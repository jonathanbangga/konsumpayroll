<?php echo form_open();?>
<?php 
	echo $this->session->flashdata("success");
?>
<div class="main-content">
        <!-- MAIN-CONTENT START -->
        <?php if($get_payroll_group_setup){
        
        	foreach($get_payroll_group_setup as $get_payr_key=>$get_payr):
        	$thirteen_month	= $this->thirteen_month_pay->get_thirteen_month_pay($this->company_id,$get_payr->payroll_group_id);
        ?>
	        <div class="more_thirteenski">
	        <input type="hidden" name="payroll_group_id[]" value="<?php echo $get_payr->payroll_group_id;?>" />
	        <p>How often do you process your 13th month pay for Payroll group1</p>
	        <select class="txtselect thirteen_month_process iselect_tmp" name="thirteen_month_process[]" >
	        	<option value="">SELECT</option>
	        	<option value="Monthly" <?php echo ($thirteen_month && $thirteen_month->process_by == "Monthly") ? 'selected="selected"': '';?>>Monthly</option>
	        	<option value="Semi-monthly" <?php echo ($thirteen_month && $thirteen_month->process_by == "Semi-monthly") ? 'selected="selected"': '';?>>Semi-Monthly</option>
	        	<option value="Quarterly" <?php echo ($thirteen_month && $thirteen_month->process_by == "Quarterly") ? 'selected="selected"': '';?>>Quarterly</option>
	        	<option value="Yearly" <?php echo ($thirteen_month && $thirteen_month->process_by == "Yearly") ? 'selected="selected"': '';?>>Yearly</option>
	        </select>
	        <br>
	        <br>
	        <br>
	        <p>Select the payroll date when you will pay 13th month for payroll <?php echo $get_payr->name;?></p>
	        <div class="tbl-wrap">
	          <table class="tbl jmarkers" border="0" cellspacing="0" cellpadding="0">
	            <tr>
	              <th style="width:136px;">Period</th>
	              <th style="width:136px;">Payroll Date</th>
	              <th style="width:136px;">From</th>
	              <th style="width:136px;">To</th>
	            </tr>
	            <tr class="ifirst_month imonth semi_mon">
		              <td>1st month</td>
		              <td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->first_month_payroll_date) : '';?>" name="first_month_payroll_date[]" class="txtfield"></td>
		              <td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->first_month_payroll_from) : '';?>" name="first_month_payroll_from[]" class="txtfield"></td>
		              <td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->first_month_payroll_to) : '';?>" name="first_month_payroll_to[]" class="txtfield"></td>
	            </tr>
	            <tr class="isecond_month imonth semi_mon">
	              	<td>2nd month</td>
					<td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->second_month_payroll_date) : '';?>" name="second_month_payroll_date[]" class="txtfield"></td>
					<td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->second_month_payroll_from) : '';?>" name="second_month_payroll_from[]" class="txtfield"></td>
					<td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->second_month_payroll_to) : '';?>" name="second_month_payroll_to[]" class="txtfield"></td>
	            </tr>
	            <tr class="ithird_month imonth semi_mon">
				 	<td>3rd month</td>
	              	<td><input style="width:115px;" type="text" name="third_month_payroll_date[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->third_month_payroll_date) : '';?>" class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="third_month_payroll_from[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->third_month_payroll_from) : '';?>" class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="third_month_payroll_to[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->third_month_payroll_to) : '';?>" class="txtfield"></td>
	            </tr>
	            <tr class="ifourth_month imonth semi_mon">
	  				<td>4th month</td>
	              	<td><input style="width:115px;" type="text" name="fourth_month_payroll_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->fourth_month_payroll_date) : '';?>" class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="fourth_month_payroll_from[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->fourth_month_payroll_from) : '';?>" class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="fourth_month_payroll_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->fourth_month_payroll_to) : '';?>" class="txtfield"></td>
	            </tr>
	            <tr class="ififth_month imonth semi_mon">
	               	<td>5th month</td>
	              	<td><input style="width:115px;" type="text" name="fifth_month_payroll_date[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->fifth_month_payroll_date) : '';?>"  class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="fifth_month_payroll_from[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->fifth_month_payroll_from) : '';?>"  class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="fifth_month_payroll_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->fifth_month_payroll_to) : '';?>"  class="txtfield"></td>
	            </tr>
	            <tr class="isix_month imonth semi_mon">
	               	<td>6th month</td>
	              	<td><input style="width:115px;" type="text" name="sixth_month_payroll_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->sixth_month_payroll_date) : '';?>"  class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="sixth_month_payroll_from[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->sixth_month_payroll_from) : '';?>"  class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="sixth_month_payroll_to[]"   value="<?php echo $thirteen_month ? idates_slash($thirteen_month->sixth_month_payroll_to) : '';?>"  class="txtfield"></td>
	            </tr>
	            <tr class="iseven_month imonth">
	              	<td>7th month</td>
	              	<td><input style="width:115px;" type="text" name="seventh_month_payroll_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->seventh_month_payroll_date) : '';?>"  class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="seventh_month_payroll_from[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->seventh_month_payroll_from) : '';?>"  class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="seventh_month_payroll_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->seventh_month_payroll_to) : '';?>"  class="txtfield"></td>
	            </tr>
	            <tr class="ieight_month imonth">
	              	<td>8th month</td>
	              	<td><input style="width:115px;" type="text" name="eight_month_payroll_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->eight_month_payroll_date) : '';?>"  class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="eight_month_payroll_from[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->eight_month_payroll_from) : '';?>"  class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="eight_month_payroll_to[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->eight_month_payroll_to) : '';?>"  class="txtfield"></td>
	            </tr>
	            <tr class="inine_month imonth">
	               	<td>9th month</td>
	              	<td><input style="width:115px;" type="text" name="ninth_month_payroll_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->ninth_month_payroll_date) : '';?>"  class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="ninth_month_payroll_from[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->ninth_month_payroll_from) : '';?>"  class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="ninth_month_payroll_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->ninth_month_payroll_to) : '';?>"  class="txtfield"></td>
	            </tr>
	            <tr class="iten_month imonth">
	               	<td>10th month</td>
	              	<td><input style="width:115px;" type="text" name="tenth_month_payroll_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->tenth_month_payroll_date) : '';?>" class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="tenth_month_payroll_from[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->tenth_month_payroll_from) : '';?>" class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="tenth_month_payroll_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->tenth_month_payroll_to) : '';?>" class="txtfield"></td>
	            </tr>
	            <tr class="ieleven_month imonth">
	              	<td>11th month</td>
	              	<td><input style="width:115px;" type="text" name="eleventh_month_payroll_date[]"   value="<?php echo $thirteen_month ? idates_slash($thirteen_month->eleventh_month_payroll_date) : '';?>"  class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="eleventh_month_payroll_from[]"   value="<?php echo $thirteen_month ? idates_slash($thirteen_month->eleventh_month_payroll_from) : '';?>"  class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="eleventh_month_payroll_to[]"   value="<?php echo $thirteen_month ? idates_slash($thirteen_month->eleventh_month_payroll_to) : '';?>"  class="txtfield"></td>
	            </tr>
	            <tr class="itwelve_month imonth">
	              	<td>12th month</td>
	              	<td><input style="width:115px;" type="text" name="twelveth_month_payroll_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->twelveth_month_payroll_date) : '';?>"  class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="twelveth_month_payroll_from[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->twelveth_month_payroll_from) : '';?>"  class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="twelveth_month_payroll_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->twelveth_month_payroll_to) : '';?>"  class="txtfield"></td>
	            </tr>
	           	<tr class="itwelve_month imonth quarter">
	              	<td>1st quarter</td>
	              	<td><input style="width:115px;" type="text" name="first_quarter_date[]"   value="<?php echo $thirteen_month ? idates_slash($thirteen_month->first_quarter_date) : '';?>"  class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="first_quarter_from[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->first_quarter_from) : '';?>"  class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="first_quarter_to[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->first_quarter_to) : '';?>"  class="txtfield"></td>
	            </tr>
	             <tr class="itwelve_month imonth quarter">
	             	<td>2nd quarter</td>
	              	<td><input style="width:115px;" type="text" name="second_quarter_date[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->second_quarter_date) : '';?>"  class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="second_quarter_from[]" value="<?php echo $thirteen_month ? idates_slash($thirteen_month->second_quarter_from) : '';?>"  class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="second_quarter_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->second_quarter_to) : '';?>"  class="txtfield"></td>
	            </tr>
	             <tr class="itwelve_month imonth quarter">
	              	<td>3st quarter</td>
	              	<td><input style="width:115px;" type="text" name="third_quarter_date[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->third_quarter_date) : '';?>"  class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="third_quarter_from[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->third_quarter_from) : '';?>"  class="txtfield"></td>
	              	<td><input style="width:115px;" type="text" name="third_quarter_to[]"  value="<?php echo $thirteen_month ? idates_slash($thirteen_month->third_quarter_to) : '';?>"  class="txtfield"></td>
	            </tr>
	          </table>
	        </div>
	        <p>Do you want to add another bonus month for Real Regular Group? Example 14th Month</p>
	        <table style="margin-left:10px;" border="0" cellspacing="0" cellpadding="0">
			  <tr>
			    <td style="width:60px;"> <input style="margin-right:5px;" name="add_another_bonus[<?php echo $get_payr_key;?>]" <?php echo ($thirteen_month && $thirteen_month->add_another_bonus == "yes") ? 'checked="checked"': '';?> class="jadd_another_bonus"  type="radio" value="yes"> Yes</td>
			    <td style="width:60px;"> <input style="margin-right:5px;" name="add_another_bonus[<?php echo $get_payr_key;?>]" type="radio" value="no" <?php echo ($thirteen_month && $thirteen_month->add_another_bonus == "no") ? 'checked="checked"': '';?> class="jadd_another_bonus" >  No</td>
			  </tr>
			</table>
			<br><br><br>
			</div>
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
      <script type="text/javascript">
     // jQuery(".imonth").hide();
     //CHECK TABLE TO BE DISPLAY 
		function display_tmp_table() {
		    jQuery(".iselect_tmp").each(function (e) {
		        var el = jQuery(this);
		        var real_eq = jQuery(".iselect_tmp").index(this);
		        var txt = el.val().toLowerCase();
		        if(txt){
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
				            break;
				        default:
				            jQuery(".jmarkers:eq(" + real_eq + ") .imonth").hide('fast');
				       	break;
			        }
		        }else{

		        }
		    });
		}     
     	// FUNCTIONS FOR SELECTING AND OPTION AND DISPLAY THE TABLES ACCORDING TO THE SELECT OPTIONs
     	function select_tmp_options(){
			jQuery(".imonth input").datepicker({dateFormat:'mm/dd/yy',changeYear: true});
			jQuery("input[name='schedule_date_release']").datepicker({dateFormat:'yy-mm-dd'});
			jQuery(document).on("change",".thirteen_month_process",function(e){  
				var el = jQuery(this);
				var real_eq = jQuery(".thirteen_month_process").index(this);    
				var txt = el.val().toLowerCase();
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
					break;
					default:
						jQuery(".jmarkers:eq("+real_eq+") .imonth").hide('fast');
					break;
				}
			});
		}

     	// IVALIDATE THE FORM
     	function tmp_validate(){
			i
     		return false;
        }
		
     	jQuery(function(){
     		jQuery(".imonth").hide();
     		select_tmp_options();
     		display_tmp_table();
     		
        });
      </script>