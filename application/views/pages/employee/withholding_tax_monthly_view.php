<div class="tbl-wrap">
	<table class="tbl">
		<tr>
			<th >Tax</th>
			<th >1</th>
			<th >2</th>
			<th >3</th>
			<th >4</th>
			<th >5</th>
			<th >6</th>
			<th >7</th>
			<th >8</th>
		</tr>
		<?php 
			if($withholding_tax != null){
				foreach($withholding_tax as $row){
		?>
			<tr>
				<td ><?php print $row->tax_name;?></td>
				<td ><?php print iprice($row->tax1);?></td>
				<td ><?php print iprice($row->tax2);?></td>
				<td ><?php print iprice($row->tax3);?></td>
				<td ><?php print iprice($row->tax4);?></td>
				<td ><?php print iprice($row->tax5);?></td>
				<td ><?php print iprice($row->tax6);?></td>
				<td ><?php print iprice($row->tax7);?></td>
				<td ><?php print iprice($row->tax8);?></td>
			</tr>
		<?php 		
				}
			}else{
				echo "<td colspan=\"9\">";
				print msg_empty();
				echo "</td>";
			}
		?>
	</table>
	<br />
	<table class="tbl">
		<tr>
			<th >Tax Status</th>
			<th style="width: 76px;">1</th>
			<th >2</th>
			<th >3</th>
			<th >4</th>
			<th >5</th>
			<th >6</th>
			<th >7</th>
			<th >8</th>
		</tr>
		<?php 
			if($withholding_tax_status != null){
				foreach($withholding_tax_status as $row){
		?>
			<tr>
				<td ><?php print $row->tax_name;?></td>
				<td ><?php print iprice($row->amount_excess1);?></td>
				<td ><?php print iprice($row->amount_excess2);?></td>
				<td ><?php print iprice($row->amount_excess3);?></td>
				<td ><?php print iprice($row->amount_excess4);?></td>
				<td ><?php print iprice($row->amount_excess5);?></td>
				<td ><?php print iprice($row->amount_excess6);?></td>
				<td ><?php print iprice($row->amount_excess7);?></td>
				<td ><?php print iprice($row->amount_excess8);?></td>
			</tr>
		<?php 		
				}
			}else{
				echo "<td colspan=\"9\">";
				print msg_empty();
				echo "</td>";
			}
		?>
	</table>
</div>