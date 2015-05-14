<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Authorization {
	var $ci;

	public function __construct() {
		$this->ci =& get_instance();
	}
	
	public function authorize(){
		// var_dump($this->ci->router->class);
		$this->ci->load->model('authentication/authen_model');
		$authorize = $this->ci->authen_model->authorize($this->ci->router->class);
		if($authorize && !$this->ci->session->userdata('user'))
			show_error('You have no authorize to access this page, please <a href="'.site_url('authentication/authen/login?url='.current_url()).'">sign in</a> or go to <a href="'.site_url().'">home</a>');
	}
}