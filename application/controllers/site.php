<?php 
class Site extends MY_Controller {

	public function  __construct() {
        parent::__construct();
	}

	public function index() {
		$this->home();
	}

	public function home() {

		//get latest three posts
		$this->db->select('threads.subject, posts.*, users.username');
		$this->db->join('users','users.user_id = posts.user_id');
		$this->db->join('threads','threads.thread_id = posts.thread_id');
		$this->db->limit(3);
		$this->db->order_by('posted_on desc');
		$this->data->posts = $this->model_posts->get();

		//get time since post in reasonable formatting (3 hours ago, etc)
		for ($i=0; $i < count($this->data->posts); $i++) { 
			$obj = $this->model_posts->time_expired($this->data->posts[$i]->posted_on);
			$this->data->posts[$i]->ago = reset($obj);
		}

		//render view
		$this->render('content_home');
	}

	public function login() {

		//if user is logged in, redirect
		if($this->model_users->loggedin()) {
			redirect('forum','refresh');
		}

		//if resent button has been pressed, resend email activation
		if($this->input->post('resend_activation')) {
			$user_data = $this->model_users->get_by(array('username'=>$this->input->post('username')), true);
			$this->model_temp->send_confirmation($user_data->email, $user_data->user_id);
		}

		//set validation rules, get from Model_Users
		$this->form_validation->set_rules($this->model_users->rules);

		//if form passes validation, run
		if($this->form_validation->run()!=false) {
			
			$arr = array('username'=>$this->input->post('username'), 'password'=>$this->input->post('password'));
			//if users login is sucessful, continue
			if($this->model_users->login($arr)) {

				//if flashdata redirect is set, redirect back to page user was previously  on
				if ($this->session->flashdata('redirect')) {
					redirect($this->session->flashdata('redirect'), 'refresh');
				}

				//else redirect to forum home
				redirect('forum','refresh');
			}
		} else if (isset($_SERVER['HTTP_REFERER'])) {
			//only set session flashdata if form has not run, else the redirect will set to site/login 
			//in case of failed attempts
			
			//split http referrer url to get page
			$redirect = explode('/', $_SERVER['HTTP_REFERER']);

			//if redirect page is logout, redirect to forum, else use original
			$redirect = $redirect[count($redirect)-1] === 'logout' ? base_url('forum') : $_SERVER['HTTP_REFERER'];

			//set flashdata
			$this->session->set_flashdata('redirect', $redirect);
		}

		//render view
		$this->render('content_'.$this->method);
	}

	public function logout() {
		$this->model_users->logout();
		redirect('site/login','refresh');
	}

	public function register() {
		if ($this->model_users->loggedin()) {
			redirect('site');
		}
		
		//form validation rules, including two callbacks
		$this->form_validation->set_rules($this->model_users->reg_rules);
		$this->form_validation->set_message('username_check','This username is already in use, please try another.');
		$this->form_validation->set_message('email_check','This email is already in use, please try another.');
		$this->form_validation->set_message('matches','The passwords do not match, please correct.');

		//if form passes validation, run
		if ($this->form_validation->run()!=false) {

			//set userdata for saving
			$arr = array(
				'username'=>$this->input->post('username'),
				'pass'=>$this->model_users->hash($this->input->post('password')),
				'email'=>$this->input->post('email')
				);
			
			//saving user details to database
			$uid = $this->model_users->save($arr);

			//sending confirmation link
			$this->model_temp->send_confirmation($this->input->post('email'), $uid);

			//flashdata registration success
			$this->session->set_flashdata('message','<p>Registration successful, please check your email for your account activation link.</p>');

			//redirect
			redirect('site/register','refresh');
		}

		//render view
		$this->render('content_'.$this->method);
	}

	public function username_check() {
		//using core model function, check if username is unique
		return $this->model_users->unique(array('username'=>$this->input->post('username'))) ? true : false;
	}

	public function email_check() {
		//using core model function, check if email is unique
		return $this->model_users->unique(array('email'=>$this->input->post('email'))) ? true : false;
	}

	public function not_found() {
		//render view
		$this->render('content_404');
	}
}