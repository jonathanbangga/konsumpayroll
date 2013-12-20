<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*	Helper : Employee helpers
*	Author : Jonathan Bangga <jonathanbangga@gmail.com>
*	Usage  : Employee Only
*/

	/**
	 * Employee Total Loan Balance
	 */
	function loan_balance($comp_id, $emp_id, $loan_no){
		$CI =& get_instance();
		// Total Loan Amount
			$total_loan_amount = $CI->employee->total_loan_amount($comp_id, $loan_no);
			if($total_loan_amount != FALSE){
				$amortization_sched_interest = 0;
				$amortization_sched_principal = 0;
				foreach($total_loan_amount as $row_amor){
					// Interest Total Amount for Amortization Schedule
					$amortization_sched_interest = $amortization_sched_interest + $row_amor->interest;
					
					// Principal Total Amount for Amortization Schedule
					$amortization_sched_principal = $amortization_sched_principal + $row_amor->principal;
				}
				#return $installment;
				// Installment for Amortization Schedule
				$installment = $amortization_sched_interest + $amortization_sched_principal;
			}else{
				return "No Amortization Schedule found";
				return false;
			}
		
			// 	Total Payment History
			$total_payment_history = $CI->employee->emp_payment_history($comp_id, $loan_no);
			if($total_payment_history != FALSE){
				$interest_val = 0;
            	$principal_val = 0;
				foreach($total_payment_history as $row){
					// Interest Total Amount
					$interest_val = $interest_val + $row->interest;
					
					// Principal Total Amount
					$principal_val = $principal_val + $row->principal;
				}
				
				// New Total Payment History
				$new_total_payment = $interest_val + $principal_val;
			}else{
				return "No Payment History found";
				return false;
			}
			
			#return $CI->db->last_query();
			$loan_balance = $installment - $new_total_payment; 
			// return $installment." - ".$new_total_payment." = ".$loan_balance;
			return number_format($loan_balance,2);
	}
