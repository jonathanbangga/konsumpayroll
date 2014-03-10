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
	  <th width="">Hours Type</th>
	  <th width="106">No. of Hours</th>
	</tr>
	
	<?php
	if($nd_timeins){
	
		foreach($nd_timeins as $hp){ 
			$have_nightdiff = $this->nd->nightdiff_approve($hp->time_in,$hp->time_out);
			if($have_nightdiff) {
		?>
			<tr>
				<td><?php echo $hp->employee_time_in_id;?> We <?php echo $hp->payroll_cloud_id; ?></td>
				<td><?php echo $hp->first_name.' '. $hp->last_name; ?></td>
				<td><?php echo $nd_payroll_period->payroll_period; ?>
				</td>
				<td><?php echo date('m/d/Y',strtotime($hp->date)); ?></td>
				<td>
					<?php
						// TIMEIN
						$emp_timein = $hp->time_in;
						$emp_timein_start = date("Y-m-d",strtotime($hp->time_in));
						$emp_timein_start_time = date("Y-m-d H:i:s",strtotime($hp->time_in));
						// TIME OUT
						$emp_timeout = $hp->time_out;
						$emp_timeout_end = date("Y-m-d",strtotime($hp->time_out));
						$emp_timeout_end_time = date("Y-m-d H:i:s",strtotime($hp->time_out));
						// NIGHT DIFF TIME IN
						$night_dif_from = date("Y-m-d H:i:s",strtotime($emp_timein_start." ".$nd_data->from_time));
		
						// NIGHT DIFF TIME OUT
						$night_dif_to = date("Y-m-d H:i:s",strtotime($emp_timeout_end." ".$nd_data->to_time));
						
						echo "Employee date <br />time in : " . $emp_timein_start_time ." Timeout : " . $emp_timeout_end_time;
						echo "<br />";
						echo "Night diff".$night_dif_from," night to".$night_dif_to;
						echo "<br />Results<br />";
						
				
					?>
				</td>
				<td>
				<?php 
				
					$emp_timein = date("Y-m-d H:i:s",strtotime($hp->time_in));
					$emp_timein_date = date("Y-m-d",strtotime($hp->time_in));
					// logout on access
					$emp_timeout = date("Y-m-d H:i:s",strtotime($hp->time_out));
					$emp_timeout_date_out = date("Y-m-d",strtotime($hp->time_out));
			
					if($emp_timein_start < $emp_timeout_end){
						echo "weeeeeeeeeee";
						
					}else if($emp_timein_date == $emp_timeout_date_out) {
					
						if($emp_timein <= date("H:i:s",strtotime("23:59:00")) && date("H:i:s",strtotime($emp_timeout) )>= $nd_data->from_time ){
							$night_diff_start = date("Y-m-d H:i:s",strtotime($emp_timein_date." ".$nd_data->from_time));
							$night_diff_end = date("Y-m-d H:i:s",strtotime($emp_timeout_date_out." ".$nd_data->to_time.' +1 day'));
						} else {
							$night_diff_start = date("Y-m-d H:i:s",strtotime($emp_timein_date." ".$nd_data->from_time.' -1 day'));
							$night_diff_end = date("Y-m-d H:i:s",strtotime($emp_timeout_date_out." ".$nd_data->to_time));
						}
						
					}
					
					
				?>

				
				
				
				
				
				
				
				
				
				<!--
					<?php
						// CHECK FIRST THE login
						$first_his = date("H:i:s",strtotime($hp->time_in));
						
						$second ="24:00:00"; # e set natog 24hours kay nightdiff gud sa? hihihi
						$night_diff_specified = strtotime("1:00:00"); # static time lang ni para sa 1:00:00 siyaro naay nightdiff na buntag diba? hihihihi
						
						$employee_timeout = date("H:i:s",strtotime($hp->time_out));
						$first = $nd_data->from_time;
						
						# IF ang time in is greater sa night different time in og dapat ang employee time less than ra 24oras
						if(strtotime($first_his) > strtotime($nd_data->from_time) && strtotime($first_his) <= strtotime($second)) {  // if ang employee time in is greater sa nightdiff masmaayo then ilisan lang nato ang timein
								$first=$first_his;

						}
						
					
						
						#	find_difference($night_dif_from,$emp_timein_start_time);
						$night_first = isubtract_time(strtotime($second),strtotime($first));
						$night_second = "";
						
						$night_diff_end = strtotime($night_dif_to);
						$specified = strtotime($employee_timeout);
						
						if($specified >= $night_diff_specified && $specified <= $night_diff_end){ // kung na fall siya aning 1:00 og nightdiff end 
							$night_second = isubtract_time($specified,$night_diff_specified);
						}
						
						# IF GREATER THAN specified time like OT nANI
						if($specified > $night_diff_end){
							$night_second = isubtract_time($night_diff_end,$night_diff_specified);			
						}
						
						$total = (strtotime($night_second) + strtotime($night_first));
						echo " code ".sum_the_time($night_first,$night_second);
					?>
				-->
				</td>
				
			</tr>
		<?php
			}
		}
	}
	?>
	
	<!--
	<?php
	

	if($nd_sql){
		foreach($nd_sql->result() as $hp){ ?>
		<tr>
			
			<td>ID <?php echo $hp->employee_time_in_id;?> We <?php echo $hp->payroll_cloud_id; ?></td>
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
	-->
  </table>
</div>
<p class="pagination">
<?php echo $pagination; ?>
<div style="clear:both;"></div>
</p>

<!-- MAIN-CONTENT END --> 
</div>
<div class="footer-grp-btn" > 
<!-- FOOTER-GRP-BTN START --> 
<a class="btn btn-gray left" href="#">BACK</a>
<input class="btn right" name="" type="button" value="SAVE">
<!-- FOOTER-GRP-BTN END --> 
</div>

