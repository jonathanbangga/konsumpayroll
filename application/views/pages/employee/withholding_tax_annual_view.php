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
				<td><?php print $row->salary_bracket;?></td>
				<td><?php print $row->range_of_tax_from;?></td>
				<td><?php print $row->range_of_tax_to;?></td>
				<td><?php print $row->initial_tax;?></td>
				<td><?php print $row->additional_tax;?></td>
			</tr>
		<?php 		
				}
			}else{
				echo "<td colspan='5'>";
				print msg_empty();
				echo "</td>";
			}
		?>
	</table>
</div>