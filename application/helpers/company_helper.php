<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*	Helper : company helpers for owner only
*	Author : Christopher Cuizon <christophercuizons@gmail.com>
*	Usage  : Usage for company/
*/
	
	function company_checker(){
		$ci =& get_instance();
		$company_name = $ci->uri->segment(1);
		$query = $ci->db->query("SELECT * FROM company WHERE sub_domain = '{$this->db->escape_str($company_name)}'");
		$row = $query->row();
		$query->free_result();
		return $row;
	}