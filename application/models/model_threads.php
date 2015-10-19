<?php 

class Model_Threads extends MY_Model {
	protected $_table_name = 'threads';
	protected $_primary_key = 'thread_id';
	protected $_primary_filter = 'intval';
	//protected $_order_by = 'posted_on';
	public $rules = array(
		'subject'=> array(
			'field'=>'subject',
			'label'=>'Subject',
			'rules'=>'trim|required|htmlentities|min_length[5]|max_length[100]'
			)
		);

	function __construct() {
		
	}

	public function update($tid) {
		$this->db->query("UPDATE threads SET latest_post_date = NOW() WHERE thread_id=".$tid);
	}

}