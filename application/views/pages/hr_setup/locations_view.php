<div style="display:none;" class="highlight_message">Message</div>
<div class="main-content">
        <!-- MAIN-CONTENT START -->
        <p>Add all project locations to be able to create reports per locations. You would also be able to<br>
        create mulitple locations.</p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
	
			<table class="tbl">
				<tr>
				  <th style="width:125px;">Project</th>
				  <th style="width:153px">Location</th>
				  <th style="width:250px">Description</th>
				  <th style="width:153px">Action</th>
				</tr>
				<?php
				if($locations->num_rows()>0){
					foreach($locations->result() as $row){ ?>
					 <tr>
					  <td><?php echo $row->project_name; ?></td>
					  <td><span class="loc"><?php echo $row->location; ?></span></td>
					  <td><span class="desc"><?php echo $row->description; ?></span></td>
					  <td>
					  <a class="btn btn-gray btn-action btn-edit" href="javascript:void(0)">EDIT</a> <a class="btn btn-red btn-action btn-delete" href="javascript:void(0)">DELETE</a>.
					  <input type="hidden" class="loc_id" value="<?php echo $row->location_id; ?>" />
					  <input type="hidden" class="proj_id" value="<?php echo $row->project_id; ?>" />
					  </td>
					</tr>
				<?php
					}
				}else{ ?>
					<tr>
					  <td colspan="4" id="empty">No project locations yet</td>
					</tr>
				<?php
				}
				?>
          </table>
	
          <!-- TBL-WRAP END -->
        </div>
        <a class="btn" href="javascript:void(0);" id="add-more">ADD MORE</a>
		<a href="javascript:void(0);" style="display:none;" id="save" class="btn">SAVE</a>
        <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a href="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/projects" class="btn btn-gray left">BACK</a> <a href="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/job_grade" class="btn btn-gray right"> CONTINUE</a>
        <!-- FOOTER-GRP-BTN END -->
      </div>
	  
<div id="add-more-dialog" class="jdialog"  title="Add more">
	<div class="inner_div">
		<p>
			Project:<br /> 
			<?php
			if($sql_proj->num_rows()>0){ ?>
				<select id="project" class="txtselect">
					<option value="0">Select Project</option>
					<?php
					foreach($sql_proj->result() as $proj){ ?>
					<option value="<?php echo $proj->project_id; ?>"><?php echo $proj->project_name; ?></option>
					<?php
					}
					?>
				</select>
			<?php
			}else{
				echo "No projects yet";
			}
			?>
			
		</p>
		<p>
			Location:<br /> 
			<input type="text" id="location" name="location" class="txtfield" />
		</p>
		<p>
			Description:<br /> 
			<input type="text" id="description" name="description" class="txtfield" />
		</p>
	</div>
</div>

<div id="confirm-delete-dialog" class="jdialog"  title="Add more">
	<div class="inner_div">
		Are you sure you want to delete?: 
	</div>
</div>

<div id="location-details-dialog" class="jdialog"  title="Add more">
	<div class="inner_div">
		<p>
			Project:<br />
			<select id="edit_proj" class="txtselect">
			<option value="-1">select project</option>
			<?php
				foreach($sql_proj->result() as $proj){ ?>
					<option value="<?php echo $proj->project_id; ?>"><?php echo $proj->project_name; ?></option>
			<?php
			}
			?>
			</select>
		</p>
		<p>
			Location:<br />
			<input type="text" id="edit_loc" name="location" class="txtfield" />
		</p>
		<p>
			Description:<br />
			<input type="text" id="edit_desc" name="description" class="txtfield" />
		</p>
	</div>
</div>
	  
<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>
<script>
jQuery(document).ready(function(){

	// load highlight message script
	redirect_highlight_message();
	// add more
	jQuery("#add-more").click(function(){	
		jQuery("#empty").hide();
		str = ''+
			'<tr>'+
				'<td>'+
					'<select class="txtselect project" style="width: 80px;">'+
						'<option value="0">select</option>'+
						<?php
						$str = "";
						foreach($sql_proj->result() as $proj){ 
							$str .= '<option value="'.$proj->project_id.'">'.$proj->project_name.'</option>';
						}
						?>
						'<?php echo $str; ?>'+
					'</select>'+
				'</td>'+
				'<td><input type="text" name="location" class="txtfield location"></td>'+
				'<td><input type="text" name="description" class="txtfield description"></td>'+
				'<td><a href="javascript:void();" class="btn btn-red btn-action btn-remove">REMOVE</a></td>'+
			'</tr>';
		jQuery("#save").show();
		jQuery(".tbl tbody").append(str);
	});
	// save location
	jQuery(document).on("click","#save",function(){
		var proj = new Array();
		var empty = false;
		jQuery(".project").each(function(index){
			if(jQuery(this).val()=="0"){
				empty = true;
			}
			proj[index] = jQuery(this).val();
		});
		var loc = new Array();
		jQuery(".location").each(function(index){
			loc[index] = jQuery(this).val();
		});
		var desc = new Array();
		jQuery(".description").each(function(index){
			desc[index] = jQuery(this).val();
		});
		var error = "";
		error = (empty==true)?"Some project are left empty":"";
		if(error!=""){
			alert(error);
		}else{
			if(proj!=""){
				// ajax call
				jQuery.ajax({
					type: "POST",
					url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/locations/ajax_project_location",
					data: {
						proj: proj, 
						loc: loc,
						desc: desc,
						<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
					}
				}).done(function(ret){
						jQuery.cookie("msg", "New project location has been saved!");
						window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/locations";
				});
			}else{
				alert('Enter employment type');
			}
		}
	});
	// remove location row
	jQuery(document).on("click",".btn-remove",function(){
		jQuery(this).parents("tr:first").remove();
		if(jQuery(".project").length==0){
			jQuery("#save").hide();
			jQuery("#empty").show();
		}
	});
	// delete location
	jQuery(".btn-delete").click(function(){
		var obj = jQuery(this);
		jQuery("#confirm-delete-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'yes': function() {
					var loc_id = obj.parents("tr").find(".loc_id").val();
					if(loc_id!=""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/locations/ajax_delete_project_location",
							data: {
								loc_id: loc_id,
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
							jQuery.cookie("msg", "A project location has been deleted");
							window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/locations";
						});
					}else{
						alert('Location Id is missing');
					}					
				},
				'no': function() {
					jQuery(this).dialog( 'close' );					
				}
			}
		});
	});
	// edit location
	jQuery(".btn-edit").click(function(){
		// resets project selection
		//jQuery(".edit_proj option").removeAttr("selected");
		var obj = jQuery(this);
		var proj_id = obj.parents("tr").find(".proj_id").val();
		var loc_id = obj.parents("tr").find(".loc_id").val();
		var loc = obj.parents("tr").find(".loc").html();
		var desc = obj.parents("tr").find(".desc").html();
		jQuery(".edit_proj option").each(function(){
		   if(jQuery(this).val()==proj_id){
			jQuery(this).prop("selected","selected");
		   }else{
			jQuery(this).removeProp("selected");
		   }
		});
		jQuery("#edit_loc").val(loc);
		jQuery("#edit_desc").val(desc);
		jQuery("#location-details-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'update': function() {
					var proj_id2 = jQuery("#edit_proj").val();
					var loc = jQuery("#edit_loc").val();
					var desc = jQuery("#edit_desc").val();
					//var loc_id = obj.parents("tr").find(".loc_id").val();
					if(loc_id!=""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/locations/ajax_update_project_location",
							data: {
								loc_id: loc_id,
								proj_id: proj_id2,
								loc: loc,
								desc: desc,
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
							if(ret==1){
								jQuery.cookie("msg", "Project location has been updated");
								window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/locations";
							}
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