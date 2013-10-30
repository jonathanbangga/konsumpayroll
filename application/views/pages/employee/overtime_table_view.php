<h1><?php print $page_title;?></h1>
<table>
	<tr>
		<td style="padding:10px;border:1px solid #bcbcbc;">Date From</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Time Start</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Time End</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Project</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Location</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">OT Type</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Hours</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">NSD Hrs</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Approver</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Reason</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Status</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">Note</td>
	</tr>
	<?php 
		if($overtime != null){
			foreach($overtime as $row){
	?>
		<tr>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->overtime_date;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->start_time;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->end_time;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->project_name;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->location_name;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->overtime_type_name;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->no_of_hours;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->with_nsd_hours;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Approver</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Reason</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Status</td>
			<td style="padding:10px;border:1px solid #bcbcbc;">Note</td>
		</tr>
	<?php 		
			}
		}
	?>
</table>