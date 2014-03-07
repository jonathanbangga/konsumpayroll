<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Earnings_commissions_model extends CI_Model {
	
	public function count_employees($company_id)
	{
		$where = array(
			'company_id' => $company_id,
			'status'	 => 'Active'
		);
		$this->db->where($where);
		
		return $this->db->count_all_results('employee');
	}

	
	public function get_employees_commissions($company_id,$page=0,$per_page=0)
	{
		$select = array(
			'accounts.account_id',
			'accounts.payroll_cloud_id',
			'employee.first_name',
			'employee.middle_name',
			'employee.last_name',
			'pc.sales_amount',
			'pc.earning_id',
			'pc.rate_per',
			'pc.tax_rate',
			'pc.commission_amount'
		);
		$where = array(
			'employee.company_id' => $company_id,
			'employee.status'	  => 'Active'
		);
		$this->db->select($select);
		$this->db->where($where);
		$this->db->join('accounts','accounts.account_id = employee.account_id','inner');
		$this->db->join('payroll_commission as pc','pc.account_id = employee.account_id','left');
		
		$q = $this->db->get('employee',$per_page,$page);
		$result = $q->result();
		
		return ($result) ? $result : false;
	}	
	
	public function get_earnings($company_id)
	{
		$where = array(
			'company_id' => $company_id,
			'status'	 => 'Active'
		);
		$this->db->where($where);
		$q = $this->db->get('earnings');
		$result = $q->result();
		
		return ($result) ? $result : false;
	}
	
	public function get_earning($earning_id,$company_id)
	{
		$where = array(
			'earning_id' => $earning_id,
			'company_id' => $company_id,
			'status'	 => 'Active'
		);
		$this->db->where($where);
		$q = $this->db->get('earnings');
		$result = $q->row();
		
		return ($result) ? $result : false;
	}
	
	public function get_payroll_commission($company_id,$account_id)
	{
		$where = array(
			'company_id' 	=> $company_id,
			'account_id'	=> $account_id
		);
		$this->db->where($where);
		$q = $this->db->get('payroll_commission');
		$result = $q->row();
		
		return ($result) ? $result : false;
	}
	
	public function add_payroll_commission($val)
	{
		$this->db->insert('payroll_commission',$val);
	}
	
	public function update_payroll_commission($where,$val)
	{
		$this->db->where($where);
		$this->db->update('payroll_commission',$val);
	}
	
	public function get_employees_other_earnings($company_id)
	{
		$select = array(
			'accounts.account_id',
			'accounts.payroll_cloud_id',
			'employee.first_name',
			'employee.middle_name',
			'employee.last_name',
			'poe.sales_amount',
			'poe.earning_id',
			'poe.rate_per',
			'poe.tax_rate',
			'poe.amount'
		);
		$where = array(
			'employee.company_id' => $company_id,
			'employee.status'	  => 'Active'
		);
		$this->db->select($select);
		$this->db->where($where);
		$this->db->join('accounts','accounts.account_id = employee.account_id','inner');
		$this->db->join('payroll_other_earnings as poe','poe.account_id = employee.account_id','left');
		
		$q = $this->db->get('employee');
		$result = $q->result();
		
		return ($result) ? $result : false;
	}
	
	public function get_payroll_other_earning($company_id,$account_id)
	{
		$where = array(
			'company_id' 	=> $company_id,
			'account_id'	=> $account_id
		);
		$this->db->where($where);
		$q = $this->db->get('payroll_other_earnings');
		$result = $q->row();
		
		return ($result) ? $result : false;
	}
	
	public function add_payroll_other_earning($val)
	{
		$this->db->insert('payroll_other_earnings',$val);
	}
	
	public function update_payroll_other_earning($where,$val)
	{
		$this->db->where($where);
		$this->db->update('payroll_other_earnings',$val);
	}
	
}
