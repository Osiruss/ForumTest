<?php 

class Model_Temp extends MY_Model {
	protected $_table_name = 'temp';
	protected $_primary_key = 'temp_id';
	protected $_primary_filter = 'intval';
	protected $_rules = array();
	
	function __construct() {
		
	}
	
	public function send_confirmation($email, $uid) {
		$code = $this->random();

		if ($this->get_by(array('user_id'=>$uid))) {
			$this->delete_by(array('user_id'=>$uid));
		}		

		$this->email->from('osiruss@live.com', 'Osiruss admin');
		$this->email->to($email); 
		$this->email->subject('Confirmation link');

		$message = '<h2>Email verification message</h2>';
		$message .= '<p>Please follow, or copy and paste the link provided into your browser of choice:</p>';
		$message .= '<a href="'.base_url('temp/'.$code).'">'.base_url('temp/'.$code).'</a>';

		$this->email->message($message);

		$this->save(array('code'=>$code,'user_id'=>$uid));	

		$this->email->send();
	}

	public function random() {
		$result = '';

		for ($i=0; $i < 12; $i++) { 
			$result .= rand(0, 9);
		}

		return $result;
	}
}