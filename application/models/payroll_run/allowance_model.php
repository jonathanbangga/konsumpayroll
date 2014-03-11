<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Allowance_model extends CI_Model {
	
	public function count_employees($company_id)
	{
		$where = array(
			'company_id' => $company_id,
			'status'	 => 'Active'
		);
		$this->db->where($where);
		
		return $this->db->count_all_results('employee');
	}
	
	public function get_allowances($company_id)
	{
		$where = array(
			'employee.company_id' => $company_id,
			'employee.status'	  => 'Active'
		);
		$this->db->where($where);
		$this->db->join('accounts','employee.account_id = accounts.account_id','left');
		$this->db->join('employee_fixed_allowances','employee.emp_id = employee_fixed_allowances.emp_id','left');
		$this->db->join('allowance_type','employee_fixed_allowances.allowance_type_id = allowance_type.allowance_type_id','left');
		
		$q = $this->db->get('employee');
		$result = $q->result();
		
		return ($result) ? $result : false;
	}
}