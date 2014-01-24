<?php
$attr = array('id'=>'jform');
echo form_open_multipart("/{$this->session->userdata('sub_domain2')}/payroll_run/timesheets/index/".$source,$attr); 
?>
<div class="main-content"> 
<div style="display:none;" class="highlight_message">Message</div>

<div class="jmenu" style="margin-bottom: 15px;">
	<button type="button" class="btn" id="btn_timesheet">Timesheet</button>
	<button type="button" class="btn" id="btn_details">Details</button>
</div>
<?php
// payroll period
$pp = $pp_sql->row();
$payroll_period = $pp->payroll_period;
$pp_start = $pp->period_from;		
?>
<div id="jdetails" style="display:none;">
<div class="tbl-wrap">
  	<table class="tbl">
	  <tr>
		<th><input type="checkbox" id="check_all" /></th>
		<th style="width: 150px;">Employee ID</th>
		<th style="width: 400px;">Employee Name</th>
		<th style="width: 140px;">Payroll Period</th>
		<?php
		for($i=0;$i<15;$i++){
		
		?>
			<th style="width: 60px;"><?php echo date('m/d/Y',strtotime($pp_start)); ?></th>
		<?php
		$pp_start = date('m/d/Y',strtotime($pp_start." +1 day"));
		}
		?>
		
	  </tr>
<?php
	if($emp_ti_details_sql->num_rows()>0){
		foreach($emp_ti_details_sql->result() as $emp_ti_details){ ?>
	  <tr>
		<td>
			<input type="checkbox" class="chk" name="eti_emp_id[]" value="<?php echo $emp_ti_details->emp_id; ?>" />
		</td>
		<td>
			<div style="width: 150px;">
				<?php echo $emp_ti_details->payroll_cloud_id; ?>
			</div>
		</td>
		<td>
			<div style="width: 300px;">
				<?php echo $emp_ti_details->first_name.' '. $emp_ti_details->last_name; ?>
			</div>
		</td>
		<td>
			<div style="width: 150px;">
				<?php echo date("m/d/Y",strtotime($payroll_period)); ?>
			</div>
		</td>
		<?php
		// get hours worked
		$pp_start = $pp->period_from;	
		for($i=0;$i<15;$i++){
		$hw_sql = $this->timesheets_model->get_hours_worked($emp_ti_details->emp_id,date('Y-m-d',strtotime($pp_start)),$source);
		if($hw_sql->num_rows()>0){
			$hw = $hw_sql->row();
			$hours_worked = $hw->total_hours;
		}else{
			$hours_worked = "";
		}
		?>
			<td><?php echo $hours_worked; ?></th>
		<?php
		$pp_start = date('m/d/Y',strtotime($pp_start." +1 day"));
		}
		?>
	  </tr>
	  <?php
		}
	}else{ ?>
		<tr><td colspan="18">Empty</td></tr>
	<?php
	}
	?>
	</table>
</div>
<input type="hidden" name="hid_delete" id="hid_delete" value="0" />
<button type="button" name="btn_delete" id="btn_delete" class="btn">DELETE</button>
</div>


<p>

<?php
if(isset($emp_arr)){ ?>
	The following employees are not inserted, because they did not exist in the employee record. Please review your data. And upload it again
	<?php foreach($emp_arr as $val){ ?>
	<ul>
		<li><?php echo $val; ?></li>
	</ul>	
	<?php 
	}
}
?>
</p>
<!-- MAIN-CONTENT START -->
<div id="jtimesheet">
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt<br>
  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation </p>
<p>
<table class="tbl1">
	<tbody>
		<tr>
			<td>Choose what data to process</td>
			<td>
				<select name="process_sel" id="process_sel" class="txtselect">
					<option value="0" <?php echo ($source==0)?'selected="selected"':''; ?>>--Select--</option>
					<option value="1" <?php echo ($source==1)?'selected="selected"':''; ?>>Import File</option>
					<option value="2" <?php echo ($source==2)?'selected="selected"':''; ?>>Time-ins</option>
				</select>
			</td>
		</tr>
		<?php
		if($source==1){ ?>
			<tr id="import_tr">
				<td>Choose file to import</td>
				<td>
					<input type="file" name="file" />
				</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" name="upload" class="btn" value="upload" />
			</td>
		</tr>
		<?php
		}
		?>
		
		
	</tbody>
</table>




</p>  
<div class="tbl-wrap">
  <table width="915" border="0" cellspacing="0" cellpadding="0" class="tbl">
	<tr>
	  <th width="96">Source </th>
	  <th width="101">Employee ID</th>
	  <th width="171">Employee Name</th>
	  <th width="96">Date</th>
	  <th width="111">Time In</th>
	  <th width="111"> Time Out</th>
	</tr>
	<?php
	if($emp_ti_sql->num_rows()>0){
		foreach($emp_ti_sql->result() as $emp_ti){ ?>
		<tr>
		  <td><?php echo $emp_ti->source; ?></td>
		  <td><?php echo $emp_ti->payroll_cloud_id; ?></td>
		  <td><?php echo $emp_ti->first_name.' '. $emp_ti->last_name; ?></td>
		  <td><?php echo date("m/d/Y",strtotime($emp_ti->date)); ?></td>
		  <td><?php echo date("m/d/Y H:i",strtotime($emp_ti->time_in));; ?></td>
		  <td><?php echo date("m/d/Y H:i",strtotime($emp_ti->time_out));; ?></td>
		</tr>
		<?php
		}
	}else{ ?>
		<tr><td colspan="6">Empty</td></tr>
	<?php
	}
	?>
  </table>
</div>
<div class="pagination" style="margin-bottom: 22px;">
<?php echo $pagination; ?>
<div style="clear:both;"></div>
</div>
<div>
<!-- MAIN-CONTENT END --> 
</div>
<div class="footer-grp-btn" style="width:820px;"> 
<!-- FOOTER-GRP-BTN START --> 
<a class="btn btn-gray left" href="#">BACK</a>
<input type="hidden" id="hid_save" name="hid_save" value="0" />
<button type="button" id="btn_save" class="btn btn-gray right">SAVE</button>
<!-- FOOTER-GRP-BTN END --> 
</div>
<?php echo form_close(); ?>

<div id="confirm-delete-dialog" class="jdialog"  title="Add more">
	<div class="inner_div">
		Are you sure you want to delete? 
	</div>
</div>  


<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>

<style>
.tbl1 td{
	padding: 10px;
}
</style>
<script>
jQuery(document).ready(function(){

	// load highlight message script
	console.log(jQuery.cookie("msg"));
	if(jQuery.cookie("msg")!=null){
		jQuery(".highlight_message").html(jQuery.cookie("msg"));
		jQuery.removeCookie("msg",{ path: '/<?php echo $this->session->userdata('sub_domain2'); ?>/payroll_run/timesheets/' });
		jQuery.removeCookie("msg",{ path: '/<?php echo $this->session->userdata('sub_domain2'); ?>/payroll_run/' });
		jQuery(".highlight_message").fadeIn();
		setTimeout(function(){
			jQuery(".highlight_message").fadeOut();	
		},5000);
	}
	
	if(jQuery.cookie('timesheet_tab')=='details'){
		show_details();
	}
	
	// tab script
	jQuery("#btn_timesheet").click(function(){
		jQuery.cookie('timesheet_tab', 'timesheet', { path: '/' });
		show_timesheet();
	});
	jQuery("#btn_details").click(function(){
		jQuery.cookie('timesheet_tab', 'details', { path: '/' });
		show_details();
	});
	
	function show_timesheet(){
		jQuery("#jtimesheet").show();
		jQuery("#jdetails").hide();
	}
	
	function show_details(){
		jQuery("#jtimesheet").hide();
		jQuery("#jdetails").show();
	}
	
	// import field hide/show script
	jQuery("#process_sel").change(function(){
		switch(jQuery(this).val()){
			// empty
			case "0":
				window.location="/<?php echo $this->session->userdata('sub_domain2') ?>/payroll_run/timesheets";
			break;
			// import
			case "1":
				window.location="/<?php echo $this->session->userdata('sub_domain2') ?>/payroll_run/timesheets/index/1";
			break;
			// time-ins
			case "2":
				window.location="/<?php echo $this->session->userdata('sub_domain2') ?>/payroll_run/timesheets/index/2";
			break;
		}
	});
	
	// save script
	jQuery("#btn_save").click(function(){
		if(jQuery("#process_sel").val()!=0){
			jQuery("#hid_save").val(1);
			jQuery("#jform").submit();
		}else{
			alert("please select item to process");
		}			
	});
	
	// check/uncheck all script
	jQuery("#check_all").click(function(){
		if(jQuery(this).prop("checked")==true){
			jQuery(".chk").prop("checked",true);
		}else{
			jQuery(".chk").prop("checked",false);
		}
	});
	
	// delete earnings
	jQuery("#btn_delete").click(function(){
		jQuery("#hid_delete").val(1)
		if(jQuery(".chk:checked").length>0){
			jQuery("#confirm-delete-dialog").dialog({
				modal: true,
				show: {
					effect: "blind"
				},
				buttons: {
					'yes': function() {
						jQuery("#jform").submit();		
					},
					'no': function() {
						jQuery(this).dialog( 'close' );					
					}
				}
			});
		}else{
			alert("Please select at least 1 item to delete");
		}
	});
	
});
</script>