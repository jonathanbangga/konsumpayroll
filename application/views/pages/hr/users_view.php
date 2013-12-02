	<div class="tbl-wrap">	
		<div class="successContBox ihide"></div>
		<?php echo form_open("",array("onsubmit"=>"return save_users();"));?>
		<!-- TBL-WRAP START -->
		<table class="tbl emp_users_list" style="width:1610px;">
			<tbody>
				<tr>
					<th style="width:50px;">Line</th>
					<th style="width:170px;">Payroll Cloud ID</th>
					<th style="width:170px;">Email</th>
					<th style="width:170px;">First Name</th>
					<th style="width:170px;">Middle Name</th>
					<th style="width:170px;">Last Name</th>
					<th style="width:170px;">Password</th>
					<th style="width:170px;">Retype password</th>
					<th style="width:170px;">Payroll Group</th>
					<th style="width:170px;">Permission</th>
					<th style="width:170px">Action</th>
				</tr>
				<?php 
					if($approvers_list){
						foreach($approvers_list as $key=>$approvers):
				?>
				<tr>
					<td><?php echo $key+1;?></td>
					<td><div class="users_text"><?php echo $approvers->payroll_cloud_id;?></div></td>
					<td>
						<input type="hidden" id="account_id" name="update_account_id" value="<?php echo base64_encode($approvers->account_id);?>">
						<input type="hidden" name="update_email[]" value="<?php echo $approvers->email;?>" class="inp_user">
						<div class="users_text"><?php echo $approvers->email;?></div>
					</td>
					<td>
						<input type="hidden" name="update_first_name[]" value="<?php echo $approvers->first_name;?>" class="inp_user">
						<div class="users_text"><?php echo $approvers->first_name;?></div>
					</td>
					<td>
						<input type="hidden" name="update_middle_name[]" value="<?php echo $approvers->middle_name;?>" class="inp_user">
						<div class="users_text"><?php echo $approvers->middle_name;?></div>
					</td>
					<td>
						<input type="hidden" name="update_last_name[]" value="<?php echo $approvers->last_name;?>" class="inp_user">
						<div class="users_text"><?php echo $approvers->last_name;?></div>
					</td>
					<td>
						<input type="hidden" name="update_password[]" class="inp_userlist">
						<div class="users_text">&nbsp;</div>
					</td>
					<td>
						<input type="hidden" name="update_retype_password[]" class="inp_userlist">
						<div class="users_text">&nbsp;</div>
					</td>
					<td>
						<input type="hidden" name="update_payroll_group[]" class="inp_userlist">
						<div class="users_text">
							<?php 
								$approver_group =  $this->users->approver_groups($company_info->company_id,$approvers->emp_id);
								if($approver_group){
									echo $approver_group->name;
								}else{
									echo "None";
								}
							?>&nbsp;
						</div>
					</td>
					<td>
						<input type="hidden" class="inp_userlist" name="update_permission[]">
					</td>
					<td> <a class="btn btn-gray btn-action" href="#" edit_approvers="<?php echo $approvers->account_id;?>" >EDIT</a> </td>
				</tr>
				
				<?php 		
						endforeach;
					}
				?>
			</tbody> 
		</table>
		<span class="ihides unameContBoxTrick"></span>
		<!-- TBL-WRAP END -->
	</div>
		
	<div class="left pagi-lefts">
	<a id="add-more-users" href="javascript:void(0);" class="btn">ADD USERS</a>
	<input type="submit" name="save" value="SAVE" class="btn ihide" />
	</div>
	<div class="right pagi-rights"><?php  echo $pagi;?></div>
	<p>&nbsp;</p>
	<?php echo form_close();?>
	<div class="footer-grp-btn">
	<!-- FOOTER-GRP-BTN START -->
	<a href="/company/hr_setup/locations" class="btn btn-gray left">BACK</a> <a href="/company/hr_setup/leaves" class="btn btn-gray right"> CONTINUE</a>
	<!-- FOOTER-GRP-BTN END -->
	</div>
	<?php 
		$options = "<option value=\"\">Please select group</option>";
		if($approval_process){
			foreach($approval_process as $key_process=>$val_process){
				$options .='<option value="'.$val_process->approval_process_id.'">'.$val_process->name.'</option>';	
			}
		}
	
	?>
	
	<script type="text/javascript">
		//token
		var itokens = "<?php echo itoken_cookie();?>";
		// DELETE APPEND
		function delete_users(){
			jQuery(document).on("click",".jdel_users_append",function(e){
			    e.preventDefault();
			    var el = jQuery(this);
			    el.parents("tr").remove();
			
			});
		}

		// AUTOCOMPLETE
		function search_name(){
			var domain_url = "<?php echo $this->uri->segment(1);?>";
			var availableTags = <?php echo $approval_group;?>;
			jQuery("input[name='payroll_group[]']").autocomplete({
				source: availableTags,select: function (event, ui) {
					var el = jQuery(this);
					if(ui.item.approval_process_id){
				   		el.attr('process_id',ui.item.approval_process_id);
				   		el.next().val(ui.item.approval_process_id);
				   		el.attr("readonly","readonly");
					}else{
						el.attr('process_id','');
				   }
				}
			});
		}
		
		// ADD USERS
		function add_users(){
			var $select_options = '<?php echo $options;?>';
			jQuery(document).on("click","#add-more-users",function(){
			    var html = '<tr>';
				    html +='<td></td>';
				    html +='<td><input type="text" class="inp_user" name="payroll_cloud_id[]"></td>';
				    html +='<td><input type="text" class="inp_user" name="email[]"></td>';
				    html +='<td><input type="text" class="inp_user" name="first_name[]"></td>';
				    html +='<td><input type="text" class="inp_user" name="middle_name[]"></td>';
				    html +='<td><input type="text" class="inp_user" name="last_name[]"></td>';    
				    html +='<td><input type="text" class="inp_user" name="password[]"></td>'; 
				    html +='<td><input type="text" class="inp_user" name="retype_password[]"></td>';
				    html +='<td><input type="hidden" class="inp_user" name="payroll_groups[]">';
				    html +='<select name="approval_process_id[]" class="inp_user">'+$select_options+'</select>';
					html +='<input type="hidden" class="inp_user" name="approval_process_ids[]" readonly="readonly">';
					html +='</td>';
				    html +='<td><input type="text" class="inp_user" name="permission[]"></td>';
				    html +='<td><a href="#" class="btn btn-red btn-action jdel_users_append">REMOVE</a></td>';
				    html +='</tr>'; 
			    jQuery(".emp_users_list").append(html); 
			    search_name();
			    jQuery("input[name='save']").show();
			});
		}

		// input payroll group
		function clear_payroll_group(){
			jQuery(document).on("click","input[name='payroll_group[]']",function(e){
					var html = jQuery(this).val('');
					jQuery(this).next().val('');
					jQuery(this).attr("process_id","");
					jQuery(this).removeAttr("readonly");
			});
		}

		//AAJAX ADD 
		function save_users(){
			var urls = "/<?php echo $this->uri->segment(1);?>/hr/users";
			var payroll_cloud_id = array_fields("input[name='payroll_cloud_id[]']");
			var email = array_fields("input[name='email[]']");
			var first_name = array_fields("input[name='first_name[]']");
			var middle_name = array_fields("input[name='middle_name[]']");
			var last_name = array_fields("input[name='last_name[]']");
			var password = array_fields("input[name='password[]']");
			var retype_password = array_fields("input[name='retype_password[]']");
			var approval_process_id = array_fields("select[name='approval_process_id[]']");
			var permission = array_fields("input[name='permission[]']");
			ierror_field("input[name='payroll_cloud_id[]']");
			ierror_field("input[name='email[]']");
			ierror_field("input[name='first_name[]']");
			ierror_field("input[name='middle_name[]']");
			ierror_field("input[name='last_name[]']");
			ierror_field("input[name='password[]']");
			ierror_field("select[name='approval_process_id[]']");
			ierror_field("input[name='retype_password[]']");			
			ierror_duplicate("input[name='payroll_cloud_id[]']");
			ierror_duplicate("input[name='email[]']");
			if(ierror_mark(".inp_user") > 0){
				
			}else{
				var fields = {
						"payroll_cloud_id[]":payroll_cloud_id,
						"email[]":email,
						"first_name[]":first_name,
						"middle_name[]":middle_name,
						"last_name[]":last_name,
						"password[]":password,
						"retype_password[]":retype_password,
						"approval_process_id[]":approval_process_id,
						"permission[]":permission,
						"ZGlldmlyZ2luamM":jQuery.cookie(itokens),
						"save":"true"
				};
				kpay.overall.ajax_save(urls,fields);
				return false;
			}
			return false;
		}

		
		jQuery(function(){
			add_users();
			delete_users();
			search_name();
			clear_payroll_group();
		});
	
	</script>