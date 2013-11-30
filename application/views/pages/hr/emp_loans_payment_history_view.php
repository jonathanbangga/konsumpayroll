		<div class="tbl-wrap">	
		  <?php print $this->session->flashdata('message');?>
          <!-- TBL-WRAP START -->
          <table style="width:1410px;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:50px;"></th>
              <th style="width:170px;">Employee Name</th>
              <th style="width:170px;">Employee Number</th>
              <th style="width:170px;">Payroll Date</th>
              <th style="width:170px;">Interest</th>
              <th style="width:170px;">Principal</th>
              <th style="width:170px;">Credit Balance on Prinicpal</th>
              <th style="width:170px;">Loan Balance</th>
              <th style="width:170px;">Penalty</th>
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
	              <td>Payroll Date</td>
	              <td><?php print $row->interest_rates;?></td>
	              <td><?php print $row->principal;?></td>
	              <td>Credit Balance on Prinicpal</td>
	              <td>Loan Balance</td>
	              <td>Penalty</td>
	            </tr>
            <?php
            		}
            	}
            ?>
          </tbody></table>
          <!-- TBL-WRAP END -->
        </div>