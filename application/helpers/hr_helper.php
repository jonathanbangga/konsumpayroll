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