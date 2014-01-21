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
			`temp_employee_time_in`(
				`emp_id`,
				`date`,
				`time_in`,
				`lunch_out`,
				`lunch_in`,
				`time_out`,
				`total_hours`,
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
				'".mysql_real_escape_string($this->company_id)."'
			)
		");
	}
	
	public function get_employee_id($first_name="",$middle_name="",$last_name=""){
		return $this->db->query("
			SELECT  `emp_id` 
			FROM  `employee` 
			WHERE  `first_name` =  '".mysql_real_escape_string($first_name)."'
			AND  `middle_name` =  '".mysql_real_escape_string($middle_name)."'
			AND  `last_name` =  '".mysql_real_escape_string($last_name)."'
			AND  `company_id` ={$this->company_id}
		");
	}
	
	public function get_employee_timein_date($date){
		return $this->db->query("
			SELECT *
			FROM `temp_employee_time_in`
			WHERE `date` = '{$date}'
			AND `comp_id` ={$this->company_id}
		");
	}
	
	public function delete_timein($employee_time_in_id){
		$this->db->query("
			DELETE 
			FROM `temp_employee_time_in`
			WHERE `employee_time_in_id` = {$employee_time_in_id}
			AND `comp_id` ={$this->company_id}
		");
	}
		
}
/* End of file */