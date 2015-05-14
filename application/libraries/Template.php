<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Template {
	var $ci;

	public function __construct() {
		$this->ci =& get_instance();
	}
	
	public function load($viewName, $data = null){
		$header['user'] = $this->ci->session->userdata('user');
		
		$this->ci->load->model('task/task_model');
		$header['tasks'] = $this->ci->task_model->getTasksByUserId($header['user']['user_id']);
		
		$this->ci->load->view('templates/header', $header);
		$this->ci->load->view($viewName, $data);
		$this->ci->load->view('templates/footer');
	}
}