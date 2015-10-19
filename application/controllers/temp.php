<?php 
class Temp extends MY_Controller {

	public function  __construct() {
        parent::__construct();
	}

	public function index() {
		$this->data->activated = false;

		if (!$cid = $this->uri->segment(2)) {
			redirect('404');
		}
		
		//if code in uri matches an instance in the database, continue
		if ($c_data = $this->model_temp->get_by(array('code'=>$cid), true)) {
			$this->model_users->save(array('active'=>1), $c_data->user_id);
			$this->model_temp->delete_by(array('user_id'=>$c_data->user_id));
			$this->data->activated = true;
		} else {
			$this->session->set_flashdata('error','<p>Invalid or expired activation link. Please try resending another by attempting to login.</p>');
		}

		$this->load->view('templates/site_header', $this->data);
		$this->load->view('forum/user/content_temp');
		$this->load->view('templates/site_footer');	
	}
}
