<?php 
/**
* Ok
*/
class MY_Model extends CI_Model {
	protected $_table_name = '';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	protected $_rules = array();
	protected $_timestamps = false;

	function __construct() {
		parent::__construct();
	}

	public function get($id = null, $single = false){
		if ($id != null) {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key , $id);
			$method = 'row';
		} else  if ($single == true) {
			 $method = 'row';
		} else {
			 $method = 'result';
		}

		return $this->db->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = false){
		//sets the where clause
		$this->db->where($where);

		//if only a single row is needed, reflect in $method
		if ($single === true) {
			$method = 'row';
		} else {
			 $method = 'result';
		}

		return $this->db->get($this->_table_name)->$method();
	}

	public function save($data, $id = null){
		//if $id is set then update, if not, insert
		if ($id === null) {
			//If primary key field is set, set to null.
			if (isset($data[$this->_primary_key])) {
				$data[$this->_primary_key] = null;
			}
			//insert/update queries both require $data to be set() fist
			$this->db->set($data);
			$this->db->insert($this->_table_name);
			$id = $this->db->insert_id();
		} else {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->set($data);
			$this->db->where($this->_primary_key, $id);
			$this->db->update($this->_table_name);
		}

		return $id;
	}

	public function delete($id){
		$filter = $this->_primary_filter;
		$id = $filter($id);
		if (!$id) {
			return false;
		}
		$this->db->where($this->_primary_key, $id);
		$this->db->limit(1);
		$this->db->delete($this->_table_name);
	}

	public function delete_by($arr) {
		$this->db->delete($this->_table_name, $arr);
	}

	public function unique($arr) {
		if ($this->{'model_'.$this->_table_name}->get_by($arr)) {
			return false;
		} else {
			return true;
		}
	}

	/*
	Record count
	If argument is set, count by field
	 */
	public function record_count($arr = null) {
		$this->db->select("COUNT($this->_primary_key) as count");
		if ($arr) {
			$this->db->where($arr);
		}
		return $this->get()[0]->count;
	}

	public function pagination($base_url, $limit, $uri, $by = null) {
		$config['base_url'] = $base_url;
		$config['per_page'] = $limit;
		$config['uri_segment'] = $uri;
		$config['total_rows'] = $by ? $this->record_count($by) : $this->record_count();
		$this->pagination->initialize($config); 
		return $this->pagination->create_links();
	}

	public function last_activity($minutes) {
		$minutes_ago = time() - (60 * $minutes);
		$datetime = date('Y-m-d H:i:s', $minutes_ago);

		$this->db->where("last_active >= '$datetime'");
		$this->db->order_by('last_active desc');
		return $this->get();
	}
}