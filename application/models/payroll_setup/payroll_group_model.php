<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payroll_group_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function get_payroll_group_setup(){
		return $this->db->query("
			SELECT *
			FROM `payroll_group_setup`
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function add_payroll_group_setup($name,$period_type="",$pay_rate_type=""){
		$this->db->query("
			INSERT INTO 
			`payroll_group_setup` (
				`name`,
				`period_type`,
				`pay_rate_type`,
				`company_id`
			)
			VALUES (
				'".mysql_real_escape_string($name)."',
				'".mysql_real_escape_string($period_type)."',
				'".mysql_real_escape_string($pay_rate_type)."',
				{$this->company_id}
			)
		");
	}
	
	public function delete_payroll_group_setup($payroll_group_setup_id){
		$this->db->query("
			DELETE 
			FROM `payroll_group_setup`
			WHERE `payroll_group_setup_id` = {$payroll_group_setup_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function update_payroll_group_setup($payroll_group_setup_id,$name,$period_type="",$pay_rate_type=""){
		$this->db->query("
			UPDATE `payroll_group_setup` 
			SET	`name` = '".mysql_real_escape_string($name)."',
				`period_type` = '".mysql_real_escape_string($period_type)."',
				`pay_rate_type` = '".mysql_real_escape_string($pay_rate_type)."'
			WHERE `payroll_group_setup_id` = {$payroll_group_setup_id}
			AND `company_id` = {$this->company_id}
		");
	}
		
}
/* End of file */