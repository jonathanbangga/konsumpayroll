<div class="tbl-wrap">
	<h1>Loan History</h1>
	<?php print $this->session->flashdata('message');?>
	<div class="loan_history_cont">
		<select style='width: 175px;' class='txtselect select-medium loan_type' name='loan_type'><?php if($loan_type == null){ print "<option value=''>".msg_empty()."</option>"; }else{ foreach($loan_type as $row_lype){?> <option value='<?php print $row_lype->loan_type_id;?><?php echo set_select('loan_type[]', $row_lype->loan_type_id); ?>'><?php print $row_lype->loan_type_name;?></option><?php } }?></select>
	</div>
	<table style="width:933px;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:auto;">Loan Type</th>
              <th style="width:auto;">Loan Number</th>
              <th style="width:auto;">Date Granted</th>
              <th style="width:auto">Principal</th>
              <th style="width:auto;">Loan Balance</th>
              <th style="width:auto;">Monthly Amortazation</th>
              <th style="width:auto">Interest Rate</th>
              <th style="width:auto">Action</th>
            </tr>
		<?php 
			if($loan != null){
				foreach($loan as $row){
		?>
			<tr>
				<td><?php print $row->loan_type_name;?></td>
				<td><?php print $row->loan_no;?></td>
				<td><?php print $row->date_granted;?></td>
				<td><?php print $row->principal;?></td>
				<td>Loan Balance</td>
				<td><?php print $row->monthly_amortization;?></td>
				<td><?php print $row->interest_rates;?></td>
				<td><a class="btn" href="/<?php print $this->uri->segment(1);?>/employee/emp_payment_history/<?php print $row->employee_loans_id;?>">PAYMENT HISTORY</a></td>
			</tr>
		<?php 		
				}
			}else{
            		print "<tr class='msg_empt_cont'><td colspan='12' style='text-align:left;'>".msg_empty()."</td></tr>";
            	}
		?>
	</table>
</div>