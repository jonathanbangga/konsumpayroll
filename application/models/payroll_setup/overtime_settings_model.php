<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Overtime_settings_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function get_overtime_type(){
		return $this->db->query("
			SELECT *
			FROM `overtime_type`
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function get_allowance_type(){
		return $this->db->query("
			SELECT *
			FROM `allowance_type`
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function add_overtime_type($overtime_type_name="",$pay_rate="",$ot_rate=""){
		$this->db->query("
			INSERT INTO
			`overtime_type` (
				`overtime_type_name`,
				`pay_rate`,
				`ot_rate`,
				`company_id`
			)
			VALUES (
				'".mysql_real_escape_string($overtime_type_name)."',
				'".mysql_real_escape_string($pay_rate)."',
				'".mysql_real_escape_string($ot_rate)."',
				'".mysql_real_escape_string($this->company_id)."'
			)
		");
	}
	
	public function add_allowance_type($allowance_type_name="",$taxable="",$maximum_non_taxable_amount="",$amount="",$minimum_ot_hours=""){
		$this->db->query("
			INSERT INTO
			`allowance_type` (
				`allowance_type_name`,
				`taxable`,
				`maximum_non_taxable_amount`,
				`amount`,
				`minimum_ot_hours`,
				`company_id`
			)
			VALUES (
				'".mysql_real_escape_string($allowance_type_name)."',
				'".mysql_real_escape_string($taxable)."',
				'".mysql_real_escape_string($maximum_non_taxable_amount)."',
				'".mysql_real_escape_string($amount)."',
				'".mysql_real_escape_string($minimum_ot_hours)."',
				'".mysql_real_escape_string($this->company_id)."'
			)
		");
	}
	
	public function get_leave_type(){
		return $this->db->query("
			SELECT *
			FROM `leave_type`
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function save_overtime_settings($automatic_recognition="",$overtime_as_leave_hours="",$leave_type_id="",$min_hours="",$increment=""){
		$this->db->query("
			INSERT INTO
			`overtime_settings` (
				`automatic_recognition`,
				`overtime_as_leave_hours`,
				`leave_type_id`,
				`min_hours`,
				`increment`,
				`company_id`
			)
			VALUES (
				'".mysql_real_escape_string($automatic_recognition)."',
				'".mysql_real_escape_string($overtime_as_leave_hours)."',
				'".mysql_real_escape_string($leave_type_id)."',
				'".mysql_real_escape_string($min_hours)."',
				'".mysql_real_escape_string($increment)."',
				'".mysql_real_escape_string($this->company_id)."'
			)
		");
	}
	
	public function get_overtime_settings(){
		return $this->db->query("
			SELECT *
			FROM `overtime_settings`
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function update_overtime_settings($overtime_settings_id,$automatic_recognition="",$overtime_as_leave_hours="",$leave_type_id="",$min_hours="",$increment=""){
		$this->db->query("
			UPDATE `overtime_settings`
			SET
				`automatic_recognition` = '".mysql_real_escape_string($automatic_recognition)."',
				`overtime_as_leave_hours` = '".mysql_real_escape_string($overtime_as_leave_hours)."',
				`leave_type_id` = '".mysql_real_escape_string($leave_type_id)."',
				`min_hours` = '".mysql_real_escape_string($min_hours)."',
				`increment` = '".mysql_real_escape_string($increment)."'
			WHERE `overtime_settings_id` = {$overtime_settings_id}
			AND `company_id` = {$this->company_id}
		");
	}
		
}
/* End of file */