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
			            	<input type="text" placeholder="Employee Number" id="payroll_user"  value="<?php echo set_value('payroll_user');?>"  autocomplete="off" name="payroll_user" class="txtfield hasDatepicker">
			            </div>
			            
			            </td>
			            <td><div class="ipadright"><input type="text"  placeholder="Employee Name" value="<?php echo set_value('employee_name');?>" autocomplete="off" id="employee_name" name="employee_name"  class="txtfield hasDatepicker"></div></td>
			            <td>
				            <div class="ipadright">
					            <select name="year" class="inp_user">
					            <option value="">Please select year</option>
					            	<?php 
					            		for($year = 2010;$year <= 2050; $year++):
					            		$iyear = set_value("year") == $year ? "selected=\"selected\"" : '';
					            	?>
					            		<option value="<?php echo $year;?>" <?php echo $iyear;?>><?php echo $year;?></option>
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
	<div class="ihide" id="jshow_status">
		<div class="highlight_message">Successfully added</div>
	</div>
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
						<td><?php echo $val->period;?></td>
						<td><?php echo $val->leave_name;?></td>
						<td><?php echo $val->total_leave_requested;?></td>
						<td><?php echo $val->total_credits;?></td>
						<td><?php echo random_string('numeric',1);?></td>
						<td><input type="text"  class="txtfield"  name="adjustments" value="<?php echo $val->note;?>" ela_id="<?php echo $val->ela_id;?>" /></td>
						<td>10060</td>
						<td><input type="text" class="txtfield" name="adjustments_reasons" value="<?php echo $val->reasons;?>"  ela_id="<?php echo $val->ela_id;?>" /> </td>  
		            </tr>	            
            <?php 		
            		endforeach;
            	}else{
            ?>
		            <tr><td colspan="8"><?php echo msg_empty();?></td></tr>
            <?php 		
            	}
            ?>     
            </tbody>
         </table>
          <span class="ihides unameContBoxTrick"></span>
          <!-- TBL-WRAP END -->
        </div>
        <div class="export_dropdown">
        	<select name="iexport" class="emp_fields" id="iexport">
        		<option value="">SELECT</option>
        		<option value="xls">XLS</option>
        		<option value="csv">CSV</option>
        	</select>
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
						var res = jQuery.parseJSON(json);	
						if(res.success == '0'){
							alert(res.error);
						}else{
							jQuery(".success_messages").empty().html("<p>You have Successfully added</p>");
						//	kpay.overall.show_success(".success_messages");
						}
					});
				});

				jQuery(document).on("blur","input[name='adjustments'],input[name='adjustments_reasons']",function(e){
					jQuery("#jshow_status").fadeIn('slow',function(){
						jQuery(this).fadeOut('slow');
					});
				});	
			}
			// AUTO SAVE REASONS ZONE
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
						var res = jQuery.parseJSON(json);	
						if(res.success == '0'){
							alert(res.error);
						}else{
							jQuery(".success_messages").empty().html("<p>You have Successfully added</p>");
							//kpay.overall.show_success(".success_messages");
						}
					});
				});
			}
			// SELECT TO EXPORT
			function export_this(){
				var comp = "<?php echo $this->uri->segment(1);?>";
				jQuery(document).on("change","#iexport",function(e){
					var el = jQuery(this);
					var option = el.val();
					var payroll_user 	= jQuery("input[id^='payroll_user']").val() ? jQuery("input[id^='payroll_user']").val() : 'no';
					var employee_name 	= jQuery("input[id^='employee_name']").val() ? jQuery("input[id^='employee_name']").val() : 'no';
					var year = jQuery("select[name='year'] option:selected").val() ? jQuery("select[name='year'] option:selected").val() : 'no';
					if(option == ""){

					}else{
						window.location.href = '/'+comp+'/hr/inquiry/export/'+option+'/'+payroll_user+'/'+employee_name+'/'+year;
						//console.log('/'+comp+'/hr/inquiry/export/'+option+'/'+payroll_user+'/'+employee_name+'/'+year);
					}
				});
			}
			
			
			jQuery(function(){
				auto_complete_name();
				auto_complete_id();
				autosave_adjustments();
				autosave_adjustments_reasons();
				export_this();
			});
		</script>

