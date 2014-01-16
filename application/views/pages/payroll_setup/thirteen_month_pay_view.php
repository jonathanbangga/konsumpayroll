<?php echo form_open('',array("onsubmit"=>"return tmp_validate();"));?>
	<div class="successContBox ihide">
		<div class="highlight_message"><?php echo $this->session->flashdata("success");?></div>
	</div>

	<div class="main-content">
        <!-- MAIN-CONTENT START -->
        <?php if($get_payroll_group_setup){      
        	foreach($get_payroll_group_setup as $get_payr_key=>$get_payr):
        
        	$thirteen_month	= $this->thirteen_month_pay->get_thirteen_month_pay($this->company_id,$get_payr->payroll_group_id,$get_payr->thirteen_month_pay_id);
        	
        ?>
	        <div class="more_thirteenski">
	        	<input type="hidden" name="thirteen_month_pay_id[]" value="<?php  echo $thirteen_month ? $get_payr->thirteen_month_pay_id : '';?>" />
		        <input type="hidden" name="payroll_group_id[]" value="<?php echo $get_payr->payroll_group_id;?>" />
		        <p>How often do you process your 13th month pay for Payroll <?php echo $get_payr->name;?></p>
		        <select class="txtselect thirteen_month_process iselect_tmp jcheck" name="thirteen_month_process[]" >
		        	<option value="">SELECT</option>
		        	<option value="Monthly" <?php echo ($thirteen_month && $thirteen_month->process_by == "Monthly") ? 'selected="selected"': '';?>>Monthly</option>
		        	<option value="Semi-monthly" <?php echo ($thirteen_month && $thirteen_month->process_by == "Semi-monthly") ? 'selected="selected"': '';?>>Semi-Monthly</option>
		        	<option value="Quarterly" <?php echo ($thirteen_month && $thirteen_month->process_by == "Quarterly") ? 'selected="selected"': '';?>>Quarterly</option>
		        	<option value="Yearly" <?php echo ($thirteen_month && $thirteen_month->process_by == "Yearly") ? 'selected="selected"': '';?>>Yearly</option>
		        </select>
	        <br>
	        <br>
	        <br>
	        <div class="tbl-wrap jmarkers_tble_zone">
				<p class="jmarkers_pa">Select the payroll date when you will pay 13th month for payroll <?php echo $get_payr->name;?></p>
					  <table class="tbl jmarkers" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <th style="width:136px;">Period</th>
						  <th style="width:136px;">Payroll Date</th>
						  <th style="width:136px;">From</th>
						  <th style="width:136px;">To</th>
						</tr>
						<tr class="ifirst_month imonth semi_mon">
							  <td>1st month</td>
							  <td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->first_month_payroll_date) : '';?>" name="first_month_payroll_date[]" class="txtfield jcheck "></td>
							  <td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->first_month_payroll_from) : '';?>" name="first_month_payroll_from[]" class="txtfield jcheck jfirst_fr"></td>
							  <td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->first_month_payroll_to) : '';?>" name="first_month_payroll_to[]" class="txtfield jcheck jfirst_to"></td>
						</tr>
						<tr class="isecond_month imonth semi_mon">
							<td>2nd month</td>
							<td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->second_month_payroll_date) : '';?>" name="second_month_payroll_date[]" class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->second_month_payroll_from) : '';?>" name="second_month_payroll_from[]" class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->second_month_payroll_to) : '';?>" name="second_month_payroll_to[]" class="txtfield jcheck"></td>
						</tr>
						<tr class="ithird_month imonth semi_mon">
							<td>3rd month</td>
							<td><input style="width:115px;" type="text" name="third_month_payroll_date[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->third_month_payroll_date) : '';?>" class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="third_month_payroll_from[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->third_month_payroll_from) : '';?>" class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="third_month_payroll_to[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->third_month_payroll_to) : '';?>" class="txtfield jcheck"></td>
						</tr>
						<tr class="ifourth_month imonth semi_mon">
							<td>4th month</td>
							<td><input style="width:115px;" type="text" name="fourth_month_payroll_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->fourth_month_payroll_date) : '';?>" class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="fourth_month_payroll_from[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->fourth_month_payroll_from) : '';?>" class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="fourth_month_payroll_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->fourth_month_payroll_to) : '';?>" class="txtfield jcheck"></td>
						</tr>
						<tr class="ififth_month imonth semi_mon">
							<td>5th month</td>
							<td><input style="width:115px;" type="text" name="fifth_month_payroll_date[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->fifth_month_payroll_date) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="fifth_month_payroll_from[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->fifth_month_payroll_from) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="fifth_month_payroll_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->fifth_month_payroll_to) : '';?>"  class="txtfield jcheck"></td>
						</tr>
						<tr class="isix_month imonth semi_mon">
							<td>6th month</td>
							<td><input style="width:115px;" type="text" name="sixth_month_payroll_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->sixth_month_payroll_date) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="sixth_month_payroll_from[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->sixth_month_payroll_from) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="sixth_month_payroll_to[]"   value="<?php echo $thirteen_month ? idates_slash($thirteen_month->sixth_month_payroll_to) : '';?>"  class="txtfield jcheck"></td>
						</tr>
						<tr class="iseven_month imonth">
							<td>7th month</td>
							<td><input style="width:115px;" type="text" name="seventh_month_payroll_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->seventh_month_payroll_date) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="seventh_month_payroll_from[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->seventh_month_payroll_from) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="seventh_month_payroll_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->seventh_month_payroll_to) : '';?>"  class="txtfield jcheck"></td>
						</tr>
						<tr class="ieight_month imonth">
							<td>8th month</td>
							<td><input style="width:115px;" type="text" name="eight_month_payroll_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->eight_month_payroll_date) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="eight_month_payroll_from[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->eight_month_payroll_from) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="eight_month_payroll_to[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->eight_month_payroll_to) : '';?>"  class="txtfield jcheck"></td>
						</tr>
						<tr class="inine_month imonth">
							<td>9th month</td>
							<td><input style="width:115px;" type="text" name="ninth_month_payroll_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->ninth_month_payroll_date) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="ninth_month_payroll_from[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->ninth_month_payroll_from) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="ninth_month_payroll_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->ninth_month_payroll_to) : '';?>"  class="txtfield jcheck"></td>
						</tr>
						<tr class="iten_month imonth">
							<td>10th month</td>
							<td><input style="width:115px;" type="text" name="tenth_month_payroll_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->tenth_month_payroll_date) : '';?>" class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="tenth_month_payroll_from[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->tenth_month_payroll_from) : '';?>" class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="tenth_month_payroll_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->tenth_month_payroll_to) : '';?>" class="txtfield jcheck"></td>
						</tr>
						<tr class="ieleven_month imonth">
							<td>11th month</td>
							<td><input style="width:115px;" type="text" name="eleventh_month_payroll_date[]"   value="<?php echo $thirteen_month ? idates_slash($thirteen_month->eleventh_month_payroll_date) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="eleventh_month_payroll_from[]"   value="<?php echo $thirteen_month ? idates_slash($thirteen_month->eleventh_month_payroll_from) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="eleventh_month_payroll_to[]"   value="<?php echo $thirteen_month ? idates_slash($thirteen_month->eleventh_month_payroll_to) : '';?>"  class="txtfield jcheck"></td>
						</tr>
						<tr class="itwelve_month imonth">
							<td>12th month</td>
							<td><input style="width:115px;" type="text" name="twelveth_month_payroll_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->twelveth_month_payroll_date) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="twelveth_month_payroll_from[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->twelveth_month_payroll_from) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="twelveth_month_payroll_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->twelveth_month_payroll_to) : '';?>"  class="txtfield jcheck"></td>
						</tr>
						<tr class="itwelve_month imonth quarter">
							<td>1st quarter</td>
							<td><input style="width:115px;" type="text" name="first_quarter_date[]"   value="<?php echo $thirteen_month ? idates_slash($thirteen_month->first_quarter_date) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="first_quarter_from[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->first_quarter_from) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="first_quarter_to[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->first_quarter_to) : '';?>"  class="txtfield jcheck"></td>
						</tr>
						 <tr class="itwelve_month imonth quarter">
							<td>2nd quarter</td>
							<td><input style="width:115px;" type="text" name="second_quarter_date[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->second_quarter_date) : '';?>"  class="txtfield jcheck"></td> 
							<td><input style="width:115px;" type="text" name="second_quarter_from[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->second_quarter_from) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="second_quarter_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->second_quarter_to) : '';?>"  class="txtfield jcheck"></td>
						</tr>
						 <tr class="itwelve_month imonth quarter">
							<td>3st quarter</td>
							<td><input style="width:115px;" type="text" name="third_quarter_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->third_quarter_date) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="third_quarter_from[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->third_quarter_from) : '';?>"  class="txtfield jcheck"></td>
							<td><input style="width:115px;" type="text" name="third_quarter_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->third_quarter_to) : '';?>"  class="txtfield jcheck"></td>
						</tr>
					</table>
	        </div>
	        <div class="jiyear ihide">
	        	<p>Do you already have a schedule date when to release the 13month of the employeee?</p>
	        	<p><input type="text" name="thirteen_month_released_date[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->thirteen_month_released_date) : '';?>" class="thirteen_released txtfield jcheck" /> ( Optional )</p>
	        </div>
	
		        <p>Do you want to add another bonus month for Real Regular Group? Example 14th Month</p>
		        <table style="margin-left:10px;" border="0" cellspacing="0" cellpadding="0">
				  <tr>
				    <td style="width:60px;"><input style="margin-right:5px;" name="add_another_bonus[<?php echo $get_payr_key;?>]" <?php echo ($thirteen_month && $thirteen_month->add_another_bonus == "yes") ? 'checked="checked"': '';?> class="jadd_another_bonus  jcheck" jpgid="<?php echo $get_payr->payroll_group_id;?>" type="radio" value="yes"> Yes</td>
				    <td style="width:60px;"><input style="margin-right:5px;" name="add_another_bonus[<?php echo $get_payr_key;?>]" type="radio" value="no" <?php echo ($thirteen_month && $thirteen_month->add_another_bonus == "no") ? 'checked="checked"': '';?> jpgid="<?php echo $get_payr->payroll_group_id;?>"  class="jadd_another_bonus  jcheck" >  No</td>
				  </tr>
				</table>

			<br>
			</div>
			<div class="iseparate"></div>
		<?php 
			endforeach;
        }else{	
        	echo "<p>".msg_empty()."</p>";
        }	
		?>
		<!-- MAIN-CONTENT END -->
	</div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray left" href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/thirteen_month_pay_settings">BACK</a> 
		<a class="btn btn-gray right" href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/de_minimis">CONTINUE</a>
        <input style="margin-right:10px;" class="btn right" name="submit" type="submit" value="SAVE">
        <!-- FOOTER-GRP-BTN END -->
      </div>      
<?php echo form_close();?>
<div class="addnew_more ihide" title="Add more Payroll">
<?php echo form_open('');?>
<div class="more_thirteenski">
		        <input type="hidden" name="update_payroll_group_id" value="" />
		        <p>How often do you process your 13th month pay for Payroll <span class="payrollgroupname"></span></p>
		        <select class="txtselect thirteen_month_process iselect_tmp jcheck" name="thirteen_month_process" >
		        	<option value="">SELECT</option>
		        	<option value="Monthly">Monthly</option>
		        	<option value="Semi-monthly">Semi-Monthly</option>
		        	<option value="Quarterly">Quarterly</option>
		        	<option value="Yearly">Yearly</option>
		        </select>
	        <br>
	        <br>
	        <br>
	        
	        <div class="tbl-wrap jmarkers_tble_zone">
	        <p class="jmarkers_pa">Select the payroll date when you will pay 13th month for payroll <?php echo $get_payr->name;?></p>
	          <table class="tbl jmarkers" border="0" cellspacing="0" cellpadding="0">
	            <tr>
	              <th style="width:136px;">Period</th>
	              <th style="width:136px;">Payroll Date</th>
	              <th style="width:136px;">From</th>
	              <th style="width:136px;">To</th>
	            </tr>
	            <tr class="ifirst_month imonth semi_mon">
		              <td>1st month</td>
		              <td><input style="width:115px;" type="text" value="" name="first_month_payroll_date" class="txtfield jcheck "></td>
		              <td><input style="width:115px;" type="text" value="" name="first_month_payroll_from" class="txtfield jcheck jfirst_fr"></td>
		              <td><input style="width:115px;" type="text" value="" name="first_month_payroll_to" class="txtfield jcheck jfirst_to"></td>
	            </tr>
	            <tr class="isecond_month imonth semi_mon">
	              	<td>2nd month</td>
					<td><input style="width:115px;" type="text" value="" name="second_month_payroll_date" class="txtfield jcheck"></td>
					<td><input style="width:115px;" type="text" value="" name="second_month_payroll_from" class="txtfield jcheck"></td>
					<td><input style="width:115px;" type="text" value="" name="second_month_payroll_to" class="txtfield jcheck"></td>
	            </tr>
	            <tr class="ithird_month imonth semi_mon">
				 	<td>3rd month</td>
	              	<td><input style="width:115px;" type="text" name="third_month_payroll_date" value="" class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="third_month_payroll_from" value="" class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="third_month_payroll_to" value="" class="txtfield jcheck"></td>
	            </tr>
	            <tr class="ifourth_month imonth semi_mon">
	  				<td>4th month</td>
	              	<td><input style="width:115px;" type="text" name="fourth_month_payroll_date"  value="" class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="fourth_month_payroll_from"  value="" class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="fourth_month_payroll_to"  value="" class="txtfield jcheck"></td>
	            </tr>
	            <tr class="ififth_month imonth semi_mon">
	               	<td>5th month</td>
	              	<td><input style="width:115px;" type="text" name="fifth_month_payroll_date" value=""  class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="fifth_month_payroll_from" value=""  class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="fifth_month_payroll_to"  value=""  class="txtfield jcheck"></td>
	            </tr>
	            <tr class="isix_month imonth semi_mon">
	               	<td>6th month</td>
	              	<td><input style="width:115px;" type="text" name="sixth_month_payroll_date"  value=""  class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="sixth_month_payroll_from"  value=""  class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="sixth_month_payroll_to"   value=""  class="txtfield jcheck"></td>
	            </tr>
	            <tr class="iseven_month imonth">
	              	<td>7th month</td>
	              	<td><input style="width:115px;" type="text" name="seventh_month_payroll_date"  value=""  class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="seventh_month_payroll_from"  value=""  class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="seventh_month_payroll_to"  value=""  class="txtfield jcheck"></td>
	            </tr>
	            <tr class="ieight_month imonth">
	              	<td>8th month</td>
	              	<td><input style="width:115px;" type="text" name="eight_month_payroll_date"  value=""  class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="eight_month_payroll_from" value=""  class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="eight_month_payroll_to" value=""  class="txtfield jcheck"></td>
	            </tr>
	            <tr class="inine_month imonth">
	               	<td>9th month</td>
	              	<td><input style="width:115px;" type="text" name="ninth_month_payroll_date"  value=""  class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="ninth_month_payroll_from"  value=""  class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="ninth_month_payroll_to"  value=""  class="txtfield jcheck"></td>
	            </tr>
	            <tr class="iten_month imonth">
	               	<td>10th month</td>
	              	<td><input style="width:115px;" type="text" name="tenth_month_payroll_date"  value="" class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="tenth_month_payroll_from"  value="" class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="tenth_month_payroll_to"  value="" class="txtfield jcheck"></td>
	            </tr>
	            <tr class="ieleven_month imonth">
	              	<td>11th month</td>
	              	<td><input style="width:115px;" type="text" name="eleventh_month_payroll_date"   value=""  class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="eleventh_month_payroll_from"   value=""  class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="eleventh_month_payroll_to"   value=""  class="txtfield jcheck"></td>
	            </tr>
	            <tr class="itwelve_month imonth">
	              	<td>12th month</td>
	              	<td><input style="width:115px;" type="text" name="twelveth_month_payroll_date"  value=""  class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="twelveth_month_payroll_from"  value=""  class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="twelveth_month_payroll_to"  value=""  class="txtfield jcheck"></td>
	            </tr>
	           	<tr class="itwelve_month imonth quarter">
	              	<td>1st quarter</td>
	              	<td><input style="width:115px;" type="text" name="first_quarter_date"   value=""  class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="first_quarter_from" value=""  class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="first_quarter_to" value=""  class="txtfield jcheck"></td>
	            </tr>
	             <tr class="itwelve_month imonth quarter">
	             	<td>2nd quarter</td>
	              	<td><input style="width:115px;" type="text" name="second_quarter_date" value=""  class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="second_quarter_from" value=""  class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="second_quarter_to"  value=""  class="txtfield jcheck"></td>
	            </tr>
	             <tr class="itwelve_month imonth quarter">
	              	<td>3st quarter</td>
	              	<td><input style="width:115px;" type="text" name="third_quarter_date"  value=""  class="txtfield jcheck"></td>
	              	<td><input style="width:115px;" type="text" name="third_quarter_from"  value=""  class="txtfield jcheck"></td>
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
      <script type="text/javascript">
     // jQuery(".imonth").hide();
     //CHECK TABLE TO BE DISPLAY 
     var itoken = "<?php echo itoken_cookie();?>";
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
     	// FUNCTIONS FOR SELECTING AND OPTION AND DISPLAY THE TABLES ACCORDING TO THE SELECT OPTIONs
     	function select_tmp_options(){
			jQuery(".imonth input").datepicker({dateFormat:'yy-mm-dd',changeYear: true});
			jQuery(".thirteen_released").datepicker({dateFormat:'yy-mm-dd',changeYear: true});
			jQuery("input[name='schedule_date_release']").datepicker({dateFormat:'yy-mm-dd'});
			jQuery(document).on("change",".thirteen_month_process",function(e){  
				var el = jQuery(this);
				var real_eq = jQuery(".thirteen_month_process").index(this);    
				var txt = el.val().toLowerCase();
				jQuery(".jmarkers_tble_zone:eq(" + real_eq + ")").show('fast');
				jQuery(".jiyear:eq(" + real_eq + ")").hide();
				
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

     	// IVALIDATE THE FORM
     	function tmp_validate(){	
     		
        }

        // IF WANT TO ADD MORE OPTIONS
        function add_more_payroll(){
        	jQuery(document).on("change",".jadd_another_bonus",function(e){   
        		 var el = jQuery(this);      
        		 var val = el.val();
        		 var type = el.attr("jpgid");
        		 if(val == 'yes'){
            		 jQuery("input[name='update_payroll_group_id']").val(type);
        		 	jQuery(".addnew_more").dialog({
						draggable: false,
						resizable: false,
						height: 'auto',
						width: "auto",
						modal: true,
						dialogClass: 'transparent'
        			});
        		 }
        	});
        }
        // SAVE MORE PAYROLL LIKE 14month pay etc hayhaya
        function add_more_bonuses(){
        	var ifields = {
        			update_payroll_group_id: jQuery(".addnew_more input[name='update_payroll_group_id']").val(),
        			thirteen_month_process: jQuery(".addnew_more select[name='thirteen_month_process']").val(),
        			first_month_payroll_date: jQuery(".addnew_more input[name='first_month_payroll_date']").val(),
        			first_month_payroll_from: jQuery(".addnew_more input[name='first_month_payroll_from']").val(),
        			first_month_payroll_to: jQuery(".addnew_more input[name='first_month_payroll_to']").val(),
        			second_month_payroll_date: jQuery(".addnew_more input[name='second_month_payroll_date']").val(),
        			second_month_payroll_from: jQuery(".addnew_more input[name='second_month_payroll_from']").val(),
        			second_month_payroll_to: jQuery(".addnew_more input[name='second_month_payroll_to']").val(),
        			third_month_payroll_date: jQuery(".addnew_more input[name='third_month_payroll_date']").val(),
        			third_month_payroll_from: jQuery(".addnew_more input[name='third_month_payroll_from']").val(),
        			third_month_payroll_to: jQuery(".addnew_more input[name='third_month_payroll_to']").val(),
        			fourth_month_payroll_date: jQuery(".addnew_more input[name='fourth_month_payroll_date']").val(),
        			fourth_month_payroll_from: jQuery(".addnew_more input[name='fourth_month_payroll_from']").val(),
        			fourth_month_payroll_to: jQuery(".addnew_more input[name='fourth_month_payroll_to']").val(),
        			fifth_month_payroll_date: jQuery(".addnew_more input[name='fifth_month_payroll_date']").val(),
        			fifth_month_payroll_from: jQuery(".addnew_more input[name='fifth_month_payroll_from']").val(),
        			fifth_month_payroll_to: jQuery(".addnew_more input[name='fifth_month_payroll_to']").val(),
        			sixth_month_payroll_date: jQuery(".addnew_more input[name='sixth_month_payroll_date']").val(),
        			sixth_month_payroll_from: jQuery(".addnew_more input[name='sixth_month_payroll_from']").val(),
        			sixth_month_payroll_to: jQuery(".addnew_more input[name='sixth_month_payroll_to']").val(),
        			seventh_month_payroll_date: jQuery(".addnew_more input[name='seventh_month_payroll_date']").val(),
        			seventh_month_payroll_from: jQuery(".addnew_more input[name='seventh_month_payroll_from']").val(),
        			seventh_month_payroll_to: jQuery(".addnew_more input[name='seventh_month_payroll_to']").val(),
        			eight_month_payroll_date: jQuery(".addnew_more input[name='eight_month_payroll_date']").val(),
        			eight_month_payroll_from: jQuery(".addnew_more input[name='eight_month_payroll_from']").val(),
        			eight_month_payroll_to: jQuery(".addnew_more input[name='eight_month_payroll_to']").val(),
        			ninth_month_payroll_date: jQuery(".addnew_more input[name='ninth_month_payroll_date']").val(),
        			ninth_month_payroll_from: jQuery(".addnew_more input[name='ninth_month_payroll_from']").val(),
        			ninth_month_payroll_to: jQuery(".addnew_more input[name='ninth_month_payroll_to']").val(),
        			tenth_month_payroll_date: jQuery(".addnew_more input[name='tenth_month_payroll_date']").val(),
        			tenth_month_payroll_from: jQuery(".addnew_more input[name='tenth_month_payroll_from']").val(),
        			tenth_month_payroll_to: jQuery(".addnew_more input[name='tenth_month_payroll_to']").val(),
        			eleventh_month_payroll_date: jQuery(".addnew_more input[name='eleventh_month_payroll_date']").val(),
        			eleventh_month_payroll_from: jQuery(".addnew_more input[name='eleventh_month_payroll_from']").val(),
        			eleventh_month_payroll_to: jQuery(".addnew_more input[name='eleventh_month_payroll_to']").val(),
        			twelveth_month_payroll_date: jQuery(".addnew_more input[name='twelveth_month_payroll_date']").val(),
        			twelveth_month_payroll_from: jQuery(".addnew_more input[name='twelveth_month_payroll_from']").val(),
        			twelveth_month_payroll_to: jQuery(".addnew_more input[name='twelveth_month_payroll_to']").val(),
        			first_quarter_date: jQuery(".addnew_more input[name='first_quarter_date']").val(),
        			first_quarter_from: jQuery(".addnew_more input[name='first_quarter_from']").val(),
        			first_quarter_to: jQuery(".addnew_more input[name='first_quarter_to']").val(),
        			second_quarter_date: jQuery(".addnew_more input[name='second_quarter_date']").val(),
        			second_quarter_from: jQuery(".addnew_more input[name='second_quarter_from']").val(),
        			second_quarter_to: jQuery(".addnew_more input[name='second_quarter_to']").val(),
        			third_quarter_date: jQuery(".addnew_more input[name='third_quarter_date']").val(),
        			third_quarter_from: jQuery(".addnew_more input[name='third_quarter_from']").val(),
        			third_quarter_to: jQuery(".addnew_more input[name='third_quarter_to']").val(),
        			thirteen_month_released_date: jQuery(".addnew_more input[name='thirteen_month_released_date']").val()
        		};

        		console.log(ifields);
        }
		
     	jQuery(function(){
     		jQuery(".imonth").hide();
     		select_tmp_options();
     		display_tmp_table();
     		hightlight_success();
     		add_more_payroll();
        });
      </script>