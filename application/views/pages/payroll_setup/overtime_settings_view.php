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
						<td><?php echo $ot->overtime_type_name;	?></td>
						<td><?php echo $ot->pay_rate; ?></td>
						<td><?php echo $ot->ot_rate; ?></td>
						<td><a href="#" class="btn btn-gray btn-action">EDIT</a> <a href="#" class="btn btn-red btn-action">DELETE</a></td>
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
          <tr>
            <td style="width:60px;"><input style="margin:2px 5px 0 0;" name="automatic_recognition" id="ar_yes" type="radio" value="1">
              Yes</td>
            <td><input style="margin:2px 5px 0 0;" name="automatic_recognition" id="ar_no" type="radio" value="0">
              No</td>
          </tr>
        </table>
        Do you want your approved overtime to be credited as leave hours?
        <table style="margin-bottom:20px;" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="width:60px;"><input style="margin:2px 5px 0 0;" name="overtime_as_leave_hours" id="oalh_yes" name="automatic_recognition" type="radio" value="1">
              Yes</td>
            <td><input style="margin:2px 5px 0 0;" name="overtime_as_leave_hours" type="radio" id="oalh_no" value="0">
              No</td>
          </tr>
        </table>
		
		<div style="display:none;" id="leave_type">
			<p>Select leave type
			  <select style="margin-left:5px;" class="txtselect" name="">
				<option value="">select</option>
				<?php
				foreach($lt_sql->result() as $lt){ ?>
					<option value="<?php echo $lt->leave_type_id; ?>"><?php echo $lt->leave_type; ?></option>
				<?php	
				}
				?>
			  </select>
			</p>
		</div>
        
        <p>Minimum hours required to be considered as overtime
          <input style="width:40px; margin-left:5px;" class="txtfield" name="" type="text">
        </p>
        <p>Credited overtime increments every (in min)
          <input style="width:40px; margin-left:5px;" class="txtfield" name="" type="text">
        </p>
        <br>
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
					  <td><?php echo $at->allowance_type_name; ?></td>
					  <td><?php echo ($at->taxable==1)?"Yes":"No"; ?></td>
					  <td><?php echo $at->maximum_non_taxable_amount; ?></td>
					  <td><?php echo $at->amount; ?></td>
					  <td><?php echo $at->minimum_ot_hours; ?></td>
					  <td><a href="javascript:void(0);" class="btn btn-gray btn-action">EDIT</a> <a href="javascript:void(0);" class="btn btn-red btn-remove">REMOVE</a></td>
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

<div id="confirm-delete-dialog" class="jdialog"  title="Add more">
	<div class="inner_div">
		Are you sure you want to delete? 
	</div>
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
	
	// add overtime type
	jQuery("#add-more").click(function(){
		jQuery("#empty").hide();
		str = ''+
			'<tr>'+
							'<td><input style="width:115px;" class="txtfield overtime_type" name="overtime_type[]" type="text"></td>'+
							'<td><input style="width:115px;" class="txtfield pay_rate" name="pay_rate[]" type="text"></td>'+
							'<td><input style="width:115px;" class="txtfield ot_rate" name="ot_rate[]" type="text"></td>'+
							'<td><a href="#" class="btn btn-gray btn-action">EDIT</a> <a href="javascript:void(0);" class="btn btn-red btn-action btn-remove">REMOVE</a></td>'+
						'</tr>';
		jQuery(".ot_tbl tbody").append(str);
	});
	
	// remove overtime type
	jQuery(document).on("click",".btn-remove",function(){
		jQuery(this).parents("tr:first").remove();
		if(jQuery(".overtime_type").length==0){
			jQuery("#empty").show();
		}
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
							'<td><a href="#" class="btn btn-gray btn-action">EDIT</a> <a href="javascript:void(0);" class="btn btn-red btn-action btn-remove-at">REMOVE</a></td>'+
						'</tr>';
		jQuery(".at_tbl tbody").append(str);
	});
	
	// remove allowance type
	jQuery(document).on("click",".btn-remove-at",function(){
		jQuery(this).parents("tr:first").remove();
		if(jQuery(".allowance_type").length==0){
			jQuery("#empty-at").show();
		}
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
	
	jQuery("#oalh_yes").click(function(){
		jQuery("#leave_type").slideDown();
	});
	jQuery("#oalh_no").click(function(){
		jQuery("#leave_type").slideUp();
	});

});
</script>