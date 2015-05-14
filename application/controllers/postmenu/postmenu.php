<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Postmenu extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('postmenu/postmenu_model');
	}
	private function __initPostMenu(){
		$postMenu['caption'] = null;
		$postMenu['date'] = date('d/m/Y', now());
		return $postMenu;
	}
	public function index(){
		$menu = $this->__initPostMenu();
		$data['menu'] = $menu;
		$this->template->load('postmenu/post_home_menu', $data);
	}
	public function savePostMenu(){
		$menu = $this->input->post();
		
		$file_name = $menu['upload_file_name'];
		$fileType = substr($file_name, strrpos($file_name, '.'));
		$user = $this->session->userdata('user');
		$file_name = $user['user_id'].'_'.now().$fileType;
		
		$data = $menu['upload_file_data'];
		$data = substr($data, strpos($data, '/'));
		$data = base64_decode($data);
		file_put_contents('img/home/'.$file_name, $data);
		
		$menu['upload_file_name'] = $file_name;
		$menu['owner_user_id'] = $user['user_id'];
		
		unset($menu['upload_file_data']);
		unset($menu['submit']);
		$this->postmenu_model->createPostMenu($menu);
		
		$this->template->load('templates/success');
	}
}