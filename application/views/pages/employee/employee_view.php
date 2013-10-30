<div class="tbl-wrap">
<?php
	print $this->session->userdata('account_id')."<br /><br />"; 
	if($employee_list != NULL){
		foreach($employee_list as $row){
			$fname = ucwords($row->fname);
			$lname = ucwords($row->lname);
			print "<p>{$fname} {$lname} <a href=''>edit</a> <a href='javascript:void(0);' class='delBtn_user' attr_userid={$row->account_id} attr_username='{$fname} {$lname}'>delete</a></p>";
		}
	}
?>
<?php print form_open('','onsubmit="return validateEmployee()"');?>
	<div class="successContBox" style="display:none;"><?php print $this->session->flashdata('message');?></div>
	company_id<input type="text" id="company_id" name="company_id" /> <br />
	Rank
	<select id="rank_id" name="rank_id">
		  <option value="" selected="selected">Please select Rank</option>
		  	<?php 
		  		if($rank!=NULL){
		  			foreach($rank as $row):
		  				print "<option value='{$row->rank_id}' name='rank_id' ".set_select('rank_id', $row->rank_id).">".ucwords($row->rank_name)."</option>";
	  				endforeach;
		  		}else{
		  			print "<option value='' name='rank_id'>There are no ranks found</option>";
		  		}
		  	?>
	</select>
	<br />
	Department 
	<select id="dept_id" name="dept_id">
		  <option value="" selected="selected">Please select Department</option>
		  	<?php 
		  		if($dept!=NULL){
		  			foreach($dept as $row):
		  				print "<option value='{$row->dept_id}' name='dept_id' ".set_select('dept_id', $row->dept_id).">".ucwords($row->department_name)."</option>";
	  				endforeach;
		  		}else{
		  			print "<option value='' name='dept_id'>No department</option>";
		  		}
		  	?>
	</select>
	<br />
	Location 
	<select id="location_id" name="location_id">
		  <option value="" selected="selected">Please select Location</option>
		  	<?php 
		  		if($location!=NULL){
		  			foreach($location as $row):
		  				print "<option value='{$row->location_id}' name='location_id' ".set_select('location_id', $row->location_id).">".ucwords($row->location_name)."</option>";
	  				endforeach;
		  		}else{
		  			print "<option value='' name='location_id'>No location</option>";
		  		}
		  	?>
	</select>
	<br />
	fname<input type="text" id="fname" name="fname" /> <br />
	mname<input type="text" id="mname" name="mname" /> <br />
	lname<input type="text" id="lname" name="lname" /> <br />
	emailaddress<input type="text" id="emailaddress" name="emailaddress" /> <br />
	dob<input type="text" id="dob" name="dob" /> <br />
	gender<input type="text" id="gender" name="gender" /> <br />
	marital_status<input type="text" id="marital_status" name="marital_status" /> <br />
	address<input type="text" id="address" name="address" /> <br />
	<br />
	Mobile Number<input type="text" id="mobile_no" name="mobile_no" /> <br />
	Home Number<input type="text" id="home_no" name="home_no" /> <br />
	photo<input type="text" id="photo" name="photo" /> <br />
	tin<input type="text" id="tin" name="tin" /> <br />
	sss<input type="text" id="sss" name="sss" /> <br />
	phil_health<input type="text" id="phil_health" name="phil_health" /> <br />
	gsis<input type="text" id="gsis" name="gsis" /> <br />
 	hdmf<input type="text" id="hdmf" name="hdmf" /> <br />
	emergency_contact_person<input type="text" id="emergency_contact_person" name="emergency_contact_person" /> <br />
	emergency_contact_number<input type="text" id="emergency_contact_number" name="emergency_contact_number" /> <br />
	Position 
	<select id="position_id" name="position_id">
		  <option value="" selected="selected">Please select Position</option>
		  	<?php 
		  		if($position!=NULL){
		  			foreach($position as $row):
		  				print "<option value='{$row->position_id}' name='position_id' ".set_select('position_id', $row->position_id).">".ucwords($row->position_name)."</option>";
	  				endforeach;
		  		}else{
		  			print "<option value='' name='position_id'>No Position</option>";
		  		}
		  	?>
	</select>
	<br />
	Payroll Group 
	<select id="payroll_group_id" name="payroll_group_id">
		  <option value="" selected="selected">Please select Payroll Group</option>
		  	<?php 
		  		if($payroll_group!=NULL){
		  			foreach($payroll_group as $row):
		  				print "<option value='{$row->payroll_group_id}' name='payroll_group_id' ".set_select('payroll_group_id', $row->payroll_group_id).">".ucwords($row->payroll_group_name)."</option>";
	  				endforeach;
		  		}else{
		  			print "<option value='' name='payroll_group_id'>No Payroll Group</option>";
		  		}
		  	?>
	</select>
	<br />
	<br />
	username<input type="text" id="username" name="username" /> <br />
	password<input type="password" id="password" name="password" /> <br />
	confirmpass<input type="password" id="confirmpass" name="confirmpass" /> <br />
	Permission 
	<select id="permission" name="permission">
		  <option value="" selected="selected">Please select Permission</option>
		  	<?php 
		  		if($permission!=NULL){
		  			foreach($permission as $row):
		  				print "<option value='{$row->permission_id}' name='permission' ".set_select('permission', $row->permission_id).">".ucwords($row->permission_type_name)."</option>";
	  				endforeach;
		  		}else{
		  			print "<option value='' name='permission'>No Permission</option>";
		  		}
		  	?>
	</select>
	<br />
	<br />
	<input type="submit" class="btn" value="SAVE" name="save" />
	<script>
		function validateEmployee(){
			//var why = "";
	
			var company_id = jQuery("#company_id").val();
			var rank_id = jQuery("#rank_id").val();
			var dept_id = jQuery("#dept_id").val();
			var location_id = jQuery("#location_id").val();
			var fname = jQuery("#fname").val();
			var mname = jQuery("#mname").val();
			var lname = jQuery("#lname").val();
			var emailaddress = jQuery("#emailaddress").val();
			var dob = jQuery("#dob").val();
			var marital_status = jQuery("#marital_status").val();
			var address = jQuery("#address").val();
			var mobile_no = jQuery("#mobile_no").val();
			var home_no = jQuery("#home_no").val();
			var tin = jQuery("#tin").val();
			var sss = jQuery("#sss").val();
			var phil_health = jQuery("#phil_health").val();
			var gsis = jQuery("#gsis").val();
			var hdmf = jQuery("#hdmf").val();
			var emergency_contact_person = jQuery("#emergency_contact_person").val();
			var emergency_contact_number = jQuery("#emergency_contact_number").val();
			var position_id = jQuery("#position_id").val();
			var username = jQuery("#username").val();
			var password = jQuery("#password").val();
			var confirmpass = jQuery("#confirmpass").val();
			var permission = jQuery("#permission").val();
			var payroll_group_id = jQuery("#payroll_group_id").val();
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			
			/*if(company_id=="") why += "- Please enter Company <br />";
			if(rank_id=="") why += "- Please enter Rank <br />";
			if(dept_id=="") why += "- Please enter Depertment <br />";
			if(location_id=="") why += "- Please enter Location <br />";
			if(fname=="") why += "- Please enter Firstname <br />";
			if(mname=="") why += "- Please enter Middlename <br />";
			if(lname=="") why += "- Please enter Lastname <br />";
			if(emailaddress==""){
				why += "- Please enter Email Address <br />";
			}else if(!emailReg.test(emailaddress)){
				why += "- The Email Address field must contain a valid email address <br />";
			}
			if(dob=="") why += "- Please enter Date of birth <br />";
			if(marital_status=="") why += "- Please enter Marital Status <br />";
			if(contact_no=="") why += "- Please enter Contact Number <br />";
			if(tin=="") why += "- Please enter TIN <br />";
			if(sss=="") why += "- Please enter SSS <br />";
			if(phil_health=="") why += "- Please enter PhilHealth <br />";
			if(gsis=="") why += "- Please enter GSIS <br />";
			if(emergency_contact_person=="") why += "- Please enter Emergency Contact Person <br />";
			if(emergency_contact_number=="") why += "- Please enter Emergency Contact Number <br />";
			if(position_id=="") why += "- Please enter Position ID <br />";
			if(username=="") why += "- Please enter Username <br />";
			if(password==""){
				why += "- Please enter Password <br />";
			}else if(password != confirmpass){
				why += "- The password field must match the password confirmation field";
			}
			if(access_level=="") why += "- Please enter Permission <br />";
			if(payroll_group_id=="") why += "- Please enter Payroll Group <br />";
			
			if(why!=""){
				alert(why);
				return false;
			}else{*/
				var urls = window.location.href;
				$.ajax({
					url:urls,
					type: "POST",
					data:{
						'company_id':company_id,
						'rank_id':rank_id,
						'dept_id':dept_id,
						'location_id':location_id,
						'fname':fname,
						'mname':mname,
						'lname':lname,
						'emailaddress':emailaddress,
						'dob':dob,
						'marital_status':marital_status,
						'address':address,
						'mobile_no':mobile_no,
						'home_no':home_no,
						'tin':tin,
						'sss':sss,
						'phil_health':phil_health,
						'gsis':gsis,
						'hdmf':hdmf,
						'emergency_contact_person':emergency_contact_person,
						'emergency_contact_number':emergency_contact_number,
						'position_id':position_id,
						'username':username,
						'password':password,
						'confirmpass':confirmpass,
						'permission':permission,
						'payroll_group_id':payroll_group_id,
						'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
						'save':'true'
						},success: function(data) {
							var status = jQuery.parseJSON(data);
							if(status.success == '1') {
								jQuery("body").append("<div class='success_add' title='Information'>Successfully saved</div>");
								jQuery(".success_add").dialog({
									width: 'inherit',
								   draggable: false,
								   modal: true,
								   dialogClass:'transparent',
								   overlay: {opacity: 0 },
									close: function() {
										window.location.href = urls;
									},
									buttons:{
										"Close": function (){
											window.location.href = urls;
										}
									}
								});
								return false;
							} else {
								alert(status.error_msg);
								return false;
							}
						}
				});
				return false;
			//}
		}

		function _successContBox(){
			var successContBox = jQuery.trim(jQuery(".successContBox").text());
			if(successContBox != ""){
			    jQuery(".successContBox").css("display","block");
			    setTimeout(function(){
			        jQuery(".successContBox").fadeOut('100');
			    },3000);
			}
		}

		function dob_datepicker(){
			jQuery("#dob").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd',
				maxDate: 0,
				yearRange: "-100:+0"
			});
		}

		function delete_user(){
			jQuery(".delBtn_user").click(function(){
				var _this = jQuery(this);
				var emp_name = jQuery(this).attr("attr_username");
				jQuery("body").append("<div class='del_msg' title='Confirmation'>Do you really want to delete user "+emp_name+"?</div>");
				jQuery(".del_msg").dialog({
				   width: 'inherit',
				   draggable: false,
				   modal: true,
				   dialogClass:'transparent',
				   overlay: {opacity: 0 },
				   close: function() {
					   jQuery(".del_msg").dialog('close').remove();
					},
					buttons:{
						"Yes": function (){
							var redirect = window.location.href,
						    user_id = _this.attr("attr_userid"),
						    urls = redirect+"/delete_user";
			                $.ajax({
								url:urls,
								type: "POST",
								data:{
									'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
									'user_id':user_id
									},success: function(data) {
										jQuery(".del_msg").dialog('close');
										jQuery("body").append("<div class='success_add' title='Information'>Successfully deleted</div>");
										jQuery(".success_add").dialog({
											width: 'inherit',
										   draggable: false,
										   modal: true,
										   dialogClass:'transparent',
										   overlay: {opacity: 0 },
											close: function() {
												window.location.href = urls;
											},
											buttons:{
												"Close": function (){
													window.location.href = window.location.href
												}
											}
										});
										return false;
									}
							});
						},
						'No': function() {
							$( this ).dialog( "close" );
						}
					}
				});
			});
		}
		
		jQuery(function(){
			_successContBox();
			dob_datepicker();
			delete_user();
		});
	</script>
<?php print form_close();?>
<br />
<br />
<br />
</div>