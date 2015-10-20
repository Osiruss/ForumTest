<?php 
/**
* Ok
*/
class MY_Controller extends CI_Controller {
	public $data;
	public $method;
	public $controller;
	public $is_admin;
	public $thread_limit;
	public $post_limit;
	public $activity_limit;

	function __construct() {
        parent::__construct();

        //load all models
        $models = scandir('./application/models');
        for ($i=0; $i < count($models); $i++) { 
        	if (!in_array($models[$i], array('.','..','index.html'))) {
        		$this->load->model(str_replace('.php', '', $models[$i]));
        	}
        }

        //set up data object
   		$this->data = new stdClass();

        //activity limit for last online, in minutes
		$this->data->activity_limit = 240;

		//get class and method names
		$this->class = $this->router->fetch_class();
		$this->method = $this->router->fetch_method();

		//check if user is admin on each page
		$this->is_admin = $this->model_users->is_admin();

		//update users activity on each page
		$this->model_users->update_activity($this->model_users->get_user_id());

		//limits for pagination purposes
		$this->thread_limit = 10;
		$this->post_limit = 5;
	}

	public function render($f) {
		$this->load->view('templates/site_header', $this->data);
		$this->load->view($f);
		$this->load->view('templates/site_footer');
	}

}