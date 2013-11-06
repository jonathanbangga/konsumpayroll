<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company principal model
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Company_principal_model extends CI_Model {
		
		public function __construct() {
			parent::__construct();
		}

		/**
		 * 
		 * add global for approvers
		 * @param string $table
		 * @param array $fields
		 * @
		 * @return integer
		 */
		public function save_fields($table,$fields){
			$this->db->insert($table,$fields);
			return $this->db->insert_id();
		}
		
		/** 
		 * Updates global fields
		 * @example $this->approvers->update_fields("employee",array("id"=>1,"status"=>"Active"),array("emp_id"=>3));
		 * @param string $table
		 * @param array $fields
		 * @param array $where_array
		 * @return boolean
		 */
		public function update_fields($table,$fields,$where_array){
			$this->db->where($where_array);
			$this->db->update($table,$fields);
			return $this->db->affected_rows();
		}
		
		/**
		 * Get the comapny principals  
		 * @param int $company_id
		 */
		public function fetch_principals($company_id,$start=5,$limit=NULL){
			if(is_numeric($start) && is_numeric($company_id)){
				$sql = "SELECT DISTINCT *,concat(e.first_name,' ',e.last_name) as fullname FROM employee e
					LEFT JOIN company_principal cp on e.emp_id = cp.emp_id
					LEFT JOIN accounts a on a.account_id = e.account_id WHERE cp.company_id={$this->db->escape_str($company_id)}
					and e.status = 'Active' and e.deleted = '0' and cp.status = 'Active' and cp.deleted = '0' 
					and a.deleted = '0'
					";
				if($start !="" && $limit == NULL){
					$sql .=" LIMIT $start";
				}
				if($start !="" && $limit !=""){
					$sql .=" LIMIT $start,$limit";
				}
				$query = $this->db->query($sql);
				$result = $query->result();
				$query->free_result();
				return $result;
			}else{
				return false;
			}
		}
		
		/**
		 * Get princiap employee id
		 * @param int $company_id
		 * @param int $emp_id
		 */
		public function get_principal_emp($company_id,$emp_id){
			if(is_numeric($company_id) && is_numeric($emp_id)){
				$sql2 = "SELECT DISTINCT concat(e.first_name,' ',e.last_name) as fullname,e.emp_id as emp_id,
					cp.company_principal_id as company_principal_id,a.account_id as account_id, 
					
					FROM employee e
					LEFT JOIN company_principal cp on e.emp_id = cp.emp_id
					LEFT JOIN accounts a on a.account_id = e.account_id WHERE cp.company_id={$this->db->escape_str($company_id)} 
					and e.emp_id = {$this->db->escape_str($emp_id)} 
					and e.status = 'Active' and e.deleted = '0' and cp.status = 'Active' and cp.deleted = '0' 
					and a.deleted = '0'";
				$sql = "SELECT DISTINCT concat( e.first_name, ' ', e.last_name ) AS fullname,e.emp_id,e.account_id,e.payroll_group_id,e.permission_id,e.company_id,e.rank_id,e.dept_id,e.location_id,e.last_name,e.first_name,e.middle_name,e.dob,
					e.gender,e.marital_status,e.address,e.contact_no,e.mobile_no,e.home_no,e.photo,e.tin,e.hdmf,e.sss,e.phil_health,e.gsis,e.emergency_contact_person,e.emergency_contact_number,e.position_id,e.`status`,e.deleted,a.account_id,a.payroll_cloud_id,a.account_type_id,a.email,a.deleted,cp.deleted,cp.`status`,cp.company_principal_id
					FROM employee e
					LEFT JOIN company_principal cp ON e.emp_id = cp.emp_id
					LEFT JOIN accounts a ON a.account_id = e.account_id
					WHERE cp.company_id ={$this->db->escape_str($company_id)}
					AND e.emp_id ={$this->db->escape_str($emp_id)} 
					AND e.status = 'Active'
					AND e.deleted = '0'";
				
				$query = $this->db->query($sql);
				$row = $query->row();
				$query->free_result();
				return $row;
			}else{
				return false;
			}
		}
		
		/**
		 * Get employee ids and return query
		 * Enter description here ...
		 * @param int $emp_id
		 */
		public function get_employee($emp_id){
			if(is_numeric($emp_id)){
				$query = $this->db->query("SELECT * FROM employee where emp_id={$this->db->escape_str($emp_id)} and status='Active' and deleted='0'");
				$row = $query->row();
				$query->free_result();
				return $row;
			}
		}
		
		/**
		 * Check emails of the employee is exist otherwise let him/her update new email
		 * @param email $old_email
		 * @param email $new_email
		 * @return boolean
		 */
		public function check_email_exist($old_email,$new_email){
			$old_email = $this->db->escape_str($old_email);
			$new_email = $this->db->escape_Str($new_email);
			if($old_email && $new_email){
				$query = $this->db->query("SELECT * FROM `accounts` a 
						LEFT JOIN employee e on e.account_id =  a.account_id
						where a.email = '{$new_email}' and NOT a.email = '{$old_email}'");
				$row = $query->num_rows();
				$query->free_result();
				return $row ? true : false;	
			}
		}
		
		public function check_payrol_cloud_id($old_payroll_cloud_id,$new_payroll_cloud_id){
			$old_payroll_cloud_id = $this->db->escape_str($old_payroll_cloud_id);
			$new_payroll_cloud_id = $this->db->escape_Str($new_payroll_cloud_id);
			if($old_payroll_cloud_id && $new_payroll_cloud_id){
				$query = $this->db->query("SELECT * FROM `accounts` a 
						LEFT JOIN employee e on e.account_id =  a.account_id
						where a.payroll_cloud_id = '{$new_payroll_cloud_id}' and NOT a.payroll_cloud_id = '{$old_payroll_cloud_id}'");
				$row = $query->num_rows();
				$query->free_result();
				return $row ? true : false;	
			}
		}
		
		
	}
/* End of file Company_principal_model */
/* Location: ./application/model/company/Company_principal_model.php */