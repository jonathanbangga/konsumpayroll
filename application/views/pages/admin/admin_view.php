<a href="#" id="jlight_adduser" class="btn right">ADD  USER</a>
	<h1><?php echo $page_title;?></h1>
	<table class="tbl jusers_all">
		<tbody>
			<tr>
			  <th style="width:165px;">Name</th>
			  <th style="width:165px">Username</th>
			  <th style="width:260px">Action</th>
			</tr>
			<?php 
			if($client_user) {
				foreach($client_user as $all_user): ?>
				<tr class="admin_list_id<?php echo $all_user->konsum_admin_id;?>">
					<td class="own_name"><?php echo $all_user->name;?></td>
					<td><?php echo $all_user->username;?></td>
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
	<div class="paginative"><?php echo $pagi;?></div>
	<!-- for registration lightbox -->
	<div class="create_users_reg jreg ihide" title="Add User">
		<?php echo form_open("admin/users/add_admin_users",array("class"=>"jaddusers","onsubmit"=>"return kpay.admin.userz.add_users_admin('/admin/users/add_admin_users/','".itoken_cookie()."');"));?>
		<table>
			<tbody>	
				<tr>
					<td style="width:155px">Name:</td>
					<td><input type="text"  value="<?php echo set_value("name");?>" name="name" class="txtfield"></td>
				</tr>
				<tr>
					<td>Email Address:</td>
					<td><input type="text" value="<?php echo set_value("email_address");?>" name="email_address" class="txtfield"></td>
				</tr>
				<tr>
					<td style="width:155px">Username:</td>
					<td><input type="text"  value="<?php echo set_value("username");?>" name="username" class="txtfield"></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" value="" name="password" class="txtfield"></td>
				</tr>
				<tr>
					<td>Confirm Password:</td>
					<td><input type="password" value="" name="cpassword" class="txtfield"></td>
				</tr>	
			</tbody>
		</table>
		<input type="submit" name="add" value="add" class="btn">
		<?php echo form_close();?>
	</div>
	
	<div class="edit_users_reg jshowupdate ihide" title="Edit Admin User">
		<?php echo form_open("admin/users/add_admin_users",array("class"=>"jaddusers_update","onsubmit"=>"return kpay.admin.userz.update_admin_user_form('/admin/users/update_admin_users/','".itoken_cookie()."');"));?>
		<table>
			<tbody>
				<tr>
					<td style="width:155px">Name:</td>
					<td>
					<input type="text"  value="<?php echo set_value("name");?>" name="name" class="txtfield" id="edit_name">
					<input type="hidden" readonly="readonly" value="<?php echo set_value("id");?>" name="id" class="txtfield" id="edit_id">
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
			</tbody>
		</table>
		<input type="submit" name="update" value="Update" class="btn">
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
	jQuery(function(){
		kpay.admin.userz.show_add_form();
		kpay.admin.userz.delete_admin_user('/admin/users/delete_admin_user',"<?php echo itoken_cookie();?>");
		kpay.admin.userz.update_admin_user('/admin/users/show_edit_admin',"<?php echo itoken_cookie();?>");
	});
</script>

