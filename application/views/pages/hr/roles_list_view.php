<br />
<h1><?php echo $page_title;?></h1>
	<table style="width:100%;" class="tbl emp_users_list">
		<tbody>
			<tr>
				<th style="width:10px;">Line</th>
				<th style="width:400px;">User Roles</th>
				<th style="width:70px">Action</th>
			</tr>
			<?php
				if($admin_users_list){
					foreach($admin_users_list as $aul_key=>$aul_val):
			?>
			<tr>
				<td><?php echo $this->uri->segment(5) !="" ?  ($this->uri->segment(5)*10-1)+$aul_key++: (($aul_key++)+1);?></td>
				<td><div class="users_text"><?php echo $aul_val->roles;?></div></td>
				<td>
					<a class="btn btn-gray btn-action jmanage_users" href="/<?php echo $this->uri->segment(1)."/hr/users/permissions_edit/".$aul_val->users_roles_id;?>" >EDIT</a>
				</td>
			</tr>
			<?php
					endforeach;
				}
			?>
		</tbody> 
	</table>
	<p>&nbsp;</p>
	<div class="pagiCont_btnCont">
		<div class="left"><?php echo $pagi;?></div><div class="clearB"></div>
	</div>
	<div class="footer-grp-btn"></div>