<?php echo validation_errors();?>
<?php echo form_open("login/index");?>
<table>
	<tr>
		<td>Username</td>
		<td><input type="text" name="username"></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="password" name="password"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="login" value="Login"></td>
	</tr>
</table>
<?php echo form_close();?>