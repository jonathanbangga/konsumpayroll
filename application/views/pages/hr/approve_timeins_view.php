	<!--  filter container -->
	<div class="filter_menus">
		<div class="left">	
			<table>
		    	<tbody>
			        <tr>
			            <td><input type="text" class="txtfield date_isearch" id="jdate_from" placeholder="Date From" readonly="readonly"></td>
			            <td><input type="text" class="txtfield date_isearch" id="jdate_to"  placeholder="Date To" readonly="readonly"></td>
			            <td><input type="submit" value="GO" class="btn" id="jleave_go"></td>
			        </tr>
		    	</tbody>
			</table>
		</div>
		<div class="right" style="">
		    <table>
		        <tbody>
		            <tr>		             
		                <td><input type="text" name="search" id="jleave_search" class="ipadright txtfield" placeholder="Employee Name"></td>
		            </tr>
		        </tbody>
		    </table>
		</div>
	</div>
	<!-- end filter container -->
	<div class="clearB"></div>
	<!-- end filter container -->
	<div class="tbl-wrap">	
		<div class="successContBox ihide">
			<div class="highlight_message"><?php echo $success;?></div>
		</div>
		<?php echo form_open("",array("onsubmit"=>"return save_users();"));?>
		<!-- TBL-WRAP START -->
		<table class="tbl emp_users_list" style="width:1610px;">
			<tbody>
				<tr>
					<th style="width:50px;"><input type="checkbox" name="checkall" /></th>
					<th style="width:170px;">Employee ID</th>
					<th style="width:170px;">Employee Name</th>
					<th style="width:170px;">Date</th>
					<th style="width:170px;">Time In</th>
					<th style="width:170px;">Lunch In</th>
					<th style="width:170px;">Lunch Out</th>
					<th style="width:170px;">Time Out</th>
					<th style="width:170px;">Tardiness (min)</th>
					<th style="width:170px;">Undertime (min)</th>
					<th style="width:170px;">Hoursworked</th>
					<th style="width:170px;">Note</th>
					<th style="width:170px;">Status</th>
				</tr>
				<?php 
					if($application){
						foreach($application as $key=>$approvers):
				?>
				<tr>
					<td><input type="checkbox" name="employee_time_in_id[]" class="employee_time_in_id timesheets_id" value="<?php echo $approvers->employee_time_in_id;?>">
					</td>
					<td><div class="users_text"><?php echo $approvers->payroll_cloud_id;?></div></td>
					<td><div class="users_text"><?php echo $approvers->full_name;?></div></td>
					<td><div class="users_text"><?php echo idates($approvers->date);?></div></td>
					<td><div class="users_text"><?php echo time_only($approvers->time_in);?></div></td>
					<td><div class="users_textdesc"><?php echo time_only($approvers->lunch_in);?></div></td>
					<td><div class="users_text"><?php echo time_only($approvers->lunch_out);?></div></td>		
					<td><div class="users_text"><?php echo time_only($approvers->time_out);?></div></td>							
					<td><div class="users_text"><?php echo $approvers->tardiness_min;?></div></td>		
					<td><div class="users_text"><?php echo $approvers->undertime_min;?></div></td>		
					<td><div class="users_text"><?php echo $approvers->total_hours;?></div></td>		
					<td>
						<div class="users_text">
							<textarea class="notes_timeins notecheck" eti="<?php echo $approvers->employee_time_in_id;?>"><?php echo $approvers->notes;?></textarea>
						</div>					
					</td>		
					<td><div class="users_text"><?php echo $approvers->time_in_status;?></div></td>		
				</tr>
				<?php 		
						endforeach;
					}else{
				?>
				<tr>
					<td colspan="13">
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
	<?php if($application){?>	
		<div class="left pagi-lefts">
		<a id="timeins_approve" href="javascript:void(0);" class="btn">APPROVE</a>
		<a id="timeins_reject" href="javascript:void(0);" class="btn">REJECT</a>
		</div>
		<div class="right pagi-rights"><?php  echo $pagi;?></div>
		<br /><br />
	<?php }?>
	<?php echo form_close();?>
	<div class="footer-grp-btn">
	<!-- FOOTER-GRP-BTN START -->
	<a href="/<?php echo $this->subdomain;?>/hr/approve_overtime/lists" class="btn btn-gray left">BACK</a> 
	<a href="/<?php echo $this->subdomain;?>/hr/approve_time_sheets/lists" class="btn btn-gray right"> CONTINUE</a>
	<!-- FOOTER-GRP-BTN END -->
	</div>
	<script type="text/javascript">
		// declares token
		var token = "<?php echo itoken_cookie();?>";
		// CHECK ALL checkbox
		function check_all(){
			jQuery(document).on("change","input[name='checkall']",function(e){
			    e.preventDefault();
			    var el = jQuery(this);  
			    if(el.is(":checked")){
			        jQuery("input[name='employee_time_in_id[]']").prop("checked","checked");
			    }else{
			      jQuery("input[name='employee_time_in_id[]']").removeAttr("checked");
			    }
			});
		}

		// APPrOVE AND REMOVE function
		function approve_this(){
			var url_approve  = "/<?php echo $this->subdomain;?>/hr/approve_timeins/approve";	
			// APPROVE
			jQuery(document).on("click","#timeins_approve",function(e){
				e.preventDefault();
				var mark = jQuery(".employee_time_in_id:checked").length;
				if(mark > 0){	
					// ASK HER IF HE WANTS
					jQuery(".option_alert").html("Are you sure you want to approve this application?");
					jQuery(".option_alert").dialog({
						resizable: false,
						height: 150,
						modal: true,
						buttons: {
							"Yes": function () {
								trigger_return_response(url_approve);
							},
							"No": function () {
								jQuery(".option_alert").dialog("close");
							}
						}
					});		
				}else{
					alert("Please check atleast one ");
					return false;
				}
			});	
		}

		// APPrOVE AND REMOVE function
		function reject_this(){
			var url_approve  = "/<?php echo $this->subdomain;?>/hr/approve_timeins/reject";	
			// APPROVE
			jQuery(document).on("click","#timeins_reject",function(e){
				e.preventDefault();
				var mark = jQuery(".employee_time_in_id:checked").length;
				if(mark > 0){	
					// ASK HER IF HE WANTS
					jQuery(".option_alert").html("Are you sure you want to reject this application?");
					jQuery(".option_alert").dialog({
						resizable: false,
						height: 150,
						modal: true,
						buttons: {
							"Yes": function () {
								trigger_return_response(url_approve);
							},
							"No": function () {
								jQuery(".option_alert").dialog("close");
							}
						}
					});		
				}else{
					alert("Please check atleast one ");
					return false;
				}
			});	
		}

		function trigger_return_response(url){	
			jQuery.post(url,{"employee_time_in_id[]":fields(),'ZGlldmlyZ2luamM':jQuery.cookie(token),"submit":"true"},function(result){
				var res = jQuery.parseJSON(result);
				if(res.success == 1){
					$(".timesheets_id").each(function(e){
					    var el = jQuery(this);
					    if(el.is(":checked") == true){	
					        el.parents("tr").remove(); 
					    }
					});
					window.location.href = "/<?php echo $this->subdomain;?>/hr/approve_timeins/lists";
				}else{
					alert(res.error);
				}
			});
		}

		function fields(){
			var checked_fields = array_fields("input[name='employee_time_in_id[]']:checked");
			return checked_fields;
		}

		// SEARCH BY NAME
		function search_by_name(){
			$('#jleave_search').enter(function(e){
		        if(jQuery(this).val() !=""){
		        	var search = jQuery("#jleave_search").val();
		        	window.location.href = "/<?php echo $this->subdomain;?>/hr/approve_timeins/lists_names/"+search; 
		        }else{
		           
		        }
			  
			});
		}
		
		// SEARCH BY DATE
		function search_by_date(){
			jQuery(document).on("click","#jleave_go",function(e){
			    var d_from = jQuery("#jdate_from").val();
			    var d_to = jQuery("#jdate_to").val();
				if(d_from =="" || d_to == ""){
					alert("Required Dates");	
				}else{
			   	 	window.location.href = "/<?php echo $this->subdomain;?>/hr/approve_timeins/lists_dates/"+d_from+"/"+d_to;
				}
			});
		}
		
		// ADD NOTES 
		function add_notes(){
			var url = "/<?php echo $this->subdomain;?>/hr/approve_timeins/ajax_add_notes/";
			jQuery(document).on("keypress",".notes_timeins",function(){
				var el = jQuery(this);
				var eti = el.attr("eti");
				var note = el.val();
				if(eti != ""){
					jQuery.post(url,{"employee_time_in_id":eti,'note':note,'ZGlldmlyZ2luamM':jQuery.cookie(token),"submit":"true"},function(result){
						var res = jQuery.parseJSON(result);
						if(res.success == '1'){
						
						}else{
							alert(res.error);
						}
					});
				}
			});
		}
		
		jQuery(function(){
			check_all();
			approve_this();
			reject_this();
			hightlight_success();

			search_by_name();
			idate_ranges();
			search_by_date();
			add_notes();
		});
	</script>
	