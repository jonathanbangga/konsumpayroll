<?php 
	if($employee_list != NULL){
		foreach($employee_list as $row){
			print "<p>{$row->fname} {$row->mname} {$row->fname} <a href=''>edit</a> <a href=''>delete</a></p>";
		}
	}
?>
<?php print form_open('','onsubmit="return validateEmployee()"');?>
	<h1>Add Employee</h1>
	<div class="successContBox" style="display:none;"><?php print $this->session->flashdata('message');?></div>
	company_id<input type="text" id="company_id" name="company_id" /> <br />
	rank_id<input type="text" id="rank_id" name="rank_id" /> <br />
	dept_id<input type="text" id="dept_id" name="dept_id" /> <br />
	location_id<input type="text" id="location_id" name="location_id" /> <br />
	fname<input type="text" id="fname" name="fname" /> <br />
	mname<input type="text" id="mname" name="mname" /> <br />
	lname<input type="text" id="lname" name="lname" /> <br />
	emailaddress<input type="text" id="emailaddress" name="emailaddress" /> <br />
	dob<input type="text" id="dob" name="dob" /> <br />
	gender<input type="text" id="gender" name="gender" /> <br />
	marital_status<input type="text" id="marital_status" name="marital_status" /> <br />
	address<input type="text" id="address" name="address" /> <br />
	<br />
	contact_no<input type="text" id="contact_no" name="contact_no" /> <br />
	photo<input type="text" id="photo" name="photo" /> <br />
	tin<input type="text" id="tin" name="tin" /> <br />
	sss<input type="text" id="sss" name="sss" /> <br />
	phil_health<input type="text" id="phil_health" name="phil_health" /> <br />
	gsis<input type="text" id="gsis" name="gsis" /> <br />
	emergency_contact_person<input type="text" id="emergency_contact_person" name="emergency_contact_person" /> <br />
	emergency_contact_number<input type="text" id="emergency_contact_number" name="emergency_contact_number" /> <br />
	position_id<input type="text" id="position_id" name="position_id" /> <br />
	<br />
	username<input type="text" id="username" name="username" /> <br />
	password<input type="text" id="password" name="password" /> <br />
	confirmpass<input type="text" id="confirmpass" name="confirmpass" /> <br />
	permission<input type="text" id="access_level" name="access_level" /> <br />
	payroll_group_id<input type="text" id="payroll_group_id" name="payroll_group_id" /> <br />
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
			var contact_no = jQuery("#contact_no").val();
			var tin = jQuery("#tin").val();
			var sss = jQuery("#sss").val();
			var phil_health = jQuery("#phil_health").val();
			var gsis = jQuery("#gsis").val();
			var emergency_contact_person = jQuery("#emergency_contact_person").val();
			var emergency_contact_number = jQuery("#emergency_contact_number").val();
			var position_id = jQuery("#position_id").val();
			var username = jQuery("#username").val();
			var password = jQuery("#password").val();
			var confirmpass = jQuery("#confirmpass").val();
			var access_level = jQuery("#access_level").val();
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
						'contact_no':contact_no,
						'tin':tin,
						'sss':sss,
						'phil_health':phil_health,
						'gsis':gsis,
						'emergency_contact_person':emergency_contact_person,
						'emergency_contact_number':emergency_contact_number,
						'position_id':position_id,
						'username':username,
						'password':password,
						'confirmpass':confirmpass,
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

		jQuery(function(){
			_successContBox();
		});
	</script>
<?php print form_close();?>
<br />
<br />
<br />