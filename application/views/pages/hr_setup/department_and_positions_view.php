<div class="main-content">
<div style="display:none;" class="highlight_message">Message</div>
        <p>To generate payroll reports by department or by position, select departments from the list by ticking the tickboxes. If you 
        want to further add positions a pop up will appear to prompt you to create positions per department, tick on the positions as well if you want to generate payroll report by positions.</p>
        <p>If no department has been created yet click on add department button. If you don't want to add positions for that department just close the pop up by clicking the x icon.</p>
        <div class="tbl-wrap department-wrap">
          <!-- TBL-WRAP START -->
          <ul id="deptnpos">
            <li>
              <header>Departments</header>
			  <?php
			  if($departments->num_rows()>0){
			  ?>
              <div class="dept-box department_div">
                <ul id="dept_ul">
                <?php
					foreach($departments->result() as $row){ 
						$check_dept = $this->department_and_positions_model->check_department($row->dept_id);
						$str_checked = ($check_dept->num_rows()>0)?'checked="checked"':"";
				?>
						<li class="li_dept">
								<input class="dept_id right" name="dept_id[]" type="checkbox" value="<?php echo $row->dept_id ?>" <?php echo $str_checked; ?>>
								<span class="dept_name"><?php echo $row->department_name; ?></span>
						</li>	  
					<?php
					}
				?>
                </ul>
              </div>
			  <?php
			  }else{ ?>
			  <p>No departments Yet</p>
			  <?php }
			  ?>
              <a class="btn" href="javascript:void(0);" id="add-more-dept">ADD DEPARTMENT</a> 
			  <a class="btn" href="javascript:void(0);" id="btn-delete_dept" style="margin-top: 9px; display:none;">DELETE</a>
			</li>
			
			<?php
			if($sel_dept->num_rows()>0){
				foreach($sel_dept->result() as $row){ ?>
			
			<li class="li<?php echo $row->dept_id ?> li_dept pos_li">
			  <input type="hidden" value="<?php echo $row->dept_id ?>" class="dept_id" name="dept_id">
			  <?php 
			  $sql = $this->department_and_positions_model->get_departments($row->dept_id); 
			  $row2 = $sql->row();
			  ?>
			  <header><?php echo $row2->department_name; ?></header>
			  <div class="dept-box position_div">
				<ul>
				<?php
				$pos = $this->department_and_positions_model->get_positions($row->dept_id); 
				foreach($pos->result() as $row2){ 
					$check_pos = $this->department_and_positions_model->check_position($row2->position_id);
					$str_checked = ($check_pos->num_rows()>0)?'checked="checked"':"";
				?>
					<li>
							<input type="checkbox" value="<?php echo $row2->position_id ?>" name="" class="right jpos" <?php echo $str_checked; ?> />
							<span class="pos_name"><?php echo $row2->position_name; ?></span>		
					</li>
				<?php }
				?>
				</ul>
			  </div>
			  <a href="javascript:void(0);" class="add-more-pos btn">ADD POSITION</a> 
			  <a class="btn btn-delete_pos" href="javascript:void(0);" style="margin-top: 9px;">DELETE</a>
			</li>
			
			<?php }
			}
			?>
			
			
			
          </ul>
          <div class="clearB"></div>
          <!-- TBL-WRAP END -->
        </div>
		
		</div>
        
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray left" href="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/employment_type">BACK</a> <a class="btn btn-gray right" href="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/projects">CONTINUE</a>
        <!-- FOOTER-GRP-BTN END -->
</div>

<div class="jdialog" id="add-more-dept-dialog" title="Add Department">
	<div class="inner_div">
		Enter department name: 
		<div class="inner_field"><input type="text" class="txtfield department_name" name="department_name" /></div>
	</div>
</div>


<div class="jdialog" id="add-more-position-dialog" title="Add Position">
	<div class="inner_div">
		Enter position: 
		<div class="inner_field"><input type="text" class="txtfield position" name="position" /></div>
	</div>
</div>


<div class="jdialog" id="no-pos-alert" title="Notice">
	<div class="inner_div">
		No positions for this department
	</div>
</div>

<div id="confirm-delete-dialog" class="jdialog"  title="Add more">
	<div class="inner_div">
		Are you sure you want to delete?
	</div>
</div>

<div class="jdialog" id="edit-dept-dialog" title="Update Department">
	<div class="inner_div">
		<p>
			Department:<br />
			<input type="text" id="update_dept" name="update_dept" class="txtfield" />
		</p>
	</div>
</div>

<div class="jdialog" id="edit-pos-dialog" title="Update Position">
	<div class="inner_div">
		<p>
			Position:<br />
			<input type="text" id="update_pos" name="update_pos" class="txtfield" />
		</p>
	</div>
</div>

<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>

<style>
.dept_name, .pos_name{
	cursor:pointer;
}
</style>

<script>
jQuery(document).ready(function(){

	// load highlight message script
	redirect_highlight_message();
	
	if(jQuery(".department_div ul").length>0){
		jQuery("#btn-delete_dept").show();
	}

	// department script
	jQuery(document).on("click",".dept_id",function(){
		var obj = jQuery(this);
		var dept_id = obj.val();
		var dept_name = obj.parents(".li_dept").find(".dept_name").html();
		var state = obj.prop("checked");
		
		var dept_exist = false;
		jQuery(".pos_li .dept_id").each(function(){
			if(jQuery(this).val()==dept_id){
				dept_exist = true;
			}
		});
		
		// if checked
		if(dept_exist==false){
			// ajax call
			jQuery.ajax({
				type: "POST",
				url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/department_and_positions/ajax_get_positions",
				data: {
					dept_id: dept_id,
					dept_name: dept_name,
					<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
				}
			}).done(function(ret){
				if(ret==0){
					jQuery("#no-pos-alert").dialog({
						modal: true,
						show: {
							effect: "blind"
						},
						buttons: {
							'add position': function() {
								jQuery( this ).dialog( "close" );
								add_position(dept_id);	
							}
						}
					});
				}
			});
		}
		
	});
	// add more department
	jQuery("#add-more-dept").click(function(){
		// empty department name
		jQuery(".department_name").val("");
		jQuery("#add-more-dept-dialog .inner_field").html('<input type="text" class="txtfield department_name" name="department_name" />');
		// launch add more department dialog box
		jQuery("#add-more-dept-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'add': function(){
					jQuery("#add-more-dept-dialog .inner_field").append('<input type="text" class="txtfield department_name" name="department_name" />');
				},
				save: function() {
					var dialog = jQuery(this);
					var dept_name = new Array();
					var i = 0;
					jQuery(".department_name").each(function(index){
						if(jQuery(this).val()!=""){
							dept_name[i] = jQuery(this).val();
							i++;
						}
					});
					
					if(dept_name!=""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/department_and_positions/ajax_add_department",
							data: {
								dept_name: dept_name, 
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
								var dept_box = jQuery(".dept-box").html();
								if(dept_box!=null){
									highlight_message("New department had been saved!");
									jQuery("#dept_ul").append(ret);
									jQuery(dialog).dialog( "close" );
								}else{
									jQuery.cookie("msg", "New department had been saved!");
									window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/department_and_positions";
								}
						});
					}else{
						alert('Enter department name');
					}	
				}
			}
		});
	});
	// add more position
	jQuery(document).on("click",".add-more-pos",function(){
		var dept_id = jQuery(this).parents(".li_dept").find(".dept_id").val();
		add_position(dept_id);
	});
	// add position script
	function add_position(dept_id){
		// empty position
		jQuery(".position").val("");
		jQuery("#add-more-position-dialog .inner_field").html('<input type="text" class="txtfield position" name="position" />');
		// launch add position dialog box
		jQuery("#add-more-position-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'add': function(){
					jQuery("#add-more-position-dialog .inner_field").append('<input type="text" class="txtfield position" name="position" />');
				},
				save: function() {
					var dialog = jQuery(this);

					var pos = new Array();
					var i = 0;
					jQuery(".position").each(function(index){
						if(jQuery(this).val()!=""){
							pos[i] = jQuery(this).val();
							i++;
						}
					});
					
					
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/department_and_positions/ajax_add_position",
							data: {
								pos: pos,
								dept_id: dept_id,
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							},
							dataType:'json'
						}).done(function(ret){
								//console.log(ret[i].length);
								var i = 0;
								var temp = "";
								if(ret.length>0){
									for(i=0;i<ret.length;i++){
										pos_box = jQuery(".li"+ret[i].dept_id).html();
										if(pos_box!=null){
											var temp = '<li>'+					
															'<input class="right jpos" type="checkbox" value="'+ret[i].pos_id+'">'+
															'<span class="pos_name">'+ret[i].position+'</div>'+
													   '</li>';
													   jQuery(".li"+ret[i].dept_id+" ul").append(temp);
										}else{
											//console.log('wa pay sud');
											var temp = '<li class="li'+ret[i].dept_id+' li_dept">'+
														  '<input type="hidden" name="dept_id" class="dept_id" value="'+ret[i].dept_id+'" />'+
														  '<header>'+ret[i].department+'</header>'+
														  '<div class="dept-box position_div">'+
															'<ul>'+
																'<li>'+
																		'<input class="right jpos" name="" type="checkbox" value="'+ret[i].pos_id+'">'+
																		'<span class="pos_name">'+ret[i].position+'</span>'+
																'</li>'+
															'</ul>'+
														  '</div>'+
														  '<a class="add-more-pos btn" href="javascript:void(0);">ADD POSITION</a> '+
														  '<a class="btn btn-delete_pos" href="javascript:void(0);" style="margin-top: 9px;">DELETE</a>'+
														'</li>';
											jQuery("#deptnpos").append(temp);
										}
									}
									highlight_message("New position has been created!");
									jQuery(dialog).dialog( "close" );
								}
						});
						
				}
			}
		});
	}
	
	// assign department and position script
	jQuery(document).on("click",".jpos",function(){
		var dept_id = jQuery(this).parents(".li_dept").find(".dept_id").val();
		var pos_id = jQuery(this).val();
		var num_of_pos = jQuery(this).parents(".dept-box").find("input:checked").length;
			if(jQuery(this).prop("checked")==true){
				jQuery.ajax({
					type: "POST",
					url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/department_and_positions/ajax_assign_department_and_position",
					data: {
						dept_id: dept_id,
						pos_id: pos_id,
						<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
					}
				});
			}else{
				jQuery.ajax({
					type: "POST",
					url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/department_and_positions/ajax_unassign_department_and_position",
					data: {
						pos_id: pos_id,
						<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
					}
				});		
			}
				
	});
	
	
	// delete department
	jQuery("#btn-delete_dept").click(function(){
		var obj = jQuery(this);
		jQuery("#confirm-delete-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'yes': function() {
					var dept_id = new Array();
					jQuery(".dept_id:checked").each(function(index){
						dept_id[index] = jQuery(this).val();
					});
					if(dept_id!=""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/department_and_positions/ajax_delete_department",
							data: {
								dept_id: dept_id,
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
							jQuery.cookie("msg", "Department has been deleted");
							window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/department_and_positions";
						});
					}else{
						alert('Department Id is missing');
					}					
				},
				'no': function() {
					jQuery(this).dialog( 'close' );					
				}
			}
		});
	});
	
	// delete department
	jQuery(document).on("click",".btn-delete_pos",function(){
		var obj = jQuery(this);
		jQuery("#confirm-delete-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'yes': function() {
					var pos_id = new Array();
					obj.parents("li:first").find(".jpos:checked").each(function(index){
						pos_id[index] = jQuery(this).val();
					});
					if(pos_id!=""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/department_and_positions/ajax_delete_position",
							data: {
								pos_id: pos_id,
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
							jQuery.cookie("msg", "Position has been deleted");
							window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/department_and_positions";
						});
					}else{
						alert('Position Id is missing');
					}					
				},
				'no': function() {
					jQuery(this).dialog( 'close' );					
				}
			}
		});
	});
	
	// edit department name
	jQuery(document).on("click",".dept_name",function(){
		var obj = jQuery(this);
		var dept_name = obj.html();
		jQuery("#update_dept").val(dept_name);
		jQuery("#edit-dept-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'Update': function() {
					var dept_id = obj.parents("li:first").find(".dept_id").val();
					var dept_name2 = jQuery("#update_dept").val();
					if(dept_id!=""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/department_and_positions/ajax_update_department",
							data: {
								dept_id: dept_id,
								dept_name: dept_name2,
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
							jQuery.cookie("msg", "Department has been updated");
							window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/department_and_positions";
						});
					}else{
						alert('Department Id is missing');
					}										
				}
			}
		});
	});
	
	// edit position name
	jQuery(document).on("click",".pos_name",function(){
		var obj = jQuery(this);
		var pos_name = obj.html();
		jQuery("#update_pos").val(pos_name);
		jQuery("#edit-pos-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'Update': function() {
					var pos_id = obj.parents("li:first").find(".jpos").val();
					var pos_name2 = jQuery("#update_pos").val();
					if(pos_id!=""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/department_and_positions/ajax_update_position",
							data: {
								pos_id: pos_id,
								pos_name: pos_name2,
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
							jQuery.cookie("msg", "Position has been updated");
							window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/department_and_positions";
						});
					}else{
						alert('Department Id is missing');
					}										
				}
			}
		});
	});
	
	
});
</script>
