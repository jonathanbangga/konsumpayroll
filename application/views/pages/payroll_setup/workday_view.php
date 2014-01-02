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
<div class="workday_div" id="main-pg-div-<?php echo $pg->payroll_group_id; ?>">
	<input type="hidden" name="main_pg_id[]" value="<?php echo $pg->payroll_group_id; ?>" />
	<p><strong class="workday_head">Working Days for <?php echo $pg->name; ?></strong>
	<?php
	// get working days settings
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
	?>
	<input type="hidden" name="wd_id[]" value="<?php echo $ws_id; ?>" />
	  <select style="margin-left:5px; width:152px;" class="txtselect" name="workday_type[]">
		<option value="">Select Working Days</option>
		<option value="Uniform Working Days" <?php echo ($wd=="Uniform Working Days")?'selected="selected"':''; ?>>Uniform Working Days</option>
		<option value="Flexible Hours" <?php echo ($wd=="Flexible Hours")?'selected="selected"':''; ?>>Flexible Hours</option>
		<option value="Workshift" <?php echo ($wd=="Workshift")?'selected="selected"':''; ?>>Workshift</option>
	  </select>
	</p>
	


	<div class="workday_body" <?php echo ($pgi>0)?'style="display:none;"':''; ?>>
		
        <p>Number of Breaks per Day:
		<?php
		if($nob!=""){
			echo $nob;
		?>
			<input type="hidden" name="num_of_break[]" value="<?php echo $nob; ?>" />
		<?php
		}else{ ?>
			<input style="width:50px;" class="txtfield txtcenter text-nomal break" name="num_of_break[]" type="text" value="0" />
		<?php
		}
		?>
          
        </p>
        <p> Total working days per year. (This will be the basis for the computation of daily rates of employees)</p>
        <div class="tbl-wrap">
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
				<th>&nbsp;</th>
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
				  <th>Start Time</th>
				  <th>End Time</th>
			  <?php
				}
			  }
			  ?>
              <th class="wh2">Working Hours</th>
              <th>Actions</th>
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
				$swd_sql = $this->workday_model->get_workdays($pg->payroll_group_id,$day);
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
						<input type="checkbox" name="workday[]" id="checkbox" value="<?php echo $day; ?>-<?php echo $index; ?>" <?php echo ($sel_day!="")?'checked="checked"':''; ?>  />
						<input type="hidden" name="pg_id[]" class="pg_id" value="<?php echo $pg->payroll_group_id; ?>" />
						<input type="hidden" name="break_last_index[]" class="break_last_index" value="<?php echo $num_break; ?>" />
						<input type="hidden" name="sel_wdid[]" class="sel_wdid" value="<?php echo $sel_wdid; ?>" />
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
						<td>
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
						<td class="end_time_td">
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
				   <td class="wh3"><input style="width:50px;" class="txtfield" name="working_hours[]" type="text" value="<?php echo $working_hours; ?>"></td>
				   <td><a class="btn btn-gray" href="#">EDIT</a></td>
				</tr>
			<?php
			$index++;
			} ?>
            
          </table>
        </div>
	

	<div class="wd_div">
		<table>
			<tr>
				<td>working days per year:</td>
				<td><input type="text" class="txtfield" name="wd_py[]" value="<?php echo $wd_py; ?>" /></td>
			</tr>
			<tr>
				<td>duration of lunch per year:</td>
				<td><input type="text" class="txtfield" name="dl_py[]" value="<?php echo $dl_py; ?>" /></td>
			</tr>
			<tr>
				<td>duration of short breaks per year:</td>
				<td><input type="text" class="txtfield" name="dsb_py[]" value="<?php echo $dsb_py; ?>" /></td>
			</tr>
		</table> 
	</div>
	
		
	<div class="main_flex_div">	
		<p style="margin-top: 42px;">
			<input type="hidden" name="flex_chk_sel[]" class="flex_chk_sel" value="<?php echo ($allow_flex==1)?1:0; ?>"  />
			<input type="checkbox" name="flex_chk[]" class="flex_chk" value="1" <?php echo ($allow_flex==1)?'checked="checked"':''; ?> /> Allow flexible workhours
		</p>   
		
		<?php
		if($allow_flex==1){
			$fh = date("h",strtotime($flex_time));
			$fm = date("i",strtotime($flex_time));
			$fp = date("A",strtotime($flex_time));
		}else{
			$fh = "";
			$fm = "";
			$fp = "";
		}
		?>

		<div class="wd_div flex_div" <?php echo ($allow_flex==1)?'style="display:block;"':''; ?>>
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
	// get work shift 
	$ws_sql = $this->workday_model->get_workshift($pg->payroll_group_id);
	?>
	<div class="main_ws_div" style="margin-bottom: 30px;">
		<p><input style="margin:2px 5px 0 0;" class="ws_chk" name="" type="checkbox" value="1" <?php echo ($ws_sql->num_rows()>0)?'checked="checked"':''; ?> />Workshifts</p>
		  
		  
		<div class="tbl-wrap ws_div" <?php echo ($ws_sql->num_rows()>0)?'style="display:block;"':''; ?>>
			<table class="tbl ws_tbl">
				<tr>
					<th >&nbsp;</th>
					<th>Shift Name</th>
					<th>Start Time</th>
					<th>End Time</th>
					<th>Working Hours</th>
					<th>Actions</th>
				</tr>
				<?php
				if($ws_sql->num_rows()>0){
					foreach($ws_sql->result() as $ws){ ?>
						<tr>
							<td>
								<input name="workshift[]" type="checkbox" value="<?php echo $ws->workshift_id; ?>" <?php echo ($ws->selected==1)?'checked="checked"':''; ?> />
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
										<option value="<?php $day_num; ?>" <?php echo ($day_num==$sel_day)?'selected="selected"':''; ?>>
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
							<td>
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
							<td><input style="width:50px;" class="txtfield text-nomal txtcenter" name="shift_wh[]" type="text" value="<?php echo $ws->working_hours; ?>"></td>
							<td>
								<div style="width: 140px;">
									<a class="btn btn-gray btn-action" href="#">EDIT</a> 
									<a class="btn btn-red btn-action" href="#">DELETE</a>
								</div>
							</td>
						</tr>
					<?php
					}
				}else{
					echo '<tr><td colspan="6" class="empty">No workshift assigned yet</td></tr>';
				}
				?>
			</table>
			<a href="javascript:void(0);" class="btn add-more" style="margin-top: 15px;">ADD MORE</a>
		</div>
		
	</div>
	
	
	


	</div>

</div>


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
	  
<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>
	  
<style>
.wd_div{
	margin-bottom: 33px;	
}
.wd_div table td{
	padding: 5px;
}
.wd_div input{
	width: 43px;
}
.workday_head{
	cursor:pointer;
}
.wd_time_div{
	width:200px;
}
.flex_div, .ws_div{
	display:none;
}
</style>

<script>
jQuery(document).ready(function(){


	// load highlight message script
	redirect_highlight_message();
	
	// break time script
	function break_time(obj){
		//console.log('inside');
		obj.parents(".workday_div").find(".bt").remove();
		var num_of_break = parseInt(obj.val());
		for(var i=0;i<num_of_break;i++){
			var str = '<th colspan="2" class="bt">Break Time '+(i+1)+'</th>';
			obj.parents(".workday_div").find(".wh1").before(str);
			
			var str2 = ''+
				'<th class="bt">Start Time</th>'+
				'<th class="bt">End Time</th>';
			obj.parents(".workday_div").find(".wh2").before(str2);
			
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
			obj.parents(".workday_div").find(".wh3").before(str3);
		}
		obj.parents(".workday_div").find(".break_last_index").val(i);
	}

	// custom accordion script
	jQuery(".workday_head").click(function(){
		jQuery(this).parents(".workday_div").find(".workday_body").slideToggle();
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
		jQuery(this).parents(".main_flex_div").find(".flex_div").slideToggle();
	});
	
	// hide show workshift
	jQuery(".ws_chk").click(function(){
		jQuery(this).parents(".main_ws_div").find(".ws_div").slideToggle();
	});
	
	// add workshift
	jQuery(".add-more").click(function(){
		var pg_id = jQuery(this).parents(".workday_div").find(".pg_id:first").val();
		jQuery(this).parents(".main_ws_div").find(".empty").hide();
		str = ''+
			'<tr>'+
				'<td>'+
					'<input name="workshift[]" class="workshift" type="checkbox" value="">'+
					'<input name="pg_id_ws[]" class="pg_id_ws" type="hidden" value="'+pg_id+'">'+
					'<input name="ws_sel[]" class="ws_sel" type="hidden" value="0">'+
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
							  '<option>AM</option>'+
							  '<option>PM</option>'+
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
							'<option>AM</option>'+
							'<option>PM</option>'+
						'</select>'+
					'</div>'+
				'</td>'+
				'<td><input style="width:50px;" class="txtfield text-nomal txtcenter shift_wh" name="shift_wh[]" type="text" /></td>'+
				'<td>'+
					'<div style="width: 140px;">'+
						'<a class="btn btn-gray btn-action" href="#">EDIT</a>'+
						'<a class="btn btn-red btn-action btn-remove" href="javascript:void(0);" title="'+pg_id+'">REMOVE</a>'+
					'</div>'+
				'</td>'+
			'</tr>';
		jQuery(this).parents(".main_ws_div").find(".ws_tbl tbody").append(str);
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
	jQuery(document).on("click",".workshift",function(){
		if(jQuery(this).prop("checked")==true){
			jQuery(this).parents("tr:first").find(".ws_sel").val(1);
		}else{
			jQuery(this).parents("tr:first").find(".ws_sel").val(0);
		}
	});
	
	
	
});
</script>