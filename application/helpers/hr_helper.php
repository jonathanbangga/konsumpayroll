<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * View table group amortization schedule
	 * @param unknown_type $emp_loan_id
	 * @param unknown_type $employee_amortization_schedule_group
	 * @param unknown_type $loan_amount_child
	 */
	function view_table_group_amortization($emp_loan_id,$employee_amortization_schedule_group,$loan_amount_child){
		$CI =& get_instance();
		
		$check_sql = $CI->db->query("
			SELECT *FROM employee_amortization_schedule
			WHERE emp_loan_id = '{$emp_loan_id}'
			GROUP BY employee_amortization_schedule_group
			ORDER BY employee_amortization_schedule_group DESC
			LIMIT 1
		");
		
		$last_row = $check_sql->row();
		
		$table = '<p>Loan Amount: '.number_format($loan_amount_child, 2).'</p>
			<table style="width:930px;" class="tbl emp_conList">
	            <tbody><tr>
	              <th style="width:50px;"></th>
	              <th>Payroll Date</th>
	              <th>Principal</th>
	              <th>Interest</th>
	              <th>Installment</th>
	              <th>Loan Balance</th>
	              <th style="width:170px">Action</th>
	            </tr>
		';
		
		$sql = $CI->db->query("
			SELECT *FROM employee_amortization_schedule
			WHERE emp_loan_id = '{$emp_loan_id}'
			AND employee_amortization_schedule_group = '{$employee_amortization_schedule_group}'
		");
		
		$counter = 1;
        $zero_value = 0;
        
        foreach($sql->result() as $row){
			$zero_value = $zero_value + $row->principal;
			$total_loan_balance = $loan_amount_child - $zero_value;
			if($last_row->employee_amortization_schedule_group == $row->employee_amortization_schedule_group){
				$employee_amortization_schedule_group = '
					<a href="javascript:void(0);" class="btn btn-gray btn-action editBtnDb" employee_amortization_schedule_id="'.$row->employee_amortization_schedule_id.'" >EDIT</a> 
	              	<a href="javascript:void(0);" class="btn btn-red btn-action delBtnDb" employee_amortization_schedule_id="'.$row->employee_amortization_schedule_id.'" >DELETE</a>
				';	
			}else{
				$employee_amortization_schedule_group = '
					<a href="javascript:void(0);" class="btn btn-gray btn-action" style="opacity:.5;">EDIT</a> 
	              	<a href="javascript:void(0);" class="btn btn-red btn-action" style="opacity:.5;">DELETE</a>
				';
			}
			
			$table .= '
				<tr>
	              <td>'.$counter++.'</td>
	              <td>'.$row->payroll_date.'</td>
	              <td>'.number_format($row->principal, 2).'</td>
	              <td>'.number_format($row->interest, 2).'</td>
	              <td>'.number_format($row->payment, 2).'</td>
	              <td>'.number_format($total_loan_balance, 2).'</td>
	              <td>'.$employee_amortization_schedule_group.'</td>
	            </tr>
			';
        }
        
        $table .= '
        	</tbody></table>
        ';
		
		return $table;
	}
	
	
	/**
	 * View table payment group history
	 * @param unknown_type $employee_loans_id
	 * @param unknown_type $employee_amortization_schedule_group
	 */
	function view_table_group_payment_history($employee_loans_id, $employee_amortization_schedule_group, $loan_amount_child){
		$CI =& get_instance();
		$table = '<p>Loan Amount: '.number_format($loan_amount_child, 2).'</p>
			<table style="width:1440px;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:50px;"></th>
              <th class="adj_row" style="width:170px;">Payment</th>
              <th class="adj_row" style="width:170px;">Interest</th>
              <th class="adj_row" style="width:170px;">Principal</th>
              <th class="adj_row" style="width:170px">Penalty</th>
              <th class="adj_row cred_bal_prin_column" style="width:170px;">Credit Balance on Principal</th>
              <th class="adj_row" style="width:170px;">Loan Balance</th>
              <th style="width:170px">Action</th>
            </tr>
		';
		
		$sql = $CI->db->query("
			SELECT *FROM employee_payment_history
			WHERE employee_loans_id = '{$employee_loans_id}'
			AND employee_amortization_schedule_group = '{$employee_amortization_schedule_group}'
			AND status = 'Active' 
		");
		
			// last row for amortization schedule group
			$last_row_for_amortization_sched_group = $CI->db->query("
				SELECT *
				FROM employee_amortization_schedule
				WHERE emp_loan_id = '{$employee_loans_id}'
				AND STATUS = 'Active'
				GROUP BY employee_amortization_schedule_group
				ORDER BY employee_amortization_schedule_group DESC
				LIMIT 1
			");
			
			// display last row for payment history fields
			$row_last_row_for_amortization_sched_group = $last_row_for_amortization_sched_group->row();
			$val_last_row_for_amortization_sched_group = $row_last_row_for_amortization_sched_group->employee_amortization_schedule_group;
			
			$sql_total_principal_amortization = $CI->db->query("
				SELECT 
				*FROM employee_amortization_schedule
				WHERE emp_loan_id = '{$employee_loans_id}'
				AND employee_amortization_schedule_group = '{$employee_amortization_schedule_group}'
				AND status = 'Active'
				GROUP BY employee_amortization_schedule_group
			");
			$row_total_principal_amortization = $sql_total_principal_amortization->row();
			$total_principal_amortization = $row_total_principal_amortization->loan_amount_child;
		
			// for last row amortization schedule
			$last_row_amortization_sched = $CI->db->query("
				SELECT *
				FROM employee_payment_history
				WHERE employee_loans_id = '{$employee_loans_id}'
				AND employee_amortization_schedule_group = '{$employee_amortization_schedule_group}'
				ORDER BY employee_payment_history_id DESC
				LIMIT 1 
			");
			
			if($last_row_amortization_sched->num_rows() > 0){
				$row_last_row = $last_row_amortization_sched->row();
				$last_row_amortization_sched->free_result();
				$last_row_payment = $row_last_row->employee_payment_history_id;
			}
			
			// display last row amortization schedule
			if($val_last_row_for_amortization_sched_group == $employee_amortization_schedule_group){
				// Get Interest and Principal Value
				$get_kapila_ka_row = $CI->db->query("
					SELECT 
					*FROM employee_payment_history
					WHERE employee_loans_id = '{$employee_loans_id}'
					AND employee_amortization_schedule_group = '{$employee_amortization_schedule_group}'
					AND status = 'Active'
				"); 
				
				if($get_kapila_ka_row->num_rows() > 0){
					$kapila_ka_row_res = $get_kapila_ka_row->num_rows() + 1;
				}else{
					$kapila_ka_row_res = 1;
				}
				
				$check_num_rows_for_amortization_sched = $CI->db->query("
					SELECT 
					*FROM employee_amortization_schedule
					WHERE emp_loan_id = '{$employee_loans_id}'
					AND employee_amortization_schedule_group = '{$employee_amortization_schedule_group}'
					AND status = 'Active'
				");
				
				$get_interest_principal = $CI->db->query(
					"
						SELECT 
						*FROM employee_amortization_schedule
						WHERE emp_loan_id = '{$employee_loans_id}'
						AND employee_amortization_schedule_group = '{$employee_amortization_schedule_group}'
						AND status = 'Active'
						LIMIT {$kapila_ka_row_res},1
					"
				);
				
				/*
				if($check_num_rows_for_amortization_sched->num_rows() == 1){
					$get_interest_principal = $CI->db->query(
						"
							SELECT 
							*FROM employee_amortization_schedule
							WHERE emp_loan_id = '{$employee_loans_id}'
							AND employee_amortization_schedule_group = '{$employee_amortization_schedule_group}'
							AND status = 'Active'
							LIMIT {$kapila_ka_row_res},1
						"
					);
				}else{
					$get_interest_principal = $CI->db->query(
						"
							SELECT 
							*FROM employee_amortization_schedule
							WHERE emp_loan_id = '{$employee_loans_id}'
							AND employee_amortization_schedule_group = '{$employee_amortization_schedule_group}'
							AND status = 'Active'
							LIMIT {$kapila_ka_row_res},1
						"
					);
				}
				*/
				
				// interest and principal value
				$row_get_interest_principal = $get_interest_principal->row();
				if($get_interest_principal->num_rows() > 0){
					$get_interest_principal->free_result();
					
					$interest_value = $row_get_interest_principal->interest;
					$principal_value = $row_get_interest_principal->principal;
					$employee_amortization_schedule_id = $row_get_interest_principal->employee_amortization_schedule_id;
				}else{
					// if balance is less than 0
					$interest_value = "";
					$principal_value = "";
					$employee_amortization_schedule_id = "";
				}
			}else{
				$interest_value = "";
				$principal_value = "";
			}
			
			// for debit amount
			
			$sql_debit_amount = $CI->db->query("
				SELECT *
				FROM `employee_payment_history`
				WHERE employee_loans_id = '{$employee_loans_id}'
				AND employee_amortization_schedule_group = '{$employee_amortization_schedule_group}'
				AND status = 'Active'
				ORDER BY employee_payment_history_id DESC
				LIMIT 1
			");
			$row_debit_amount = $sql_debit_amount->row();
			if($sql_debit_amount->num_rows() > 0){
				$sql_debit_amount->free_result();
				$debit_amount = $row_debit_amount->remaining_cash_amount;
			}else{
				$debit_amount = 0;
			}
			
			// for total remaining balance
			if($debit_amount == 0){
				$new_remaining_cash_amount = $debit_amount;
			}else{
				// Total Remaining Cash Amount
            	$total_debit_amount_value = $debit_amount - $interest_value;
            	
            	/*
				// Compute New Principal Amount and New Interest Amount
            	if($total_debit_amount_value > 0){
            		$interest_value = 0;
            		
            		// Total Principal is greater than Remaining Cash Amount 
            		if($principal_value >= $total_debit_amount_value){
            			$principal_value = $principal_value - $total_debit_amount_value;
            			// Compute New Remaining Cash Amount
            			$new_remaining_cash_amount = 0;
            		}else{
            			// Total Remaining Cash Amount is greater than Principal
            			 $new_remaining_cash_amount = $total_debit_amount_value - $principal_value;
            			 $principal_value = 0;
            		}
            	}else{
            		// new remaining cash amount value
            		$new_remaining_cash_amount = 0;
            		
            		// Returns the absolute value of number or convert to positive integer
					// if total remaining cash amount is less than 0 then total ramaining cash amount value will be add on principal value
            		$principal_value = abs($debit_amount - $principal_value);
            		
            		// Returns the absolute value of number or convert to positive integer
					$interest_value = abs($total_debit_amount_value);
            	}*/
				
            	// Total Remaining Cash Amount
            	$total_debit_amount_value = $debit_amount - $interest_value;
            	
            	// Compute New Interest Amount
            	if($total_debit_amount_value > 0){
            		$interest_value = 0;
            	}else{
            		// Returns the absolute value of number or convert to positive integer
					// $interest_value = abs($total_debit_amount_value);
					
            		$principal_value = $principal_value - $debit_amount;
            		
					// new remaining cash amount value
            		$new_remaining_cash_amount = 0;
            	}
            	
            	// Compute New Principal Amount
            	if($total_debit_amount_value > 0){
            		// Total Principal is greater than Remaining Cash Amount
            		if($principal_value >= $total_debit_amount_value){
            			$principal_value = $principal_value - $total_debit_amount_value;
            			// Compute New Remaining Cash Amount
            			$new_remaining_cash_amount = 0;
            		}else{
            			// Total Remaining Cash Amount is greater than Principal
            			 $new_remaining_cash_amount = $total_debit_amount_value - $principal_value;
            			 $principal_value = 0;
            		}
            	}
			}
			
		if($sql->num_rows() > 0){
			
			// variables
			$counter = 1;
			$credit_balance_principal = 0;
			$interest_val = 0;
			$principal_val = 0;
			$flag = ""; // if flag is equal to empty then display payment fields else create new amortization schedule
			
			foreach($sql->result() as $row){
				
				// Get Principal from Amortization Schedule
				
				$sql_principal_amor_sched = $CI->db->query("
					SELECT *
					FROM `employee_amortization_schedule`
					WHERE employee_amortization_schedule_id = '{$row->employee_amortization_schedule_id}'
					AND status = 'Active'
				");
				
				$row_principal_amor_sched = $sql_principal_amor_sched->row();
				
				// For Credit Balance On Principal
				$credit_balance_principal = ($credit_balance_principal + $row_principal_amor_sched->principal);
				$balance_principal =  $total_principal_amortization - $credit_balance_principal - $row->remaining_cash_amount;
				//$balance_principal =  $total_principal_amortization ."-". $credit_balance_principal ."-". $row->remaining_cash_amount;
				
				// Interest Total Amount
				// $interest_val = $interest_val + $row->interest;
				$interest_val = $interest_val + $row_principal_amor_sched->interest;
				
				// Principal Total Amount
				// $principal_val = $principal_val + $row->principal;
				$principal_val = $principal_val + $row_principal_amor_sched->principal;
				
				// For Loan Balance
				// $loan_balance = $total_principal_amortization - ( $interest_val + $principal_val);				
				$loan_balance = $total_principal_amortization - ( $interest_val + $principal_val) - $row->remaining_cash_amount;

				if($row->employee_payment_history_id == $last_row_payment){
					$action_btn = '<a href="javascript:void(0);" class="btn btn-gray btn-action editBtnDb" employee_payment_history_id="'.$row->employee_payment_history_id.'" >EDIT</a>';
				}else{
					$action_btn = '';
				}
			
				// for credit balance
				
				$new_amortization_schedule_btn = '';
				
				if($row->employee_payment_history_id == $last_row_payment){
					$last_credit_balance = $balance_principal + $row->principal;
					$check_credit_balance = $last_credit_balance * .5; // * 50%;

					if($row->payment >= $check_credit_balance){
						// display new amortization schedule fields
						$check_fifty_percent = $last_credit_balance + $row->interest - $row->payment;
						$num_format_checl_fifty_percent = number_format($check_fifty_percent,2) - number_format($row->principal,2);
						if($num_format_checl_fifty_percent < 0){
							$flag = 1; // if flag is equal to empty then display payment fields else create new amortization schedule
							// $new_amortization_schedule_btn = '<a '.$check_fifty_percent.' style="width:177px;" href="javascript:void(0);" class="btn new_amor_sched_btn">CREATE NEW AMORTIZATION SCHEDULE</a>';	
							$new_amortization_schedule_btn = "<span class='new_amortization_flag ihide'>1</span><span class='new_bal_prin ihide'>".$balance_principal."</span>";
						}
					}
					
					$installment_val = $row->interest + $row->principal;
					$total_last_credit_balance = $last_credit_balance + $row->interest;
					$table .= "<span class='installment_val ihide'>{$installment_val}<br/></span>";
					$table .= "<span class='last_credit_balance ihide'>{$last_credit_balance} + {$row->interest} = {$total_last_credit_balance}<br/></span>";
				}
				
				// for layout
				if($flag == ""){ // if flag is equal to empty then display payment fields else create new amortization schedule
					
					// for css and jquery
					$table .= '
						<style>
              	  			.txtfield, .txtselect, .txtarea, .cusfield{width: 80px;}
              	  			.emp_conList {width: auto!important;}
              	  		</style>
					';
					
				}else{
					$table .= '
						<style>
              	  			.txtfield, .txtselect, .txtarea, .cusfield{width: 80px;}
              	  			.emp_conList {width: 933px!important;}
              	  			.adj_row {width: 80px!important;}
              	  		</style>
              	  		<script>
							function remove_save_btn(){
								jQuery(".saveBtn").hide();
							}
							jQuery(function(){
								remove_save_btn();
							});
              	  		</script>
					';
				}
				
				// payment history list
				$table .= '
					<tr class="payment_row_cont">
					  <td>'.$counter++.'</td>
					  <td>'.number_format($row->payment, 2).'</td>
					  <td>'.number_format($row->interest, 2).'</td>
					  <td>'.number_format($row->principal, 2).'</td>
					  <td>'.number_format($row->penalty, 2).'</td>
					  <td>
		              	<span class="ihide">'.$total_principal_amortization." - ".$credit_balance_principal." = ".'</span>
		              	'.number_format($balance_principal, 2).'
	              	  </td>
					  <td>'.number_format($loan_balance, 2).'</td>
					  <td style="width: 275px;">'.$action_btn.$new_amortization_schedule_btn.'</td>
					</tr>
				';
				
			}
			
			if($flag == ""){ // if flag is equal to empty then display payment fields else create new amortization schedule
				
				// add new amortization schedule row
				if($val_last_row_for_amortization_sched_group == $employee_amortization_schedule_group){
					
					/*
					$new_installment_value = $interest_value + $principal_value; 
					$table .= '
						<tr>
						    <td>
						    	<input readonly="readonly" type="text" name="loan_no[]" class="ihide txtfield" value="'.$employee_loans_id.'" />
						    	<input readonly="readonly" type="text" name="amortization_schedule_group[]" class="ihide txtfield" value="'.$employee_amortization_schedule_group.'" />
						    	<input readonly="readonly" type="text" name="employee_amortization_schedule_id[]" class="ihide txtfield" value="'.$employee_amortization_schedule_id.'" />
						    </td>
						    <td><input type="text" name="payment[]" class="payment txtfield"></td>
						    <td><input type="text" readonly="readonly" name="interest[]" class="interest txtfield" value="'.$interest_value.'" /></td>
						    <td><input type="text" readonly="readonly" name="principal[]" class="principal txtfield" value="'.$principal_value.'" /></td>
						    <td><input type="text" name="penalty[]" class="penalty txtfield"></td>
						    <td>
						    	<span class="ihide">Installment:
							    '.$interest_value." + ".$principal_value.'
							    	<input type="text" name="installment_value[]" style="width:auto;" value="'.$new_installment_value.'">
					            </span>
				            </td>
						    <td><span class="ihide">Remaining Cash Amount: '.$debit_amount.'</span></td>
						    <td>
						    	<span class="ihidea">New Cash Amount:
							    	<input type="text" name="remaining_cash_amount[]" style="width:auto;" value="'.$new_remaining_cash_amount.'" />
							    </span>
						    </td>
					    </tr>
					';
					*/
					
					if( ($interest_value != "" && $principal_value != "")){
						if($balance_principal > 0){
							$new_installment_value = $interest_value + $principal_value;
							$table .= '
								<tr>
								    <td>
								    	<input readonly="readonly" type="text" name="loan_no[]" class="ihide txtfield" value="'.$employee_loans_id.'" />
								    	<input readonly="readonly" type="text" name="amortization_schedule_group[]" class="ihide txtfield" value="'.$employee_amortization_schedule_group.'" />
								    	<input readonly="readonly" type="text" name="employee_amortization_schedule_id[]" class="ihide txtfield" value="'.$employee_amortization_schedule_id.'" />
								    </td>
								    <td><input type="text" name="payment[]" class="payment txtfield"></td>
								    <td><input type="text" readonly="readonly" name="interest[]" class="interest txtfield" value="'.$interest_value.'" /></td>
								    <td><input type="text" readonly="readonly" name="principal[]" class="principal txtfield" value="'.$principal_value.'" /></td>
								    <td><input type="text" name="penalty[]" class="penalty txtfield"></td>
								    <td>
								    	<span class="ihide">Installment:
									    '.$interest_value." + ".$principal_value.'
									    	<input type="text" name="installment_value[]" style="width:auto;" value="'.$new_installment_value.'">
							            </span>
						            </td>
								    <td><span class="ihide">Remaining Cash Amount: '.$debit_amount.'</span></td>
								    <td>
								    	<span class="ihide">New Cash Amount:
									    	<input type="text" name="remaining_cash_amount[]" style="width:auto;" value="'.$new_remaining_cash_amount.'" />
									    </span>
								    </td>
							    </tr>
							';
						}
					}else{
						$table .= '
	              	  		<script>
								function new_remove_save_btn(){
									jQuery(".saveBtn").remove();
								}
								jQuery(function(){
									new_remove_save_btn();
								});
	              	  		</script>
						';
					}
				}
			}

		}else{
			
			// table is empty, get the first row for amortization schedule
			if($val_last_row_for_amortization_sched_group == $employee_amortization_schedule_group){
				$table .= '
              	  		<script>
							function remove_save_btn(){
								jQuery(".saveBtn").fadeIn("100");
							}
							jQuery(function(){
								remove_save_btn();
							});
              	  		</script>
					';
				
				// remove last row if balance is less than 0
				if( ($interest_value != NULL || $principal_value != NULL) || ($interest_value != "" || $principal_value != "") ){
					$new_installment_value = $interest_value + $principal_value;
					$table .= '
						<tr>
						    <td>
						    	<input readonly="readonly" type="text" name="loan_no[]" class="ihide txtfield" value="'.$employee_loans_id.'" />
						    	<input readonly="readonly" type="text" name="amortization_schedule_group[]" class="ihide txtfield" value="'.$employee_amortization_schedule_group.'" />
						    	<input readonly="readonly" type="text" name="employee_amortization_schedule_id[]" class="ihide txtfield" value="'.$employee_amortization_schedule_id.'" />
					    	</td>
						    <td><input type="text" name="payment[]" class="payment txtfield"></td>
						    <td><input type="text" readonly="readonly" name="interest[]" class="interest txtfield" value="'.$interest_value.'" /></td>
						    <td><input type="text" readonly="readonly" name="principal[]" class="principal txtfield" value="'.$principal_value.'" /></td>
						    <td><input type="text" name="penalty[]" class="penalty txtfield"></td>
						    <td>
						    	<span class="ihide">Installment:
							    '.$interest_value." + ".$principal_value.'
							    	<input type="text" name="installment_value[]" style="width:auto;" value="'.$new_installment_value.'">
					            </span>
				            </td>
						    <td><span class="ihide">Remaining Cash Amount: '.$debit_amount.'</span></td>
						    <td>
						    	<span class="ihide">New Cash Amount:
							    	<input type="text" name="remaining_cash_amount[]" style="width:auto;" value="'.$new_remaining_cash_amount.'" />
							    </span>
						    </td>
					    </tr>
					';
				}else{
					$table .= '
              	  		<script>
							function new_remove_save_btn(){
								jQuery(".saveBtn").remove();
							}
							jQuery(function(){
								new_remove_save_btn();
							});
              	  		</script>
					';
				}
			}
		}
		
		$table .= '
        	</tbody></table>
        ';
		
		return $table;
	}
	
	/**
	 * Get Overtime
	 * @param unknown_type $emp_id
	 * @info, visit http://www.laborlaw.usc-law.org/2010/02/23/overtime-pay/
	 */
	function get_overtime_emp($emp_id){
		$CI =& get_instance();
		
		// company payroll period, period from and period to
		
		$sql_payroll_period = $CI->db->query("
			SELECT *
			FROM `payroll_period` pp
			LEFT JOIN employee e ON pp.company_id = e.company_id
			WHERE e.emp_id = '{$emp_id}' 
		");
		
		$row_payroll_period = $sql_payroll_period->row();
		
		$mininum_wage_rate = "";
		$working_hours = "";
		$no_of_days = "";
		$regular_hourly_rate = "";
		
		// check if workday is uniform working days, get the total working days per year
		/* $sql_uniform_working_days = $CI->db->query("
			SELECT *
			FROM `employee_overtime_application` eoa
			LEFT JOIN uniform_working_day_settings uwds ON eoa.company_id = uwds.company_id
			LEFT JOIN uniform_working_day uwd ON uwds.company_id = uwd.company_id
			WHERE eoa.emp_id = '{$emp_id}'
			AND overtime_status = 'Approved'
			GROUP BY uwds.total_working_days_per_year
		");
		
		// get number of days
		$row_uniform_working_days = $sql_uniform_working_days->row();
		if($sql_uniform_working_days->num_rows() > 0){
			$sql_uniform_working_days->free_result();
			
			if($row_uniform_working_days->total_working_days_per_year != null || $row_uniform_working_days->working_hours != ""){
				// for uniform working days
				$no_of_days = $row_uniform_working_days->total_working_days_per_year / 12; // 12 = months
				$working_hours = $row_uniform_working_days->working_hours;
			}
		} */
		
		// check if workday is workshit schedule
		$sql_workshift = $CI->db->query("
			SELECT *
			FROM `employee_overtime_application` eoa
			LEFT JOIN workshift_settings ws ON eoa.company_id = ws.company_id
			LEFT JOIN workshift w ON ws.company_id = w.company_id
			WHERE eoa.emp_id = '{$emp_id}'
			AND overtime_status = 'Approved'
			GROUP BY ws.total_working_days_per_year
		");
		
		$row_workshift = $sql_workshift->row();
		if($sql_workshift->num_rows() > 0){
			$sql_workshift->free_result();
			
			if($row_workshift->total_working_days_per_year != null || $row_workshift->working_hours != ""){
				// for workshift
				$no_of_days = $row_workshift->total_working_days_per_year / 12; // 12 = months
				$working_hours = $row_workshift->working_hours;
			}
		}
		
		// check if workday is flexible hours
		$sql_flexible_hours = $CI->db->query("
			SELECT *
			FROM `employee_overtime_application` eoa
			LEFT JOIN flexible_hours fh ON eoa.company_id = fh.company_id
			WHERE eoa.emp_id = '{$emp_id}'
			AND overtime_status = 'Approved'
			GROUP BY fh.total_days_per_year
		");
		
		$row_flexible_hours = $sql_flexible_hours->row();
		if($sql_flexible_hours->num_rows() > 0){
			$sql_flexible_hours->free_result();
			
			if($row_flexible_hours->total_days_per_year != null){
				// for flexible hours
				$no_of_days = $row_flexible_hours->total_days_per_year / 12; // 12 = months
				$working_hours = $row_flexible_hours->total_hours_for_the_day;
			}
		}
		
		if($no_of_days != "" && $working_hours != ""){
			// get mininum wage rate for employee
			$sql_minimum_wage_rate = $CI->db->query("
				SELECT *
				FROM `basic_pay_adjustment`
				WHERE emp_id = '{$emp_id}'
				AND status = 'Active'
				AND deleted = '0'
			");
			
			$row_minimum_wage_rate = $sql_minimum_wage_rate->row();
			if($sql_minimum_wage_rate->num_rows() > 0){
				$sql_minimum_wage_rate->free_result();
				$effective_date = strtotime(date("Y-m-d",strtotime($row_minimum_wage_rate->effective_date)));
				$current_date = strtotime(date("Y-m-d"));
				if($effective_date < $current_date){
					$current_basic_pay = $row_minimum_wage_rate->current_basic_pay;
				}else{
					$current_basic_pay = $row_minimum_wage_rate->new_basic_pay;
				}
				
				$mininum_wage_rate = $current_basic_pay / $no_of_days;
			}else{
				$current_basic_pay = 0;
				$mininum_wage_rate = 0;
			}
			
			// get regular hours type
			
			$regular_hourly_rate = number_format($mininum_wage_rate, 2) / number_format($working_hours, 2);
		}
		
		// ===========================
		
		if($sql_payroll_period->num_rows() > 0){
			$period_from = $row_payroll_period->period_from;
			$period_to = $row_payroll_period->period_to;
			
			// check payroll period, datefrom to dateto
			
			$sql_check_overtime_payroll_period = $CI->db->query("
				SELECT *
				FROM employee_overtime_application
				WHERE overtime_from >= '{$period_from}'
				AND overtime_to <= '{$period_to}'
				AND emp_id = '{$emp_id}'
			");
			
			$row_check_overtime_payroll_period = $sql_check_overtime_payroll_period->result();
			if($sql_check_overtime_payroll_period->num_rows() > 0){
				$sql_check_overtime_payroll_period->free_result();
				$overtime_value = "";
				foreach($row_check_overtime_payroll_period as $row){
					
					$workday_val = date('l',strtotime($row->overtime_from));
					
					// check if workday is uniform working days, get the total working days per year
					$sql_uniform_working_days = $CI->db->query("	
						SELECT *
						FROM `employee_overtime_application` eoa
						LEFT JOIN uniform_working_day_settings uwds ON eoa.company_id = uwds.company_id
						LEFT JOIN uniform_working_day uwd ON uwds.company_id = uwd.company_id
						WHERE eoa.emp_id = '{$emp_id}'
						AND overtime_status = 'Approved'
						AND uwd.working_day = '{$workday_val}'
						GROUP BY uwd.working_day
					");
					
					// get number of days
					$row_uniform_working_days = $sql_uniform_working_days->row();
					if($sql_uniform_working_days->num_rows() > 0){
						$sql_uniform_working_days->free_result();
						
						if($row_uniform_working_days->total_working_days_per_year != null || $row_uniform_working_days->working_hours != ""){
							// for uniform working days
							$no_of_days = $row_uniform_working_days->total_working_days_per_year / 12; // 12 = months
							$working_hours = $row_uniform_working_days->working_hours;
							
							// get mininum wage rate for employee
							$sql_minimum_wage_rate = $CI->db->query("
								SELECT *
								FROM `basic_pay_adjustment`
								WHERE emp_id = '{$emp_id}'
								AND status = 'Active'
								AND deleted = '0'
							");
							
							$row_minimum_wage_rate = $sql_minimum_wage_rate->row();
							if($sql_minimum_wage_rate->num_rows() > 0){
								$sql_minimum_wage_rate->free_result();
								$effective_date = strtotime(date("Y-m-d",strtotime($row_minimum_wage_rate->effective_date)));
								$current_date = strtotime(date("Y-m-d"));
								if($effective_date < $current_date){
									$current_basic_pay = $row_minimum_wage_rate->current_basic_pay;
								}else{
									$current_basic_pay = $row_minimum_wage_rate->new_basic_pay;
								}
								
								$mininum_wage_rate = $current_basic_pay / $no_of_days;
							}else{
								$current_basic_pay = 0;
								$mininum_wage_rate = 0;
							}
							
							// get regular hours type
							
							$regular_hourly_rate = number_format($mininum_wage_rate, 2) / number_format($working_hours);
						}
					}
					
					$num_of_hours = $row->no_of_hours;
					$overtime_from_value = $row->overtime_from;
					$pay_rate = "";
					$ot_rate = "";
					
					// check if workday is holiday
					$sql_check_holiday = $CI->db->query("
						SELECT *,ht.pay_rate as pay_rate
						FROM `holiday` h
						LEFT JOIN `hours_type` ht ON h.hour_type_id = ht.hour_type_id
						LEFT JOIN overtime_type ot ON ht.hour_type_id = ot.hour_type_id
						WHERE h.date = '{$overtime_from_value}'
					");
					
					$row_check_holiday = $sql_check_holiday->row();
					if($sql_check_holiday->num_rows() > 0){
						
						$sql_check_holiday->free_result();
						
						// if overtime workday falls on regular holiday
						$pay_rate = $row_check_holiday->pay_rate;
						$ot_rate = $row_check_holiday->ot_rate;
						
						// compute new regular hourly rate
						$sub_regular_hourly_rate = (number_format($mininum_wage_rate, 2) / number_format($working_hours)) * ($pay_rate / 100);
						$regular_hourly_rate = $sub_regular_hourly_rate + (($ot_rate / 100) * $sub_regular_hourly_rate);
					}
					
					// ========================================================================================================
					
					// check if workday is rest day
					$sql_check_rest_day = $CI->db->query("
						SELECT *
						FROM `rest_day`
						WHERE rest_day = '".date('l',strtotime($overtime_from_value))."'
						AND company_id = '{$row->company_id}'
					");
						
					$row_check_rest_day = $sql_check_rest_day->row();
					if($sql_check_rest_day->num_rows() > 0){
						
						$sql_check_rest_day->free_result();
						
						// On a rest day which falls on a regular holiday or special holiday

						$sql_rest_day_regular_holiday = $CI->db->query("
							SELECT *,ht.pay_rate as pay_rate, ht.hour_type_name as hour_type_name 
							FROM `holiday` h
							LEFT JOIN `hours_type` ht ON h.hour_type_id = ht.hour_type_id
							LEFT JOIN overtime_type ot ON ht.hour_type_id = ot.hour_type_id
							WHERE h.date = '{$overtime_from_value}'
						");
						
						$row_rest_day_regular_holiday = $sql_rest_day_regular_holiday->row();
						if($sql_rest_day_regular_holiday->num_rows() > 0){
							$sql_rest_day_regular_holiday->free_result();
							
							// On a rest day which falls on a regular holiday
							$pay_rate = $row_rest_day_regular_holiday->pay_rate;
							$ot_rate = $row_rest_day_regular_holiday->ot_rate;
							$hour_type_name = $row_rest_day_regular_holiday->hour_type_name;
							
							// Compute new regular hourly rate, for rest day which falls on a regular holiday
							if($hour_type_name == "Regular Holiday"){
								
								// Hourly rate = 260% of Regular hourly rate
								// Overtime rate = Hourly rate + 30% of Hourly rate 
								
								$sub_regular_hourly_rate = (number_format($mininum_wage_rate, 2) / number_format($working_hours)) * (260 / 100);
								$regular_hourly_rate = $sub_regular_hourly_rate + ((30 / 100) * $sub_regular_hourly_rate); // 30% of Hourly rate
							}
							
							// Compute new regular hourly rate, for rest day which falls on a special holiday
							if($hour_type_name == "Special Holiday"){
								
								// Hourly rate = 150% of Regular hourly rate 
								// Overtime rate = Hourly rate + 30% of Hourly rate  
								
								$sub_regular_hourly_rate = (number_format($mininum_wage_rate, 2) / number_format($working_hours)) * (150 / 100);
								$regular_hourly_rate = $sub_regular_hourly_rate + ((30 / 100) * $sub_regular_hourly_rate); // 30% of Hourly rate
							}
							
						}else{
							
							// get rest day rate
							$rest_day_default = "2";
							$sql_rest_day_rate = $CI->db->query("
								SELECT *,ot.pay_rate as pay_rate, ot.ot_rate as ot_rate
								FROM `overtime_type` ot
								LEFT JOIN hours_type ht ON ot.hour_type_id = ht.hour_type_id
								WHERE ht.default = '{$rest_day_default}'
								AND ot.company_id = '{$row->company_id}'
							");
							
							$row_rest_day_rate = $sql_rest_day_rate->row();
							if($sql_rest_day_rate->num_rows() > 0){
								
								$sql_rest_day_rate->free_result();
								
								$pay_rate = $row_rest_day_rate->pay_rate;
								$ot_rate = $row_rest_day_rate->ot_rate;
								
								// compute new regular hourly rate
								$sub_regular_hourly_rate = (number_format($mininum_wage_rate, 2) / number_format($working_hours)) * ($pay_rate / 100);
								$regular_hourly_rate = $sub_regular_hourly_rate + (($ot_rate / 100) * $sub_regular_hourly_rate);
							}	
						}
					}
					
					// ========================================================================================================
					
					// check if workday is ordinary day
					
					if($pay_rate == "" && $ot_rate == ""){
						$rest_day_default = "1";
						$sql_ordinary_day = $CI->db->query("
							SELECT *,ot.pay_rate as pay_rate, ot.ot_rate as ot_rate
							FROM `overtime_type` ot
							LEFT JOIN hours_type ht ON ot.hour_type_id = ht.hour_type_id
							WHERE ht.default = '{$rest_day_default}'
							AND ot.company_id = '{$row->company_id}'
						");
						
						$row_ordinary_day = $sql_ordinary_day->row();
						if($sql_ordinary_day->num_rows() > 0){
							
							$sql_ordinary_day->free_result();
							
							$ot_rate = $row_ordinary_day->ot_rate;
							
							// compute new regular hourly rate
							$regular_hourly_rate = (number_format($mininum_wage_rate, 2) / number_format($working_hours)) + (($ot_rate / 100) * (number_format($mininum_wage_rate, 2) / number_format($working_hours)));
						}
					}
					
					// ========================================================================================================
					
					$overtime_value .= " + ".number_format($regular_hourly_rate, 2)." * ".$num_of_hours;
				}
			}else{
				$overtime_value = 0;
			}
		}else{
			$overtime_value = 0;
		}
		
		return $overtime_value;
	}
	
	/**
	 * Get Holiday Premium
	 * @param unknown_type $emp_id
	 */
	function get_holiday_premium($emp_id){
		$CI =& get_instance();
		
		// company payroll period, period from and period to
		
		$sql_payroll_period = $CI->db->query("
			SELECT *
			FROM `payroll_period` pp
			LEFT JOIN employee e ON pp.company_id = e.company_id
			WHERE e.emp_id = '{$emp_id}' 
		");
		
		$row_payroll_period = $sql_payroll_period->row();
		
		$mininum_wage_rate = "";
		$working_hours = "";
		$no_of_days = "";
		$regular_hourly_rate = "";
		
		// check if workday is uniform working days, get the total working days per year
		/* $sql_uniform_working_days = $CI->db->query("
			SELECT *
			FROM `employee_time_in` eti
			LEFT JOIN uniform_working_day_settings uwds ON eti.comp_id = uwds.company_id
			LEFT JOIN uniform_working_day uwd ON uwds.company_id = uwd.company_id
			WHERE eti.emp_id = '{$emp_id}'
			GROUP BY uwds.total_working_days_per_year
		");
		
		// get number of days
		$row_uniform_working_days = $sql_uniform_working_days->row();
		if($sql_uniform_working_days->num_rows() > 0){
			$sql_uniform_working_days->free_result();
			
			if($row_uniform_working_days->total_working_days_per_year != null || $row_uniform_working_days->working_hours != ""){
				// for uniform working days
				$no_of_days = $row_uniform_working_days->total_working_days_per_year / 12; // 12 = months
				$working_hours = $row_uniform_working_days->working_hours;	
			}
		} */
		
		// ==========================================
		
		// check if workday is workshit schedule
		$sql_workshift = $CI->db->query("
			SELECT *
			FROM `employee_time_in` eti
			LEFT JOIN workshift_settings ws ON eti.comp_id = ws.company_id
			LEFT JOIN workshift w ON ws.company_id = w.company_id
			WHERE eti.emp_id = '{$emp_id}'
			GROUP BY ws.total_working_days_per_year
			
		");
		
		$row_workshift = $sql_workshift->row();
		if($sql_workshift->num_rows() > 0){
			$sql_workshift->free_result();
			
			if($row_workshift->total_working_days_per_year != null || $row_workshift->working_hours != ""){
				// for workshift
				$no_of_days = $row_workshift->total_working_days_per_year / 12; // 12 = months
				$working_hours = $row_workshift->working_hours;
			}
		}
		
		// ==========================================
		
		// check if workday is flexible hours
		$sql_flexible_hours = $CI->db->query("
			SELECT *
			FROM `employee_time_in` eti
			LEFT JOIN flexible_hours fh ON eti.comp_id = fh.company_id
			WHERE eti.emp_id = '{$emp_id}'
			GROUP BY fh.total_days_per_year
		");
		
		$row_flexible_hours = $sql_flexible_hours->row();
		if($sql_flexible_hours->num_rows() > 0){
			$sql_flexible_hours->free_result();
			
			if($row_flexible_hours->total_days_per_year != null){
				// for flexible hours
				$no_of_days = $row_flexible_hours->total_days_per_year / 12; // 12 = months
				$working_hours = $row_flexible_hours->total_hours_for_the_day;
			}
		}
		
		if($working_hours != "" && $no_of_days != ""){
			// get mininum wage rate for employee
			$sql_minimum_wage_rate = $CI->db->query("
				SELECT *
				FROM `basic_pay_adjustment`
				WHERE emp_id = '{$emp_id}'
				AND status = 'Active'
				AND deleted = '0'
			");
			
			$row_minimum_wage_rate = $sql_minimum_wage_rate->row();
			if($sql_minimum_wage_rate->num_rows() > 0){
				$sql_minimum_wage_rate->free_result();
				$effective_date = strtotime(date("Y-m-d",strtotime($row_minimum_wage_rate->effective_date)));
				$current_date = strtotime(date("Y-m-d"));
				if($effective_date < $current_date){
					$current_basic_pay = $row_minimum_wage_rate->current_basic_pay;
				}else{
					$current_basic_pay = $row_minimum_wage_rate->new_basic_pay;
				}
				
				$mininum_wage_rate = $current_basic_pay / $no_of_days;
			}else{
				$current_basic_pay = 0;
				$mininum_wage_rate = 0;
			}
			
			// get regular hours type
		
			$regular_hourly_rate = number_format($mininum_wage_rate, 2) / number_format($working_hours);
		}
		
		if($sql_payroll_period->num_rows() > 0){
			$period_from = $row_payroll_period->period_from;
			$period_to = $row_payroll_period->period_to;
			
			$sql_check_overtime_payroll_period = $CI->db->query("
				SELECT *
				FROM employee_time_in
				WHERE date >= '{$period_from}'
				AND date <= '{$period_to}'
				AND emp_id = '{$emp_id}'
			");
			
			$row_check_overtime_payroll_period = $sql_check_overtime_payroll_period->result();
			if($sql_check_overtime_payroll_period->num_rows() > 0){
				$sql_check_overtime_payroll_period->free_result();
				$holiday_premium_val = "";
				foreach($row_check_overtime_payroll_period as $row){
					
					$workday_val = date('l', strtotime($row->date)); 
					
					// check if workday is uniform working days, get the total working days per year
					$sql_uniform_working_days = $CI->db->query("
						SELECT *
						FROM `employee_time_in` eti
						LEFT JOIN uniform_working_day_settings uwds ON eti.comp_id = uwds.company_id
						LEFT JOIN uniform_working_day uwd ON uwds.company_id = uwd.company_id
						WHERE eti.emp_id = '{$emp_id}'
						AND uwd.working_day = 'Friday'
						GROUP BY uwd.working_day
					");
					
					// get number of days
					$row_uniform_working_days = $sql_uniform_working_days->row();
					if($sql_uniform_working_days->num_rows() > 0){
						$sql_uniform_working_days->free_result();
						
						if($row_uniform_working_days->total_working_days_per_year != null || $row_uniform_working_days->working_hours != ""){
							// for uniform working days
							$no_of_days = $row_uniform_working_days->total_working_days_per_year / 12; // 12 = months
							$working_hours = $row_uniform_working_days->working_hours;

							// get mininum wage rate for employee
							$sql_minimum_wage_rate = $CI->db->query("
								SELECT *
								FROM `basic_pay_adjustment`
								WHERE emp_id = '{$emp_id}'
								AND status = 'Active'
								AND deleted = '0'
							");
							
							$row_minimum_wage_rate = $sql_minimum_wage_rate->row();
							if($sql_minimum_wage_rate->num_rows() > 0){
								$sql_minimum_wage_rate->free_result();
								$effective_date = strtotime(date("Y-m-d",strtotime($row_minimum_wage_rate->effective_date)));
								$current_date = strtotime(date("Y-m-d"));
								if($effective_date < $current_date){
									$current_basic_pay = $row_minimum_wage_rate->current_basic_pay;
								}else{
									$current_basic_pay = $row_minimum_wage_rate->new_basic_pay;
								}
								
								$mininum_wage_rate = $current_basic_pay / $no_of_days;
							}else{
								$current_basic_pay = 0;
								$mininum_wage_rate = 0;
							}
							
							// get regular hours type
			
							$regular_hourly_rate = number_format($mininum_wage_rate, 2) / number_format($working_hours);
						}
					}
					
					
					$num_of_hours = $row->total_hours;
					$overtime_from_value = $row->date;
					$pay_rate = "";
					$ot_rate = "";
					
					// check if workday is holiday
					$sql_check_holiday = $CI->db->query("
						SELECT *,ht.pay_rate as pay_rate
						FROM `holiday` h
						LEFT JOIN `hours_type` ht ON h.hour_type_id = ht.hour_type_id
						LEFT JOIN overtime_type ot ON ht.hour_type_id = ot.hour_type_id
						WHERE h.date = '{$overtime_from_value}'
					");
					
					$row_check_holiday = $sql_check_holiday->row();
					if($sql_check_holiday->num_rows() > 0){
						
						$sql_check_holiday->free_result();
						
						// if overtime workday falls on regular holiday
						$pay_rate = $row_check_holiday->pay_rate;
						$ot_rate = $row_check_holiday->ot_rate;
						
						// compute new regular hourly rate
						$sub_regular_hourly_rate = (number_format($mininum_wage_rate, 2) / number_format($working_hours)) * ($pay_rate / 100);
						$regular_hourly_rate = $sub_regular_hourly_rate + (($ot_rate / 100) * $sub_regular_hourly_rate);
					}
					
					// ========================================================================================================
					
					// check if workday is ordinary day
					
					if($pay_rate == "" && $ot_rate == ""){
						$rest_day_default = "1";
						$sql_ordinary_day = $CI->db->query("
							SELECT *,ot.pay_rate as pay_rate, ot.ot_rate as ot_rate
							FROM `overtime_type` ot
							LEFT JOIN hours_type ht ON ot.hour_type_id = ht.hour_type_id
							WHERE ht.default = '{$rest_day_default}'
							AND ot.company_id = '{$row->comp_id}'
						");
						
						$row_ordinary_day = $sql_ordinary_day->row();
						if($sql_ordinary_day->num_rows() > 0){
							
							$sql_ordinary_day->free_result();
							
							$ot_rate = $row_ordinary_day->ot_rate;
							
							// compute new regular hourly rate
							$regular_hourly_rate = (number_format($mininum_wage_rate, 2) / number_format($working_hours)) + (($ot_rate / 100) * (number_format($mininum_wage_rate, 2) / number_format($working_hours)));
						}
					}
					
					$holiday_premium_val .= " + ".number_format($regular_hourly_rate, 2)." * ".$num_of_hours;
				}
			}else{
				$holiday_premium_val = 0;
			}
		}else{
			$holiday_premium_val = 0;
		}
		
		return $holiday_premium_val;
	}
	
	/**
	 * Get Night Differential
	 * Enter description here ...
	 * @param unknown_type $emp_id
	 */
	function get_night_diff($emp_id){
		$CI =& get_instance();
		
		// company payroll period, period from and period to
		
		$sql_payroll_period = $CI->db->query("
			SELECT *
			FROM `payroll_period` pp
			LEFT JOIN employee e ON pp.company_id = e.company_id
			WHERE e.emp_id = '{$emp_id}' 
		");
		
		$row_payroll_period = $sql_payroll_period->row();
		
		$mininum_wage_rate = "";
		$working_hours = "";
		$no_of_days = "";
		$regular_hourly_rate = "";
		
		// check if workday is uniform working days, get the total working days per year
		/* $sql_uniform_working_days = $CI->db->query("
			SELECT *
			FROM `employee_time_in` eti
			LEFT JOIN uniform_working_day_settings uwds ON eti.comp_id = uwds.company_id
			LEFT JOIN uniform_working_day uwd ON uwds.company_id = uwd.company_id
			WHERE eti.emp_id = '{$emp_id}'
			GROUP BY uwds.total_working_days_per_year
		");
		
		// get number of days
		$row_uniform_working_days = $sql_uniform_working_days->row();
		if($sql_uniform_working_days->num_rows() > 0){
			$sql_uniform_working_days->free_result();
			
			if($row_uniform_working_days->total_working_days_per_year != null || $row_uniform_working_days->working_hours != ""){
				// for uniform working days
				$no_of_days = $row_uniform_working_days->total_working_days_per_year / 12; // 12 = months
				$working_hours = $row_uniform_working_days->working_hours;	
			}
		} */
		
		// ==========================================
		
		// check if workday is workshit schedule
		$sql_workshift = $CI->db->query("
			SELECT *
			FROM `employee_time_in` eti
			LEFT JOIN workshift_settings ws ON eti.comp_id = ws.company_id
			LEFT JOIN workshift w ON ws.company_id = w.company_id
			WHERE eti.emp_id = '{$emp_id}'
			GROUP BY ws.total_working_days_per_year
			
		");
		
		$row_workshift = $sql_workshift->row();
		if($sql_workshift->num_rows() > 0){
			$sql_workshift->free_result();
			
			if($row_workshift->total_working_days_per_year != null || $row_workshift->working_hours != ""){
				// for workshift
				$no_of_days = $row_workshift->total_working_days_per_year / 12; // 12 = months
				$working_hours = $row_workshift->working_hours;
			}
		}
		
		// ==========================================
		
		// check if workday is flexible hours
		$sql_flexible_hours = $CI->db->query("
			SELECT *
			FROM `employee_time_in` eti
			LEFT JOIN flexible_hours fh ON eti.comp_id = fh.company_id
			WHERE eti.emp_id = '{$emp_id}'
			GROUP BY fh.total_days_per_year
		");
		
		$row_flexible_hours = $sql_flexible_hours->row();
		if($sql_flexible_hours->num_rows() > 0){
			$sql_flexible_hours->free_result();
			
			if($row_flexible_hours->total_days_per_year != null){
				// for flexible hours
				$no_of_days = $row_flexible_hours->total_days_per_year / 12; // 12 = months
				$working_hours = $row_flexible_hours->total_hours_for_the_day;
			}
		}
		
		if($working_hours != "" && $no_of_days != ""){
			// get mininum wage rate for employee
			$sql_minimum_wage_rate = $CI->db->query("
				SELECT *
				FROM `basic_pay_adjustment`
				WHERE emp_id = '{$emp_id}'
				AND status = 'Active'
				AND deleted = '0'
			");
			
			$row_minimum_wage_rate = $sql_minimum_wage_rate->row();
			if($sql_minimum_wage_rate->num_rows() > 0){
				$sql_minimum_wage_rate->free_result();
				$effective_date = strtotime(date("Y-m-d",strtotime($row_minimum_wage_rate->effective_date)));
				$current_date = strtotime(date("Y-m-d"));
				if($effective_date < $current_date){
					$current_basic_pay = $row_minimum_wage_rate->current_basic_pay;
				}else{
					$current_basic_pay = $row_minimum_wage_rate->new_basic_pay;
				}
				
				$mininum_wage_rate = $current_basic_pay / $no_of_days;
			}else{
				$current_basic_pay = 0;
				$mininum_wage_rate = 0;
			}
			
			// get regular hours type
			
			$regular_hourly_rate = number_format($mininum_wage_rate, 2) / number_format($working_hours);
		}
		
		if($sql_payroll_period->num_rows() > 0){
			
			
			// Check Night Shift Differential Settings
			
			$sql_night_diff = $CI->db->query("
				SELECT *
				FROM `nightshift_differential_settings` nds
				LEFT JOIN employee e ON nds.company_id = e.company_id
				WHERE e.emp_id = '{$emp_id}'
				AND e.status = 'Active'
			");
			
			$row_night_diff = $sql_night_diff->row();
			
			if($sql_night_diff->num_rows() > 0){
				
				$sql_night_diff->free_result();
				
				$nd_from_time = strtotime(date("H:i:s",strtotime($row_night_diff->from_time)));
				$nd_to_time = strtotime(date("H:i:s",strtotime($row_night_diff->to_time)));
				$rate = number_format($row_night_diff->rate, 2) / 100; 
				
				$period_from = $row_payroll_period->period_from;
				$period_to = $row_payroll_period->period_to;
				
				$sql_check_overtime_payroll_period = $CI->db->query("
					SELECT *
					FROM employee_time_in
					WHERE date >= '{$period_from}'
					AND date <= '{$period_to}'
					AND emp_id = '{$emp_id}'
				");
				
				$row_check_overtime_payroll_period = $sql_check_overtime_payroll_period->result();
				if($sql_check_overtime_payroll_period->num_rows() > 0){
					$sql_check_overtime_payroll_period->free_result();
					
					$night_diff_val = "";
					$num_of_hours = 0;
					foreach($row_check_overtime_payroll_period as $row){
						
						$workday_val = date('l', strtotime($row->date));
						
						// for uniform working days
						$sql_uniform_working_days = $CI->db->query("
							SELECT *
							FROM `employee_time_in` eti
							LEFT JOIN uniform_working_day_settings uwds ON eti.comp_id = uwds.company_id
							LEFT JOIN uniform_working_day uwd ON uwds.company_id = uwd.company_id
							WHERE eti.emp_id = '{$emp_id}'
							AND uwd.working_day = '{$workday_val}'
							GROUP BY uwd.working_day
						");
						
						// get number of days
						$row_uniform_working_days = $sql_uniform_working_days->row();
						if($sql_uniform_working_days->num_rows() > 0){
							$sql_uniform_working_days->free_result();
							
							if($row_uniform_working_days->total_working_days_per_year != null || $row_uniform_working_days->working_hours != ""){
								// for uniform working days
								$no_of_days = $row_uniform_working_days->total_working_days_per_year / 12; // 12 = months
								$working_hours = $row_uniform_working_days->working_hours;
	
								// get mininum wage rate for employee
								$sql_minimum_wage_rate = $CI->db->query("
									SELECT *
									FROM `basic_pay_adjustment`
									WHERE emp_id = '{$emp_id}'
									AND status = 'Active'
									AND deleted = '0'
								");
								
								$row_minimum_wage_rate = $sql_minimum_wage_rate->row();
								if($sql_minimum_wage_rate->num_rows() > 0){
									$sql_minimum_wage_rate->free_result();
									$effective_date = strtotime(date("Y-m-d",strtotime($row_minimum_wage_rate->effective_date)));
									$current_date = strtotime(date("Y-m-d"));
									if($effective_date < $current_date){
										$current_basic_pay = $row_minimum_wage_rate->current_basic_pay;
									}else{
										$current_basic_pay = $row_minimum_wage_rate->new_basic_pay;
									}
									
									$mininum_wage_rate = $current_basic_pay / $no_of_days;
								}else{
									$current_basic_pay = 0;
									$mininum_wage_rate = 0;
								}
								
								// get regular hours type
								
								$regular_hourly_rate = number_format($mininum_wage_rate, 2) / number_format($working_hours);
							}
						}
						
						$time_in = strtotime(date("H:i:s",strtotime($row->time_in)));
						$time_out = strtotime(date("H:i:s",strtotime($row->time_out)));
						$pay_rate = "";
						$ot_rate = "";
						
						// for ordinary day or regular day
						// check if time in work performed between 10pm and 6am
						
						if($time_in >= $nd_from_time && $time_in <= $nd_to_time){
							// if time out is less than or equal to night diff settings, get total hours worked
							if($time_out <= $nd_to_time){
								$num_of_hours = (strtotime($time_out) - strtotime($time_in)) / 3600;
							}else{
								$num_of_hours = (strtotime($nd_to_time) - strtotime($time_in)) / 3600;
							}
							
							$night_diff_val .= " + ".number_format($regular_hourly_rate, 2) * $rate * $working_hours." * ".$num_of_hours;
						}else{
							$night_diff_val = 0;
						}
					}
				}else{
					$night_diff_val = 0;
				}
			}else{
				$night_diff_val = 0;
			}
		}else{
			$night_diff_val = 0;
		}
		
		return $night_diff_val;
		
	}
	
	/**
	 * Get Period Type (Monthly/Semi-Monthly)
	 * Enter description here ...
	 * @param unknown_type $emp_id
	 */
	function get_period_type($emp_id){
		$CI =& get_instance();
		
		$sql_payroll_group = $CI->db->query("
			SELECT *
			FROM `employee_payroll_information` epi
			LEFT JOIN payroll_group pg ON epi.payroll_group_id = pg.payroll_group_id
			WHERE epi.emp_id = '{$emp_id}'
		");
		
		$row_payroll_group = $sql_payroll_group->row();
		if($sql_payroll_group->num_rows() > 0){
			$sql_payroll_group->free_result();
			return $row_payroll_group;
		}else{
			return "";
		}
	}
	
	/**
	 * Get Pagibig Deduction
	 */
	function get_pagibig(){
		return "100";
	}
	
	/**
	 * Get Basic Pay
	 * @param unknown_type $emp_id
	 * @param unknown_type $pay_rate_type
	 */
	function get_basic_pay($emp_id, $pay_rate_type){
		$CI =& get_instance();
		$rate_type = "By Month";
		$current_date = strtotime(date("Y-m-d"));
		
		// by month
		if($pay_rate_type == $rate_type){
			$sql_basic_pay = $CI->db->query("
				SELECT *
				FROM `basic_pay_adjustment`
				WHERE emp_id = '{$emp_id}'
				AND status = 'Active'
			");	
			
			$row_basic_pay = $sql_basic_pay->row();
			if($sql_basic_pay->num_rows() > 0){
				$sql_basic_pay->free_result();
				$effective_date = strtotime(date("Y-m-d",strtotime($row_basic_pay->effective_date)));
				if($current_date >= $effective_date){
					return $row_basic_pay->new_basic_pay;
				}else{
					return $row_basic_pay->current_basic_pay;
				}
			}
		}
	}
	
	/**
	 * Get SSS
	 * Enter description here ...
	 * @param unknown_type $emp_id
	 */
	function get_sss($basic_pay){
		$CI =& get_instance();
		
		// check if basic pay is greater than maximum value from sss table
		$check_max_basic_pay = $CI->db->query("
			SELECT *
			FROM `sss`
			ORDER BY id DESC
			LIMIT 1
		");
		
		$row_max_basic_pay = $check_max_basic_pay->row();
		$range_compensation_to_max = $row_max_basic_pay->range_compensation_to;
		$employee_ss_max = $row_max_basic_pay->employee_ss;
		
		if($basic_pay > $range_compensation_to_max){
			return $employee_ss_max;
		}else{
			$sql_sss = $CI->db->query("
				SELECT *
				FROM `sss`
				WHERE `range_compensation_from` <= '{$basic_pay}'
				AND `range_compensation_to` >= '{$basic_pay}'
			");
			
			$row_sss = $sql_sss->row();
			if($sql_sss->num_rows() > 0){
				$sql_sss->free_result();
				$employee_ss = $row_sss->employee_ss;
				return $employee_ss;
			}	
		}
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $emp_id
	 * @param unknown_type $basic_pay
	 */
	function get_philhealth($basic_pay){
		$CI =& get_instance();
		
		$sql_philhealth = $CI->db->query("
			SELECT *
			FROM `phil_health`
			WHERE salary_range_from <= '{$basic_pay}'
			AND salary_range_to >= '{$basic_pay}'
		");
		
		$row = $sql_philhealth->row();
		
		if($sql_philhealth->num_rows() > 0){
			$return_value = $row->employee_share;
		}
		
		return $return_value;
	}
	
	/**
	 * How to compute Lates/Tardiness
	 * Enter description here ...
	 * @param unknown_type $emp_id
	 */
	function get_tardiness($emp_id){
		$CI =& get_instance();
		
		// company payroll period, period from and period to
		
		$sql_payroll_period = $CI->db->query("
			SELECT *
			FROM `payroll_period` pp
			LEFT JOIN employee e ON pp.company_id = e.company_id
			WHERE e.emp_id = '{$emp_id}' 
		");
		
		$row_payroll_period = $sql_payroll_period->row();
		
		$mininum_wage_rate = "";
		$working_hours = "";
		$no_of_days = "";
		$regular_hourly_rate = "";
		
		// check if workday is uniform working days, get the total working days per year
		/* $sql_uniform_working_days = $CI->db->query("
			SELECT *
			FROM `employee_time_in` eti
			LEFT JOIN uniform_working_day_settings uwds ON eti.comp_id = uwds.company_id
			LEFT JOIN uniform_working_day uwd ON uwds.company_id = uwd.company_id
			WHERE eti.emp_id = '{$emp_id}'
			GROUP BY uwds.total_working_days_per_year
		");
		
		// get number of days
		$row_uniform_working_days = $sql_uniform_working_days->row();
		if($sql_uniform_working_days->num_rows() > 0){
			$sql_uniform_working_days->free_result();
			
			if($row_uniform_working_days->total_working_days_per_year != null || $row_uniform_working_days->working_hours != ""){
				// for uniform working days
				$no_of_days = $row_uniform_working_days->total_working_days_per_year / 12; // 12 = months
				$working_hours = $row_uniform_working_days->working_hours;	
			}
		} */
		
		// ==========================================
		
		// check if workday is workshit schedule
		$sql_workshift = $CI->db->query("
			SELECT *
			FROM `employee_time_in` eti
			LEFT JOIN workshift_settings ws ON eti.comp_id = ws.company_id
			LEFT JOIN workshift w ON ws.company_id = w.company_id
			WHERE eti.emp_id = '{$emp_id}'
			GROUP BY ws.total_working_days_per_year
			
		");
		
		$row_workshift = $sql_workshift->row();
		if($sql_workshift->num_rows() > 0){
			$sql_workshift->free_result();
			
			if($row_workshift->total_working_days_per_year != null || $row_workshift->working_hours != ""){
				// for workshift
				$no_of_days = $row_workshift->total_working_days_per_year / 12; // 12 = months
				$working_hours = $row_workshift->working_hours;
			}
		}
		
		// ==========================================
		
		// check if workday is flexible hours
		$sql_flexible_hours = $CI->db->query("
			SELECT *
			FROM `employee_time_in` eti
			LEFT JOIN flexible_hours fh ON eti.comp_id = fh.company_id
			WHERE eti.emp_id = '{$emp_id}'
			GROUP BY fh.total_days_per_year
		");
		
		$row_flexible_hours = $sql_flexible_hours->row();
		if($sql_flexible_hours->num_rows() > 0){
			$sql_flexible_hours->free_result();
			
			if($row_flexible_hours->total_days_per_year != null){
				// for flexible hours
				$no_of_days = $row_flexible_hours->total_days_per_year / 12; // 12 = months
				$working_hours = $row_flexible_hours->total_hours_for_the_day;
			}
		}
		
		if($working_hours != "" && $no_of_days != ""){
			// get mininum wage rate for employee
			$sql_minimum_wage_rate = $CI->db->query("
				SELECT *
				FROM `basic_pay_adjustment`
				WHERE emp_id = '{$emp_id}'
				AND status = 'Active'
				AND deleted = '0'
			");
			
			$row_minimum_wage_rate = $sql_minimum_wage_rate->row();
			if($sql_minimum_wage_rate->num_rows() > 0){
				$sql_minimum_wage_rate->free_result();
				$effective_date = strtotime(date("Y-m-d",strtotime($row_minimum_wage_rate->effective_date)));
				$current_date = strtotime(date("Y-m-d"));
				if($effective_date < $current_date){
					$current_basic_pay = $row_minimum_wage_rate->current_basic_pay;
				}else{
					$current_basic_pay = $row_minimum_wage_rate->new_basic_pay;
				}
				
				$mininum_wage_rate = $current_basic_pay / $no_of_days;
			}else{
				$current_basic_pay = 0;
				$mininum_wage_rate = 0;
			}
			
			// get regular hours type
			
			$regular_hourly_rate = number_format($mininum_wage_rate, 2) / number_format($working_hours);
		}
		
		$tardiness = 0;
		
		if($sql_payroll_period->num_rows() > 0){
			$period_from = $row_payroll_period->period_from;
			$period_to = $row_payroll_period->period_to;
			
			$sql_check_overtime_payroll_period = $CI->db->query("
				SELECT *
				FROM employee_time_in
				WHERE date >= '{$period_from}'
				AND date <= '{$period_to}'
				AND emp_id = '{$emp_id}'
			");
			
			$res_check_overtime_payroll_period =  $sql_check_overtime_payroll_period->result();
			if($sql_check_overtime_payroll_period->num_rows() > 0){
				$sql_check_overtime_payroll_period->free_result();
				
				foreach($res_check_overtime_payroll_period as $row){
					
					$workday_val = date('l', strtotime($row->date));
					
					// check if workday is uniform working days, get the total working days per year
					$sql_uniform_working_days = $CI->db->query("
						SELECT *
						FROM `employee_time_in` eti
						LEFT JOIN uniform_working_day_settings uwds ON eti.comp_id = uwds.company_id
						LEFT JOIN uniform_working_day uwd ON uwds.company_id = uwd.company_id
						WHERE eti.emp_id = '{$emp_id}'
						AND uwd.working_day = '{$workday_val}'
						GROUP BY uwd.working_day
					");
					
					// get number of days
					$row_uniform_working_days = $sql_uniform_working_days->row();
					if($sql_uniform_working_days->num_rows() > 0){
						$sql_uniform_working_days->free_result();
						
						if($row_uniform_working_days->total_working_days_per_year != null || $row_uniform_working_days->working_hours != ""){
							// for uniform working days
							$no_of_days = $row_uniform_working_days->total_working_days_per_year / 12; // 12 = months
							$working_hours = $row_uniform_working_days->working_hours;

							// get mininum wage rate for employee
							$sql_minimum_wage_rate = $CI->db->query("
								SELECT *
								FROM `basic_pay_adjustment`
								WHERE emp_id = '{$emp_id}'
								AND status = 'Active'
								AND deleted = '0'
							");
							
							$row_minimum_wage_rate = $sql_minimum_wage_rate->row();
							if($sql_minimum_wage_rate->num_rows() > 0){
								$sql_minimum_wage_rate->free_result();
								$effective_date = strtotime(date("Y-m-d",strtotime($row_minimum_wage_rate->effective_date)));
								$current_date = strtotime(date("Y-m-d"));
								if($effective_date < $current_date){
									$current_basic_pay = $row_minimum_wage_rate->current_basic_pay;
								}else{
									$current_basic_pay = $row_minimum_wage_rate->new_basic_pay;
								}
								
								$mininum_wage_rate = $current_basic_pay / $no_of_days;
							}else{
								$current_basic_pay = 0;
								$mininum_wage_rate = 0;
							}
							
							// get regular hours type
							
							$regular_hourly_rate = number_format($mininum_wage_rate, 2) / number_format($working_hours);
						}
					}
					
					$tardiness_min = $row->tardiness_min;
					if($tardiness_min != ""){
						$compute_tardiness = $regular_hourly_rate ." / ". 60 ." * ". $tardiness_min;
						// $compute_tardiness = $regular_hourly_rate / 60 * $tardiness_min;
						$tardiness .= " + ".$compute_tardiness;
					}else{
						$tardiness .= "";
					}
				}
			}
		}
		
		return $tardiness;
	}
	
	/**
	 * How to compute Undertime
	 * Enter description here ...
	 * @param unknown_type $emp_id
	 */
	function get_undertime($emp_id){
		$CI =& get_instance();
		
		// company payroll period, period from and period to
		
		$sql_payroll_period = $CI->db->query("
			SELECT *
			FROM `payroll_period` pp
			LEFT JOIN employee e ON pp.company_id = e.company_id
			WHERE e.emp_id = '{$emp_id}' 
		");
		
		$row_payroll_period = $sql_payroll_period->row();
		
		$mininum_wage_rate = "";
		$working_hours = "";
		$no_of_days = "";
		$regular_hourly_rate = "";
		
		// check if workday is uniform working days, get the total working days per year
		/* $sql_uniform_working_days = $CI->db->query("
			SELECT *
			FROM `employee_time_in` eti
			LEFT JOIN uniform_working_day_settings uwds ON eti.comp_id = uwds.company_id
			LEFT JOIN uniform_working_day uwd ON uwds.company_id = uwd.company_id
			WHERE eti.emp_id = '{$emp_id}'
			GROUP BY uwds.total_working_days_per_year
		");
		
		// get number of days
		$row_uniform_working_days = $sql_uniform_working_days->row();
		if($sql_uniform_working_days->num_rows() > 0){
			$sql_uniform_working_days->free_result();
			
			if($row_uniform_working_days->total_working_days_per_year != null || $row_uniform_working_days->working_hours != ""){
				// for uniform working days
				$no_of_days = $row_uniform_working_days->total_working_days_per_year / 12; // 12 = months
				$working_hours = $row_uniform_working_days->working_hours;	
			}
		} */
		
		// ==========================================
		
		// check if workday is workshit schedule
		$sql_workshift = $CI->db->query("
			SELECT *
			FROM `employee_time_in` eti
			LEFT JOIN workshift_settings ws ON eti.comp_id = ws.company_id
			LEFT JOIN workshift w ON ws.company_id = w.company_id
			WHERE eti.emp_id = '{$emp_id}'
			GROUP BY ws.total_working_days_per_year
			
		");
		
		$row_workshift = $sql_workshift->row();
		if($sql_workshift->num_rows() > 0){
			$sql_workshift->free_result();
			
			if($row_workshift->total_working_days_per_year != null || $row_workshift->working_hours != ""){
				// for workshift
				$no_of_days = $row_workshift->total_working_days_per_year / 12; // 12 = months
				$working_hours = $row_workshift->working_hours;
			}
		}
		
		// ==========================================
		
		// check if workday is flexible hours
		$sql_flexible_hours = $CI->db->query("
			SELECT *
			FROM `employee_time_in` eti
			LEFT JOIN flexible_hours fh ON eti.comp_id = fh.company_id
			WHERE eti.emp_id = '{$emp_id}'
			GROUP BY fh.total_days_per_year
		");
		
		$row_flexible_hours = $sql_flexible_hours->row();
		if($sql_flexible_hours->num_rows() > 0){
			$sql_flexible_hours->free_result();
			
			if($row_flexible_hours->total_days_per_year != null){
				// for flexible hours
				$no_of_days = $row_flexible_hours->total_days_per_year / 12; // 12 = months
				$working_hours = $row_flexible_hours->total_hours_for_the_day;
			}
		}

		if($working_hours != "" && $no_of_days != ""){
			// get mininum wage rate for employee
			$sql_minimum_wage_rate = $CI->db->query("
				SELECT *
				FROM `basic_pay_adjustment`
				WHERE emp_id = '{$emp_id}'
				AND status = 'Active'
				AND deleted = '0'
			");
			
			$row_minimum_wage_rate = $sql_minimum_wage_rate->row();
			if($sql_minimum_wage_rate->num_rows() > 0){
				$sql_minimum_wage_rate->free_result();
				$effective_date = strtotime(date("Y-m-d",strtotime($row_minimum_wage_rate->effective_date)));
				$current_date = strtotime(date("Y-m-d"));
				if($effective_date < $current_date){
					$current_basic_pay = $row_minimum_wage_rate->current_basic_pay;
				}else{
					$current_basic_pay = $row_minimum_wage_rate->new_basic_pay;
				}
				
				$mininum_wage_rate = $current_basic_pay / $no_of_days;
			}else{
				$current_basic_pay = 0;
				$mininum_wage_rate = 0;
			}
			
			// get regular hours type
			
			$regular_hourly_rate = number_format($mininum_wage_rate, 2) / number_format($working_hours);
		}
		
		$undertime = 0;
		
		if($sql_payroll_period->num_rows() > 0){
			$period_from = $row_payroll_period->period_from;
			$period_to = $row_payroll_period->period_to;
			
			$sql_check_overtime_payroll_period = $CI->db->query("
				SELECT *
				FROM employee_time_in
				WHERE date >= '{$period_from}'
				AND date <= '{$period_to}'
				AND emp_id = '{$emp_id}'
			");
			
			$res_check_overtime_payroll_period =  $sql_check_overtime_payroll_period->result();
			if($sql_check_overtime_payroll_period->num_rows() > 0){
				$sql_check_overtime_payroll_period->free_result();
				foreach($res_check_overtime_payroll_period as $row){
					
					$workday_val = date('l',strtotime($row->date));
					
					// check if workday is uniform working days, get the total working days per year
					$sql_uniform_working_days = $CI->db->query("
						SELECT *
						FROM `employee_time_in` eti
						LEFT JOIN uniform_working_day_settings uwds ON eti.comp_id = uwds.company_id
						LEFT JOIN uniform_working_day uwd ON uwds.company_id = uwd.company_id
						WHERE eti.emp_id = '{$emp_id}'
						AND uwd.working_day = '{$workday_val}'
						GROUP BY uwd.working_day
					");
					
					// get number of days
					$row_uniform_working_days = $sql_uniform_working_days->row();
					if($sql_uniform_working_days->num_rows() > 0){
						$sql_uniform_working_days->free_result();
						
						if($row_uniform_working_days->total_working_days_per_year != null || $row_uniform_working_days->working_hours != ""){
							// for uniform working days
							$no_of_days = $row_uniform_working_days->total_working_days_per_year / 12; // 12 = months
							$working_hours = $row_uniform_working_days->working_hours;

							// get mininum wage rate for employee
							$sql_minimum_wage_rate = $CI->db->query("
								SELECT *
								FROM `basic_pay_adjustment`
								WHERE emp_id = '{$emp_id}'
								AND status = 'Active'
								AND deleted = '0'
							");
							
							$row_minimum_wage_rate = $sql_minimum_wage_rate->row();
							if($sql_minimum_wage_rate->num_rows() > 0){
								$sql_minimum_wage_rate->free_result();
								$effective_date = strtotime(date("Y-m-d",strtotime($row_minimum_wage_rate->effective_date)));
								$current_date = strtotime(date("Y-m-d"));
								if($effective_date < $current_date){
									$current_basic_pay = $row_minimum_wage_rate->current_basic_pay;
								}else{
									$current_basic_pay = $row_minimum_wage_rate->new_basic_pay;
								}
								
								$mininum_wage_rate = $current_basic_pay / $no_of_days;
							}else{
								$current_basic_pay = 0;
								$mininum_wage_rate = 0;
							}
							
							// get regular hours type
							
							$regular_hourly_rate = number_format($mininum_wage_rate, 2) / number_format($working_hours);
						}
					}
					
					$undertime_min = $row->undertime_min;
					if($undertime_min != ""){
						$compute_undertime = $regular_hourly_rate ." / ". 60 ." * ". $undertime_min;
						// $compute_undertime = $regular_hourly_rate / 60 * $undertime_min;
						$undertime .= " + ".$compute_undertime;
					}else{
						$undertime .= "";
					}
				}
			}
		}
		
		return $undertime;
	}
	
	/**
	 * Get Rest Day
	 * @param unknown_type $emp_id
	 * @param unknown_type $workday
	 */
	function get_restday($emp_id, $workday){
		$CI =& get_instance();
		
		$sql_restday = $CI->db->query("
			SELECT *
			FROM employee e
			LEFT JOIN rest_day r ON r.company_id = e.company_id
			WHERE e.emp_id = '{$emp_id}'
			AND r.rest_day = '{$workday}'
		");
		
		$row_restday = $sql_restday->row();
		if($sql_restday->num_rows() > 0){
			return "1";
		}else{
			
			$sql_uniform_working_day = $CI->db->query("
				SELECT *
				FROM employee e
				LEFT JOIN uniform_working_day uwd ON uwd.company_id = e.company_id
				WHERE e.emp_id = '{$emp_id}'
			");
			
			$row_uniform_working_day = $sql_uniform_working_day->result();
			if($sql_uniform_working_day->num_rows() > 0){
				$sql_uniform_working_day->free_result();
				
				$sql_uniform_working_day2 = $CI->db->query("
					SELECT *
					FROM employee e
					LEFT JOIN uniform_working_day uwd ON uwd.company_id = e.company_id
					WHERE e.emp_id = '{$emp_id}'
					AND uwd.working_day = '{$workday}'
				");
				
				if($sql_uniform_working_day2->num_rows() == 0){
					return "1";
				}
			}
		}
	}
	
	/**
	 * Get Days Time Ins
	 * @param unknown_type $emp_id
	 */
	function get_days_timeins($emp_id){
		$CI =& get_instance();
		
		// company payroll period, period from and period to
		
		$sql_payroll_period = $CI->db->query("
			SELECT *
			FROM `payroll_period` pp
			LEFT JOIN employee e ON pp.company_id = e.company_id
			WHERE e.emp_id = '{$emp_id}' 
		");
		
		$row_payroll_payroid = $sql_payroll_period->row();
		if($sql_payroll_period->num_rows() > 0){
			$period_from = $row_payroll_payroid->period_from;
			$period_to = $row_payroll_payroid->period_to;
			
			$sql_check_overtime_payroll_period = $CI->db->query("
				SELECT *
				FROM employee_time_in
				WHERE date >= '{$period_from}'
				AND date <= '{$period_to}'
				AND emp_id = '{$emp_id}'
			");
			
			$res_check_overtime_payroll_period =  $sql_check_overtime_payroll_period->result();
			if($sql_check_overtime_payroll_period->num_rows() > 0){
				$new_total_days = 0;
				foreach($res_check_overtime_payroll_period as $row){
					$workday = date('l',strtotime($row->date));
					$get_restday = get_restday($emp_id, $workday);
					if($get_restday != "1"){
						$new_total_days = $new_total_days + 1;
					}
				}
				return $new_total_days;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
		
	}
	
	/**
	 * No of days payroll period
	 * @param unknown_type $emp_id
	 */
	function no_days_payroll_period($emp_id){
		$CI =& get_instance();
		
		// company payroll period, period from and period to
		
		$sql_payroll_period = $CI->db->query("
			SELECT *
			FROM `payroll_period` pp
			LEFT JOIN employee e ON pp.company_id = e.company_id
			WHERE e.emp_id = '{$emp_id}' 
		");
		
		$row_payroll_payroid = $sql_payroll_period->row();
		if($sql_payroll_period->num_rows() > 0){
			
			$from = strtotime(date('Y-m-d', strtotime($row_payroll_payroid->period_from)));
			$to = strtotime(date('Y-m-d', strtotime($row_payroll_payroid->period_to)));
			
			$total_days = (($to - $from) / (3600 * 24)) + 1;
			
			$new_total_days = 0;
			$date_from3 = $row_payroll_payroid->period_from;
			for($i=0;$i<$total_days;$i++){
				$workday = date('l',strtotime($date_from3));
				$get_restday = get_restday($emp_id, $workday);
				if($get_restday == "1"){
					$new_total_days = $new_total_days + 1;
				}
				$date_from3 = date('m/d/Y',strtotime($date_from3." +1 day"));
			}
			
			$no_of_days_for_payroll_period = $total_days - $new_total_days;
			return $no_of_days_for_payroll_period;
			
		}else{
			return 0;
		}
	}
	
	/**
	 * Get Allowance
	 * @param unknown_type $emp_id
	 */
	function get_allowances($emp_id){
		$CI =& get_instance();
		
		$sql_employee_fixed_allowances = $CI->db->query("
			SELECT *
			FROM `employee_fixed_allowances`
			WHERE emp_id = '{$emp_id}'
		");
		
		$row = $sql_employee_fixed_allowances->row();
		if($sql_employee_fixed_allowances->num_rows() > 0){
			return $row->amount;
		}else{
			return 0;
		}
	}
	
	/**
	 * Get Withholding Tax Semi Monthly
	 * @param unknown_type $total_basic_pay
	 */
	function get_withholding_tax_semi_monthly($total_basic_pay, $emp_id){
		$CI =& get_instance();
		
		$counter = 8;
		$amount = 0;
		$tax_no = 0;
		
		// Check Employee Marital Status
		$sql_marital_status = $CI->db->query("
			SELECT *
			FROM `employee`
			WHERE emp_id = '{$emp_id}'	
			AND status = 'Active'
		");
		
		$row_marital_status = $sql_marital_status->row();
		$marital_status = $row_marital_status->marital_status;
		$no_dependent = $row_marital_status->no_of_dependents;
		
		if($marital_status == "Single"){
			if($no_dependent == 0) $emp_status = 'S';
			if($no_dependent == 1) $emp_status = 'S-1';
			if($no_dependent == 2) $emp_status = 'S-2';
			if($no_dependent == 3) $emp_status = 'S-3';
			if($no_dependent >= 4) $emp_status = 'S-4';
		}elseif($marital_status == "Married"){
			if($no_dependent == 0) $emp_status = 'M';
			if($no_dependent == 1) $emp_status = 'M-1';
			if($no_dependent == 2) $emp_status = 'M-2';
			if($no_dependent == 3) $emp_status = 'M-3';
			if($no_dependent >= 4) $emp_status = 'M-4';
		}
		
		for($access_amount=1; $access_amount<=$counter; $access_amount++){
			
			$add_one = ($access_amount == $counter) ? $access_amount : $access_amount + 1 ;
			
			$sql_semimonthly = $CI->db->query("
				SELECT *, amount_excess{$access_amount} as amount
				FROM `withholding_tax_status`
				WHERE `tax_type` = 'Semi Monthly'
				AND `tax_name` = '{$emp_status}'
				AND `amount_excess{$access_amount}` <= '{$total_basic_pay}'
				AND `amount_excess{$add_one}` >= '{$total_basic_pay}'
			");
			
			if($sql_semimonthly->num_rows() > 0){
				$row = $sql_semimonthly->row();
				$amount = $amount + $row->amount;
				$tax_no = $tax_no + $access_amount;
			}else{
				$amount = $amount + 0;
				$tax_no = $tax_no + 0;
			}
		}
		
		return $amount."-".$tax_no; // withholding tax table tax1, tax2 .....
		
	}
	
	/**
	 * Get Withholding Tax for Initial and Additional Tax
	 * @param unknown_type $tax_no
	 * @param unknown_type $tax_type
	 */
	function get_withholding_tax_ini_add($tax_no, $tax_type){
		
		$withholding_tax_no = "tax".$tax_no;
		
		$CI =& get_instance();
		
		// for initial tax
		$sql_tax_ini = $CI->db->query("
			SELECT *
			FROM `withholding_tax`
			WHERE `tax_type` = '{$tax_type}'
			AND tax_name = 'Initial Tax'
		");
		
		if($sql_tax_ini->num_rows() > 0){
			$row_ini = $sql_tax_ini->row();
			$ini = $row_ini->$withholding_tax_no;
		}
		
		// for additional tax
		$sql_tax_add = $CI->db->query("
			SELECT *
			FROM `withholding_tax`
			WHERE `tax_type` = '{$tax_type}'
			AND tax_name = 'Additional Tax'
		");
		
		if($sql_tax_add->num_rows() > 0){
			$row_add = $sql_tax_add->row();
			$add = $row_add->$withholding_tax_no;
		}
		
		return $row_ini->$withholding_tax_no."-".$row_add->$withholding_tax_no;
	}