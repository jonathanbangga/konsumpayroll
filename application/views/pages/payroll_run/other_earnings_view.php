<div class="main-content">
	<!-- MAIN-CONTENT START -->
	<?php $this->load->view('content_holders/payrollrun_commission_menu')?>
	<?php echo form_open()?>
	<div class="tbl-wrap">
		<table width="1330" border="0" cellspacing="0" cellpadding="0" class="tbl table-form">
			<tr>
				<th width="41">&nbsp;</th>
				<th width="116">Employee ID</th>
				<th width="171">Employee Name</th>
				<th width="121">Sales Amount</th>
				<th width="121">Earning Type</th>
				<th width="145">Witholding Tax Rate</th>
				<th width="145">Amount</th>
			</tr>
			<?php 
			if ($q) {
				foreach ($q as $key => $employee) {
				?>
			<tr id="<?php echo $employee->account_id?>">
				<td><?php echo $key+1;?></td>
				<td><?php echo $employee->payroll_cloud_id?></td>
				<td><?php echo $employee->first_name.' '.$employee->middle_name.' '.$employee->last_name?></td>
				<td>	<!-- Sales Amount -->
					<div class="d"><?php echo $employee->sales_amount?></div>
					<div class="e"><input type="text" class="sales_amount txtfield maxheight" name="sales_amount[<?php echo $employee->account_id?>]"
						value="<?php echo $employee->sales_amount?>" /></div>
				</td>
				<td>	<!-- Earning Type -->
					<div class="d">
					<?php 
					$q2 = $this->ecm->get_earning($employee->earning_id,$this->company_id);
					echo ($q2) ? $q2->earning_name : '';
					?>
					</div>
					<div class="e">
						<select class="earning_id txtselect" name="earning_id[<?php echo $employee->account_id?>]">
							<option value="">Select</option>
						<?php 
						foreach ($q1 as $earning) {
							$sel  = ($earning->earning_id == $employee->earning_id) ? 'selected="selected"' : '';
							echo '<option value="'.$earning->earning_id.'" '.$sel.'>'.$earning->earning_name.'</option>';
						}
						?>
						</select>
					</div>
				</td>
				<td class="tax_rate"><?php echo $employee->tax_rate?></td>
				<td class="amount"><?php echo $employee->amount?></td>
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
	<?php echo form_close()?>
	<!-- MAIN-CONTENT END -->
</div>

<script type="text/javascript">
var settings = {
		tn : '<?php echo itoken_cookie()?>'
}
$(document).ready(function(){
	enc.init();
	enc.earning();
});
</script>