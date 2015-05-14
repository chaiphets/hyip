<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Material_model extends CI_Model {
	function createMaterial($material){
		$this->db->order_by('material_id', 'desc');
		$query = $this->db->get('fg_material');
		$newId = 1;
		$last = $query->first_row('array');
		if($last)
			$newId = intval($last['material_id']) + 1;
		
		//fg_material_files
		if(isset($material['files'])){
			foreach($material['files'] as $key => $files){
				$file['material_id'] = $newId;
				$file['file_id'] = $key + 1;
				$file['file_name'] = $files['file_name'];
				$file['full_path'] = 'img/uploads/material/'.sprintf('%04d',$file['material_id']).'_'.$file['file_name'];
				$this->db->insert('fg_material_files', $file);
				
				//move files
				rename('img/tmp/'.$file['file_name'], $file['full_path']);
			}
			
			unset($material['files']);
		}
		
		//fg_material
		$material['material_id'] = $newId;
		$material['purchased_date'] = implode("-", array_reverse(explode("/", $material['purchased_date'])));
		$material['claim_price'] = $material['material_price'] * $material['claim_rate'];
		$this->db->insert('fg_material', $material);
		
		//fg_material_depreciate
		for($i=1;$i<=5;$i++){
			$depreciate['material_id'] = $material['material_id'];
			$depreciate['year'] = $i;
			// if($i == 1)
				// $depreciate['depreciate_rate'] = 40;
			// else
				// $depreciate['depreciate_rate'] = 12;
				$depreciate['depreciate_rate'] = 0.2;
			$this->db->insert('fg_material_depreciate', $depreciate);
		}
		
		
		//fg_task
		// $currentUser = $this->session->userdata('user');
		// $query = $this->db->get_where('fg_user', array('flag'=>'1','user_id !='=>$currentUser['user_id']));
		// $users = $query->result_array();
		// foreach($users as $key=>$user){
			// $this->db->order_by('task_id', 'desc');
			// $query = $this->db->get('fg_task');
			// $newId = 1;
			// $last = $query->first_row('array');
			// if($last)
				// $newId = intval($last['task_id']) + 1;
// 			
			// $task['task_id'] = $newId;
			// $task['type'] = 'fg_material';
			// $task['type_id_name'] = 'material_id';
			// $task['type_id'] = $material['material_id'];
			// $task['owner_user_id'] = $user['user_id'];
			// $task['is_complete'] = 0;
			// $this->db->set('created_date', 'DATE_ADD(NOW(), INTERVAL '.constant('GMT').' HOUR)', FALSE);
			// $this->db->insert('fg_task', $task);
		// }
		$this->load->model('task/task_model');
		$taskDetail['type'] = 'fg_material';
		$taskDetail['type_id_name'] = 'material_id';
		$taskDetail['type_id'] = $material['material_id'];
		$this->task_model->createTask($taskDetail);
	}
	function getAllMaterial(){
		$this->db->join('fg_user', 'fg_material.owner_user_id = fg_user.user_id');
		$query = $this->db->get('fg_material');
		$materials = $query->result_array();
		foreach($materials as $key => $material){
			$materials[$key]['purchased_date'] = date('d/m/Y', strtotime($material['purchased_date']));
			$query = $this->db->get_where('fg_task', array('type'=>'fg_material','type_id'=>$material['material_id']));
			$taskNum = $query->num_rows();
			$tasks = $query->result_array();
			if($taskNum > 0)
				$taskNum++;
			foreach ($tasks as $task) {
				if(intval($task['is_complete']) < 0){
					$taskNum = -1;
					break;
				} else {
					$taskNum -= intval($task['is_complete']);
				}
			}
			if($taskNum == 1)
				$materials[$key]['status'] = 'Approved';
			else if($taskNum == -1)
				$materials[$key]['status'] = 'Rejected';
			else
				$materials[$key]['status'] = 'Waiting for approve';
		}
		return $materials;
	}
	function getMaterial($materialId){
		$this->db->join('fg_user', 'fg_material.owner_user_id = fg_user.user_id');
		$query = $this->db->get_where('fg_material', array('material_id'=>$materialId));
		$material = $query->row_array();
		
		$material['purchased_date'] = date('d/m/Y', strtotime($material['purchased_date']));
		
		$query = $this->db->get_where('fg_material_files', array('material_id'=>$materialId));
		$files = $query->result_array();
		if($files)
			$material['files'] = $files;
		
		// task list
		$this->load->model('task/task_model');
		$material['tasks'] = $this->task_model->getTaskDetailByTypeAndTypeId('fg_material',$materialId);
		
		return $material;
	}
}