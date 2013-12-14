<div class="main-content">
<?php 
$attributes = array('id' => 'jform');
echo form_open("/{$this->session->userdata('sub_domain')}/payroll_setup/payroll_calendar",$attributes);
?>
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
				<input type="hidden" class="pg_id" name="pg_id[]" value="<?php echo $pg->payroll_group_setup_id; ?>" />
			  </h5>
			  <table style="margin-bottom:8px;">
				<tr>
				  <td style="width:314px;"> Indicate the date of the first semi-monthly payroll </td>
				  <td style="width:120px;">
					<select style="width:120px;" class="txtselect semi_monthly" name="semi_monthly[]">
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
					<select style="width:120px;" class="txtselect monthly" name="monthly[]">
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
				<input type="text" class="txtfield dp payroll_date" name="payroll_date[]" style="width:120px;" />
			  </p>
			  <table border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td style="width:512px;">Select range of work days to be included in first payroll for this group using the system</td>
				  <td style="width:180px;"><input class="txtfield dp cut_off_from" name="cut_off_from[]" style="width:70px;" type="text">
					<input class="txtfield dp cut_off_to" name="cut_off_to[]" style="width:70px;" type="text"></td>
				</tr>
				<tr>
				  <td colspan="2">
				  <a class="btn save" href="javascript:void(0);" id="add-project" >SAVE</a>
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
		
		<input type="submit" class="btn" id="save_all" name="save_all" value="Save All" />
      
        <!-- MAIN-CONTENT END -->
		<?php echo form_close();?>
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray left" href="#">BACK</a> <a class="btn btn-gray right" href="#"> CONTINUE</a>
        <!-- FOOTER-GRP-BTN END -->
      </div>
	  
<div id="payroll_calendar_dialog" class="jdialog"  title="Payroll Calendar">
	<div class="inner_div">
		<div style="display:none;" class="highlight_message msg2">Message</div>
		<div style="float:right;margin-bottom: 15px;">
		Year 
		<span id="pgy_span">
		</span>
		</div>
		<div style="clear:both;"></div>
		<div id="pc_table_div">
		Please Select Year
		</div>
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
	
	jQuery(".save").click(function(){
		var obj = jQuery(this);
		var pg_id = obj.parents(".payroll-calendar-row").find(".pg_id").val();
		var semi_monthly = obj.parents(".payroll-calendar-row").find(".semi_monthly").val();
		var monthly = obj.parents(".payroll-calendar-row").find(".monthly").val();
		var payroll_date = obj.parents(".payroll-calendar-row").find(".payroll_date").val();
		var cut_off_from = obj.parents(".payroll-calendar-row").find(".cut_off_from").val();
		var cut_off_to = obj.parents(".payroll-calendar-row").find(".cut_off_to").val();
		var error = "";
		if(semi_monthly==-1){
			error += "Semi month payroll date is required<br />";
		}
		if(monthly==-1){
			error += "Monthly payroll date is required<br />";
		}
		if(payroll_date==""){
			error += "Payroll date is required<br />";
		}
		if(cut_off_from==""){
			error += "Cut off from date is required<br />";
		}
		if(cut_off_to==""){
			error += "Cut off to date is required<br />";
		}
		if(error==""){
			
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
				obj.parents(".payroll-calendar-row").find(".semi_monthly").val("");
				obj.parents(".payroll-calendar-row").find(".monthly").val("");
				obj.parents(".payroll-calendar-row").find(".payroll_date").val("");
				obj.parents(".payroll-calendar-row").find(".cut_off_from").val("");
				obj.parents(".payroll-calendar-row").find(".cut_off_to").val("");
				highlight_message("Payroll calendar has been saved")
			});	
			
		}else{
			alert(error)
		}
			
	});
	
	jQuery("#save_all").click(function(){
		var is_empty = false;
		jQuery(".semi_monthly").each(function(){
			if(jQuery(this).val()==-1){
				is_empty = true;
			}
		});
		jQuery(".monthly").each(function(){
			if(jQuery(this).val()==-1){
				is_empty = true;
			}
		});
		jQuery(".payroll_date").each(function(){
			if(jQuery(this).val()==""){
				is_empty = true;
			}
		});
		jQuery(".cut_off_from").each(function(){
			if(jQuery(this).val()==""){
				is_empty = true;
			}
		});
		jQuery(".cut_off_to").each(function(){
			if(jQuery(this).val()==""){
				is_empty = true;
			}
		});
		if(is_empty){
			alert("all field are required");
		}else{
			jQuery("#jform").submit();
		}
	});
	
	// show caledar
	jQuery(".show_calendar").click(function(){
		var pg_id = jQuery(this).parents(".payroll-calendar-row").find(".pg_id").val();
		jQuery.ajax({
			type: "POST",
			url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/payroll_calendar/ajax_get_payroll_calendar_year",
			data: {
				pg_id: pg_id,
				<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
			}
		}).done(function(ret){
			jQuery("#pgy_span").html(ret);
			jQuery("#payroll_calendar_dialog").dialog({
				modal: true,
				show: {
					effect: "blind"
				},
				close: function( event, ui ) {
					jQuery("#pc_table_div").html("Please Select Year");
				},
				buttons: {
					'save': function() {
						// ajax call
								var is_changed = new Array();
								jQuery("#payroll_calendar_dialog .is_changed").each(function(index){
									is_changed[index] = jQuery(this).val();
								});
								var pc_id = new Array();
								jQuery("#payroll_calendar_dialog .pc_id").each(function(index){
									pc_id[index] = jQuery(this).val();
								});
								var payroll_date = new Array();
								jQuery("#payroll_calendar_dialog .edit_payroll_date").each(function(index){
									payroll_date[index] = jQuery(this).val();
								});
			
								var cut_off_from = new Array();
								jQuery("#payroll_calendar_dialog .edit_cut_off_from").each(function(index){
									cut_off_from[index] = jQuery(this).val();
								});
								var cut_off_to = new Array();
								jQuery("#payroll_calendar_dialog .edit_cut_off_to").each(function(index){
									cut_off_to[index] = jQuery(this).val();
								});
								var period = new Array();
								jQuery("#payroll_calendar_dialog .period").each(function(index){
									period[index] = jQuery(this).val();
								});
								jQuery.ajax({
									type: "POST",
									url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/payroll_calendar/ajax_update_payroll_calendar",
									data: {
										is_changed: is_changed,
										pc_id: pc_id,
										payroll_date: payroll_date,
										cut_off_from: cut_off_from,
										cut_off_to: cut_off_to,
										period: period,
										<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
									}
								}).done(function(ret){
									highlight_message("Changes has been saved",".msg2");
								});	
							
					
						
					}
				}
			});
		});	
	});
	
	// select year
	jQuery(document).on("change","#pcy_select",function(){
		var pg_id = jQuery("#pg_id").val();
		var year = jQuery(this).val();
		console.log(pg_id+" "+year);
		jQuery.ajax({
			type: "POST",
			url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/payroll_calendar/ajax_get_payroll_calendar",
			data: {
				pg_id: pg_id,
				year: year,
				<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
			}
		}).done(function(ret){
			jQuery("#pc_table_div").html(ret);
			// invoke date picker
			jQuery( ".dp" ).datepicker();
		});	
	});
	
	// if changed
	jQuery(document).on("change","#payroll_calendar_dialog .inner_div input[type='text']",function(){
		jQuery(this).parents("tr:first").find(".is_changed").val(1);
	});
	
});
</script>