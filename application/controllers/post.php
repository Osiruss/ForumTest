<?php 
class Post extends MY_Controller {

	public function  __construct() {
        parent::__construct();
	}

	public function index() {
		//if post_id uri is not set, redirect
		if (!$pid = $this->uri->segment(2)) {
			redirect('404');
		}

		//if id is not a valid post, redirect to 404
		if (!$this->model_posts->get($pid)) {
			redirect('404');
		}

		//get post data + userdata by joining posts & users tables ON user_id
		$this->db->join('users','users.user_id = posts.user_id');
		$this->data->post = $this->model_posts->get($pid);

		//get subject of individual post's thread
		$this->data->subject = $this->model_threads->get($this->data->post->thread_id)->subject;

		//render view
		$this->render('forum/post/content_post');
	}

	public function new_post() {
		$tid = $this->uri->segment(3);

		//if user is not logged in or thread id to post in is not set, redirect
		if (!$this->model_users->loggedin()) {
			$this->session->set_flashdata('error','<p class="error">You must be logged in to post</p>');
			redirect('site/login', 'refresh');
		} elseif ($this->model_threads->get($tid) == null) {
			redirect('site/not_found');
		}

		//set post validation rules
		$this->form_validation->set_rules($this->model_posts->rules);

		//if post validates, run
		if ($this->form_validation->run()!=false) {
			//set array of post info for saving to database
			$arr = array(
				'thread_id'=>$tid,
				'user_id'=>$this->session->userdata('id'),
				'message'=>nl2br($this->input->post('message'))
				);
			//post_id of new post for redirecting purposes
			$new_pid = $this->model_posts->save($arr);

			//update threads latest_post_date field
			$this->model_threads->update($tid);

			//get page number of post (by counting number of posts in thread, and finding number in order)
			//then divide by page limit, then some math jiggery-pokery to get the whole number
			$page_num = $this->model_posts->get_page_num($new_pid);
			$page_num = $page_num>1 ? '/'.$page_num : '';

			//redirect to new post on correct page
			redirect('thread/'.$tid.$page_num.'#'.$new_pid, 'refresh');
		}

		//render view
		$this->render('forum/post/content_'.$this->method);
	}

	public function edit_post() {
		//if user is not logged in redirect to login with flashdata message
		if (!$this->model_users->loggedin()) {
			$this->session->set_flashdata('error','<p class="error">You must be logged in to edit posts</p>');
			redirect('site/login', 'refresh');
		}

		//if user is logged in, its safe to assume id is too, but just in caaaaaaaaase
		if (!$uid = $this->session->userdata('id')) {
			redirect('forum','refresh');
		}
		
		//if pid is not set, 404 appears, no redirect necessary
		$pid = $this->uri->segment(3);

		//get post data
		$this->data->post = $this->model_posts->get($pid);

		//get thread id for redirect purposes
		$tid = $this->model_posts->get($pid)->thread_id;

		//if user is not admin AND the current users id does not match the posters id then redirect
		//should probably put flashdata stuff here
		if (!$this->is_admin) {
			if ($uid != $this->model_posts->get($pid)->user_id) {
				redirect('forum', 'refresh');
			}
		}

		//set validation rules for editing post
		$this->form_validation->set_rules($this->model_posts->rules);
		$this->form_validation->set_rules('subject','subject','trim|htmlentities|max_length[100]|min_length[5]');

		//if form data passes validation, run
		if ($this->form_validation->run()!=false) {
			//as primary key is included, update rather than insert
			$this->model_posts->save(array('message'=>$this->input->post('message')), $pid);
			//if subject field is set, update subject for respective thread
			if ($this->input->post('subject')) {
				$this->model_threads->save(array('subject'=>$this->input->post('subject')),$tid);
			}

			//mathematical jiggery pokery to get page number from post_id
			$page_num = $this->model_posts->get_page_num($pid);
			$page_num = $page_num>1 ? '/'.$page_num : '';

			redirect('thread/'.$tid.$page_num.'#'.$pid, 'refresh');
		}

		//if post id is first, show subject field in view
		$this->data->first_post = $this->model_posts->is_first($pid);

		//get thread data
		$this->data->thread = $this->model_threads->get($tid);
		
		//render view
		$this->render('forum/post/content_'.$this->method);
	}

	public function delete_post() {
		//get post id from uri
		$pid = $this->uri->segment(3);

		//get post number of post for deciding whether to delete thread or single post
		$post_num = $this->model_posts->get_post_num($pid);

		//get post data
		$post_data = $this->model_posts->get($pid);
		$fid = $this->model_threads->get($post_data->thread_id)->forum_id;

		//if post data is falsey, redirect. this will be due to no data being found for the specific post id
		if (!$post_data) {
			redirect('404');
		}

		//if post is set the only course of action is to delete, if the user clicked no theyd be redirected
		if ($this->input->post()) {
			//if post number is greater than one delete post, else delete all posts by thread id and parent thread
			if ($post_num > 1) {
				$this->model_posts->delete($pid);
				redirect('thread/'.$post_data->thread_id);
			} else {
				$this->model_posts->delete_by(array('thread_id'=>$post_data->thread_id));
				$this->model_threads->delete($post_data->thread_id);
				redirect('board/'.$fid);
			}
		}

		//if first variable used only for changing the worrd 'posdt' to 'thread'
		$this->data->is_first = $this->model_posts->is_first($pid);

		//thread id used to redriect should the user choose not to delete
		$this->data->tid = $post_data->thread_id;

		//render view
		$this->render('forum/post/content_'.$this->method);
	}

}