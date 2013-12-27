<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workday_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function get_payroll_group(){
		return $this->db->query("
			SELECT *
			FROM `payroll_group`
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function add_workdays($working_day,$work_start_time,$work_end_time,$working_hours,$payroll_group_id){
		$this->db->query("
			INSERT INTO
			`workday` (
				`working_day`,
				`work_start_time`,
				`work_end_time`,
				`working_hours`,
				`payroll_group_id`,
				`company_id`
			)
			VALUES (
				'".mysql_real_escape_string($working_day)."',
				'".mysql_real_escape_string($work_start_time)."',
				'".mysql_real_escape_string($work_end_time)."',
				'".mysql_real_escape_string($working_hours)."',
				'".mysql_real_escape_string($payroll_group_id)."',
				'".mysql_real_escape_string($this->company_id)."'
			)
		");
	}
	
	public function add_break_time($payroll_group_id,$workday,$start_time,$end_time,$break_time_number){
		$this->db->query("
			INSERT INTO
			`break_time` (
				`payroll_group_id`,
				`break_time_number`,
				`workday`,
				`start_time`,
				`end_time`,
				`company_id`
			)
			VALUES (
				'".mysql_real_escape_string($payroll_group_id)."',
				'".mysql_real_escape_string(($break_time_number+1))."',
				'".mysql_real_escape_string($workday)."',
				'".mysql_real_escape_string($start_time)."',
				'".mysql_real_escape_string($end_time)."',
				'".mysql_real_escape_string($this->company_id)."'
			)
		");
	}
	
	public function get_workdays($payroll_group_id,$working_day){
		return $this->db->query("
			SELECT * 
			FROM `workday` 
			WHERE `payroll_group_id` = {$payroll_group_id}
			AND `working_day` = '{$working_day}'
			AND `company_id` = {$this->company_id}
			
		");
	}
	
	public function check_if_pagroll_group_has_break($payroll_group_id){
		return $this->db->query("
			SELECT *
			FROM `break_time` 
			WHERE `payroll_group_id` = {$payroll_group_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function get_breaktime($payroll_group_id,$working_day,$break_time_id){
		return $this->db->query("
			SELECT *
			FROM `break_time`
			WHERE `payroll_group_id` = {$payroll_group_id}
			AND `workday` = '{$working_day}'
			AND `break_time_number` = {$break_time_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function get_number_of_breaks($payroll_group_id){
		return $this->db->query("
			SELECT * 
			FROM  `break_time` 
			WHERE  `payroll_group_id` ={$payroll_group_id}
			AND `company_id` = {$this->company_id}
			ORDER BY  `break_time_number` DESC 
			LIMIT 0 , 1
		");
	}
	
	public function get_workshift($payroll_group_id){
		return $this->db->query("
			SELECT *
			FROM `workshift`
			WHERE `payroll_group_id` = {$payroll_group_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function add_workshift($payroll_group_id="",$shift_name="",$start_time="",$end_time="",$working_hours="",$selected=""){
		$this->db->query("
			INSERT INTO 
			`workshift`(
				`payroll_group_id`,
				`shift_name`,
				`start_time`,
				`end_time`,
				`working_hours`,
				`selected`,
				`company_id`
			)
			VALUES (
				'".mysql_real_escape_string($payroll_group_id)."',
				'".mysql_real_escape_string($shift_name)."',
				'".mysql_real_escape_string($start_time)."',
				'".mysql_real_escape_string($end_time)."',
				'".mysql_real_escape_string($working_hours)."',
				'".mysql_real_escape_string($selected)."',
				'".mysql_real_escape_string($this->company_id)."'
			)
		");
	}
	
	public function set_workday_settings($payroll_group_id,$workday_type="",$num_breaks="",$working_days="",$duration_of_lunch="",$duration_of_short_breaks="",$flexible_workhours="",$latest_allowed_time_in=""){
		$this->db->query("
			INSERT INTO
			`workday_settings` (
				`payroll_group_id`,
				`workday_type`,
				`num_breaks`,
				`working_days`,
				`duration_of_lunch`,
				`duration_of_short_breaks`,
				`flexible_workhours`,
				`latest_allowed_time_in`,
				`company_id`
			)
			VALUES(
				'".mysql_real_escape_string($payroll_group_id)."',
				'".mysql_real_escape_string($workday_type)."',
				'".mysql_real_escape_string($num_breaks)."',
				'".mysql_real_escape_string($working_days)."',
				'".mysql_real_escape_string($duration_of_lunch)."',
				'".mysql_real_escape_string($duration_of_short_breaks)."',
				'".mysql_real_escape_string($flexible_workhours)."',
				'".mysql_real_escape_string($latest_allowed_time_in)."',
				'".mysql_real_escape_string($this->company_id)."'
			)
		");
	}
	
	public function get_workday_settings($payroll_group_id){
		return $this->db->query("
			SELECT *
			FROM `workday_settings` 
			WHERE `payroll_group_id` = {$payroll_group_id}
			AND `company_id` = {$this->company_id}
		");
	}
		
}
/* End of file */