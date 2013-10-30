<h1><?php print $page_title;?></h1>
<table>
	<tr>
		<td style="padding:10px;border:1px solid #bcbcbc;">Salary Brackets</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Range of Compensation From</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Range of Compensation To</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Monthly Salary Credit</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Emp Monthly Contri Ss</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Emp Monthly Contri Ec</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Employee Ss</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Total</td>
	</tr>
	<?php 
		if($sss_tbl != null){
			foreach($sss_tbl as $row){
	?>
		<tr>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->salary_brackets;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->range_compensation_from;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->range_compensation_to;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->monthly_salary_credit;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->employer_monthly_contribution_ss;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->employer_monthly_contribution_ec;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->employee_ss;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Total</td>
		</tr>
	<?php 		
			}
		}
	?>
</table>