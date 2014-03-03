	<div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table style="width:100%;" class="tbl">
            <tbody>
				<tr>
					<th style="width:50px;"><input type="checkbox" name="odeleteall"></th>
					<th style="width:135px">Employee ID</th>
					<th style="width:200px">Employee Name</th>
					<th colspan="2">Required Hours</th>
					<th colspan="5">Hoursworked</th>
					<th>Total</th>
					<th>Absences</th>
					<th>Tardiness</th>
					<th>Undertime</th>
					<th>Paid Leave</th>
				</tr>
				<tr>
					<td><span class="payroll_group_span"></span></td>
					<td><span class="payroll_group_span"></span></td>
					<td><span class="payroll_group_span"></span></td>	
					<td><span class="payroll_group_span">Regular Day</span></td>
					<td><span class="payroll_group_span">Holiday</span></td>
					<td><span class="payroll_group_span">Paid Holiday</span></td>
					<td><span class="payroll_group_span">Holiday</span></td>
					<td><span class="payroll_group_span">Paid Holiday</span></td>
					<td><span class="payroll_group_span">Night Differential</span></td>
					<td><span class="payroll_group_span">Regular Hour</span></td>
					<td><span class="payroll_group_span"></span></td>
					<td><span class="payroll_group_span"></span></td>
					<td><span class="payroll_group_span"></span></td>
					<td><span class="payroll_group_span"></span></td>
					<td><span class="payroll_group_span"></span></td>
				</tr>
				<?php
					if($list){
						$test = date("j A",strtotime("19:30:00"));
				
						foreach($list as $list_key => $list_val):
				?>
				<tr>
					<td><span class="payroll_group_span"><input type="checkbox" name="timein_id[]" /></span></td>
					<td><span class="payroll_group_span"><?php echo $list_val->payroll_cloud_id;?></span></td>
					<td><span class="payroll_group_span"><?php echo $list_val->last_name." , ".$list_val->first_name;?></span></td>	
					<td><span class="payroll_group_span"><?php echo "asd";?></span></td>
					<td><span class="payroll_group_span"><?php echo $test;?></span></td>
					<td><span class="payroll_group_span"><?php echo $test;?></span></td>
					<td><span class="payroll_group_span"><?php echo $test;?></span></td>
					<td><span class="payroll_group_span"><?php echo $test;?></span></td>
					<td><span class="payroll_group_span"><?php echo $test;?></span></td>
					<td><span class="payroll_group_span"><?php echo $test;?></span></td>
					<td><span class="payroll_group_span"><?php echo $test;?></span></td>
					<td><span class="payroll_group_span"><?php echo $test;?></span></td>
					<td><span class="payroll_group_span"><?php echo $test;?></span></td>
					<td><span class="payroll_group_span"><?php echo $test;?></span></td>
					<td><span class="payroll_group_span"><?php echo $test;?></span></td>
				</tr> 
				<?php
						endforeach;
					}
				?>	
            </tbody>
          </table>
          <!-- TBL-WRAP END -->
	</div>