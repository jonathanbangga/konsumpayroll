		<div class="tbl-wrap">	
		  <?php print $this->session->flashdata('message');?>
          <!-- TBL-WRAP START -->
          <table style="width:2600px;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:50px;"></th>
              <th style="width:170px;">Employee Name</th>
              <th style="width:170px;">Employee Number</th>
              <th style="width:170px;">Loan Number</th>
              <th style="width:170px;">Loan Type</th>
              <th style="width:170px;">Date Granted</th>
              <th style="width:170px;">Principal</th>
              <th style="width:170px;">Term(months)</th>
              <th style="width:170px;">Interest Rate%</th>
              <th style="width:170px;">Penalty Rate%</th>
              <th style="width:170px;">Beginning Balance</th>
              <th style="width:170px;">Bank Route</th>
              <th style="width:170px;">Bank Account</th>
              <th style="width:170px;">Account Type</th>
              <th style="width:170px;">Monthly Amortization</th>
              <th style="width:170px;">Loan Balance</th>
            </tr>
            <?php 
            	if($emp_loan != NULL){
            		$counter = 1;
            		foreach($emp_loan as $row){
            ?>
	            <tr>
	              <td><?php print $counter++;?></td>
	              <td><?php print ucwords($row->first_name)." ".ucwords($row->last_name);?></td>
	              <td><?php print $row->payroll_cloud_id;?></td>
	              <td><?php print $row->loan_no;?></td>
	              <td><?php print $row->loan_type;?></td>
	              <td><?php print $row->date_granted;?></td>
	              <td><?php print $row->principal;?></td>
	              <td><?php print $row->terms;?></td>
	              <td><?php print $row->interest_rates;?></td>
	              <td><?php print $row->penalty_rates;?></td>
	              <td><?php print $row->beginning_balance;?></td>
	              <td><?php print $row->bank_route;?></td>
	              <td><?php print $row->bank_account;?></td>
	              <td><?php print $row->account_type;?></td>
	              <td><?php print $row->monthly_amortization;?></td>
	              <td>Loan Balance</td>
	            </tr>
            <?php
            		}
            	}
            ?>
          </tbody></table>
          <!-- TBL-WRAP END -->
        </div>