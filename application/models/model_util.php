<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_util extends CI_Model {
	function getNewId($tableName, $columnName){
		$this->db->order_by($columnName, 'desc');
		$query = $this->db->get($tableName);
		$newId = 1;
		$last = $query->first_row('array');
		if($last)
			$newId = intval($last[$columnName]) + 1;
		return $newId;
	}
}