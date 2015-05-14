<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sendmail extends CI_Controller{
	public function test(){
		$this->load->model('task/task_model');
		$this->task_model->sendMailAfterCreateTask('chaiphetsa@gmail.com', 51);
		$this->task_model->sendMailAfterCreateTask('chaiphet_ra2@hotmail.com', 52);
		// $this->task_model->sendMailAfterCompleteTask(8);
		
		// $ch = curl_init();
		// curl_setopt($ch, CURLOPT_URL, "http://smartvc.vert2zest.com/index.php/webservice/sendgmail/send");
	    // curl_setopt($ch, CURLOPT_POST, 1);
	    // curl_setopt($ch, CURLOPT_POSTFIELDS, "username=fastgoood@gmail.com&password=thaimail&to=chaiphetsa@gmail.com&subject=Test Subject&message=ทดสอบส่งภาษาไทย");
	    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// echo curl_exec($ch);
		// curl_close($ch);
		
		// $params['username'] = 'fastgoood@gmail.com';
		// $params['password'] = 'thaimail';
		// $this->load->library('gmail', $params);
// 		
		// $mail['to'] = 'chaiphetsa@gmail.com';
		// $mail['subject'] = 'test';
		// $mail['message'] = 'test sending mail';
		// $this->gmail->send($mail);
// 		
		// echo $this->gmail->getErrorMessage();
	}
}