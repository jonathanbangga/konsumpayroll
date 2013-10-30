<div class="tbl-wrap">
	<table>
		<tr>
			<td style="padding:10px;border:1px solid #bcbcbc;">Salary Bracket</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Rage or Compensation From</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Rage or Compensation To</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Monthly Salary Credit</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Employer Contribution</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Employer Contribution</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Total</td>
		</tr>
		<?php 
			if($hdmf_tbl != null){
				foreach($hdmf_tbl as $row){
		?>
			<tr>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->salary_bracket_id;?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->range_of_compensation_from;?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->range_of_compensation_to;?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->monthly_salary_credit;?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->employer_contribution1;?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->employee_contribution2;?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;">Total</td>
			</tr>
		<?php 		
				}
			}
		?>
	</table>
</div>