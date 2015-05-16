<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Authen_model extends CI_Model {
	function login($user){
		$user['password'] = crypt($user['password'], 'fastgood');
		$query = $this->db->get_where('user', $user);
		$user = $query->row_array();
		if($user){
			$this->db->set('last_login', 'DATE_ADD(NOW(), INTERVAL '.constant('GMT').' HOUR)', FALSE);
			//$this->db->where('user_id', $user['user_id']);
			// $lastLoginUser['last_login'] = date('Y-m-d H:i:s', now());
			$this->db->update('user', $lastLoginUser, array('user_id'=>$user['user_id'])); 
		}
		return $user;
	}
	function authorize($controllerName){
		$filter['controller_name'] = $controllerName;
		$query = $this->db->get_where('authorization', $filter);
		return $query->row_array();
	}
	function getUserById($userId){
		$user['user_id'] = $userId;
		$query = $this->db->get_where('user', $user);
		return $query->row_array();
	}
}