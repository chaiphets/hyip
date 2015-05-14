<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Register_model extends CI_Model {
	function getUserKey($userKey){
		$filter['user_key'] = $userKey;
		$query = $this->db->get_where('fg_user_key', $filter);
		return $query->row_array();
	}
	function createUser($user){
		$query = $this->db->get('fg_user');
		$newId = 1;
		$last = $query->last_row('array');
		if($last)
			$newId = intval($last['user_id']) + 1;
		
		$userKey['flag'] = 0;
		$this->db->where('user_key', $user['user_key']);
		$this->db->update('fg_user_key', $userKey);
		
		$user['user_id'] = $newId;
		unset($user['rePassword']);
		unset($user['user_key']);
		$user['flag'] = 1;
		$user['password'] = crypt($user['password'], 'fastgood');
		$this->db->set('activate_time', 'DATE_ADD(NOW(), INTERVAL '.constant('GMT').' HOUR)', FALSE);
		$this->db->insert('fg_user', $user);
	}
	function resetPassword($resetPasswordKey, $newPassword){
		$this->db->where('password', $resetPasswordKey);
		$this->db->update('fg_user', array('password'=>crypt($newPassword, 'fastgood')));
	}
}