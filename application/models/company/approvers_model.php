<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Government_model Model 
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Approvers_model extends CI_Model {
		
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
			$this->db->insert($table,$fields);
			return $this->db->affected_rows();
		}
		
		/**
		 * Check approvers users list
		 * @param int $comp_id
		 * @return object
		 */
		public function fetch_approvers_users($comp_id){
			if(is_numeric($comp_id)){
				$q_old = $this->db->query("SELECT * from employee e 
									LEFT JOIN accounts a on a.account_id = e.account_id 
									LEFT JOIN assign_company_head ach  on ach.emp_id = e.emp_id 
									WHERE ach.company_id ={$this->db->escape_str($comp_id)} AND e.status = 'Active' and e.deleted = '0' AND 
									ach.status = 'Active' and ach.deleted='0'");
				$q = $this->db->query("SELECT DISTINCT * FROM company_approvers ca 
										LEFT JOIN employee e on e.account_id = ca.account_id
										LEFT JOIN accounts a on a.account_id = e.account_id
										WHERE ca.company_id = {$this->db->escape_str($comp_id)} and ca.deleted = '0' 
										AND e.deleted = '0' AND a.deleted = '0' ORDER BY ca.level DESC
										");
				
				$result	 = $q->result();
				$q->free_result();
				return $result;
			}else{
				return false;
			}
		}
		
		/**
		 * 
		 * Remove this file on the approvers
		 * @param int $account_id
		 * @return boolean
		 */
		public function remove_approvers($account_id){
			if(is_numeric($account_id)){
				$fields = array("deleted"=>"1");
				$this->db->where(array("account_id"=>$account_id));
				$this->db->update("employee",$fields);
				// disabled on company heads	
				return $this->db->affected_rows();
			} else {
				return false;
			}
		}
		
		/**
		 * 
		 * remove assign company heads when removing it from the company section
		 * @param int $account_id
		 * @return boolean
		 */
		public function remove_assign_company_head($account_id){
			if(is_numeric($account_id)){
				# check first the owner of the account_id
				$query_emp = $this->db->query("SELECT * FROM employee e LEFT JOIN accounts a on a.account_id = e.account_id WHERE e.account_id = {$this->db->escape_str($account_id)}");
				$emp_row = $query_emp->row();
				$query_emp->free_result(); #reset the query
				# check emp_row
				if($emp_row) {
					$fields = array("deleted"=>"1");
					# update accounts deleted 		
					$query_accounts = $this->db->update("accounts",$fields,array("account_id"=>$this->db->escape_str($account_id)));			
					# end updated accounts deleted
					# update assign company heads to deleted = 1
					$where = array("account_id"=>$this->db->escape_str($account_id),"company_id"=>$this->db->escape_str($emp_row->company_id));
					$this->db->update("company_approvers",$fields,$where);
					return $this->db->affected_rows();
					# end update assign company heads to deleted
				} else {
					return false;
				}
			}else{
				return false;
			}
		}
	}
/* End of file Approvers_model.php */
/* Location: ./application/controllers/company/Approvers_model.php */