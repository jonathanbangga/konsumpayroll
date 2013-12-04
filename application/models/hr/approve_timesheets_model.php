<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Approve LEave model for approving overtime , leaves , loans
 *
 * @category Model
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Approve_timesheets_model extends CI_Model {
		
		/**
		 * CHECKS APPLICATION LEAVE FOR EVERY COMPANY
		 * @param int $company_id
		 * @return object
		 */
		public function timesheets_list($company_id,$limit=10,$start=0){
			if(is_numeric($company_id)){
				$start = intval($start);
				$limit = intval($limit);
				$query = $this->db->query(
						"	SELECT *,concat(e.first_name,' ',e.last_name) as full_name FROM employee_timesheets et
							LEFT JOIN employee e on e.emp_id = et.emp_id 
							LEFT JOIN accounts a on a.account_id = e.account_id 
							WHERE et.company_id = '{$this->db->escape_str($company_id)}' AND et.deleted = '0' AND et.timesheets_status = 'pending' 
							Limit {$start},{$limit}
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
		 * TIMELIST DATE BY DATE
		 * @param int $company_id
		 * @param int $limit
		 * @param int $start
		 * @param dates $date_from
		 * @param dates $date_to
		 * @return object
		 */
		public function timesheets_list_by_date($company_id,$limit=10,$start=0,$date_from,$date_to){
			if(is_numeric($company_id)){
				$start = intval($start);
				$limit = intval($limit);
				$date_from = trim($this->db->escape($date_from));
				$date_to = trim($this->db->escape($date_to));
				$query = $this->db->query(
						"	SELECT *,concat(e.first_name,' ',e.last_name) as full_name FROM employee_timesheets et
							LEFT JOIN employee e on e.emp_id = et.emp_id 
							LEFT JOIN accounts a on a.account_id = e.account_id 
							WHERE et.company_id = '{$this->db->escape_str($company_id)}' AND et.deleted = '0' AND et.timesheets_status = 'pending' 
							AND CAST(et.date_from as date)>={$date_from} AND CAST(et.date_from as date) <={$date_to} 
							OR CAST(et.date_from as date)>={$date_from} AND CAST(et.date_to as date) <={$date_to} 
							ORDER BY et.date_from ASC
							Limit {$start},{$limit} 
						"
				);
				$result = $query->result();
				$query->free_result();
				return $result;
			}else{
				return false;
			}
		}
		
		public function timesheets_list_by_name($company_id,$limit=10,$start=0,$employee_name){
			if(is_numeric($company_id)){
				$start = intval($start);
				$limit = intval($limit);
				$employee_name = $this->db->escape_like_str($employee_name);
				$query = $this->db->query(
						"	SELECT *,concat(e.first_name,' ',e.last_name) as full_name FROM employee_timesheets et
							LEFT JOIN employee e on e.emp_id = et.emp_id 
							LEFT JOIN accounts a on a.account_id = e.account_id 
							WHERE et.company_id = '{$this->db->escape_str($company_id)}' AND et.deleted = '0' AND et.timesheets_status = 'pending' 
							AND concat(e.first_name,' ',e.last_name) like '%{$employee_name}%' 
							Limit {$start},{$limit}
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
		public function timesheets_application_count($company_id){
			if(is_numeric($company_id)){
				$query = $this->db->query("SELECT count(*) as val FROM employee_timesheets WHERE timesheets_status  = 'pending' 
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
		 * FETCH APPLICATION BY DATES FOR PAGINATION PURPOSES
		 * COUNTS THE NUMBER OF DATA WITHIN THE DB
		 * @param int $company_id
		 * @return integer
		 */
		public function timesheets_application_count_dates($company_id,$date_from,$date_to){
			if(is_numeric($company_id)){
				$date_from = trim($this->db->escape($date_from));
				$date_to = trim($this->db->escape($date_to));
				$query = $this->db->query("SELECT count(*) as val FROM employee_timesheets 
						WHERE timesheets_status  = 'pending' 
						AND company_id = '{$this->db->escape_str($company_id)}' AND deleted='0'
						AND CAST(date_from as date)>={$date_from} AND CAST(date_from as date) <={$date_to} 
						OR CAST(date_from as date)>={$date_from} AND CAST(date_to as date) <={$date_to} 
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
		 * FETCH APPLICATION BY NAME FOR PAGINATION PURPOSES
		 * COUNTS THE NUMBER OF DATA WITHIN THE DB
		 * @param int $company_id
		 * @return integer
		 */
		public function timesheets_application_count_names($company_id,$employee_name){
			if(is_numeric($company_id)){
				$employee_name = $this->db->escape_like_str($employee_name);
				$query = $this->db->query("SELECT count(*) as val FROM employee_timesheets et
						LEFT JOIN employee e on e.emp_id = et.emp_id 
						WHERE et.timesheets_status  = 'pending' 
						AND et.company_id = '{$this->db->escape_str($company_id)}' AND et.deleted='0'
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
	