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
		 * Expense list by name
		 * Checks expenses application sort by name
		 * @param int $company_id
		 * @param int $limit
		 * @param int $start
		 * @param string $employee_name
		 * @return object
		 */
		public function expense_list_by_name($company_id,$limit,$start,$employee_name){
			if(is_numeric($company_id)){
				$start = intval($start);
				$limit = intval($limit);
				$employee_name = $this->db->escape_like_str($employee_name);
				$query = $this->db->query(
						"	SELECT *,concat(e.first_name,' ',e.last_name) as full_name FROM expenses ee
							LEFT JOIN employee e on e.emp_id = ee.emp_id 
							LEFT JOIN accounts a on a.account_id = e.account_id 
							WHERE ee.company_id = '{$this->db->escape_str($company_id)}' AND ee.deleted = '0' AND  ee.expense_status = 'pending' 
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
		 * EXPENSE list via dates
		 * expense list of expenses via dates
		 * @param int $company_id
		 * @param int $limit
		 * @param int $start
		 * @param dates $date_from
		 * @param dates $date_to
		 * @return object
		 */
		public function expense_list_by_date($company_id,$limit,$start,$date_from,$date_to){
			if(is_numeric($company_id)){
				$start = intval($start);
				$limit = intval($limit);
				$date_from = $this->db->escape($date_from);
				$date_to = $this->db->escape($date_to);
				
				$query = $this->db->query(
						"	SELECT *,concat(e.first_name,' ',e.last_name) as full_name FROM expenses ee
							LEFT JOIN employee e on e.emp_id = ee.emp_id 
							LEFT JOIN accounts a on a.account_id = e.account_id 
							WHERE ee.company_id = '{$this->db->escape_str($company_id)}' AND ee.deleted = '0' AND  ee.expense_status = 'pending' 
							AND ee.payroll_date >={$date_from} AND  ee.payroll_date <={$date_to}
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
		 * COUNT expenses application count names
		 * counts application snames
		 * @param int $company_id
		 * @param string $employee_name
		 * @return int
		 */
		public function expense_application_count_name($company_id,$employee_name){
			if(is_numeric($company_id)){
				$employee_name = $this->db->escape_like_str($employee_name);
				$query = $this->db->query("SELECT count(*) as val FROM expenses ex
						LEFT JOIN employee e on e.emp_id = ex.emp_id
						WHERE ex.expense_status  = 'pending' 
						AND ex.company_id = '{$this->db->escape_str($company_id)}' AND ex.deleted='0' 
						AND concat(e.first_name,' ',e.last_name) like '%{$employee_name}%' 
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
		 * Expenses application counts dates
		 * check expenses application and count to date
		 * @param int $company_id
		 * @param int $date_from
		 * @param dates $date_to
		 * @return integer
		 */
		public function expense_application_count_date($company_id,$date_from,$date_to){
			if(is_numeric($company_id)){
				$date_from = $this->db->escape($date_from);
				$date_to = $this->db->escape($date_to);
				$query = $this->db->query("SELECT count(*) as val FROM expenses ex
						LEFT JOIN employee e on e.emp_id = ex.emp_id
						WHERE ex.expense_status = 'pending' 
						AND ex.company_id = '{$this->db->escape_str($company_id)}' AND ex.deleted='0' 
						AND ex.payroll_date >={$date_from} AND  ex.payroll_date <={$date_to}
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
	