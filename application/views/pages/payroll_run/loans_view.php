<div class="main-content">
	<?php $this->load->view('content_holders/payrollrun_loan_deduction_menu')?>
	<div class="tbl-wrap">
		<table width="1060" border="0" cellspacing="0" cellpadding="0" class="tbl">
			<tr>
				<th width="41">&nbsp;</th>
				<th width="116">Employee ID</th>
				<th width="176">Employee Name</th>
				<th width="116">Loan Number</th>
				<th width="116">Loan Type</th>
				<th width="116">Principal Due</th>
				<th width="121">Interest Due</th>
			</tr>
			<?php 
			if ($q) {
				foreach ($q as $key => $employee) {
			?>
			<tr>
				<td><?php echo $key+1?></td>
				<td><?php echo $employee->payroll_cloud_id?></td>
				<td><?php echo $employee->first_name.' '.$employee->middle_name.' '.$employee->last_name?></td>
				<td><?php echo $employee->loan_no?></td>
				<td><?php echo $employee->loan_type_name?></td>
				<td><?php echo $employee->principal?></td>
				<td><?php echo $employee->interest_rates?></td>
			</tr>
			<?php 
				}
			}
			?>
		</table>
	</div>
</div>
