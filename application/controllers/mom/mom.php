<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mom extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('mom/mom_model');
		$this->load->library('pagination');
	}
	
	private function __initMom(){
		$mom['mom_id'] = null;
		$mom['mom_subject'] = null;
		$mom['mom_content'] = null;
		$mom['meeting_date'] = null;
		// $mom['create_date'] = null;
		// $mom['last_update_date'] = null;
		$user = $this->session->userdata('user');
		$mom['create_by_user_id'] = $user['user_id'];
		return $mom;
	}
	
	public function index(){
		$input = $this->input->get();
		if($input['page'] == null)
			$currentPage = 1;
		else
			$currentPage = $input['page'];
		
		$pageSize = 5;
		$total_rows = $this->mom_model->getNumberAllMinuteOfMeeting();
		$data['momList'] = $this->mom_model->getAllMinuteOfMeeting($currentPage, $pageSize);
		
		$totalPage = $total_rows / $pageSize;
		if($total_rows % $pageSize > 0)
			$totalPage++;
		$data['totalPage'] = $totalPage;
		$data['currentPage'] = $currentPage;
		
		$this->template->load('mom/mom_list', $data);
	}
	
	public function addMom(){
		$data['mom'] = $this->__initMom();
		$this->template->load('mom/mom_detail', $data);
	}
	
	public function editMom($momId){
		$data['mom'] = $this->mom_model->getMinuteOfMeeting($momId);
		$this->template->load('mom/mom_detail', $data);
	}
	
	public function showMom($momId){
		$data['momDetail'] = $this->mom_model->getMinuteOfMeeting($momId);
		$this->template->load('mom/mom', $data);
	}
	
	public function saveMom(){
		$mom = $this->input->post();
		
		if($mom['submit'] == 'Cancel'){
			redirect('mom/mom');
			return;
		}
		
		unset($mom['submit']);
		if($mom['mom_id'] == ''){
			$this->mom_model->createMinuteOfMeeting($mom);
		} else {
			$this->mom_model->updateMinuteOfMeeting($mom);
		}
		
		$this->template->load('templates/success');
	}
}