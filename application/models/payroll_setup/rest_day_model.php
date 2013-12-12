<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rest_day_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function get_payroll_group(){
		return $this->db->query("
			SELECT * 
			FROM `payroll_group_setup`
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function add_rest_day($payroll_group_id,$rest_day){
		$this->db->query("
			INSERT INTO
			`rest_day` (
				`payroll_group_id`,
				`rest_day`,
				`company_id`
			)
			VALUES(
				'{$payroll_group_id}',
				'{$rest_day}',
				{$this->company_id}
			)
		");
	}
	
	public function get_rest_day($payroll_group_id){
		return $this->db->query("
			SELECT * 
			FROM `rest_day` 
			WHERE `payroll_group_id` ={$payroll_group_id}
		");
	}
	
	public function delete_rest_day($rest_day_id){
		$this->db->query("
			DELETE
			FROM `rest_day` 
			WHERE `rest_day_id` = {$rest_day_id}
		");
	}
		
}
/* End of file */