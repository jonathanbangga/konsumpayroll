<div class="tbl-wrap">
	<div class="main_time_in_cont">
		<div class="date_cont"><span><?php print date("F")." ".date("d").", ".date("Y");?></span></div>
		<div class="ihide">
			<?php 
				print "<span class='month_val'>".date("m")."</span> ";
				print "<span class='day_val'>".date("d")."</span> ";
				print "<span class='year_val'>".date("Y")."</span>";
			?>
		</div>
		<div class="time_cont"><span></span></div>
		<div class="in_out_cont">
			<?php 
				// If datetime is not already exist in table
				if($time_out == 0){
					print '<a href="javascript:void(0);" class="btn_left btn in_btn">In</a>';
					print '<a href="javascript:void(0);" class="btn btn-gray disable_btn" onclick="return false;">Out</a>';	
				}elseif($time_out == 1){
					print '<a href="javascript:void(0);" class="btn_left btn disable_btn" onclick="return false;">In</a>';
					print '<a href="javascript:void(0);" class="btn btn-gray out_btn">Out</a>';
				}elseif($time_out == 2){
					print '<a href="javascript:void(0);" class="btn_left btn disable_btn" onclick="return false;">In</a>';
					print '<a href="javascript:void(0);" class="btn btn-gray disable_btn" onclick="return false;">Out</a>';
				}
			?>
		</div>
	</div>
	<div class="time_in_table_cont">
		<?php print $this->session->flashdata('message');?>
		<table class="tbl" width="933px">
			<tr>
				<th>Date</th>
				<th>Time In</th>
				<th>Lunch Out</th>
				<th>Lunch In</th>
				<th>Time Out</th>
				<th>Hours</th>
				<th>Corrected</th>
				<th>Reason</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
			<?php 
				if($time_in_list != null){
					foreach($time_in_list as $row){
			?>
				<tr>
					<td><span class="ihide"><?php print $row->date;?></span><?php print date("M d, Y",strtotime($row->date));?></td>
					<td><span class="ihide"><?php print $row->time_in;?></span><?php print date("g:i A",strtotime($row->time_in));?></td>
					<td><span class="ihide"><?php print $row->lunch_out;?></span><?php print ($row->lunch_out == "00:00:00") ? $row->lunch_out : date("g:i A",strtotime($row->lunch_out));?></td>
					<td><span class="ihide"><?php print $row->lunch_in;?></span><?php print ($row->lunch_in == "00:00:00") ? $row->lunch_in : date("g:i A",strtotime($row->lunch_in));?></td>
					<td><span class="ihide"><?php print $row->time_out;?></span><?php print ($row->time_out == "00:00:00") ? $row->time_out : date("g:i A",strtotime($row->time_out));?></td>
					<td><span class="ihide"><?php print $row->total_hours;?></span><?php print $row->total_hours;?></td>
					<td><span class="ihide"><?php print $row->corrected;?></span><?php print $row->corrected;?></td>
					<td><span class="ihide"><?php print $row->reason;?></span><?php print $row->reason;?></td>
					<td><span class="ihide"><?php print $row->tax_status;?></span><?php print $row->tax_status;?></td>
					<td>
					<?php 
						print '<a href="javascript:void(0);" class="btn btn-action change_log_btn" attr_timein_id="'.$row->employee_time_in_id.'">CHANGE</a>';
					?>
					</td>
				</tr>
			<?php 		
					}
				}else{
					echo "<td colspan='10'>";
					print msg_empty();
					echo "</td>";
				}
			?>
		</table>
	</div>
</div>

		<div class='changeLogs ihide' title='Change Logs'>
		<?php print form_open('','onsubmit="return validate_form()" enctype="multipart/form-data"');?>
			  <div>
          <!-- TBL-WRAP START -->
          <table width="100%">
            <tbody>
              <tr><td width="70px">Time In</td>
              <td>
              	<input type="hidden" name="employee_timein" class="employee_timein ihide" />
              	<select name="time_in_hr" class="txtselect time_in_hr" style="width:60px;">
              		<?php 
              			for($hrs=00;$hrs<=12;$hrs++){
              				$hrs = (strlen($hrs)==1) ? "0".$hrs : $hrs;
              				print "<option value='{$hrs}' name='time_in_hr'>".$hrs."</option>";
              			}
              		?>
                </select>
                :
                <select name="time_in_min" class="txtselect time_in_min" style="width:60px;">
                  	<?php 
              			for($hrs=00;$hrs<=59;$hrs++){
              				$hrs = (strlen($hrs)==1) ? "0".$hrs : $hrs;
              				print "<option value='{$hrs}' name='time_in_min'>".$hrs."</option>";
              			}
              		?>
                </select>
                <select name="time_in_ampm" class="txtselect time_in_ampm" style="width:60px;">
                  	<?php 
                  		print "<option value='00' name='time_in_ampm'></option>";
              			print "<option value='AM' name='time_in_ampm'>AM</option>";
              			print "<option value='PM' name='time_in_ampm'>PM</option>";
              		?>
                </select>
              </td></tr>
		    <tr>
              <td>Lunch Out</td>
              	<td>
					<select name="lunch_out_hr" class="lunch_out_hr txtselect" style="width:60px;">
	                    <?php 
	              			for($hrs=00;$hrs<=12;$hrs++){
	              				$hrs = (strlen($hrs)==1) ? "0".$hrs : $hrs;
              					print "<option value='{$hrs}' name='lunch_out_hr'>".$hrs."</option>";
	              			}
	              		?>
	                </select>
	                :
	                <select name="lunch_out_min" class="lunch_out_min txtselect" style="width:60px;">
	                   <?php 
	              			for($hrs=00;$hrs<=59;$hrs++){
	              				$hrs = (strlen($hrs)==1) ? "0".$hrs : $hrs;
              					print "<option value='{$hrs}' name='lunch_out_min'>".$hrs."</option>";
	              			}
	              		?>
	                </select>
	                <select name="lunch_out_ampm" class="lunch_out_ampm txtselect" style="width:60px;">
	                  	<?php 
	                  		print "<option value='00' name='lunch_out_ampm'></option>";
	              			print "<option value='AM' name='lunch_out_ampm'>AM</option>";
              				print "<option value='PM' name='lunch_out_ampm'>PM</option>";
	              		?>
	                </select>
                </td>              	
              </tr>
           	<tr>
              <td>Lunch In</td>
	              <td>
              		<select name="lunch_in_hr" class="lunch_in_hr txtselect" style="width:60px;">
	                  	<?php 
	              			for($hrs=00;$hrs<=12;$hrs++){
              					$hrs = (strlen($hrs)==1) ? "0".$hrs : $hrs;
              					print "<option value='{$hrs}' name='lunch_in_hr'>".$hrs."</option>";	
	              			}
	              		?>
	                </select>
	                :
	                <select name="lunch_in_min" class="lunch_in_min txtselect" style="width:60px;">
	                  	<?php 
	              			for($hrs=00;$hrs<=59;$hrs++){
	              				$hrs = (strlen($hrs)==1) ? "0".$hrs : $hrs;
              					print "<option value='{$hrs}' name='lunch_in_hr'>".$hrs."</option>";
	              			}
	              		?>
	                </select>
	                <select name="lunch_in_ampm" class="lunch_in_ampm txtselect" style="width:60px;">
	                 	<?php 
	                 		print "<option value='00' name='lunch_in_ampm'></option>";
	              			print "<option value='AM' name='lunch_in_ampm'>AM</option>";
              				print "<option value='PM' name='lunch_in_ampm'>PM</option>";
	              		?>
	                </select>
	              </td>
              </tr>
              <tr>
              <td>Time Out</td>
	              <td>
              		<select name="time_out_hr" class="time_out_hr txtselect" style="width:60px;">
	                  	<?php 
	              			for($hrs=00;$hrs<=12;$hrs++){
              					$hrs = (strlen($hrs)==1) ? "0".$hrs : $hrs;
              					print "<option value='{$hrs}' name='time_out_hr'>".$hrs."</option>";	
	              			}
	              		?>
	                </select>
	                :
	                <select name="time_out_min" class="time_out_min txtselect" style="width:60px;">
	                  	<?php 
	              			for($hrs=00;$hrs<=59;$hrs++){
	              				$hrs = (strlen($hrs)==1) ? "0".$hrs : $hrs;
              					print "<option value='{$hrs}' name='time_out_hr'>".$hrs."</option>";
	              			}
	              		?>
	                </select>
	                <select name="time_out_ampm" class="time_out_ampm txtselect" style="width:60px;">
	                 	<?php 
	                 		print "<option value='00' name='time_out_ampm'></option>";
	              			print "<option value='AM' name='time_out_ampm'>AM</option>";
              				print "<option value='PM' name='time_out_ampm'>PM</option>";
	              		?>
	                </select>
	              </td>
              </tr>
            <tr>
              <td style="vertical-align: top;">Reason</td>
              <td>
              	<textarea name="reason" class="reason txtfield" style="height: 50px;width: 178px;"></textarea>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right;">
	              <input type="submit" value="Submit" name="update_log" class="btn" />
              </td>
            </tr>
          </tbody></table>
          <!-- TBL-WRAP END -->
        </div>
        <?php print form_close();?>
        </div>

<style>
	.main_time_in_cont {
		border: 1px solid #CCCCCC;
	    height: 235px;
	}
	.date_cont {
		margin-top: 50px;
    	text-align: center;
    	height: 18px;
	}
	.date_cont span {
		font-size:18pt;
	}
	.time_cont {
		margin-top:30px;
		text-align: center;
	}
	.time_cont span{
		font-size:48pt;
		font-weight:bold;
	}
	.in_out_cont{
		margin-top: 45px;
    	text-align: center;
	}
	.btn_left{
		margin-right: 20px;
	}
	.time_in_table_cont {
		margin-top: 30px;
	}
	.disable_btn {
		opacity: 0.2!important;
	}
</style>
<script>
	function updateTime() {
		var currentTime = new Date();
		var hours = currentTime.getHours();
		var minutes = currentTime.getMinutes();
		var seconds = currentTime.getSeconds();
		if (minutes < 10){
			minutes = "0" + minutes;
		}
		if (seconds < 10){
			seconds = "0" + seconds;
		}

		if(hours > 12){
			var new_hour = hours - 12;
			var v = new_hour + ":" + minutes + ":" + seconds + " ";
		}else if(hours == "00"){
			var new_hour = 12;
			var v = new_hour + ":" + minutes + ":" + seconds + " ";
		}else{
			var v = hours + ":" + minutes + ":" + seconds + " ";
		}
		

		if(hours > 11){
			v+="PM";
		} else {
			v+="AM"
		}
		setTimeout("updateTime()",1000);
		jQuery(".time_cont span").html(v);
	}

	function time_in(){
		jQuery(".in_btn").click(function(){
			$.ajax({
				url: window.location.href,
				type: "POST",
				data: {
					'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
					'process_time_in':'1',
				},
				success: function(data){
					 var status = jQuery.parseJSON(data);
					 if(status.success == 1){
	               		window.location.href = status.url;
	                 }else if(status.success == 3){
		                alert(status.msg);
	                 	return false;
	               	}else{
	               		return false;
	               	}
				}
	 	    });
		});
	}

	function time_out(){
		jQuery(".out_btn").click(function(){
			$.ajax({
				url: window.location.href,
				type: "POST",
				data: {
					'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
					'process_time_out':'1',
				},
				success: function(data){
					 var status = jQuery.parseJSON(data);
	               	 if(status.success == 1){
	               		window.location.href = status.url;
	                 }else if(status.success == 3){
		                alert(status.msg);
	                 	return false;
	               	}else{
	               		return false;
	               	}
				}
	 	    });
		});
	}

	function change_log(){
		jQuery(".change_log_btn").click(function(){
			var employee_time_in_id = jQuery(this).attr("attr_timein_id");
			$.ajax({
				url: window.location.href,
				type: "POST",
				data: {
					'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
					'change_log':'1',
					'employee_time_in_id':employee_time_in_id
				},
				success: function(data){
					 var status = jQuery.parseJSON(data);
					 if(status.success == 1){
						 var employee_time_in_id = status.employee_time_in_id;
						 var time_in = status.time_in;
						 var lunch_out = status.lunch_out;
						 var lunch_in = status.lunch_in;
						 var time_out = status.time_out;

						 var split_employee_time_in_id = employee_time_in_id.split(":");
						 var split_time_in = time_in.split(":");
						 var split_lunch_out = lunch_out.split(":");
						 var split_lunch_in = lunch_in.split(":");
						 var split_time_out = time_out.split(":");

						 // for time in
						jQuery(".time_in_hr option").each(function(){
							var _this = jQuery(this);
							var new_time_in_hr = (split_time_in[0].length==1) ? "0"+split_time_in[0] : split_time_in[0];
							if(_this.val() == new_time_in_hr){
								_this.prop("selected",true);
							}else{
								_this.removeAttr("selected");
							}
						})
						
						jQuery(".time_in_min option").each(function(){
							var _this = jQuery(this);
							var new_time_in_min = (split_time_in[1].length==1) ? "0"+split_time_in[1] : split_time_in[1];
							if(_this.val() == new_time_in_min){
								_this.prop("selected",true);
							}else{
								_this.removeAttr("selected");
							}
						})
						
						jQuery(".time_in_ampm option").each(function(){
							var _this = jQuery(this);
							if(_this.val() == split_time_in[2]){
								_this.prop("selected",true);
							}else{
								_this.removeAttr("selected");
							}
						})
						 
						 // for lunch out
						 jQuery(".lunch_out_hr option").each(function(){
							var _this = jQuery(this);
							var new_lunch_out_hr = (split_lunch_out[0].length==1) ? "0"+split_lunch_out[0] : split_lunch_out[0];
							if(_this.val() == new_lunch_out_hr){
								_this.prop("selected",true);
								if(split_lunch_out[0]=="00" && split_lunch_out[1]=="00" && split_lunch_out[2]=="00"){
									jQuery(".lunch_out_hr").prop("disabled",true);
								}else{
									jQuery(".lunch_out_hr").removeAttr("disabled");
								}
							}else{
								_this.removeAttr("selected");
							}
						})
						
						jQuery(".lunch_out_min option").each(function(){
							var _this = jQuery(this);
							var new_lunch_out_min = (split_lunch_out[1].length==1) ? "0"+split_lunch_out[1] : split_lunch_out[1];
							if(_this.val() == new_lunch_out_min){
								_this.prop("selected",true);
								if(split_lunch_out[0]=="00" && split_lunch_out[1]=="00" && split_lunch_out[2]=="00"){
									jQuery(".lunch_out_min").prop("disabled",true);
								}else{
									jQuery(".lunch_out_min").removeAttr("disabled");
								}
							}else{
								_this.removeAttr("selected");
							}
						})
						
						jQuery(".lunch_out_ampm option").each(function(){
							var _this = jQuery(this);
							if(_this.val() == split_lunch_out[2]){
								_this.prop("selected",true);
								if(split_lunch_out[0]=="00" && split_lunch_out[1]=="00" && split_lunch_out[2]=="00"){
									jQuery(".lunch_out_ampm").prop("disabled",true);
								}else{
									jQuery(".lunch_out_ampm").removeAttr("disabled");
								}
							}else{
								_this.removeAttr("selected");
							}
						})
						 
						 // for lunch in
						 
						 jQuery(".lunch_in_hr option").each(function(){
							var _this = jQuery(this);
							var new_lunch_in_hr = (split_lunch_in[0].length==1) ? "0"+split_lunch_in[0] : split_lunch_in[0];
							if(_this.val() == new_lunch_in_hr){
								_this.prop("selected",true);
								if(split_lunch_in[0]=="00" && split_lunch_in[1]=="00" && split_lunch_in[2]=="00"){
									jQuery(".lunch_in_hr").prop("disabled",true);
								}else{
									jQuery(".lunch_in_hr").removeAttr("disabled");
								}
							}else{
								_this.removeAttr("selected");
							}
						})
						
						jQuery(".lunch_in_min option").each(function(){
							var _this = jQuery(this);
							var new_lunch_in_min = (split_lunch_in[1].length==1) ? "0"+split_lunch_in[1] : split_lunch_in[1];
							if(_this.val() == new_lunch_in_min){
								_this.prop("selected",true);
								if(split_lunch_in[0]=="00" && split_lunch_in[1]=="00" && split_lunch_in[2]=="00"){
									jQuery(".lunch_in_min").prop("disabled",true);
								}else{
									jQuery(".lunch_in_min").removeAttr("disabled");
								}
							}else{
								_this.removeAttr("selected");
							}
						})
						
						jQuery(".lunch_in_ampm option").each(function(){
							var _this = jQuery(this);
							if(_this.val() == split_lunch_in[2]){
								_this.prop("selected",true);
								if(split_lunch_in[0]=="00" && split_lunch_in[1]=="00" && split_lunch_in[2]=="00"){
									jQuery(".lunch_in_ampm").prop("disabled",true);
								}else{
									jQuery(".lunch_in_ampm").removeAttr("disabled");
								}
							}else{
								_this.removeAttr("selected");
							}
						})
						 
						 // for time out
						 jQuery(".time_out_hr option").each(function(){
							var _this = jQuery(this);
							var new_time_out_hr = (split_time_out[0].length==1) ? "0"+split_time_out[0] : split_time_out[0];
							if(_this.val() == new_time_out_hr){
								_this.prop("selected",true);
								if(split_time_out[0]=="00" && split_time_out[1]=="00" && split_time_out[2]=="00"){
									jQuery(".time_out_hr").prop("disabled",true);
								}else{
									jQuery(".time_out_hr").removeAttr("disabled");
								}
							}else{
								_this.removeAttr("selected");
							}
						})
						 
						 jQuery(".time_out_min option").each(function(){
							var _this = jQuery(this);
							var new_time_out_min = (split_time_out[1].length==1) ? "0"+split_time_out[1] : split_time_out[1];
							if(_this.val() == new_time_out_min){
								_this.prop("selected",true);
								if(split_time_out[0]=="00" && split_time_out[1]=="00" && split_time_out[2]=="00"){
									jQuery(".time_out_min").prop("disabled",true);
								}else{
									jQuery(".time_out_min").removeAttr("disabled");
								}
							}else{
								_this.removeAttr("selected");
							}
						})
						
						jQuery(".time_out_ampm option").each(function(){
							var _this = jQuery(this);
							if(_this.val() == split_time_out[2]){
								_this.prop("selected",true);
								if(split_time_out[0]=="00" && split_time_out[1]=="00" && split_time_out[2]=="00"){
									jQuery(".time_out_ampm").prop("disabled",true);
								}else{
									jQuery(".time_out_ampm").removeAttr("disabled");
								}
							}else{
								_this.removeAttr("selected");
							}
						});

						jQuery(".reason").val(status.reason);
						
						 jQuery(".employee_timein").val(status.employee_time_in_id);
						 jQuery(".changeLogs").dialog({
							width: 'inherit',
							draggable: false,
							modal: true,
							minWidth:'400',
							dialogClass:'transparent',
							overlay: {
						   		opacity: 0
							}
						});
	                 }
				}
	 	    });
		});	
	}

	function validate_form(){
		var reason = jQuery(".reason").val();
		var error = 0;
		if(reason == ""){
			jQuery(".reason").addClass("emp_str");
			error = 1;
		}

		if(error == 1){
			return false;
	    }else{
		    jQuery(".changeLogs").dialog("close");
			jQuery(".lunch_out_hr, .lunch_out_min, .lunch_out_ampm").removeAttr("disabled");
			jQuery(".lunch_in_hr, .lunch_in_min, .lunch_in_ampm").removeAttr("disabled");
			jQuery(".time_out_hr, .time_out_min, .time_out_ampm").removeAttr("disabled");
	    }
	}

	function _successContBox(){
		var successContBox = jQuery.trim(jQuery(".successContBox").text());
		if(successContBox != ""){
		    jQuery(".successContBox").css("display","inline-block");
		    setTimeout(function(){
		        jQuery(".successContBox").fadeOut('100');
		    },3000);
		}
	}
	
	jQuery(function(){
		updateTime();
		time_in();
		time_out();
		change_log();
		_successContBox();
	});
</script>