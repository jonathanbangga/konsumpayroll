<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Model
 *
 * @category Model
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Employee_model extends CI_Model {
		
		/**
		 * Fetch Employee Account
		 * @param unknown_type $emp_id
		 */
		public function my_profile($emp_id){
			$sql = $this->db->query("
				SELECT *FROM employee e
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE e.emp_id = '{$emp_id}'
				AND status = 'Active' 
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row;
			}else{
				return false;
			}
		}
		
		/**
		 * Employee Leave Application Counter
		 * Enter description here ...
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 */
		public function leave_application_counter($comp_id,$emp_id){
			$sql = $this->db->query("
				SELECT 
				COUNT(employee_leaves_application_id) as employee_leaves_application_id
				FROM `employee_leaves_application` el
				LEFT JOIN `leave_type` lt ON el.leave_type_id = lt.leave_type_id
				WHERE el.company_id = {$comp_id}
				AND el.emp_id = {$emp_id}
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row->employee_leaves_application_id;
			}else{
				return false;
			}
		}
		
		/**
		 * Employee Leave Application
		 * Enter description here ...
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 */
		public function leave_application($limit, $start, $comp_id,$emp_id){
			if($start==0){
				$sql = $this->db->query("
					SELECT *FROM `employee_leaves_application` el
					LEFT JOIN `leave_type` lt ON el.leave_type_id = lt.leave_type_id
					WHERE el.company_id = {$comp_id}
					AND el.emp_id = {$emp_id}
					LIMIT ".$limit."
				");
				
				if($sql->num_rows() > 0){
					$row = $sql->result();
					$sql->free_result();
					return $row;
				}else{
					return false;
				}
			}else{
				$sql = $this->db->query("
					SELECT *FROM `employee_leaves_application` el
					LEFT JOIN `leave_type` lt ON el.leave_type_id = lt.leave_type_id
					WHERE el.company_id = {$comp_id}
					AND el.emp_id = {$emp_id}
					LIMIT ".$start.",".$limit."
				");
				
				if($sql->num_rows() > 0){
					$row = $sql->result();
					$sql->free_result();
					return $row;
				}else{
					return false;
				}
			}
		}
		
		/**
		 * Employee Loan Payment History 
		 * Enter description here ...
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 */
		public function loans($comp_id,$emp_id){
			$sql = $this->db->query("
				SELECT *FROM `employee_loans` el
				LEFT JOIN loan_type lt ON el.loan_type_id = lt.loan_type_id
				WHERE el.company_id = {$comp_id}
				AND el.emp_id = {$emp_id}
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->result();
				$sql->free_result();
				return $row;
			}else{
				return false;
			}
		}
		
		/**
		 * Employee Overtime
		 * Enter description here ...
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 */
		public function overtime($comp_id,$emp_id){
			/*$sql2 = $this->db->query("
				SELECT *FROM `overtime` o
				LEFT JOIN overtime_type ot ON o.overtime_type_id = ot.overtime_type_id
				LEFT JOIN location l ON o.location_id = l.location_id
				LEFT JOIN project p ON l.project_id = p.project_id 
				WHERE o.company_id = {$comp_id}
				AND o.emp_id = {$emp_id}
			");*/
			
			$sql = $this->db->query("
				SELECT *FROM `overtime` o
				LEFT JOIN overtime_type ot ON o.overtime_type_id = ot.overtime_type_id
			
				WHERE o.company_id = {$comp_id}
				AND o.emp_id = {$emp_id}
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->result();
				$sql->free_result();
				return $row;
			}else{
				return false;
			}
		}
		
		/**
		 * Leave Type Information
		 * @param unknown_type $comp_id
		 */
		public function leave_type($comp_id){
			$sql = $this->db->query("
				SELECT *FROM leave_type
				WHERE company_id = '{$comp_id}'
				AND status = 'Active'
			");
			if($sql->num_rows() > 0){
				$result = $sql->result();
				$sql->free_result();
				return $result;
			}else{
				return false;
			}
		}
		
		/**
		 * Employee Overtime Information Counter
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 */
		public function overtime_application_counter($comp_id,$emp_id){
			$sql = $this->db->query("
				SELECT 
				COUNT(overtime_id) as total_row
				FROM employee_overtime_application
				WHERE company_id = '{$comp_id}'
				AND emp_id = '{$emp_id}'
				AND status = 'Active'
			");
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row->total_row;
			}else{
				return false;
			}
		}
		
		/**
		 * Employee Overtime Information
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 */
		public function overtime_application($limit, $start, $comp_id,$emp_id){
			if($start==0){
				$sql = $this->db->query("
					SELECT *FROM employee_overtime_application
					WHERE company_id = '{$comp_id}'
					AND emp_id = '{$emp_id}'
					AND status = 'Active'
					ORDER BY overtime_id DESC 
					LIMIT ".$limit."
				");
				if($sql->num_rows() > 0){
					$result = $sql->result();
					$sql->free_result();
					return $result;
				}else{
					return false;
				}
			}else{
				$sql = $this->db->query("
					SELECT *FROM employee_overtime_application
					WHERE company_id = '{$comp_id}'
					AND emp_id = '{$emp_id}'
					AND status = 'Active'
					ORDER BY overtime_id DESC 
					LIMIT ".$start.",".$limit."
				");
				if($sql->num_rows() > 0){
					$result = $sql->result();
					$sql->free_result();
					return $result;
				}else{
					return false;
				}
			}
		}
		
		/**
		 * Loan Type Information
		 * @param unknown_type $comp_id
		 */
		public function loan_type($comp_id){
			$sql = $this->db->query("
				SELECT *FROM loan_type
				WHERE company_id = '{$comp_id}'
				AND status = 'Active'
			");
			if($sql->num_rows() > 0){
				$result = $sql->result();
				$sql->free_result();
				return $result;
			}else{
				return false;
			}
		}
		
	}
	
/* End of file employee_model.php */
/* Location: ./application/models/employee_model.php */