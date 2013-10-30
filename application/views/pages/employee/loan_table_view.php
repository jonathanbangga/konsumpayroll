<div class="tbl-wrap">
	<table>
		<tr>
			<td style="padding:10px;border:1px solid #bcbcbc;">Loan Type</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Loan Number</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Date Granted</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Principal</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Loan Balance</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Monthly Amortazation</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Details</td>
		</tr>
		<?php 
			if($loan != null){
				foreach($loan as $row){
		?>
			<tr>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->loan_type_name;?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;">Loan Number</td>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->date_granted;?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->principal;?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;">Loan Balance</td>
				<td style="padding:10px;border:1px solid #bcbcbc;">Monthly Amortazation</td>
				<td style="padding:10px;border:1px solid #bcbcbc;">Details</td>
			</tr>
		<?php 		
				}
			}else{
				print msg_empty();
			}
		?>
	</table>
</div>