<?php print form_open('','onsubmit="return validateEmployee()"');?>
	<h1><?php print $page_title;?></h1>
	<p>Last Name <input type="text" id="lname" name="lname" value="<?php print $my_profile->lname;?>" /></p>
	<p>First Name <input type="text" id="fname" name="fname" value="<?php print $my_profile->fname;?>" /></p>
	<p>Middle Name <input type="text" id="mname" name="mname" value="<?php print $my_profile->mname;?>" /></p>
	<p>Birth Date <input type="text" id="dob" name="dob" value="<?php print $my_profile->dob;?>" /></p>
	
	<h1>Contact Information</h1>
	<p>Mobile Number <input type="text" id="mobile_no" name="mobile_no" value="<?php print $my_profile->mobile_no;?>" /></p>
	<p>Home Number <input type="text" id="home_no" name="home_no" value="<?php print $my_profile->home_no;?>" /></p>
	<p>Email <input type="text" id="emailaddress" name="emailaddress" value="<?php print $my_profile->email;?>" /></p>
	<p>Home Address <input type="text" id="address" name="address" value="<?php print $my_profile->address;?>" /></p>
	<p>Emergency Contact Person <input type="text" id="emergency_contact_person" name="emergency_contact_person" value="<?php print $my_profile->emergency_contact_person;?>" /></p>
	<p>Emergency Contact Number <input type="text" id="emergency_contact_number" name="emergency_contact_number" value="<?php print $my_profile->emergency_contact_number;?>" /></p>
	
	<h1>Payroll Information</h1>
	<p>Payroll ID <input type="text" id="username" name="username" value="<?php print $my_profile->payroll_cloud_id;?>" /></p>
	<p>Old Password <input type="password" id="old_pass" name="old_pass" value="" /></p>
	<p>New Password <input type="password" id="new_pass" name="new_pass" value="" /></p>
	<p>Re-type Password <input type="password" id="confirmpass" name="confirmpass" value="" /></p>
	
	<p><input type="submit" class="btn" value="SAVE CHANGES" name="save" /></p>
	
	<script>
		function validateEmployee(){
			var fname = jQuery("#fname").val();
			var mname = jQuery("#mname").val();
			var lname = jQuery("#lname").val();
			var emailaddress = jQuery("#emailaddress").val();
			var dob = jQuery("#dob").val();
			var address = jQuery("#address").val();
			var mobile_no = jQuery("#mobile_no").val();
			var home_no = jQuery("#home_no").val();
			var emergency_contact_person = jQuery("#emergency_contact_person").val();
			var emergency_contact_number = jQuery("#emergency_contact_number").val();
			var username = jQuery("#username").val();
			var old_pass = jQuery("#old_pass").val();
			var new_pass = jQuery("#new_pass").val();
			var confirmpass = jQuery("#confirmpass").val();

			var urls = window.location.href;
			$.ajax({
				url:urls,
				type: "POST",
				data:{
				   'save':'true',
				   'fname':fname,
				   'mname':mname,
				   'lname':lname,
				   'dob':dob,
				   'mobile_no':mobile_no,
				   'home_no':home_no,
				   'emailaddress':emailaddress,
				   'address':address,
				   'emergency_contact_person':emergency_contact_person,
				   'emergency_contact_number':emergency_contact_number,
				   'username':username,
				   'old_pass':old_pass,
				   'new_pass':new_pass,
				   'confirmpass':confirmpass,
				   'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
				},
				success: function (data){
    				var status = jQuery.parseJSON(data);
					if(status.success == '1') {
						jQuery("body").append("<div class='success_add' title='Information'>Successfully updated</div>");
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
					}else{
        				alert(status.error_msg);
						return false;
					}
				}
			});
			return false;
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
		
		jQuery(function(){
			dob_datepicker();
		})
		
	</script>
		
</form>