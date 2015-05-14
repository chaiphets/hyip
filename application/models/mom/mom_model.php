<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mom_model extends CI_Model {
	function __construct(){
        // Call the Model constructor
        parent::__construct();
		$this->load->model('model_util');
    }
	
	private function reconstructToDB($momDetail){
		$momDetail['meeting_date'] = implode("-", array_reverse(explode("/", $momDetail['meeting_date'])));
		return $momDetail;
	}
	
	private function reconstructFromDB($momDetail){
		$momDetail['meeting_date'] = date('d/m/Y', strtotime($momDetail['meeting_date']));
		return $momDetail;
	}
	
	function createMinuteOfMeeting($momDetail){
		$momDetail['mom_id'] = $this->model_util->getNewId('fg_mom', 'mom_id');
		
		$momDetail = $this->reconstructToDB($momDetail);
		
		$this->db->set('create_date', 'DATE_ADD(NOW(), INTERVAL '.constant('GMT').' HOUR)', FALSE);
		$this->db->set('last_update_date', 'DATE_ADD(NOW(), INTERVAL '.constant('GMT').' HOUR)', FALSE);
		$this->db->insert('fg_mom', $momDetail);
	}
	
	function updateMinuteOfMeeting($momDetail){
		$momDetail = $this->reconstructToDB($momDetail);
		$this->db->set('last_update_date', 'DATE_ADD(NOW(), INTERVAL '.constant('GMT').' HOUR)', FALSE);
		$this->db->update('fg_mom', $momDetail, array('mom_id'=>$momDetail['mom_id']));
	}
	
	function getMinuteOfMeeting($momId){
		$query = $this->db->get_where('fg_mom', array('mom_id'=>$momId));
		$momDetail = $query->row_array();
		
		$momDetail = $this->reconstructFromDB($momDetail);
		
		return $momDetail;
	}
	
	function getAllMinuteOfMeeting($currentPage, $pageSize){
		$limit = $pageSize;
		$offset = ($currentPage - 1) * $limit;
		
		$this->db->order_by('mom_id', 'desc'); 
		$query = $this->db->get('fg_mom', $limit, $offset);
		$momList = $query->result_array();
		foreach ($momList as $key => $momDetail) {
			$momList[$key] = $this->reconstructFromDB($momDetail);
		}
		return $momList;
	}
	
	function getNumberAllMinuteOfMeeting(){
		return $this->db->count_all('fg_mom');
	}
}