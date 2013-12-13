<div class="main-content">
<div style="display:none;" class="highlight_message">Message</div>
        <!-- MAIN-CONTENT START -->
        <p> Define the dates of the payroll to each of your payroll group. Make sure you enter the correct date range.</p>
        <div class="payroll-calendar-row">
          <!--PAYROLL-CALENDAR-ROW START -->
          <h5>Payroll Group 1</h5>
          <table style="margin-bottom:8px;">
            <tr>
              <td style="width:314px;"> Indicate the date of the first semi-monthly payroll </td>
              <td style="width:120px;">
				<select style="width:120px;" class="txtselect" name="">
					<option value="-1">select</option>
					<?php
					for($i=1;$i<=15;$i++){?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php
					}
					?>
                </select>
				</td>
            </tr>
            <tr>
              <td>Indicate the date of your second monthly payroll</td>
              <td>
				<select style="width:120px;" class="txtselect" name="">
					<option value="-1">select</option>
					<?php
					for($i=16;$i<=31;$i++){?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php
					}
					?>
                </select>
				</td>
            </tr>
          </table>
          <p style="padding-bottom:8px;">State the first payroll for this group that will be run by this system
            <input class="txtfield dp" style="width:120px;" name="" type="text">
          </p>
          <table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td style="width:512px;">Select range of work days to be included in first payroll for this group using the system</td>
              <td style="width:180px;"><input class="txtfield dp" style="width:70px;" name="" type="text">
                <input class="txtfield dp" style="width:70px;" name="" type="text"></td>
            </tr>
            <tr>
              <td colspan="2">
			  <a class="btn" id="save" href="javascript:void(0);" id="add-project" >SAVE</a>
			  <a class="btn right" href="javascript:void(0);" class="show_calendar">SHOW CALENDAR</a>
                <div class="clearB"></div>
			</td>
            </tr>
          </table>
          <!--PAYROLL-CALENDAR-ROW END -->
        </div>
      
        <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray left" href="#">BACK</a> <a class="btn btn-gray right" href="#"> CONTINUE</a>
        <!-- FOOTER-GRP-BTN END -->
      </div>
	  
<div id="project-details-dialog" class="jdialog"  title="Edit Project">
	<div class="inner_div">
		<p>
			Earnings:<br />
			<input type="text" id="edit_earnings" name="edit_earnings" class="txtfield" />
		</p>
		<p>
			Taxable:<br />
			<select class="txtselect taxable" id="edit_taxable" style="width: 85px !important;margin-top: 10px;">
				<option value="-1">Select</option>
				<option value="1">Yes</option>
				<option value="0">No</option>
			</select>
		</p>
		<p>
			Max Non Taxable:<br />
			<input type="text" id="edit_max_non_taxable" name="edit_max_non_taxable" class="txtfield" />
		</p>
		<p>
			Witholding Tax Rate:<br />
			<input type="text" id="edit_witholding_tax" name="edit_witholding_tax" class="txtfield" />
		</p>
	</div>
</div>

<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>
	  
<script>
jQuery(document).ready(function(){

	// load highlight message script
	redirect_highlight_message();
	
	jQuery( ".dp" ).datepicker();
	
});
</script>