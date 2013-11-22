<div style="display:none;" class="highlight_message">Message</div>
<!-- RBOX START -->
      <div class="main-content">
        <!-- MAIN-CONTENT START -->
        <p>Lorem Ipsum Bungot Unsa Ibutang Diri</p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl" style="width:2155px;">
            <tr>
              <th style="width:115px;">Leave Type</th>
              <th style="width:115px;">Payable</th>
              <th style="width:163px;">Required Documents</th>
              <th style="width:214px;">Include in actual hours worked</th>
              <th style="width:238px;">Leaves used to deduct no. of work </th>
              <th style="width:134px;">Leave Accrued</th>
              <th style="width:85px;">Period</th>
              <th style="width:96px;">Position</th>
              <th style="width:133px;">Years of Service</th>
              <th style="width:122px;">Unused Leave</th>
              <th style="width:210px;">Unused Leave Upon Termination</th>
              <th style="width:137px;">Max Days of Leave</th>
			  <th style="width:137px;">Action</th>
            </tr>
			<?php
			if($leaves_sql->num_rows()>0){
				foreach($leaves_sql->result() as $leave){ ?>
					<tr>
					  <td><?php echo $leave->leave_type; ?></td>
					  <td><?php echo ($leave->payable==1)?"yes":"no"; ?></td>
					  <td><?php echo $leave->required_documents; ?></td>
					  <td><?php echo ($leave->include_in_actual_hours_worked==1)?"yes":"no"; ?></td>
					  <td><?php echo ($leave->leaves_used_to_deduct_no_of_work==1)?"yes":"no"; ?></td>
					  <td><?php echo $leave->leave_accrued; ?></td>
					  <td><?php echo $leave->period; ?></td>
					  <td><?php echo $leave->position_name; ?></td>
					  <td><?php echo $leave->years_of_service; ?></td>
					  <td><?php echo $leave->unused_leave; ?></td>
					  <td><?php echo $leave->unused_leave_upon_termination; ?></td>
					  <td><?php echo $leave->max_days_of_leave; ?></td>
					  <td>
						<a href="javascript:void(0)" class="btn btn-red btn-action btn-delete">DELETE</a>
						<input type="hidden" class="leaves_id" value="<?php echo $leave->leaves_id; ?>" />
					</td>
					</tr>
			<?php
				}
			}else{
				echo '<tr><td id="empty" colspan="12">No leaves yet</td></tr>';
			}
			?>
            
          </table>
          <!-- TBL-WRAP END -->
        </div>
		

        <a class="btn" href="javascript:void(0);" id="add-more">ADD MORE</a>
		<a class="btn" id="save" style="display:none;" href="javascript:void(0);">SAVE</a>
		
			<ul class="leaves_ul" style="list-style-type: none;">
			<li>Define number of hours in a leave day <input type="text" /></li>
			<li>Specify default number of work days for the month <input type="text" /></li>
		<ul>
        <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray left" href="/company/hr_setup/job_grade">BACK</a> 
        <!-- FOOTER-GRP-BTN END -->
      </div>
      <!-- RBOX END -->
	  
<div id="confirm-delete-dialog" class="jdialog"  title="Add more">
	<div class="inner_div">
		Are you sure you want to delete?: 
	</div>
</div>
	  
<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>

<style>
.leaves_ul{
	list-style-type: none;
}
.leaves_ul li{
	margin: 11px;
}
.leaves_ul li input[type='text']{
	width: 30px;
	margin-left: 10px;
}
</style>

<script>
jQuery(document).ready(function(){

	// load highlight message script
	redirect_highlight_message();

	jQuery("#add-more").click(function(){
		jQuery("#empty").hide();
		var obj = jQuery(this);
		var str = ''+
		'<tr>'+
			'<td>'+
				'<input type="text" name="leave_type" class="leave_type">'+
			'</td>'+
			'<td>'+
				'<select name="select" class="txtselect select-medium payable" name="payable">'+
					'<option value="0">No</option>'+
					'<option value="1">Yes</option>'+
				'</select>'+
			'</td>'+
			'<td>'+
				'<input type="text" name="req_doc" class="txtfield req_doc">'+
			'</td>'+
			'<td>'+
				'<input type="checkbox" name="act_hours_worked" class="act_hours_worked" value="1">'+
			'</td>'+
			'<td>'+
				'<input type="checkbox" name="deduct_num_work" class="deduct_num_work" value="1">'+
			'</td>'+
			'<td>'+
				'<input type="text" name="leave_type" class="accrued">'+
			'</td>'+
			'<td>'+
				'<select name="select" class="txtselect select-medium period" name="period">'+
					'<option value="">select period</option>'+
					'<option value="monthly">monthly</option>'+
					'<option value="quarterly">quarterly</option>'+
					'<option value="yearly">yearly</option>'+
				'</select>'+
			'</td>'+
			'<td>'+
				'<select name="select" class="txtselect select-medium position" class="position">'+
						'<option>select position</option>'+
						'<?php foreach($pos_sql->result() as $pos){
							echo '<option value="'.$pos->position_id.'">'.$pos->position_name.'</option>';
						} ?>'+
				'</select>'+
			'</td>'+
			'<td>'+
				'<select name="select" class="txtselect select-medium years_of_service" class="years_of_service">'+
						'<option value="">select years of service</option>'+
						'<option value="below 3 months">below 3 months</option>'+
						'<option value="above 3 months">above 3 months</option>'+
						'<option value="below 6 months">below 6 months</option>'+
						'<option value="above 6 months">above 6 months</option>'+
						'<option value="below 1 year">below 1 year</option>'+
						'<option value="1 year">1 year</option>'+
						'<option value="2 year">2 year</option>'+
						'<option value="3 year">3 year</option>'+
						'<option value="4 year">4 year</option>'+
						'<option value="5 year">5 year</option>'+
						'<option value="above 5 years">above 5 years</option>'+
					'</select>'+
			'</td>'+
			'<td>'+
				'<select name="select" class="txtselect select-medium unused_leave" class="unused_leave">'+
					'<option value="">select</option>'+
					'<option value="convert to cash">convert to cash</option>'+
					'<option value="accrue to next year">accrue to next year</option>'+
				'</select>'+
			'</td>'+
			'<td>'+
				'<select name="select" class="txtselect select-medium unused_leave_termin" class="unused_leave_termin">'+
					'<option value="">select</option>'+
					'<option value="convert to cash">convert to cash</option>'+
					'<option value="accrue to next year">accrue to next year</option>'+
				'</select>'+
			'</td>'+
			'<td>'+
				'<input type="text" name="max_day_leave" class="max_day_leave">'+
			'</td>'+
			'<td>'+
				'<a href="javascript:void(0);" class="btn btn-red btn-action btn-remove">REMOVE</a>'+
			'</td>'+
		'</tr>';
		jQuery("#save").show();
		jQuery(".tbl tbody").append(str)
	});
	
	// save
	jQuery("#save").click(function(){		
		var empty_lt = false;
		var lt = new Array();
		jQuery(".leave_type").each(function(index){
			if(jQuery(this).val()==""){
				empty_lt = true;
			}
			lt[index] = jQuery(this).val();
		});
		var payable = new Array();
		jQuery(".payable").each(function(index){
			payable[index] = jQuery(this).val();
		});
		var req_doc = new Array();
		jQuery(".req_doc").each(function(index){
			req_doc[index] = jQuery(this).val();
		});
		var act_hours_worked = new Array();
		jQuery(".act_hours_worked").each(function(index){
			act_hours_worked[index] = (jQuery(this).prop("checked")==true)?1:0;
		});
		var deduct_num_work = new Array();
		jQuery(".deduct_num_work").each(function(index){
			deduct_num_work[index] = (jQuery(this).prop("checked")==true)?1:0;
		});
		var accrued = new Array();
		jQuery(".accrued").each(function(index){
			accrued[index] = jQuery(this).val();
		});
		var period = new Array();
		jQuery(".period").each(function(index){
			period[index] = jQuery(this).val();
		});
		var position = new Array();
		jQuery(".position").each(function(index){
			position[index] = jQuery(this).val();
		});
		var years_of_service = new Array();
		jQuery(".years_of_service").each(function(index){
			years_of_service[index] = jQuery(this).val();
		});
		var unused_leave = new Array();
		jQuery(".unused_leave").each(function(index){
			unused_leave[index] = jQuery(this).val();
		});
		var unused_leave_termin = new Array();
		jQuery(".unused_leave_termin").each(function(index){
			unused_leave_termin[index] = jQuery(this).val();
		});
		var max_day_leave = new Array();
		jQuery(".max_day_leave").each(function(index){
			max_day_leave[index] = jQuery(this).val();
		});
		var error = "";
		error += (empty_lt==true)?"Some job grade are left empty<br />":"";

		if(error==""){
			// ajax call
			jQuery.ajax({
				type: "POST",
				url: "/company/hr_setup/leaves/ajax_add_leaves",
				data: {
					lt: lt,
					payable: payable,
					req_doc: req_doc,
					act_hours_worked: act_hours_worked,
					deduct_num_work: deduct_num_work,
					accrued: accrued,
					period: period,
					position: position,
					years_of_service: years_of_service,
					unused_leave: unused_leave,
					unused_leave_termin: unused_leave_termin,
					max_day_leave: max_day_leave,
					<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
				}
			}).done(function(ret){
				jQuery.cookie("msg", "Leave has been saved");
				window.location="/company/hr_setup/leaves";
			});
		}else{
			alert(error);
		}
	});
	
	// delete leaves
	jQuery(".btn-delete").click(function(){
		var obj = jQuery(this);
		jQuery("#confirm-delete-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'yes': function() {
					var leaves_id = obj.parents("tr").find(".leaves_id").val();
					if(leaves_id!=""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/company/hr_setup/leaves/ajax_delete_leaves",
							data: {
								leaves_id: leaves_id,
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
							jQuery.cookie("msg", "Job grade has been deleted");
							window.location="/company/hr_setup/leaves";
						});
					}else{
						alert('leaves Id is missing');
					}					
				},
				'no': function() {
					jQuery(this).dialog( 'close' );					
				}
			}
		});
	});
	
	// remove leaves row
	jQuery(document).on("click",".btn-remove",function(){
		jQuery(this).parents("tr:first").remove();
		if(jQuery(".leave_type").length==0){
			jQuery("#save").hide();
			jQuery("#empty").show();
		}
	});
	
});
</script>