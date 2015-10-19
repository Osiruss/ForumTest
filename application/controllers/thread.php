<?php 
class Thread extends MY_Controller {

	public function  __construct() {
        parent::__construct();
	}

	public function index() {
		if (!$tid = $this->uri->segment(2)) {
			redirect('404');
		}

		if (!$this->model_threads->get($tid)) {
			redirect('404');
		}

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3)-1 : 0;
		$this->data->pagination = $this->model_posts->pagination(
			'http://localhost/projects/11th/thread/'.$tid.'/', 
			$this->post_limit,
			3, 
			array('thread_id'=>$tid));

		$this->db->join('users', 'users.user_id = posts.user_id');
		$this->db->where('thread_id', $tid);
		$this->db->order_by('posted_on');
		$this->db->limit($this->post_limit, $page*$this->post_limit);
		$this->data->posts = $this->model_posts->get();

		$this->form_validation->set_rules($this->model_posts->rules);


		if ($this->form_validation->run()!=false) {

			//if user is not logged in redirect to login page and set erro flashdata to that effect
			if (!$this->session->userdata('loggedin')) {
				$this->session->set_flashdata('error','<p class="error">You must be logged in to post</p>');
				redirect('site/login','refresh');
			}
			$arr = array(
				'user_id'=>$this->session->userdata('id'),
				'thread_id'=>$tid,
				'message'=>$this->input->post('message')
				);

			//update last posted in thread table
			$this->model_threads->update($tid);

			//get post id of new post
			$new_pid = $this->model_posts->save($arr);

			//get page number of new post for redirect purposes
			$page_num = $this->model_posts->get_page_num($new_pid);
			$page_num = $page_num>1 ? '/'.$page_num : '';

			redirect('thread/'.$tid.$page_num.'#'.$new_pid);
		}

		//if user is not logged in set message to that effect for quick reply
		if (!$this->session->userdata('loggedin')) {
			$this->session->set_flashdata('error','<p class="error">You must be logged in to post</p>');
		}
		
		//get forum data for thread breadcrumbs
		$this->db->select('forums.forum_id');
		$this->db->join('forums','forums.forum_id = threads.forum_id');
		$this->data->breadcrumbs = $this->model_forum->breadcrumbs($this->model_threads->get($tid)->forum_id, $tid);

		$this->data->tid = $tid;
		$this->data->subject = $this->model_threads->get_by(array('thread_id'=>$tid), true)->subject;
		$this->load->view('site_header', $this->data);
		$this->load->view('forum/thread/content_thread');
		$this->load->view('site_footer');		
	}

	public function new_thread() {
		$fid = $this->uri->segment(3);

		//if user is not logged in immediately redirect with flashdata message
		if (!$this->model_users->loggedin()) {
			$this->session->set_flashdata('error','<p class="error">You must be logged in to create a new thread.</p>');
			redirect('site/login','refresh');
		}

		$this->form_validation->set_rules($this->model_posts->rules);
		$this->form_validation->set_rules($this->model_threads->rules);

		if ($this->form_validation->run()!=false) {
			$arr = array(
				'forum_id'=>$fid,
				'user_id'=>$this->session->userdata('id'),
				'subject'=>$this->input->post('subject')
				);
			$tid = $this->model_threads->save($arr);

			$arr = array(
				'thread_id'=>$tid,
				'user_id'=>$this->session->userdata('id'),
				'message'=>$this->input->post('message')
				);
			$pid = $this->model_posts->save($arr);

			redirect('thread/'.$tid, 'refresh');
		}

		$this->load->view('site_header');
		$this->load->view('forum/thread/content_'.$this->method);
		$this->load->view('site_footer');	
	}

}