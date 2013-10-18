<?php print form_open('','onsubmit="return validateUser(this)"');?>
<table>
	<tr>
		<td>Username</td>
		<td><input type="text" name="username" id="username" /></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="password" name="password" id="password" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="login" value="Login" /></td>
	</tr>
	<?php print $msg_error;?>
</table>
<script>
	function validateUser(){
		var why = "";
	
		var username = jQuery("#username").val();
		var password = jQuery("#password").val();
		if(username=="") why += "- Please enter Username <br />";
		if(password=="") why += "- Please enter Password <br />";
		if(why!=""){
			alert(why); 
			return false;
		}
	}
</script>
<?php echo form_close();?>