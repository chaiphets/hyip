<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->template->loadPublic('support');
	}
	
	public function submit()
	{
		$this->load->model('support_model');
		$this->support_model->createSupport($this->input->post());
		$this->template->loadPublic('support');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */