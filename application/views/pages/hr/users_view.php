	<div class="tbl-wrap">	
		<div class="successContBox ihide"></div>
		<!-- TBL-WRAP START -->
		<table class="tbl emp_users_list" style="width:1610px;">
			<tbody>
				<tr>
					<th style="width:50px;">Line</th>
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
						foreach($approvers_list as $approvers):
				?>
				<tr>
					<td></td>
					<td>
						<input type="hidden" id="account_id" name="account_id" value="<?php echo base64_encode($approvers->account_id);?>">
						<input type="text" name="email[]" value="<?php echo $approvers->email;?>" class="inp_user">
					</td>
					<td><input type="text" name="first_name[]" value="<?php echo $approvers->first_name;?>" class="inp_user"></td>
					<td><input type="text" name="middle_name[]" value="<?php echo $approvers->middle_name;?>" class="inp_user"></td>
					<td><input type="text" name="last_name[]" value="<?php echo $approvers->last_name;?>" class="inp_user"></td>
					<td><input type="text" name="password[]" class="inp_user"></td>
					<td><input type="text" name="retype_password[]" class="inp_user"></td>
					<td><input type="text" name="payroll_group[]" class="inp_user"></td>
					<td><input type="text" class="inp_user"></td>
					<td><a class="btn btn-red btn-action jdel_the_users" href="#">DELETE</a></td>
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
	<p>
	<a id="add-more-users" href="javascript:void(0);" class="btn">ADD USERS</a>
	<input type="submit" name="save" value="SAVE" class="btn" />
	</p>
	<p>&nbsp;</p>
	<div class="footer-grp-btn">
	<!-- FOOTER-GRP-BTN START -->
	<a href="/company/hr_setup/locations" class="btn btn-gray left">BACK</a> <a href="/company/hr_setup/leaves" class="btn btn-gray right"> CONTINUE</a>
	<!-- FOOTER-GRP-BTN END -->
	</div>
	
	<script type="text/javascript">
		function add_users(){
			jQuery(document).on("click","#add-more-users",function(){
			    var html = '<tr>';
			    html +='<td></td>';
			    html +='<td><input type="text" class="inp_user" name="email[]"></td>';
			    html +='<td><input type="text" class="inp_user" name="full_name[]"></td>';
			    html +='<td><input type="text" class="inp_user" name="password[]"></td>';
			    html +='<td><input type="text" class="inp_user" name="retype_password[]"></td>';
			    html +='<td><input type="text" class="inp_user" name="payroll_group[]"></td>';
			    html +='<td><input type="text" class="inp_user"></td>';
			    html +='<td><a href="#" class="btn btn-red btn-action jdel_the_users">DELETE</a></td>';
			    html +='</tr>';
			    jQuery(".emp_users_list").append(html);
			});
		}

		jQuery(function(){
			add_users();
		});
	
	</script>