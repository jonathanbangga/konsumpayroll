	<div class="tbl-wrap">	
		<div class="successContBox ihide"></div>
		<!-- TBL-WRAP START -->
		<table class="tbl emp_users_list" style="width:1610px;">
			<tbody>
				<tr>
					<th style="width:50px;">Line</th>
					<th style="width:170px;">Email</th>
					<th style="width:170px;">Account Name</th>
					<th style="width:170px;">Password</th>
					<th style="width:170px;">Retype password</th>
					<th style="width:170px;">Payroll Group</th>
					<th style="width:170px;">Permission</th>
					<th style="width:170px">Action</th>
				</tr>
			</tbody> 
		</table>
		<span class="ihides unameContBoxTrick"></span>
		<!-- TBL-WRAP END -->
	</div>
	<p>
	<a id="add-more-users" href="javascript:void(0);" class="btn">ADD USERS</a>
	<input type="submit" name="save_user" value="SAVE" class="btn" />
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
			    html +='<td><input type="text" class="inp_user"></td>';
			    html +='<td><input type="text" class="inp_user"></td>';
			    html +='<td><input type="text" class="inp_user"></td>';
			    html +='<td><input type="text" class="inp_user"></td>';
			    html +='<td><input type="text" class="inp_user"></td>';
			    html +='<td><input type="text" class="inp_user"></td>';
			    html +='<td><input type="text" class="inp_user"></td>';
			    html +='</tr>';
			    jQuery(".emp_users_list").append(html);
			});
		}

		jQuery(function(){
			add_users();
		});
	
	</script>