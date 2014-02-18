<div class="main-content"> 
<!-- MAIN-CONTENT START -->
<p>All holidays of the selected payroll period will be listed here.</p>
  
<div class="tbl-wrap">
  <table width="1040" border="0" cellspacing="0" cellpadding="0" class="tbl">
	<tr>
	  <th width="116">Employee ID</th>
	  <th width="116">Employee Name</th>
	  <th width="156">Pay Date</th>
	  <th width="156">Holiday Day</th>
	  <th width="126">Hours Type</th>
	  <th width="126">Rate</th>
	  <th width="106">No. of Hours</th>
	</tr>
	<?php
	foreach($hp_sql->result() as $hp){ ?>
		<tr>
		<td><?php echo $hp->payroll_cloud_id; ?></td>
		<td><?php echo $hp->first_name.' '. $hp->last_name; ?></td>
		<td><?php echo date('m/d/Y',strtotime($hp->payroll_period)); ?></td>
		<td><?php echo ($hp->hol_day!="")?date('m/d/Y',strtotime($hp->hol_day)):''; ?></td>
		<td><?php echo $hp->hour_type_name; ?></td>
		<td><?php echo ($hp->pay_rate)?$hp->pay_rate.'%':''; ?></td>
		<td><?php echo ($hp->counted_hol_hours>0)?$hp->counted_hol_hours:$hp->tot_hours; ?></td>
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
