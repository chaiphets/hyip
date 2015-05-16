<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Template {
	var $ci;

	public function __construct() {
		$this->ci =& get_instance();
	}
	
	public function load($viewName, $data = null){
		$header['user'] = $this->ci->session->userdata('user');
		
		$this->ci->load->view('templates/header', $header);
		$this->ci->load->view($viewName, $data);
		$this->ci->load->view('templates/footer');
	}
	
	public function loadPublic($viewName, $data = null){
		$header['user'] = $this->ci->session->userdata('user');
		
		$this->ci->load->view('templates/header', $header);
		$this->ci->load->view('templates/public_template_header');
		$this->ci->load->view($viewName, $data);
		$this->ci->load->view('templates/public_template_footer');
		$this->ci->load->view('templates/footer');
	}
}