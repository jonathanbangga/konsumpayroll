<div class="main-content">
<div style="display:none;" class="highlight_message">Message</div>
        <!-- MAIN-CONTENT START -->
		<?php
		$attributes = array('id' => 'jform');
		echo form_open("/".$this->session->userdata('sub_domain')."/payroll_setup/workday", $attributes);
		?>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et<br>
          dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
		 </p>
<?php
if($pg_sql->num_rows()>0){
$index = 0;
// payroll group
foreach($pg_sql->result() as $pgi=>$pg){
// get number of breaks
$brk_sql = $this->workday_model->get_number_of_breaks($pg->payroll_group_id);
if($brk_sql->num_rows()>0){
$brk = $brk_sql->row();
$num_break = intval($brk->break_time_number);
}else{
$num_break = 0;
}
?>

<div class="payroll_group_div" id="main-pg-div-<?php echo $pg->payroll_group_id; ?>">
	<input type="hidden" name="main_pg_id[]" value="<?php echo $pg->payroll_group_id; ?>" />
	<p><strong class="workday_head">Working Days for <?php echo $pg->name; ?></strong>
	<?php
	// get working days settings
	/*
	$wss_sql = $this->workday_model->get_workday_settings($pg->payroll_group_id);
	if($wss_sql->num_rows()>0){
		$wss = $wss_sql->row();
		$ws_id = $wss->workday_settings_id;
		$wd = $wss->workday_type;
		$nob = $wss->num_breaks;
		$wd_py = $wss->working_days_per_year;
		$dl_py = $wss->duration_of_lunch_per_year;
		$dsb_py = $wss->duration_of_short_breaks_per_year;
		$allow_flex = $wss->flexible_workhours;
		$flex_time = $wss->latest_allowed_time_in;
	}else{
		$ws_id = "";
		$wd = "";
		$nob = "";
		$wd_py = "";
		$dl_py = "";
		$dsb_py = "";
		$allow_flex = "";
		$flex_time = "";
	}
	*/
	
		$ws_id = "";
		$wd = "";
		$nob = "";
		$wd_py = "";
		$dl_py = "";
		$dsb_py = "";
		$allow_flex = "";
		$flex_time = "";
	
		// get workday 
		$wd_sql = $this->workday_model->get_workday($pg->payroll_group_id);
		if($wd_sql->num_rows()>0){
			$wd =  $wd_sql->row();
			$sel_wd = $wd->workday_type;
		}else{
			$sel_wd = "";
		}
		
		// get unifrm working days settings
		$wds_sql = $this->workday_model->get_uniform_working_day_settings($pg->payroll_group_id);
		if($wds_sql->num_rows()>0){
			$wds = $wds_sql->row();
			$nob = $wds->number_of_breaks_per_day;
			$tot_wh_py = $wds->total_working_days_per_year;
			$afwh = $wds->allow_flexible_workhours;
			$ltia = $wds->latest_time_in_allowed;
		}else{
			$nob = "";
			$tot_wh_py = "";
			$afwh = "";
			$ltia = "";
		}
		
		
	?>
	<input type="hidden" name="wd_id[]" value="<?php echo $ws_id; ?>" />
	  <select style="margin-left:5px; width:152px;" class="txtselect workday_type" name="workday_type[]">
		<option value="">-- Select Workday --</option>
		<option value="Uniform Working Days" <?php echo ($sel_wd=="Uniform Working Days")?'selected="selected"':''; ?>>Uniform Working Days</option>
		<option value="Flexible Hours" <?php echo ($sel_wd=="Flexible Hours")?'selected="selected"':''; ?>>Flexible Hours</option>
		<option value="Workshift" <?php echo ($sel_wd=="Workshift")?'selected="selected"':''; ?>>Workshift</option>
	  </select>
	</p>
	

	<div class="workday_body">
	<div class="uniform_working_hours_div" <?php echo ($sel_wd=="Uniform Working Days")?'style="display:block"':''; ?>>
		
        <p>
	
			<input style="width:50px;" class="txtfield txtcenter text-nomal break" name="num_of_break[]" type="text" value="<?php echo $nob; ?>" />
			Number of Breaks per Day:   
		
		
        </p>
        <p> 
		<input type="text" name="working_day_per_year[]" style="width:50px;" class="txtfield txtcenter text-nomal" value="<?php echo $tot_wh_py; ?>" />
		Total working days per year. (This will be the basis for the computation of daily rates of employees)
		</p>
        <div class="tbl-wrap" style="margin:0px;">
          <table class="tbl">
            <tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th colspan="2" class="swt_th">Standard Work Time (Inclusive of Break Time)</th>
				<?php 
				$cpgb_sql = $this->workday_model->check_if_pagroll_group_has_break($pg->payroll_group_id);
				if($cpgb_sql->num_rows()>0){ 
					for($x=0;$x<$num_break;$x++){
				?>
					<th colspan="2" class="bt">Break Time <?php echo ($x+1); ?></th>
				<?php
					}
				}
				?>
				<th class="wh1">&nbsp;</th>
			
            </tr>
            <tr>
              <th>&nbsp;</th>
              <th>Working Days</th>
              <th>Start Time</th>
              <th class="end_time_th">End Time</th>
			  <?php
			  if($cpgb_sql->num_rows()>0){
				 for($x=0;$x<$num_break;$x++){
			  ?>
				  <th class="bt">Start Time</th>
				  <th class="bt">End Time</th>
			  <?php
				}
			  }
			  ?>
              <th class="wh2">Working Hours</th>
      
            </tr>
			<?php
			$day_array = array(
				"Sunday",
				"Monday",
				"Tuesday",
				"Wednesday",
				"Thursday",
				"Friday",
				"Saturday"
			);
			
			
			foreach($day_array as $day){
			
				// get selected workday
				$swd_sql = $this->workday_model->get_uniform_working_day($pg->payroll_group_id,$day);
				if($swd_sql->num_rows()>0){
					$swd = $swd_sql->row();
					$sel_day = $swd->working_day;
					// start time
					$st_h = date("h",strtotime($swd->work_start_time));
					$st_m =  date("i",strtotime($swd->work_start_time));
					$st_p =  date("A",strtotime($swd->work_start_time));
					// end time
					$et_h = date("h",strtotime($swd->work_end_time));
					$et_m = date("i",strtotime($swd->work_end_time));
					$et_p = date("A",strtotime($swd->work_end_time));
					$working_hours = $swd->working_hours;
					$sel_wdid = $swd->workday_id;
				}else{
					$sel_day = "";
					$st_h = "";
					$st_m = "";
					$st_p = "";
					$et_h = "";
					$et_m = "";
					$et_p = "";
					$working_hours = "";
					$sel_wdid = "";
				}
				
				
			
			?>
				<tr>
					<td>
						<input type="checkbox" name="workday[]" class="workday_chk" id="checkbox" value="<?php echo $day; ?>-<?php echo $index; ?>" <?php echo ($sel_day!="")?'checked="checked"':''; ?>  />
						<input type="hidden" name="pg_id[]" class="pg_id" value="<?php echo $pg->payroll_group_id; ?>" />
						<input type="hidden" name="break_last_index[]" class="break_last_index" value="<?php echo $num_break; ?>" />
						<input type="hidden" name="sel_wdid[]" class="sel_wdid" value="<?php echo $sel_wdid; ?>" />
						<input type="hidden" name="is_delete[]" class="is_delete" value="0" />
						<input type="hidden" name="wt_name[]" class="wt_name" value="Uniform Working Days" />
					</td>
					<td><?php echo $day; ?></td>
					<td>
						<div class="wd_time_div">
							<select name="st_h[]" class="txtselect" style="width:60px;">
							   <?php for($i=0;$i<=12;$i++){ 
								$st_h2 = intval($st_h);
								$day_num = sprintf("%02s", $i);
							   ?>
								<option value="<?php echo $day_num; ?>" <?php echo ($day_num==$st_h2)?'selected="selected"':''; ?>>
									<?php echo $day_num; ?>
								</option>
								<?php } ?>
							 </select>:
							<select name="st_m[]" class="txtselect" style="width:60px;">
								<?php for($i=0;$i<=59;$i++){
								$st_m2 = intval($st_m);
								$day_num = sprintf("%02s", $i);
								?>
								<option value="<?php echo $day_num; ?>" <?php echo ($day_num==$st_m2)?'selected="selected"':''; ?>>
									<?php echo $day_num; ?>
								</option>
								<?php } ?>
							</select>
							<select name="st_p[]" class="txtselect" style="width:60px;">
								<option value="AM" <?php echo ($st_p=="AM")?'selected="selected"':''; ?>>AM</option>
								<option value="PM" <?php echo ($st_p=="PM")?'selected="selected"':''; ?>>PM</option>
							</select>
						</div>
					</td>
					<td class="end_time_td">
						<div class="wd_time_div">
							<select name="et_h[]" class="txtselect" style="width:60px;">
							   <?php for($i=0;$i<=12;$i++){ 
								$et_h2 = intval($et_h);
								$day_num = sprintf("%02s", $i);
							   ?>
								<option value="<?php echo $day_num; ?>" title="<?php echo $et_h2.'-'.$day_num; ?>" <?php echo ($day_num==$et_h2)?'selected="selected"':''; ?>>
									<?php echo $day_num; ?>
								</option>
								<?php } ?>
							 </select>:
							<select name="et_m[]" class="txtselect" style="width:60px;">
								<?php for($i=0;$i<=59;$i++){ 
								$et_m2 = intval($et_m);
								$day_num = sprintf("%02s", $i);
								?>
								<option value="<?php echo $day_num; ?>" <?php echo ($day_num==$et_m2)?'selected="selected"':''; ?>>
									<?php echo $day_num; ?>
								</option>
								<?php } ?>
							</select>
							<select name="et_p[]" class="txtselect" style="width:60px;">
							  <option value="AM" <?php echo ($et_p=="AM")?'selected="selected"':''; ?>>AM</option>
							  <option value="PM" <?php echo ($et_p=="PM")?'selected="selected"':''; ?>>PM</option>
							</select>
						</div>
					</td>
					<?php
						// break time
					  if($cpgb_sql->num_rows()>0){ 
					  for($x=0;$x<$num_break;$x++){
					  //echo $pg->payroll_group_id.'-'.$day.'-'.($x+1);
					  $sbt_sql = $this->workday_model->get_breaktime($pg->payroll_group_id,$day,($x+1));
					  if($sbt_sql->num_rows()>0){
						$sbt = $sbt_sql->row();
						// break time id
						$btid = $sbt->break_time_id;
						// start time
						$st_h = date("h",strtotime($sbt->start_time));
						$st_m =  date("i",strtotime($sbt->start_time));
						$st_p =  date("A",strtotime($sbt->start_time));
						// end time
						$et_h = date("h",strtotime($sbt->end_time));
						$et_m = date("i",strtotime($sbt->end_time));
						$et_p = date("A",strtotime($sbt->end_time));;
					
					}else{
						$btid = "";
						$sel_day = "";
						$st_h = "";
						$st_m = "";
						$st_p = "";
						$et_h = "";
						$et_m = "";
						$et_p = "";
			
					}
					  ?>
						<td class="bt">
							<div class="wd_time_div">
								<input type="hidden" name="btid<?php echo $x; ?>[]" value="<?php echo $btid; ?>" />
								<select name="bt_st_h<?php echo $x; ?>[]" class="txtselect" style="width:60px;">
								   <?php for($i=0;$i<=12;$i++){ 
									$st_h2 = intval($st_h);
									$day_num = sprintf("%02s", $i);
								   ?>
									<option value="<?php echo $day_num; ?>" <?php echo ($day_num==$st_h2)?'selected="selected"':''; ?>>
										<?php echo $day_num; ?>
									</option>
									<?php } ?>
								 </select>:
								<select name="bt_st_m<?php echo $x; ?>[]" class="txtselect" style="width:60px;">
									<?php for($i=0;$i<=59;$i++){
									$st_m2 = intval($st_m);
									$day_num = sprintf("%02s", $i);
									?>
									<option value="<?php echo $day_num; ?>" <?php echo ($day_num==$st_m2)?'selected="selected"':''; ?>>
										<?php echo $day_num; ?>
									</option>
									<?php } ?>
								</select>
								<select name="bt_st_p<?php echo $x; ?>[]" class="txtselect" style="width:60px;">
									<option value="AM" <?php echo ($st_p=="AM")?'selected="selected"':''; ?>>AM</option>
									<option value="PM" <?php echo ($st_p=="PM")?'selected="selected"':''; ?>>PM</option>
								</select>
							</div>
						</td>
						<td class="end_time_td bt">
							<div class="wd_time_div">
								<select name="bt_et_h<?php echo $x; ?>[]" class="txtselect" style="width:60px;">
								   <?php for($i=0;$i<=12;$i++){ 
									$et_h2 = intval($et_h);
									$day_num = sprintf("%02s", $i);
								   ?>
									<option value="<?php echo $day_num; ?>" title="<?php echo $et_h2.'-'.$day_num; ?>" <?php echo ($day_num==$et_h2)?'selected="selected"':''; ?>>
										<?php echo $day_num; ?>
									</option>
									<?php } ?>
								 </select>:
								<select name="bt_et_m<?php echo $x; ?>[]" class="txtselect" style="width:60px;">
									<?php for($i=0;$i<=59;$i++){ 
									$et_m2 = intval($et_m);
									$day_num = sprintf("%02s", $i);
									?>
									<option value="<?php echo $day_num; ?>" <?php echo ($day_num==$et_m2)?'selected="selected"':''; ?>>
										<?php echo $day_num; ?>
									</option>
									<?php } ?>
								</select>
								<select name="bt_et_p<?php echo $x; ?>[]" class="txtselect" style="width:60px;">
								  <option <?php echo ($et_p=="AM")?'selected="selected"':''; ?>>AM</option>
								  <option <?php echo ($et_p=="PM")?'selected="selected"':''; ?>>PM</option>
								</select>
							</div>
						</td>
					  <?php
						}
					  }
					  ?>
				   <td class="wh3">
					<?php echo $working_hours; ?>
				   </td>
			
				</tr>
			<?php
			$index++;
			} ?>
            
          </table>
		  
        </div>
		<div class="main_flex_div" style="margin-top: 32px;">	
	
			<input type="hidden" name="flex_chk_sel[]" class="flex_chk_sel" value="<?php echo ($afwh==1)?1:0; ?>"  />
			<input type="checkbox" name="flex_chk[]" class="flex_chk" value="1" <?php echo ($afwh==1)?'checked="checked"':''; ?> /> Allow flexible workhours
		  
			<?php
			if($afwh==1){
				$fh = date("h",strtotime($ltia));
				$fm = date("i",strtotime($ltia));
				$fp = date("A",strtotime($ltia));
			}else{
				$fh = "";
				$fm = "";
				$fp = "";
			}
			?>

			
		  
		</div>
		
		
			<div class="wd_div flex_div" style="margin-top: 13px;<?php echo ($afwh==1)?'display:block;':''; ?>" >
				<table>
					<tr>
						<td>Latest Time in Allowed: </td>
						<td>
							<select name="flex_h[]" class="txtselect" style="width:60px;">
								<?php for($i=0;$i<=12;$i++){ 
								$fh2 = intval($fh);
								$day_num = sprintf("%02s", $i);
								?>
								<option value="<?php echo $day_num; ?>" <?php echo ($day_num==$fh2)?'selected="selected"':''; ?>>
									<?php echo $day_num; ?>
								</option>
								<?php } ?>
							</select>:
							<select name="flex_m[]" class="txtselect" style="width:60px;">
								<?php for($i=0;$i<=59;$i++){ 
								$fm2 = intval($fm);
								$day_num = sprintf("%02s", $i);
								?>
								<option value="<?php echo $day_num; ?>" <?php echo ($day_num==$fm2)?'selected="selected"':''; ?>>
									<?php echo $day_num; ?>
								</option>
								<?php } ?>
							</select>
							<select name="flex_p[]" class="txtselect" style="width:60px;">
								<option value="AM" <?php echo ($fp=="AM")?'selected="selected"':''; ?>>AM</option>
								<option value="PM" <?php echo ($fp=="PM")?'selected="selected"':''; ?>>PM</option>
							</select>
						</td>
					</tr>
				</table> 	
			</div>
		</div>
		
	
		 
		

		

	<?php
	$flex_sql = $this->workday_model->get_flexible_hours($pg->payroll_group_id);
	if($flex_sql->num_rows()>0){
		$flex = $flex_sql->row();
		$tot_h_pd = $flex->total_hours_for_the_day;
		$tot_wd_pw = $flex->total_hours_for_the_week;
		$tot_days_py = $flex->total_days_per_year;
		$lta = $flex->latest_time_in_allowed;
		$num_breaks_pd = $flex->number_of_breaks_per_day;
		$bt1 = $flex->break1;
		$bt2 = $flex->break2;
		$bt3 = $flex->break3;
		$bt4 = $flex->break4;
		$dur_lb_pd = $flex->duration_of_lunch_break_per_day;
		$lta_h = date("h",strtotime($lta));
		$lta_m = date("i",strtotime($lta));
		$lta_p = date("A",strtotime($lta));
	}else{
		$tot_h_pd = "";
		$tot_wd_pw = "";
		$tot_days_py = "";
		$lta = "";
		$num_breaks_pd = "";
		$bt1 = "";
		$bt2 = "";
		$bt3 = "";
		$bt4 = "";
		$dur_lb_pd = "";
		$lta_h = "";
		$lta_m = "";
		$lta_p = "";
	}
	
	?>

	<div class="flexible_hours_div" <?php echo ($sel_wd=="Flexible Hours")?'style="display:block"':''; ?>> 
		<div style="float: left;">
			<table>
				<tr>
					<td>Total hours per day:</td><td><input type="text" name="tot_h_pd[]" class="txtfield" value="<?php echo $tot_h_pd; ?>" /></td>
				</tr>
				<tr>
					<td>Total hours for the week:</td><td><input type="text" class="txtfield" name="tot_wd_pw[]" value="<?php echo $tot_wd_pw; ?>" /></td>
				</tr>
				
				<tr>
					<td>Total days per year:</td><td><input type="text" class="txtfield" name="tot_days_py[]" value="<?php echo $tot_days_py; ?>" /></td>
				</tr>
				
				<tr>
					<td>Latest Time in Allowed</td>
					<td>
						<select name="lta_h[]" class="txtselect" style="width:60px;">
						<?php for($i=0;$i<=12;$i++){ 
						$lta_h2 = intval($lta_h);
						$day_num = sprintf("%02s", $i);
						?>
						<option value="<?php echo $day_num; ?>" <?php echo ($day_num==$lta_h2)?'selected="selected"':''; ?>>
							<?php echo $day_num; ?>
						</option>
						<?php } ?>
						</select>:
						<select name="lta_m[]" class="txtselect" style="width:60px;">
							<?php for($i=0;$i<=59;$i++){ 
							$lta_m2 = intval($lta_m);
							$day_num = sprintf("%02s", $i);
							?>
							<option value="<?php echo $day_num; ?>" <?php echo ($day_num==$lta_m2)?'selected="selected"':''; ?>>
								<?php echo $day_num; ?>
							</option>
							<?php } ?>
						</select>
						<select name="lta_p[]" class="txtselect" style="width:60px;margin-right: 90px;">
							<option value="AM" <?php echo ($lta_p=="AM")?'selected="selected"':''; ?>>AM</option>
							<option value="PM" <?php echo ($lta_p=="PM")?'selected="selected"':''; ?>>PM</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Duration of lunch break (per min) per day:</td><td><input type="text" class="txtfield" name="dur_lb_pd[]" value="<?php echo $dur_lb_pd; ?>" /></td>
				</tr>
				<tr>
					<td>Number of short breaks per day</td><td><input type="text" class="txtfield num_breaks_pd" name="num_breaks_pd[]" value="<?php echo $num_breaks_pd; ?>" /></td>
				</tr>
			</table>
		</div>
		
		
		<div>
			<table class="tbl_short_breaks">
				<?php
					if($bt1!=""){ ?>
					<tr>
						<td>Duration of short break (per min) per day:</td><td><input type="text" class="txtfield flex_break" name="flex_break1" value="<?php echo $bt1; ?>" /></td>
					</tr>
				<?php
					}
				?>
				<?php
					if($bt2!=""){ ?>
					<tr>
						<td>Duration of short break (per min) per day:</td><td><input type="text" class="txtfield flex_break" name="flex_break2" value="<?php echo $bt2; ?>" /></td>
					</tr>
				<?php
					}
				?>
				<?php
					if($bt3!=""){ ?>
					<tr>
						<td>Duration of short break (per min) per day:</td><td><input type="text" class="txtfield flex_break" name="flex_break3" value="<?php echo $bt3; ?>" /></td>
					</tr>
				<?php
					}
				?>
				<?php
					if($bt4!=""){ ?>
					<tr>
						<td>Duration of short break (per min) per day:</td><td><input type="text" class="txtfield flex_break" name="flex_break4" value="<?php echo $bt4; ?>" /></td>
					</tr>
				<?php
					}
				?>
			</table>	
		</div>
		
		<div style="clear:both;">&nbsp;</div>
		
		
	</div>
	
		
	
  
	<?php
	// get work shift 
	$ws_sql = $this->workday_model->get_workshift($pg->payroll_group_id);
	
	// get workshift settings
	$wss_sql = $this->workday_model->get_workshift_settings($pg->payroll_group_id);
	if($wss_sql->num_rows()>0){
		$wss = $wss_sql->row();
		$ws_nb = $wss->number_of_breaks_per_shift;
		$ws_twdpy = $wss->total_working_days_per_year;
		$ws_gpps = $wss->grace_period_for_every_shift;
	}else{
		$ws_nb = "";
		$ws_twdpy = "";
		$ws_gpps = "";
	}
	
	?>
	<div class="workshift_div" <?php echo ($sel_wd=="Workshift")?'style="display:block"':''; ?>>
		
		  
		<p>
		<input style="width:50px;" class="txtfield txtcenter text-nomal ws_break" name="ws_break[]" type="text" value="<?php echo $ws_nb; ?>" />
		Number of Breaks per Shift:  
        </p>
        <p> 
		<input type="text" name="shift_wd_py[]" style="width:50px;" class="txtfield txtcenter text-nomal break" value="<?php echo $ws_twdpy; ?>" />
		Total working days per year. (This will be the basis for the computation of daily rates of employees)
		</p> 
		  
		<div class="tbl-wrap ws_div">
			<table class="tbl ws_tbl">
				<tr>
					<th >&nbsp;</th>
					<th>Shift Name</th>
					<th>Start Time</th>
					<th class="ws_et">End Time</th>
					<?php 
					if($ws_nb>0){ 
						for($i=0;$i<$ws_nb;$i++){
					?>
						<th class="bt">Break Time(start)</th>
						<th class="ws_et bt">Break Time(End)</th>
					<?php 
						}
					} 
					?>
					<th>Working Hours</th>
					<th>Actions</th>
				</tr>
				<?php
				
				if($ws_sql->num_rows()>0){
					foreach($ws_sql->result() as $ws){ ?>
						<tr>
							<td>
								<input class="workshift_chk" type="checkbox" <?php echo ($ws->selected==1)?'checked="checked"':''; ?> />
								<input type="hidden" name="workshift[]" class="workshift" value="<?php echo $ws->workshift_id; ?>" />
								<input type="hidden" name="pg_id_ws[]" class="pg_id_ws" value="<?php echo $pg->payroll_group_id; ?>" />
								<input type="hidden" name="ws_sel[]" class="ws_sel" value="<?php echo ($ws->selected==1)?1:0; ?>">								
								<input type="hidden" value="Workshift" class="ws_wt_name" name="ws_wt_name[]">
								<input type="hidden" class="ws_last_index" name="ws_last_index[]" value="<?php echo $ws_nb; ?>" />
							</td>
							<td><input type="text" style="width:85px;" class="txtfield text-nomal" name="shift_name[]" value="<?php echo $ws->shift_name; ?>"></td>
							<td>
								<div class="wd_time_div">
									<select name="shift_st_h[]" class="txtselect" style="width:60px;">
										<?php for($i=0;$i<=12;$i++){ 
										$sel_day = intval(date("h",strtotime($ws->start_time)));
										$day_num = sprintf("%02s", $i);
										?>
										<option value="<?php echo $day_num; ?>" <?php echo ($day_num==$sel_day)?'selected="selected"':''; ?>>
											<?php echo $day_num; ?>
										</option>
										<?php } ?>
									</select>:
									<select name="shift_st_m[]" class="txtselect" style="width:60px;">
										<?php for($i=0;$i<=59;$i++){ 
										$sel_day = intval(date("i",strtotime($ws->start_time)));
										$day_num = sprintf("%02s", $i);
										?>
										<option value="<?php echo $day_num; ?>" <?php echo ($day_num==$sel_day)?'selected="selected"':''; ?>>
											<?php echo $day_num; ?>
										</option>
										<?php } ?>
									</select>
									<select name="shift_st_p[]" class="txtselect" style="width:60px;">
										<?php
										$wsp = date("A",strtotime($ws->start_time));
										?>
									  <option value="AM" <?php echo ($wsp=="AM")?'selected="selected"':''; ?>>AM</option>
									  <option value="PM" <?php echo ($wsp=="PM")?'selected="selected"':''; ?>>PM</option>
									</select>
								</div>
							</td>
							<td class="bt_insert">
								<div class="wd_time_div">
									<select name="shift_et_h[]" class="txtselect" style="width:60px;">
									   <?php for($i=0;$i<=12;$i++){ 
										$sel_day = intval(date("h",strtotime($ws->end_time)));
										$day_num = sprintf("%02s", $i);
									   ?>
										<option value="<?php echo $day_num; ?>" <?php echo ($day_num==$sel_day)?'selected="selected"':''; ?>>
											<?php echo $day_num; ?>
										</option>
										<?php } ?>
									 </select>:
									<select name="shift_et_m[]" class="txtselect" style="width:60px;">
										<?php for($i=0;$i<=59;$i++){ 
										$sel_day = intval(date("i",strtotime($ws->end_time)));
										$day_num = sprintf("%02s", $i);
										?>
										<option value="<?php echo $day_num; ?>" <?php echo ($day_num==$sel_day)?'selected="selected"':''; ?>>
											<?php echo $day_num; ?>
										</option>
										<?php } ?>
									</select>
									<select name="shift_et_p[]" class="txtselect" style="width:60px;">
									  <?php
										$wsp = date("A",strtotime($ws->end_time));
									  ?>
									  <option value="AM" <?php echo ($wsp=="AM")?'selected="selected"':''; ?>>AM</option>
									  <option value="PM" <?php echo ($wsp=="PM")?'selected="selected"':''; ?>>PM</option>
									</select>
								</div>
							</td>
							
							<?php
						// break time
					  if($wss_sql->num_rows()>0){ 
					  for($x=0;$x<$ws_nb;$x++){
					  //echo $pg->payroll_group_id.'-'.$day.'-'.($x+1);
					  $ws_bt_sql = $this->workday_model->get_ws_breaktime($pg->payroll_group_id,$ws->workshift_id,($x+1));
					  if($ws_bt_sql->num_rows()>0){
						$wsbt = $ws_bt_sql->row();
						// break time id
						$btid = $wsbt->break_time_id;
						// start time
						$st_h = date("h",strtotime($wsbt->start_time));
						$st_m =  date("i",strtotime($wsbt->start_time));
						$st_p =  date("A",strtotime($wsbt->start_time));
						// end time
						$et_h = date("h",strtotime($wsbt->end_time));
						$et_m = date("i",strtotime($wsbt->end_time));
						$et_p = date("A",strtotime($wsbt->end_time));;
					
					}else{
						$btid = "";
						$sel_day = "";
						$st_h = "";
						$st_m = "";
						$st_p = "";
						$et_h = "";
						$et_m = "";
						$et_p = "";
			
					}
					  ?>
						<td class="bt">
							
							<div class="wd_time_div">								
								<input type="hidden" name="wsbtid<?php echo $x; ?>[]" value="<?php echo $btid; ?>" />
								<select name="shift_bt_st_h<?php echo $x; ?>[]" class="txtselect" style="width:60px;">
								   <?php for($i=0;$i<=12;$i++){ 
									$st_h2 = intval($st_h);
									$day_num = sprintf("%02s", $i);
								   ?>
									<option value="<?php echo $day_num; ?>" <?php echo ($day_num==$st_h2)?'selected="selected"':''; ?>>
										<?php echo $day_num; ?>
									</option>
									<?php } ?>
								 </select>:
								<select name="shift_bt_st_m<?php echo $x; ?>[]" class="txtselect" style="width:60px;">
									<?php for($i=0;$i<=59;$i++){
									$st_m2 = intval($st_m);
									$day_num = sprintf("%02s", $i);
									?>
									<option value="<?php echo $day_num; ?>" <?php echo ($day_num==$st_m2)?'selected="selected"':''; ?>>
										<?php echo $day_num; ?>
									</option>
									<?php } ?>
								</select>
								<select name="shift_bt_st_p<?php echo $x; ?>[]" class="txtselect" style="width:60px;">
									<option value="AM" <?php echo ($st_p=="AM")?'selected="selected"':''; ?>>AM</option>
									<option value="PM" <?php echo ($st_p=="PM")?'selected="selected"':''; ?>>PM</option>
								</select>
							</div>
						</td>
						<td class="end_time_td bt">
					
							<div class="wd_time_div">
								<select name="shift_bt_et_h<?php echo $x; ?>[]" class="txtselect" style="width:60px;">
								   <?php for($i=0;$i<=12;$i++){ 
									$et_h2 = intval($et_h);
									$day_num = sprintf("%02s", $i);
								   ?>
									<option value="<?php echo $day_num; ?>" title="<?php echo $et_h2.'-'.$day_num; ?>" <?php echo ($day_num==$et_h2)?'selected="selected"':''; ?>>
										<?php echo $day_num; ?>
									</option>
									<?php } ?>
								 </select>:
								<select name="shift_bt_et_m<?php echo $x; ?>[]" class="txtselect" style="width:60px;">
									<?php for($i=0;$i<=59;$i++){ 
									$et_m2 = intval($et_m);
									$day_num = sprintf("%02s", $i);
									?>
									<option value="<?php echo $day_num; ?>" <?php echo ($day_num==$et_m2)?'selected="selected"':''; ?>>
										<?php echo $day_num; ?>
									</option>
									<?php } ?>
								</select>
								<select name="shift_bt_et_p<?php echo $x; ?>[]" class="txtselect" style="width:60px;">
								  <option <?php echo ($et_p=="AM")?'selected="selected"':''; ?>>AM</option>
								  <option <?php echo ($et_p=="PM")?'selected="selected"':''; ?>>PM</option>
								</select>
							</div>
						</td>
					  <?php
						}
					  }
					  ?>
							
							
							<td><?php echo $ws->working_hours; ?></td>
							<td>
								<div style="width: 140px;">
									<a class="btn btn-red btn-action btn-delete" href="javascript:void(0);">DELETE</a>
								</div>
							</td>
						</tr>
					<?php
					}
				}else{
					echo '<tr><td colspan="8" class="empty ws_empty">No workshift assigned yet</td></tr>';
				}
				
				?>
			</table>
			
			
			
		</div>
		
		<a href="javascript:void(0);" class="btn add-more" style="margin-bottom: 23px;">ADD MORE</a><br />
		
		<input type="text" style="width:50px;" class="txtfield" name="grace_value[]" value="<?php echo $ws_gpps; ?>" /> Grace period for every shift (in min)
		
	</div>
	
	</div>
	

</div>

<hr style="border: 1px solid rgb(204, 204, 204);margin-bottom: 20px;">


<?php
	}
}else{
	echo 'No Payroll Group created. click <a href="/'.$this->session->userdata('sub_domain').'/payroll_setup/payroll_group">here</a>';
}
?>	
<input type="submit" class="btn" name="save" value="SAVE" />
	
	<?php echo form_close(); ?>
        <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray left" href="#">BACK</a> <a class="btn btn-gray right" href="#"> CONTINUE</a>
        
        <!-- FOOTER-GRP-BTN END -->
      </div>
	  
	  
<div id="confirm-delete-dialog" class="jdialog"  title="Delete">
	<div class="inner_div">
		Are you sure you want to delete? 
	</div>
</div>  	
	  
	  
<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>
	  
<style>
.uniform_working_hours_div, .flexible_hours_div, .workshift_div {
    margin-bottom: 35px;
}
.wd_div table td{
	padding: 5px;
}
.flexible_hours_div input{
	width: 43px;
}
.workday_head{
	cursor:pointer;
}
.wd_time_div{
	width:200px;
}
.uniform_working_hours_div,
.flexible_hours_div,
.workshift_div,
.flex_div{
	display:none;
}
.flexible_hours_div td{
	padding: 4px 15px;
}

</style>

<script>
jQuery(document).ready(function(){


	// load highlight message script
	redirect_highlight_message();
	
	// break time script
	function break_time(obj){
		//console.log('inside');
		obj.parents(".uniform_working_hours_div").find(".bt").remove();
		var num_of_break = parseInt(obj.val());
		for(var i=0;i<num_of_break;i++){
			var str = '<th colspan="2" class="bt">Break Time '+(i+1)+'</th>';
			obj.parents(".payroll_group_div").find(".wh1").before(str);
			
			var str2 = ''+
				'<th class="bt">Start Time</th>'+
				'<th class="bt">End Time</th>';
			obj.parents(".payroll_group_div").find(".wh2").before(str2);
			
			var str3 = ''+
				'<td class="bt">'+
					'<div class="wd_time_div">'+
						'<select name="bt_st_h'+i+'[]" class="txtselect" style="width:60px;">'+
						'<?php for($i=0;$i<=12;$i++){ 
							echo '<option value="'.sprintf("%02s", $i).'">'.sprintf("%02s", $i).'</option>';
						} ?>'+ 
						'</select>:'+
						'<select name="bt_st_m'+i+'[]" class="txtselect" style="width:60px;">'+
						'<?php for($i=0;$i<=59;$i++){ 
							echo '<option value="'.sprintf("%02s", $i).'">'.sprintf("%02s", $i).'</option>';
						} ?>'+ 
						'</select>'+
						'<select name="bt_st_p'+i+'[]" class="txtselect" style="width:60px;">'+
						  '<option value="AM">AM</option>'+
						  '<option value="PM">PM</option>'+
						'</select>'+
					'</div>'+
				'</td>'+
				'<td class="bt">'+
					'<div class="wd_time_div">'+
						'<select name="bt_et_h'+i+'[]" class="txtselect" style="width:60px;">'+
						   '<?php for($i=0;$i<=12;$i++){ 
							echo '<option value="'.sprintf("%02s", $i).'">'.sprintf("%02s", $i).'</option>';
						} ?>'+ 
						'</select>:'+
						'<select name="bt_et_m'+i+'[]" class="txtselect" style="width:60px;">'+
						'<?php for($i=0;$i<=59;$i++){ 
							echo '<option value="'.sprintf("%02s", $i).'">'.sprintf("%02s", $i).'</option>';
						} ?>'+ 
						'</select>'+
						'<select name="bt_et_p'+i+'[]" class="txtselect" style="width:60px;">'+
						  '<option value="AM">AM</option>'+
						  '<option value="PM">PM</option>'+
						'</select>'+
					'</div>'+
				'</td>';
			obj.parents(".payroll_group_div").find(".wh3").before(str3);
		}
		obj.parents(".payroll_group_div").find(".break_last_index").val(i);
	}

	// custom accordion script
	jQuery(".workday_head").click(function(){
		jQuery(this).parents(".payroll_group_div").find(".workday_body").slideToggle();
	});
	
	// invoke break time script
	// onload
	/*
	jQuery(".break").each(function(){
		//console.log('weeee');
		break_time(jQuery(this));
	});
	*/
	
	// on blur
	jQuery(".break").blur(function(){
		break_time(jQuery(this));
	});
	
	// hide/show flexible hours
	jQuery(".flex_chk").click(function(){
		jQuery(this).parents(".payroll_group_div").find(".flex_div").slideToggle();
	});
	
	// hide show workshift
	jQuery(".ws_chk").click(function(){
		jQuery(this).parents(".payroll_group_div").find(".ws_div").slideToggle();
	});
	
	// add workshift
	jQuery(".add-more").click(function(){
		//jQuery(this).parents(".workshift_div").find(".bt").remove();
		var pg_id = jQuery(this).parents(".payroll_group_div").find(".pg_id:first").val();
		var num_of_shift = jQuery(this).parents(".payroll_group_div").find(".shift_name").length;
		if(num_of_shift<1){
		
		jQuery(this).parents(".payroll_group_div").find(".empty").hide();
		str = ''+
			'<tr>'+
				'<td>'+
					'<input type="checkbox" class="workshift_chk" value="">'+
					'<input type="hidden" name="workshift[]" value="">'+
					'<input name="pg_id_ws[]" class="pg_id_ws" type="hidden" value="'+pg_id+'">'+
					'<input name="ws_sel[]" class="ws_sel" type="hidden" value="0">'+
					'<input type="hidden" name="is_delete[]" class="is_delete" value="0" />'+
					'<input type="hidden" name="ws_last_index[]" class="ws_last_index" value="0" />'+
					'<input type="hidden" name="ws_wt_name[]" class="ws_wt_name" value="Workshift" />'+
				'</td>'+
				'<td><input style="width:85px;" class="txtfield text-nomal shift_name" name="shift_name[]" type="text" /></td>'+
				'<td>'+
					'<div class="wd_time_div">'+
						'<select class="txtselect shift_st_h" name="shift_st_h[]" style="width:60px;">'+
						   '<?php for($i=0;$i<=12;$i++){ 
								echo '<option value="'.sprintf("%02s", $i).'">'.sprintf("%02s", $i).'</option>';
							} ?>'+ 
						 '</select>:'+
						'<select class="txtselect shift_st_m" name="shift_st_m[]" style="width:60px;">'+
							'<?php for($i=0;$i<=59;$i++){ 
								echo '<option value="'.sprintf("%02s", $i).'">'.sprintf("%02s", $i).'</option>';
							} ?>'+ 
						'</select>'+
						'<select class="txtselect shift_st_p" name="shift_st_p[]" style="width:60px;">'+
							  '<option value="AM">AM</option>'+
							  '<option value="PM">PM</option>'+
						'</select>'+
					'</div>'+
				'</td>'+
				'<td>'+
					'<div class="wd_time_div">'+
						'<select class="txtselect shift_et_h" name="shift_et_h[]" style="width:60px;">'+
						   '<?php for($i=0;$i<=12;$i++){ 
								echo '<option value="'.sprintf("%02s", $i).'">'.sprintf("%02s", $i).'</option>';
							} ?>'+ 
						'</select>:'+
						'<select class="txtselect shift_et_m" name="shift_et_m[]" style="width:60px;">'+
							'<?php for($i=0;$i<=59;$i++){ 
								echo '<option value="'.sprintf("%02s", $i).'">'.sprintf("%02s", $i).'</option>';
							} ?>'+ 
						'</select>'+
						'<select class="txtselect shift_et_p" name="shift_et_p[]" style="width:60px;">'+
							'<option value="AM">AM</option>'+
							'<option value="PM">PM</option>'+
						'</select>'+
					'</div>'+
				'</td>';
				
				var ws_bt = parseInt(jQuery(this).parents(".payroll_group_div").find(".ws_break").val());
				//console.log(ws_bt);
				
				for(var i=0;i<ws_bt;i++){
					str +='<td class="bt">'+
					'<div class="wd_time_div">'+
						'<select class="txtselect shift_bt_st_h" name="shift_bt_st_h'+i+'[]" style="width:60px;">'+
						   '<?php for($i=0;$i<=12;$i++){ 
								echo '<option value="'.sprintf("%02s", $i).'">'.sprintf("%02s", $i).'</option>';
							} ?>'+ 
						 '</select>:'+
						'<select class="txtselect shift_bt_st_m" name="shift_bt_st_m'+i+'[]" style="width:60px;">'+
							'<?php for($i=0;$i<=59;$i++){ 
								echo '<option value="'.sprintf("%02s", $i).'">'.sprintf("%02s", $i).'</option>';
							} ?>'+ 
						'</select>'+
						'<select class="txtselect shift_bt_st_p" name="shift_bt_st_p'+i+'[]" style="width:60px;">'+
							  '<option value="AM">AM</option>'+
							  '<option value="PM">PM</option>'+
						'</select>'+
					'</div>'+
					'</td>'+
					'<td class="bt">'+
						'<div class="wd_time_div">'+
							'<select class="txtselect shift_bt_et_h" name="shift_bt_et_h'+i+'[]" style="width:60px;">'+
							   '<?php for($i=0;$i<=12;$i++){ 
									echo '<option value="'.sprintf("%02s", $i).'">'.sprintf("%02s", $i).'</option>';
								} ?>'+ 
							'</select>:'+
							'<select class="txtselect shift_bt_et_m" name="shift_bt_et_m'+i+'[]" style="width:60px;">'+
								'<?php for($i=0;$i<=59;$i++){ 
									echo '<option value="'.sprintf("%02s", $i).'">'.sprintf("%02s", $i).'</option>';
								} ?>'+ 
							'</select>'+
							'<select class="txtselect shift_bt_et_p" name="shift_bt_et_p'+i+'[]" style="width:60px;">'+
								'<option value="AM">AM</option>'+
								'<option value="PM">PM</option>'+
							'</select>'+
						'</div>'+
					'</td>';
				}
				
				
				
				str += '<td></td>'+
				'<td>'+
					'<div style="width: 140px;">'+
						'<a class="btn btn-red btn-action btn-remove" href="javascript:void(0);" title="'+pg_id+'">REMOVE</a>'+
					'</div>'+
				'</td>'+
			'</tr>';
		jQuery(this).parents(".payroll_group_div").find(".ws_tbl tbody").append(str);
		jQuery(this).parents(".payroll_group_div").find(".ws_last_index").val(i);
		
		}else{
			alert("Only 1 shift can be created");
		}
		
		
		/*
		jQuery(".workshift").each(function(index){
			jQuery(this).val(index);
		});
		*/
	});
	
	// remove earnings row
	jQuery(document).on("click",".btn-remove",function(){
		var pg_id = jQuery(this).attr("title");
		jQuery(this).parents("tr:first").remove();
		var shift = jQuery("#main-pg-div-"+pg_id).find(".shift_name").length;
		console.log(shift);
		//console.log(pg_id+' - '+shift);
		if(shift==0){
			jQuery("#main-pg-div-"+pg_id).find(".empty").show();
		}
	});
	
	// mark "allow flexible workhours" as checked
	jQuery(document).on("click",".flex_chk",function(){
		if(jQuery(this).prop("checked")==true){
			jQuery(this).parents(".main_flex_div").find(".flex_chk_sel").val(1);
		}else{
			jQuery(this).parents(".main_flex_div").find(".flex_chk_sel").val(0);
		}
	});
	
	// mark workshift as selected
	jQuery(document).on("click",".workshift_chk",function(){
		if(jQuery(this).prop("checked")==true){
			jQuery(this).parents("tr:first").find(".ws_sel").val(1);
		}else{
			jQuery(this).parents("tr:first").find(".ws_sel").val(0);
		}
	});
	
	// delete workday script
	jQuery(".workday_chk").click(function(){
		var parent = jQuery(this).parents("tr:first");
		if(jQuery(this).prop("checked")==false){
			var sel_wdid = parent.find(".sel_wdid").val();
			if(sel_wdid!=""){
				parent.find(".is_delete").val(1);
			}
		}else{
			parent.find(".is_delete").val(0);
		}
	});
	
	
	
	// working day dropdown script
	jQuery(".workday_type").change(function(){
		var wt = jQuery(this).val();
		var parent = jQuery(this).parents(".payroll_group_div");
		switch(wt){
			case 'Uniform Working Days':
				parent.find(".uniform_working_hours_div").slideDown();
				parent.find(".flexible_hours_div").slideUp();
				parent.find(".workshift_div").slideUp();
			break;
			case 'Flexible Hours':
				parent.find(".uniform_working_hours_div").slideUp();
				parent.find(".flexible_hours_div").slideDown();
				parent.find(".workshift_div").slideUp();
			break;
			case 'Workshift':
				parent.find(".uniform_working_hours_div").slideUp();
				parent.find(".flexible_hours_div").slideUp();
				parent.find(".workshift_div").slideDown();
			break;
			default:
				parent.find(".uniform_working_hours_div").slideUp();
				parent.find(".flexible_hours_div").slideUp();
				parent.find(".workshift_div").slideUp();
		}
	});
	
	jQuery(".ws_break").blur(function(){
		jQuery(this).parents(".workshift_div").find(".bt").remove();
		var bt = parseInt(jQuery(this).val());
		cp = 8+(bt*2);
		jQuery(".ws_empty").attr("colspan",cp);
		var str = "";
		var str2 = "";
		for(var i=0;i<bt;i++){
		
			str += '<th class="bt">Break Time(Start)</th><th class="ws_et_bt bt">Break Time(End)</th>';
			
			str2 +='<td class="bt">'+
					'<div class="wd_time_div">'+
						'<select class="txtselect shift_bt_st_h" name="shift_bt_st_h'+i+'[]" style="width:60px;">'+
						   '<?php for($i=0;$i<=12;$i++){ 
								echo '<option value="'.sprintf("%02s", $i).'">'.sprintf("%02s", $i).'</option>';
							} ?>'+ 
						 '</select>:'+
						'<select class="txtselect shift_bt_st_m" name="shift_bt_st_m'+i+'[]" style="width:60px;">'+
							'<?php for($i=0;$i<=59;$i++){ 
								echo '<option value="'.sprintf("%02s", $i).'">'.sprintf("%02s", $i).'</option>';
							} ?>'+ 
						'</select>'+
						'<select class="txtselect shift_bt_st_p" name="shift_bt_st_p'+i+'[]" style="width:60px;">'+
							  '<option value="AM">AM</option>'+
							  '<option value="PM">PM</option>'+
						'</select>'+
					'</div>'+
					'</td>'+
					'<td class="bt">'+
						'<div class="wd_time_div">'+
							'<select class="txtselect shift_bt_et_h" name="shift_bt_et_h'+i+'[]" style="width:60px;">'+
							   '<?php for($i=0;$i<=12;$i++){ 
									echo '<option value="'.sprintf("%02s", $i).'">'.sprintf("%02s", $i).'</option>';
								} ?>'+ 
							'</select>:'+
							'<select class="txtselect shift_bt_et_m" name="shift_bt_et_m'+i+'[]" style="width:60px;">'+
								'<?php for($i=0;$i<=59;$i++){ 
									echo '<option value="'.sprintf("%02s", $i).'">'.sprintf("%02s", $i).'</option>';
								} ?>'+ 
							'</select>'+
							'<select class="txtselect shift_bt_et_p" name="shift_bt_et_p'+i+'[]" style="width:60px;">'+
								'<option value="AM">AM</option>'+
								'<option value="PM">PM</option>'+
							'</select>'+
						'</div>'+
					'</td>';
					
		}
		
		jQuery(".ws_et:last").after(str);
		jQuery(this).parents(".payroll_group_div").find(".bt_insert").after(str2);
	});
	
	// delete earnings
	jQuery(".btn-delete").click(function(){
		var obj = jQuery(this);
		jQuery("#confirm-delete-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'yes': function() {
					var wsid = obj.parents("tr").find(".workshift").val();
					// ajax call
					jQuery.ajax({
						type: "POST",
						url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/workday/ajax_delete_workshift",
						data: {
							wsid: wsid,
							<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
						}
					}).done(function(ret){
						jQuery.cookie("msg", "Workshift has been deleted");
						window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/workday";
					});				
				},
				'no': function() {
					jQuery(this).dialog( 'close' );					
				}
			}
		});
	});
	
	// flexible hours breaks script
	jQuery(".num_breaks_pd").blur(function(){

		var num = jQuery(this).val();
		var str = "";
		
		if(num<=4){
			for(var i=1;i<=num;i++){
				str += '<tr>'+
							'<td>Duration of short break '+i+'(per min) per day:</td>'+
							'<td><input type="text" class="txtfield flex_break" name="flex_break'+i+'" value="" /></td>'+
						'</tr>';
			}		
			jQuery(this).parents(".payroll_group_div").find(".tbl_short_breaks").html(str);
		}else{
			var num_of_breaks = jQuery(this).parents(".payroll_group_div").find(".flex_break").length;
			jQuery(this).parents(".payroll_group_div").find(".num_breaks_pd").val(num_of_breaks);
			alert("you can only assign a maximum of 4 breaks");
		}
		
	});
	
	
});
</script>