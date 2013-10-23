<html>
<?php echo form_open("login/validate_login");?>
<table>
	<tr>
		<td colspan="2" style="text-align: center;">
			<img src="/assets/images/img-logo2.jpg" />
		</td>
	</tr>
	<tr>
		<td>Payroll Cloud ID:</td><td><input type="text" name="user" /></td>
	</tr>
	<tr>
		<td>Password:</td><td><input type="password" name="pass" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="login" /></td>
	</tr>
</table>

<?php echo form_close();?>
</html>