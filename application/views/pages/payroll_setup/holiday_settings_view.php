<div class="main-content">
<div style="display:none;" class="highlight_message">Message</div>
        <!-- MAIN-CONTENT START -->
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt<br>
          ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation </p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl">
            <tbody>
			  <tr>
				<th style="width:135px">Holiday</th>
				<th style="width:110px;">Type</th>
				<th style="width:110px">Date</th>
				<th style="width:160px">Action</th>
			  </tr>
			  <?php
			  if($hs_sql->num_rows()>0){
				foreach($hs_sql->result() as $hs){ ?>
				  <tr>
					<td><span class="holiday_span"><?php echo $hs->holiday_name; ?></span></td>
					<td><span class="type_span"><?php echo $hs->type; ?></span></td>
					<td><span class="date_span"><?php echo $hs->date; ?></span></td>
					<td>
						<a href="javascript:void(0);" class="btn btn-gray btn-action btn-edit">EDIT</a> 
						<a href="javascript:void(0);" class="btn btn-red btn-action btn-delete">DELETE</a>
						<input type="hidden" class="holiday_id" value="<?php echo $hs->holiday_id; ?>" />
					</td>
				  </tr>
			  <?php
				}
			  }else{
				echo '<tr><td colspan="4" id="empty">No earnings yet</td></tr>';
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
			Holiday:<br />
			<input class="txtfield" id="edit_holiday" type="text">
		</p>
		<p>
			Type:<br />
			<select class="txtselect" id="edit_type">
				<option value="-1">Select</option>
				<option value="Regular">Regular</option>
				<option value="Special">Special</option>
			</select>
		</p>
		<p>
			Date:<br />
			<input class="txtfield" id="edit_date" type="text">
		</p>
	</div>
</div>
	  
<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>

<script>
jQuery(document).ready(function(){
	// load highlight message script
	redirect_highlight_message();
	
	// add holiday
	jQuery("#add-more").click(function(){
		jQuery("#empty").hide();
		str = ''+
			'<tr>'+
				'<td><input class="txtfield holiday" type="text"></td>'+
				'<td>'+
					'<select class="txtselect type">'+
						'<option value="-1">Select</option>'+
						'<option value="Regular">Regular</option>'+
						'<option value="Special">Special</option>'+
					'</select>'+
				'<td><input class="txtfield date" type="text"></td>'+
				'</td>'+
				'<td>'+
					'<a href="javascript:void(0);" class="btn btn-gray btn-action">EDIT</a>'+ 
					'<a href="javascript:void(0);" class="btn btn-red btn-action btn-remove">REMOVE</a>'+
				'</td>'+
			'</tr>';
		jQuery("#save").show();
		jQuery(".tbl tbody").append(str);
	});
	
	// remove holiday row
	jQuery(document).on("click",".btn-remove",function(){
		jQuery(this).parents("tr:first").remove();
		if(jQuery(".holiday").length==0){
			jQuery("#save").hide();
			jQuery("#empty").show();
		}
	});
	
	// save holiday
	jQuery("#save").click(function(){
		var empty = false;
		var holiday = new Array();
		jQuery(".holiday").each(function(index){
			if(jQuery(this).val()==""){
				empty = true;
			}
			holiday[index] = jQuery(this).val();
		});
		var type = new Array();
		jQuery(".type").each(function(index){
			type[index] = jQuery(this).val();
		});
		var date = new Array();
		jQuery(".date").each(function(index){
			date[index] = jQuery(this).val();
		});
		if(empty==true){
			alert("Some Holiday fields are empty");
		}else{
			// ajax call
			jQuery.ajax({
				type: "POST",
				url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/holiday_settings/ajax_add_holiday_settings",
				data: {
					holiday: holiday, 
					type: type,
					date: date,
					<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
				}
			}).done(function(ret){
				jQuery.cookie("msg", "New holiday had been saved!");
				window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/holiday_settings";
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
					var holiday_id = obj.parents("tr").find(".holiday_id").val();
					// ajax call
					jQuery.ajax({
						type: "POST",
						url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/holiday_settings/ajax_delete_holiday_settings",
						data: {
							holiday_id: holiday_id,
							<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
						}
					}).done(function(ret){
						jQuery.cookie("msg", "Holiday has been deleted");
						window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/holiday_settings";
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
		var holiday_id = obj.parents("tr").find(".holiday_id").val();
		var holiday = obj.parents("tr").find(".holiday_span").html();
		var type = obj.parents("tr").find(".type_span").html();
		var date = obj.parents("tr").find(".date_span").html();
		jQuery("#edit_holiday").val(holiday);
		jQuery("#edit_type option").each(function(){
			if(jQuery(this).val()==type){
				jQuery(this).prop("selected",true);
			}
		});
		jQuery("#edit_date").val(date);
		jQuery("#project-details-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'update': function() {
					var holiday = jQuery("#edit_holiday").val();
					var type = jQuery("#edit_type").val();
					var date = jQuery("#edit_date").val();
					// ajax call
					jQuery.ajax({
						type: "POST",
						url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/holiday_settings/ajax_update_holiday_settings",
						data: {
							holiday_id: holiday_id,
							holiday: holiday,
							type: type,
							date: date,
							<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
						}
					}).done(function(ret){
						jQuery.cookie("msg", "Holiday has been updated");
						window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/holiday_settings";
					});	
				}
			}
		});
	});
	
});
</script>