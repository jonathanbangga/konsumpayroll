<div class="tbl-wrap">
	<table>
		<tr>
			<td style="padding:10px;border:1px solid #bcbcbc;">Leave Type</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">With Pay</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Date From</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Date To</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Hours</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Total Hours</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Next Approver</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Reason</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Status</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Note</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Attachment</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Approval History</td>
		</tr>
		<?php 
			if($leave != null){
				foreach($leave as $row){
		?>
			<tr>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->leave_type_name;?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print ucwords($row->payable);?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->date;?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->to;?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->no_of_hours;?></td>
				<td style="padding:10px;border:1px solid #bcbcbc;">Total Hours</td>
				<td style="padding:10px;border:1px solid #bcbcbc;">Next Approver</td>
				<td style="padding:10px;border:1px solid #bcbcbc;">Reason</td>
				<td style="padding:10px;border:1px solid #bcbcbc;">Status</td>
				<td style="padding:10px;border:1px solid #bcbcbc;">Note</td>
				<td style="padding:10px;border:1px solid #bcbcbc;">Attachment</td>
				<td style="padding:10px;border:1px solid #bcbcbc;">Approval History</td>
			</tr>
		<?php 		
				}
			}
		?>
	</table>
</div>