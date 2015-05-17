<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Support_model extends CI_Model {
	function createSupport($support){
		$support['id'] = $this->model_util->getNewIdByTable('support');
		$support['read_flag'] = 0;
		$this->db->set('submit_date', 'DATE_ADD(NOW(), INTERVAL '.constant('GMT').' HOUR)', FALSE);
		$this->db->insert('support', $support);
	}
}