<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loans_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function get_loans(){
		return $this->db->query("
			SELECT *
			FROM `loan_type`
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function add_loans($loan_type_name){
		$this->db->query("
			INSERT INTO 
			`loan_type` (
				`loan_type_name`,
				`company_id`
			)
			VALUES (
				'{$loan_type_name}',
				'{$this->company_id}'
			)
		");
	}
	
	public function delete_loans($loan_type_id){
		$loan_type_id2 = implode(",",$loan_type_id);
		$this->db->query("
			DELETE
			FROM `loan_type`
			WHERE `loan_type_id` IN({$loan_type_id2})
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function update_loans($loan_type_id,$loan_type_name){
		$this->db->query("
			UPDATE `loan_type`
			SET `loan_type_name` = '{$loan_type_name}'
			WHERE `loan_type_id` = {$loan_type_id}
			AND `company_id` = {$this->company_id}
		");
	}
		
}
/* End of file */