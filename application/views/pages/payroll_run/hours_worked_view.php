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
					<?php
						if($hours_type) {
							foreach($hours_type as $ht) :
					?>
					<td><span class="payroll_group_span"><?php echo $ht->hour_type_name;?></span></td>	
					<?php
							endforeach;
						}
					?>
					<td><span class="payroll_group_span"></span></td>
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
					<td><span class="payroll_group_span"><?php echo $list_val->emp_id."aid".$list_val->payroll_cloud_id;?></span></td>
					<td><span class="payroll_group_span"><?php echo $list_val->last_name." , ".$list_val->first_name;?></span></td>	
					<?php
						if($hours_type) {					
							foreach($hours_type as $ht) :
					?>
					<td>
						<span class="payroll_group_span">
						<?php 
						
							$days_holiday = $this->hw->get_holiday_dates($this->company_info->company_id,$ht->hour_type_id);
							if($days_holiday){
							$emp_timein = $this->db->query("SELECT sum(eti.total_hours) as hours from employee_time_in eti WHERE comp_id ='{$this->company_info->company_id}' 
														AND  eti.emp_id = '{$list_val->emp_id}' AND CAST(eti.time_out as date) IN ({$days_holiday})");
							$emp_result = $emp_timein->result();
							p($emp_result);
							}else{
								echo "none";
							}
						
							echo $ht->hour_type_id."id";
							echo $ht->hour_type_name;
						?>
						</span></td>	
					<?php
							endforeach;
						}
					?>
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