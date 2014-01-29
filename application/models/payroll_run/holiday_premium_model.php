<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Holiday_premium_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function get_holiday_premium_employee_listing($payroll_group_id){
		return $this->db->query("
			SELECT *
			FROM `holiday` AS h
			LEFT JOIN `hours_type` AS ht ON h.`hour_type_id` = ht.`hour_type_id`
			LEFT JOIN `payroll_period` AS pp ON h.`date`
			BETWEEN pp.`period_from`
			AND pp.`period_to`
			LEFT JOIN `employee_shifts_schedule` AS ess ON pp.`payroll_group_id` = ess.`payroll_group_id`
			LEFT JOIN `employee` AS e ON ess.`emp_id` = e.`emp_id`
			LEFT JOIN `accounts` AS a ON e.`account_id` = a.`account_id`
			WHERE ess.`payroll_group_id` ={$payroll_group_id}
			AND ess.`company_id` ={$this->company_id}
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