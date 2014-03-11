<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loan_deduction_model extends CI_Model {
	
	public function count_employees($company_id)
	{
		$where = array(
			'company_id' => $company_id,
			'status'	 => 'Active'
		);
		$this->db->where($where);
		
		return $this->db->count_all_results('employee');
	}
	
	public function get_loans($company_id)
	{
		$where = array(
			'employee_loans.company_id' => $company_id,
			'employee_loans.status'		=> 'Active'
		);
		$this->db->where($where);
		$this->db->join('employee','employee.emp_id = employee_loans.emp_id','inner');
		$this->db->join('accounts','accounts.account_id = employee.account_id','inner');
		$this->db->join('loan_type','loan_type.loan_type_id = employee_loans.loan_type_id','inner');
		
		$q = $this->db->get('employee_loans');
		$result = $q->result();
		
		return ($result) ? $result : false;
	}
}