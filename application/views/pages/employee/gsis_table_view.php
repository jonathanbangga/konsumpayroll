<div class="tbl-wrap">
	<table class="tbl">
		<tr>
			<th>Type of Insurance Coverage</th>
			<th>Personal Share Life</th>
			<th>Personal Share Retirement</th>
			<th>Government Share Life</th>
			<th>Government Share Retirement</th>
		</tr>
		<?php 
			if($gsis_tbl != null){
				foreach($gsis_tbl as $row){
		?>
			<tr>
				<td><?php print $row->type_of_insurance_coverage;?></td>
				<td><?php print $row->personal_share_life;?></td>
				<td><?php print $row->personal_share_retirement;?></td>
				<td><?php print $row->gov_share_life;?></td>
				<td><?php print $row->gov_share_retirement;?></td>
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