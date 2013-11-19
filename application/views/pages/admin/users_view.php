<h1><?php echo $page_title;?></h1>
<div class="main-content">
<div class="tbl-wrap">
<?php echo form_open("admin/users/add_owners");?>
<table class="tbl jusers_all">
	<tbody>
		<tr>
            <th style="width:165px;">Name</th>
            <th style="width:165px">Company Name</th>
             <th style="width:165px">Email Address</th>
            <th style="width:225px">Action</th>
		</tr>
		<?php 
		if($client_user) {
			foreach($client_user as $all_user): ?>
			<tr id="jcomp_<?php echo $all_user->company_owner_id;?>">
				<td class="own_name"><?php echo $all_user->owner_name;?></td>
				<td>
					<ul class="complist">
					<?php
						$all_companies = $this->users_model->owners_company_list($all_user->company_owner_id);
						if($all_companies){
							foreach($all_companies as $comp_list): ?>
							<li><span><?php echo $comp_list->company_name;?></span></li>
					<?php
							endforeach;
						}
					?>
					</ul>
				</td>
				<td><?php echo $this->users_model->select_user($all_user->company_owner_id) ? $this->users_model->select_user($all_user->company_owner_id)->email : ""; ?></td>
				<td>
					<a href="#" class="btn cbtnadd juser_view"  id="user_view_<?php echo $all_user->company_owner_id;?>"  set_id="<?php echo $all_user->company_owner_id;?>">VIEW</a> 
					<a href="#" class="btn btn-gray btn-action juser_edit" id="user_edit_<?php echo $all_user->company_owner_id;?>" set_id="<?php echo $all_user->company_owner_id;?>" >EDIT</a> 
					<a href="#" class="btn btn-red btn-action juser_del" id="user_id_<?php echo $all_user->company_owner_id;?>"  set_id="<?php echo $all_user->company_owner_id;?>">DELETE</a>
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
<input type="submit" name="add_owner" class="btn ihide jadd_owner" value="SAVE" />
<?php echo form_close();?>
</div>
<!-- for registration lightbox -->
<div class="create_users_reg jreg ihide" title="Add User">
	<?php echo form_open("admin/users/add_users",array("class"=>"jaddusers","onsubmit"=>"return kpay.admin.userz.add_users('/admin/users/add_users/','".itoken_cookie()."');"));?>
	<table>
		<tbody>
			<tr>
				<td style="width:155px">Name:</td>
				<td><input type="text"  value="<?php echo set_value("owner_name");?>" name="owner_name" class="txtfield"></td>
			</tr>
			<tr>
				<td>Email Address:</td>
				<td><input type="text" value="<?php echo set_value("email_address");?>" name="email_address" class="txtfield"></td>
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
<!-- end for registration lightbox -->
<!-- updated user lightbox -->
	<div class="edit_users_reg jshowupdate ihide" title="Edit Company Owner">
		<?php echo form_open("admin/users/update_users",array("class"=>"jaddusers_update","onsubmit"=>"return kpay.admin.userz.update_user_form('/admin/users/update_users/','".itoken_cookie()."');"));?>
		<table>
			<tbody>
				<tr>
					<td style="width:155px">Name:</td>
					<td>
					<input type="hidden" name="account_id" id="edit_account_id" value="" readonly="readonly"/>
					<input type="hidden"  readonly="readonly"  value="" name="edit_owner_id" id="edit_owner_id" class="txtfield">
					<input type="hidden" name="account_id" id="edit_account_id" value="" readonly="readonly"/>
					<input type="text"  value="" name="edit_owner" id="edit_owner" class="txtfield">
					<input type="hidden"  value="" name="edit_payroll_system_account_id" id="edit_payroll_system_account_id" class="txtfield">
					</td>
				</tr>
				<tr>
					<td>Email Address:</td>
					<td><input type="text" value="" name="edit_email" id="edit_email"  class="txtfield"></td>
					<td><input type="hidden" readonly="readonly" value="<?php echo set_value("email_address");?>" name="edit_old_email" id="edit_old_email"  class="txtfield"></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" value="" name="edit_pass" class="txtfield" id="edit_pass" ></td>
				</tr>
				<tr>
					<td>Confirm Password:</td>
					<td><input type="password" value="" name="edit_cpass" class="txtfield" id="edit_cpass"></td>
				</tr>	
			</tbody>
		</table>
		<input type="submit" name="update" value="Update" class="btn">
		<?php echo form_close();?>
	</div>
<!-- end updated user lightbox -->


<!-- lightbox success -->
<div class="ihide">
	<div class="success_add" title="Successfull Save">
		<p>Success you have added a user</p>
	</div>
	<div class="success_updated" title="Successfull Updated">
		<p>Success you have updated a user</p>
	</div>
</div>
<!-- end lightbox success -->

<script type="text/javascript">
	// ADD AN APPEND FORM
	function add_form(){
		jQuery(document).on('click',"#jlight_adduser",function(e){
			e.preventDefault();
			jQuery(".jadd_owner").fadeIn('slow');
			
				var html = '<tr>';
					html +='<td class="own_name"><input type="text" name="owners_name[]" class="owners_namecs"></td>';
					html +='<td>';
					html +='<ul class="complist"></ul>';
					html +='</td>';
					html +='<td><input type="text" name="owners_email[]" class="owners_namecs"></td>';
					html +='<td>';
					html +='<div class="disable disablethis">';
					html +='<a class="btn cbtnadd" href="#">VIEW</a>'; 
					html +='<a class="btn btn-gray btn-action" href="#">EDIT</a>'; 
					html +='<a class="btn btn-red btn-action jappend_delete" href="#">DELETE</a>';
					html +='</div>';
					html +='</td>';
					html +='</tr>';
					jQuery(".jusers_all").append(html);
		});
	}
	// DELETE THE FILE AND SHOW THE BUTTON IF HAVE VALUE IF NOT HIDDEN
	function delete_appendmore(){
		jQuery(document).on("click", ".jappend_delete", function (e) {
		    e.preventDefault();
		    jQuery(this).parents("tr").remove();

		    var ileft = jQuery(".jappend_delete").length;
		    if (ileft == 0) {
		        jQuery(".jadd_owner").hide();
		    } else {
		        jQuery(".jadd_owner").show();
		    }
		});
	}
	jQuery(function(){
		//kpay.admin.userz.show_add_form();
		kpay.admin.userz.delete_users('/admin/users/delete_user',"<?php echo itoken_cookie();?>");	
		kpay.admin.userz.update_user('/admin/users/show_edit_user',"<?php echo itoken_cookie();?>");
		add_form();
		delete_appendmore();
	});
</script>


