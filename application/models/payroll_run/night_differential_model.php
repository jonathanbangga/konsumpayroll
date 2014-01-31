<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Night_differential_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function nigh_differential_employee_listing($payroll_group_id,$offset="",$limit=""){
		$str_limit = "";
		if($limit!=""){
			$str_limit = "LIMIT {$offset}, {$limit}"; 
		}
		return $this->db->query("
			SELECT *, eti.`date` AS ti_date
			FROM `employee_time_in` AS eti
			LEFT JOIN `employee` AS e ON eti.`emp_id` = e.`emp_id`
			LEFT JOIN `accounts` AS a ON e.`account_id` = a.`account_id`
			LEFT JOIN `employee_shifts_schedule` AS ess ON eti.`emp_id` = ess.`emp_id`
			LEFT JOIN `payroll_period` AS pp ON ess.`payroll_group_id` = pp.`payroll_group_id` 
			LEFT JOIN `holiday` AS h ON h.`date` = eti.`date`
			LEFT JOIN `hours_type` AS ht ON h.`hour_type_id` = ht.`hour_type_id`
			WHERE ess.`payroll_group_id` ={$payroll_group_id}
			AND eti.`comp_id` ={$this->company_id}
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