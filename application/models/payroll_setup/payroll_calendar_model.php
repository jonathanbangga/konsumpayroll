<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payroll_calendar_model extends CI_Model {

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
			WHERE `company_id` = '{$this->company_id}'
		");
	}
	
	public function add_payroll_calendar($payroll_group_id,$semi_monthly="",$monthly="",$payroll_date="",$cut_off_from="",$cut_off_to="",$period="",$selected=0){
		$this->db->query("
			INSERT INTO
			`payroll_calendar` (
				`payroll_group_id`,
				`first_semi_monthly`,
				`second_monthly`,
				`first_payroll_date`,
				`cut_off_from`,
				`cut_off_to`,
				`period`,
				`selected`,
				`company_id`
			)
			VALUES (
				'".mysql_real_escape_string($payroll_group_id)."',
				'".mysql_real_escape_string($semi_monthly)."',
				'".mysql_real_escape_string($monthly)."',
				'".mysql_real_escape_string($payroll_date)."',
				'".mysql_real_escape_string($cut_off_from)."',
				'".mysql_real_escape_string($cut_off_to)."',
				'".mysql_real_escape_string($period)."',
				'".mysql_real_escape_string($selected)."',
				'".mysql_real_escape_string($this->company_id)."'
			)
		");
		return mysql_insert_id();
	}
	
	public function update_payroll_calendar($payroll_calendar_id,$semi_monthly="",$monthly="",$payroll_date="",$cut_off_from="",$cut_off_to="",$period=""){
		$this->db->query("
			UPDATE `payroll_calendar`
			SET
				`first_semi_monthly` = '".mysql_real_escape_string($semi_monthly)."',
				`second_monthly` = '".mysql_real_escape_string($monthly)."',
				`first_payroll_date` = '".mysql_real_escape_string($payroll_date)."',
				`cut_off_from` = '".mysql_real_escape_string($cut_off_from)."',
				`cut_off_to` = '".mysql_real_escape_string($cut_off_to)."',
				`period` = '".mysql_real_escape_string($period)."'
			WHERE `payroll_calendar_id` ={$payroll_calendar_id}
			AND `company_id` ={$this->company_id}
		");
	}
	
	public function get_distinct_year($payroll_group_id){
		return $this->db->query("
			SELECT DISTINCT YEAR(  `payroll_date` ) AS payroll_year
			FROM  `payroll_calendar` 
			WHERE  `payroll_group_id` ={$payroll_group_id}
			AND  `company_id` ={$this->company_id}
		");
	}
	
	
	// new
	public function get_next_payroll_list($payroll_calendar_id){
		return $this->db->query("
			SELECT *
			FROM `payroll_calendar`
			WHERE `payroll_calendar_id` = {$payroll_calendar_id}
		");
	}
	
	public function get_payroll_calendar($payroll_group_id){
		return $this->db->query("
			SELECT *
			FROM `payroll_calendar`
			WHERE `payroll_group_id` = {$payroll_group_id}
			AND `selected` = 1
			AND  `company_id` ={$this->company_id}
		");
	}
	
	public function get_payroll_calendar_list($payroll_group_id){
		return $this->db->query("
			SELECT *
			FROM `payroll_calendar`
			WHERE `payroll_group_id` ={$payroll_group_id}
			AND  `company_id` ={$this->company_id}
			ORDER BY `first_payroll_date` ASC 
		");
	}
	
	public function clear_payroll_calendar_list($payroll_group_id){
		$this->db->query("
			DELETE
			FROM `payroll_calendar`
			WHERE `payroll_group_id` ={$payroll_group_id}
			AND `selected` = 0
			AND  `company_id` ={$this->company_id}
		");
	}
	
}
/* End of file */