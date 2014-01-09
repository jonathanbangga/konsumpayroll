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
	
	public function add_uniform_working_day($working_day,$work_start_time,$work_end_time,$working_hours,$payroll_group_id){
		$this->db->query("
			INSERT INTO
			`uniform_working_day` (
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
	
	public function update_uniform_working_day($working_day,$work_start_time,$work_end_time,$working_hours,$workday_id){
		$this->db->query("
			UPDATE `uniform_working_day` 
			SET	`working_day` = '".mysql_real_escape_string($working_day)."',
				`work_start_time` = '".mysql_real_escape_string($work_start_time)."',
				`work_end_time` = '".mysql_real_escape_string($work_end_time)."',
				`working_hours` = '".mysql_real_escape_string($working_hours)."'
			WHERE `workday_id` = {$workday_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function delete_uniform_working_day($workday_id){
		$this->db->query("
			DELETE 
			FROM `uniform_working_day`
			WHERE `workday_id` = {$workday_id}
		");
	}
	
	public function add_break_time($payroll_group_id,$workday="",$start_time="",$end_time="",$break_time_number="",$worktype="",$workshift_id=""){
		$this->db->query("
			INSERT INTO
			`break_time` (
				`payroll_group_id`,
				`break_time_number`,
				`workday`,
				`start_time`,
				`end_time`,
				`worktype`,
				`workshift_id`,
				`company_id`
			)
			VALUES (
				'".mysql_real_escape_string($payroll_group_id)."',
				'".mysql_real_escape_string(($break_time_number+1))."',
				'".mysql_real_escape_string($workday)."',
				'".mysql_real_escape_string($start_time)."',
				'".mysql_real_escape_string($end_time)."',
				'".mysql_real_escape_string($worktype)."',
				'".mysql_real_escape_string($workshift_id)."',
				'".mysql_real_escape_string($this->company_id)."'
			)
		");
	}
	
	public function update_break_time($break_time_id="",$start_time="",$end_time=""){
		$this->db->query("
			UPDATE `break_time`
			SET
				`start_time` = '".mysql_real_escape_string($start_time)."',
				`end_time` = '".mysql_real_escape_string($end_time)."'
			WHERE `break_time_id` = '".mysql_real_escape_string($break_time_id)."'
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function delete_breaktime($break_time_id){
		$this->db->query("
			DELETE 
			FROM `break_time`
			WHERE `break_time_id` = {$break_time_id}
		");
	}
	
	public function get_uniform_working_day($payroll_group_id,$working_day){
		return $this->db->query("
			SELECT * 
			FROM `uniform_working_day` 
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
			AND `worktype` = 'Uniform Working Days'
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
		return mysql_insert_id();
	}
	
	public function update_workshift($workshift_id="",$shift_name="",$start_time="",$end_time="",$working_hours="",$selected=""){
		$this->db->query("
			UPDATE `workshift`
			SET
				`shift_name` = '".mysql_real_escape_string($shift_name)."',
				`start_time` = '".mysql_real_escape_string($start_time)."',
				`end_time` = '".mysql_real_escape_string($end_time)."',
				`working_hours` = '".mysql_real_escape_string($working_hours)."',
				`selected` = '".mysql_real_escape_string($selected)."'
			WHERE `workshift_id` = {$workshift_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function set_workday_settings($payroll_group_id,$workday_type="",$num_breaks="",$working_days_per_year="",$duration_of_lunch_per_year="",$duration_of_short_breaks_per_year="",$flexible_workhours="",$latest_allowed_time_in=""){
		$this->db->query("
			INSERT INTO
			`workday_settings` (
				`payroll_group_id`,
				`workday_type`,
				`num_breaks`,
				`working_days_per_year`,
				`duration_of_lunch_per_year`,
				`duration_of_short_breaks_per_year`,
				`flexible_workhours`,
				`latest_allowed_time_in`,
				`company_id`
			)
			VALUES(
				'".mysql_real_escape_string($payroll_group_id)."',
				'".mysql_real_escape_string($workday_type)."',
				'".mysql_real_escape_string($num_breaks)."',
				'".mysql_real_escape_string($working_days_per_year)."',
				'".mysql_real_escape_string($duration_of_lunch_per_year)."',
				'".mysql_real_escape_string($duration_of_short_breaks_per_year)."',
				'".mysql_real_escape_string($flexible_workhours)."',
				'".mysql_real_escape_string($latest_allowed_time_in)."',
				'".mysql_real_escape_string($this->company_id)."'
			)
		");
	}
	
	public function update_workday_settings($workday_settings_id,$workday_type="",$num_breaks="",$working_days_per_year="",$duration_of_lunch_per_year="",$duration_of_short_breaks_per_year="",$flexible_workhours="",$latest_allowed_time_in=""){
		$this->db->query("
			UPDATE `workday_settings`
			SET
				`workday_type` = '".mysql_real_escape_string($workday_type)."',
				`num_breaks` = '".mysql_real_escape_string($num_breaks)."',
				`working_days_per_year` = '".mysql_real_escape_string($working_days_per_year)."',
				`duration_of_lunch_per_year` = '".mysql_real_escape_string($duration_of_lunch_per_year)."',
				`duration_of_short_breaks_per_year` = '".mysql_real_escape_string($duration_of_short_breaks_per_year)."',
				`flexible_workhours` = '".mysql_real_escape_string($flexible_workhours)."',
				`latest_allowed_time_in` = '".mysql_real_escape_string($latest_allowed_time_in)."'
			WHERE `workday_settings_id` = {$workday_settings_id}
			AND `company_id` = {$this->company_id}
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
	
	public function check_if_working_day_already_set($payroll_group_id,$working_day){
		return $this->db->query("
			SELECT *
			FROM `workday_settings`
			WHERE `payroll_group_id` = {$payroll_group_id}
			AND `working_day` = '{$working_day}'
			AND `company_id` = {$this->company_id}
		");
	}
	
	// revised
	public function add_workday($workday_type,$payroll_group_id){
		$this->db->query("
			INSERT INTO
			`workday` (
				`workday_type`,
				`payroll_group_id`,
				`company_id`
			)
			VALUES (
				'".mysql_real_escape_string($workday_type)."',
				'".mysql_real_escape_string($payroll_group_id)."',
				'".mysql_real_escape_string($this->company_id)."'
			)
		");
	}
	
	public function set_uniform_working_day_settings($number_of_breaks_per_day,$total_working_days_per_year,$allow_flexible_workhours,$latest_time_in_allowed,$payroll_group_id){
		$this->db->query("
			INSERT INTO
			`uniform_working_day_settings` (
				`number_of_breaks_per_day`,
				`total_working_days_per_year`,
				`allow_flexible_workhours`,
				`latest_time_in_allowed`,
				`payroll_group_id`,
				`company_id`
				
			)
			VALUES (
				'".mysql_real_escape_string($number_of_breaks_per_day)."',
				'".mysql_real_escape_string($total_working_days_per_year)."',
				'".mysql_real_escape_string($allow_flexible_workhours)."',
				'".mysql_real_escape_string($latest_time_in_allowed)."',
				'".mysql_real_escape_string($payroll_group_id)."',
				'".mysql_real_escape_string($this->company_id)."'
			)
		");
	}
	
	
	public function add_flexible_hours($total_hours_for_the_week,$total_days_per_year,$latest_time_in_allowed,$number_of_breaks_per_day,$duration_of_lunch_break_per_day,$duration_of_short_break_per_day,$payroll_group_id){
		$this->db->query("
			INSERT INTO
			`flexible_hours` (
				`total_hours_for_the_week`,
				`total_days_per_year`,
				`latest_time_in_allowed`,
				`number_of_breaks_per_day`,
				`duration_of_lunch_break_per_day`,
				`duration_of_short_break_per_day`,
				`payroll_group_id`,
				`company_id`
			)
			VALUES (
				'".mysql_real_escape_string($total_hours_for_the_week)."',
				'".mysql_real_escape_string($total_days_per_year)."',
				'".mysql_real_escape_string($latest_time_in_allowed)."',
				'".mysql_real_escape_string($number_of_breaks_per_day)."',
				'".mysql_real_escape_string($duration_of_lunch_break_per_day)."',
				'".mysql_real_escape_string($duration_of_short_break_per_day)."',
				'".mysql_real_escape_string($payroll_group_id)."',
				'".mysql_real_escape_string($this->company_id)."'
			)
		");
	}
	
	public function set_workshift_settings($number_of_breaks_per_shift,$total_working_days_per_year,$grace_period_for_every_shift,$payroll_group_id){
		$this->db->query("
			INSERT INTO
			`workshift_settings` (
				`number_of_breaks_per_shift`,
				`total_working_days_per_year`,
				`grace_period_for_every_shift`,
				`payroll_group_id`,
				`company_id`
			)
			VALUES (
				'".mysql_real_escape_string($number_of_breaks_per_shift)."',
				'".mysql_real_escape_string($total_working_days_per_year)."',
				'".mysql_real_escape_string($grace_period_for_every_shift)."',
				'".mysql_real_escape_string($payroll_group_id)."',
				'".mysql_real_escape_string($this->company_id)."'
			)
		");
	}
	
	public function get_workday($payroll_group_id){
		return $this->db->query("
			SELECT *
			FROM `workday`
			WHERE `payroll_group_id` ={$payroll_group_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function get_uniform_working_day_settings($payroll_group_id){
		return $this->db->query("
			SELECT *
			FROM `uniform_working_day_settings`
			WHERE `payroll_group_id` ={$payroll_group_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function get_flexible_hours($payroll_group_id){
		return $this->db->query("
			SELECT *
			FROM `flexible_hours`
			WHERE `payroll_group_id` ={$payroll_group_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function get_ws_breaktime($payroll_group_id,$workshift_id,$break_time_id){
		return $this->db->query("
			SELECT *
			FROM `break_time`
			WHERE `payroll_group_id` = {$payroll_group_id}
			AND `worktype` = 'Workshift'
			AND `workshift_id` = {$workshift_id}
			AND `break_time_number` = {$break_time_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function get_workshift_settings($payroll_group_id){
		return $this->db->query("
			SELECT *
			FROM `workshift_settings`
			WHERE `payroll_group_id` = {$payroll_group_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function clear_all_db_in_workday(){
		$this->db->query("
			DELETE 
			FROM `workday`
			WHERE `company_id` = {$this->company_id}
		");
		$this->db->query("
			DELETE 
			FROM `uniform_working_day`
			WHERE `company_id` = {$this->company_id}
		");
		$this->db->query("
			DELETE 
			FROM `uniform_working_day_settings`
			WHERE `company_id` = {$this->company_id}
		");
		$this->db->query("
			DELETE 
			FROM `workshift`
			WHERE `company_id` = {$this->company_id}
		");
		$this->db->query("
			DELETE 
			FROM `workshift_settings`
			WHERE `company_id` = {$this->company_id}
		");
		$this->db->query("
			DELETE 
			FROM `break_time`
			WHERE `company_id` = {$this->company_id}
		");
		$this->db->query("
			DELETE 
			FROM `flexible_hours`
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function delete_workshift($workshift_id){
		$this->db->query("
			DELETE 
			FROM `workshift`
			WHERE `workshift_id` = {$workshift_id}
			AND `company_id` = {$this->company_id}
		");
	}
		
}
/* End of file */