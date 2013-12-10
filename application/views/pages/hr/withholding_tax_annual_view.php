<div class="tbl-wrap">
	<table class="tbl">
		<tr>
			<th>Salary Bracket</th>
			<th>Rage of Tax From</th>
			<th>Rage of Tax To</th>
			<th>Initial Tax</th>
			<th>Additional Tax %</th>
		</tr>
		<?php 
			if($withholding_tax_status != null){
				foreach($withholding_tax_status as $row){
		?>
			<tr>
				<td><?php print iprice($row->salary_bracket);?></td>
				<td><?php print iprice($row->range_of_tax_from);?></td>
				<td><?php print iprice($row->range_of_tax_to);?></td>
				<td><?php print iprice($row->initial_tax);?></td>
				<td><?php print iprice($row->additional_tax);?></td>
			</tr>
		<?php 		
				}
			}else{
				print "<td colspan='5'>";
				print msg_empty();
				print "</td>";
			}
		?>
	</table>
</div>