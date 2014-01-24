<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timesheets_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function add_temp_employee_time_in($emp_id="",$date="",$time_in="",$lunch_out="",$lunch_in="",$time_out="",$total_hours=""){
		$this->db->query("
			INSERT INTO 
			`employee_time_in`(
				`emp_id`,
				`date`,
				`time_in`,
				`lunch_out`,
				`lunch_in`,
				`time_out`,
				`total_hours`,
				`source`,
				`comp_id`
			)
			VALUES(
				'".mysql_real_escape_string($emp_id)."',
				'".mysql_real_escape_string($date)."',
				'".mysql_real_escape_string($time_in)."',
				'".mysql_real_escape_string($lunch_out)."',
				'".mysql_real_escape_string($lunch_in)."',
				'".mysql_real_escape_string($time_out)."',
				'".mysql_real_escape_string($total_hours)."',
				'import',
				'".mysql_real_escape_string($this->company_id)."'
			)
		");
	}
	
	public function get_employee_id($payroll_group_id,$first_name="",$middle_name="",$last_name=""){
		return $this->db->query("
			SELECT e.`emp_id`
			FROM `employee_shifts_schedule` AS ess
			LEFT JOIN `employee` AS e ON ess.`emp_id` = e.`emp_id` 
			WHERE  `first_name` =  '".mysql_real_escape_string($first_name)."'
			AND  `middle_name` =  '".mysql_real_escape_string($middle_name)."'
			AND  `last_name` =  '".mysql_real_escape_string($last_name)."'
			AND ess.`payroll_group_id` = {$payroll_group_id}
			AND  ess.`company_id` ={$this->company_id}
		");
	}
	
	public function get_employee_timein_date($payroll_group_id,$date,$emp_id){
		return $this->db->query("
			SELECT *
			FROM `employee_time_in` AS eti
			LEFT JOIN `employee_shifts_schedule` AS ess ON eti.`emp_id` = ess.`emp_id`
			LEFT JOIN `employee` AS e ON eti.`emp_id` = e.`emp_id`
			WHERE eti.`date` = '{$date}'
			AND ess.`payroll_group_id` = {$payroll_group_id}
			AND ess.`emp_id` = {$emp_id}
			AND eti.`source` = 'import'
			AND eti.`comp_id` ={$this->company_id}
		");
	}
	
	public function delete_timein($employee_time_in_id){
		$this->db->query("
			DELETE 
			FROM `employee_time_in`
			WHERE `employee_time_in_id` = {$employee_time_in_id}
			AND `comp_id` ={$this->company_id}
		");
	}
	
	public function get_employee_time_ins($payroll_group_id,$source=0,$offset="",$limit=""){
		$str_limit = "";
		$str_source = "";
		// source
		// import
		if($source==1){
			$str_source = "AND eti.`source`='import'";
		// system
		}else if($source==2){
			$str_source = "AND eti.`source`='system'";
		}
		if($limit!=""){
			$str_limit = "LIMIT {$offset}, {$limit}"; 
		}
		
		return $this->db->query("
			SELECT *
			FROM `employee_time_in` AS eti
			LEFT JOIN `employee_shifts_schedule` AS ess ON eti.emp_id = ess.emp_id
			LEFT JOIN `employee` AS e ON eti.emp_id = e.emp_id
			LEFT JOIN `accounts` AS a ON e.account_id = a.account_id
			WHERE eti.`comp_id` ={$this->company_id}
			AND ess.`payroll_group_id` = {$payroll_group_id}
			{$str_source}
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
	
	public function get_distinct_employee($payroll_group_id,$source){
		// source
		// import
		$str_source = "";
		if($source==1){
			$str_source = "AND eti.`source`='import'";
		// system
		}else if($source==2){
			$str_source = "AND eti.`source`='system'";
		}
		return $this->db->query("
			SELECT DISTINCT eti.`emp_id`, a.`payroll_cloud_id` , e.`first_name` , e.`last_name`
			FROM `employee_time_in` AS eti
			LEFT JOIN `employee` AS e ON eti.`emp_id` = e.`emp_id`
			LEFT JOIN `accounts` AS a ON e.`account_id` = a.`account_id`
			LEFT JOIN `employee_shifts_schedule` AS ess ON eti.`emp_id` = ess.`emp_id`
			WHERE ess.`payroll_group_id` = {$payroll_group_id}
			{$str_source}
			AND eti.`comp_id` ={$this->company_id}
		");
	}
	
	public function get_hours_worked($emp_id,$date,$source){
		// source
		// import
		$str_source = "";
		if($source==1){
			$str_source = "AND `source`='import'";
		// system
		}else if($source==2){
			$str_source = "AND `source`='system'";
		}
		return $this->db->query("
			SELECT *
			FROM `employee_time_in`
			WHERE `emp_id` ={$emp_id}
			AND `date` = '{$date}'
			{$str_source}
			AND `comp_id` ={$this->company_id}
		");
	}
	
	public function save_selected_timesheets($timesheets="",$payroll_group_id=""){
		$timesheets2 = "";
		if($timesheets==1){
			$timesheets2 = "import";
		// system
		}else if($timesheets==2){
			$timesheets2 = "time-in";
		}
		$this->db->query("
			INSERT INTO
			`selected_timesheets`(
				`timesheets`,
				`payroll_group_id`,
				`company_id`
			)
			VALUES(
				'".mysql_real_escape_string($timesheets2)."',
				'".mysql_real_escape_string($payroll_group_id)."',
				{$this->company_id}
			)
		");
	}
	
	public function delete_selected_timesheets(){
		$this->db->query("
			DELETE
			FROM `selected_timesheets`
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function delete_time_ins($emp_id,$source){
		// source
		// import
		$str_source = "";
		if($source==1){
			$str_source = "AND `source`='import'";
		// system
		}else if($source==2){
			$str_source = "AND `source`='system'";
		}
		$this->db->query("
			DELETE 
			FROM `employee_time_in`
			WHERE `emp_id` = {$emp_id}
			{$str_source}
			AND `comp_id` ={$this->company_id}
		");
	}
	
}
/* End of file */