<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Task_model extends CI_Model {
	function createTask($taskDetail){
		//fg_task
		$currentUser = $this->session->userdata('user');
		$query = $this->db->get_where('fg_user', array('flag'=>'1','user_id !='=>$currentUser['user_id']));
		$users = $query->result_array();
		foreach($users as $key=>$user){
			$this->db->order_by('task_id', 'desc');
			$query = $this->db->get('fg_task');
			$newId = 1;
			$last = $query->first_row('array');
			if($last)
				$newId = intval($last['task_id']) + 1;
			
			$task['task_id'] = $newId;
			$task['type'] = $taskDetail['type'];
			$task['type_id_name'] = $taskDetail['type_id_name'];
			$task['type_id'] = $taskDetail['type_id'];
			$task['owner_user_id'] = $user['user_id'];
			$task['is_complete'] = 0;
			$this->db->set('created_date', 'DATE_ADD(NOW(), INTERVAL '.constant('GMT').' HOUR)', FALSE);
			$this->db->insert('fg_task', $task);
			
			$this->sendMailAfterCreateTask($user['email'], $task['task_id']);
		}
	}
	function sendMailAfterCreateTask($to, $taskId){
		$subject = "Fast Good - You have new task";
		$message = "คุณมี task ใหม่เข้ามา ช่วยเข้าไปดูและพิจารณาหน่อยครัช<br><br>http://www.fastgood-fg.com/index.php/task/task/taskDetail/".$taskId;
		$this->sendMail($to, $subject, $message);
	}
	function sendMail($to, $subject, $message){
		$params['username'] = 'fastgoood@gmail.com';
		$params['password'] = 'thaimail';
		$this->load->library('gmail', $params);
		
		$mail['to'] = $to;
		$mail['subject'] = $subject;
		$mail['message'] = $message;
		$this->gmail->send($mail);
	}
	function sendMailWs($to, $subject, $message){
		$postfields = "username=fastgoood@gmail.com&password=thaimail";
		$postfields .= "&to=".$to;
		$postfields .= "&subject=".$subject;
		$postfields .= "&message=".$message;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://smartvc.vert2zest.com/index.php/webservice/sendgmail/send");
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_exec($ch);
		curl_close($ch);
	}
	function sendMailCi(){
		//send email
		$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'fastgoood@gmail.com',
		    'smtp_pass' => 'thaimail',
		    'mailtype'  => 'html',
		    'charset'   => 'utf-8'
		);
		$this->load->library('email');
		$this->email->initialize($config);
		
		$this->email->from('fastgoood@gmail.com', 'Fast Good');
		$this->email->to('chaiphetsa@gmail.com');
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');

		$this->email->send();
		
		var_dump($this->email->print_debugger());
	}
	function getTasksByUserId($userId){
		$this->db->order_by('task_id', 'desc');
		$query = $this->db->get_where('fg_task', array('owner_user_id'=>$userId,'is_complete'=>0));
		$tasks = $query->result_array();
		if(!$tasks)
			return $tasks;
		foreach ($tasks as $key => $task) {
			// $this->db->where('');
			$query = $this->db->get_where('fg_task', array('type'=>$task['type'],'type_id'=>$task['type_id'],'owner_user_id !='=>$task['owner_user_id'],'is_complete'=>-1));
			$row_array = $query->row_array();
			if(!empty($row_array)){
				unset($tasks[$key]);
				continue;
			}
			
			$query = $this->db->get_where($task['type'], array($task['type_id_name']=>$task['type_id']));
			$taskDetail = $query->row_array();
			$query = $this->db->get_where('fg_user', array('user_id'=>$taskDetail['owner_user_id']));
			$userDetail = $query->row_array();
			$taskDetail['owner_user_detail'] = $userDetail;
			$tasks[$key]['task_detail'] = $taskDetail;
		}
		return $tasks;
	}
	function getTaskDetailByTaskId($taskId){
		$this->db->join('fg_user', 'fg_task.owner_user_id = fg_user.user_id');
		$query = $this->db->get_where('fg_task', array('task_id'=>$taskId));
		$task = $query->row_array();
		
		// task detail
		$this->db->join('fg_user', $task['type'].'.owner_user_id = fg_user.user_id');
		$query = $this->db->get_where($task['type'], array($task['type_id_name']=>$task['type_id']));
		$taskDetail = $query->row_array();
		
		$taskDetail['purchased_date'] = date('d/m/Y', strtotime($taskDetail['purchased_date']));
		
		// task files
		$tableFileName = $task['type'].'_files';
		if($this->db->table_exists($tableFileName)){
			$query = $this->db->get_where($tableFileName, array($task['type_id_name']=>$task['type_id']));
			$taskDetail['files'] = $query->result_array();
		}
		
		$taskDetail['tasks'] = $this->getTaskDetailByTypeAndTypeId($task['type'], $task['type_id']);
		
		$task['task_detail'] = $taskDetail;
		
		return $task;
	}
	function getTaskDetailByTypeAndTypeId($type, $typeId){
		// task list
		$this->db->join('fg_user', 'fg_task.owner_user_id = fg_user.user_id');
		$query = $this->db->get_where('fg_task', array('type'=>$type,'type_id'=>$typeId));
		$tasks = $query->result_array();
		foreach ($tasks as $key => $task) {
			if($task['completed_date'] != null)
				$tasks[$key]['completed_date'] = date('d/m/Y H:i:s', strtotime($task['completed_date']));
			if($task['is_complete'] == 0)
				$tasks[$key]['status'] = 'Waiting for approve';
			else if($task['is_complete'] == 1)
				$tasks[$key]['status'] = 'Approved';
			else if($task['is_complete'] == -1)
				$tasks[$key]['status'] = 'Rejected';
		}
		return $tasks;
	}
	function completeTask($task){
		if($task['submit'] == 'Approve')
			$task['is_complete'] = 1;
		else if($task['submit'] == 'Reject')
			$task['is_complete'] = -1;
		else
			$task['is_complete'] = 0;
		$taskId = $task['task_id'];
		unset($task['submit']);
		unset($task['task_id']);
		
		$this->db->set('completed_date', 'DATE_ADD(NOW(), INTERVAL '.constant('GMT').' HOUR)', FALSE);
		$this->db->update('fg_task', $task, array('task_id'=>$taskId));
	}
	function sendMailAfterCompleteTask($taskId){
		$subject = "Fast Good - Your expense bill has ";
		
		$task = $this->getTaskDetailByTaskId($taskId);
		
		$to = $task['task_detail']['email'];
		
		if($task['is_complete'] == 1)
			$subject .= "approved by ".$task['first_name'];
		else if($task['is_complete'] == -1)
			$subject .= "rejected by ".$task['first_name'];
		
		$message = "บิล expense ของคุณ ";
		if($task['is_complete'] == 1)
			$message .= "ได้ถูกอนุมัติแล้ว โดย ".$task['first_name'];
		else if($task['is_complete'] == -1)
			$message .= "ไม่ถูกอนุมัติ โดย ".$task['first_name'];
		$message .= "<br><br>";
		
		$type = "";
		if($task['type'] == "fg_material")
			$type = "material";
		else if($task['type'] == "fg_raw_material")
			$type = "raw_material";
		else if($task['type'] == "fg_misc")
			$type = "misc";
			
		$message .= "http://www.fastgood-fg.com/index.php/expense/".$type."/showMaterial/".$task['type_id'];
		
		$this->sendMail($to, $subject, $message);
	}
}