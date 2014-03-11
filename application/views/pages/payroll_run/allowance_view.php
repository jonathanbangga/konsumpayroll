<div class="main-content">
	<div class="tbl-wrap">
		<table width="805" border="0" cellspacing="0" cellpadding="0" class="tbl">
			<tr>
				<th width="41">&nbsp;</th>
				<th width="116">Employee ID</th>
				<th width="166">Employee Name</th>
				<th width="116">Allowance Type</th>
				<th width="118">Taxable</th>
				<th width="116">Amount</th>
			</tr>
			<?php 
			if ($q) {
				foreach ($q as $key => $employee) {
			?>
			<tr>
				<td><?php echo $key+1?></td>
				<td><?php echo $employee->payroll_cloud_id?></td>
				<td><?php echo $employee->first_name.' '.$employee->middle_name.' '.$employee->last_name?></td>
				<td><?php echo $employee->allowance_type_name?></td>
				<td><?php echo $employee->taxable?></td>
				<td><?php echo $employee->amount?></td>
			</tr>
			<?php 
				}
			}			
			?>
		</table>
	</div>
	<div class="pagination left" style="margin-top: -25px; margin-left:35%"><?php echo $links?></div>
</div>
