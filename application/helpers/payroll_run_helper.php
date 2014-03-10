<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	/**
	 * Carry Over for Absences
	 * @param unknown_type $emp_id
	 * @param unknown_type $field
	 */
	function carry_over_absences($emp_id, $field){
		$CI =& get_instance();
		
		$value = 0;
		
		$sql = $CI->db->query("
			SELECT *
			FROM `payroll_carry_over`
			WHERE emp_id = '{$emp_id}'
		");
		
		$row = $sql->row();
		if($sql->num_rows() > 0){
			return $row->$field;
		}
		
		return $value;
	}