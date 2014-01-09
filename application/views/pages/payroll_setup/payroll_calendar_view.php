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
				<input type="hidden" class="pg_id" name="pg_id[]" value="<?php echo $pg->payroll_group_id; ?>" />
			  </h5>
			  
			  <?php
				$pc_sql = $this->payroll_calendar_model->get_payroll_calendar($pg->payroll_group_id);
				if($pc_sql->num_rows()>0){
					$pc = $pc_sql->row();
					$pc_id = $pc->payroll_calendar_id;
					$fsm = $pc->first_semi_monthly;
					$sm = $pc->second_monthly;
					$fpd = $pc->first_payroll_date;
					$cof = $pc->cut_off_from;
					$cot = $pc->cut_off_to;
				}else{
					$pc_id = "";
					$fsm = "";
					$sm = "";
					$fpd = "";
					$cof = "";
					$cot = "";
				}				
			  ?>
			  
			  <table style="margin-bottom:8px;">
				<tr>
				  <td style="display:none">
					<input type="hidden" name="pc_id[]" class="pc_id" value="<?php echo $pc_id; ?>" />
				  </td>
				  <td style="width:314px;"> Indicate the date of the first semi-monthly payroll </td>
				  <td style="width:120px;">
					<select style="width:120px;" class="txtselect first_semi_monthly" name="first_semi_monthly[]">
						<option value="">select</option>
						<?php
						for($i=1;$i<=15;$i++){?>
							<option value="<?php echo $i; ?>" <?php echo ($i==$fsm)?'selected="selected"':''; ?>><?php echo $i; ?></option>
						<?php
						}
						?>
					</select>
					</td>
				</tr>
				<tr>
				  <td>Indicate the date of your second monthly payroll</td>
				  <td>
					<select style="width:120px;" class="txtselect second_monthly" name="second_monthly[]">
						<option value="">select</option>
						<?php
						for($i=16;$i<=31;$i++){?>
							<option value="<?php echo $i; ?>" <?php echo ($i==$sm)?'selected="selected"':''; ?>><?php echo $i; ?></option>
						<?php
						}
						?>
						<option value="-1" <?php echo ($sm==-1)?'selected="selected"':''; ?>>end of month</option>
					</select>
					</td>
				</tr>
			  </table>
			  <p style="padding-bottom:8px;">State the first payroll for this group that will be run by this system
				<input type="text" class="txtfield dp first_payroll_date" name="first_payroll_date[]" style="width:120px;" value="<?php echo $fpd; ?>" />
			  </p>
			  <table border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td style="width:512px;">Select range of work days to be included in first payroll for this group using the system</td>
				  <td style="width:180px;"><input class="txtfield dp cut_off_from" name="cut_off_from[]" style="width:70px;" type="text" value="<?php echo $cof; ?>" />
					<input class="txtfield dp cut_off_to" name="cut_off_to[]" style="width:70px;" type="text"  value="<?php echo $cot; ?>" /></td>
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
	<div class="inner_div pgy_span">
		<div style="float:right;margin-bottom: 15px;" class="pgy_span">
			<div id="pgy_span">
			</div>
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
		var first_semi_monthly = obj.parents(".payroll-calendar-row").find(".first_semi_monthly").val();
		var second_monthly = obj.parents(".payroll-calendar-row").find(".second_monthly").val();
		var first_payroll_date = obj.parents(".payroll-calendar-row").find(".first_payroll_date").val();
		var cut_off_from = obj.parents(".payroll-calendar-row").find(".cut_off_from").val();
		var cut_off_to = obj.parents(".payroll-calendar-row").find(".cut_off_to").val();
		var error = "";
		if(first_semi_monthly==""){
			error += "Semi month payroll date is required<br />";
		}
		if(second_monthly==""){
			error += "Monthly payroll date is required<br />";
		}
		if(first_payroll_date==""){
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
					first_semi_monthly: first_semi_monthly,
					second_monthly: second_monthly,
					first_payroll_date: first_payroll_date,
					cut_off_from: cut_off_from,
					cut_off_to: cut_off_to,
					<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
				}
			}).done(function(ret){
				highlight_message("Payroll calendar has been saved");
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
		var pc_id = jQuery(this).parents(".payroll-calendar-row").find(".pc_id").val();
		jQuery.ajax({
			type: "POST",
			url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/payroll_calendar/ajax_show_calendar",
			data: {
				pc_id: pc_id,
				<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
			}
		}).done(function(ret){
			jQuery("#pgy_span").html(ret);
			jQuery("#payroll_calendar_dialog").dialog({
				modal: true,
				show: {
					effect: "blind"
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