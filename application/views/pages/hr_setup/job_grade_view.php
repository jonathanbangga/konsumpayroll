<div style="display:none;" class="highlight_message">Message</div>
 <!-- RBOX START -->
     <div class="main-content">
       <!-- MAIN-CONTENT START -->
     <p>Add all your levels for approvers. This is used for leave approval/entitlement. </p>
      <div class="tbl-wrap">
      <!-- TBL-WRAP START -->
	
		<table class="tbl">
          <tr>
            <th style="width:65px">Job Grade</th>
            <th style="width:276px">Description</th>
            <th style="width:90">Action</th>
          </tr>
		  <?php
		  if($jg_sql->num_rows()>0){
			foreach($jg_sql->result() as $jg){ ?>
			<tr>
				<td><?php echo $jg->job_grade; ?></td>
				<td><?php echo $jg->description; ?></td>
				<td>
					<a class="btn btn-red btn-action btn-delete" href="javascript:void(0);">DELETE</a>
					<input type="hidden" class="job_grade_id" value="<?php echo $jg->job_grade_id; ?>" />
				</td>
			</tr>
		  <?php
			}
		  }else{ ?>
				<tr>
				  <td colspan="4" id="empty">No Ranks yet</td>
				</tr>
		  <?php
		  }
		  ?>
        </table>
	
          <!-- TBL-WRAP END -->
      </div>
      <a class="btn" href="javascript:void(0);" id="add-more">ADD MORE</a>
	  <a class="btn" id="save" style="display:none;" href="javascript:void(0);">SAVE</a>
      <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
      <a class="btn btn-gray left" href="/company/hr_setup/locations">BACK</a> <a class="btn btn-gray right" href="/company/hr_setup/leaves"> CONTINUE</a>
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
				'<input type="text" name="job_grade" class="job_grade">'+
			'</td>'+
			'<td>'+
				'<input type="text" name="description" class="description">'+
			'</td>'+
			'<td>'+
				'<a href="javascript:void(0)" class="btn btn-red btn-action btn-remove">REMOVE</a>'+
			'</td>'+
		'</tr>';
		jQuery("#save").show();
		jQuery(".tbl tbody").append(str)
	});
	
	jQuery("#save").click(function(){		
		var empty_jg = false;
		var jg = new Array();
		jQuery(".job_grade").each(function(index){
			if(jQuery(this).val()==""){
				empty_jg = true;
			}
			jg[index] = jQuery(this).val();
		});
		var desc = new Array();
		jQuery(".description").each(function(index){
			desc[index] = jQuery(this).val();
		});
		var error = "";
		error += (empty_jg==true)?"Some job grade are left empty<br />":"";

		if(error==""){
			// ajax call
			jQuery.ajax({
				type: "POST",
				url: "/company/hr_setup/job_grade/ajax_add_job_grade",
				data: {
					jg: jg,
					desc: desc,
					<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
				}
			}).done(function(ret){
				jQuery.cookie("msg", "Job Grade has been saved");
				window.location="/company/hr_setup/job_grade";
			});
		}else{
			alert(error);
		}
	});
	
	// delete ranks
	jQuery(".btn-delete").click(function(){
		var obj = jQuery(this);
		jQuery("#confirm-delete-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'yes': function() {
					var jg_id = obj.parents("tr").find(".job_grade_id").val();
					if(jg_id!=""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/company/hr_setup/job_grade/ajax_delete_job_grade",
							data: {
								jg_id: jg_id,
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
							jQuery.cookie("msg", "Job grade has been deleted");
							window.location="/company/hr_setup/job_grade";
						});
					}else{
						alert('Job grade Id is missing');
					}					
				},
				'no': function() {
					jQuery(this).dialog( 'close' );					
				}
			}
		});
	});
	
	// remove rank row
	jQuery(document).on("click",".btn-remove",function(){
		jQuery(this).parents("tr:first").remove();
		if(jQuery(".job_grade").length==0){
			jQuery("#save").hide();
			jQuery("#empty").show();
		}
	});

});
</script>