<?php 
$attr = array('id'=>'jform');
echo form_open("/{$this->session->userdata('sub_domain2')}/payroll_run/payroll_period",$attr); 
// payroll period

if($pp_sql->num_rows()>0){
	$pp = $pp_sql->row();
	$pid = $pp->payroll_period_id;
	$pg_id = $pp->payroll_group_id;
	$period = $pp->payroll_period;
	$pfrom = date('m/d/Y',strtotime($pp->period_from));
	$pto = date('m/d/Y',strtotime($pp->period_to));
}else{
	$pid = "";
	$pg_id = "";
	$period = "";
	$pfrom = "";
	$pto = "";
}

?>
<div class="main-content"> 
<div style="display:none;" class="highlight_message">Message</div>
<!-- MAIN-CONTENT START -->
	<p>Select payroll date and payroll group you want to process.</p>
	<table class="jtbl">
		<tbody>
			<tr>
				<td style="display:none;"><input type="hidden" name="payroll_period_id" value="<?php echo $pid; ?>" /></td>
				<td>Payroll Group</td>
				<td>
					<select class="txtselect" id="payroll_group" name="payroll_group">
						<option value="">Select Payroll Group</option>
						<?php
						foreach($pg_sql->result() as $pg){ ?>
							<option value="<?php echo $pg->payroll_group_id; ?>" <?php echo ($pg->payroll_group_id==$pg_id)?'selected="selected"':''; ?>><?php echo $pg->name ?></option>
						<?php	
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Payroll Period</td>
				<td>
					<select class="txtselect" id="payroll_period" name="payroll_period">
						<?php
							if($period!=""){
							$pp_sql = $this->payroll_period_model->get_payroll_calendar($pg_id);
								foreach($pp_sql->result() as $pp){
						?>
							<option value="<?php echo $pp->payroll_calendar_id; ?>" <?php echo ($pp->first_payroll_date==$period)?'selected="selected"':''; ?>><?php echo date("m/d/Y",strtotime($pp->first_payroll_date)); ?></option>	
						<?php
								}
							}else{ ?>
							<option value="">Select Payroll Period</option>
						<?php	
						}
						?>
						
						
					</select>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="text" class="txtfield" readonly="readonly" name="pfrom" id="pfrom" value="<?php echo $pfrom; ?>" />
					<input type="text" class="txtfield" readonly="readonly" name="pto" id="pto" value="<?php echo $pto; ?>" />
				</td>
			</tr>
		</tbody>
	</table>
<!-- MAIN-CONTENT END --> 

</div>
<div class="footer-grp-btn" style="width:820px;"> 
<!-- FOOTER-GRP-BTN START --> 
<a class="btn btn-gray left" href="#">BACK</a>
<input class="btn right" id="save" name="submit" type="submit" value="SAVE">
<!-- FOOTER-GRP-BTN END --> 
</div>
<?php echo form_close(); ?>

<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>

<style>
.jtbl td{
	padding: 9px;
}
</style>
<script>
jQuery(document).ready(function(){

	// load highlight message script
	redirect_highlight_message();

	// get payroll period
	jQuery("#payroll_group").change(function(){
		var pg_id = jQuery(this).val();
		jQuery.ajax({
			type: "POST",
			url: "/<?php echo $this->session->userdata('sub_domain2'); ?>/payroll_run/payroll_period/ajax_get_payroll_period",
			data: {
				pg_id: pg_id,
				<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
			}
		}).done(function(ret){
			if(ret!=""){
				jQuery("#payroll_period").html(ret);
			}else{
				jQuery("#payroll_period").html("<option>empty</option>");
				jQuery("#pfrom").val("");
				jQuery("#pto").val("");
			}
		});
	});
	// get payroll range
	jQuery("#payroll_period").change(function(){
		var pc_id = jQuery(this).val();
		jQuery.ajax({
			type: "POST",
			url: "/<?php echo $this->session->userdata('sub_domain2'); ?>/payroll_run/payroll_period/ajax_get_range",
			data: {
				pc_id: pc_id,
				<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
			},
			dataType: 'json'
		}).done(function(ret){
			console.log(ret);
			if(ret!=-1){
				console.log('true');
				jQuery("#pfrom").val(ret.pfrom);
				jQuery("#pto").val(ret.pto);
			}else{
				console.log('false');
				jQuery("#pfrom").val("");
				jQuery("#pto").val("");
			}
			
		});
	});
	// save
	jQuery("#jform").submit(function(event){
		//event.preventDefault();
		var pg = jQuery("#payroll_group").val();
		var pp = jQuery("#payroll_period").val();
		var pfrom = jQuery("#pfrom").val();
		var pto = jQuery("#pto").val();
		var error = "";
			if(pg==""){
				error += "Payroll Group is Required<br />";
			}
			if(pp==""){
				error += "Payroll Period is Required<br />";
			}
			if(pfrom==""){
				error += "Payroll Period from field is Required<br />";
			}
			if(pto==""){
				error += "Payroll Period to field is Required<br />";
			}
		if(error!=""){
			event.preventDefault();
			alert(error);
		}
	});
	
});
</script>