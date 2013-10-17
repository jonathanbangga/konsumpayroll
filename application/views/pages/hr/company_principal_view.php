
	<h1><?php echo $page_title;?></h1>
	<p>You can assign departments and employees to specific cost centers.<br>
	Specify the cost center and it’s description.</p>
	<table style="width:100%" class="tbl">
		<tr>
			<th>Employee Number</th>
			<th style="width:130px">Name</th>
			<th>Level</th>
			<th style="width:150px">Email</th>
			<th style="width:90">Business Phone</th>
			<th style="width:90">Mobile Phone</th>
			<th style="width:130px">Action</th>
		</tr>
		<?php
			for($i = 0; $i <= 3;$i++){
		?>
		<tr id="jcom_prin_parent_<?php echo $i;?>">
			<td>09-09090987</td>
			<td>Allan Villaon Vergara</td>
			<td>1</td>
			<td>Allan.Vergara@konsumtech.com</td>
			<td>987-9632-775</td>
			<td>987-9632-775</td>
			<td><a class="btn btn-gray btn-action" href="#">EDIT</a> <a class="btn btn-red btn-action jcom_prin_del" href="#">DELETE</a></td>
		</tr>
		<?php
			}
		?>
		
	</table>
	<a href="#" class="btn">ADD MORE PRINCIPAL</a>