<?php 

class Model_Posts extends MY_Model {
	protected $_table_name = 'posts';
	protected $_primary_key = 'post_id';
	protected $_primary_filter = 'intval';
	//protected $_order_by = 'posted_on';
	public $rules = array(
		'message'=> array(
			'field'=>'message',
			'label'=>'Message',
			'rules'=>'trim|required|htmlentities|min_length[5]|max_length[5000]'
			)
		);

	/**
	 * Checks if post is first post in thread
	 * @param  int  $pid current post id
	 * @return boolean      true if first
	 */
	public function is_first($pid) {
		$p_data = $this->get($pid);

		$this->db->order_by('posted_on');
		return $pid == $this->get_by(array('thread_id'=>$p_data->thread_id))[0]->post_id ? true : false;
	}

	/**
	 * Gets post number by post_id from residing thread
	 * @param  int $pid post id
	 * @return int      post number in thread
	 */
	public function get_post_num($pid) {
		$tid = $this->get($pid)->thread_id;

		$this->db->order_by('posted_on');
		$thread_data = $this->model_posts->get_by(array('thread_id'=>$tid));
		$arr = array();

		for ($i=0; $i < count($thread_data); $i++) { 
			$arr[] = $thread_data[$i]->post_id;
		}
		return array_search($pid, $arr)+1;
	}

	/**
	 * Gets page number of post in residing thread through post id
	 * @param  int $pid post id
	 * @return int      page number
	 */
	public function get_page_num($pid) {
		$post_num = $this->get_post_num($pid);

		$page_num = floor(($post_num-1)/$this->post_limit)+1;

		return $page_num;
	}
}