<div class="tbl-wrap">
	<table>
		<tr>
			<td style="padding:10px;border:1px solid #bcbcbc;">Salary Bracket</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Rage of Tax From</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Rage of Tax To</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Initial Tax</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Additional Tax %</td>
		</tr>
		<?php 
			if($withholding_tax_status != null){
				foreach($withholding_tax_status as $row){
		?>
			<tr>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->salary_bracket;?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->range_of_tax_from;?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->range_of_tax_to;?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->initial_tax;?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->additional_tax;?></td>
			</tr>
		<?php 		
				}
			}else{
				print $this->config->item('msg_empty');
			}
		?>
	</table>
</div>