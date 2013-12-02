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
	