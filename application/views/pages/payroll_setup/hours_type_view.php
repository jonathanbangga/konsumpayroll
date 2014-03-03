<div class="main-content">
<div style="display:none;" class="highlight_message">Message</div>
        <!-- MAIN-CONTENT START -->
        <p>Listed here are the default hour type, you can change the rate if this doesn't apply in your company. </p>
        <p>You can add more hours type just specify the rate since this will be the basis in computing the premium of each hour type.</p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl">
            <tbody>
              <tr>
              	<th style="width:135px;">Default</th>
                <th style="width:135px;">Hour Type</th>
                <th style="width:135px">Pay Rate</th>
                <th style="width:160px">Action</th>
              </tr>
			  <?php
			  if($ht_sql->num_rows()>0){
				foreach($ht_sql->result() as $ht){ ?>
				
			 <tr>
			 	<td><input type="radio" class="hours_type_default_val" name="hours_type_default_val" attr_hours_type_id="<?php print $ht->hour_type_id;?>"></td>
                <td><span class="hours_type_span"><?php echo $ht->hour_type_name ?></span></td>
                <td><span class="pay_rate_span"><?php echo $ht->pay_rate ?>%</span></td>
                <td>
					<a href="javascript:void(0);" class="btn btn-gray btn-action btn-edit">EDIT</a> 
					<a href="javascript:void(0);" class="btn btn-red btn-action btn-delete">DELETE</a>
					<input type="hidden" class="hours_type_id" value="<?php echo $ht->hour_type_id; ?>" />
				</td>
              </tr>
				
				<?php
					}
				}else{
					echo '<tr><td id="empty" colspan="3">No Hours Type yet</td></tr>';
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
        <a class="btn btn-gray left" href="javascript:void(0);">BACK</a> <a class="btn btn-gray right" href="#"> CONTINUE</a>
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
			Hours Type:<br />
			<input class="txtfield" id="edit_hours_type" type="text">
		</p>
		<p>
			Pay Rate:<br />
			<input class="txtfield" id="edit_pay_rate" type="text">
		</p>
	</div>
</div> 
	  
<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>

<script>
jQuery(document).ready(function(){

	// load highlight message script
	redirect_highlight_message();

	// add hours type
	jQuery("#add-more").click(function(){
		jQuery("#empty").hide();
		str = ''+
			'<tr>'+
				'<td><input class="txtfield hours_type" type="text"></td>'+
				'<td><input class="txtfield pay_rate" type="text"></td>'+
				'<td>'+
					'<a href="javascript:void(0);" class="btn btn-red btn-action btn-remove">REMOVE</a>'+
				'</td>'+
			'</tr>';
		jQuery("#save").show();
		jQuery(".tbl tbody").append(str);
		jQuery( ".date" ).datepicker();
	});
	
	// remove hours type row
	jQuery(document).on("click",".btn-remove",function(){
		jQuery(this).parents("tr:first").remove();
		if(jQuery(".hours_type").length==0){
			jQuery("#save").hide();
			jQuery("#empty").show();
		}
	});
	
	// save hours type
	jQuery("#save").click(function(){
		var empty = false;
		var hours_type = new Array();
		jQuery(".hours_type").each(function(index){
			if(jQuery(this).val()==""){
				empty = true;
			}
			hours_type[index] = jQuery(this).val();
		});
		var pay_rate = new Array();
		jQuery(".pay_rate").each(function(index){
			pay_rate[index] = jQuery(this).val();
		});
		if(empty==true){
			alert("Some Holiday fields are empty");
		}else{
			// ajax call
			jQuery.ajax({
				type: "POST",
				url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/hours_type/ajax_add_hours_type",
				data: {
					hours_type: hours_type, 
					pay_rate: pay_rate,
					<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
				}
			}).done(function(ret){
				jQuery.cookie("msg", "New hours type had been saved!");
				window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/hours_type";
			});
		}	
	});
	
	// delete hours type
	jQuery(".btn-delete").click(function(){
		var obj = jQuery(this);
		jQuery("#confirm-delete-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'yes': function() {
					var hours_type_id = obj.parents("tr").find(".hours_type_id").val();
					// ajax call
					jQuery.ajax({
						type: "POST",
						url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/hours_type/ajax_delete_hours_type",
						data: {
							hours_type_id: hours_type_id,
							<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
						}
					}).done(function(ret){
						jQuery.cookie("msg", "Hours type has been deleted");
						window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/hours_type";
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
		var holiday_id = obj.parents("tr").find(".hours_type_id").val();
		var hour_type = obj.parents("tr").find(".hours_type_span").html();
		var pay_rate = obj.parents("tr").find(".pay_rate_span").html();
		jQuery("#edit_hours_type").val(hour_type);
		jQuery("#edit_pay_rate").val(pay_rate);
		jQuery("#project-details-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'update': function() {
					var hour_type = jQuery("#edit_hours_type").val();
					var pay_rate = jQuery("#edit_pay_rate").val();
					// ajax call
					jQuery.ajax({
						type: "POST",
						url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/hours_type/ajax_update_hours_type",
						data: {
							holiday_id: holiday_id,
							hour_type: hour_type,
							pay_rate: pay_rate,
							<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
						}
					}).done(function(ret){
						jQuery.cookie("msg", "Hours type has been updated");
						window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/hours_type";
					});	
				}
			}
		});
	});
	
});
</script>
