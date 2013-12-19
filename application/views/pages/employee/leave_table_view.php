<div class="new_header_cont">
	<h1>Leave History</h1>
</div>
<div class="tbl-wrap">
	<?php print $this->session->flashdata('message');?>
	<table style="width:1618px;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:95px;">Leave Type</th>
              <th style="width:90px;">Date Filed</th>
              <th style="width:140px;">Start Date</th>
              <th style="width:140px">End Date</th>
              <th style="width:140px;">Return Date</th>
              <th style="width:90px;">With Pay</th>
              <th style="width:90px;">Total Hours</th>
              <th style="width:263px">Approved By Immediate Head</th>
              <th style="width:200px">Reason</th>
              <th style="width:90px">Remarks</th>
              <th style="width:90px">Atttachment</th>
              <th style="width:90px">Status</th>
            </tr>
		<?php 
			if($leave != null){
				foreach($leave as $row){
		?>
			<tr>
				<td><?php print $row->leave_type_name;?></td>
				<td><?php print $row->date_filed;?></td>
				<td><?php print $row->date_start;?></td>
				<td><?php print $row->date_end;?></td>
				<td><?php print $row->date_return;?></td>
				<td><?php print ucwords($row->payable);?></td>
				<td><?php print $row->total_leave_requested;?></td>
				<td><?php print $row->approved_by_head;?></td>
				<td><?php print $row->reasons;?></td>
				<td><?php print $row->note;?></td>
				<td><?php print $row->attachments;?></td>
				<td><?php print ucwords($row->leave_application_status);?></td>
			</tr>
		<?php 		
				}
			}else{
            		print "<tr class='msg_empt_cont'><td colspan='12' style='text-align:left;'>".msg_empty()."</td></tr>";
            	}
		?>
	</tbody></table>
</div>
		<div class="pagiCont_btnCont">
			<div class="left"><?php print $links;?></div>
        	<a href="javascript:void(0);" class="btn right avail_leave_btn">Avail Leave</a>
        	<div class="clearB"></div>
        </div>
        
		<div class='avail_leave_cont ihide' title='Avail Leave'>
		<?php print form_open('','onsubmit="return validate_form()" enctype="multipart/form-data"');?>
			  <div>
          <!-- TBL-WRAP START -->
          <table width="100%">
            <tbody>
            <tr>
              <td style="width:80px">Leave Type</td>
              <td><select style='min-width: 205px;' class='txtselect select-medium' name='leave_type'><?php if($leave_type == NULL){print "<option value=''>".msg_empty()."</option>";}else{foreach($leave_type as $row_ltype){?> <option value='<?php print $row_ltype->leave_type_id;?><?php echo set_select('leave_type', $row_ltype->leave_type_name); ?>'><?php print $row_ltype->leave_type_name;?></option><?php } }?></select>
              </tr>
            <tr>
              <td style="vertical-align: top;">Reason</td>
              <td>
              	<textarea name="reason" class="reason txtfield" style="height: 50px;width: 330px;"></textarea>
              </td>
            </tr>
              <tr><td>Start Date</td>
              <td>
              	<input type='text' name='start_date' class='start_date txtfield datepickerCont' readonly="readonly" />
              	<select name="start_date_hr" class="txtselect start_date_hr" style="width:60px;">
              		<?php 
              			for($hrs=00;$hrs<=12;$hrs++){
              				$hrs = (strlen($hrs)==1) ? "0".$hrs : $hrs;
              				print "<option value='{$hrs}' name='start_date_hr'>".$hrs."</option>";
              			}
              		?>
                </select>
                :
                <select name="start_date_min" class="txtselect start_date_min" style="width:60px;">
                  	<?php 
              			for($hrs=00;$hrs<=59;$hrs++){
              				$hrs = (strlen($hrs)==1) ? "0".$hrs : $hrs;
              				print "<option value='{$hrs}' name='start_date_min'>".$hrs."</option>";
              			}
              		?>
                </select>
                <select name="start_date_sec" class="txtselect start_date_sec" style="width:60px;">
              		<?php 
                  		print "<option value='00' name='start_date_sec'></option>";
              			print "<option value='AM' name='start_date_sec'>AM</option>";
              			print "<option value='PM' name='start_date_sec'>PM</option>";
              		?>
                </select>
              </td></tr>
		    <tr>
              <td>End Date</td>
              	<td>
	              	<input type='text' name='end_date' class='end_date txtfield datepickerCont' readonly="readonly" />
						<select name="end_date_hr" class="end_date_hr txtselect" style="width:60px;">
		                    <?php 
		              			for($hrs=00;$hrs<=12;$hrs++){
		              				$hrs = (strlen($hrs)==1) ? "0".$hrs : $hrs;
	              					print "<option value='{$hrs}' name='end_date_hr'>".$hrs."</option>";
		              			}
		              		?>
		                </select>
		                :
		                <select name="end_date_min" class="end_date_min txtselect" style="width:60px;">
		                   <?php 
		              			for($hrs=00;$hrs<=59;$hrs++){
		              				$hrs = (strlen($hrs)==1) ? "0".$hrs : $hrs;
	              					print "<option value='{$hrs}' name='end_date_min'>".$hrs."</option>";
		              			}
		              		?>
		                </select>
		                <select name="end_date_sec" class="end_date_sec txtselect" style="width:60px;">
		              		<?php 
		                  		print "<option value='00' name='end_date_sec'></option>";
		              			print "<option value='AM' name='end_date_sec'>AM</option>";
		              			print "<option value='PM' name='end_date_sec'>PM</option>";
		              		?>
		                </select>
                </td>              	
              </tr>
           	<tr>
              <td>Return Date</td>
	              <td>
	              	<input type='text' name='return_date' class='return_date txtfield datepickerCont' readonly="readonly" />
	              		<select name="return_date_hr" class="return_date_hr txtselect" style="width:60px;">
		                  	<?php 
		              			for($hrs=00;$hrs<=12;$hrs++){
	              					$hrs = (strlen($hrs)==1) ? "0".$hrs : $hrs;
	              					print "<option value='{$hrs}' name='return_date_hr'>".$hrs."</option>";	
		              			}
		              		?>
		                </select>
		                :
		                <select name="return_date_min" class="return_date_min txtselect" style="width:60px;">
		                  	<?php 
		              			for($hrs=00;$hrs<=59;$hrs++){
		              				$hrs = (strlen($hrs)==1) ? "0".$hrs : $hrs;
	              					print "<option value='{$hrs}' name='return_date_hr'>".$hrs."</option>";
		              			}
		              		?>
		                </select>
		                <select name="return_date_sec" class="return_date_sec txtselect" style="width:60px;">
		              		<?php 
		                  		print "<option value='00' name='return_date_sec'></option>";
		              			print "<option value='AM' name='return_date_sec'>AM</option>";
		              			print "<option value='PM' name='return_date_sec'>PM</option>";
		              		?>
		                </select>
	              </td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td>Total Leave Requested: <input type="text" name="total_leave_request" class="total_leave_request" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right;">
	              <input type="submit" value="Submit" name="save_my_leave" class="btn" />
              </td>
            </tr>
          </tbody></table>
          <!-- TBL-WRAP END -->
        </div>
        <?php print form_close();?>
        </div>
<script>
	function validate_form(){
	    jQuery(".avail_leave_cont tr input:text").each(function(){
	        var _this = jQuery(this);
	        var txtfield = _this.val();
	        if(txtfield == ""){
	            _this.addClass("emp_str");
	        }else{
	        	_this.removeClass("emp_str");
	        }
	    });
	
	    jQuery(".avail_leave_cont tr textarea").each(function(){
	        var _this = jQuery(this);
	        var txtfield = _this.val();
	        if(txtfield == ""){
	            _this.addClass("emp_str");
	        }else{
	        	_this.removeClass("emp_str");
	        }
	    });

	    if(calculateTime() == "1"){
			return false;
    	}
	    
		if(jQuery(".avail_leave_cont tr input:text").hasClass("emp_str") || jQuery(".avail_leave_cont tr select").hasClass("emp_str")){
	    	return false;
	    }
	}

	function _avail_leave(){
		jQuery(".avail_leave_btn").click(function(){
			jQuery(".avail_leave_cont").dialog({
			       width: 'inherit',
				   draggable: false,
				   modal: true,
				   minWidth:'400',
				   dialogClass:'transparent',
				   overlay: {
			   		   opacity: 0
			   	   }
			    });
		});
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

	function _datepicker(){
		jQuery(".datepickerCont").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	}

	function getWeekDay(_date){
	    var d = new Date(_date);
	    var weekday=new Array(7);
	    weekday[0]="Sunday";
	    weekday[1]="Monday";
	    weekday[2]="Tuesday";
	    weekday[3]="Wednesday";
	    weekday[4]="Thursday";
	    weekday[5]="Friday";
	    weekday[6]="Saturday"
	    return weekday[d.getDay()];
	}

	function getWeekDay_value_ajax(weekDay_value){
		var z = "";
		$.ajax({
			url: window.location.href,
			type: "POST",
			data: {
				'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
				'shift_schedule':'1',
				'weekDay_value': weekDay_value,
			},
			async: false,
			success: function(data){
				z = data;
			}
	    });
	    return z;
	}

	function result_shift_schedule(_value){
		var z = "";
		$.ajax({
			url: window.location.href,
			type: "POST",
			data: {
				'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
				'result_shift_schedule':'1',
				'date_weekDay_value': _value,
			},
			async: false,
			success: function(data){
				z = data;
			}
	    });
		return z;
	}
	
	function calculateTime() {
        // get values time
	    var start = jQuery(".start_date_hr").val()+":"+jQuery(".start_date_min").val()+" "+jQuery(".start_date_sec").val();
	    var end = jQuery(".end_date_hr").val()+":"+jQuery(".end_date_min").val()+" "+jQuery(".end_date_sec").val();
	    // get values start date
	    var date_start = jQuery(".start_date").val();
	    var split_ds = date_start.split("-");
	    var new_date_start = split_ds[1]+"/"+split_ds[2]+"/"+split_ds[0]+" ";
	    
	    // get values end date
	    var date_end= jQuery(".end_date").val();
	    var split_de = date_end.split("-");
	    var new_date_end = split_de[1]+"/"+split_de[2]+"/"+split_de[0]+" ";
	    
	    //alert(hours_new_val+"."+min_new_time);
	    var startDate=new Date(new_date_start+" "+start);
	    var endDate=new Date(new_date_end+" "+end);
	    var myDiff=new Date;
	    myDiff.setTime(endDate-startDate);
	    
	    var x=parseInt(myDiff.getTime()/1000/60/60);
	    var y=parseInt(myDiff.getMinutes());
	    var total_comLay=parseFloat((y/60)+x);

		// same date, 24hours : 1day
		if(total_comLay.toFixed(2) <= 24){
			if(total_comLay.toFixed(2) < 0){
	            alert("- The total hour(s) is not negative value");
	            return "1";
		    }else{
				jQuery(".total_leave_request").val(total_comLay.toFixed(2));
		    }	
		}else{
			// minus 1 day
		    var no_of_days = endDate.getDate() - startDate.getDate();
    		var get_days_between = no_of_days - 1;
		    
		    // hours work per day
		    var hours_work_per_day = 1.25;
		    if(get_days_between > 0){
	            var get_hours_work_between = hours_work_per_day * get_days_between;
		    }else{
		        var get_hours_work_between = 0;
		    }
		    var start_date_weekday = getWeekDay(new_date_start);
		    var end_date_weekday = getWeekDay(new_date_end);

		    var total_no_of_days = get_days_between + 2;
		    
		    var new_total_hours_worked = getWeekDay(new_date_start)+"-";
		    for(var counter = 1;counter<total_no_of_days;counter++){
	            var someDate = new Date(new_date_start);
	            someDate.setTime(someDate.getTime() +  (counter * 24 * 60 * 60 * 1000));
	            var someDate_fullyear = someDate.getFullYear();
	    	    var someDate_month = someDate.getMonth() + 1;
	    	    var someDate_day = someDate.getDate();
	    	    var some_new_date = someDate_month+"/"+someDate_day+"/"+someDate_fullyear;
	    	    var some_getWeekDay = getWeekDay(some_new_date); // passing shift schedule
	    	    new_total_hours_worked += some_getWeekDay+"-";
		    }
		    var new_total_hours_worked_array  = new_total_hours_worked.slice(0,-1);
		    var split_new_total_hours_worked_array = new_total_hours_worked_array.split("-");
		    var length_new_total_hours_worked_array = split_new_total_hours_worked_array.length - 1;
		    var zero_hours = 0;
		    for(var new_counter = 0;new_counter<=length_new_total_hours_worked_array;new_counter++){
		       var weekDay_value = split_new_total_hours_worked_array[new_counter];
		       zero_hours = parseFloat(zero_hours) + parseFloat(getWeekDay_value_ajax(weekDay_value));
		    }

			var start_date_shift_schedule = result_shift_schedule(getWeekDay(new_date_start));
			var end_date_shift_schedule = result_shift_schedule(getWeekDay(new_date_end));

			if(start_date_shift_schedule == ""){
				var new_start_date_shift_schedule = 0;
			}else{
				var split_start_date_shift_schedule = start_date_shift_schedule.split("-");
				var new_start_date_shift_schedule = split_start_date_shift_schedule[1];
			}

			if(end_date_shift_schedule == ""){
				var new_end_date_shift_schedule = 0;
			}else{
				var split_end_date_shift_schedule = end_date_shift_schedule.split("-");
				var new_end_date_shift_schedule = split_end_date_shift_schedule[0];
			}

			// Total Start Date Shift Sched ======================
			var compute_start_date = new Date(new_date_start+" "+start);
			var split_new_start_date_shift_schedule = new_start_date_shift_schedule.split(" ");
			if(jQuery(".start_date_sec").val() == "PM" && split_new_start_date_shift_schedule[1] == "AM"){
				// add 1 day to compute the total hours worked
				var comput_new_date_start = new Date(new_date_start);
				comput_new_date_start.setTime(comput_new_date_start.getTime() +  (1 * 24 * 60 * 60 * 1000));
				var comput_new_someDate_fullyear = comput_new_date_start.getFullYear();
	    	    var comput_new_someDate_month = comput_new_date_start.getMonth() + 1;
	    	    var comput_new_someDate_day = comput_new_date_start.getDate();
	    	    var comput_new_some_new_date = comput_new_someDate_month+"/"+comput_new_someDate_day+"/"+comput_new_someDate_fullyear;
				var compute_end_date = new Date(comput_new_some_new_date+" "+new_start_date_shift_schedule);
			}else{
				var compute_end_date = new Date(new_date_start+" "+new_start_date_shift_schedule);
			}
			
			// overall start date shift schedule
			var result_start_date_shift_sched = (compute_end_date.getTime() - compute_start_date.getTime()) / 1000 / 60 / 60;
			if(result_start_date_shift_sched >= 10){ // 10 total hours worked
				var total_start_date_shift_sched = 10;
				var overall_start_date_shift_sched = 10 / 8; // 8 = labor code hours worked
			}else{
				var total_start_date_shift_sched = result_start_date_shift_sched; // minus 1 more lunch break
				var overall_start_date_shift_sched = result_start_date_shift_sched; // minus 1 more lunch break
				if(overall_start_date_shift_sched < 0){
					overall_start_date_shift_sched = 0;
				}else{
					overall_start_date_shift_sched = overall_start_date_shift_sched / 8; // 8 = labor code hours worked
				}
			}
			// Total Start Date Shift Sched End ======================
			
			// Total End Date Shift Sched ======================
			var compute_end_date = new Date(new_date_end+" "+end);
			var split_new_end_date_shift_schedule = new_end_date_shift_schedule.split(" ");
			if(jQuery(".end_date_sec").val() == "AM" && split_new_end_date_shift_schedule[1] == "PM"){
				// add 1 day to compute the total hours worked
				var comput_new_date_end = new Date(new_date_end);
				comput_new_date_end.setTime(comput_new_date_end.getTime() - (1 * 24 * 60 * 60 * 1000));
				var comput_new_someDate_fullyear_end = comput_new_date_end.getFullYear();
	    	    var comput_new_someDate_month_end = comput_new_date_end.getMonth() + 1;
	    	    var comput_new_someDate_day_end = comput_new_date_end.getDate();
	    	    var comput_new_some_new_date_end = comput_new_someDate_month_end+"/"+comput_new_someDate_day_end+"/"+comput_new_someDate_fullyear_end;
				var compute_end_date_end = new Date(comput_new_some_new_date_end+" "+new_end_date_shift_schedule);
			}else{
				var compute_end_date_end = new Date(new_date_end+" "+new_end_date_shift_schedule);
			}
			
			// overall start date shift schedule
			var result_end_date_shift_sched = (compute_end_date.getTime() - compute_end_date_end.getTime()) / 1000 / 60 / 60;
			if(result_end_date_shift_sched >= 10){ // 10 total hours worked
				var total_end_date_shift_sched = 10;
				var overall_end_date_shift_sched = 10 / 8; // 8 = labor code hours worked
			}else{
				var total_end_date_shift_sched = result_end_date_shift_sched; // minus 1 more lunch break
				var overall_end_date_shift_sched = result_end_date_shift_sched; // minus 1 more lunch break
				if(overall_end_date_shift_sched < 0){
					overall_end_date_shift_sched = 0;
				}else{
					overall_end_date_shift_sched = overall_end_date_shift_sched / 8; // 8 = labor code hours worked
				}
			}
			// Total Start Date Shift Sched End ======================
		    
		    // overall rest day hours work
		    var overall_rd_hours_work = zero_hours;

		    // overall hours worked between
			var overall_get_hours_work_between = get_hours_work_between;
			console.log(new_start_date_shift_schedule+" "+new_end_date_shift_schedule);
			console.log("Total Start Date Shift Sched: "+overall_start_date_shift_sched);
			console.log("Total End Date Shift Sched: "+overall_end_date_shift_sched);
		    console.log("Hours worked between: "+overall_get_hours_work_between);
		    console.log("Rest Day: "+overall_rd_hours_work);
		    return "1";
		}
	}
	
	jQuery(function(){
		_avail_leave();
		_successContBox();
		_datepicker();
	});
</script>