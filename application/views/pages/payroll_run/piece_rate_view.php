<div class="main-content">
	<?php $this->load->view('content_holders/payrollrun_commission_menu')?>
	<div class="tbl-wrap">
		<table width="1330" border="0" cellspacing="0" cellpadding="0" class="tbl">
			<tr>
				<th width="41">&nbsp;</th>
				<th width="116">Employee ID</th>
				<th width="171">Employee Name</th>
				<th width="121">Date</th>
				<th width="121">Piece Rate Type</th>
				<th width="91">Rate %</th>
				<th width="145">Units Produced</th>
				<th width="145">Piece Rate Amount</th>
			</tr>
			<?php 
			if ($q) {
				foreach ($q as $key => $employee) {
			?>
			<tr id="<?php echo $employee->account_id?>">
				<td><?php echo $key+1?></td>
				<td><?php echo $employee->payroll_cloud_id?></td>
				<td><?php echo $employee->first_name.' '.$employee->middle_name.' '.$employee->last_name?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<?php
				}
			} 
			?>
			
		</table>
	</div>
	<div class="pagination left" style="margin-top: -25px; margin-left:35%"><?php echo $links?></div>
	<div class="group-btns right" style="margin-top: -25px;">
		<button type="button" class="btn updateBtn">Update</button>
		<button type="submit" class="btn e saveBtn">Save</button>
	</div>
	<!-- MAIN-CONTENT END -->
</div>
<div
	class="footer-grp-btn" style="width: 820px;">
	<!-- FOOTER-GRP-BTN START -->
	<a class="btn btn-gray left" href="#">BACK</a> <input class="btn right"
		name="" type="button" value="SAVE">
	<!-- FOOTER-GRP-BTN END -->
</div>
<!-- RBOX END -->
</div>
