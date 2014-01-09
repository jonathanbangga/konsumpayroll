<?php echo form_open();?>
<div class="main-content">
        <!-- MAIN-CONTENT START -->
        <p>How often do you process your 13th month pay for Payroll group1</p>
        <select class="txtselect" name="thirteen_month_process" id="thirteen_month_process">
        	<option value="">SELECT</option>
        	<option value="monthly">Monthly</option>
        	<option value="semi-monthly">Semi-Monthly</option>
        	<option value="quarterly">Quarterly</option>
        	<option value="yearly">Yearly</option>
        </select>
        <br>
        <br>
        <br>
        <p>Select the payroll date when you will pay 13th month for payroll group 1</p>
        <div class="tbl-wrap">
          <table class="tbl" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <th style="width:136px;">Period</th>
              <th style="width:136px;">Payroll Date</th>
              <th style="width:136px;">From</th>
              <th style="width:136px;">To</th>
            </tr>
            <tr class="ifirst_month imonth semi_mon">
	              <td>1st month</td>
	              <td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? $thirteen_month->first_month_payroll_date : '';?>" name="first_month_payroll_date" class="txtfield"></td>
	              <td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? $thirteen_month->first_month_payroll_from : '';?>" name="first_month_payroll_from" class="txtfield"></td>
	              <td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? $thirteen_month->first_month_payroll_to : '';?>" name="first_month_payroll_to" class="txtfield"></td>
            </tr>
            <tr class="isecond_month imonth semi_mon">
              	<td>2nd month</td>
				<td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? $thirteen_month->second_month_payroll_date : '';?>" name="second_month_payroll_date" class="txtfield"></td>
				<td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? $thirteen_month->second_month_payroll_from : '';?>" name="second_month_payroll_from" class="txtfield"></td>
				<td><input style="width:115px;" type="text" value="<?php echo $thirteen_month ? $thirteen_month->second_month_payroll_to : '';?>" name="second_month_payroll_to" class="txtfield"></td>
            </tr>
            <tr class="ithird_month imonth semi_mon">
			 <td>3rd month</td>
              <td><input style="width:115px;" type="text" name="third_month_payroll_date" value="<?php echo $thirteen_month ? $thirteen_month->third_month_payroll_date : '';?>" class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="third_month_payroll_from" value="<?php echo $thirteen_month ? $thirteen_month->third_month_payroll_from : '';?>" class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="third_month_payroll_to" value="<?php echo $thirteen_month ? $thirteen_month->third_month_payroll_to : '';?>" class="txtfield"></td>
            </tr>
            <tr class="ifourth_month imonth semi_mon">
  				<td>4th month</td>
              <td><input style="width:115px;" type="text" name="fourth_month_payroll_date"  value="<?php echo $thirteen_month ? $thirteen_month->fourth_month_payroll_date : '';?>" class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="fourth_month_payroll_from"  value="<?php echo $thirteen_month ? $thirteen_month->fourth_month_payroll_from : '';?>" class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="fourth_month_payroll_to"  value="<?php echo $thirteen_month ? $thirteen_month->fourth_month_payroll_to : '';?>" class="txtfield"></td>
            </tr>
            <tr class="ififth_month imonth semi_mon">
               <td>5th month</td>
              <td><input style="width:115px;" type="text" name="fifth_month_payroll_date" value="<?php echo $thirteen_month ? $thirteen_month->fifth_month_payroll_date : '';?>"  class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="fifth_month_payroll_from" value="<?php echo $thirteen_month ? $thirteen_month->fifth_month_payroll_from : '';?>"  class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="fifth_month_payroll_to"  value="<?php echo $thirteen_month ? $thirteen_month->fifth_month_payroll_to : '';?>"  class="txtfield"></td>
            </tr>
            <tr class="isix_month imonth semi_mon">
               <td>6th month</td>
              <td><input style="width:115px;" type="text" name="sixth_month_payroll_date"  value="<?php echo $thirteen_month ? $thirteen_month->sixth_month_payroll_date : '';?>"  class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="sixth_month_payroll_from"  value="<?php echo $thirteen_month ? $thirteen_month->sixth_month_payroll_from : '';?>"  class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="sixth_month_payroll_to"   value="<?php echo $thirteen_month ? $thirteen_month->sixth_month_payroll_to : '';?>"  class="txtfield"></td>
            </tr>
            <tr class="iseven_month imonth">
              <td>7th month</td>
              <td><input style="width:115px;" type="text" name="seventh_month_payroll_date"  value="<?php echo $thirteen_month ? $thirteen_month->seventh_month_payroll_date : '';?>"  class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="seventh_month_payroll_from"  value="<?php echo $thirteen_month ? $thirteen_month->seventh_month_payroll_from : '';?>"  class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="seventh_month_payroll_to"  value="<?php echo $thirteen_month ? $thirteen_month->seventh_month_payroll_to : '';?>"  class="txtfield"></td>
            </tr>
            <tr class="ieight_month imonth">
              <td>8th month</td>
              <td><input style="width:115px;" type="text" name="eight_month_payroll_date"  value="<?php echo $thirteen_month ? $thirteen_month->eight_month_payroll_date : '';?>"  class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="eight_month_payroll_from" value="<?php echo $thirteen_month ? $thirteen_month->eight_month_payroll_from : '';?>"  class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="eight_month_payroll_to" value="<?php echo $thirteen_month ? $thirteen_month->eight_month_payroll_to : '';?>"  class="txtfield"></td>
            </tr>
            <tr class="inine_month imonth">
               <td>9th month</td>
              <td><input style="width:115px;" type="text" name="ninth_month_payroll_date"  value="<?php echo $thirteen_month ? $thirteen_month->ninth_month_payroll_date : '';?>"  class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="ninth_month_payroll_from"  value="<?php echo $thirteen_month ? $thirteen_month->ninth_month_payroll_from : '';?>"  class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="ninth_month_payroll_to"  value="<?php echo $thirteen_month ? $thirteen_month->ninth_month_payroll_to : '';?>"  class="txtfield"></td>
            </tr>
            <tr class="iten_month imonth">
               <td>10th month</td>
              <td><input style="width:115px;" type="text" name="tenth_month_payroll_date"  value="<?php echo $thirteen_month ? $thirteen_month->tenth_month_payroll_date : '';?>" class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="tenth_month_payroll_from"  value="<?php echo $thirteen_month ? $thirteen_month->tenth_month_payroll_from : '';?>" class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="tenth_month_payroll_to"  value="<?php echo $thirteen_month ? $thirteen_month->tenth_month_payroll_to : '';?>" class="txtfield"></td>
            </tr>
            <tr class="ieleven_month imonth">
              <td>11th month</td>
              <td><input style="width:115px;" type="text" name="eleventh_month_payroll_date"   value="<?php echo $thirteen_month ? $thirteen_month->eleventh_month_payroll_date : '';?>"  class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="eleventh_month_payroll_from"   value="<?php echo $thirteen_month ? $thirteen_month->eleventh_month_payroll_from : '';?>"  class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="eleventh_month_payroll_to"   value="<?php echo $thirteen_month ? $thirteen_month->eleventh_month_payroll_to : '';?>"  class="txtfield"></td>
            </tr>
            <tr class="itwelve_month imonth">
              <td>12th month</td>
              <td><input style="width:115px;" type="text" name="twelveth_month_payroll_date"  value="<?php echo $thirteen_month ? $thirteen_month->twelveth_month_payroll_date : '';?>"  class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="twelveth_month_payroll_from"  value="<?php echo $thirteen_month ? $thirteen_month->twelveth_month_payroll_from : '';?>"  class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="twelveth_month_payroll_to"  value="<?php echo $thirteen_month ? $thirteen_month->twelveth_month_payroll_to : '';?>"  class="txtfield"></td>
            </tr>
           	<tr class="itwelve_month imonth quarter">
              <td>1st quarter</td>
              <td><input style="width:115px;" type="text" name="first_quarter_date"   value="<?php echo $thirteen_month ? $thirteen_month->first_quarter_date : '';?>"  class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="first_quarter_from" value="<?php echo $thirteen_month ? $thirteen_month->first_quarter_from : '';?>"  class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="first_quarter_to" value="<?php echo $thirteen_month ? $thirteen_month->first_quarter_to : '';?>"  class="txtfield"></td>
            </tr>
             <tr class="itwelve_month imonth quarter">
              <td>2nd quarter</td>
              <td><input style="width:115px;" type="text" name="second_quarter_date" value="<?php echo $thirteen_month ? $thirteen_month->second_quarter_date : '';?>"  class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="second_quarter_from" value="<?php echo $thirteen_month ? $thirteen_month->second_quarter_from : '';?>"  class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="second_quarter_to"  value="<?php echo $thirteen_month ? $thirteen_month->second_quarter_to : '';?>"  class="txtfield"></td>
            </tr>
             <tr class="itwelve_month imonth quarter">
              <td>3st quarter</td>
              <td><input style="width:115px;" type="text" name="third_quarter_date"  value="<?php echo $thirteen_month ? $thirteen_month->third_quarter_date : '';?>"  class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="third_quarter_from"  value="<?php echo $thirteen_month ? $thirteen_month->third_quarter_from : '';?>"  class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="third_quarter_to"  value="<?php echo $thirteen_month ? $thirteen_month->third_quarter_to : '';?>"  class="txtfield"></td>
            </tr>
             <tr class="itwelve_month imonth yearly">
              <td>1 yearly</td>
              <td><input style="width:115px;" type="text" name="textfield" class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="textfield" class="txtfield"></td>
              <td><input style="width:115px;" type="text" name="textfield" class="txtfield"></td>
            </tr>
            
          </table>
        </div>
        <p>Do you want to add another bonus month for Real Regular Group? Example 14th Month</p>
        <table style="margin-left:10px;" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="width:60px;"><input style="margin-right:5px;" name="add_another_bonus" type="radio" value="1"> Yes</td>
    <td style="width:60px;"> <input style="margin-right:5px;" name="add_another_bonus" type="radio" value="0">  No</td>
  </tr>
</table><br>
<br>
<br>
<p>How often do you process your 13th month pay for Payroll group2</p>

<select class="txtselect" name="often_process_payroll2">
	<option value="">SELECT</option>
        	<option value="monthly">Monthly</option>
        	<option value="semi-monthly">Semi-Monthly</option>
        	<option value="quarterly">Quarterly</option>
        	<option value="yearly">Yearly</option>
</select><br>
<br>
<p>Do you already have a schedule date when to release the 13th month of the employee?</p>
<p><input style="width:115px;" type="text" name="schedule_date_release"  value="<?php echo $thirteen_month ? $thirteen_month->schedule_date_release : '';?>"   class="txtfield"> ( Optional )</p>


 <p>Do you want to add another bonus month for Real Regular Group? Example 14th Month</p>
	<table style="margin-left:10px;" border="0" cellspacing="0" cellpadding="0">
  		<tr>
    		<td style="width:60px;"><input style="margin-right:5px;" name="add_second_bonus" type="radio" value="1"> Yes</td>
    		<td style="width:60px;"> <input style="margin-right:5px;" name="add_second_bonus" type="radio" value="0">  No</td>
  		</tr>
	</table>
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
      jQuery(".imonth").hide();
      jQuery(".imonth input").datepicker({dateFormat:'yy-mm-dd'});
      jQuery("input[name='schedule_date_release']").datepicker({dateFormat:'yy-mm-dd'});
      
      jQuery(document).on("change","#thirteen_month_process",function(){
          var el = jQuery(this);
          var txt = el.val();
          switch(txt){
	          case "monthly":
				jQuery(".imonth").show('slow');
				jQuery(".quarter").hide();	
				
	          break;
	          case "semi-monthly":
				jQuery(".imonth").hide('slow');
				jQuery(".semi_mon").show('slow');
	          break;
	          case "quarterly":
				jQuery(".imonth").hide('fast');
				jQuery(".quarter").show('slow');	
	          break;
	          case "yearly":
				jQuery(".imonth").hide('fast');
				jQuery(".yearly").show('slow');
	          break;
	          default:
				jQuery(".imonth").hide('fast');
	          break;
        }
      });
      
      </script>