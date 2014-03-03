
<div class="successContBox highlight_message" style="display: none;"><?php echo $this->session->flashdata("delete_success");?></div>
	<div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl" style="width:100%;">
            <tbody>
				<tr>
					<th style="width:50px;"><input type="checkbox" name="odeleteall" /></th>
					<th style="width:135px">Employee ID</th>
					<th style="width:200px">Employee Name</th>
					<th style="width:160px">Overtime Date</th>
					<th style="width:160px">Overtime Type</th>
					<th style="width:160px">Rate (%)</th>
					<th style="width:160px">Start Time</th>
					<th style="width:160px">End Time</th>
					<th style="width:160px">Total Time</th>
				</tr>
				<?php
					if($list){
						foreach($list as $list_key=>$list_val):
				?>
				<tr>
					<td><span class="payroll_group_span"><input type="checkbox" name="overtime_id[]" value="<?php echo $list_val->overtime_id;?>" /></span></td>
					<td><span class="payroll_group_span"><?php echo $list_val->payroll_cloud_id;?></span></td>
					<td><span class="payroll_group_span"><?php echo $list_val->first_name." ".$list_val->last_name;?></span></td>
					<td><span class="payroll_group_span"><?php echo date("d/m/Y",strtotime($list_val->overtime_from)); ?></span></td>
					<?php
						$overtime_data = $this->overtime->overtime_type($list_val->company_id,$list_val->overtime_from); 
						if($overtime_data){
					?>
					<td><span class="payroll_group_span"><?php echo $overtime_data->hour_type_name;?></span></td>
					<td><span class="payroll_group_span"><?php echo $overtime_data->ot_rate > 0 ? $overtime_data->ot_rate."%" : "0%";?></span></td>
					<?php
						}else{
							$ot_default = $this->overtime->overtime_default($list_val->company_id);
					?>
					<td><span class="payroll_group_span"><?php echo $ot_default->hour_type_name;?></span></td>
					<td><span class="payroll_group_span"><?php echo number_format($ot_default->ot_rate,1)."%";?></span></td>
					<?php
						}
					?>
					<td><span class="payroll_group_span"><?php echo $list_val->start_time;?></span></td>
					<td><span class="payroll_group_span"><?php echo $list_val->end_time;?></span></td>
					<td><span class="payroll_group_span">
					<?php 
							$start_d = strtotime($list_val->start_time);
							$end_d	= strtotime($list_val->end_time);
							$minus =  ($end_d - $start_d);
							$total_val = $minus / (60*60);
							echo number_format($total_val,2);			
					?>
					</span></td>
				<?php
						endforeach;
					}
				?>
				</tr>
            </tbody>
          </table>
          <!-- TBL-WRAP END -->
	</div>
	<div class="left pagi-lefts"><?php echo ($list) ? '<a class="btn" href="javascript:void(0);" id="overtime_idelete">DELETE</a>' : '';?></div>
	<div class="right pagi-rights"><?php echo $pagi;?></div>
	
	<script type="text/javascript">
		var token = "<?php echo itoken_cookie();?>";
		
		// REMOVES THE APPLICATION ON OVERTIME DELETE IT COMPLETELY
		function delete_overtime(){
			jQuery(document).on("click", "#overtime_idelete", function (e) {
						e.preventDefault();
						var el = jQuery(this);
						var oid = array_fields("input[name='overtime_id[]']:checked");
						if(oid == ""){
							return false;
						}
						var message = "Are you sure you want to delete this overtime application?";
						jQuery(".opt_selection").empty().html(message);
						jQuery(".opt_selection").dialog({
							resizable: false,
							draggable: false,
							height: 150,
							modal: true,
							width: '320',
							maxWidth: '600',
							buttons: {
								"Yes": function () {
									var urls = "/<?php echo $this->uri->segment(1);?>/payroll_run/overtime/ajax_remove_overtime";
									var return_url = "/<?php echo $this->uri->segment(1);?>/payroll_run/overtime/lists";			
									jQuery.post(urls,{	
									'oid':oid,
									'ZGlldmlyZ2luamM':jQuery.cookie(token),
									},function(d){
										var res = jQuery.parseJSON(d);
										if(res.success == true){
											window.location.href = return_url;
										}else{
											alert("Error encountered please refresh again,if problem still persist please contact administrator");
										}
										jQuery(".opt_selection").dialog("close");	
									});
									
								},
								No: function () {
									jQuery(".opt_selection").dialog("close");
								}
							}
						});
			});
		}
		
		// SELECT ALL 
		
		jQuery(function(){
			delete_overtime();
			god_signs();
			icheck_box("odeleteall","overtime_id[]");
		});
	</script>
	
	
	<!-- FOR TESTING -->
	
	<br/>
	<br/>
	
	Overtime =
	
	<?php 
		print get_overtime_emp('78');
	?>
	
	<br/>
	<br/>
	
	Holiday Premium = 
	
	<?php 
		print get_holiday_premium('78');
	?>
	
	<br/>
	<br/>
	
	Night Differential = 
	<?php 
		print get_night_diff('78');
	?>
	
	<br/>
	<br/>
	
	Withholding Tax
	<br/>
	<br/>
	
	Period Type (Monthly / Semi-Monthly) = 
	<?php 
		$peroid_type = get_period_type('78');
		print $peroid_type->period_type;
	?> 
	<br/>
	<br/>
	
	Basic Pay (Set By Month) = 
	
	<?php 
		$peroid_type = get_period_type('78');
		print get_basic_pay('78', $peroid_type->pay_rate_type);
	?> 
	<br/>
	<br/>
	
	PAGIBIG = <?php print get_pagibig();?>
	<br/>
	<br/>
	PHILHEALTH = 
	<?php 
		$peroid_type = get_period_type('78');
		$basic_pay = get_basic_pay('78', $peroid_type->pay_rate_type);
		
		print get_philhealth($basic_pay);
	?>
	<br/>
	<br/>
	SSS = 
	<?php 
		$peroid_type = get_period_type('78');
		$basic_pay = get_basic_pay('78', $peroid_type->pay_rate_type);
		
		print get_sss($basic_pay);
	?>
	<br/>
	<br/>
	Tardiness = 
	<?php 
		print get_tardiness('78');				
	?>
	<br/>
	<br/>
	Undertime = 
	<?php 
		print get_undertime('78');				
	?>
	<br/>
	<br/>
	No of days for payroll period = 
	<?php 
		print no_days_payroll_period('78');
	?>
	<br/>
	<br/>
	Days Timein = 
	<?php 
		$days_timeins = get_days_timeins('78');
		print $days_timeins;
	?>
	<br/>
	<br/>
	Absences = 
	<?php 
		print no_days_payroll_period('78') - get_days_timeins('78');
	?>
	<br/>
	<br/>
	Allowances = 
	<?php 
		print get_allowances('78');
	?>
	<br/>
	<br/>
	<hr>
	<br/>
	<br/>
	Semi Monthly
	<br/>
	<br/>
	<?php 
		$emp_id = '78';
		$peroid_type = get_period_type($emp_id);
		if($peroid_type->period_type == "Semi Monthly"){
			$new_basic_pay = get_basic_pay($emp_id, $peroid_type->pay_rate_type) / 2;
			
			// for SSS
			$sss = get_sss($new_basic_pay);
			
			// for PAGIBIG
			$pagibig = get_pagibig($emp_id);
			
			// for PHILHEALTH
			$philhealth = get_philhealth($basic_pay);
			
			// for Allowance
			$allowance = get_allowances($emp_id);
			
			// deductions
			$total_basic_pay = $new_basic_pay - $sss - $pagibig - $philhealth + $allowance;
			
			// for withholding tax semi monthly
			$withholding_tax_semi_monthly = get_withholding_tax_semi_monthly($total_basic_pay, $emp_id);
			
			#print $total_basic_pay;
			print $withholding_tax_semi_monthly;
		}
	?>