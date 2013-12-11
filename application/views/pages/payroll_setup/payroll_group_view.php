 <div class="main-content">
 <div style="display:none;" class="highlight_message">Message</div>
        <!-- MAIN-CONTENT START -->
        <p>Payroll group is important in creating payroll. You need to group your employees according to their shift, 
		workday, hours type, pay rate type and or different rest days.</p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl">
            <tbody>
              <tr>
                <th style="width:135px;">Payroll Group</th>
                <th style="width:135px">Period Type</th>
				<th style="width:135px">Pay Rate Type</th>
                <th style="width:160px">Action</th>
              </tr>
			  <?php
			  if($pg_sql->num_rows()>0){
				foreach($pg_sql->result() as $pg){ ?>
				<tr>
					<td>
						<span class="payroll_group_span"><?php echo $pg->name ?></span>
					</td>
					<td>
						<span class="period_type_span"><?php echo $pg->period_type ?></span>
					</td>
					<td>
						<span class="pay_rate_type_span"><?php echo $pg->pay_rate_type ?></span>
					</td>
					<td>
						<a href="javascript:void(0);" class="btn btn-gray btn-action btn-edit">EDIT</a> 
						<a href="javascript:void(0);" class="btn btn-red btn-action btn-delete">DELETE</a>
						<input type="hidden" class="pg_id" value="<?php echo $pg->payroll_group_setup_id; ?>" />
					</td>
				</tr>
			  <?php
					}
				}else{ 
					echo '<tr><td id="empty" colspan="4">No Hours Type yet</td></tr>';
				}
			  ?>
              
			  
            </tbody>
          </table>
          <!-- TBL-WRAP END -->
        </div>
        <a href="javascript:void(0);" class="btn" id="add-more">ADD MORE</a>
		<a href="javascript:void(0);" class="btn" id="save" style="display:none">SAVE</a>
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

<div id="project-details-dialog" class="jdialog"  title="Edit">
	<div class="inner_div">
		<p>
			Payroll Group:<br />
			<input class="txtfield" id="edit_payroll_group" type="text">
		</p>
		<p>
			Period Type:<br />
			<select name="" class="txtselect" id="edit_period_type">
				<option value="-1">Select</option>
				<option selected="selected" value="Daily">Daily</option>
				<option value="Weekly">Weekly</option>
				<option value="Monthly">Monthly</option> 
				<option value="Semi Monthly">Semi Monthly</option> 
			</select>
		</p>
		<p>
			Pay Rate Type:<br />
			<select name="" class="txtselect" id="edit_pay_rate_type">
				<option value="-1">Select</option>
				<option value="By Day">By Day</option>
				<option value="By Hour">By Hour</option>
				<option value="By Month">By Month</option>
				<option value="By Half Month">By Half Month</option>
				<option value="By Week">By Week</option>
				<option value="By Units Produced">By Units Produced</option>
				<option selected="selected" value="By Sales Amount">By Sales Amount</option>
			</select>
		</p>
	</div>
</div> 
	  
	  
<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>

<script>
jQuery(document).ready(function(){

	// load highlight message script
	redirect_highlight_message();

	// add payroll group
	jQuery("#add-more").click(function(){
		jQuery("#empty").hide();
		str = ''+
			'<tr>'+
                '<td><input style="width:115px;" class="txtfield payroll_group" name="" type="text"></td>'+
                '<td>'+
					'<select style="width:115px;" class="txtselect period_type" name="">'+
						'<option value="-1">Select</option>'+
						'<option value="Daily">Daily</option>'+
						'<option value="Weekly">Weekly</option>'+
						'<option value="Monthly">Monthly</option>'+ 
						'<option value="Semi Monthly">Semi Monthly</option>'+ 
					'</select>'+
				'</td>'+
				'<td>'+
					'<select style="width:115px;" class="txtselect pay_rate_type" name="">'+
						'<option value="-1">Select</option>'+
						'<option value="By Day">By Day</option>'+
						'<option value="By Hour">By Hour</option>'+
						'<option value="By Month">By Month</option>'+
						'<option value="By Half Month">By Half Month</option>'+
						'<option value="By Week">By Week</option>'+
						'<option value="By Units Produced">By Units Produced</option>'+
						'<option value="By Sales Amount">By Sales Amount</option>'+
					'</select>'+
				'</td>'+
                '<td>'+
					'<a href="javascript:void(0);" class="btn btn-red btn-action btn-remove">REMOVE</a>'+
				'</td>'+
			'</tr>';
		jQuery("#save").show();
		jQuery(".tbl tbody").append(str);
		jQuery( ".date" ).datepicker();
	});
	
	// remove payroll group row
	jQuery(document).on("click",".btn-remove",function(){
		jQuery(this).parents("tr:first").remove();
		if(jQuery(".payroll_group").length==0){
			jQuery("#save").hide();
			jQuery("#empty").show();
		}
	});
	
	// save payroll group
	jQuery("#save").click(function(){
		var empty = false;
		var payroll_group = new Array();
		jQuery(".payroll_group").each(function(index){
			if(jQuery(this).val()==""){
				empty = true;
			}
			payroll_group[index] = jQuery(this).val();
		});
		var period_type = new Array();
		jQuery(".period_type").each(function(index){
			period_type[index] = jQuery(this).val();
		});
		var pay_rate_type = new Array();
		jQuery(".pay_rate_type").each(function(index){
			pay_rate_type[index] = jQuery(this).val();
		});
		if(empty==true){
			alert("Some Payroll Groups are empty");
		}else{
			// ajax call
			jQuery.ajax({
				type: "POST",
				url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/payroll_group/ajax_add_payroll_group_setup",
				data: {
					payroll_group: payroll_group, 
					period_type: period_type,
					pay_rate_type: pay_rate_type,
					<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
				}
			}).done(function(ret){
				jQuery.cookie("msg", "New Payroll Group had been saved!");
				window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/payroll_group";
			});
		}	
	});
	
	// delete payroll group
	jQuery(".btn-delete").click(function(){
		var obj = jQuery(this);
		jQuery("#confirm-delete-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'yes': function() {
					var pg_id = obj.parents("tr").find(".pg_id").val();
					// ajax call
					jQuery.ajax({
						type: "POST",
						url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/payroll_group/ajax_delete_payroll_group_setup",
						data: {
							pg_id: pg_id,
							<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
						}
					}).done(function(ret){
						jQuery.cookie("msg", "Payroll Group has been deleted");
						window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/payroll_group";
					});				
				},
				'no': function() {
					jQuery(this).dialog( 'close' );					
				}
			}
		});
	});
	
	// edit payroll group
	jQuery(".btn-edit").click(function(){
		var obj = jQuery(this);
		var pg_id = obj.parents("tr").find(".pg_id").val();
		var payroll_group = obj.parents("tr").find(".payroll_group_span").html();
		var period_type = obj.parents("tr").find(".period_type_span").html();
		var pay_rate_type = obj.parents("tr").find(".pay_rate_type_span").html();
		jQuery("#edit_payroll_group").val(payroll_group);
		jQuery("#edit_period_type option").each(function(){
			if(jQuery(this).val()==period_type){
				jQuery(this).prop("selected",true);
			}
		});
		jQuery("#edit_pay_rate_type option").each(function(){
			if(jQuery(this).val()==pay_rate_type){
				jQuery(this).prop("selected",true);
			}
		});
		jQuery("#project-details-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'update': function() {
					var payroll_group = jQuery("#edit_payroll_group").val();
					var period_type = jQuery("#edit_period_type").val();
					var pay_rate_type = jQuery("#edit_pay_rate_type").val();
					// ajax call
					jQuery.ajax({
						type: "POST",
						url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/payroll_group/ajax_update_payroll_group_setup",
						data: {
							pg_id: pg_id,
							payroll_group: payroll_group,
							period_type: period_type,
							pay_rate_type: pay_rate_type,
							<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
						}
					}).done(function(ret){
						jQuery.cookie("msg", "Payroll Group has been updated");
						window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/payroll_group";
					});	
				}
			}
		});
	});
	
});
</script>