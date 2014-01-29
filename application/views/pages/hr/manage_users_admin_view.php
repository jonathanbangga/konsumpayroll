<br />
<h1><?php echo $page_title;?></h1>

<p>
<input type="submit" class="btn itab" id="jshow_admin" value="ADMIN" onclick="return false;">
<input type="submit" class="btn itab" id="jshow_users" value="EMPLOYEE" onclick="return false;">
</p>
<div class="error_msg_cont" id="jerror_admin"></div>

<div class="show_users">
	<div class="tbl-wrap">	
		<div class="successContBox ihide"></div>
		<?php echo form_open("",array("onsubmit"=>"return save_users();"));?>
		<!-- TBL-WRAP START -->
		<table class="tbl emp_users_list" style="width:100%;">
			<tbody>
				<tr>
					<th style="width:50px;">Line</th>
					<th style="width:100px;">Employee ID</th>
					<th style="width:170px;">Employee Name</th>
					<th style="width:170px;">Email Address</th>
					<th style="width:170px;">Roles</th>
					<th style="width:170px">Action</th>
				</tr>
				<?php 
					if($approvers_list){
						foreach($approvers_list as $key=>$approvers):
				?>
				<tr>
					<td><?php echo ($this->uri->segment(5))? $key+$this->uri->segment(5)+4:$key+1;?></td>
					<td><div class="users_text"><?php echo $approvers->payroll_cloud_id;?></div></td>
					<td>
						<input type="hidden" id="account_id" name="update_account_id" value="<?php echo base64_encode($approvers->account_id);?>">
						<div class="users_text"><?php echo $approvers->first_name." ".$approvers->last_name;?></div>
					</td>
					<td>
					<input type="hidden" name="update_email[]" value="<?php echo $approvers->email;?>" class="inp_user">
					<div class="users_text"><?php echo $approvers->email;?></div></td>
					<td>
						<?php 
							$permission_list =  $this->users->permission_define($company_info->company_id,$approvers->account_id);		
							if($permission_list){
								echo $permission_list->roles;	
							}
						?>
					</td>
					<td> 
					<a class="btn btn-gray btn-action jmanageinvite_users" href="javascript:void(0);" invite_approvers="<?php echo $approvers->account_id;?>">INVITE</a>
					<a class="btn btn-gray btn-action jmanage_users" href="javascript:void(0);" edit_approvers="<?php echo $approvers->account_id;?>" >EDIT</a> </td>
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
		<!-- <a id="add-more-users" href="javascript:void(0);" class="btn">ADD USERS</a> -->
		<input type="button" onclick="return false;" id="add-more-users"  name="add" value="ADD USERS" class="btn" />
		<input type="submit" name="save" value="SAVE" class="btn ihide" />
	</div>
	<div class="right pagi-rights"><?php  echo $pagi;?></div>
	<p>&nbsp;</p>
	<?php echo form_close();?>
</div>	
<!-- emploeee details -->
	<div class="show_employee ihide"> 
	<?php echo form_open($this->uri->segment(1)."/hr/users/add_employee",array("onsubmit"=>"return add_normal_employe();","id"=>"j_addemployee_form"));?>
		<table class="tbl emp_employee_list" style="width:100%">
			<tbody>
				<tr>
					<th style="width:50px;">Line</th>
					<th>Employee ID</th>
					<th>Employee First Name</th>
					<th>Employee Middle Name</th>
					<th>Employee Last Name</th>
					<th>Email Address</th>
					<th style="width:80px">Action</th>
				</tr>
				<?php

					if($normal_employee){ 
						foreach($normal_employee as $ne_key=>$ne_val):
				?>
				<tr>
					<td><?php echo ($ne_key++)+1;?></td>
					<td>
						<div class="users_textemp"><?php echo $ne_val->payroll_cloud_id;?></div>
					</td>
					<td>
						<input type="hidden" value="<?php echo $ne_val->account_id;?>" name="admin_category_account_id" id="admin_category_account_id">
						<div class="users_textemp"><?php echo $ne_val->first_name;?></div>
					</td>
					<td>
						
						<div class="users_textemp"><?php echo $ne_val->middle_name;?></div>
					</td>
					<td>
						
						<div class="users_textemp"><?php echo $ne_val->last_name." ".$ne_val->last_name;?></div>
					</td>
					<td>
						<input type="hidden" class="inp_user" value="<?php echo $ne_val->email;?>" name="admin_category_email[]">
						<div class="users_textemp"><?php echo $ne_val->email;?></div>
					</td>
					<td>
						<a invite_approvers="<?php echo $ne_val->account_id;?>" href="javascript:void(0);" class="btn btn-gray btn-action jmanageinvite_users">INVITE</a>
						<!--<a edit_approvers="46" href="javascript:void(0);" class="btn btn-gray btn-action jmanage_users">EDIT</a> -->
					</td>
				</tr>
				<?php	
						endforeach;
					} 
				?>	
			</tbody>
		</table>
		<div class="left pagi-lefts">
			<br />
			<input type="button" onclick="return false;" id="add-more-employee"  name="add" value="ADD EMPLOYEE" class="btn" />
			<input type="submit" name="save_employee" value="SAVE" class="btn ihide" />
		</div>
	<?php echo form_close();?>
	</div>
<!-- end employee details -->
	
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
		$options = "<option value=\"\">Please select roles</option>";
		if($approval_process){
			foreach($approval_process as $key_permission=>$val_permission){
				$options .='<option value="'.$val_permission->approval_process_id.'">'.$val_permission->name.'</option>';	
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
		
		// ADD NORMAL EMPLOYEE
		function add_normal_employe(){
			var npci = array_fields("input[name='normal_payroll_cloud_id[]']");
			var nef = array_fields("input[name='normal_employee_firstname[]']");
			var nem = array_fields("input[name='normal_employee_middlename[]']");
			var nel = array_fields("input[name='normal_employee_lastname[]']");
			var ne = array_fields("input[name='normal_email[]']");

			var ifield_employee = {
				"normal_payroll_cloud_id[]":npci,
				"normal_employee_firstname[]":nef,
				"normal_employee_middlename[]":nem,
				"normal_employee_lastname[]":nel,
				"normal_email[]":ne,
				"ZGlldmlyZ2luamM":jQuery.cookie(itokens),
				"save_employee":"true"
			};

			ierror_field("input[name='normal_payroll_cloud_id[]']");
			ierror_field("input[name='normal_email[]']");
			ierror_email("input[name='normal_email[]']");
			ierror_field("input[name='normal_employee_firstname[]']");		
			ierror_field("input[name='normal_employee_middlename[]']");		
			ierror_field("input[name='normal_employee_lastname[]']");		
			ierror_duplicate("input[name='normal_payroll_cloud_id[]']");
			ierror_duplicate("input[name='normal_email[]']");
			ierror_emp_minlength("input[name='normal_payroll_cloud_id[]']");
	
			var why_pcid = "";
			var why_efn	= "";
			var why_eln	= "";
			var why_emn	= "";
			var why_email = "";
			var why_email_invalid = "";
			var why_emp_length = ""; // must have employee id atleast 10 above
			var why = "";
			
			for(var field_data=0;field_data<=$("input[name='normal_payroll_cloud_id[]']").length;field_data++){ // a = dummy
				var mark_pcid = jQuery("input[name='normal_payroll_cloud_id[]']").eq(field_data).val();
				var mark_efn = jQuery("input[name='normal_employee_firstname[]']").eq(field_data).val();
				var mark_emn = jQuery("input[name='normal_employee_middlename[]']").eq(field_data).val();
				var mark_eln = jQuery("input[name='normal_employee_lastname[]']").eq(field_data).val();
				var mark_email = jQuery("input[name='normal_email[]']").eq(field_data).val();	
				if(mark_email !=""){
					if(check_emailski(mark_email) == false){
						why_email_invalid = 1;
					}
				}
				if(mark_pcid == "") why_pcid = 1;
				if(mark_efn == "") why_efn = 1;
				if(mark_eln == "") why_eln = 1;
				if(mark_emn == "") why_emn = 1;
				if(mark_email == "") why_email = 1;
			}
			
			if(why_pcid != "") why += "<p>- Please enter Employee Number</p>";
			if(why_emp_length !="") why += "<p>- Please enter Employee Numbe minimum of 10</p>";
			if(why_efn != "") why += "<p>- Please enter Employee First Name</p>";
			if(why_eln != "") why += "<p>- Please enter Employee Last Name</p>";
			if(why_emn != "") why += "<p>- Please enter Employee Middle Name</p>";
			if(why_email != "") why += "<p>- Please enter Employee Email Address</p>";			
			//if(why_email_invalid !="") why +="<p>- Please enter valid Employee Email Address</p>";
			
			if(why !=""){
				var ierror_zon = jQuery("#jerror_admin").offset().top;
				jQuery("html,body").animate({scrollTop:ierror_zon},"slow");
				jQuery("#jerror_admin").html(why);
				return false;
			}else{
				jQuery("#jerror_admin").html('');
			}
				
			if(ierror_mark(".inp_useremp") > 0){
				
			}else{
			
				var urls = jQuery("form[id^='j_addemployee_form']").attr("action");	
				jQuery.post(urls,ifield_employee,function(json){
					var res = jQuery.parseJSON(json);	
					if(res.success == '0'){
						alert(res.error);
					}else{
						jQuery(".success_messages").empty().html("<p>You have Successfully added</p>");
						kpay.overall.show_success(".success_messages");					
					}
				});				
				console.log(ifield_employee);
				return false;
			}
			return false;
		}
		
		// CHECKS EMAIL ACCOUNT
		function check_emails_existed(){
			jQuery(document).on("keyup","input[name='normal_email[]']",function(e){
				var el = jQuery(this);
				var index = jQuery("input[name='normal_email[]']").index(this);
				var urls = "/<?php echo $this->uri->segment(1);?>/hr/users/ajax_check_email";
				var val = jQuery("input[name='normal_email[]']").eq(index).val();
				var fields = {
					"email":val,
					"ZGlldmlyZ2luamM":jQuery.cookie(itokens),
				};
					jQuery.post(urls,fields,function(json){
						var res = jQuery.parseJSON(json);	
						 if(res.existings == 1){
							el.addClass("emp_str");
							alert("Email Account is already existed");
						 }else{
							el.removeClass("emp_str");
						 }	
					});		
			});
		}
		
		// EXISTING EMPLOYEE ID
		function check_emp_id(){
			jQuery(document).on("keyup","input[name='normal_payroll_cloud_id[]']",function(e){
				var el = jQuery(this);
				var index = jQuery("input[name='normal_payroll_cloud_id[]']").index(this);
				var urls = "/<?php echo $this->uri->segment(1);?>/hr/users/ajax_check_employee_id";
				var val = jQuery("input[name='normal_payroll_cloud_id[]']").eq(index).val();
				var fields = {
					"check_employee_id":val,
					"ZGlldmlyZ2luamM":jQuery.cookie(itokens),
				};
					jQuery.post(urls,fields,function(json){
						var res = jQuery.parseJSON(json);	
						 if(res.existings == 1){
							el.addClass("emp_str");
						 }else{
							el.removeClass("emp_str");
						 }	
					});		
			});
		}
		
		// ADD USERS
		function add_users(){
			var $select_options = '<?php echo $options;?>';
			jQuery(document).on("click","#add-more-users",function(){
			    var html = '<tr>';
				    html +='<td><div class="add_quad"></div></td>';
				    html +='<td><input type="text" class="inp_user txtfield" name="payroll_cloud_id[]"></td>';
				    html +='<td><input type="text" class="inp_user txtfield" name="employee_fullname[]"></td>';
				    html +='<td><input type="text" class="inp_user txtfield" name="email[]"></td>';
				//    html +='<td><input type="text" class="inp_user" name="middle_name[]"></td>';
				//    html +='<td><input type="text" class="inp_user" name="last_name[]"></td>';    
				//    html +='<td style="display:none;"><input type="hidden" class="inp_user" name="payroll_groups[]">';
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
		
		// ADD NORMAL EMPLOYEE
		function add_normal_employee(){
			jQuery(document).on("click","#add-more-employee",function(e){
				e.preventDefault();
				var el = jQuery(this);
				var quad = jQuery(".emp_employee_list tr").length; 
				var html = '<tr>';
				    html +='<td><div class="add_empl">'+quad+'</div></td>';
				    html +='<td><input type="text" class="inp_useremp txtfield" name="normal_payroll_cloud_id[]"></td>';
				    html +='<td><input type="text" class="inp_useremp txtfield" name="normal_employee_firstname[]"></td>';
				    html +='<td><input type="text" class="inp_useremp txtfield" name="normal_employee_middlename[]"></td>';
				    html +='<td><input type="text" class="inp_useremp txtfield" name="normal_employee_lastname[]"></td>';
				    html +='<td><input type="text" class="inp_useremp txtfield" name="normal_email[]"></td>';
				    html +='<td><a href="#" class="btn btn-red btn-action jdel_users_append">REMOVE</a></td>';
				    html +='</tr>'; 				
					jQuery(".emp_employee_list").append(html);
					jQuery("input[name='save_employee']").show();
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
			var urls = "/<?php echo $this->uri->segment(1);?>/hr/users/add_admin";
			var payroll_cloud_id = array_fields("input[name='payroll_cloud_id[]']");
			var email = array_fields("input[name='email[]']");
			var employee_fullname = array_fields("input[name='employee_fullname[]']");
			var permission = array_fields("select[name='permission[]']");
			ierror_field("input[name='payroll_cloud_id[]']");
			ierror_field("input[name='email[]']");
			ierror_field("input[name='employee_fullname[]']");		
			ierror_duplicate("input[name='payroll_cloud_id[]']");
			ierror_duplicate("input[name='email[]']");
			
			var why_pcid = "";
			var why_efn	= "";
			var why_email = "";
			var why_roles = "";
			var why = "";
			
			for(var field_data=0;field_data<=$("input[name='payroll_cloud_id[]']").length;field_data++){ // a = dummy
				var mark_pcid = jQuery("input[name='payroll_cloud_id[]']").eq(field_data).val();
				var mark_efn =  jQuery("input[name='employee_fullname[]']").eq(field_data).val();
				var mark_email =  jQuery("input[name='email[]']").eq(field_data).val();	
				if(mark_pcid == "") why_pcid = 1;
				if(mark_efn == "") why_efn = 1;
				if(mark_email == "") why_email = 1;
			}
			if(why_pcid != "") why += "<p>- Please enter Employee Number</p>";
			if(why_efn != "") why += "<p>- Please enter Employee FullName</p>";
			if(why_email != "") why += "<p>- Please enter Employee Email Address</p>";
		
			if(why !=""){
				jQuery("#jerror_admin").html(why);
				return false;
			}else{
					jQuery("#jerror_admin").html('');
			}
			
			if(ierror_mark(".inp_user") > 0){
				
			}else{
				var fields = {
						"payroll_cloud_id[]":payroll_cloud_id,
						"email[]":email,
						"employee_fullname[]":employee_fullname,
						"permission[]":permission,
						"ZGlldmlyZ2luamM":jQuery.cookie(itokens),
						"save":"true"
				};
				jQuery.post(urls,fields,function(json){
					var res = jQuery.parseJSON(json);	
					if(res.success == '0'){
						alert(res.error);
					}else{
						jQuery(".success_messages").empty().html("<p>You have Successfully added</p>");
						kpay.overall.show_success(".success_messages");
					}
				});			
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
		
		// SHOW HIDE USER AND ADMIN 
		function showhide_users_admin(){
			jQuery(document).on("click","#jshow_admin",function(e){
				e.preventDefault();
				jQuery(".show_employee").css('display','none');
				jQuery(".show_users").css('display','block');
				jQuery("#jerror_admin").html('');
			});
			jQuery(document).on("click","#jshow_users",function(e){
				e.preventDefault();
				jQuery(".show_employee").css('display','block');
				jQuery(".show_users").css('display','none');
				jQuery("#jerror_admin").html('');
			});
		}
		
		// SEND INVITES
		function send_invites(){
			jQuery(document).on("click",".jmanageinvite_users",function(e){
				e.preventDefault();
				var el = jQuery(this);
				var invite_approvers = el.attr("invite_approvers");
				
				jQuery(".option_alert").html("Are you sure you want to sent an invite on this user?");
					jQuery(".option_alert").dialog({
						resizable: false,
						height: 150,
						modal: true,
						buttons: {
							"Yes": function () {
								var urls = "/<?php echo $this->uri->segment(1);?>/hr/users/ajax_send_invite";
								var fields = {
								   "invite_id":invite_approvers,
								   "ZGlldmlyZ2luamM":jQuery.cookie(itokens),					
								};
								jQuery.post(urls,fields,function(json){
									var res = jQuery.parseJSON(json);	
									jQuery(".option_alert").dialog("close");
									
								});		
							},
							No: function () {
								jQuery(".option_alert").dialog("close");
							}
						}
					});						
				
				
				
			});
		}
		
		jQuery(function(){
			add_users();
			delete_users();
			search_name();
			clear_payroll_group();
			edit_users();
			showhide_users_admin();
			send_invites();
			add_normal_employee();
			check_emails_existed(); // CHECKS EMAILs
			check_emp_id(); // CHECK employee id
		});
	</script>