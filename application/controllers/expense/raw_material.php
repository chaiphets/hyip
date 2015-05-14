<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Raw_material extends CI_Controller{
	public function __construct(){
		parent::__construct();
		// $this->load->model('authentication/authen_model');
		$this->load->model('expense/raw_material_model');
	}
	private function __initMaterial(){
		$material['material_name'] = null;
		$material['material_unit'] = null;
		$material['material_unit_price'] = null;
		$material['material_quantity'] = null;
		$material['material_price'] = null;
		$material['purchased_date'] = null;
		$material['claim_rate'] = null;
		$material['is_claimed'] = 0;
		$material['memo'] = null;
		$user = $this->session->userdata('user');
		$material['owner_user_id'] = $user['user_id'];
		$material['first_name'] = $user['first_name'];
		return $material;
	}
	public function index(){
		$data['materials'] = $this->raw_material_model->getAllMaterial();
		$this->template->load('expense/raw_material/material_list', $data);
	}
	public function addMaterial(){
		$data['material'] = $this->__initMaterial();
		$this->template->load('expense/raw_material/material_detail', $data);
	}
	public function showMaterial($materialId=null){
		if($materialId == null){
			$this->index();
			return;
		}
		
		$material = $this->raw_material_model->getMaterial($materialId);
		$data['material'] = $material;
		$data['readonly'] = true;
		$this->template->load('expense/raw_material/material_detail', $data);
	}
	public function saveMaterial(){
		$this->form_validation->set_rules('material_name', 'Material Name', 'min_length[3]');
		$this->form_validation->set_rules('material_unit_price', 'Material Unit Price', 'decimal');
		$this->form_validation->set_rules('material_quantity', 'Material Quantity', 'decimal');
		$this->form_validation->set_rules('material_price', 'Material Price', 'decimal|greater_than[50]');
		$this->form_validation->set_rules('purchased_date', 'Purchased Date', 'exact_length[10]');
		
		//upload file
		// $config['upload_path'] = './img/tmp/';
		// $config['allowed_types'] = 'jpg|png';
		// $config['max_size']	= '500';
		// $config['overwrite'] = TRUE;
		// $this->load->library('upload', $config);
		
		$material = $this->input->post();
		
		$upload_error = '';
		// if($this->upload->do_upload('upload_file')){
			// $uploadFile = $this->upload->data();
			// if(!isset($material['files']))
				// $material['files'] = array();
			// array_push($material['files'], $uploadFile);
		// } else {
			// $upload_error = $this->upload->display_errors('<div class="row autoclose"><div class="col-xs-12 col-md-8 alert alert-danger alert-dismissible"><div class="spin"></div>&nbsp;&nbsp;', '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div></div>');
		// }
		
		if($material['submit'] == 'Upload'){
			$file_name = $material['upload_file_name'];
			
			if(strlen($file_name) > 0){
				if(!isset($material['files']))
					$material['files'] = array();
				
				$file_name = substr($file_name, strrpos($file_name, '\\')+1);
				foreach($material['files'] as $key => $file){
					if($file['file_name'] == $file_name){
						$this->template->load('expense/raw_material/material_detail', array('material'=>$material, 'upload_error'=>$upload_error));
						return;
					}
				}
				$uploadFile['file_name'] = $file_name;
				array_push($material['files'], $uploadFile);
				
				$data = $material['upload_file_data'];
				$data = substr($data, strpos($data, '/'));
				$data = base64_decode($data);
				if(file_exists('img/tmp/'.$file_name))
					unlink('img/tmp/'.$file_name);
				file_put_contents('img/tmp/'.$file_name, $data);
			}
			
			$this->template->load('expense/raw_material/material_detail', array('material'=>$material, 'upload_error'=>$upload_error));
			return;
		}
		
		if($material['submit'] == 'Delete'){
			$file_name = $material['delete_file'];
			if(file_exists('img/tmp/'.$file_name))
				unlink('img/tmp/'.$file_name);
			
			foreach ($material['files'] as $key => $file) {
				if($file['file_name'] == $file_name){
					unset($material['files'][$key]);
					break;
				}
			}
			
			$this->template->load('expense/raw_material/material_detail', array('material'=>$material, 'upload_error'=>$upload_error));
			return;
		}
		
		if($material['submit'] == 'Cancel'){
			if(isset($material['files'])){
				foreach ($material['files'] as $key => $file) {
					if(file_exists('img/tmp/'.$file['file_name']))
						unlink('img/tmp/'.$file['file_name']);
				}
			}
			redirect('expense/raw_material');
			return;
		}
		
		if ($this->form_validation->run() == FALSE){
			$this->template->load('expense/raw_material/material_detail', array('material'=>$material, 'upload_error'=>$upload_error));
			return;
		}
		
		unset($material['first_name']);
		unset($material['delete_file']);
		unset($material['upload_file_name']);
		unset($material['upload_file_data']);
		unset($material['submit']);
		
		$this->raw_material_model->createMaterial($material);
		
		$this->template->load('templates/success');
	}
}