<?php 

class Model_Forum extends MY_Model {
	protected $_table_name = 'forums';
	protected $_primary_key = 'forum_id';
	protected $_primary_filter = 'intval';
	//protected $_order_by = 'posted_on';
	protected $_rules = array();
	protected $_timestamps = false;

	public function breadcrumbs($fid, $tid = null) {
		$initial = $this->get($fid);
		$arr = array();
		$arr[] = $initial;

		while ($initial->parent_id != 0) {
			$initial = $this->get($initial->parent_id);
			$arr[] = $initial;
		}

		$arr[] = (object) array('forum_id'=>'', 'title'=>'Index', 'description'=>'Forum index');

		$output = '<ul class="breadcrumbs">';

		for ($i = count($arr)-1; $i >= 0; $i--) { 
			if ($arr[$i]->forum_id == $fid) {
				if ($tid) {
					$output .= '<li><a href="'.base_url('board/'.$fid).'">'.$arr[$i]->title.'</a></li> > ';
				} else {
					$output .= '<li>'.$arr[$i]->title.'</li>';
				}
			} else if($arr[$i]->forum_id === '' ){
				$output .= '<li><a href="'.base_url('forum').'">'.$arr[$i]->title.'</a></li> > ';
			} else {
				$output .= '<li><a href="'.base_url('board/'.$arr[$i]->forum_id).'">'.$arr[$i]->title.'</a></li> > ';
			}
		}
		if ($tid) {
			$output .= '<li>'.$this->model_threads->get($tid)->subject.'</li>';
		}
		return $output .= '</ul>';
	}
}