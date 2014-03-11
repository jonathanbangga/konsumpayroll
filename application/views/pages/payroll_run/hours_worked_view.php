	<div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table style="width:100%;" class="tbl">
            <tbody>
				<tr>
					<th style="width:50px;"><input type="checkbox" name="odeleteall"></th>
					<th style="width:135px">Employee ID</th>
					<th style="width:400px">Employee Name</th>
					<th colspan="2">Required Hours</th>
					<th colspan="<?php echo $hours_type ? count($hours_type) - 2 : 3;?>">Hoursworked</th>
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
				</tr>
				<?php
					if($list){
						$test = date("j A",strtotime("19:30:00"));
						
						foreach($list as $list_key => $list_val):
							if($hours_type) {		
							$total_hours_work = 0;
				?>
						<tr>
							<td><span class="payroll_group_span"><input type="checkbox" name="timein_id[]" /></span></td>
							<td><span class="payroll_group_span"><?php echo $list_val->emp_id."aid".$list_val->payroll_cloud_id;?></span></td>
							<td><span class="payroll_group_span"><?php echo $list_val->last_name." , ".$list_val->first_name;?></span></td>	
							<?php			
									foreach($hours_type as $ht) :
							?>
							<td>
								<span class="payroll_group_span2">
								<?php 				
									$days_holiday = $this->hw->get_holiday_dates($this->company_info->company_id,$ht->hour_type_id);
									if ($days_holiday) {
										$emp_timein = $this->db->query("SELECT * from employee_time_in eti 
																						WHERE comp_id ='{$this->company_info->company_id}' 
																						AND  eti.emp_id = '{$list_val->emp_id}' AND  CAST(eti.time_out as date) IN ({$days_holiday}) 
																						AND eti.time_in_status = '' OR eti.time_in_status='approved' and eti.status='Active'");
										$emp_result = $emp_timein->result();
										$emp_timein->free_result();
										$totalhours= 0;
										if ($emp_result) {	
											foreach($emp_result as $eti_val):
												$holiday_declare =  date("Y-m-d",strtotime($eti_val->time_out)); 	# so the declaration of the Holidate is based upon timeout date
												$employee_timein = date("Y-m-d",strtotime($eti_val->time_in));		# This is the employee time in 
												if ($employee_timein == $holiday_declare) { # if dates of time in and time out equal meaning the dates are the same not like the Night which is the call centers have 2 dates
													$totalhours +=$eti_val->total_hours;								
												} else if ($holiday_declare > $employee_timein) { # if timeout is greater than timein march 13 , 2014 > march 12,2013 then goes through
													
													$static = strtotime(date("Y-m-d H:i",strtotime($holiday_declare." 00:00:00")));
													$minus_timeout = strtotime(date("Y-m-d H:i",strtotime($eti_val->time_out)));
													$totalhours +=isubtract_time($minus_timeout,$static);
													
													# lunch in
													
													# if lunch in == $holiday declare  2:00
													# 
													# if(12am <= lunchin)   12am < 2:00 then subtract
													# lunchout 3am
													# lunchin 
													# 										
												}	
											endforeach;
										}
										echo $totalhours."<br />";
										$total_hours_work +=$totalhours;
									} else {
										echo "0";
										$total_hours_work +=0;
									}
								
						#		$reg = 0; 
								$holiday = 0;
								
								
								#employee1  -  4 hr regular & 3 hr holiday
								#employee2   - 9 hr regular & 0 holiday
								
						#		$reg = 0 + 4 + 9
						#		$holiday = 0 + 3 + 0
				
								#	echo $ht->hour_type_id . " id ";
								#	echo $ht->hour_type_name;
								?>
								</span>
							</td>	
			<?php endforeach; ?>
					<td><span class="payroll_group_span"><?php echo $total_hours_work;?></span></td>	
					<td><span class="payroll_group_span"><?php echo $total_hours_work;?></span></td>	
					<td><span class="payroll_group_span"><?php echo $list_val->tardiness;?></span></td>	
					<td><span class="payroll_group_span"><?php echo $list_val->undertime;?></span></td>	
					<td><span class="payroll_group_span">
					<?php 
						$show_paid_leave = $this->hw->get_paid_leave($list_val->emp_id,$this->company_info->company_id,$payroll_period->period_from,$payroll_period->period_to);
						if($show_paid_leave) {
							if($show_paid_leave->total_leave_requested > 0) {
								echo $show_paid_leave->total_leave_requested;
							} else {
								echo '0';
							}
						} else {
							echo '0';
						}
					?></span>
					</td>	
			<?php } ?>
					
				</tr> 
				<?php
						endforeach;
					}
				?>	
            </tbody>
          </table>
          <!-- TBL-WRAP END -->
	</div>