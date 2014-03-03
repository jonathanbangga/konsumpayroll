<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * HOURSWORKED  model for approving overtime , leaves , loans
 *
 * @category Model
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Hoursworked_model extends CI_Model {
	
		public function __construct(){
			parent::__construct();
		}
		
		/**
		 * CHECKS APPLICATION LEAVE FOR EVERY COMPANY
		 * @param int $company_id
		 * @return object
		 */
		public function hoursworked_list($company_id,$limit=10,$start=0){
			if(is_numeric($company_id)){
				$start = intval($start);
				$limit = intval($limit);
				$query2 = $this->db->query("SELECT distinct(e.emp_id),sum(eti.total_hours) as res,concat(e.first_name,' ',e.last_name) as full_name,a.payroll_cloud_id FROM employee  e
													LEFT JOIN `employee_time_in` eti on e.emp_id = eti.emp_id 
													LEFT JOIN accounts a on e.account_id= e.account_id 
													WHERE eti.comp_id = '{$this->db->escape_str($company_id)}' 
													AND e.deleted = '0' AND e.status = 'Active' AND a.deleted=  '0'  
													AND eti.deleted = '0' 
													group by e.emp_id LIMIT {$start},{$limit}"
				);				
				$query = $this->db->query("SELECT * FROM employee  e
													LEFT JOIN `employee_time_in` eti on e.emp_id = eti.emp_id 
													LEFT JOIN accounts a on e.account_id= e.account_id 
													WHERE eti.comp_id = '{$this->db->escape_str($company_id)}' 
													AND e.deleted = '0' AND e.status = 'Active' AND a.deleted=  '0'  
													AND eti.deleted = '0' 
													group by e.emp_id LIMIT {$start},{$limit}");
				$result = $query->result();
				$query->free_result();
				return $result;
			}else{
				return false;
			}
		}
		
		/**
		*	COUNT HOURSWORKED FOR PAGINATION PURPOSES
		*	@param int $company_id
		*	@return int $val
		*/
		public function count_hoursworked_list($company_id) {
			if(is_numeric($company_id)) {
				$query = $this->db->query("SELECT count(*) as val from employee e LEFT JOIN `employee_time_in` eti on e.emp_id = eti.emp_id WHERE eti.comp_id = '{$this->db->escape_str($company_id)}' AND e.deleted = '0' AND e.status = 'Active' AND eti.deleted = '0'");
				$row = $query->row();
				$query->free_result();
				return $row;
			} else {
				return false;
			}
		}
		
		/**
		*	FETCH LIST TABLE
		*	@param string $table
		*	@param array $where_array
		*	@return object
		*/
		public function fetch_list($table,$where_array){
			$where = array($where_array);
			$query = $this->db->get_where($table,$where);
			$result = $query->result();
			$query->free_result();
			return $result;
		}
		
		/*
		*   ROW LIST TABLE
		*	@param string $table
		*	@param array $where_array
		*	@return object
		*/
		public function row_list($table,$where_array) {
			if(!$table) {
				return FALSE;
			} else {
				$where	= array($where_array);
				$query	= $this->db->qet_where($table,$where);
				$result	= $query->result();
				$query->free_result();
				return $result;
			}
		}
		
	}
/* End of file Approve_leave_model */
/* Location: ./application/models/hr/Approve_leave_model.php */;
	