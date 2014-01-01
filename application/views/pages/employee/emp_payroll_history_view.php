<div class="new_header_cont">
	<h1>Payroll History</h1>
</div>
<div class="tbl-wrap">
	<p>
		<input type="text" class="txtfield datepickerCont" placeholder="From" />
		<input type="text" class="txtfield datepickerCont" placeholder="To" />
		<a href="javascript:void(0);" class="filter_payroll_history btn">Filter</a>
	</p>
	<?php print $this->session->flashdata('message');?>
	<table style="width:930px;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:auto;">Payroll Date</th>
              <th style="width:auto;">Pay Coverage</th>
              <th style="width:auto;">Pay Period</th>
              <th style="width:auto">Rate</th>
              <th style="width:auto;">Net Amount</th>
              <th style="width:auto;">Details</th>
            </tr>
            <!-- 
		<?php 
			if($leave != null){
				foreach($leave as $row){
		?>
			<tr>
				<td><?php print $row->leave_type_name;?></td>
				<td><?php print $row->date_filed;?></td>
				<td><?php print $row->date_start;?></td>
				<td><?php print $row->date_end;?></td>
				<td><?php print $row->date_return;?></td>
				<td><?php print ucwords($row->payable);?></td>
				<td><?php print $row->approved_by_head;?></td>
				<td><?php print $row->reasons;?></td>
				<td><?php print $row->note;?></td>
				<td><?php print $row->attachments;?></td>
				<td><?php print ucwords($row->leave_application_status);?></td>
			</tr>
		<?php 		
				}
			}else{
            		print "<tr class='msg_empt_cont'><td colspan='12' style='text-align:left;'>".msg_empty()."</td></tr>";
            	}
		?>
		 -->
	</tbody></table>
</div>
<script>
	function _datepicker(){
		jQuery(".datepickerCont").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	}
	
	jQuery(function(){
		_datepicker();
	});
</script>