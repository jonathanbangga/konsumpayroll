<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * Comapny SEtup
 *
 * @subpackage Company_setup_model
 * @category model
 * @version 1.0
 * @copyright Copyright (c) 2013, Konsum Technologies Inc.
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */

class Company_setup_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * DISPLAYS ALL USERS
	 * Enter description here ...
	 */
	public function display_owners(){ 
		$query 	= $this->db->get_where("company_owner");
		$row	= $query->result();
		$query->free_result();
		return $row;
	}
	
	public function display_owners_details($account_id){
		if(is_numeric($account_id)){
			$sql = "SELECT * FROM company_owner co
					LEFT JOIN accounts a on a.account_id = co.account_id
					WHERE a.user_type_id = 2 AND a.account_id = {$account_id}";
			 
			$q = $this->db->query($sql);
			$row = $q->row();
			return $row;
		}
	}
	
	public function owners_no_psa(){
		$query = $this->db->query(
					"SELECT * FROM company_owner co
					LEFT JOIN accounts a on a.account_id = co.account_id
					WHERE a.user_type_id = 2 AND a.payroll_system_account_id = 0 AND
					a.deleted = '0'"
		);
		$result = $query->result();
		$query->free_result();
		return $result;
	}
	
	/**
	 * CHECK AVAILABLE OWNERS NO PSA INCLUDE
	 * Enter description here ...
	 * @param int $account_id
	 */
	public function owners_no_psa_include($account_id){
		$query = $this->db->query(
					"SELECT a.account_id,co.owner_name,a.payroll_system_account_id FROM company_owner co
					LEFT JOIN accounts a on a.account_id = co.account_id
					WHERE a.account_id = '{$this->db->escape_str($account_id)}' OR a.user_type_id = 2 AND a.payroll_system_account_id = 0 AND
					a.deleted = '0'"
		);
		$result = $query->result();
		$query->free_result();
		return $result;
	}
	
	
	public function display_owners_options(){
		$owners = $this->owners_no_psa();
		$option = "";
		if($owners){
			foreach($owners as $key=>$val):
				$option .="<option value='{$val->account_id}'>{$val->owner_name}</option>";
			endforeach;
		}
		return $option;
	}
	
	/**
	 * 
	 * Saves the fields global style
	 * @param string $database
	 * @param array $fields
	 * @return int
	 */
	public function save_fields($database,$fields){
		$this->db->insert($database,$fields);
		return $this->db->insert_id();
	}
	
	/**
	 * 
	 * Updates the fields global style
	 * @param string $database
	 * @param array $fields
	 * @param int $company_id
	 * @return int
	 */
	public function update_fields($database,$fields,$company_id) {
		$this->db->where("company_id",$this->db->escape_str($company_id));
		$this->db->update($database,$fields);
		return $this->db->insert_id();
	}
	
	/**
	 * 
	 * Get company_info
	 * @param int $comp_id
	 * @return object
	 */
	public function company_info($comp_id){
		$query = $this->db->query(
			"SELECT * FROM `accounts` a
			LEFT JOIN company_owner co on a.account_id = co.account_id
			LEFT JOIN payroll_system_account psa on psa.payroll_system_account_id = a.payroll_system_account_id
			WHERE a.user_type_id = 2 AND psa.payroll_system_account_id = {$this->db->escape_str($comp_id)}"
		);
		$rows = $query->row();
		$query->free_result();	
		return $rows;
	}
	
	/**
	 * 
	 * Fetch company
	 * @param int $limit
	 * @param int $offset
	 * @return boject
	 */
	public function fetch_company($limit,$offset) {
		$this->db->limit($limit,$offset);
		$this->db->where(array("status"=>"Active"));
		$query = $this->db->get("payroll_system_account");
		$result = $query->result();
		$query->free_result();
		return $result;
	}
	
	/**
	 * 
	 * Counts company usage for pagination purposes
	 * @return integer
	 */
	public function count_company() {
		$query 	= $this->db->query("SELECT COUNT(*) as val from payroll_system_account WHERE status='Active'");
		$row	= $query->num_rows();
		$res 	= $query->row();
		$query->free_result();
		return $row ? $res->val : 0;
	}
	
	/**
	 * 
	 * Displays all company
	 * @return object
	 */
	public function all_company() {
		$query 	= $this->db->get_where("company",array("status"=>"Active","deleted"=>"0"));
		$result	= $query->result();
		$query->free_result();
		return $result;
	}
	
	public function fetch_payroll_system_account(){
		$query 	= $this->db->get_where("payroll_system_account",array("status"=>"Active"));
		$result	= $query->result();
		$query->free_result();
		return $result;
	}
	
	/**
	 * 
	 * Check if the company exisst
	 * @param string $company_name
	 * @return object
	 */
	public function exist_company($company_name) {
		$query = $this->db->get_where("company",array("status"=>"Active","deleted"=>"0","company_name"=>$this->db->escape_str($company_name)));
		$row	= $query->row();
		$query->free_result();
		return $row;
	}
	
	/**
	 * 
	 * Update existing company
	 * @param string $company_name
	 * @param string $old_company_name
	 * @return object
	 */
	public function update_exist_company($company_name,$old_company_name) {
		$sql = "SELECT * FROM company where status = 'Active' AND deleted='0' AND company_name = '".$this->db->escape_str($company_name)."'
				AND NOT company_name = '".$this->db->escape_str($old_company_name)."'";
		$query = $this->db->query($sql);
		$row	= $query->row();
		$query->free_result();
		return $row;
	}
	
	/**
	 * Update payroll account system
	 * @param string $database
	 * @param array $fields
	 * @param array $where
	 * @return boolean
	 */
	public function update_payroll_account_system($database,$fields,$where){
		if($where){
			$this->db->where($where);
			$this->db->update($database,$fields);
			return $this->db->affected_rows();
		}
	}
	
	/**
	 * Update fields global 
	 * Enter description here ...
	 * @param string $database
	 * @param array $fields
	 * @param array $where
	 * @return integer
	 */
	public function update_fields_data($database,$fields,$where){
		$this->db->where($where);
		$this->db->update($database,$fields);
		return $this->db->affected_rows();
	}
	
	/**
	 * THIS IS FOR THE AJAX RETURN VIEW CHECK THE DEPARTMENT DETAILS ( eq: parent company)
	 * Enter description here ...
	 * @param int $psa_id
	 * @return object
	 */
	public function department_details($psa_id){
		if($psa_id){
			$query = $this->db->query(
				"SELECT * FROM accounts a
				LEFT JOIN company_owner co on co.account_id = a.account_id
				LEFT JOIN payroll_system_account psa on psa.payroll_system_account_id = a.payroll_system_account_id
				WHERE a.payroll_system_account_id !=0 AND  a.payroll_system_account_id = '{$this->db->escape_str($psa_id)}'"
			);
			$row = $query->row();
			$query->free_result();
			return $row;
		}else{
			return false;
		}
	}

}

/* End of file Company_setup_model.php */
/* Location: ./application/model/admin/Company_setup_model.php */