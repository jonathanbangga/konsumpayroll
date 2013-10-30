<div class="tbl-wrap">
	<table>
		<tr>
			<td style="padding:10px;border:1px solid #bcbcbc;">Type of Insurance Coverage</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Personal Share Life</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Personal Share Retirement</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Government Share Life</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Government Share Retirement</td>
		</tr>
		<?php 
			if($gsis_tbl != null){
				foreach($gsis_tbl as $row){
		?>
			<tr>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->type_of_insurance_coverage;?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->personal_share_life;?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->personal_share_retirement;?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->gov_share_life;?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->gov_share_retirement;?></td>
			</tr>
		<?php 		
				}
			}else{
				print msg_empty();
			}
		?>
	</table>
</div>