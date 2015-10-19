<?php 
class User extends MY_Controller {

	public function  __construct() {
        parent::__construct();
	}

	public function index() {
		//if user_id is not set in uri, redirect
		if (!$uid = $this->uri->segment(2)) {
			redirect('forum');
		}

		//if user_id is invalid, redirect
		if (!$this->data->user = $this->model_users->get($uid)) {
			redirect('404');
		}

		//render view
		$this->render('forum/user/content_'.$this->method);
	}

	public function edit_user() {

		//retreives user id from uri
		$uid = $this->uri->segment(3);
		//retreives user info from database
		$this->data->user = $this->model_users->get($uid);

		//if user is not admin, go through to next stage
		//if user is not logged in, or the user_id from the uri does not match the session id, redirect
		if (!$this->is_admin) {
			if (!$this->model_users->loggedin() || $uid != $this->session->userdata('id')) {
				redirect('forum');
			}
		}

		//set validation rules
		$this->form_validation->set_rules('bio','Bio','trim|htmlentities|min_length[5]|max_length[500]');

		if ($this->form_validation->run()!=false) {
			//create avatar sized image from file, deletes original
			$this->model_users->create_thumb($uid);

			//saves bio data to database
			$this->model_users->save(array('bio'=>$this->input->post('bio')), $this->data->user->user_id);
			
			redirect('user/'.$uid, 'refresh');
		}

		//render view
		$this->render('forum/user/content_'.$this->method);
	}
}
