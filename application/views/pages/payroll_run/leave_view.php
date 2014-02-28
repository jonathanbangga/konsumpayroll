<div class="main-content"> 
<!-- MAIN-CONTENT START -->
<p>
The leave information here is automatically populated from the approved leaves when using the application leave of the system. 
</p>
<div class="tbl-wrap">
  <table width="1040" border="0" cellspacing="0" cellpadding="0" class="tbl">
	<tr>
	  <th width="116">Employee ID</th>
	  <th width="116">Employee Name</th>
	  <th width="156">Pay Date</th>
	  <th width="126">Leave Date</th>
	  <th width="126">Leave Type</th>
	  <th width="106">No.of Hours</th>
	  <th width="120">With Pay</th>
	  <th width="121">Leave Balance</th>
	  <th width="121">Attachment</th>
	  <th width="121">Status</th>
	</tr>
	<?php
	foreach($tk_sql->result() as $tk){ ?>
		<tr>
		  <td><?php echo $tk->payroll_cloud_id; ?></td>
		  <td><?php echo $tk->first_name.' '. $tk->last_name; ?></td>
		  <td><?php echo date('m/d/Y',strtotime($tk->payroll_period)); ?></td>
		  <td><?php echo date('m/d/Y',strtotime($tk->date_start)).' - '. date('m/d/Y',strtotime($tk->date_end)); ?></td>
		  <td><?php echo $tk->leave_type; ?></td>
		  <td><?php echo $tk->total_leave_requested; ?></td>
		  <td><?php echo ($tk->payable==1)?'Yes':'No'; ?></td>
		  <td><?php echo $tk->leave_accrued; ?></td>
		  <td><?php echo $tk->required_documents; ?></td>
		  <td><?php echo $tk->leave_application_status; ?></td>
		</tr>
	<?php
	}
	?>
  </table>
</div>
<p class="pagination">
<?php echo $pagination; ?>
<div style="clear:both;"></div>
</p>

<!-- MAIN-CONTENT END --> 
</div>
<div class="footer-grp-btn" style="width:820px;"> 
<!-- FOOTER-GRP-BTN START --> 
<a class="btn btn-gray left" href="#">BACK</a>
<input class="btn right" name="" type="button" value="SAVE">
<!-- FOOTER-GRP-BTN END --> 
</div>
