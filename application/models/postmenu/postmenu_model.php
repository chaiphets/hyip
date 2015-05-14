<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Postmenu_model extends CI_Model {
	function createPostMenu($menu){
		$this->db->order_by('posting_id', 'desc');
		$query = $this->db->get('fg_home_posting');
		$newId = 1;
		$last = $query->first_row('array');
		if($last)
			$newId = intval($last['posting_id']) + 1;
		
		$menu['posting_id'] = $newId;
		$menu['date'] = implode("-", array_reverse(explode("/", $menu['date'])));
		$this->db->set('posting_date', 'DATE_ADD(NOW(), INTERVAL '.constant('GMT').' HOUR)', FALSE);
		$this->db->insert('fg_home_posting', $menu);
	}
	function getAllPostMenus(){
		$this->db->order_by('posting_id', 'asc');
		$this->db->join('fg_user', 'fg_home_posting.owner_user_id = fg_user.user_id');
		$query = $this->db->get('fg_home_posting');
		$menus = $query->result_array();
		if($menus){
			foreach ($menus as $key => $menu) {
				$menus[$key]['date'] = date('d/m/Y', strtotime($menu['date']));
			}
		}
		return $menus;
	}
}