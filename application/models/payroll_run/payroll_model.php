<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Payroll_model extends CI_Model {
	
		/**
		 * Employee Lis		 
		 * @param unknown_type $comp_id
		 */
		public function carry_over($comp_id){
			$sql = $this->db->query("			
				SELECT *, e.emp_id as emp_id
				FROM `employee` e
				LEFT JOIN company c ON e.company_id = c.company_id
				LEFT JOIN accounts a ON e.account_id = a.account_id
				LEFT JOIN basic_pay_adjustment b ON e.emp_id = b.emp_id
				WHERE c.company_name = '{$comp_id}'
			");
			
			$result = $sql->result();
			return $result;
		}
		
		/**
		 * Update Carry Over
		 * @param unknown_type $emp_id
		 * @param unknown_type $absences
		 * @param unknown_type $tardiness
		 * @param unknown_type $undertime
		 * @param unknown_type $overtime
		 * @param unknown_type $leave_pay
		 * @param unknown_type $night_differential
		 * @param unknown_type $earnings
		 * @param unknown_type $commission
		 * @param unknown_type $allowance
		 * @param unknown_type $expense
		 * @param unknown_type $loans
		 */
		public function update_carry_over(
			$emp_id,$absences,$tardiness,$undertime,$overtime,$leave_pay,
			$night_differential,$earnings,$commission,$allowance,$expense,$loans
		){
			$sql = $this->db->query("
				UPDATE payroll_carry_over
				SET absences = '{$absences}',tardiness = '{$tardiness}', undertime = '{$undertime}', overtime = '{$overtime}', leave_pay = '{$leave_pay}',
				night_differential = '{$night_differential}', earnings = '{$earnings}', commission = '{$commission}', allowance = '{$allowance}',
				expense = '{$expense}', loans = '{$loans}'
				WHERE emp_id = '$emp_id'
			");
			
			return false;
		}
	
	}