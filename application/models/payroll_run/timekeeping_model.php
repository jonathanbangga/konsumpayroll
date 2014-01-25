<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timekeeping_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function get_timekeeping($payroll_group_id,$offset="",$limit=""){
		$str_limit = "";
		if($limit!=""){
			$str_limit = "LIMIT {$offset}, {$limit}"; 
		}
		return $this->db->query("
			SELECT *
			FROM `employee_leaves_application` AS ela
			LEFT JOIN `employee` AS e ON ela.`emp_id` = e.`emp_id`
			LEFT JOIN `accounts` AS a ON e.`account_id` = a.`account_id`
			LEFT JOIN `employee_shifts_schedule` AS ess ON ess.`emp_id` = e.`emp_id`
			LEFT JOIN `payroll_period` AS pp ON ess.`payroll_group_id` = pp.`payroll_group_id`
			LEFT JOIN `leave_type` AS lt ON ela.`leave_type_id` = lt.`leave_type_id`
			WHERE ess.`payroll_group_id` ={$payroll_group_id}
			AND ela.`company_id` ={$this->company_id}
			{$str_limit}
		");
	}
	
	public function get_payroll_period(){
		return $this->db->query("
			SELECT *
			FROM `payroll_period`
			WHERE `company_id` ={$this->company_id}
		");
	}
	
}
/* End of file */