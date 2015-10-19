<?php 
class Forum extends MY_Controller {

	public function  __construct() {
        parent::__construct();
	}

	public function index() {
		//get list of forums
		$this->db->order_by('forum_group_id');
		$forums = $this->model_forum->get();

		//get list of forum groups
		$forum_groups = $this->model_forum_groups->get();
		
		//for every group
		for ($i=0; $i < count($forum_groups); $i++) { 
			$forum_groups[$i]->forums = array();

			//for every forum in group
			for ($l=0; $l < count($forums); $l++) { 

				//if forum group id matches a group id add to array
				//used to group forums before outputting to view
				if ($forum_groups[$i]->forum_group_id == $forums[$l]->forum_group_id) {
					$forum_groups[$i]->forums[] = $forums[$l];
				}
			}
		}

		//for each forum group
		for ($l=0; $l < count($forum_groups); $l++) { 

			//for each forum
			for ($i=0; $i < count($forum_groups[$l]->forums);$i++) { 

				//get forum id
				$fid = $forum_groups[$l]->forums[$i]->forum_id;

				//set get where array for forum id
				$arr = array('forum_id'=>$fid);

				//count number of threads in specific forum
				$this->db->select('COUNT(thread_id) as count');
				$forum_groups[$l]->forums[$i]->thread_count = $this->model_threads->get_by($arr, true)->count;

				//count number of posts in specific forum by joining post table
				//joined on thread_id to get posts from specific threads from specific forum
				$this->db->select('COUNT(posts.post_id) as post_count');
				$this->db->join('posts','posts.thread_id = threads.thread_id');
				$forum_groups[$l]->forums[$i]->post_count = $this->model_threads->get_by($arr, true)->post_count;

				//get info on latest poster, such as where the post was made and when, by forum
				$this->db->select('users.username, posts.posted_on, threads.subject, threads.thread_id, users.user_id, posts.post_id');
				$this->db->join('posts','posts.thread_id = threads.thread_id');
				$this->db->join('users','users.user_id = posts.user_id');
				$this->db->order_by('posts.posted_on DESC');
				$forum_groups[$l]->forums[$i]->latest = $this->model_threads->get_by($arr, true);

				//if there are no posts in the specific forum, do not continue
				if ($forum_groups[$l]->forums[$i]->latest != null) {
					$obj = $this->model_posts->time_expired($forum_groups[$l]->forums[$i]->latest->posted_on);
					$forum_groups[$l]->forums[$i]->latest->ago = reset($obj);
				}
			}			
		}
		
		$this->data->forum_grouping = $forum_groups;

		//get list of users active in the last xxx minutes
		$this->data->latest_activity = $this->model_users->last_activity($this->data->activity_limit);

		//render view
		$this->render('forum/content_'.$this->method);	
	}

	public function board() {
		//if forum id is not set, redirect
		if (!$fid = $this->uri->segment(2)) {
			redirect('forum');
		}

		//get current page, 0 if not set
		$page = $this->uri->segment(3) ? $this->uri->segment(3)-1 : 0;

		//get pagination links by using current url (without page), thread limit per page, 
		//uri segment where page resides and the by portion to get total number of results
		$this->data->pagination = $this->model_threads->pagination(
			'http://localhost/projects/11th/board/'.$fid.'/', 
			$this->thread_limit, 
			3, 
			array('forum_id'=>$fid));

		//get threads by forum id, ordered by latest post
		$this->db->select('threads.*, users.username');
		$this->db->join('users','threads.user_id = users.user_id');
		$this->db->order_by('threads.latest_post_date DESC');
		$this->db->limit($this->thread_limit, $page*$this->thread_limit);
		$this->data->threads = $this->model_threads->get_by(array('forum_id'=> $fid));

		//for every thread
		for ($i=0; $i < count($this->data->threads); $i++) { 

			//get thread id
			$tid = $this->data->threads[$i]->thread_id;

			//set get_by array
			$arr = array('forum_id'=>$fid, 'threads.thread_id'=>$tid);

			//get info on latest post. where, when, by whom
			$this->db->select('posts.*, users.username, users.user_id');
			$this->db->join('posts','posts.thread_id = threads.thread_id');
			$this->db->join('users','posts.user_id = users.user_id');
			$this->db->order_by('posted_on DESC');
			$this->data->threads[$i]->latest = $this->model_threads->get_by($arr, true);

			//get post count of specific thread
			$this->db->select('COUNT(posts.post_id) as post_count');
			$this->db->join('posts', 'posts.thread_id = threads.thread_id');
			$this->data->threads[$i]->post_count = $this->model_threads->get_by($arr, true)->post_count;

			//if there are no posts in the specific forum, do not continue
			if ($this->data->threads[$i]->latest != null) {
				$obj = $this->model_threads->time_expired($this->data->threads[$i]->latest->posted_on);
				$this->data->threads[$i]->latest->ago = reset($obj);
			}
		}
		
		//get breadcrumbs of specific forum. i.e. parent forums
		$this->data->breadcrumbs = $this->model_forum->breadcrumbs($fid);
		$this->data->fid = $fid;

		//render view
		$this->render('forum/content_'.$this->method);
	}
}