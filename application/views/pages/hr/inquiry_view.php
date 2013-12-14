<?php 
	$names = array();
	$emp_id = array();
	if($employees){
		foreach($employees as $val_emp):
			$names[] = "'".$val_emp->full_name."'";
			$emp_id[] = "'".$val_emp->payroll_cloud_id."'";
		endforeach;
	}	
?>


	<div class="filter_menus">
	<?php echo form_open($this->uri->segment(1)."/hr/inquiry/search");?>
		<div class="left">
			<table>
		    	<tbody>
			        <tr >
			            <td><div class="ipadright">
			            	<input type="text" placeholder="Employee Number" id="payroll_user" name="payroll_user" class="txtfield hasDatepicker">
			            </div>
			            
			            </td>
			            <td><div class="ipadright"><input type="text"  placeholder="Employee Name" id="employee_name" name="employee_name"  class="txtfield hasDatepicker"></div></td>
			            <td>
				            <div class="ipadright">
					            <select name="year" class="inp_user">
					            <option value="">Please select year</option>
					            	<?php 
					            		for($year = 2010;$year <= 2050; $year++):
					            	?>
					            		<option value="<?php echo $year;?>" ><?php echo $year;?></option>
					            	<?php 
					            		endfor;
					            	?>
					            </select> 
				            </div>
			            </td>
			            <td><input type="submit" id="jleave_go" name="submit" class="btn" value="GO"></td>
			        </tr>
		    	</tbody>
			</table>
		</div>
	<?php echo form_close();?>
	<div class="clearB"></div>	
	</div>
	<br />
	<br />
	<div class="tbl-wrap">	
		            <!-- TBL-WRAP START -->
          <table class="tbl emp_conList" style="width:2430px;">
            <tbody>
	            <tr>
					
					<th style="width:30px;">Period</th>
					<th style="width:70px;">Leave Type</th>
					<th style="width:70px;">Total Credits</th>
					<th style="width:70px;">Accrued Leaves</th>
					<th style="width:70px;">Used Leaves</th>
					<th style="width:70px;">Adjustments</th>
					<th style="width:70px;">Ending Balance</th>
					<th style="width:70px;">Adjustment Reason</th>
	            </tr>
	            <?php 
	            	if($inquiry_result){
	            		foreach($inquiry_result as $key=>$val):
	            ?>
            	<tr>
					<td><?php echo random_string('numeric',1);?></td>
					<td><?php echo $val->leave_name;?></td>
					<td><?php echo 1;?></td>
					<td><?php echo $val->total_credits;?></td>
					<td><?php echo random_string('numeric',1);?></td>
					<td><input type="text"  class="txtfield"  name="adjustments" ela_id="<?php echo $val->ela_id;?>" /></td>
					<td>10060</td>
					<td><input type="text" class="txtfield" name="adjustments_reasons"  ela_id="<?php echo $val->ela_id;?>" /> </td>  
	            </tr>	            
	            <?php 		
	            		endforeach;
	            	}else{
	            ?>
	            <tr>
	            	<td colspan="8">
	            	<?php echo msg_empty();?>
	            	</td>
	            </tr>
	            <?php 		
	            	}
	            ?>
            
            </tbody>
            </table>
          <span class="ihides unameContBoxTrick"></span>
          <!-- TBL-WRAP END -->
        </div>
        <script type="text/javascript">
        	var tokens  = "<?php echo itoken_cookie();?>";
        	var tname = "<?php echo itoken_name();?>";
			// AUTOCOMPLETE NAME
			function auto_complete_name(){
				var availableTags = [<?php echo implode(",",$names);?>];
				$( "#employee_name" ).autocomplete({source: availableTags});
			}
			// AUTOCOMPLETE EMPLOYEE
			function auto_complete_id(){
				var availableTags = [<?php echo implode(",",$emp_id);?>];
				$( "#payroll_user" ).autocomplete({source: availableTags});
			}
			// AUTOSAVES adjustments
			function autosave_adjustments(){
				jQuery(document).on("keyup","input[name='adjustments']",function(e){
					var el = jQuery(this);
					var urls = "/<?php echo $this->uri->segment(1);?>/hr/inquiry/ajax_add_adjustments";
					var fields = {
							"ela_id":el.attr("ela_id"),
							"adjustments":el.val(),
							"ZGlldmlyZ2luamM":jQuery.cookie(tokens),
							"submit":true,
							"type":'add_adjustments'
					};

					jQuery.post(urls,fields,function(json){
						console.log(json);
						//var res = jQuery.parseJSON(json);	
						//if(res.success == '0'){
						//	alert(res.error);
						//}else{
							//jQuery(".success_messages").empty().html("<p>You have Successfully added</p>");
							//kpay.overall.show_success(".success_messages");
						//}
					});
				});
			}
			function autosave_adjustments_reasons(){
				jQuery(document).on("keyup","input[name='adjustments_reasons']",function(e){
					var el = jQuery(this);
					var urls = "/<?php echo $this->uri->segment(1);?>/hr/inquiry/ajax_add_adjustments";
					var fields = {
							"ela_id":el.attr("ela_id"),
							"adjustments_reasons":el.val(),
							"ZGlldmlyZ2luamM":jQuery.cookie(tokens),
							"submit":true,
							"type":'add_adjustment_reasons'
					};

					jQuery.post(urls,fields,function(json){
						console.log(json);
						//var res = jQuery.parseJSON(json);	
						//if(res.success == '0'){
						//	alert(res.error);
						//}else{
							//jQuery(".success_messages").empty().html("<p>You have Successfully added</p>");
							//kpay.overall.show_success(".success_messages");
						//}
					});
				});
			}
			
			jQuery(function(){
				auto_complete_name();
				auto_complete_id();
				autosave_adjustments();
				autosave_adjustments_reasons();
			});
		</script>

