<div style="display:none;" class="highlight_message">Message</div>
<div class="main-content">
<p>You need to assign approver for each approval process. If approval process does not exist, click add approval process.</p>
<p>If the approver is an employee, go back to this module once you have added the employees.</p>

<div class="tbl-wrap">
<?php 
$max = $ap_sql->num_rows();
if($max>0){ 
?>
  <table style="width:260px;">
	<tr>
	  <td colspan="2"><h5>Check the process this person will aprove</h5></td>
	</tr>
	<?php
		$i = 1;
		foreach($ap_sql->result() as $index=>$ap){ 
		if($index==0){ echo "<tr>"; } 
	?>
			<td style="width:130px">
				<label>
					<input style="margin-right:15px;" name="app_proc[]" class="app_proc" type="checkbox" value="<?php echo $ap->approval_process_id; ?>">
					<?php echo $ap->name; ?>
				</label>
			</td>
	<?php 
			if($index==$max){ 
				echo "</tr>";
			}else{
				if($i%2==0){ 
					echo "</tr>";
				}
			}
			$i++;
		}
	?>
  </table>
<?php 
}else{
	echo "No approval process yet";
} 
?>
  <p class="jc1">
	  <a href="javascript:void(0);" id="btn-add-approval-process" class="btn">
		ADD APPROVAL PROCESS
	  </a>
	  <a class="btn" id="btn-delete" href="javascript:void(0);">DELETE</a>
  </p>
</div>

<div class="tbl-wrap">
  <h5>How many level of approval process do you have?</h5>
  <input class="txtfield txtcenter num_level" name="" type="text">
</div>

<div class="tbl-wrap tbl-approvers">
	<div id="tbl-approvers"></div> 
    <p class="jc1">
	  <input style="margin: 0 15px 0 1px;" name="" type="checkbox" value=""> 
	  <label style="bottom: 8px;position: relative;">include HR for confirmation<label/>
    </p>
</div>

<div class="tbl-wrap">
  <!-- TBL-WRAP START -->
  <h5>Approval Group</h5>
  <?php 
  if($ap_n_ag_sql->num_rows()>0){ ?>
	<div class="accor" style="width:368px;">
		<ul>
		<?php
		foreach($ap_n_ag_sql->result() as $index=>$row){ ?>
			<li <?php if($index==0){ echo 'class="selected"'; } ?>>
				<header class="jacc_head"><?php echo $row->name; ?></header>
				<section <?php if($index>0){ echo 'style="display:none;"'; } ?>>
				  <table width="100%" class="tbl">
					<tr>
					  <th style="width:123px;">Approver</th>
					  <th style="widows:59px;">Level</th>
					  <th>Action</th>
					</tr>
					<?php
					$appr_sql = $this->approval_groups_model->get_approvers($row->approval_process_id);
					foreach($appr_sql->result() as $appr){ ?>
					<tr>
					  <td><?php echo "{$appr->first_name} {$appr->last_name}";  ?></td>
					  <td><?php echo $appr->level; ?></td>
					  <td>
						<a class="btn btn-red btn-action btn-remove" href="javascript:void(0)">REMOVE</a>
						<input type="hidden" class="ag_id" value="<?php echo $appr->approval_group_id; ?>" />
					  </td>
					</tr>
					<?php }
					?>
				  </table>
				</section>
			</li>
		<?php }
		?>
		</ul>
	 </div>
  <?php 
  }else{
	echo "No approval group yet";
  }
  ?>
  <!-- TBL-WRAP END -->
</div>



 </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray left" href="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/department_and_positions">BACK</a> <a class="btn btn-gray right" href="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/projects"> CONTINUE</a>
        <!-- FOOTER-GRP-BTN END -->
      </div>

<div class="jdialog" id="add-approval-process" title="Add Approval Process">
	<div class="inner_div">
		Enter approval process: 
		<input type="text" id="app_pro" name="app_pro" />
	</div>
</div>

<div id="confirm-delete-dialog" class="jdialog"  title="Add more">
	<div class="inner_div">
		Are you sure you want to delete?
	</div>
</div>

<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>
<style>
.tbl-approvers input {
    height: 25px;
}
.approver {
    width: 157px;
}
.level {
    width: 23px;
}
.num_level{
	width:55px; 
	font-style:normal; 
	padding-top:8px; 
	padding-bottom:8px; 
	height: 15px;
	width: 23px;
}
.jc1{
	margin-top: 10px;
}
</style>
<script>
jQuery(document).ready(function(){

	// load highlight message script
	redirect_highlight_message();

	// append more approvers
	jQuery(".num_level").blur(function(){
		var num = jQuery(this).val();
		if(num!=""){
			var temp = '<table><tr>'+
						'<th style="width:200px;"><strong>Approvers</strong></th>'+
						'<th><strong>Level</strong></th>'+
					'</tr>';
			for(var i=0;i<num;i++){
				temp += '<tr>'+
							'<td><input type="text" class="approver txtfield"></td>'+
							'<td><input type="text" class="level txtfield"></td>'+
							'<td><input type="hidden" name="emp_id[]" class="emp_id txtfield"></td>'+
						'</tr>';
			}
				temp += '</table><p class="jc1">'+
							'<a href="javascript:void(0);" id="btn-add-approval-groups" class="btn">'+
								'SUBMIT'+
							'</a>'+
						'</p>';
			jQuery("#tbl-approvers").html(temp);
			auto_complete();
		}
	});
	// add more approval process
	jQuery("#btn-add-approval-process").click(function(){
		var name = jQuery("#app_pro").val("");
		jQuery("#add-approval-process").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'save': function() {
					var name = jQuery("#app_pro").val();
					if(name!=""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/approval_groups/ajax_add_approval_process",
							data: {
								name: name, 
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
							if(ret==1){
								jQuery.cookie("msg", "New approval process had been saved!");
								window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/approval_groups";
							}
						});
					}else{
						alert("Approval process is empty");
					}
				}
			}
		});
	});
	
	// auto complete script 
	function auto_complete(){
		<?php
			$sql_emp = $this->approval_groups_model->get_company_approver();
			$emp_str = "";
			if($sql_emp->num_rows()>0){
				foreach($sql_emp->result() as $emp){
					$emp_str .= ",{value:'{$emp->first_name} {$emp->last_name}',emp_id:{$emp->emp_id}}";
				}
			}
			$emp_str2 = substr($emp_str,1) 
		?>
		var availableTags = [<?php echo trim(preg_replace('/\s\s+/', ' ', $emp_str2)); ?>];
		jQuery( ".approver" ).autocomplete({
			source: availableTags,
			select: function( event, ui ) {
				jQuery(this).parents("tr:first").find(".emp_id").val(ui.item.emp_id);
			}
		});
	}
	
	// custom accordion script
	jQuery(".jacc_head").click(function(){
		var section = jQuery(this).parents("li:first").find("section");
		var visibility = section.css("display");
		if(visibility=='block'){
			jQuery(this).css('background','url("/assets/theme_2013/images/bg-small-white-arrow-right.png") no-repeat scroll 15px center #32677D');
			section.slideUp();
		}else{
			jQuery(this).css('background','url("/assets/theme_2013/images/bg-small-white-arrow-down.png") no-repeat scroll 15px center #32677D');
			 section.slideDown();
		}
	});
	
	// add approval groups
	jQuery(document).on("click","#btn-add-approval-groups",function(){
		$error = "";
		$empty = false;
		// approval process
		if(jQuery(".app_proc:checked").length==0){
			$empty = true;
		}
		$error += ($empty==true)?"- Select at least one approval process<br />":"";
		// approver
		$empty = false;
		jQuery(".emp_id").each(function(){
			if(jQuery(this).val()==""){
				$empty = true;
			}
		});
		$error += ($empty==true)?"- Some of approver fields are empty<br />":"";
		// approver level
		$empty = false;
		jQuery(".level").each(function(){
			if(jQuery(this).val()==""){
				$empty = true;
			}
		});
		$error += ($empty==true)?"- Some of approver levels are empty<br />":"";		
		
		if($error!=""){
			alert($error);
		}else{
			// approval group
			var i = 0;	
			var app_proc = new Array;
			jQuery(".app_proc:checked").each(function(){
				app_proc[i] = jQuery(this).val();
				i++;
			});
			// approver
			var i = 0;	
			var approver = new Array;
			jQuery(".emp_id").each(function(){
				if(jQuery(this).val()!=""){
					approver[i] = jQuery(this).val();
				}
				i++;
			});	
			// approver
			var i = 0;	
			var level = new Array;
			jQuery(".level").each(function(){
				if(jQuery(this).parents("tr").find(".approver").val()!=""){
					level[i] = jQuery(this).val();
				}
				i++;
			});	
			// ajax call
			jQuery.ajax({
				type: "POST",
				url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/approval_groups/ajax_add_approval_group",
				data: {
					app_proc: app_proc, 
					approver: approver,
					level: level,
					<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
				}
			}).done(function(ret){
				jQuery.cookie("msg", "New approval group had been saved!");
				window.location='/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/approval_groups';
			});
		}
		
	});
	
	// remove approver
	jQuery(".btn-remove").click(function(){
		var obj = jQuery(this);
		jQuery("#confirm-remove-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'yes': function() {
					var ag_id = obj.parents("tr").find(".ag_id").val();
					if(ag_id!=""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/approval_groups/delete_approver",
							data: {
								ag_id: ag_id,
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
							jQuery.cookie("msg", "An approver has been removed");
							window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/approval_groups";
						});
					}else{
						alert('Approval Groups Id is missing');
					}					
				},
				'no': function() {
					jQuery(this).dialog( 'close' );					
				}
			}
		});
	});
	
	
	// delete approval process
	jQuery("#btn-delete").click(function(){
		var obj = jQuery(this);
		jQuery("#confirm-delete-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'yes': function() {
					var ap_id = new Array();
					jQuery(".app_proc:checked").each(function(index){
						ap_id[index] = jQuery(this).val();
					});
					if(ap_id!=""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/approval_groups/ajax_delete_approval_process",
							data: {
								ap_id: ap_id,
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
							jQuery.cookie("msg", "Approval process has been deleted");
							window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/approval_groups";
						});
					}else{
						alert('Approval process Id is missing');
					}					
				},
				'no': function() {
					jQuery(this).dialog( 'close' );					
				}
			}
		});
	});

	
});
</script>
