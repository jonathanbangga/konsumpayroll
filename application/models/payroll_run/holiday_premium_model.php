<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Holiday_premium_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function get_holiday_premium_employee_listing($payroll_group_id,$offset="",$limit=""){
		$str_limit = "";
		if($limit!=""){
			$str_limit = "LIMIT {$offset}, {$limit}"; 
		}
		return $this->db->query("
			SELECT * , h.`date` AS hol_day, TIMESTAMPDIFF( HOUR , eti.`time_in` , eti.`time_out` ) AS tot_hours, TIMESTAMPDIFF( HOUR , DATE_FORMAT( h.`date` , '%Y-%m-%d 23:59:59' ) , eti.`time_out` ) AS counted_hol_hours
			FROM `employee_shifts_schedule` AS ess
			LEFT JOIN `employee_time_in` AS eti ON ess.`emp_id` = eti.`emp_id`
			LEFT JOIN `employee` AS e ON ess.`emp_id` = e.`emp_id`
			LEFT JOIN `accounts` AS a ON e.`account_id` = a.`account_id`
			LEFT JOIN `holiday` AS h ON h.`date` = eti.`date`
			LEFT JOIN `hours_type` AS ht ON h.`hour_type_id` = ht.`hour_type_id`
			LEFT JOIN `payroll_period` AS pp ON ess.`payroll_group_id` = pp.`payroll_group_id` 
			WHERE ess.`payroll_group_id` ={$payroll_group_id}
			AND ess.`company_id` ={$this->company_id}
			AND h.`date` = eti.`date` 
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