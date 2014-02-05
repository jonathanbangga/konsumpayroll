<div class="main-content">
<?php
$attributes = array('id' => 'jform');
echo form_open("/{$this->session->userdata('sub_domain')}/payroll_setup/overtime_settings", $attributes);
?>
<div style="display:none;" class="highlight_message">Message</div>
        <!-- MAIN-CONTENT START -->
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt<br>
          ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation </p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl ot_tbl">
            <tbody>
              <tr>
                <th style="width:135px">Overtime Type</th>
                <th style="width:110px;">Pay Rate %</th>
                <th style="width:110px">OT Rate %</th>
                <th style="width:160px">Action</th>
              </tr>
			  <?php
			  if($ot_sql->num_rows()>0){
				foreach($ot_sql->result() as $ot){ ?>
					<tr>
						<td><span class="overtime_type_span"><?php echo $ot->hour_type_name;	?></span></td>
						<td><span class="pay_rate_span"><?php echo $ot->pay_rate; ?></span></td>
						<td><span class="ot_rate_span"><?php echo $ot->ot_rate; ?></span></td>
						<td>
							<a href="javascript:void(0);" class="btn btn-gray btn-action btn-edit">EDIT</a> 
							<a href="javascript:void(0);" class="btn btn-red btn-action btn-delete">DELETE</a>
							<input type="hidden" class="overtime_type_id" value="<?php echo $ot->overtime_type_id ?>" />
						</td>
					</tr>
			  <?php
				}
			  }else{
					echo '<tr><td colspan="4" id="empty">No Overtime type yet</td></tr>';
			  }
			  ?>
              
			  
            </tbody>
          </table>
          <!-- TBL-WRAP END -->
        </div>
        <a href="javascript:void(0);" class="btn" id="add-more">ADD MORE</a>
        <br>
        <br>
        Do you allow automatic recognition for overtime if hours worked exceeded the required work hours?
        <table style="margin-bottom:20px;" border="0" cellspacing="0" cellpadding="0">
		<?php
		if($ots_sql->num_rows()>0){
			$ots = $ots_sql->row();
			
			$ots_id =$ots->overtime_settings_id;
			$ar =$ots->automatic_recognition;
			$oalh =$ots->overtime_as_leave_hours;
			$lt_id =$ots->leave_type_id;
			$mh =$ots->min_hours;
			$i =$ots->increment;
		}else{
			$ots_id = "";
			$ar = "";
			$oalh = "";
			$lt_id = "";
			$mh = "";
			$i = "";
		}
		?>
          <tr>
            <td style="width:60px;">
			<input style="margin:2px 5px 0 0;" name="automatic_recognition" id="ar_yes" type="radio" value="1" <?php echo ($ar==="1")?'checked="checked"':""; ?> />
              Yes</td>
            <td><input style="margin:2px 5px 0 0;" name="automatic_recognition" id="ar_no" type="radio" value="0" <?php echo ($ar==="0")?'checked="checked"':""; ?> />
              No</td>
          </tr>
        </table>
        Do you want your approved overtime to be credited as leave hours?
        <table style="margin-bottom:20px;" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="width:60px;"><input style="margin:2px 5px 0 0;" name="overtime_as_leave_hours" id="oalh_yes" type="radio" value="1" <?php echo ($oalh==="1")?'checked="checked"':""; ?> />
              Yes</td>
            <td><input style="margin:2px 5px 0 0;" name="overtime_as_leave_hours" type="radio" id="oalh_no" value="0" <?php echo ($oalh==="0")?'checked="checked"':""; ?> />
              No</td>
          </tr>
        </table>
		
		<div <?php echo ($oalh==1)?"":'style="display:none;"'; ?> id="leave_type">
			<p>Select leave type
			  <select style="margin-left:5px;" class="txtselect" name="leave_type">
				<option value="">select</option>
				<?php
				foreach($lt_sql->result() as $lt){ 
				
				?>
					<option value="<?php echo $lt->leave_type_id; ?>" <?php echo ($lt_id==$lt->leave_type_id&&$oalh==1)?'selected="selected"':""; ?>><?php echo $lt->leave_type; ?></option>
				<?php	
				}
				?>
			  </select>
			</p>
		</div>
        
        <p>Minimum hours required to be considered as overtime
          <input style="width:40px; margin-left:5px;" class="txtfield" name="min_hours" type="text" value="<?php echo $mh; ?>" />
        </p>
        <p>Credited overtime increments every (in min)
          <input style="width:40px; margin-left:5px;" class="txtfield" name="increment" type="text" value="<?php echo $i; ?>" />
        </p>
        <br>
		
		<input type="hidden" name="ots_id" value="<?php echo $ots_id; ?>" /> 
		<input type="hidden" name="has_ots" value="<?php echo ($ots_sql->num_rows()>0)?1:0; ?>" /> 
		
        <p>Overtime allowances are benefits given to employees for work rendered beyond the regular working hours.<br>
          A fixed amount is given to an employee for each workday that the minimum OT hours is met.</p>
        <div class="tbl-wrap">
          <table class="tbl at_tbl">
            <tr>
              <th style="width:120px;">Allowance Type</th>
              <th style="width:120px;">Taxable</th>
              <th style="width:166px;">Max Non-Taxable Amount</th>
              <th style="width:135px;">Amount</th>
              <th style="width:135px;">Min OT Hours</th>
              <th style="width:160px;">Action</th>
            </tr>
			<?php
			if($at_sql->num_rows()>0){
				foreach($at_sql->result() as $at){ ?>
					<tr>
					  <td><span class="allowance_type_name_span"><?php echo $at->allowance_type_name; ?></span></td>
					  <td><span class="taxable_span" style="display:none;"><?php echo $at->taxable; ?></span><?php echo ($at->taxable==1)?"Yes":"No"; ?></td>
					  <td><span class="maximum_non_taxable_amount_span"><?php echo $at->maximum_non_taxable_amount; ?></span></td>
					  <td><span class="amount_span"><?php echo $at->amount; ?></span></td>
					  <td><span class="minimum_ot_hours_span"><?php echo $at->minimum_ot_hours; ?></span></td>
					  <td>
						<a href="javascript:void(0);" class="btn btn-gray btn-action btn-edit-at">EDIT</a> 
						<a href="javascript:void(0);" class="btn btn-red btn-delete-at">DELETE</a>
						<input type="hidden" class="allowance_type_id" value="<?php echo $at->allowance_type_id ?>" />
					  </td>
					</tr>
				<?php
				}
			}else{
				echo '<tr><td colspan="6" id="empty-at" style="text-align:left;">No Allowance type yet</td></tr>';
			}
			?>
            
          </table>
        </div>
		
		<a href="javascript:void(0);" class="btn" id="add-more-at">ADD MORE</a><br />
		
		<input type="hidden" name="save" id="save" value="0" />
		<a class="btn" id="save_btn" href="javascript:void(0);" style="margin-top: 20px;" >SAVE</a>
		<?php echo form_close(); ?>
        <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray left" href="#">BACK</a> <a class="btn btn-gray right" href="#"> CONTINUE</a>
      
        <!-- FOOTER-GRP-BTN END -->
      </div>

<div id="confirm-delete-dialog" class="jdialog"  title="Delete">
	<div class="inner_div">
		Are you sure you want to delete? 
	</div>
</div>  

<div id="edit-overtime_settings" class="jdialog"  title="Edit">
	<div class="inner_div">
		<p>
			Overtime Type:<br />
			<input type="text" id="edit_overtime_type" class="txtfield" />
		</p>
		<p>
			Pay Rate %:<br />
			<input type="text" id="edit_pay_rate" class="txtfield" />
		</p>
		<p>
			OT Rate %:<br />
			<input type="text" id="edit_ot_rate" class="txtfield" />
		</p>
	</div>
</div>

<div id="edit-allowance_settings" class="jdialog"  title="Edit">
	<div class="inner_div">
		<p>
			Allowance Type:<br />
			<input type="text" id="edit_allowance_type" class="txtfield" />
		</p>
		<p>
			Taxable:<br />
			<select class="txtselect" id="edit_taxable">
				<option value="-1">select</option>
				<option value="1">Yes</option>
				<option value="0">No</option>
			</select>
		</p>
		<p>
			Max Non-Taxable Amount:<br />
			<input type="text" id="edit_maximum_non_taxable" class="txtfield" />
		</p>
		<p>
			Amount:<br />
			<input type="text" id="edit_amount" class="txtfield" />
		</p>
		<p>
			Min OT Hours:<br />
			<input type="text" id="edit_minimum_ot" class="txtfield" />
		</p>
	</div>
</div>
	  
	  
<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>


<script>
jQuery(document).ready(function(){

	// load highlight message script
	redirect_highlight_message();
	
	// add overtime type
	jQuery("#add-more").click(function(){
		jQuery("#empty").hide();
		str = ''+
			'<tr>'+
							'<td>'+
								'<select name="overtime_type[]" class="txtselect overtime_type">'+
									<?php
									foreach($ht_sql->result() as $ht){ ?>
										'<option value="<?php echo $ht->hour_type_id ?>"><?php echo $ht->hour_type_name ?></option>'+
									<?php
									}
									?>
								'</select>'+
							'</td>'+
							'<td><input style="width:115px;" class="txtfield pay_rate" name="pay_rate[]" type="text"></td>'+
							'<td><input style="width:115px;" class="txtfield ot_rate" name="ot_rate[]" type="text"></td>'+
							'<td><a href="#" class="btn btn-gray btn-action">EDIT</a> <a href="javascript:void(0);" class="btn btn-red btn-action btn-remove">REMOVE</a></td>'+
						'</tr>';
		jQuery(".ot_tbl tbody").append(str);
		jQuery(".overtime_type").each(function(){
			get_hour_type_rate(jQuery(this));
		});
		 
	});
	
	// remove overtime type row
	jQuery(document).on("click",".btn-remove",function(){
		jQuery(this).parents("tr:first").remove();
		if(jQuery(".overtime_type").length==0){
			jQuery("#empty").show();
		}
	});
	
	// delete overtime type
	jQuery(".btn-delete").click(function(){
		var obj = jQuery(this);
		jQuery("#confirm-delete-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'yes': function() {
					var overtime_type_id = obj.parents("tr:first").find(".overtime_type_id").val();
					// ajax call
					jQuery.ajax({
						type: "POST",
						url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/overtime_settings/ajax_delete_overtime_type",
						data: {
							overtime_type_id: overtime_type_id,
							<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
						}
					}).done(function(ret){
						jQuery.cookie("msg", "Overtime type has been deleted");
						window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/overtime_settings";
					});				
				},
				'no': function() {
					jQuery(this).dialog( 'close' );					
				}
			}
		});
	});
	
	// edit overtime type
	jQuery(".btn-edit").click(function(){
		var obj = jQuery(this);
		var overtime_type_id = obj.parents("tr:first").find(".overtime_type_id").val();
		var overtime_type = obj.parents("tr:first").find(".overtime_type_span").html();
		var pay_rate = obj.parents("tr:first").find(".pay_rate_span").html();
		var ot_rate = obj.parents("tr:first").find(".ot_rate_span").html();
		jQuery("#edit_overtime_type").val(overtime_type);
		jQuery("#edit_pay_rate").val(pay_rate);
		jQuery("#edit_ot_rate").val(ot_rate);
		jQuery("#edit-overtime_settings").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'update': function() {
					var overtime_type = jQuery("#edit_overtime_type").val();
					var pay_rate = jQuery("#edit_pay_rate").val();
					var ot_rate = jQuery("#edit_ot_rate").val();
					// ajax call
					jQuery.ajax({
						type: "POST",
						url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/overtime_settings/ajax_update_overtime_type",
						data: {
							overtime_type_id: overtime_type_id,
							overtime_type: overtime_type,
							pay_rate: pay_rate,
							ot_rate: ot_rate,
							<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
						}
					}).done(function(ret){
						jQuery.cookie("msg", "Overtime type has been updated");
						window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/overtime_settings";
					});	
				}
			}
		});
	});
	
	
	
	// add allowance type
	jQuery("#add-more-at").click(function(){
		jQuery("#empty-at").hide();
		str = ''+
			'<tr>'+
							'<td><input style="width:100px;" class="txtfield allowance_type" name="allowance_type[]" type="text"></td>'+
							'<td>'+
								'<select class="txtselect taxable" name="taxable[]" style="width:98px;">'+
									'<option value="-1">select</option>'+
									'<option value="1">Yes</option>'+
									'<option value="0">No</option>'+
								'</select>'+
							'</td>'+
							'<td><input style="width:100px;" class="txtfield max_non_taxable" name="max_non_taxable[]" type="text"></td>'+
							'<td><input style="width:100px;" class="txtfield amount" name="amount[]" type="text"></td>'+
							'<td><input style="width:100px;" class="txtfield min_ot" name="min_ot[]" type="text"></td>'+
							'<td>'+
								'<a href="#" class="btn btn-gray btn-action">EDIT</a>'+ 
								'<a href="javascript:void(0);" class="btn btn-red btn-action btn-remove-at">REMOVE</a>'+
							'</td>'+
						'</tr>';
		jQuery(".at_tbl tbody").append(str);
	});
	
	// remove allowance type row
	jQuery(document).on("click",".btn-remove-at",function(){
		jQuery(this).parents("tr:first").remove();
		if(jQuery(".allowance_type").length==0){
			jQuery("#empty-at").show();
		}
	});
	
	// delete allowance type
	jQuery(".btn-delete-at").click(function(){
		var obj = jQuery(this);
		jQuery("#confirm-delete-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'yes': function() {
					var allowance_type_id = obj.parents("tr:first").find(".allowance_type_id").val();
					// ajax call
					jQuery.ajax({
						type: "POST",
						url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/overtime_settings/ajax_delete_allowance_type",
						data: {
							allowance_type_id: allowance_type_id,
							<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
						}
					}).done(function(ret){
						jQuery.cookie("msg", "Allowance type has been deleted");
						window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/overtime_settings";
					});				
				},
				'no': function() {
					jQuery(this).dialog( 'close' );					
				}
			}
		});
	});
	
	// edit allowance type
	jQuery(".btn-edit-at").click(function(){
		var obj = jQuery(this);
		var allowance_type_id = obj.parents("tr:first").find(".allowance_type_id").val();
		var allowance_type = obj.parents("tr:first").find(".allowance_type_name_span").html();
		var taxable = obj.parents("tr:first").find(".taxable_span").html();
		var maximum_non_taxable = obj.parents("tr:first").find(".maximum_non_taxable_amount_span").html();
		var amount = obj.parents("tr:first").find(".amount_span").html();
		var minimum_ot = obj.parents("tr:first").find(".minimum_ot_hours_span").html();
		jQuery("#edit_allowance_type").val(allowance_type);
		jQuery("#edit_taxable option").each(function(){
			if(jQuery(this).val()==taxable){
				jQuery(this).prop("selected",true);
			}
		});
		jQuery("#edit_maximum_non_taxable").val(maximum_non_taxable);
		jQuery("#edit_amount").val(amount);
		jQuery("#edit_minimum_ot").val(minimum_ot);
		jQuery("#edit-allowance_settings").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'update': function() {
					var allowance_type = jQuery("#edit_allowance_type").val();
					var taxable = jQuery("#edit_taxable").val();
					var maximum_non_taxable = jQuery("#edit_maximum_non_taxable").val();
					var amount = jQuery("#edit_amount").val();
					var minimum_ot = jQuery("#edit_minimum_ot").val();
					// ajax call
					jQuery.ajax({
						type: "POST",
						url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/overtime_settings/ajax_update_allowance_type",
						data: {
							allowance_type_id: allowance_type_id,
							allowance_type: allowance_type,
							taxable: taxable,
							maximum_non_taxable: maximum_non_taxable,
							amount: amount,
							minimum_ot: minimum_ot,
							<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
						}
					}).done(function(ret){
						jQuery.cookie("msg", "Overtime type has been updated");
						window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/overtime_settings";
					});	
				}
			}
		});
	});
	
	// save
	jQuery("#save_btn").click(function(){
		var error = "";
		var ot_is_empty = false;
		var at_is_empty = false;
		jQuery(".overtime_type").each(function(){
			if(jQuery(this).val()==""){
				ot_is_empty = true;
			}
		});
		error += (ot_is_empty==true)?"Some of overtime type field is empty<br />":"";
		jQuery(".allowance_type").each(function(){
			if(jQuery(this).val()==""){
				at_is_empty = true;
			}
		});
		error += (at_is_empty==true)?"Some of allowance type field is empty":"";
		if(error!=""){
			alert(error);
		}else{
			jQuery("#save").val(1);
			jQuery("#jform").submit();
		}
		
	});
	
	// leave type hide/show script
	jQuery("#oalh_yes").click(function(){
		jQuery("#leave_type").slideDown();
	});
	jQuery("#oalh_no").click(function(){
		jQuery("#leave_type").slideUp();
	});
	
	jQuery(document).on("change",".overtime_type",function(){
	   get_hour_type_rate(jQuery(this));
	});
	
	function get_hour_type_rate(obj){
		var ht_id = obj.val();
		// ajax call
		jQuery.ajax({
			type: "POST",
			url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/overtime_settings/ajax_get_rate",
			data: {
				ht_id: ht_id,
				<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
			}
		}).done(function(ret){
			obj.parents("tr:first").find(".pay_rate").val(ret);
			/*jQuery.cookie("msg", "Overtime type has been updated");
			window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/overtime_settings";*/
		});	
	}

});
</script>