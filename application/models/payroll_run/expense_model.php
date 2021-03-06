<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expense_model extends CI_Model {
	
	public function count_employees($company_id)
	{
		$where = array(
			'company_id' => $company_id,
			'status'	 => 'Active'
		);
		$this->db->where($where);
		
		return $this->db->count_all_results('employee');
	}
	
	public function get_payroll_expenses($company_id)
	{
		$where = array(
			'payroll_expense.company_id' => $company_id,
			'payroll_expense.status'	 => 'Active'
		);
		$this->db->where($where);
		$this->db->join('accounts','accounts.account_id = payroll_expense.account_id','left');
		$this->db->join('employee','employee.account_id = payroll_expense.account_id','left');
		$this->db->join('expense_type','expense_type.expense_type_id = payroll_expense.expense_type_id','left');
		$q = $this->db->get('payroll_expense');
		$result = $q->result();
		
		return ($result) ? $result : false;
	}
	
	public function get_employees($company_id)
	{
		$where = array(
			'employee.company_id' => $company_id,
			'employee.status' 	  => 'Active'
		);
		$this->db->where($where);
		$this->db->join('accounts','accounts.account_id = employee.account_id');
		$q = $this->db->get('employee');
		$result = $q->result();
		
		return ($result) ? $result : false;
	}
	
	public function get_employee($company_id,$account_id)
	{
		$where = array(
			'accounts.account_id' => $account_id,
			'employee.company_id' => $company_id,
			'employee.status'	  => 'Active'
		);
		$this->db->where($where);
		$this->db->join('accounts','accounts.account_id = employee.account_id');
		$q = $this->db->get('employee');
		$result = $q->row();
		
		return ($result) ? $result : false;
	}
	
	public function get_expenses_type($company_id)
	{
		$where = array(
			'company_id' => $company_id,
			'status'	 => 'Active'
		);
		$this->db->where($where);
		$q = $this->db->get('expense_type');
		$result = $q->result();
		
		return ($result) ? $result : false;
	}
	
	public function get_expense_type($company_id,$expense_type_id)
	{
		$where = array(
			'expense_type_id' => $expense_type_id,
			'company_id' 	  => $company_id,
			'status'	 	  => 'Active'
		);
		$this->db->where($where);
		$q = $this->db->get('expense_type');
		$result = $q->row();
		
		return ($result) ? $result : false;
	}
	
	public function add_expense($val)
	{
		$this->db->insert('payroll_expense',$val);
	}
	
}