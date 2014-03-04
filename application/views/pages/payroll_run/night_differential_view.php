<div class="main-content"> 
<!-- MAIN-CONTENT START -->
<p>List of all employees which has night differential premium. The rate is based on the night differential set up.</p>
  
<div class="tbl-wrap">
  <table width="1040" border="0" cellspacing="0" cellpadding="0" class="tbl">
	<tr>
	  <th width="116">Employee ID</th>
	  <th width="116">Employee Name</th>
	  <th width="156">Pay Date</th>
	  <th width="156">Date</th>
	  <th width="126">Hours Type</th>
	  <th width="106">No. of Hours</th>
	</tr>
	<?php
	if($nd_sql){
		foreach($nd_sql->result() as $hp){ ?>
		<tr>
			<td><?php echo $hp->payroll_cloud_id; ?></td>
			<td><?php echo $hp->first_name.' '. $hp->last_name; ?></td>
			<td><?php echo date('m/d/Y',strtotime($hp->payroll_period)); ?></td>
			<td><?php echo date('m/d/Y',strtotime($hp->ti_date)); ?></td>
			<td>
					<?php echo $hp->hour_type_name; 
						echo get_night_diff($hp->emp_id);
					?>
			</td>
			<td><?php echo $hp->total_hours; ?></td>
		</tr>
	<?php
		}
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
