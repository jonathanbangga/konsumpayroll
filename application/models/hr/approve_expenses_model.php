<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Approve LEave model for approving overtime , leaves , loans
 *
 * @category Model
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Approve_expenses_model extends CI_Model {
		
		/**
		 * CHECKS APPLICATION LEAVE FOR EVERY COMPANY
		 * @param int $company_id
		 * @return object
		 */
		public function expense_list($company_id,$limit,$start){
			if(is_numeric($company_id)){
				$start = intval($start);
				$limit = intval($limit);
				$query = $this->db->query(
						"	SELECT *,concat(e.first_name,' ',e.last_name) as full_name FROM expenses ee
							LEFT JOIN employee e on e.emp_id = ee.emp_id 
							LEFT JOIN accounts a on a.account_id = e.account_id 
							WHERE ee.company_id = '{$this->db->escape_str($company_id)}' AND ee.deleted = '0' AND  ee.expense_status = 'pending' 
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
		public function expense_application_count($company_id){
			if(is_numeric($company_id)){
				$query = $this->db->query("SELECT count(*) as val FROM expenses WHERE expense_status  = 'pending' 
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
		 * Update global fields
		 * use for all
		 * @param string $database
		 * @param array $fields
		 * @param array $where
		 */
		public function update_field($database,$fields,$where){
			$this->db->where($where);
			$this->db->update($database,$fields);
			return $this->db->affected_rows();
		}
	}
	
/* End of file Approve_leave_model */
/* Location: ./application/models/hr/Approve_leave_model.php */;
	