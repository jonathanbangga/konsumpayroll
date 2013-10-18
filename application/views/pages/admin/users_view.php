<h1><?php echo $page_title;?></h1>
<table class="tbl jusers_all">
	<tbody>
		<tr>
			<th style="width: 213px;">Name</th>
			<th style="width: 363px;">Company Name</th>
			<th style="width: 215px;">Action</th>
		</tr>
		<?php 
		if($client_user) {
			foreach($client_user as $all_user): ?>
			<tr>
				<td class="own_name"><?php echo $all_user->owner_name;?></td>
				<td></td>
				<td>
					<a href="#" class="btn cbtnadd">VIEW</a> <a href="#" class="btn btn-gray btn-action">EDIT</a> <a href="#" class="btn btn-red btn-action">DELETE</a>
				</td>
			</tr>
		<?php	
			endforeach;
		}
		?>	
	</tbody>
</table>
<?php echo $pagi;?>

<div class="create_users_reg jreg" title="Add User">
	<div class="error_users"><ul><?php echo validation_errors('<li>','</li>');?></ul></div>
	<?php echo form_open("admin/users/all_users",array("class"=>"jaddusers"));?>
	<table>
		<tbody>
			<tr>
				<td style="width:155px">Name:</td>
				<td><input type="text"  value="" name="owner_name" class="txtfield"></td>
			</tr>
			<tr>
				<td>Email Address:</td>
				<td><input type="text"value="" name="email_address" class="txtfield"></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="text" value="" name="password" class="txtfield"></td>
			</tr>
			<tr>
				<td>Confirm Password:</td>
				<td><input type="text" value="" name="cpassword" class="txtfield"></td>
			</tr>	
		</tbody>
	</table>
	<input type="submit" name="add" value="add" class="btn">
	<?php echo form_close();?>
</div>


