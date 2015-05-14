<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Task extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('task/task_model');
	}
	public function index(){
		$user = $this->session->userdata('user');
		$tasks = $this->task_model->getTasksByUserId($user['user_id']);
		// $tasks = $this->task_model->getTasksByUserId(2);					//FIXME
		
		//re-structure
		foreach ($tasks as $key => $task) {
			$tasks[$key]['task_detail']['purchased_date'] = date('d/m/Y', strtotime($tasks[$key]['task_detail']['purchased_date']));
			if($task['type'] == 'fg_material'){
				$tasks[$key]['type'] = 'อุปกรณ์';
				// $tasks[$key]['link'] = 'material/material/showMaterial/'.$task['type_id'];
			} else if($task['type'] == 'fg_raw_material') {
				$tasks[$key]['type'] = 'วัตถุดิบ';
				// $tasks[$key]['link'] = 'material/raw_material/showMaterial/'.$task['type_id'];
			} else if($task['type'] == 'fg_misc') {
				$tasks[$key]['type'] = 'จิปาถะ';
				// $tasks[$key]['link'] = 'material/misc/showMaterial/'.$task['type_id'];
			} 
		}
		
		$data['tasks'] = $tasks;
		$this->template->load('task/my_task', $data);
	}
	public function taskDetail($taskId=null){
		if($taskId == null)
			show_404();
		
		$task = $this->task_model->getTaskDetailByTaskId($taskId);
		
		$user = $this->session->userdata('user');
		if($task['owner_user_id'] != $user['user_id'])
			show_404();
		
		$data['material'] = $task['task_detail'];
		$data['task'] = $task;
		$data['readonly'] = true;
		if($task['is_complete'] == 0)
			$data['approveTask'] = true;
		if($task['type'] == 'fg_material')
			$this->template->load('expense/material/material_detail', $data);
		else if($task['type'] == 'fg_raw_material')
			$this->template->load('expense/raw_material/material_detail', $data);
		else if($task['type'] == 'fg_misc')
			$this->template->load('expense/misc/material_detail', $data);
		else
			show_404();
	}
	public function completeTask(){
		$task = $this->input->post();
		$this->task_model->completeTask($task);
		
		$this->index();
	}
}