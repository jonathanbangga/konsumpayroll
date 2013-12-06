<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Approve LEave model for approving overtime , leaves , loans
 *
 * @category Model
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Approve_leave_model extends CI_Model {
		
		/**
		 * CHECKS APPLICATION LEAVE FOR EVERY COMPANY
		 * @param int $company_id
		 * @return object
		 */
		public function leave_application_list($company_id,$limit=10,$start=0){
			if(is_numeric($company_id)){
				$start = intval($start);
				$limit = intval($limit);
				$query = $this->db->query(
						"	SELECT *,concat(e.first_name,' ',e.last_name) as full_name FROM employee_leaves_application el
							LEFT JOIN employee e on e.emp_id = el.emp_id 
							LEFT JOIN accounts a on a.account_id = e.account_id 
							WHERE el.company_id = '{$this->db->escape_str($company_id)}' AND el.deleted = '0' AND el.leave_application_status = 'pending'
							 LIMIT {$start},{$limit} 
						"
				);
				$result = $query->result();
				$query->free_result();
				return $result;
			}else{
				return false;
			}
		}
		
		/**
		 * Leave date sorting 
		 * @param int $company_id
		 * @param int $limit
		 * @param int $start
		 */
		public function leave_application_date_sort($company_id,$limit=10,$start=0,$date_from,$date_to){
			if(is_numeric($company_id)){
				$date_from = $this->db->escape($date_from);
				$date_to = $this->db->escape($date_to);
				$start = intval($start);
				$limit = intval($limit);
				$query = $this->db->query(
						"	SELECT *,concat(e.first_name,' ',e.last_name) as full_name FROM employee_leaves_application el
							LEFT JOIN employee e on e.emp_id = el.emp_id 
							LEFT JOIN accounts a on a.account_id = e.account_id 
							WHERE el.company_id = '{$this->db->escape_str($company_id)}' AND el.deleted = '0' AND el.leave_application_status = 'pending'
							AND el.date_start >= {$date_from}	AND el.date_start <={$date_to} 	
							 LIMIT {$start},{$limit} 
						"
				);
				$result = $query->result();
				$query->free_result();
				return $result;
			}else{
				return false;
			}
		}
		
		/**
		 * CHECKS APPLICATION LEAVE FOR EVERY COMPANY by employe name
		 * @param int $company_id
		 * @return object
		 */
		public function leave_application_list_name($company_id,$limit=10,$start=0,$employee_name){
			if(is_numeric($company_id)){
				$start = intval($start);
				$limit = intval($limit);
				$employee_name =$this->db->escape_like_str($employee_name);
				$query = $this->db->query(
						"	SELECT *,concat(e.first_name,' ',e.last_name) as full_name FROM employee_leaves_application el
							LEFT JOIN employee e on e.emp_id = el.emp_id 
							LEFT JOIN accounts a on a.account_id = e.account_id 
							WHERE el.company_id = '{$this->db->escape_str($company_id)}' AND el.deleted = '0' AND el.leave_application_status = 'pending'
							AND concat(e.first_name,' ',e.last_name) like '%{$employee_name}%' 
							 LIMIT {$start},{$limit} 
						"
				);
				$result = $query->result();
				$query->free_result();
				return $result;
			}else{
				return false;
			}
		}
		
		/**
		 * Count Leaves application for pagination purposes only
		 * @param int $company_id
		 * @return integer
		 */
		public function leave_application_count($company_id){
			if(is_numeric($company_id)){
				$query = $this->db->query("SELECT count(*) as val FROM employee_leaves_application WHERE leave_application_status  = 'pending' 
						AND company_id = '{$this->db->escape_str($company_id)}' AND deleted='0'
				");
				$row = $query->row();
				$num_row = $query->num_rows();
				$query->free_result();
				return $num_row ? $row->val : 0;
			}else{
				return false;
			}
		}
		
		/**
		 * LEave application count date sort
		 * @param int $company_id
		 * @param date $date_from
		 * @param date $date_to
		 * @return integer
		 */
		public function leave_application_date_count($company_id,$date_from,$date_to){
			if(is_numeric($company_id)){
				$date_from = $this->db->escape($date_from);
				$date_to = $this->db->escape($date_to);
				$query = $this->db->query("SELECT count(*) as val FROM employee_leaves_application WHERE leave_application_status  = 'pending' 
						AND company_id = '{$this->db->escape_str($company_id)}' AND deleted='0'  AND date_start >= {$date_from}	AND date_start <={$date_to} 	
				");
				$row = $query->row();
				$num_row = $query->num_rows();
				$query->free_result();
				return $num_row ? $row->val : 0;
			}else{
				return false;
			}
		}
		
		/**
		 * Leave application get count by name
		 * Enter description here ...
		 * @param unknown_type $company_id
		 */
		public function leave_application_count_name($company_id,$employee_name){
			if(is_numeric($company_id) && $employee_name !=""){
				$employee_name = $this->db->escape_like_str($employee_name);
				$query = $this->db->query(
					"SELECT count(*) as val FROM employee_leaves_application ela
					LEFT JOIN employee e on e.emp_id = ela.emp_id
					WHERE ela.leave_application_status  = 'pending' 
					AND ela.company_id = '{$this->db->escape_str($company_id)}' AND ela.deleted='0' 
					AND concat(e.first_name,' ',e.last_name) like '%{$employee_name}%'"
				);
				$row = $query->row();
				$num_row = $query->num_rows();
				$query->free_result();
				return $num_row ? $row->val : 0;
			}else{
				return false;
			}
		}

		/**
		 * Update fields
		 * @param string $database
		 * @param array $field
		 * @param array $where
		 * @return boolean
		 */
		public function update_field($database,$field,$where){
			$this->db->where($where);
			$this->db->update($database,$field);
			return $this->db->affected_rows();
		}
		
	}
	
/* End of file Approve_leave_model */
/* Location: ./application/models/hr/Approve_leave_model.php */;
	