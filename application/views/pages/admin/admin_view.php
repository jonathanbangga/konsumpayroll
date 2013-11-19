
	<h1><?php echo $page_title;?></h1>

	
	<div class="main-content">
	<?php echo form_open("admin/users/add_admin",array("onsubmit"=>"return add_admin_user();","id"=>"add_admin_user"));?>
		<div class="tbl-wrap">
			<table class="tbl jusers_all">
				<tbody>
					<tr>
						<th style="width:165px;">Name</th>
						<th style="width:165px">Username</th>
						<th style="width:285px">Action</th>
					</tr>
					<?php 
					if($client_user) {
						foreach($client_user as $all_user): ?>
						<tr class="admin_list_id<?php echo $all_user->konsum_admin_id;?>">
							<td class="own_name"><?php echo $all_user->name;?></td>
							<td><?php echo $all_user->payroll_cloud_id;?></td>
							<td>
								<a href="#" class="btn btn-normal btn-action change_pass_admin" id="view_<?php echo $all_user->konsum_admin_id;?>" set_id="<?php echo $all_user->konsum_admin_id;?>">CHANGE PASSWORD</a> 
								<a href="#" class="btn btn-gray btn-action edit_admin" id="edit_<?php echo $all_user->konsum_admin_id;?>" set_id="<?php echo $all_user->konsum_admin_id;?>">EDIT</a> 
								<a href="#" class="btn btn-red btn-action del_admin" id="del_<?php echo $all_user->konsum_admin_id;?>" set_id="<?php echo $all_user->konsum_admin_id;?>">DELETE</a>
							</td>
						</tr>
					<?php	
						endforeach;
					}
					?>	
				</tbody>
			</table>
		</div>
		<div class="paginative"><?php echo $pagi;?></div>
		<a href="#" id="jlight_adduser" class="btn">ADD  USER</a>	
		<input type="submit" name="save_user" class="btn ihide" id="add_admin" value="ADD ADMIN">
	<?php echo form_close();?>
	</div>
	
	<!-- for registration lightbox -->
	<div class="edit_users_reg jshowupdate ihide" title="Edit Admin User">
		<?php echo form_open("admin/users/add_admin_users",array("class"=>"jaddusers_update","onsubmit"=>"return kpay.admin.userz.update_admin_user_form('/admin/users/update_admin_users/','".itoken_cookie()."');"));?>
		<table>
			<tbody>
				<tr>
					<td style="width:155px">Name:</td>
					<td>
					<input type="text"  value="<?php echo set_value("name");?>" name="name" class="txtfield" id="edit_name">
					<input type="hidden" readonly="readonly" value="<?php echo set_value("id");?>" name="accounts_id" class="txtfield" id="accounts_id">
					</td>
				</tr>
				<tr>
					<td>Email Address:</td>
					<td>
					<input type="hidden" value="<?php echo set_value("email_address");?>" name="email_old_address" id="edit_old_email" class="txtfield">
					<input type="text" value="<?php echo set_value("email_address");?>" name="email_address" id="edit_email" class="txtfield"></td>
				</tr>
				<tr>
					<td style="width:155px">Username:</td>
					<td>
					<input type="hidden"  value="<?php echo set_value("username");?>" name="username_old" id="edit_username_old" class="txtfield">
					<input type="text"  value="<?php echo set_value("username");?>" name="username" id="edit_username" class="txtfield"></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" value="" name="password" class="txtfield" id="edit_password"></td>
				</tr>
				<tr>
					<td>Confirm Password:</td>
					<td><input type="password" value="" name="cpassword" class="txtfield" id="edit_cpassword"></td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="submit" name="update" value="Update" class="btn">
					</td>
				</tr>
			</tbody>
		</table>
		<?php echo form_close();?>
	</div>
	
	
	
	<!-- end for registration lightbox -->
	<!-- lightbox success -->
	<div class="ihide">
		<div class="success_add" title="Successfull Save">
			<p>Success you have added a user</p>
		</div>
		<div class="success_update" title="Successfull">
			<p>Success you have updated admin user</p>
		</div>
	</div>
	<!-- end lightbox success -->
	
	<!-- uis here -->
	<div class="ihide">
	
	</div>
	<!-- end uis -->
	

<script type="text/javascript">
	var a_token = "<?php echo itoken_cookie();?>";
	// ADDS APPEND INPUTS 
	function append_admin(){
		var html = '<tr class="append_admin">';
			html +='<td class="own_name"><input type="text" name="name[]" class="admin_uname check_error emp_fields"></td>';
			html +='<td><input type="text" name="username[]" class="admin_username check_error emp_fields"></td>';
			html +='<td>';
			html +='<a class="btn btn-red btn-action append_del_admin" href="#" style="width: 251px;">DELETE</a>';
			html +='</td>';
			html +='</tr>';
		jQuery(document).on("click","#jlight_adduser",function(e){
			e.preventDefault();
			jQuery(".jusers_all").append(html);
			jQuery(".append_admin").length > 0 ? jQuery("#add_admin").show() : jQuery("#add_admin").hide();
		});
	}
	
	// REMOVES APPEND HTML
	function delete_row_add(){
		jQuery(document).on("click",".append_del_admin",function(e){
		    e.preventDefault();
		    jQuery(this).parents("tr").remove();
		    jQuery(".append_admin").length > 0 ? jQuery("#add_admin").show() : jQuery("#add_admin").hide();
		});
	}
	
	// ADD  admin
	function add_admin_user(){
		var action = jQuery("#add_admin_user").attr("action");
		var name  = array_fields("input[name='name[]']");
		var user_name  = array_fields("input[name='username[]']");
		ierror_field(".admin_uname");
		ierror_field(".admin_username");
		var dup = ierror_duplicate(".admin_username");
		if(dup > 0){
			return false;
		}
		if(ierror_mark(".check_error") == 0){		
			var fields = {
				"name[]":name,
				"username[]":user_name,
				"ZGlldmlyZ2luamM": jQuery.cookie(a_token),
				"save_user":"true"
			};
			jQuery.post(action,fields,function(json){
				var res = jQuery.parseJSON(json);	
				if(res.success == '0'){
					alert(res.error);
				}else if(res.success == 1){
					jQuery(".success_messages").empty().html("<p>You have Successfully added</p>");
					kpay.overall.show_success(".success_messages");
				}
			});	
		}
		return false;
	}
	jQuery(function(){
		append_admin();
		delete_row_add();
		//kpay.admin.userz.show_add_form();
		kpay.admin.userz.delete_admin_user('/admin/users/delete_admin_user',"<?php echo itoken_cookie();?>");
		kpay.admin.userz.update_admin_user('/admin/users/show_edit_admin',"<?php echo itoken_cookie();?>");
	});
</script>


