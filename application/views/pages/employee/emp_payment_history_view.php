<div class="tbl-wrap">	
		<h1>Payment History</h1>
          <!-- TBL-WRAP START -->
          <table style="width:933px;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:auto;"></th>
              <th style="width:auto;">Payment</th>
              <th style="width:auto;">Interest</th>
              <th style="width:auto;">Principal</th>
              <th style="width:auto">Penalty</th>
              <th style="width:auto;">Credit Balance on Principal</th>
              <th style="width:auto;">Loan Balance</th>
            </tr>
            <?php 
            	if($emp_payment_history != NULL){
            		$counter = 1;
            		$credit_balance_principal = 0;
            		$interest_val = 0;
            		$principal_val = 0;
            		foreach($emp_payment_history as $row){
            			
            			// For Credit Balance On Principal
            			$credit_balance_principal = ($credit_balance_principal + $row->principal);
            			$balance_principal =  $total_princiapl_amortization - $credit_balance_principal;
            			
            			// Interest Total Amount
            			$interest_val = $interest_val + $row->interest;
            			
            			// Principal Total Amount
            			$principal_val = $principal_val + $row->principal;
            			
            			// For Loan Balance
            			$loan_balance = $loan_amount - ( $interest_val + $principal_val);
            ?>
	            <tr class="payment_row_cont">
	              <td><?php print $counter++;?></td>
	              <td><?php print number_format($row->payment, 2);?></td>
	              <td><?php print number_format($row->interest, 2);?></td>
	              <td><?php print number_format($row->principal, 2);?></td>
	              <td><?php print number_format($row->penalty, 2);?></td>
	              <td><span class="ihide"><?php print $total_princiapl_amortization." - ".$credit_balance_principal." = ";?></span><?php print number_format($balance_principal, 2);?></td>
	              <td><?php print number_format($loan_balance, 2);?></td>
	            </tr>
            <?php
            		}
            	}else{
            		print "<tr class='msg_empt_cont'><td colspan='12' style='text-align:left;'>".msg_empty()."</td></tr>";
            	}
            ?>
          </tbody></table>
          <span class="ihides unameContBoxTrick"></span>
          <!-- TBL-WRAP END -->
        </div>
        <div class="footer-grp-btn">
		 <!-- FOOTER-GRP-BTN START -->
		 <a class="btn btn-gray left" href="javascript:history.go(-1);">BACK</a> 
		 <!-- FOOTER-GRP-BTN END -->
		 </div>
