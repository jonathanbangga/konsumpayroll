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
					<th style="width:170px;" class="ihide">Payroll Group</th>
					<th style="width:170px;">Permission</th>
					<th style="width:170px">Action</th>
				</tr>
				<?php 
					if($approvers_list){
						foreach($approvers_list as $key=>$approvers):
				?>
				<tr>
					<td> <?php  echo ($this->uri->segment(5))? $key+$this->uri->segment(5)+4:$key+1;?></td>
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
						<?php 
							$permission_list =  $this->users->permission_define($company_info->company_id,$approvers->account_id);		
							if($permission_list){
								echo $permission_list->roles;	
							}
						?>
					</td>
					<td> <a class="btn btn-gray btn-action jmanage_users" href="javascript:void(0);" edit_approvers="<?php echo $approvers->account_id;?>" >EDIT</a> </td>
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
	<div class="footer-grp-btn ihide">
	<!-- FOOTER-GRP-BTN START -->
	<a href="/company/hr_setup/locations" class="btn btn-gray left">BACK</a> <a href="/company/hr_setup/leaves" class="btn btn-gray right"> CONTINUE</a>
	<!-- FOOTER-GRP-BTN END -->
	</div>
	
	<div class="ihide">
		<div class="jedit_users" title="EDIT USERS">
		<?php echo form_open("",array("onsubmit"=>"return submit_edit_users();"));?>
				<table>
					<tr>
						<td style="width:120px;">Payroll Cloud ID</td>
						<td>
						<input type="hidden" name="jaccount_id" id="jaccount_id">
						<div id="jpayroll_cloud_id"></div></td>
					</tr>
					<tr>
						<td>Email Address</td>
						<td>
						<input type="hidden" name="old_jemail_address" class="txtfield input_width">
						<input type="text" name="jemail_address" class="txtfield input_width"></td>
					</tr>
					<tr>
						<td>First Name</td>
						<td><input type="text" name="jfname" class="txtfield input_width"></td>
					</tr>
					<tr>
						<td>Middle Name</td>
						<td><input type="text" name="jmname" class="txtfield input_width"></td>
					</tr>
					<tr>
						<td>Last Name</td>
						<td><input type="text" name="jlname" class="txtfield input_width"></td>
					</tr>
					<tr>
						<td>Payroll Group</td>
						<td><select name="jpermisssion" id="jpermisssion" class="txtselect input_width"></select></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="flright">
							<input type="submit" name="update" value="UPDATE" class="btn" id="submit_users">
							<input type="button" name="cancel" value="CANCEL" class="btn" id="update_users">
						</td>
					</tr>
				</table>
			<?php echo form_close();?>
		</div>
	</div>
	<?php 
		$options = "<option value=\"\">Please select permission</option>";
		if($approval_process){
			foreach($permission_type as $key_permission=>$val_permission){
				$options .='<option value="'.$val_permission->users_roles_id.'">'.$val_permission->roles.'</option>';	
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
				    html +='<td style="display:none;"><input type="hidden" class="inp_user" name="payroll_groups[]">';
				    html +='<select name="approval_process_id[]" class="inp_user">'+$select_options+'</select>';
					html +='<input type="hidden" class="inp_user" name="approval_process_ids[]" readonly="readonly">';
					html +='</td>';
				    html +='<td><select class="inp_user" name="permission[]">'+$select_options+'</select></td>';
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
			var permission = array_fields("select[name='permission[]']");
			ierror_field("input[name='payroll_cloud_id[]']");
			ierror_field("input[name='email[]']");
			ierror_field("input[name='first_name[]']");
			ierror_field("input[name='middle_name[]']");
			ierror_field("input[name='last_name[]']");
			//ierror_field("input[name='password[]']");
			//ierror_field("select[name='approval_process_id[]']");
			//ierror_field("input[name='retype_password[]']");			
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
						//"password[]":password,
						//"retype_password[]":retype_password,
						//"approval_process_id[]":approval_process_id,
						"permission[]":permission,
						"ZGlldmlyZ2luamM":jQuery.cookie(itokens),
						"save":"true"
				};
				kpay.overall.ajax_save(urls,fields);
				return false;
			}
			return false;
		}

		//EDIT USERS
		function edit_users(){
			jQuery(document).on("click",".jmanage_users",function(e){
				e.preventDefault();
				var el = jQuery(this);
				var account_id = el.attr("edit_approvers");
				var urls = "/<?php echo $this->subdomain;?>/hr/users/check_users/";
				var fields = {
					"account_id":account_id,
					"ZGlldmlyZ2luamM":jQuery.cookie(itokens),
				};	
				// checker
				jQuery.post(urls,fields,function(json){
					var res = jQuery.parseJSON(json);	
					if(res){
						var options= '<?php echo $options;?>';
						jQuery("#jpayroll_cloud_id").text(res.payroll_cloud_id);
						jQuery("input[name='jemail_address']").empty().val(res.email);
						jQuery("input[name='old_jemail_address']").empty().val(res.email);
						jQuery("input[name='jfname']").empty().val(res.first_name);
						jQuery("input[name='jmname']").empty().val(res.middle_name);
						jQuery("input[name='jlname']").empty().val(res.last_name);
						jQuery("#jpermisssion").html(options);
						jQuery("#jaccount_id").empty().val(res.account_id);
					}
				});	
				kpay.overall.show_pops(".jedit_users");	
			});
			jQuery(document).on("click","#update_users",function(e){
				jQuery(".jedit_users").dialog('close');
			});
		}

		function submit_edit_users(){
			var urls =  "/<?php echo $this->subdomain;?>/hr/users/update_users/";
			var fields = {
				"jaccount_id":jQuery("input[name='jaccount_id']").val(),
				"jemail_address":jQuery("input[name='jemail_address']").val(),
				"old_jemail_address":jQuery("input[name='old_jemail_address']").val(),
				"jfname":jQuery("input[name='jfname']").val(),
				"jmname":jQuery("input[name='jmname']").val(),
				"jlname":jQuery("input[name='jlname']").val(),
				"jpermisssion":jQuery("select[name='jpermisssion']").val(),
				"ZGlldmlyZ2luamM":jQuery.cookie(itokens),
				"update":true
			};	
			jQuery.post(urls,fields,function(json){
				var res = jQuery.parseJSON(json);	
				if(res.success == '0'){
					alert(res.error);
				}else{
					jQuery(".success_messages").empty().html("<p>Successfully Updated</p>");
					kpay.overall.show_success(".success_messages");
				}
				console.log(res);
			});		
			return false;
		}

		jQuery(function(){
			add_users();
			delete_users();
			search_name();
			clear_payroll_group();
			edit_users();
		});
	</script>