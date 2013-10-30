<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*	Helper : company helpers for owner only
*	Author : Christopher Cuizon <christophercuizons@gmail.com>
*	Usage  : Usage for company/
*/
	
	/**
	*	This is to check if the company is for the right owner
	*	@param int $company_owner
	*	@param int $company_id
	*	@return boolean
	*/
	function mod_is_mycompany($company_owner,$company_id) 
	{
		$CI =& get_instance();
		if(is_numeric($company_owner) && is_numeric($company_id)) {
			$query = $CI->db->query("SELECT * FROM company where company_owner_id = '{$CI->db->escape_str($company_owner)}' AND company_id='{$CI->db->escape_str($company_id)}'");
			$row = $query->num_rows();
			$query->free_result();
			return $row;
		} else {
			return false;
		}
	}


