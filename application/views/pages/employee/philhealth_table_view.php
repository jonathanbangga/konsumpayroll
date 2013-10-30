<h1><?php print $page_title;?></h1>
<table>
	<tr>
		<td style="padding:10px;border:1px solid #bcbcbc;">Salary Brackets</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Range of Compensation From</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Range of Compensation To</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Monthly Salary Credit</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Employee Contribution</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Employee Contribution</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Total</td>
	</tr>
	<?php 
		if($philhealth_tbl != null){
			foreach($philhealth_tbl as $row){
	?>
		<tr>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->salary_bracket;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->range_of_compensation_from;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->range_of_compensation_to;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->monthly_salary_credit;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->employer_contribution1;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->employer_contribution2;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Total</td>
		</tr>
	<?php 		
			}
		}
	?>
</table>