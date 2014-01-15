<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payroll_period_model extends CI_Model {

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
	
	public function get_payroll_calendar($payroll_group_id=""){
		return $this->db->query("
			SELECT *
			FROM `payroll_calendar`
			WHERE `payroll_group_id` = '{$payroll_group_id}'
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function get_payroll_range($payroll_calendar_id=""){
		return $this->db->query("
			SELECT *
			FROM `payroll_calendar`
			WHERE `payroll_calendar_id` = '{$payroll_calendar_id}'
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function add_payroll_period($payroll_group_id="",$payroll_period="",$period_from="",$period_to=""){
		$this->db->query("
			INSERT INTO 
			`payroll_period`(
				`payroll_group_id`,
				`payroll_period`,
				`period_from`,
				`period_to`,
				`company_id`
			)
			VALUES(
				'".mysql_real_escape_string($payroll_group_id)."',
				'".mysql_real_escape_string(date('Y-m-d',strtotime($payroll_period)))."',
				'".mysql_real_escape_string(date('Y-m-d',strtotime($period_from)))."',
				'".mysql_real_escape_string(date('Y-m-d',strtotime($period_to)))."',
				'".mysql_real_escape_string($this->company_id)."'
			)
		");
	}
	
	public function update_payroll_period($payroll_group_id="",$payroll_period="",$period_from="",$period_to=""){
		$this->db->query("
			UPDATE `payroll_period`
			SET
				`payroll_group_id` = '".mysql_real_escape_string($payroll_group_id)."',
				`payroll_period` = '".mysql_real_escape_string(date('Y-m-d',strtotime($payroll_period)))."',
				`period_from` = '".mysql_real_escape_string(date('Y-m-d',strtotime($period_from)))."',
				`period_to` = '".mysql_real_escape_string(date('Y-m-d',strtotime($period_to)))."'
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function get_payroll_calendar_period($payroll_calendar_id){
		return $this->db->query("
			SELECT `first_payroll_date`
			FROM `payroll_calendar`
			WHERE `payroll_calendar_id` = '{$payroll_calendar_id}'
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function get_payroll_period(){
		return $this->db->query("
			SELECT *
			FROM `payroll_period`
			WHERE `company_id` = {$this->company_id}
		");
	}
		
}
/* End of file */