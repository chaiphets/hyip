<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Authen extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('authentication/authen_model');
	}
	public function index(){
		if($this->session->userdata('userId'))
			redirect('');
		$this->template->load('authentication/login');
	}
	public function login(){
		if($this->session->userdata('user'))
			redirect('');
		
		$user = $this->input->post();
		$this->form_validation->set_rules('username', 'Username', 'min_length[6]');
		$this->form_validation->set_rules('password', 'Password', 'min_length[6]');
		$this->form_validation->set_rules('url', 'URL');
		if ($this->form_validation->run() == FALSE){
			$this->template->load('authentication/login');
			return;
		}
		
		$url = $user['url'];
		unset($user['url']);
		$user = $this->authen_model->login($user);
		if(!$user){
			$data['login_error'] = "Username or password is invalid";
			$this->template->load('authentication/login', $data);
		} else {
			$this->session->set_userdata('user', $user);
			redirect($url);
		}
	}
	public function logout(){
		$this->session->unset_userdata('user');
		redirect('');
	}
}