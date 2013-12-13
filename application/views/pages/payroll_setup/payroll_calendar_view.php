<div class="main-content">
<div style="display:none;" class="highlight_message">Message</div>
        <!-- MAIN-CONTENT START -->
        <p> Define the dates of the payroll to each of your payroll group. Make sure you enter the correct date range.</p>
		
		<?php
		if($pg_sql->num_rows()>0){
			foreach($pg_sql->result() as $pg){ ?>
			<div class="payroll-calendar-row" style="margin-bottom: 30px;">
			  <!--PAYROLL-CALENDAR-ROW START -->
			  <h5>
				<?php echo $pg->name ?>
				<input type="hidden" class="pg_id" value="<?php echo $pg->payroll_group_setup_id; ?>" />
			  </h5>
			  <table style="margin-bottom:8px;">
				<tr>
				  <td style="width:314px;"> Indicate the date of the first semi-monthly payroll </td>
				  <td style="width:120px;">
					<select style="width:120px;" class="txtselect semi_monthly">
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
					<select style="width:120px;" class="txtselect monthly">
						<option value="-1">select</option>
						<?php
						for($i=16;$i<=31;$i++){?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php
						}
						?>
						<option value="-2">end of month</option>
					</select>
					</td>
				</tr>
			  </table>
			  <p style="padding-bottom:8px;">State the first payroll for this group that will be run by this system
				<input type="text" class="txtfield dp payroll_date" style="width:120px;" />
			  </p>
			  <table border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td style="width:512px;">Select range of work days to be included in first payroll for this group using the system</td>
				  <td style="width:180px;"><input class="txtfield dp cut_off_from" style="width:70px;" type="text">
					<input class="txtfield dp cut_off_to" style="width:70px;" type="text"></td>
				</tr>
				<tr>
				  <td colspan="2">
				  <a class="btn" id="save" href="javascript:void(0);" id="add-project" >SAVE</a>
				  <a class="btn right show_calendar" href="javascript:void(0);">SHOW CALENDAR</a>
					<div class="clearB"></div>
				</td>
				</tr>
			  </table>
			  <!--PAYROLL-CALENDAR-ROW END -->
			</div>
		<?php
			}
		}else{
			echo 'No Payroll Group created. click <a href="/'.$this->session->userdata('sub_domain').'/payroll_setup/payroll_group">here</a>';
		}
		?>
        
      
        <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray left" href="#">BACK</a> <a class="btn btn-gray right" href="#"> CONTINUE</a>
        <!-- FOOTER-GRP-BTN END -->
      </div>
	  
<div id="payroll_calendar_dialog" class="jdialog"  title="Payroll Calendar">
	<div class="inner_div">
		<div style="float:right;margin-bottom: 15px;">
		Year 
		<select class="txtselect" style="width: 80px;">
			<option>2013</option>
		</select>
		</div>
		<div style="clear:both;"></div>
		<table>
			<thead>
				<tr>
					<th>Payroll Date</th>
					<th>From</th>
					<th>To</th>
					<th>Period</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input class="txtfield dp" type="text" value="2013-12-12" /></td>
					<td><input class="txtfield dp" type="text" value="2013-12-12" /></td>
					<td><input class="txtfield dp" type="text" value="2013-12-12" /></td>
					<td><input class="txtfield" type="text" value="12" style="width: 20px;" /></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<style>
#payroll_calendar_dialog .dp{
	width: 80px;
}
#payroll_calendar_dialog th,
#payroll_calendar_dialog td{
	padding: 3px;
}
.ui-dialog {
	width: 366px!important;
}
</style>

<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>
	  
<script>
jQuery(document).ready(function(){

	// load highlight message script
	redirect_highlight_message();
	
	// invoke date picker
	jQuery( ".dp" ).datepicker();
	
	jQuery("#save").click(function(){
		var pg_id = jQuery(this).parents(".payroll-calendar-row").find(".pg_id").val();
		var semi_monthly = jQuery(this).parents(".payroll-calendar-row").find(".semi_monthly").val();
		var monthly = jQuery(this).parents(".payroll-calendar-row").find(".monthly").val();
		var payroll_date = jQuery(this).parents(".payroll-calendar-row").find(".payroll_date").val();
		var cut_off_from = jQuery(this).parents(".payroll-calendar-row").find(".cut_off_from").val();
		var cut_off_to = jQuery(this).parents(".payroll-calendar-row").find(".cut_off_to").val();
		jQuery.ajax({
			type: "POST",
			url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/payroll_calendar/ajax_add_payroll_calendar",
			data: {
				pg_id: pg_id,
				semi_monthly: semi_monthly,
				monthly: monthly,
				payroll_date: payroll_date,
				cut_off_from: cut_off_from,
				cut_off_to: cut_off_to,
				<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
			}
		}).done(function(ret){
			jQuery.cookie("msg", "Payroll calendar has been saved");
			window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/payroll_calendar";
		});		
	});
	
	jQuery(".show_calendar").click(function(){
		
		jQuery("#payroll_calendar_dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'save': function() {
					// ajax call
							
				}
			}
		});
	});
	
});
</script>