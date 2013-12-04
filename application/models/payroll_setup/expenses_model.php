<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expenses_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function get_expense_type(){
		return $this->db->query("
			SELECT *
			FROM `expense_type`
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function add_expense_type($expense_type_name="",$minimum_amount="",$maximum_amount="",$require_receipt=""){
		$this->db->query("
			INSERT INTO
			`expense_type` (
				`expense_type_name`,
				`minimum_amount`,
				`maximum_amount`,
				`require_receipt`,
				`company_id`
			)
			VALUES (
				'{$expense_type_name}',
				'{$minimum_amount}',
				'{$maximum_amount}',
				'{$require_receipt}',
				'{$this->company_id}'
			)
		");
	}
	
	public function delete_expense_type($expense_type_id){
		$this->db->query("
			DELETE FROM
			`expense_type`
			WHERE `expense_type_id` = {$expense_type_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function update_expense_type($expense_type_id,$expense_type_name="",$minimum_amount="",$maximum_amount="",$req_receipt=""){
		$this->db->query("
			UPDATE `expense_type` 
			SET
				`expense_type_name` = '{$expense_type_name}',
				`minimum_amount` = '{$minimum_amount}',
				`maximum_amount` = '{$maximum_amount}',
				`require_receipt` = '{$req_receipt}'
			WHERE `expense_type_id` = {$expense_type_id}
			AND `company_id` = {$this->company_id}
		");
	}
		
}
/* End of file */