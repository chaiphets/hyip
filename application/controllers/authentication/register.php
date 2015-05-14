<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Register extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('authentication/register_model');
	}
	public function index(){
		$userKey = $this->input->get('userKey');
		if(!$userKey)
			show_error('Something weng wrong');
		$userKey = $this->register_model->getUserKey($userKey);
		if(!$userKey['flag'])
			show_error('Your user key is not available');
		$userKey['user_key'] = $this->input->get('userKey');
		$data['user'] = $userKey;
		$this->template->load('authentication/register', $data);
	}
	public function saveRegister(){
		$this->form_validation->set_rules('username', 'Username', 'min_length[6]');
		$this->form_validation->set_rules('password', 'Password', 'min_length[6]');
		$this->form_validation->set_rules('rePassword', 'Password', 'min_length[6]|matches[password]');
		$data['user'] = $this->input->post();
		
		if ($this->form_validation->run() == FALSE){
			$this->template->load('authentication/register', $data);
		} else {
			$this->register_model->createUser($data['user']);
			$this->template->load('templates/success');
		}
	}
	public function resetPassword(){
		$this->template->load('authentication/reset_password');
	}
	public function savePassword(){
		$this->form_validation->set_rules('reset_password_key', 'Reset Password Key');
		$this->form_validation->set_rules('password', 'Password', 'min_length[6]');
		$this->form_validation->set_rules('rePassword', 'Password', 'min_length[6]|matches[password]');
		
		if ($this->form_validation->run() == FALSE){
			$this->template->load('authentication/reset_password');
		} else {
			$post = $this->input->post();
			$this->register_model->resetPassword($post['reset_password_key'], $post['password']);
			$this->template->load('templates/success');
		}
	}
}