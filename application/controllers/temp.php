<?php 
class Temp extends MY_Controller {

	public function  __construct() {
        parent::__construct();
	}

	public function index() {
		//activated boolean check, used in view
		$this->data->activated = false;

		//if activation code is not set, redirect
		if (!$cid = $this->uri->segment(2)) {
			redirect('404');
		}
		
		//if code in uri matches an instance in the database, continue
		if ($c_data = $this->model_temp->get_by(array('code'=>$cid), true)) {
			//update user to be active
			$this->model_users->save(array('active'=>1), $c_data->user_id);

			//delete any other activation codes for said user
			$this->model_temp->delete_by(array('user_id'=>$c_data->user_id));
			
			$this->data->activated = true;
		} else {
			$this->session->set_flashdata('error','<p>Invalid or expired activation link. Please try resending another by attempting to login.</p>');
		}

		//render view
		$this->render('forum/user/content_temp');
	}
}
