<div class="main-content">
<div style="display:none;" class="highlight_message">Message</div>
        <!-- MAIN-CONTENT START -->
        <p>List down all your projects to track all your employees' timesheet, overtime and reports per projects.<br>
        Assign employees to this projects, if not applicable to your company use default project for all.</p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
			<table class="tbl">
				<tr>
				  <th style="width:125px;">Project</th>
				  <th style="width:250px">Description</th>
				  <th style="width:155px">Action</th>
				</tr>
				<?php
				if($proj_sql->num_rows()>0){
					foreach($proj_sql->result() as $proj){ ?>
					<tr>
					  <td><span class="proj"><?php echo $proj->project_name ?></span></td> 
					  <td><span class="desc"><?php echo $proj->project_description ?></span></td>
					  <td>
						<a href="javascript:void(0)" class="btn btn-gray btn-action btn-edit">EDIT</a>
						<a class="btn btn-red btn-action btn-delete" href="javascript:void(0);">DELETE</a>
						<input type="hidden" class="proj_id" value="<?php echo $proj->project_id; ?>" />
					  </td>
					</tr>
				<?php
					}
				}else{ ?>
					<tr>
					  <td colspan="3" id="empty">No projects yet</td>
					</tr>
				<?php
				}
				?>    
			</table>
          <!-- TBL-WRAP END -->
        </div>
        <a class="btn" href="javascript:void(0);" id="add-project" >ADD PROJECT</a>
		<a class="btn" id="save" style="display:none" href="javascript:void(0);" id="add-project" >SAVE</a>
        <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a href="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/department_and_positions" class="btn btn-gray left">BACK</a> <a href="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/locations" class="btn btn-gray right"> CONTINUE</a>
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
			Project:<br />
			<input type="text" id="edit_proj" name="edit_proj" class="txtfield" />
		</p>
		<p>
			Description:<br />
			<input type="text" id="edit_desc" name="edit_desc" class="txtfield" />
		</p>
	</div>
</div>

<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>


<script>
jQuery(document).ready(function(){

	// load highlight message script
	redirect_highlight_message();

	// add project
	jQuery("#add-project").click(function(){
		jQuery("#empty").hide();
		str = ''+
			'<tr>'+
				'<td><input type="text" name="project" class="txtfield project"></td>'+
				'<td><input type="text" name="description" class="txtfield description" /></td>'+
				'<td><a href="javascript:void(0);" class="btn btn-red btn-action btn-remove">REMOVE</a></td>'+
			'</tr>';
		jQuery("#save").show();
		jQuery(".tbl tbody").append(str);
	});
	
	// save project
	jQuery("#save").click(function(){
		var proj = new Array();
		jQuery(".project").each(function(index){
			proj[index] = jQuery(this).val();
		});
		var desc = new Array();
		jQuery(".description").each(function(index){
			desc[index] = jQuery(this).val();
		});
		var empty = false;
		jQuery(".project").each(function(){
			if(jQuery(this).val()==""){
				empty = true;
			}
		});
		if(empty==true){
			alert("Some project fields are empty");
		}else{
			if(proj.length>0){
				// ajax call
				jQuery.ajax({
					type: "POST",
					url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/projects/ajax_add_project",
					data: {
						proj: proj, 
						desc: desc,
						<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
					}
				}).done(function(ret){
						jQuery.cookie("msg", "New Project had been saved!");
						window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/projects";
				});
			}else{
				alert('Enter employment type');
			}
		}	
	});
	
	// remove project row
	jQuery(document).on("click",".btn-remove",function(){
		jQuery(this).parents("tr:first").remove();
		if(jQuery(".project").length==0){
			jQuery("#save").hide();
			jQuery("#empty").show();
		}
	});
	
	// delete project
	jQuery(".btn-delete").click(function(){
		var obj = jQuery(this);
		jQuery("#confirm-delete-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'yes': function() {
					var proj = obj.parents("tr").find(".proj_id").val();
					if(proj!=""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/projects/ajax_delete_project",
							data: {
								proj: proj,
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
								jQuery.cookie("msg", "A project has been deleted");
								window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/projects";
						});
					}else{
						alert('Project Id is missing');
					}					
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
		var proj_id = obj.parents("tr").find(".proj_id").val();
		var proj = obj.parents("tr").find(".proj").html();
		var desc = obj.parents("tr").find(".desc").html();
		jQuery("#edit_proj").val(proj);
		jQuery("#edit_desc").val(desc);
		jQuery("#project-details-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'update': function() {
					var proj = jQuery("#edit_proj").val();
					var desc = jQuery("#edit_desc").val();
					if(proj_id!=""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/projects/ajax_update_project",
							data: {
								proj_id: proj_id,
								proj: proj,
								desc: desc,
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
							jQuery.cookie("msg", "Project has been updated");
							window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/projects";
						});
					}else{
						alert('Location Id is missing');
					}			
				}
			}
		});
	});
	
	
});
</script>

