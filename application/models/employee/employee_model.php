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
					ORDER BY employee_leaves_application_id DESC
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
					ORDER BY employee_leaves_application_id DESC
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
				AND deleted = '0'
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
		
		/**
		 * Check Employee Time Out Value
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 */
		public function check_time_out_first($comp_id, $emp_id){
			$date_val = date("Y")."-".date("m")."-".date("d");
			$time_val = date("H:i:s");
			$sql = $this->db->query("
				SELECT *FROM employee_time_in
				WHERE comp_id = '{$comp_id}'
				AND emp_id = '{$emp_id}'
				ORDER BY employee_time_in_id DESC
				LIMIT 1
			");
			// AND date = '{$date_val}'
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				
				// compute number of day
				
				#$startDate = strtotime("{$row->time_in}");
				#$endDate = strtotime("{$date_val} {$time_val}");
				
				$startDate = strtotime("{$row->date}");
				$endDate = strtotime("{$date_val}");
				
				$interval = $endDate - $startDate;
				$days = floor($interval / (60 * 60 * 24));
				
				// if no. of day is greater than 0, add new row for employee time in
				if($days > 0){
					return FALSE;
				}else{
					// get employee time in information
					return $row;
				}
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Time In Table is empty
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 * @param unknown_type $date_val
		 * @param unknown_type $time_in
		 */
		public function time_in_is_empty($comp_id, $emp_id){
			$current_datetime = date("Y")."-".date("m")."-".date("d");
			$time_val = date("H:i:s");
			$sql = $this->db->query("
				SELECT *FROM employee_time_in
				WHERE comp_id = '{$comp_id}'
				AND emp_id = '{$emp_id}'
				ORDER BY employee_time_in_id DESC
				LIMIT 1
			");
			if($sql->num_rows() == 0){
				return TRUE;
			}else{
				$row = $sql->row();
				$sql->free_result();
				
				// compute number of day
				#$startDate = strtotime("{$row->time_in}");
				#$endDate = strtotime("{$current_datetime} {$time_val}");
				
				$startDate = strtotime("{$row->date}");
				$endDate = strtotime("{$current_datetime}");
				$interval = $endDate - $startDate;
				$days = floor($interval / (60 * 60 * 24));
				
				// if no. of day is greater than 0, add new row for employee time in
				if($days > 0){
					return TRUE;
				}else{
					return FALSE;
				}
			}
		}
		
		/**
		 * Employee Time In List Counter
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 */
		public function time_in_list_counter($comp_id, $emp_id){
			$sql = $this->db->query("
				SELECT 
				COUNT(employee_time_in_id) AS total_row
				FROM employee_time_in
				WHERE comp_id = '{$comp_id}'
				AND emp_id = '{$emp_id}'
				ORDER BY employee_time_in_id DESC
			");
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row->total_row;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee Time In List
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 */
		public function time_in_list($limit, $start, $comp_id, $emp_id){
			if($start==0){
				$sql = $this->db->query("
					SELECT *FROM employee_time_in
					WHERE comp_id = '{$comp_id}'
					AND emp_id = '{$emp_id}'
					ORDER BY employee_time_in_id DESC
					LIMIT ".$limit."
				");
				if($sql->num_rows() > 0){
					$results = $sql->result();
					$sql->free_result();
					return $results;
				}else{
					return FALSE;
				}
			}else{
				$sql = $this->db->query("
					SELECT *FROM employee_time_in
					WHERE comp_id = '{$comp_id}'
					AND emp_id = '{$emp_id}'
					ORDER BY employee_time_in_id DESC
					LIMIT ".$start.",".$limit."
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
		
		/**
		 * Get Information Current Time In
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 */
		public function get_timein_today($comp_id, $emp_id){
			$sql = $this->db->query("
				SELECT *FROM employee_time_in
				WHERE comp_id = '{$comp_id}'
				AND emp_id = '{$emp_id}'
				ORDER BY employee_time_in_id DESC
				LIMIT 1
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				
				$date_val = date("Y")."-".date("m")."-".date("d");
				$time_val = date("H:i:s");
				
				// compute number of day
				#$startDate = strtotime("{$row->time_in}");
				#$endDate = strtotime("{$date_val} {$time_val}");
				
				$startDate = strtotime("{$row->date}");
				$endDate = strtotime("{$date_val}");
				
				$interval = $endDate - $startDate;
				$days = floor($interval / (60 * 60 * 24));
				
				// if no. of day is greater than 0, add new row for employee time in
				
				/*
				version 1.0
				
				if($days > 0){
					return FALSE;
				}else{
					// get employee time in information
					return $row;
				}
				*/
			
				if(strtotime('-1 day') < strtotime(date($row->date))){
					return FALSE;		
				}else{
					// get employee time in information
					return $row;
				}
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Update Employee Lunch Out value
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 * @param unknown_type $lunch_out_val
		 */
		public function update_lunch_out($comp_id, $emp_id, $employee_time_in_id){
			$date_val = date("Y")."-".date("m")."-".date("d");
			$lunch_out_val = date('Y-m-d H:i:s');
			$sql = $this->db->query("
				UPDATE employee_time_in
				SET lunch_out = '{$lunch_out_val}'
				WHERE comp_id = '{$comp_id}'
				AND emp_id = '{$emp_id}'
				AND employee_time_in_id = '{$employee_time_in_id}'
			");
			
			if($sql){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Update Employee Lunch In value
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 * @param unknown_type $lunch_out_val
		 */
		public function update_lunch_in($comp_id, $emp_id, $employee_time_in_id){
			$date_val = date("Y")."-".date("m")."-".date("d");
			$current_time = date('Y-m-d H:i:s');
			$sql = $this->db->query("
				UPDATE employee_time_in
				SET lunch_in = '{$current_time}'
				WHERE comp_id = '{$comp_id}'
				AND emp_id = '{$emp_id}'
				AND employee_time_in_id = '{$employee_time_in_id}'
			");
			
			if($sql){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Update Employee Time Out value
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 * @param unknown_type $lunch_out_val
		 */
		public function update_time_out($comp_id, $emp_id, $employee_time_in_id, $under_min_val){
			$date_val = date("Y")."-".date("m")."-".date("d");
			$current_time = date('Y-m-d H:i:s');
			$sql = $this->db->query("
				UPDATE employee_time_in
				SET time_out = '{$current_time}', undertime_min = '{$under_min_val}'
				WHERE comp_id = '{$comp_id}'
				AND emp_id = '{$emp_id}'
				AND employee_time_in_id = '{$employee_time_in_id}'
			");
			
			if($sql){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Check Current Time for lunch out and time out
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 * @param unknown_type $min_log
		 */
		public function check_current_time_login($comp_id, $emp_id, $min_log){
			$time_val = date("H:i:s");
			$date_val = date("Y")."-".date("m")."-".date("d");
			$sql = $this->db->query("
				SELECT *FROM employee_time_in
				WHERE comp_id = '{$comp_id}'
				AND emp_id = '{$emp_id}'
				ORDER BY employee_time_in_id DESC
				LIMIT 1
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				$time_in = $row->time_in;
				$lunch_out = $row->lunch_out;
				$lunch_in = $row->lunch_in;
				$time_out = $row->time_out;
				if($lunch_out=="0000-00-00 00:00:00"){
					
					// this is for lunch out
					
					// compute number of minutes
					$startTime = $time_in;
					$endTime = $time_val;
					$minute = floor((strtotime($endTime) - strtotime($startTime)) / 60);
					
					// if no. of minute is greater than $min_log, add new row for employee time in
					if($minute < $min_log){
						return TRUE;
					}else{
						return FALSE;
					}
				}elseif($lunch_out!="0000-00-00 00:00:00" && $time_out=="0000-00-00 00:00:00"){
					
					// this is for time out
					
					// compute number of minutes
					$startTime = $lunch_in;
					$endTime = $time_val;
					$minute = floor((strtotime($endTime) - strtotime($startTime)) / 60);
					
					// if no. of minute is greater than $min_log, add new row for employee time in
					if($minute < $min_log){
						return TRUE;
					}else{
						return FALSE;
					}
				}
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Check Current Time for time in and lunch in
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 * @param unknown_type $min_log
		 */
		public function check_current_time_to_timein_lunchin($comp_id, $emp_id, $min_log){
			$time_val = date("H:i:s");
			$date_val = date("Y")."-".date("m")."-".date("d");
			$sql = $this->db->query("
				SELECT *FROM employee_time_in
				WHERE comp_id = '{$comp_id}'
				AND emp_id = '{$emp_id}'
				ORDER BY employee_time_in_id DESC
				LIMIT 1
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				$time_in = $row->time_in;
				$lunch_out = $row->lunch_out;
				$lunch_in = $row->lunch_in;
				$time_out = $row->time_out;
				if($lunch_in=="0000-00-00 00:00:00"){
					// this is for lunch in
					// compute number of minutes
					$startTime = $lunch_out;
					$endTime = $time_val;
					$minute = floor((strtotime($endTime) - strtotime($startTime)) / 60);
					
					// if no. of minute is greater than $min_log, add new row for employee time in
					if($minute < $min_log){
						return TRUE;
					}else{
						return FALSE;
					}
				}
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Check if time in is not empty
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 */
		public function check_time_in_is_empty($comp_id, $emp_id){
			$sql = $this->db->query("
				SELECT *FROM employee_time_in
				WHERE comp_id = '{$comp_id}'
				AND emp_id = '{$emp_id}'
				ORDER BY employee_time_in_id DESC
				LIMIT 1
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				$time_in = $row->time_in;
				$lunch_out = $row->lunch_out;
				$lunch_in = $row->lunch_in;
				$time_out = $row->time_out;
				
				if($time_in == "0000-00-00 00:00:00" && $lunch_out == "0000-00-00 00:00:00"){
					print $time_in;
					return TRUE;
				}elseif($lunch_out != "0000-00-00 00:00:00" && $lunch_in == "0000-00-00 00:00:00" && $lunch_in == "0000-00-00 00:00:00"){
					return TRUE;
				}else{
					return FALSE;
				}
			}else{
				return TRUE;
			}
		}
		
		/**
		 * Get Employee Time In Information
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 * @param unknown_type $timein_id
		 */
		public function get_timein_info($comp_id, $emp_id, $timein_id){
			$sql = $this->db->query("
				SELECT *FROM employee_time_in
				WHERE comp_id = '{$comp_id}'
				AND emp_id = '{$emp_id}'
				AND employee_time_in_id = '{$timein_id}'
				AND status = 'Active'
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
		 * Update Employee Time In Log
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 * @param unknown_type $employee_timein
		 * @param unknown_type $time_in
		 * @param unknown_type $lunch_out
		 * @param unknown_type $lunch_in
		 * @param unknown_type $time_out
		 * @param unknown_type $reason
		 * @param unknown_type $hours_worked
		 */
		public function update_employee_time_log(
			$comp_id, $emp_id, $employee_timein, $time_in, $lunch_out, $lunch_in, $time_out, $reason, $hours_worked
		){
			if($lunch_out != "0000-00-00 00:00:00" || $lunch_in != "0000-00-00 00:00:00" || $time_out != "0000-00-00 00:00:00"){
				$compute_timein_lunchout = (strtotime($lunch_out) - strtotime($time_in)) / 3600; 
				$compute_lunchin_timeout = (strtotime($time_out) - strtotime($lunch_in)) / 3600;
				$first_hours_worked = round($compute_timein_lunchout,2);
				$second_hours_worked = round($compute_lunchin_timeout,2);
				
				$total_hours_worked = $first_hours_worked + $second_hours_worked;
				if($total_hours_worked > $hours_worked){
					$total_hours_worked = $hours_worked;
				}
			}else{
				$total_hours_worked = "0.00";
			}
			/*
			$sql = $this->db->query("
				UPDATE employee_time_in
				SET time_in = '{$time_in}', lunch_out = '{$lunch_out}', lunch_in = '{$lunch_in}', time_out = '{$time_out}', 
				reason = '{$reason}', tax_status = 'pending', corrected = 'Yes'
				WHERE comp_id = '{$comp_id}'
				AND emp_id = '{$emp_id}'
				AND employee_time_in_id = '{$employee_timein}'
			");
			*/
			$sql = $this->db->query("
				UPDATE employee_time_in
				SET time_in = '{$time_in}', lunch_out = '{$lunch_out}', lunch_in = '{$lunch_in}', time_out = '{$time_out}', 
				reason = '{$reason}', time_in_status = 'pending', corrected = 'Yes', total_hours = '{$total_hours_worked}'
				WHERE comp_id = '{$comp_id}'
				AND emp_id = '{$emp_id}'
				AND employee_time_in_id = '{$employee_timein}'
			");
			if($sql){
				/*
				$sql_2 = $this->db->query("
					SELECT *FROM employee_time_in
					WHERE comp_id = '{$comp_id}'
					AND emp_id = '{$emp_id}'
					AND status = 'Active'
					ORDER BY employee_time_in_id DESC
					LIMIT 1
				");
				if($sql_2->num_rows() > 0){
					
					$row = $sql_2->row();
					$sql_2->free_result();
					if($row->time_in != "0000-00-00 00:00:00" && $row->lunch_out != "0000-00-00 00:00:00" && $row->lunch_in != "0000-00-00 00:00:00" && $row->time_out != "0000-00-00 00:00:00"){
						$compute_timein_lunchout = (strtotime($row->lunch_out) - strtotime($row->time_in)) / 3600; 
						$compute_lunchin_timeout = (strtotime($row->time_out) - strtotime($row->lunch_in)) / 3600;
						$first_hours_worked = round($compute_timein_lunchout,2);
						$second_hours_worked = round($compute_lunchin_timeout,2);
						
						$total_hours_worked = $first_hours_worked + $second_hours_worked;
						$sql_update = $this->db->query("
							UPDATE employee_time_in
							SET total_hours = '{$total_hours_worked}'
							WHERE comp_id = '{$comp_id}'
							AND emp_id = '{$emp_id}'
							AND employee_time_in_id = '{$employee_timein}'
						");
					}else{
					
					}
					
				}
				*/
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Total Hours Worked
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 * @param unknown_type $hours_worked
		 */
		public function total_hours($comp_id, $emp_id, $hours_worked){
			$sql = $this->db->query("
				SELECT *FROM employee_time_in
				WHERE comp_id = '{$comp_id}'
				AND emp_id = '{$emp_id}'
				AND status = 'Active'
				ORDER BY employee_time_in_id DESC
				LIMIT 1
			");
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				
				$compute_timein_lunchout = (strtotime($row->lunch_out) - strtotime($row->time_in)) / 3600; 
				$compute_lunchin_timeout = (strtotime($row->time_out) - strtotime($row->lunch_in)) / 3600;
				$first_hours_worked = round($compute_timein_lunchout,2);
				$second_hours_worked = round($compute_lunchin_timeout,2);
				
				$total_hours_worked = $first_hours_worked + $second_hours_worked;
				if($total_hours_worked > $hours_worked){
					$total_hours_worked = $hours_worked;
				}
				
				$sql_update = $this->db->query("
					UPDATE employee_time_in
					SET total_hours = '{$total_hours_worked}'
					WHERE comp_id = '{$comp_id}'
					AND emp_id = '{$emp_id}'
					AND employee_time_in_id = '{$row->employee_time_in_id}'
				");
				if($sql_update){
					return TRUE;
				}else{
					return FALSE;
				}
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Get Employee Week Day Value
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 * @param unknown_type $weekDay_value
		 */
		public function weekDay_value($comp_id, $emp_id, $weekDay_value){
			/*
			$sql = $this->db->query("
				SELECT *FROM employee_shifts_schedule
				WHERE company_id = '{$comp_id}'
				AND emp_id = '{$emp_id}'
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				$new_weekday_val = $row->$weekDay_value;
				if($new_weekday_val == ""){
					return TRUE;
				}else{
					return FALSE;
				}
			}
			*/
			
			/*
			 * Version 1.0
			$sql = $this->db->query("
				SELECT *FROM employee_shifts_schedule ess
				LEFT JOIN workday w ON ess.payroll_group_id = w.payroll_group_id 
				WHERE ess.company_id = '{$comp_id}'
				AND ess.emp_id = '{$emp_id}'
				AND w.working_day = '{$weekDay_value}'
			");
			
			if($sql->num_rows() > 0){
				$zero = "00:00:00";
				$row = $sql->row();
				$sql->free_result();
				$work_start_time = $row->work_start_time;
				$work_end_time = $row->work_end_time;
				$break_start_time = $row->break_start_time;
				$break_end_time = $row->break_end_time;
				
				if($work_start_time == $zero && $work_end_time == $zero && $break_start_time == $zero && $break_end_time == $zero){
					return TRUE;
				}else{
					return FALSE;
				}
			}
			*/
			
			// for rest day
			$sql = $this->db->query("
				SELECT *FROM employee_shifts_schedule ess
				LEFT JOIN rest_day rd ON ess.payroll_group_id = rd.payroll_group_id 
				WHERE ess.company_id = '{$comp_id}'
				AND ess.emp_id = '{$emp_id}'
				AND rd.rest_day = '{$weekDay_value}'
			");
			
			if($sql->num_rows() > 0){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Get Date Week Day Value
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 * @param unknown_type $weekDay_value
		 */
		public function date_weekDay_value($comp_id, $emp_id, $weekDay_value, $start_time){
			/*
			$sql = $this->db->query("
				SELECT *FROM employee_shifts_schedule
				WHERE company_id = '{$comp_id}'
				AND emp_id = '{$emp_id}'
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				$new_weekday_val = $row->$weekDay_value;
				if($new_weekday_val == ""){
					return "0";
				}else{
					return $new_weekday_val;
				}
			}
			*/
			
			/*
			 * Version 1.0
			$sql = $this->db->query("
				SELECT *FROM employee_shifts_schedule ess
				LEFT JOIN workday w ON ess.payroll_group_id = w.payroll_group_id 
				WHERE ess.company_id = '{$comp_id}'
				AND ess.emp_id = '{$emp_id}'
				AND w.working_day = '{$weekDay_value}'
			");
			
			if($sql->num_rows() > 0){
				$zero = "00:00:00";
				$row = $sql->row();
				$sql->free_result();
				$work_start_time = $row->work_start_time;
				$work_end_time = $row->work_end_time;
				$break_start_time = $row->break_start_time;
				$break_end_time = $row->break_end_time;
				
				if($work_start_time == $zero && $work_end_time == $zero && $break_start_time == $zero && $break_end_time == $zero){
					return "0";
				}else{
					$new_weekday_val = date("h:i:s A",strtotime($work_start_time))."-".date("h:i:s A",strtotime($work_end_time));
					return $new_weekday_val;
				}
			}
			*/
			
			// for rest day return value 0
			$sql = $this->db->query("
				SELECT *FROM employee_shifts_schedule ess
				LEFT JOIN rest_day rd ON ess.payroll_group_id = rd.payroll_group_id 
				WHERE ess.company_id = '{$comp_id}'
				AND ess.emp_id = '{$emp_id}'
				AND rd.rest_day = '{$weekDay_value}'
			");
			
			if($sql->num_rows() > 0){
				return "0";
			}else{

				$zero = "00:00:00";
				
				// for uniform working days
				$sql_uniform_wd = $this->db->query("
					SELECT *FROM employee_shifts_schedule ess
					LEFT JOIN uniform_working_day uwd ON ess.payroll_group_id = uwd.payroll_group_id
					WHERE ess.company_id = '{$comp_id}'
					AND ess.emp_id = '{$emp_id}'
					AND uwd.working_day = '{$weekDay_value}'
				");
				
				if($sql_uniform_wd->num_rows() > 0){

					$row = $sql_uniform_wd->row();
					$sql_uniform_wd->free_result();
					$work_start_time = $row->work_start_time;
					$work_end_time = $row->work_end_time;

					$new_weekday_val = date("h:i:s A",strtotime($work_start_time))."-".date("h:i:s A",strtotime($work_end_time));
					return $new_weekday_val;
				}else{
					// workshift working days
					$sql_workshift = $this->db->query("
						SELECT *FROM employee_shifts_schedule ess
						LEFT JOIN workshift w ON ess.payroll_group_id = w.payroll_group_id
						WHERE ess.company_id = '{$comp_id}'
						AND ess.emp_id = '{$emp_id}'
					");
					
					if($sql_workshift->num_rows() > 0){
						$row_workshift = $sql_workshift->row();
						$sql_workshift->free_result();
						$work_start_time = $row_workshift->start_time;
						$work_end_time = $row_workshift->end_time;
						
						$new_weekday_val = date("h:i:s A",strtotime($work_start_time))."-".date("h:i:s A",strtotime($work_end_time));
						return $new_weekday_val;
					}else{
						// flexible working days
						$new_weekday_val = date("h:i:s A",strtotime($start_time))."-".date("H:i:s",strtotime($start_time) + 60 * 60 * 9); // 9 = company worked hours
						return $new_weekday_val;
					}
				}
			}
		}
		
		/**
		 * Get Employee Shift Schedule Information
		 * @param unknown_type $comp_id
		 * @param unknown_type $day
		 */
		public function get_shift_sched($emp_id,$day){
			/*
			 version 1.0
			 $sql = $this->db->query("
				SELECT *FROM workday w
				LEFT JOIN employee_shifts_schedule ess ON ess.payroll_group_id = w.payroll_group_id
				WHERE ess.emp_id = '{$emp_id}'
				AND w.working_day = '{$day}'
			");
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row->work_start_time;
			}
			*/
			
			/*
			option 1
			$sql = $this->db->query("
				SELECT *FROM employee_shifts_schedule ess
				LEFT JOIN uniform_working_day uwd ON uwd.payroll_group_id = ess.payroll_group_id
				WHERE ess.emp_id = '{$emp_id}'
				AND uwd.working_day = '{$day}'
			");
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row->work_start_time;
			}
			*/
			
			// option 2
			
			// rest day
			$rest_day = $this->db->query("
				SELECT *FROM employee_shifts_schedule ess
				LEFT JOIN rest_day rd ON rd.payroll_group_id = ess.payroll_group_id
				WHERE ess.emp_id = '{$emp_id}'
				AND rd.rest_day = '{$day}'
			");
			
			if($rest_day->num_rows() == 0){
				// uniform working days settings
				$sql = $this->db->query("
					SELECT *FROM employee_shifts_schedule ess
					LEFT JOIN uniform_working_day_settings uwds ON uwds.payroll_group_id = ess.payroll_group_id
					WHERE ess.emp_id = '{$emp_id}'
				");
				if($sql->num_rows() > 0){
					$row = $sql->row();
					$sql->free_result();
					return $row->latest_time_in_allowed;
				}else{
					// uniform working days
					$sql_uniform_working_days = $this->db->query("
						SELECT *FROM employee_shifts_schedule ess
						LEFT JOIN uniform_working_day uwd ON uwd.payroll_group_id = ess.payroll_group_id
						WHERE ess.emp_id = '{$emp_id}'
					");
					
					if($sql_uniform_working_days->num_rows() > 0){
						$row_uniform_working_days = $sql_uniform_working_days->row();
						$sql_uniform_working_days->free_result();
						return $row_uniform_working_days->work_start_time;
					}else{
						// flexible working days
						$sql_flexible_days = $this->db->query("
							SELECT *FROM employee_shifts_schedule ess
							LEFT JOIN flexible_hours fh ON fh.payroll_group_id = ess.payroll_group_id
							WHERE ess.emp_id = '{$emp_id}'
						");
						
						if($sql_flexible_days->num_rows() > 0){
							$row_flexible_days = $sql_flexible_days->row();
							$sql_flexible_days->free_result();
							return $row_flexible_days->latest_time_in_allowed;
						}else{
							// workshift working days
							$sql_workshift = $this->db->query("
								SELECT *FROM employee_shifts_schedule ess
								LEFT JOIN workshift w ON w.payroll_group_id = ess.payroll_group_id
								WHERE ess.emp_id = '{$emp_id}'
							");
							
							if($sql_workshift->num_rows() > 0){
								$row_workshift = $sql_workshift->row();
								$sql_workshift->free_result();
								return $row_workshift->start_time;
							}else{
								return "00:00:00";
							}
						}
					}
				}
			}else{
				return "00:00:00";
			}
			
		}
		
		/**
		 * Get Employee Work End Time
		 * @param unknown_type $emp_id
		 * @param unknown_type $day
		 */
		public function undertime_min($emp_id,$day){
			/*
			Version 1
			$sql = $this->db->query("
				SELECT *FROM workday w
				LEFT JOIN employee_shifts_schedule ess ON ess.payroll_group_id = w.payroll_group_id
				WHERE ess.emp_id = '{$emp_id}'
				AND w.working_day = '{$day}'
			");
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row->work_end_time;
			}
			*/
			
			// rest day
			$rest_day = $this->db->query("
				SELECT *FROM employee_shifts_schedule ess
				LEFT JOIN rest_day rd ON rd.payroll_group_id = ess.payroll_group_id
				WHERE ess.emp_id = '{$emp_id}'
				AND rd.rest_day = '{$day}'
			");
			
			if($rest_day->num_rows() == 0){
				// uniform working days
				$sql_uniform_working_days = $this->db->query("
					SELECT *FROM employee_shifts_schedule ess
					LEFT JOIN uniform_working_day uwd ON uwd.payroll_group_id = ess.payroll_group_id
					WHERE ess.emp_id = '{$emp_id}'
				");
				
				if($sql_uniform_working_days->num_rows() > 0){
					$row_uniform_working_days = $sql_uniform_working_days->row();
					$sql_uniform_working_days->free_result();
					return $row_uniform_working_days->work_end_time;
				}else{
					// flexible working days
					$sql_flexible_days = $this->db->query("
						SELECT *FROM employee_shifts_schedule ess
						LEFT JOIN flexible_hours fh ON fh.payroll_group_id = ess.payroll_group_id
						WHERE ess.emp_id = '{$emp_id}'
					");
					
					if($sql_flexible_days->num_rows() > 0){
						
						$flexible_compute_time = $this->db->query("
							SELECT * FROM `employee_time_in` WHERE emp_id = '{$emp_id}'
							ORDER BY employee_time_in_id DESC
							LIMIT 1
						");
						
						if($flexible_compute_time->num_rows() > 0){
							$row_flexible_compute_time = $flexible_compute_time->row();
							$flexible_compute_time->free_result();
							$time_in = explode(" ", $row_flexible_compute_time->time_in);;
							$flexible_work_end = $time_in[1];
							
							// flexible total hours per day
							$sql_flexible_working_days = $this->db->query("
								SELECT *FROM employee_shifts_schedule ess
								LEFT JOIN flexible_hours fh ON fh.payroll_group_id = ess.payroll_group_id
								WHERE ess.emp_id = '{$emp_id}'
							");
							
							if($sql_flexible_working_days->num_rows() > 0){
								$row_flexible_working_days = $sql_flexible_working_days->row();
								$sql_flexible_working_days->free_result();
								$row_flexible_working_days->total_hours_for_the_day;
							}
							
							//$end_time = date("H:i:s",strtotime($flexible_work_end) + 60 * 60 * 9); // 9 = company worked hours
							$end_time = date("H:i:s",strtotime($flexible_work_end) + 60 * 60 * $row_flexible_working_days);
							return $end_time;
						}else{
							return "00:00:00";
						}
						
					}else{
						// workshift working days
						$sql_workshift = $this->db->query("
							SELECT *FROM employee_shifts_schedule ess
							LEFT JOIN workshift w ON w.payroll_group_id = ess.payroll_group_id
							WHERE ess.emp_id = '{$emp_id}'
						");
						
						if($sql_workshift->num_rows() > 0){
							$row_workshift = $sql_workshift->row();
							$sql_workshift->free_result();
							return $row_workshift->end_time;
						}else{
							return "00:00:00";
						}
					}
				}
			}else{
				return "00:00:00";
			}
		}
		
		/**
		 * Get Total Hours Value
		 * @param unknown_type $emp_id
		 * @param unknown_type $week_day
		 */
		public function total_hours_value($emp_id,$week_day){
			// rest day
			$rest_day = $this->db->query("
				SELECT *FROM employee_shifts_schedule ess
				LEFT JOIN rest_day rd ON rd.payroll_group_id = ess.payroll_group_id
				WHERE ess.emp_id = '{$emp_id}'
				AND rd.rest_day = '{$week_day}'
			");
			
			if($rest_day->num_rows() == 0){
				// uniform working days
				$sql_uniform_working_days = $this->db->query("
					SELECT *FROM employee_shifts_schedule ess
					LEFT JOIN uniform_working_day uwd ON uwd.payroll_group_id = ess.payroll_group_id
					WHERE ess.emp_id = '{$emp_id}'
					AND uwd.working_day = '{$week_day}'
				");
				
				if($sql_uniform_working_days->num_rows() > 0){
					$row_uniform_working_days = $sql_uniform_working_days->row();
					$sql_uniform_working_days->free_result();
					return $row_uniform_working_days->working_hours;
				}else{
					// flexible working days
					$sql_flexible_working_days = $this->db->query("
						SELECT *FROM employee_shifts_schedule ess
						LEFT JOIN flexible_hours fh ON fh.payroll_group_id = ess.payroll_group_id
						WHERE ess.emp_id = '{$emp_id}'
					");
					
					if($sql_flexible_working_days->num_rows() > 0){
						$row_flexible_working_days = $sql_flexible_working_days->row();
						$sql_flexible_working_days->free_result();
						return $row_flexible_working_days->total_hours_for_the_day;
					}else{
						// workshift working days
						$sql_workshift_working_days = $this->db->query("
							SELECT *FROM employee_shifts_schedule ess
							LEFT JOIN workshift w ON w.payroll_group_id = ess.payroll_group_id
							WHERE ess.emp_id = '{$emp_id}'
						");
						
						if($sql_workshift_working_days->num_rows() > 0){
							$row_workshift_working_days = $sql_workshift_working_days->row();
							$sql_workshift_working_days->free_result();
							return $row_workshift_working_days->working_hours;
						}else{
							return 0;
						}
					}
				}
			}else{
				return 0;
			}
		}
		
		/**
		 * Get Holiday Date Informatio		 
		 * @param unknown_type $date_start
		 * @param unknown_type $emp_id
		 * @param unknown_type $comp_id
		 */
		public function get_holiday_date($date_start,$emp_id,$comp_id){
			$new_date_start = date("Y-m-d",strtotime($date_start));
			#$new_date_start = strtotime($date_start);
			$sql = $this->db->query("
				SELECT *FROM holiday
				WHERE company_id = '{$comp_id}'
				AND date = '{$date_start}'
				AND status = 'Active'
			");
			if($sql->num_rows() > 0){
				return true;
				/*
				$results = $sql->result();
				foreach($results as $row){
					$holiday_date = date("Y-m-d",strtotime($row->date));
					#$holiday_date = strtotime($row->date);
					if($new_date_start == $holiday_date){
						return true;	
					}else{
						return false;
					}	
				}
				*/
			}else{
				return false;
			}
		}
		
		/**
		 * Get Return Date Value
		 * @param unknown_type $emp_id
		 * @param unknown_type $date
		 */
		public function get_return_date_val($comp_id,$emp_id,$date){
			// rest day
			$rest_day = $this->db->query("
				SELECT *FROM employee_shifts_schedule ess
				LEFT JOIN rest_day rd ON rd.payroll_group_id = ess.payroll_group_id
				WHERE ess.emp_id = '{$emp_id}'
				AND rd.rest_day = '".date('l',strtotime($date))."'
			");
			
			if($rest_day->num_rows() == 0){
				// uniform working days
				$sql_uniform_working_days = $this->db->query("
					SELECT *FROM employee_shifts_schedule ess
					LEFT JOIN uniform_working_day uwd ON uwd.payroll_group_id = ess.payroll_group_id
					WHERE ess.emp_id = '{$emp_id}'
					AND uwd.working_day = '".date('l',strtotime($date))."'
				");
											
				if($sql_uniform_working_days->num_rows() > 0){
					$row_uniform_working_days = $sql_uniform_working_days->row();
					$sql_uniform_working_days->free_result();
					$uniform_return_date_val = (strtotime(date('H:i:s',strtotime($date))) - strtotime($row_uniform_working_days->work_start_time)) / 3600;
					
					if($uniform_return_date_val<0){
						if(abs($uniform_return_date_val) >= 12){
							return (24-(abs($uniform_return_date_val))) / 8;
						}else{
							return 0;
						}
					}else{
						return $uniform_return_date_val / 8;
					}
				}else{
					// flexible working days
					$sql_flexible_working_days = $this->db->query("
						SELECT *FROM employee_shifts_schedule ess
						LEFT JOIN flexible_hours fh ON fh.payroll_group_id = ess.payroll_group_id
						WHERE ess.emp_id = '{$emp_id}'
					");
					
					if($sql_flexible_working_days->num_rows() > 0){
						$row_flexible_working_days = $sql_flexible_working_days->row();
						$sql_flexible_working_days->free_result();
						$flexible_return_date_val = (strtotime(date('H:i:s',strtotime($date))) - strtotime($row_flexible_working_days->latest_time_in_allowed)) / 3600;
						if($flexible_return_date_val<0){
							if(abs($flexible_return_date_val) >= 12){
								return (24-(abs($flexible_return_date_val))) / 8;
							}else{
								return 0;
							}
						}else{
							return $flexible_return_date_val / 8;
						}
					}else{
						// workshift working days
						$sql_workshift_working_days = $this->db->query("
							SELECT *FROM employee_shifts_schedule ess
							LEFT JOIN workshift w ON w.payroll_group_id = ess.payroll_group_id
							WHERE ess.emp_id = '{$emp_id}'
						");
						
						if($sql_workshift_working_days->num_rows() > 0){
							$row_workshift_working_days = $sql_workshift_working_days->row();
							$sql_workshift_working_days->free_result();
							$workshift_return_date_val = (strtotime(date('H:i:s',strtotime($date))) - strtotime($row_workshift_working_days->start_time)) / 3600;
							if($workshift_return_date_val<0){
								if(abs($workshift_return_date_val) >= 12){
									return (24-(abs($workshift_return_date_val))) / 8;
								}else{
									return 0;
								}
							}else{
								return $workshift_return_date_val / 8;
							}
						}else{
							return 0;
						}
					}
				}
			}else{
				return 0;
			}
		}
		
	}
	
/* End of file employee_model.php */
/* Location: ./application/models/employee_model.php */