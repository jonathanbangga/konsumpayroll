	<!-- hightlights -->
	<div class="successContBox ihide" id="arcane_boots">
		<div class="highlight_message"><?php echo $this->session->flashdata("success");?></div>
	</div>
	<!-- end highlights -->
	<?php
	if($get_payroll_group_setup) { 
		echo form_open('',array("onsubmit"=>"return tmp_validate();"));
		foreach($get_payroll_group_setup as $get_payr_key=>$get_payr):
			$thirteen_month	= $this->thirteen_month_pay->get_thirteen_month_values($this->company_id,$get_payr->payroll_group_id);
	?>		
			<!-- arcane boots meets krubelos -->
			<input type="hidden" name="thirteen_month_pay_id[]" value="<?php echo $thirteen_month ? $thirteen_month->thirteen_month_pay_id : '';?>" />
			<!-- end krubeloski -->
			
			<input type="hidden" name="payroll_group_id[]" value="<?php echo $get_payr->payroll_group_id;?>" />
			<p>How often do you process your 13th month pay for Payroll <?php echo $get_payr->name;?></p>
			<p>
			<select class="txtselect thirteen_month_process iselect_tmp jcheck" name="thirteen_month_process[]" >
				<option value="">SELECT</option>
				<option value="Monthly" <?php echo ($thirteen_month && $thirteen_month->process_by == "Monthly") ? 'selected="selected"': '';?>>Monthly</option>
				<option value="Semi-monthly" <?php echo ($thirteen_month && $thirteen_month->process_by == "Semi-monthly") ? 'selected="selected"': '';?>>Semi-Monthly</option>
				<option value="Quarterly" <?php echo ($thirteen_month && $thirteen_month->process_by == "Quarterly") ? 'selected="selected"': '';?>>Quarterly</option>
				<option value="Yearly" <?php echo ($thirteen_month && $thirteen_month->process_by == "Yearly") ? 'selected="selected"': '';?>>Yearly</option>
			</select>
			</p>
			<div class="tbl-wrap jmarkers_tble_zone" style="">
				<p class="jmarkers_pa">Select the payroll date when you will pay 13th month for payroll <?php echo $get_payr->name;?></p>
					 <table cellspacing="0" cellpadding="0" border="0" class="tbl jmarkers" jpid="<?php echo $get_payr->payroll_group_id;?>">
						<tbody>
						<tr>
						  <th style="width:136px;">Period</th>
						  <th style="width:136px;">Payroll Date</th>
						  <th style="width:136px;">From</th>
						  <th style="width:136px;">To</th>
						</tr>
						<tr class="ifirst_month imonth semi_mon">
							  <td>1st month</td>
							  <td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->first_month_payroll_date) : '';?>" name="first_month_payroll_date[]" class="txtfield jcheck jpaydate"></td>
							  <td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->first_month_payroll_from) : '';?>" name="first_month_payroll_from[]" class="txtfield jcheck jfirst_fr"></td>
							  <td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->first_month_payroll_to) : '';?>" name="first_month_payroll_to[]" class="txtfield jcheck jfirst_to"></td>
						</tr>
						<tr class="isecond_month imonth semi_mon">
							<td>2nd month</td>
							<td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->second_month_payroll_date) : '';?>" name="second_month_payroll_date[]" class="txtfield jcheck jpaydate"></td>
							<td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->second_month_payroll_from) : '';?>" name="second_month_payroll_from[]" class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->second_month_payroll_to) : '';?>" name="second_month_payroll_to[]" class="txtfield jcheck"></td>
						</tr>
						<tr class="ithird_month imonth semi_mon">
							<td>3rd month</td>
							<td><input style="width:115px;" type="text" name="third_month_payroll_date[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->third_month_payroll_date) : '';?>" class="txtfield jcheck jpaydate"></td>
							<td><input style="width:115px;" type="text" name="third_month_payroll_from[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->third_month_payroll_from) : '';?>" class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="third_month_payroll_to[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->third_month_payroll_to) : '';?>" class="txtfield jcheck"></td>
						</tr>
						<tr class="ifourth_month imonth semi_mon">
							<td>4th month</td>
							<td><input style="width:115px;" type="text" name="fourth_month_payroll_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->fourth_month_payroll_date) : '';?>" class="txtfield jcheck jpaydate"></td>
							<td><input style="width:115px;" type="text" name="fourth_month_payroll_from[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->fourth_month_payroll_from) : '';?>" class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="fourth_month_payroll_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->fourth_month_payroll_to) : '';?>" class="txtfield jcheck"></td>
						</tr>
						<tr class="ififth_month imonth semi_mon">
							<td>5th month</td>
							<td><input style="width:115px;" type="text" name="fifth_month_payroll_date[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->fifth_month_payroll_date) : '';?>"  class="txtfield jcheck jpaydate"></td>
							<td><input style="width:115px;" type="text" name="fifth_month_payroll_from[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->fifth_month_payroll_from) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="fifth_month_payroll_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->fifth_month_payroll_to) : '';?>"  class="txtfield jcheck"></td>
						</tr>
						<tr class="isix_month imonth semi_mon">
							<td>6th month</td>
							<td><input style="width:115px;" type="text" name="sixth_month_payroll_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->sixth_month_payroll_date) : '';?>"  class="txtfield jcheck jpaydate"></td>
							<td><input style="width:115px;" type="text" name="sixth_month_payroll_from[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->sixth_month_payroll_from) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="sixth_month_payroll_to[]"   value="<?php echo $thirteen_month ? idates_slash($thirteen_month->sixth_month_payroll_to) : '';?>"  class="txtfield jcheck"></td>
						</tr>
						<tr class="iseven_month imonth">
							<td>7th month</td>
							<td><input style="width:115px;" type="text" name="seventh_month_payroll_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->seventh_month_payroll_date) : '';?>"  class="txtfield jcheck jpaydate"></td>
							<td><input style="width:115px;" type="text" name="seventh_month_payroll_from[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->seventh_month_payroll_from) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="seventh_month_payroll_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->seventh_month_payroll_to) : '';?>"  class="txtfield jcheck"></td>
						</tr>
						<tr class="ieight_month imonth">
							<td>8th month</td>
							<td><input style="width:115px;" type="text" name="eight_month_payroll_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->eight_month_payroll_date) : '';?>"  class="txtfield jcheck jpaydate"></td>
							<td><input style="width:115px;" type="text" name="eight_month_payroll_from[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->eight_month_payroll_from) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="eight_month_payroll_to[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->eight_month_payroll_to) : '';?>"  class="txtfield jcheck"></td>
						</tr>
						<tr class="inine_month imonth">
							<td>9th month</td>
							<td><input style="width:115px;" type="text" name="ninth_month_payroll_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->ninth_month_payroll_date) : '';?>"  class="txtfield jcheck jpaydate"></td>
							<td><input style="width:115px;" type="text" name="ninth_month_payroll_from[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->ninth_month_payroll_from) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="ninth_month_payroll_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->ninth_month_payroll_to) : '';?>"  class="txtfield jcheck"></td>
						</tr>
						<tr class="iten_month imonth">
							<td>10th month</td>
							<td><input style="width:115px;" type="text" name="tenth_month_payroll_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->tenth_month_payroll_date) : '';?>" class="txtfield jcheck jpaydate"></td>
							<td><input style="width:115px;" type="text" name="tenth_month_payroll_from[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->tenth_month_payroll_from) : '';?>" class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="tenth_month_payroll_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->tenth_month_payroll_to) : '';?>" class="txtfield jcheck"></td>
						</tr>
						<tr class="ieleven_month imonth">
							<td>11th month</td>
							<td><input style="width:115px;" type="text" name="eleventh_month_payroll_date[]"   value="<?php echo $thirteen_month ? idates_slash($thirteen_month->eleventh_month_payroll_date) : '';?>"  class="txtfield jcheck jpaydate"></td>
							<td><input style="width:115px;" type="text" name="eleventh_month_payroll_from[]"   value="<?php echo $thirteen_month ? idates_slash($thirteen_month->eleventh_month_payroll_from) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="eleventh_month_payroll_to[]"   value="<?php echo $thirteen_month ? idates_slash($thirteen_month->eleventh_month_payroll_to) : '';?>"  class="txtfield jcheck"></td>
						</tr>
						<tr class="itwelve_month imonth">
							<td>12th month</td>
							<td><input style="width:115px;" type="text" name="twelveth_month_payroll_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->twelveth_month_payroll_date) : '';?>"  class="txtfield jcheck jpaydate"></td>
							<td><input style="width:115px;" type="text" name="twelveth_month_payroll_from[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->twelveth_month_payroll_from) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="twelveth_month_payroll_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->twelveth_month_payroll_to) : '';?>"  class="txtfield jcheck"></td>
						</tr>
						<tr class="itwelve_month imonth quarter ihide">
							<td>1st quarter</td>
							<td><input style="width:115px;" type="text" name="first_quarter_date[]"   value="<?php echo $thirteen_month ? idates_slash($thirteen_month->first_quarter_date) : '';?>"  class="txtfield jcheck jpaydate"></td>
							<td><input style="width:115px;" type="text" name="first_quarter_from[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->first_quarter_from) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="first_quarter_to[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->first_quarter_to) : '';?>"  class="txtfield jcheck"></td>
						</tr>
						 <tr class="itwelve_month imonth quarter ihide">
							<td>2nd quarter</td>
							<td><input style="width:115px;" type="text" name="second_quarter_date[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->second_quarter_date) : '';?>"  class="txtfield jcheck jpaydate"></td> 
							<td><input style="width:115px;" type="text" name="second_quarter_from[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->second_quarter_from) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="second_quarter_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->second_quarter_to) : '';?>"  class="txtfield jcheck"></td>
						</tr>
						 <tr class="itwelve_month imonth quarter ihide">
							<td>3st quarter</td>
							<td><input style="width:115px;" type="text" name="third_quarter_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->third_quarter_date) : '';?>"  class="txtfield jcheck jpaydate"></td>
							<td><input style="width:115px;" type="text" name="third_quarter_from[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->third_quarter_from) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="third_quarter_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->third_quarter_to) : '';?>"  class="txtfield jcheck"></td>
						</tr>
					</tbody>
				</table>
			</div>
			
			<div class="jiyear jyear_choose ihide">
			<p>Do you already have a schedule date when to release the 13month of the employeee?</p>
			<p><input type="text" name="thirteen_month_released_date[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->thirteen_month_released_date) : '';?>" class="thirteen_released txtfield jcheck" /> ( Optional ) </p>
			</div>
		
			<br />
			<div class="iseparate"></div>
			
			<?php
				if($thirteen_month){
					$the_tmp_id = $thirteen_month->thirteen_month_pay_id;
					$fourthen_result = $this->thirteen_month_pay->get_fourthenth_months($the_tmp_id,$this->company_id);	
					foreach($fourthen_result  as $tmp_key => $tmp_val):
			?>
					<!-- for looping more fourtheen -->
					<input type="hidden" name="uthirteen_month_pay_id[]" value="<?php echo $tmp_val ? $tmp_val->thirteen_month_pay_id : '';?>" />
					<!-- end krubeloski -->					
					<input type="hidden" name="upayroll_group_id[]" value="<?php echo $get_payr->payroll_group_id;?>" />
					<p>How often do you process your 13th month pay for Payroll <?php echo $get_payr->name;?></p>
					<p>
					<select class="txtselect thirteen_month_process iselect_tmp jcheck" name="uthirteen_month_process[]" >
						<option value="">SELECT</option>
						<option value="Monthly" <?php echo ($tmp_val && $tmp_val->process_by == "Monthly") ? 'selected="selected"': '';?>>Monthly</option>
						<option value="Semi-monthly" <?php echo ($tmp_val && $tmp_val->process_by == "Semi-monthly") ? 'selected="selected"': '';?>>Semi-Monthly</option>
						<option value="Quarterly" <?php echo ($tmp_val && $tmp_val->process_by == "Quarterly") ? 'selected="selected"': '';?>>Quarterly</option>
						<option value="Yearly" <?php echo ($tmp_val && $tmp_val->process_by == "Yearly") ? 'selected="selected"': '';?>>Yearly</option>
					</select>
					</p>
					<div class="tbl-wrap jmarkers_tble_zone" style="">
						<p class="jmarkers_pa">Select the payroll date when you will pay 13th month for payroll <?php echo $get_payr->name;?></p>
						 <table cellspacing="0" cellpadding="0" border="0" class="tbl jmarkers" jpid="<?php echo $get_payr->payroll_group_id;?>">
							<tbody>
							<tr>
							  <th style="width:136px;">Period</th>
							  <th style="width:136px;">Payroll Date</th>
							  <th style="width:136px;">From</th>
							  <th style="width:136px;">To</th>
							</tr>
							<tr class="ifirst_month imonth semi_mon">
								  <td>1st month</td>
								  <td><input style="width:115px;" type="text" value="<?php echo $tmp_val ? idates_slash($tmp_val->first_month_payroll_date) : '';?>" name="ufirst_month_payroll_date[]" class="txtfield jcheck jpaydate"></td>
								  <td><input style="width:115px;" type="text" value="<?php echo $tmp_val ? idates_slash($tmp_val->first_month_payroll_from) : '';?>" name="ufirst_month_payroll_from[]" class="txtfield jcheck jfirst_fr"></td>
								  <td><input style="width:115px;" type="text" value="<?php echo $tmp_val ? idates_slash($tmp_val->first_month_payroll_to) : '';?>" name="ufirst_month_payroll_to[]" class="txtfield jcheck jfirst_to"></td>
							</tr>
							<tr class="isecond_month imonth semi_mon">
								<td>2nd month</td>
								<td><input style="width:115px;" type="text" value="<?php echo $tmp_val ? idates_slash($tmp_val->second_month_payroll_date) : '';?>" name="usecond_month_payroll_date[]" class="txtfield jcheck jpaydate"></td>
								<td><input style="width:115px;" type="text" value="<?php echo $tmp_val ? idates_slash($tmp_val->second_month_payroll_from) : '';?>" name="usecond_month_payroll_from[]" class="txtfield jcheck"></td>
								<td><input style="width:115px;" type="text" value="<?php echo $tmp_val ? idates_slash($tmp_val->second_month_payroll_to) : '';?>" name="usecond_month_payroll_to[]" class="txtfield jcheck"></td>
							</tr>
							<tr class="ithird_month imonth semi_mon">
								<td>3rd month</td>
								<td><input style="width:115px;" type="text" name="uthird_month_payroll_date[]" value="<?php echo $tmp_val ? idates_slash($tmp_val->third_month_payroll_date) : '';?>" class="txtfield jcheck jpaydate"></td>
								<td><input style="width:115px;" type="text" name="uthird_month_payroll_from[]" value="<?php echo $tmp_val ? idates_slash($tmp_val->third_month_payroll_from) : '';?>" class="txtfield jcheck"></td>
								<td><input style="width:115px;" type="text" name="uthird_month_payroll_to[]" value="<?php echo $tmp_val ? idates_slash($tmp_val->third_month_payroll_to) : '';?>" class="txtfield jcheck"></td>
							</tr>
							<tr class="ifourth_month imonth semi_mon">
								<td>4th month</td>
								<td><input style="width:115px;" type="text" name="ufourth_month_payroll_date[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->fourth_month_payroll_date) : '';?>" class="txtfield jcheck jpaydate"></td>
								<td><input style="width:115px;" type="text" name="ufourth_month_payroll_from[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->fourth_month_payroll_from) : '';?>" class="txtfield jcheck"></td>
								<td><input style="width:115px;" type="text" name="ufourth_month_payroll_to[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->fourth_month_payroll_to) : '';?>" class="txtfield jcheck"></td>
							</tr>
							<tr class="ififth_month imonth semi_mon">
								<td>5th month</td>
								<td><input style="width:115px;" type="text" name="ufifth_month_payroll_date[]" value="<?php echo $tmp_val ? idates_slash($tmp_val->fifth_month_payroll_date) : '';?>"  class="txtfield jcheck jpaydate"></td>
								<td><input style="width:115px;" type="text" name="ufifth_month_payroll_from[]" value="<?php echo $tmp_val ? idates_slash($tmp_val->fifth_month_payroll_from) : '';?>"  class="txtfield jcheck"></td>
								<td><input style="width:115px;" type="text" name="ufifth_month_payroll_to[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->fifth_month_payroll_to) : '';?>"  class="txtfield jcheck"></td>
							</tr>
							<tr class="isix_month imonth semi_mon">
								<td>6th month</td>
								<td><input style="width:115px;" type="text" name="usixth_month_payroll_date[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->sixth_month_payroll_date) : '';?>"  class="txtfield jcheck jpaydate"></td>
								<td><input style="width:115px;" type="text" name="usixth_month_payroll_from[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->sixth_month_payroll_from) : '';?>"  class="txtfield jcheck"></td>
								<td><input style="width:115px;" type="text" name="usixth_month_payroll_to[]"   value="<?php echo $tmp_val ? idates_slash($tmp_val->sixth_month_payroll_to) : '';?>"  class="txtfield jcheck"></td>
							</tr>
							<tr class="iseven_month imonth">
								<td>7th month</td>
								<td><input style="width:115px;" type="text" name="useventh_month_payroll_date[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->seventh_month_payroll_date) : '';?>"  class="txtfield jcheck jpaydate"></td>
								<td><input style="width:115px;" type="text" name="useventh_month_payroll_from[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->seventh_month_payroll_from) : '';?>"  class="txtfield jcheck"></td>
								<td><input style="width:115px;" type="text" name="useventh_month_payroll_to[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->seventh_month_payroll_to) : '';?>"  class="txtfield jcheck"></td>
							</tr>
							<tr class="ieight_month imonth">
								<td>8th month</td>
								<td><input style="width:115px;" type="text" name="ueight_month_payroll_date[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->eight_month_payroll_date) : '';?>"  class="txtfield jcheck jpaydate"></td>
								<td><input style="width:115px;" type="text" name="ueight_month_payroll_from[]" value="<?php echo $tmp_val ? idates_slash($tmp_val->eight_month_payroll_from) : '';?>"  class="txtfield jcheck"></td>
								<td><input style="width:115px;" type="text" name="ueight_month_payroll_to[]" value="<?php echo $tmp_val ? idates_slash($tmp_val->eight_month_payroll_to) : '';?>"  class="txtfield jcheck"></td>
							</tr>
							<tr class="inine_month imonth">
								<td>9th month</td>
								<td><input style="width:115px;" type="text" name="uninth_month_payroll_date[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->ninth_month_payroll_date) : '';?>"  class="txtfield jcheck jpaydate"></td>
								<td><input style="width:115px;" type="text" name="uninth_month_payroll_from[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->ninth_month_payroll_from) : '';?>"  class="txtfield jcheck"></td>
								<td><input style="width:115px;" type="text" name="uninth_month_payroll_to[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->ninth_month_payroll_to) : '';?>"  class="txtfield jcheck"></td>
							</tr>
							<tr class="iten_month imonth">
								<td>10th month</td>
								<td><input style="width:115px;" type="text" name="utenth_month_payroll_date[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->tenth_month_payroll_date) : '';?>" class="txtfield jcheck jpaydate"></td>
								<td><input style="width:115px;" type="text" name="utenth_month_payroll_from[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->tenth_month_payroll_from) : '';?>" class="txtfield jcheck"></td>
								<td><input style="width:115px;" type="text" name="utenth_month_payroll_to[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->tenth_month_payroll_to) : '';?>" class="txtfield jcheck"></td>
							</tr>
							<tr class="ieleven_month imonth">
								<td>11th month</td>
								<td><input style="width:115px;" type="text" name="ueleventh_month_payroll_date[]"   value="<?php echo $tmp_val ? idates_slash($tmp_val->eleventh_month_payroll_date) : '';?>"  class="txtfield jcheck jpaydate"></td>
								<td><input style="width:115px;" type="text" name="ueleventh_month_payroll_from[]"   value="<?php echo $tmp_val ? idates_slash($tmp_val->eleventh_month_payroll_from) : '';?>"  class="txtfield jcheck"></td>
								<td><input style="width:115px;" type="text" name="ueleventh_month_payroll_to[]"   value="<?php echo $tmp_val ? idates_slash($tmp_val->eleventh_month_payroll_to) : '';?>"  class="txtfield jcheck"></td>
							</tr>
							<tr class="itwelve_month imonth">
								<td>12th month</td>
								<td><input style="width:115px;" type="text" name="utwelveth_month_payroll_date[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->twelveth_month_payroll_date) : '';?>"  class="txtfield jcheck jpaydate"></td>
								<td><input style="width:115px;" type="text" name="utwelveth_month_payroll_from[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->twelveth_month_payroll_from) : '';?>"  class="txtfield jcheck"></td>
								<td><input style="width:115px;" type="text" name="utwelveth_month_payroll_to[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->twelveth_month_payroll_to) : '';?>"  class="txtfield jcheck"></td>
							</tr>
							<tr class="itwelve_month imonth quarter ihide">
								<td>1st quarter</td>
								<td><input style="width:115px;" type="text" name="ufirst_quarter_date[]"   value="<?php echo $tmp_val ? idates_slash($tmp_val->first_quarter_date) : '';?>"  class="txtfield jcheck jpaydate"></td>
								<td><input style="width:115px;" type="text" name="ufirst_quarter_from[]" value="<?php echo $tmp_val ? idates_slash($tmp_val->first_quarter_from) : '';?>"  class="txtfield jcheck"></td>
								<td><input style="width:115px;" type="text" name="ufirst_quarter_to[]" value="<?php echo $tmp_val ? idates_slash($tmp_val->first_quarter_to) : '';?>"  class="txtfield jcheck"></td>
							</tr>
							 <tr class="itwelve_month imonth quarter ihide">
								<td>2nd quarter</td>
								<td><input style="width:115px;" type="text" name="usecond_quarter_date[]" value="<?php echo $tmp_val ? idates_slash($tmp_val->second_quarter_date) : '';?>"  class="txtfield jcheck jpaydate"></td> 
								<td><input style="width:115px;" type="text" name="usecond_quarter_from[]" value="<?php echo $tmp_val ? idates_slash($tmp_val->second_quarter_from) : '';?>"  class="txtfield jcheck"></td>
								<td><input style="width:115px;" type="text" name="usecond_quarter_to[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->second_quarter_to) : '';?>"  class="txtfield jcheck"></td>
							</tr>
							 <tr class="itwelve_month imonth quarter ihide">
								<td>3st quarter</td>
								<td><input style="width:115px;" type="text" name="uthird_quarter_date[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->third_quarter_date) : '';?>"  class="txtfield jcheck jpaydate"></td>
								<td><input style="width:115px;" type="text" name="uthird_quarter_from[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->third_quarter_from) : '';?>"  class="txtfield jcheck"></td>
								<td><input style="width:115px;" type="text" name="uthird_quarter_to[]"  value="<?php echo $tmp_val ? idates_slash($tmp_val->third_quarter_to) : '';?>"  class="txtfield jcheck"></td>
							</tr>
						</tbody>
					</table>
					</div>
					<div class="jiyear jyear_choose ihide">
						<p>Do you already have a schedule date when to release the 13month of the employeee?</p>
						<p><input type="text" name="uthirteen_month_released_date[]" value="<?php echo $tmp_val ? idates_slash($tmp_val->thirteen_month_released_date) : '';?>" class="thirteen_released txtfield jcheck" /> ( Optional ) </p>
					</div>			
					<br />
					<div class="iseparate"></div>
				<!-- end for looping -->
			
			<?php
					endforeach;
				}
			?>	
	<?php
		endforeach;
	?>
	
	<div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a href="/<?php echo $this->uri->segment(1);?>/payroll_setup/thirteen_month_pay_settings" class="btn btn-gray left">BACK</a> 
		<a href="/<?php echo $this->uri->segment(1);?>/payroll_setup/de_minimis" class="btn btn-gray right">CONTINUE</a>
        <input type="submit" value="SAVE" name="submit" class="btn right" style="margin-right:10px;">
        <!-- FOOTER-GRP-BTN END -->
    </div>
	
	<?php
		echo form_close();
	}
	?>

	<!-- lightboxes -->
	<?php 	if($get_payroll_group_setup){ ?>
	<div class="addnew_more ihide" title="Add more Payroll">
	<?php echo form_open('');?>
		<div class="more_thirteenski">
			<p>Select Payroll Group	
			<select name="update_choose_payrollgroup" class="txtselect juipdate">
				<option value="">Select</option>
			<?php 
				foreach($get_payroll_group_setup as $get_payr_key=>$get_payr):
					$update_thirteen_month	= $this->thirteen_month_pay->get_thirteen_month_values($this->company_id,$get_payr->payroll_group_id);
					echo '<option value="'.$get_payr->payroll_group_id.'" tmp_id="'.$update_thirteen_month->thirteen_month_pay_id.'">'.$get_payr->name.'</option>';
				endforeach;
			?>
			</select>
			</p>
				<input type="hidden" name="tmp_id" value="" />
				<p>How often do you process your 13th month pay for Payroll <span class="payrollgroupname"></span>
				<select class="txtselect thirteen_month_processupdate iselect_tmp jcheck" name="thirteen_month_processupdate" >
					<option value="">SELECT</option>
					<option value="Monthly">Monthly</option>
					<option value="Semi-monthly">Semi-Monthly</option>
					<option value="Quarterly">Quarterly</option>
					<option value="Yearly">Yearly</option>
				</select>
				</p>
			
			<div class="tbl-wrap jmarkers_tble_zone_update">
			<p class="jmarkers_pa">Select the payroll date when you will pay 14th month for payroll </p>
			  <table class="tbl jmarkers_update" border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <th style="width:136px;">Period</th>
				  <th style="width:136px;">Payroll Date</th>
				  <th style="width:136px;">From</th>
				  <th style="width:136px;">To</th>
				</tr>
				<tr class="ifirst_month imonthu semi_mon">
					  <td>1st month</td>
					  <td><input style="width:115px;" type="text" value="" name="first_month_payroll_date" class="txtfield ujpaydate jcheck "></td>
					  <td><input style="width:115px;" type="text" value="" name="first_month_payroll_from" class="txtfield jcheck jfirst_fr"></td>
					  <td><input style="width:115px;" type="text" value="" name="first_month_payroll_to" class="txtfield jcheck jfirst_to"></td>
				</tr>
				<tr class="isecond_month imonthu semi_mon">
					<td>2nd month</td>
					<td><input style="width:115px;" type="text" value="" name="second_month_payroll_date" class="txtfield  ujpaydate jcheck"></td>
					<td><input style="width:115px;" type="text" value="" name="second_month_payroll_from" class="txtfield jcheck"></td>
					<td><input style="width:115px;" type="text" value="" name="second_month_payroll_to" class="txtfield jcheck"></td>
				</tr>
				<tr class="ithird_month imonthu semi_mon">
					<td>3rd month</td>
					<td><input style="width:115px;" type="text" name="third_month_payroll_date" value="" class="txtfield ujpaydate jcheck"></td>
					<td><input style="width:115px;" type="text" name="third_month_payroll_from" value="" class="txtfield jcheck"></td>
					<td><input style="width:115px;" type="text" name="third_month_payroll_to" value="" class="txtfield jcheck"></td>
				</tr>
				<tr class="ifourth_month imonthu semi_mon">
					<td>4th month</td>
					<td><input style="width:115px;" type="text" name="fourth_month_payroll_date"  value="" class="txtfield ujpaydate jcheck"></td>
					<td><input style="width:115px;" type="text" name="fourth_month_payroll_from"  value="" class="txtfield jcheck"></td>
					<td><input style="width:115px;" type="text" name="fourth_month_payroll_to"  value="" class="txtfield jcheck"></td>
				</tr>
				<tr class="ififth_month imonthu semi_mon">
					<td>5th month</td>
					<td><input style="width:115px;" type="text" name="fifth_month_payroll_date" value=""  class="txtfield ujpaydate jcheck"></td>
					<td><input style="width:115px;" type="text" name="fifth_month_payroll_from" value=""  class="txtfield jcheck"></td>
					<td><input style="width:115px;" type="text" name="fifth_month_payroll_to"  value=""  class="txtfield jcheck"></td>
				</tr>
				<tr class="isix_month imonthu semi_mon">
					<td>6th month</td>
					<td><input style="width:115px;" type="text" name="sixth_month_payroll_date"  value=""  class="txtfield ujpaydate jcheck"></td>
					<td><input style="width:115px;" type="text" name="sixth_month_payroll_from"  value=""  class="txtfield jcheck"></td>
					<td><input style="width:115px;" type="text" name="sixth_month_payroll_to"   value=""  class="txtfield jcheck"></td>
				</tr>
				<tr class="iseven_month imonthu">
					<td>7th month</td>
					<td><input style="width:115px;" type="text" name="seventh_month_payroll_date"  value=""  class="txtfield ujpaydate jcheck"></td>
					<td><input style="width:115px;" type="text" name="seventh_month_payroll_from"  value=""  class="txtfield jcheck"></td>
					<td><input style="width:115px;" type="text" name="seventh_month_payroll_to"  value=""  class="txtfield jcheck"></td>
				</tr>
				<tr class="ieight_month imonthu">
					<td>8th month</td>
					<td><input style="width:115px;" type="text" name="eight_month_payroll_date"  value=""  class="txtfield ujpaydate jcheck"></td>
					<td><input style="width:115px;" type="text" name="eight_month_payroll_from" value=""  class="txtfield jcheck"></td>
					<td><input style="width:115px;" type="text" name="eight_month_payroll_to" value=""  class="txtfield jcheck"></td>
				</tr>
				<tr class="inine_month imonthu">
					<td>9th month</td>
					<td><input style="width:115px;" type="text" name="ninth_month_payroll_date"  value=""  class="txtfield ujpaydate jcheck"></td>
					<td><input style="width:115px;" type="text" name="ninth_month_payroll_from"  value=""  class="txtfield jcheck"></td>
					<td><input style="width:115px;" type="text" name="ninth_month_payroll_to"  value=""  class="txtfield jcheck"></td>
				</tr>
				<tr class="iten_month imonthu">
					<td>10th month</td>
					<td><input style="width:115px;" type="text" name="tenth_month_payroll_date"  value="" class="txtfield ujpaydate jcheck"></td>
					<td><input style="width:115px;" type="text" name="tenth_month_payroll_from"  value="" class="txtfield jcheck"></td>
					<td><input style="width:115px;" type="text" name="tenth_month_payroll_to"  value="" class="txtfield jcheck"></td>
				</tr>
				<tr class="ieleven_month imonthu">
					<td>11th month</td>
					<td><input style="width:115px;" type="text" name="eleventh_month_payroll_date"   value=""  class="txtfield ujpaydate jcheck"></td>
					<td><input style="width:115px;" type="text" name="eleventh_month_payroll_from"   value=""  class="txtfield jcheck"></td>
					<td><input style="width:115px;" type="text" name="eleventh_month_payroll_to"   value=""  class="txtfield jcheck"></td>
				</tr>
				<tr class="itwelve_month imonthu">
					<td>12th month</td>
					<td><input style="width:115px;" type="text" name="twelveth_month_payroll_date"  value=""  class="txtfield ujpaydate jcheck"></td>
					<td><input style="width:115px;" type="text" name="twelveth_month_payroll_from"  value=""  class="txtfield jcheck"></td>
					<td><input style="width:115px;" type="text" name="twelveth_month_payroll_to"  value=""  class="txtfield jcheck"></td>
				</tr>
				<tr class="itwelve_month imonthu ihide quarter">
					<td>1st quarter</td>
					<td><input style="width:115px;" type="text" name="first_quarter_date"   value=""  class="txtfield ujpaydate jcheck"></td>
					<td><input style="width:115px;" type="text" name="first_quarter_from" value=""  class="txtfield jcheck"></td>
					<td><input style="width:115px;" type="text" name="first_quarter_to" value=""  class="txtfield jcheck"></td>
				</tr>
				 <tr class="itwelve_month imonthu ihide quarter">
					<td>2nd quarter</td>
					<td><input style="width:115px;" type="text" name="second_quarter_date" value=""  class="txtfield jcheck"></td>
					<td><input style="width:115px;" type="text" name="second_quarter_from" value=""  class="txtfield jcheck"></td>
					<td><input style="width:115px;" type="text" name="second_quarter_to"  value=""  class="txtfield jcheck"></td>
				</tr>
				 <tr class="itwelve_month imonthu ihide quarter">
					<td>3st quarter</td>
					<td><input style="width:115px;" type="text" name="third_quarter_date"  value=""  class="txtfield jcheck"></td>
					<td><input style="width	:115px;" type="text" name="third_quarter_from"  value=""  class="txtfield jcheck"></td>
					<td><input style="width:115px;" type="text" name="third_quarter_to"  value=""  class="txtfield jcheck"></td>
				</tr>
			  </table>
			</div>
			<div class="jiyear ihide">
				<p>Do you already have a schedule date when to release the 13month of the employeee?</p>
				<p><input type="text" name="thirteen_month_released_date" value="" class="thirteen_released txtfield jcheck" /> ( Optional )</p>
			</div>
			<p>
			<input type="submit" value="SAVE" id="Iaddmore" name="add_more_submit" class="btn right" style="margin-right:10px;">
			</p>
			<br>
			</div>
			<div class="iseparate"></div>
		<?php echo form_close();?>
		</div>    
	<?php
	}
	?>
	<!-- end lightboxes -->
	<?php 	if($count_thirtheen) { ?>
		<p>Do you want to add another bonus month for Real Regular Group? Example 14th Month</p>
		<p>	<input style="margin-right:5px;" name="add_another_bonus[]" type="radio" value="yes"  class="jadd_another_bonus jcheck">Yes &nbsp;&nbsp;
		<input style="margin-right:5px;" name="add_another_bonus[]" type="radio" value="no" class="jadd_another_bonus  jcheck" >No
		</p>
	<?php 	} ?>
	
<script type="text/javascript">
	var itoken = "<?php echo itoken_cookie();?>";
	// SELECT 13 month
	function select_tmp_options(){
		jQuery(".imonth input,.imonthu input").datepicker({
			dateFormat:'yy-mm-dd',
			changeYear: true
		});
		
		
		jQuery(".thirteen_released").datepicker({dateFormat:'yy-mm-dd',changeYear: true});
		jQuery("input[name='schedule_date_release']").datepicker({dateFormat:'yy-mm-dd'});
			jQuery(document).on("change",".thirteen_month_process",function(e){  
				var el = jQuery(this);
				var real_eq = jQuery(".thirteen_month_process").index(this);    
				var txt = el.val().toLowerCase();
				jQuery(".jmarkers_tble_zone:eq(" + real_eq + ")").show('fast');
				jQuery(".jiyear:eq(" + real_eq + ")").hide();
				jQuery(".jmarkers:eq("+real_eq+") input").val('');
				switch(txt){
					case "monthly":		
						jQuery(".jmarkers:eq("+real_eq+") .imonth").show('slow');
						jQuery(".jmarkers:eq("+real_eq+") .quarter").hide();		
					break;
					case "semi-monthly":	
						jQuery(".jmarkers:eq("+real_eq+") .imonth").hide('slow');
						jQuery(".jmarkers:eq("+real_eq+") .semi_mon").show('slow');
					break;
					case "quarterly":
						jQuery(".jmarkers:eq("+real_eq+") .imonth").hide('fast');
						jQuery(".jmarkers:eq("+real_eq+") .quarter").show('slow');	
					break;
					case "yearly":
						jQuery(".jmarkers:eq("+real_eq+") .imonth").hide('fast');
						jQuery(".jmarkers:eq("+real_eq+") .yearly").show('slow');
						
						jQuery(".jmarkers_tble_zone:eq(" + real_eq + ")").hide();
						jQuery(".jiyear:eq(" + real_eq + ")").fadeIn('slow');
					break;
					default:
						jQuery(".jmarkers:eq("+real_eq+") .imonth").hide('fast');
					break;
				}
			});
	}
	
	// THIS WILL DISPLAYS ALREADY BEEN SET VALUE
	function display_tmp_table() {
		jQuery(".jmarkers_tble_zone").show();
		jQuery(".iselect_tmp").each(function (e) {
			var el = jQuery(this);
			var real_eq = jQuery(".iselect_tmp").index(this);
			var txt = el.val().toLowerCase();
			if(txt){
				jQuery(".jmarkers_tble_zone:eq(" + real_eq + ")").show('fast');
				jQuery(".jiyear:eq(" + real_eq + ")").hide();
				switch(txt) {
					case "monthly":
						jQuery(".jmarkers:eq(" + real_eq + ") .imonth").show('slow');
						jQuery(".jmarkers:eq(" + real_eq + ") .quarter").hide();
						break;
					case "semi-monthly":
						jQuery(".jmarkers:eq(" + real_eq + ") .imonth").hide('slow');
						jQuery(".jmarkers:eq(" + real_eq + ") .semi_mon").show('slow');
						break;
					case "quarterly":
						jQuery(".jmarkers:eq(" + real_eq + ") .imonth").hide('fast');
						jQuery(".jmarkers:eq(" + real_eq + ") .quarter").show('slow');
						break;
					case "yearly":
						jQuery(".jmarkers:eq(" + real_eq + ") .imonth").hide('fast');
						jQuery(".jmarkers:eq(" + real_eq + ") .yearly").show('slow');
						jQuery(".jmarkers_tble_zone:eq(" + real_eq + ")").hide();
						jQuery(".jiyear:eq(" + real_eq + ")").fadeIn('slow');
						break;
					default:
						jQuery(".jmarkers:eq(" + real_eq + ") .imonth").hide('fast');
						jQuery(".jmarkers_tble_zone:eq(" + real_eq + ")").show('fast');
					break;
				}
			}else{

			}
		});
	}     
	
	// IVALIDATE THE FORM
	function tmp_validate(){	
		jQuery(".imonth input").removeClass("emp_str");
		ierror_field(".imonth input:visible");
		ierror_field(".thirteen_month_process") 
		var imonth = ierror_mark(".imonth input");
		var iselects = 	ierror_mark(".thirteen_month_process");
		
		if(imonth > 0 || iselects >0){
			return false;
		}else{
			return true;
		}
		return false;
	}
	
	function display_tmp_table() {
		jQuery(".jmarkers_tble_zone").show();
		jQuery(".iselect_tmp").each(function (e) {
			var el = jQuery(this);
			var real_eq = jQuery(".iselect_tmp").index(this);
			var txt = el.val().toLowerCase();
			if(txt){
				jQuery(".jmarkers_tble_zone:eq(" + real_eq + ")").show('fast');
				jQuery(".jiyear:eq(" + real_eq + ")").hide();
				switch(txt) {
					case "monthly":
						jQuery(".jmarkers:eq(" + real_eq + ") .imonth").show('slow');
						jQuery(".jmarkers:eq(" + real_eq + ") .quarter").hide();
						break;
					case "semi-monthly":
						jQuery(".jmarkers:eq(" + real_eq + ") .imonth").hide('slow');
						jQuery(".jmarkers:eq(" + real_eq + ") .semi_mon").show('slow');
						break;
					case "quarterly":
						jQuery(".jmarkers:eq(" + real_eq + ") .imonth").hide('fast');
						jQuery(".jmarkers:eq(" + real_eq + ") .quarter").show('slow');
						break;
					case "yearly":
						jQuery(".jmarkers:eq(" + real_eq + ") .imonth").hide('fast');
						jQuery(".jmarkers:eq(" + real_eq + ") .yearly").show('slow');
						jQuery(".jmarkers_tble_zone:eq(" + real_eq + ")").hide();
						jQuery(".jiyear:eq(" + real_eq + ")").fadeIn('slow');
						break;
					default:
						jQuery(".jmarkers:eq(" + real_eq + ") .imonth").hide('fast');
						jQuery(".jmarkers_tble_zone:eq(" + real_eq + ")").show('fast');
					break;
				}
			}else{

			}
		});
	}     
	
	// AJAX EXPERIMENTAL SA
	function get_date_ajax(){
		$(document).on('change','.jpaydate',function(e) {
			var el = jQuery(this);
			var getindex = el.parents("tr");	
			var url = "/<?php echo $this->uri->segment(1);?>/payroll_setup/thirteen_month_pay/ajax_fill_dates_payroll";
			var pgi = el.parents("table").attr("jpid");
			jQuery.post(url,{
			  "payroll_date":el.val(),
			  "ZGlldmlyZ2luamM":jQuery.cookie(itoken),
			  "payroll_group_id":pgi
			},function(json){
				var res = jQuery.parseJSON(json);
				console.log(getindex);
				getindex.find("input:eq(1)").val(res.fields.cut_off_from);
				getindex.find("input:eq(2)").val(res.fields.cut_off_to);
			});
		});
		
		$(document).on('change','.ujpaydate',function(e) {
			var el = jQuery(this);
			var getindex = el.parents("tr");	
			var url = "/<?php echo $this->uri->segment(1);?>/payroll_setup/thirteen_month_pay/ajax_fill_dates_payroll";
			var pgi = jQuery("select[name='update_choose_payrollgroup'] option:selected").val();
			jQuery.post(url,{
			  "payroll_date":el.val(),
			  "ZGlldmlyZ2luamM":jQuery.cookie(itoken),
			  "payroll_group_id":pgi
			},function(json){
				var res = jQuery.parseJSON(json);
				console.log(getindex);
				getindex.find("input:eq(1)").val(res.fields.cut_off_from);
				getindex.find("input:eq(2)").val(res.fields.cut_off_to);
			});
		});
	}
	
	// LGIHTBOXES
	function add_yes(){
		jQuery(document).on("change",".jadd_another_bonus",function(e){
			var el = jQuery(this);
			if(el.val() == 'yes'){
				var pid = el.attr("jpgid");
				var tmp_id = el.attr("tmp_id");
				jQuery("input[name='update_payroll_group_id']").val(pid);
				jQuery("input[name='tmp_id']").val(tmp_id);
				kpay.overall.show_pops(".addnew_more");
			}else{
			}
		});
	}
	
	// for add yes lightboxes chooses often process
	function add_more_yes(){
		jQuery("input[name='schedule_date_release']").datepicker({dateFormat:'yy-mm-dd'});
		jQuery(document).on("change",".thirteen_month_processupdate",function(e){  
			var el = jQuery(this);		
			var txt = el.val().toLowerCase();
			jQuery(".jmarkers_tble_zone_update").show('fast');
			jQuery(".addnew_more .jiyear").hide();
			jQuery(".jmarkers_update input").val('');
			switch(txt){
				case "monthly":		
					jQuery(".jmarkers_update .imonthu").show('slow');
					jQuery(".jmarkers_update .quarter").hide();		
				break;
				case "semi-monthly":	
					jQuery(".jmarkers_update .imonthu").hide('slow');
					jQuery(".jmarkers_update .semi_mon").show('slow');
				break;
				case "quarterly":
					jQuery(".jmarkers_update .imonthu").hide('fast');
					jQuery(".jmarkers_update .quarter").show('slow');	
				break;
				case "yearly":
					jQuery(".jmarkers_update .imonthu").hide('fast');
					jQuery(".addnew_more .yearly").show('slow');
					
					jQuery(".jmarkers_tble_zone_update").hide();
					jQuery(".addnew_more .jiyear").fadeIn('slow');
				break;
				default:
					jQuery(".jmarkers_update .imonthu").hide('fast');
				break;
			}
		});
	}
	
	// tmp choose for more lightboxes 
	function choose_payrollgroup(){
		jQuery(document).on("change",".juipdate",function(e){
			var el = jQuery(this);
			jQuery("input[name='tmp_id']").val(el.find("option:selected").attr('tmp_id'));
		});
	}
	
	jQuery(function(){
		select_tmp_options();	
		hightlight_success();
		get_date_ajax();
		add_yes();
		add_more_yes();
		choose_payrollgroup();
		display_tmp_table();
	});
	
	jQuery(window).load(function(){
		display_tmp_table();
		setTimeout(function(){
			display_tmp_table();
		},1000);
	});
</script>
	
	
	