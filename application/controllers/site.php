<?php 
class Site extends MY_Controller {

	public function  __construct() {
        parent::__construct();
	}

	public function index() {
		$this->home();
	}

	public function home() {
		$this->db->select('threads.subject, posts.*, users.username');
		$this->db->join('users','users.user_id = posts.user_id');
		$this->db->join('threads','threads.thread_id = posts.thread_id');
		$this->db->limit(3);
		$this->db->order_by('posted_on desc');
		$this->data->posts = $this->model_posts->get();


		for ($i=0; $i < count($this->data->posts); $i++) { 
			$obj = $this->model_posts->time_expired($this->data->posts[$i]->posted_on);
			$this->data->posts[$i]->ago = reset($obj);
		}

		$this->load->view('site_header', $this->data);
		$this->load->view('content_home');
		$this->load->view('site_footer');
	}

	public function login() {
		if($this->model_users->loggedin()) {
			redirect('forum','refresh');
		}

		if($this->input->post('resend_activation')) {
			$user_data = $this->model_users->get_by(array('username'=>$this->input->post('username')), true);
			$this->model_temp->send_confirmation($user_data->email, $user_data->user_id);
		}

		$this->form_validation->set_rules($this->model_users->rules);

		if($this->form_validation->run()!=false) {
			if($this->model_users->login()) {
				if ($this->session->flashdata('redirect')) {
					redirect($this->session->flashdata('redirect'), 'refresh');
				}
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

		$this->load->view('site_header', $this->data);
		$this->load->view('content_'.$this->method);
		$this->load->view('site_footer');
	}

	public function logout() {
		$this->model_users->logout();
		redirect('site/login','refresh');
	}

	public function register() {
		if ($this->model_users->loggedin()) {
			redirect('site');
		}
			
		$this->form_validation->set_rules($this->model_users->reg_rules);
		$this->form_validation->set_message('username_check','This username is already in use, please try another.');
		$this->form_validation->set_message('email_check','This email is already in use, please try another.');
		$this->form_validation->set_message('matches','The passwords do not match, please correct.');

		if ($this->form_validation->run()!=false) {
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

		$this->load->view('site_header');
		$this->load->view('content_'.$this->method);
		$this->load->view('site_footer');
	}

	public function username_check() {
		return $this->model_users->unique(array('username'=>$this->input->post('username'))) ? true : false;
	}

	public function email_check() {
		return $this->model_users->unique(array('email'=>$this->input->post('email'))) ? true : false;
	}

	public function not_found() {
		$this->load->view('site_header');
		$this->load->view('content_404');
		$this->load->view('site_footer');
	}
}