<?php print form_open('','onsubmit="return validateUser(this)"');?>
<table>
	<tr>
		<td style="width:130px;">Old Password</td>
		<td><input type="text" name="old_password" class="txtfield" id="old_password" /></td>
	</tr>
	<tr>
		<td>New Password</td>
		<td><input type="password" name="new_password" class="txtfield" id="new_password" /></td>
	</tr>
	<tr>
		<td>Confirm Password</td>
		<td><input type="password" name="confirm_password" class="txtfield" id="confirm_password" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="login" class="btn" value="Change password" /></td>
	</tr>
	
</table>
<script>
	function validateUser(){
		var why = "";
	
		var old_password = jQuery("#old_password").val();
		var password = jQuery("#new_password").val();
		var cpassword = jQuery("#confirm_password").val();
		if(old_password=="") why += "- Please enter Username <br />";
		if(password=="") why += "- Please enter Password <br />";
		if(why!=""){
			alert(why); 
			return false;
		}
	}
</script>
<?php echo form_close();?>