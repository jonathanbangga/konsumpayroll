<h1><?php print $page_title;?></h1>
<table>
	<tr>
		<td style="padding:10px;border:1px solid #bcbcbc;">Tax</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">1</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">2</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">3</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">4</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">5</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">6</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">7</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">8</td>
	</tr>
	<?php 
		if($withholding_tax != null){
			foreach($withholding_tax as $row){
	?>
		<tr>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->tax_name;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->tax1;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->tax2;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->tax3;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->tax4;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->tax5;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->tax6;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->tax7;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->tax8;?></td>
		</tr>
	<?php 		
			}
		}
	?>
</table>
<br />
<table>
	<tr>
		<td style="padding:10px;border:1px solid #bcbcbc;">Tax Status</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">1</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">2</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">3</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">4</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">5</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">6</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">7</td>
		<td style="padding:10px;border:1px solid #bcbcbc;">8</td>
	</tr>
	<?php 
		if($withholding_tax_status != null){
			foreach($withholding_tax_status as $row){
	?>
		<tr>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->tax_name;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->amount_excess1;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->amount_excess2;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->amount_excess3;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->amount_excess4;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->amount_excess5;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->amount_excess6;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->amount_excess7;?></td>
			<td style="padding:10px;border:1px solid #bcbcbc;"><?php print $row->amount_excess8;?></td>
		</tr>
	<?php 		
			}
		}
	?>
</table>