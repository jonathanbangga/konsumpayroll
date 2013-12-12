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
				AND el.status = 'Active'
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
					AND el.status = 'Active'
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
					AND el.status = 'Active'
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
				AND el.status = 'Active'
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
		 * Filter Loan Type
		 * @param unknown_type $loan_type
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 */
		public function filter_loan_type($loan_type,$comp_id,$emp_id){
			$sql = $this->db->query("
				SELECT *FROM `employee_loans` el
				LEFT JOIN loan_type lt ON el.loan_type_id = lt.loan_type_id
				WHERE el.company_id = {$comp_id}
				AND el.emp_id = {$emp_id}
				AND el.loan_type_id = '{$loan_type}'
				AND el.status = 'Active'
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
				AND o.status = 'Active'
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
		
		/**
		 * Check Employee Amortization Schedule ID		 
		 * @param unknown_type $amor_sched_id
		 * @param unknown_type $comp_id
		 */
		public function check_amortization_sched_id($emp_loan_id,$comp_id){
			$sql = $this->db->query("
				SELECT 
				*FROM employee_loans
				WHERE company_id = '{$comp_id}'
				AND employee_loans_id = '{$emp_loan_id}'
				AND status = 'Active'
			");
			$results = $sql->result();
			if($sql->num_rows() > 0){
				return true;
			}else{
				return false;
			}
		}
		
		/**
		 * Employee Payment History Information
		 * @param unknown_type $comp_id
		 */
		public function emp_payment_history($comp_id, $loan_id){
			$sql = $this->db->query("
				SELECT 
				*FROM employee_payment_history
				WHERE comp_id = '{$comp_id}'
				AND employee_loans_id = '{$loan_id}'
				AND status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$results = $sql->result();
				$sql->free_result();
				return $results;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Total Principal Amount Amortization
		 * @param unknown_type $loan_id
		 * @param unknown_type $comp_id
		 */
		public function total_princiapl_amortization($loan_id,$comp_id){
			$sql = $this->db->query("
				SELECT 
				*FROM employee_amortization_schedule
				WHERE comp_id = '{$comp_id}'
				AND emp_loan_id = '{$loan_id}'
				AND status = 'Active'
			");
			$result = $sql->result();
			if($sql->num_rows() > 0){
				$total_val = 0;
				foreach($result as $row){
					$total_val = $total_val + $row->principal;
				}
				return $total_val;
			}else{
				return false;
			}
		}
		
		/**
		 * Employee Loan Amount
		 * @param unknown_type $loan_id
		 * @param unknown_type $comp_id
		 */
		public function loan_amount($loan_id,$comp_id){
			$sql = $this->db->query("
				SELECT 
				*FROM employee_loans
				WHERE company_id = '{$comp_id}'
				AND employee_loans_id = '{$loan_id}'
				AND status = 'Active'
			");
			$row = $sql->row();
			if($sql->num_rows() > 0){
				return $row->principal;
			}else{
				return false;
			}
		}
		
		/**
		 * Employee Loan No Information
		 * @param unknown_type $comp_id
		 */
		public function emp_loan_no_group($comp_id, $loan_id){
			$sql = $this->db->query("
				SELECT 
				*FROM employee_loans el
				LEFT JOIN employee e ON el.emp_id = e.emp_id
				LEFT JOIN accounts a ON e.account_id = a.account_id
				LEFT JOIN loan_type lt ON el.loan_type_id = lt.loan_type_id
				WHERE el.company_id = '{$comp_id}'
				AND e.status = 'Active'
				AND el.employee_loans_id = '{$loan_id}'
				GROUP BY e.emp_id
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Get Interest and Principal Value from Payment History
		 * Enter description here ...
		 * @param unknown_type $amotization_id
		 * @param unknown_type $comp_id
		 */
		public function kapila_ka_row_interest_principal($loan_id, $comp_id){
			$sql = $this->db->query("
				SELECT 
				*FROM employee_payment_history
				WHERE comp_id = '{$comp_id}'
				AND employee_loans_id = '{$loan_id}'
				AND status = 'Active'
			");
			$row = $sql->row();
			if($sql->num_rows() > 0){
				$kapila_ka_row_res = $sql->num_rows() + 1;
				return $kapila_ka_row_res;
			}else{
				$kapila_ka_row_res = 1;
				return $kapila_ka_row_res;
			}
		}
		
		/**
		 * Get Interest and Principal Value
		 * @param unknown_type $get_kapila_ka_row
		 * @param unknown_type $comp_id
		 */
		public function get_interest_principal($amotization_id, $get_kapila_ka_row,$comp_id){
			$sql = $this->db->query("
				SELECT 
				*FROM employee_amortization_schedule
				WHERE comp_id = '{$comp_id}'
				AND emp_loan_id = '{$amotization_id}'
				AND status = 'Active'
				LIMIT {$get_kapila_ka_row},1
			");
			$row = $sql->row();
			if($sql->num_rows() > 0){
				$sql->free_result();
				return $row;
			}else{
				return false;
			}
		}
		
		/**
		 * Payment Debit Amount / Remaining Cash Amount
		 * @param unknown_type $loan_id
		 * @param unknown_type $comp_id
		 */
		public function payment_debit_amount($loan_id, $comp_id){
			$sql = $this->db->query("
				SELECT *
				FROM `employee_payment_history`
				WHERE comp_id = '{$comp_id}'
				AND employee_loans_id = '{$loan_id}'
				AND status = 'Active'
				ORDER BY employee_payment_history_id DESC
				LIMIT 1
			");
			$row = $sql->row();
			if($sql->num_rows() > 0){
				$sql->free_result();
				return $row->remaining_cash_amount;
			}else{
				return 0;
			}
		}
		
		/**
		 * Total Loan Amount from Amortization Schedule
		 * @param unknown_type $comp_id
		 * @param unknown_type $loan_id
		 */
		public function total_loan_amount($comp_id, $loan_id){
			$sql = $this->db->query("
				SELECT
				*FROM employee_amortization_schedule
				WHERE comp_id = '{$comp_id}'
				AND emp_loan_id = '{$loan_id}'
				AND status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$results = $sql->result();
				$sql->free_result();
				return $results;
			}else{
				return FALSE;
			}
		}
		
	}
	
/* End of file employee_model.php */
/* Location: ./application/models/employee_model.php */