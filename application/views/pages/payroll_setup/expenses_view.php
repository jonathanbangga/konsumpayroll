<div class="main-content">
<div style="display:none;" class="highlight_message">Message</div>
        <!-- MAIN-CONTENT START -->
        <p>Payroll group is important in creating payroll. You need to group your employees according to their shift,<br>
        workday, hours type, pay rate type and or different rest days.</p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl">
            <tbody>
              <tr>
                <th style="width:135px;">Expense Type</th>
                <th style="width:135px">Minimum Amount</th>
                <th style="width:135px;">Maximum Amount</th>
                <th style="width:135px">Require Receipt</th>
                <th style="width:160px">Action</th>
              </tr>
			  <?php 
			  if($e_sql->num_rows()>0){
				foreach($e_sql->result() as $e){ ?>
				<tr>
					<td><span class="expense_type_span"><?php echo $e->expense_type_name; ?></span></td>
					<td><span class="min_amount_span"><?php echo $e->minimum_amount; ?></span></td>
					<td><span class="max_amount_span"><?php echo $e->maximum_amount; ?></span></td>
					<td><span class="req_receipt" style="display:none;"><?php echo $e->require_receipt; ?></span><?php echo ($e->require_receipt==1)?"yes":"no"; ?></td>
					<td>
						<a href="javascript:void(0);" class="btn btn-gray btn-action btn-edit">EDIT</a> 
						<a href="javascript:void(0);" class="btn btn-red btn-action btn-delete">DELETE</a>
						<input type="hidden" class="expense_type_id" value="<?php echo $e->expense_type_id; ?>" />
					</td>
				</tr>
			  <?php
					}
				}else{
					echo '<tr><td colspan="5" id="empty">No earnings yet</td></tr>';
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

<div id="project-details-dialog" class="jdialog"  title="Edit Project">
	<div class="inner_div">
		<p>
			Expense Type:<br />
			<input class="txtfield" id="edit_expense_type" type="text">
		</p>
		<p>
			Minimum Amount:<br />
			<input class="txtfield" id="edit_min_amount" type="text">
		</p>
		<p>
			Maximum Amount:<br />
			<input class="txtfield" id="edit_max_amount" type="text">
		</p>
		<p>
			<select class="txtselect" id="edit_req_receipt">
				<option value="-1">Select</option>
				<option value="1">Yes</option>
				<option value="0">No</option>
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
	
	// invoke datepicker
	jQuery( ".date" ).datepicker();
	
	// add holiday
	jQuery("#add-more").click(function(){
		jQuery("#empty").hide();
		str = ''+
			'<tr>'+
				'<td><input style="width:115px;" class="txtfield expense_type" name="" type="text"></td>'+
				'<td><input style="width:115px;" class="txtfield min_amount" name="" type="text"></td>'+
				'<td><input style="width:115px;" class="txtfield max_amount" name="" type="text"></td>'+
				'<td>'+
					'<select class="txtselect req_receipt" name="">'+
						'<option value="-1">Select</option>'+
						'<option value="1">Yes</option>'+
						'<option value="0">No</option>'+
					'</select>'+
				'</td>'+
				'<td><a href="javascript:void(0);" class="btn btn-red btn-action btn-remove">REMOVE</a></td>'+
             '</tr>';
		jQuery("#save").show();
		jQuery(".tbl tbody").append(str);
		jQuery( ".date" ).datepicker();
	});
	
	// remove holiday row
	jQuery(document).on("click",".btn-remove",function(){
		jQuery(this).parents("tr:first").remove();
		if(jQuery(".expense_type").length==0){
			jQuery("#save").hide();
			jQuery("#empty").show();
		}
	});
	
	// save holiday
	jQuery("#save").click(function(){
		var empty = false;
		var expense_type = new Array();
		jQuery(".expense_type").each(function(index){
			if(jQuery(this).val()==""){
				empty = true;
			}
			expense_type[index] = jQuery(this).val();
		});
		var min_amount = new Array();
		jQuery(".min_amount").each(function(index){
			min_amount[index] = jQuery(this).val();
		});
		var max_amount = new Array();
		jQuery(".max_amount").each(function(index){
			max_amount[index] = jQuery(this).val();
		});
		var req_receipt = new Array();
		jQuery(".req_receipt").each(function(index){
			req_receipt[index] = jQuery(this).val();
		});
		if(empty==true){
			alert("Some Holiday fields are empty");
		}else{
			// ajax call
			jQuery.ajax({
				type: "POST",
				url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/expenses/ajax_add_expense_type",
				data: {
					expense_type: expense_type, 
					min_amount: min_amount,
					max_amount: max_amount,
					req_receipt: req_receipt,
					<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
				}
			}).done(function(ret){
				jQuery.cookie("msg", "New Expenses had been saved!");
				window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/expenses";
			});
		}	
	});
	
	// delete holiday
	jQuery(".btn-delete").click(function(){
		var obj = jQuery(this);
		jQuery("#confirm-delete-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'yes': function() {
					var expense_type_id = obj.parents("tr").find(".expense_type_id").val();
					// ajax call
					jQuery.ajax({
						type: "POST",
						url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/expenses/ajax_delete_expense_type",
						data: {
							expense_type_id: expense_type_id,
							<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
						}
					}).done(function(ret){
						jQuery.cookie("msg", "Expenses has been deleted");
						window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/expenses";
					});				
				},
				'no': function() {
					jQuery(this).dialog( 'close' );					
				}
			}
		});
	});
	
	// edit project
	jQuery(".btn-edit").click(function(){
		var obj = jQuery(this);
		var expense_type_id = obj.parents("tr").find(".expense_type_id").val();
		var expense_type = obj.parents("tr").find(".expense_type_span").html();
		var minimum_amount = obj.parents("tr").find(".min_amount_span").html();
		var maximum_amount = obj.parents("tr").find(".max_amount_span").html();
		var req_receipt = obj.parents("tr").find(".req_receipt").html();
		jQuery("#edit_expense_type").val(expense_type);
		jQuery("#edit_min_amount").val(minimum_amount);
		jQuery("#edit_max_amount").val(maximum_amount);
		jQuery("#edit_req_receipt").val(req_receipt);
		jQuery("#req_receipt option").each(function(){
			if(jQuery(this).val()==req_receipt){
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
					var expense_type = jQuery("#edit_expense_type").val();
					var minimum_amount = jQuery("#edit_min_amount").val();
					var maximum_amount = jQuery("#edit_max_amount").val();
					var req_receipt = jQuery("#edit_req_receipt").val();
					// ajax call
					jQuery.ajax({
						type: "POST",
						url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/expenses/ajax_update_expense_type",
						data: {
							expense_type_id: expense_type_id,
							expense_type: expense_type,
							minimum_amount: minimum_amount,
							maximum_amount: maximum_amount,
							req_receipt: req_receipt,
							<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
						}
					}).done(function(ret){
						jQuery.cookie("msg", "Expenses has been updated");
						window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/expenses";
					});	
				}
			}
		});
	});
	
});
</script>