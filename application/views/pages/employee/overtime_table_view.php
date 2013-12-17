<div class="new_header_cont">
	<h1>Overtime Logs</h1>
</div>
<div class="tbl-wrap">
	<?php print $this->session->flashdata('message');?>
	<table style="width:933px;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:auto;">Date of Overtime</th>
              <th style="width:auto;">Time Start</th>
              <th style="width:auto;">Time End</th>
              <th style="width:auto">Date Filed</th>
              <th style="width:auto;">Purpose of Overtime</th>
              <th style="width:auto;">No. of hours</th>
              <th style="width:auto">Approved By Immediate Head</th>
              <th style="width:auto">Status</th>
            </tr>
		<?php 
			if($overtime != null){
				foreach($overtime as $row){
		?>
			<tr>
				<td><?php print $row->overtime_from;?></td>
				<td><?php print $row->start_time;?></td>
				<td><?php print $row->end_time;?></td>
				<td><?php print $row->overtime_date_applied;?></td>
				<td><?php print $row->reason;?></td>
				<td><?php print $row->no_of_hours;?></td>
				<td>Yes</td>
				<td><?php print ucwords($row->overtime_status);?></td>
			</tr>
		<?php 		
				}
			}else{
            		print "<tr class='msg_empt_cont'><td colspan='12' style='text-align:left;'>".msg_empty()."</td></tr>";
            	}
		?>
	</table>
</div>
		<div class="pagiCont_btnCont">
			<div class="left"><?php print $links;?></div>
        	<a href="javascript:void(0);" class="btn right apply_overtime_btn">Apply Overtime</a>
        	<div class="clearB"></div>
        </div>
        <div class='apply_overtimeCont ihide' title='Apply Overtime'>
		<?php print form_open('','onsubmit="return validate_form()" enctype="multipart/form-data"');?>
			  <div>
          <!-- TBL-WRAP START -->
          <table width="100%">
            <tbody>
              <tr><td style="width: 130px;">Date of Overtime</td>
              <td>
              	<input type='text' class='txtfield' style="position:absolute;top:-9999999999px;" />
              	<input type='text' name='start_date' class='start_date txtfield datepickerCont' style="width: 178px;" />
              </td></tr>
              <tr>
              	<td>Time Start</td>
              	<td>
              		<select name="start_date_hr" class="txtselect start_date_hr" style="width:60px;">
	              		<?php 
	              			for($hrs=00;$hrs<=23;$hrs++){
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
	              			for($hrs=00;$hrs<=59;$hrs++){
	              				$hrs = (strlen($hrs)==1) ? "0".$hrs : $hrs;
	              				print "<option value='{$hrs}' name='start_date_sec'>".$hrs."</option>";
	              			}
	              		?>
	                </select>
              	</td>
              </tr>
		    <tr>
              <td>Time End</td>
              	<td>
						<select name="end_date_hr" class="end_date_hr txtselect" style="width:60px;">
		                    <?php 
		              			for($hrs=00;$hrs<=24;$hrs++){
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
		              			for($hrs=00;$hrs<=59;$hrs++){
		              				$hrs = (strlen($hrs)==1) ? "0".$hrs : $hrs;
		              				print "<option value='{$hrs}' name='end_date_sec'>".$hrs."</option>";
		              			}
		              		?>
		                </select>
                </td>              	
              </tr>
 			<tr>
              <td style="vertical-align: top;">Purpose of Overtime</td>
              <td>
              	<input type="text" name="total_hours" value="" class="total_hours ihide" />
              	<textarea name="purpose" class="purpose txtfield" style="height: 50px;width: 178px;"></textarea>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right;">
	              <input type="submit" value="Submit" name="add" class="btn" />
              </td>
            </tr>
          </tbody></table>
          <!-- TBL-WRAP END -->
        </div>
        <?php print form_close();?>
        </div>
        
<script>

	function validate_form(){
		var start_date = jQuery(".start_date").val();
		var purpose = jQuery(".purpose").val();
		
		if(start_date == ""){
			jQuery(".start_date").addClass("emp_str");
			var error = 1;
		}else{
			jQuery(".start_date").removeClass("emp_str");
		}

		if(purpose == ""){
			jQuery(".purpose").addClass("emp_str");
			var error = 1;
		}else{
			jQuery(".purpose").removeClass("emp_str");
		}
	    
		if(error == 1){
	    	return false;
	    }else{
	    	var calculate_time = calculateTime();
	    	if(calculate_time == "1"){
				alert("- The total hour(s) is not negative value");
				return false;
	    	}else{
				jQuery(".total_hours").val(calculate_time);
	    	}
	    }
	}

        function _apply_ovetime(){
    		jQuery(".apply_overtime_btn").click(function(){
    			jQuery(".apply_overtimeCont	").dialog({
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

        function _datepicker(){
    		jQuery(".datepickerCont").datepicker({
    			changeMonth: true,
    			changeYear: true,
    			dateFormat: 'yy-mm-dd'
    		});
    	}
    	
        function calculateTime() {

    	    // get values time
    	    var start = jQuery(".start_date_hr").val()+":"+jQuery(".start_date_min").val();
    	    var end = jQuery(".end_date_hr").val()+":"+jQuery(".end_date_min").val();
    	     
    	    // get values start date
    	    var date_start = jQuery(".start_date").val();
    	    var split_ds = date_start.split("-");
    	    var new_date_start = split_ds[1]+"/"+split_ds[2]+"/"+split_ds[0]+" ";
    	    
    	    // get values end date
    	    var date_end= jQuery(".start_date").val();
    	    var split_de = date_end.split("-");
    	    var new_date_end = split_de[1]+"/"+split_de[2]+"/"+split_de[0]+" ";
    	    
    	    var startDate=new Date(new_date_start+" "+start);
    	    var endDate=new Date(new_date_end+" "+end);
    	    var myDiff=new Date;
    	    myDiff.setTime(endDate-startDate);
    	    
    	    var x=parseInt(myDiff.getTime()/1000/60/60);
    	    var y=parseInt(myDiff.getMinutes());
    	    var total_comLay=parseFloat((y/60)+x);
    	    
    	    if(total_comLay <= 0){
				return "1";
	    	}else{
	    		return total_comLay.toFixed(2);
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
        	_apply_ovetime();
        	_datepicker();
        	_successContBox();
    	});
</script>