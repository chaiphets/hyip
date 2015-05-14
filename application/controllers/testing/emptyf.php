<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Emptyf extends CI_Controller{
	public function test(){
		$query = $this->db->get_where('fg_task', array('type_id'=>0));
		$row_array = $query->row_array();
		var_dump($row_array);
		// echo is_array($query->row_array());
		echo empty($row_array);
	}
}