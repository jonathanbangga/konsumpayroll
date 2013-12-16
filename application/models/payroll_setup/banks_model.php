<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banks_model extends CI_Model {

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
	
	public function assign_bank_account_to_payroll($payroll_group_id,$bank_name,$branch,$bank_account_no,$bank_account_type){
		$this->db->query("
			INSERT INTO
			`payroll_assigned_bank_accounts` (
				`payroll_group_id`,
				`bank_name`,
				`branch`,
				`bank_account_no`,
				`bank_account_type`,
				`company_id`
			)
			VALUES (
				'{$payroll_group_id}',
				'{$bank_name}',
				'{$branch}',
				'{$bank_account_no}',
				'{$bank_account_type}',
				'{$this->company_id}'
			)
		");
	}
	
	public function get_payroll_bank_accounts($payroll_group_id){
		return $this->db->query("
			SELECT * 
			FROM  `payroll_assigned_bank_accounts` 
			WHERE  `payroll_group_id` ={$payroll_group_id}
			AND  `company_id` ={$this->company_id}
		");
	}
	
	public function update_bank_account_to_payroll($payroll_assigned_bank_accounts_id,$bank_name,$branch,$bank_account_no,$bank_account_type){
		$this->db->query("
			UPDATE `payroll_assigned_bank_accounts`
			SET
				`bank_name` = '{$bank_name}',
				`branch`= '{$branch}',
				`bank_account_no` = '{$bank_account_no}',
				`bank_account_type` = '{$bank_account_type}'
			WHERE  `payroll_assigned_bank_accounts_id` ={$payroll_assigned_bank_accounts_id}
			AND  `company_id` ={$this->company_id}
		");
	}
		
}
/* End of file */