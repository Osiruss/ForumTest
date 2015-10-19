<?php 

class Model_Forum_Groups extends MY_Model {
	protected $_table_name = 'forum_groups';
	protected $_primary_key = 'forum_group_id';
	protected $_primary_filter = 'intval';
	//protected $_order_by = 'posted_on';

	function __construct() {
		
	}

}