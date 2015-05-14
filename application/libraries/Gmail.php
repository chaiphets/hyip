<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gmail {
	var $ci;
	
	var $mail;
	
	public function __construct($params) {
		$this->ci =& get_instance();
		
		require_once('class.smtp.php');
		require_once('class.phpmailer.php');
		
		if($params == null)
			return;
		
		$this->initialize($params);
	}
	
	public function initialize($params){
		$mail = new PHPMailer(); // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true; // authentication enabled
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 465; // or 587
		$mail->IsHTML(true);
		$mail->CharSet = "utf-8";
		$mail->Username = $params['username'];
		$mail->Password = $params['password'];
		$mail->SetFrom($params['username']);
		
		$this->mail = $mail;
	}
	
	public function getErrorMessage(){
		return $this->mail->ErrorInfo;
	}
	
	public function send($mail){
		$this->mail->ClearAddresses();
		$this->mail->AddAddress($mail['to']);
		$this->mail->Subject = $mail['subject'];
		$this->mail->Body = $mail['message'];
		
		return $this->mail->Send();
	}
}