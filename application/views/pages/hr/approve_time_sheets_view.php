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
					<th style="width:170px;">Emp ID</th>
					<th style="width:170px;">Employee Name</th>
					<th style="width:170px;">Date From</th>
					<th style="width:170px;">Date To</th>
					<th style="width:170px;">Hoursworked</th>
					<th style="width:170px;">Tardiness</th>
					<th style="width:170px;">Undertime</th>
					<th style="width:170px;">Timesheet</th>
					<th style="width:170px;">Note</th>
					<th style="width:170px;">Status</th>
				</tr>
				<?php 
					if($leave_application){
						foreach($leave_application as $key=>$approvers):
				?>
				<tr>
					<td><input type="checkbox" name="timesheets_id[]" class="timesheets_id" value="<?php echo $approvers->timesheets_id;?>">
					</td>
					<td><div class="users_text"><?php echo $approvers->payroll_cloud_id;?></div></td>
					<td>	
						<div class="users_text"><?php echo $approvers->full_name;?></div>
					</td>
					<td>
						<div class="users_text"><?php echo idates_only($approvers->date_from);?></div>
					</td>
					<td>	
						<div class="users_text"><?php echo idates_only($approvers->date_to);?></div>
					</td>
					<td>				
						<div class="users_textdesc"><?php echo $approvers->hoursworked;?></div>
					</td>
					<td>
						<div class="users_text"><?php echo $approvers->tardiness;?></div>
					</td>
					<td>
						<div class="users_text"><?php echo $approvers->undertime;?></div>
					</td>
					<td>
						<div class="users_text"><?php echo $approvers->timesheet;?></div>
					</td>
					<td>
						<div class="users_text"><?php echo $approvers->note;?></div>
					</td>
					<td>
						<div class="users_text"><?php echo $approvers->timesheets_status;?></div>
					</td>
				</tr>
				
				<?php 		
						endforeach;
					}
				?>
			</tbody> 
		</table>
		<span class="ihides unameContBoxTrick"></span>
		<!-- TBL-WRAP END -->
	</div>
	<p><?php # echo $pagi;?></p>
	<p>
	<a id="timesheet_approve" href="javascript:void(0);" class="btn">APPROVE</a>
	<a id="timesheet_reject" href="javascript:void(0);" class="btn">REJECT</a>
	</p>
	<p>&nbsp;</p>
	<?php echo form_close();?>
	<div class="footer-grp-btn">
	<!-- FOOTER-GRP-BTN START -->
	<a href="/<?php echo $this->subdomain;?>/hr/approve_expenses/lists" class="btn btn-gray left">BACK</a> 
	<a href="/<?php echo $this->subdomain;?>/hr/approve_payroll_run/lists" class="btn btn-gray right"> CONTINUE</a>
	<!-- FOOTER-GRP-BTN END -->
	</div>
	<script type="text/javascript">
		var token = "<?php echo itoken_cookie();?>";
		// CHECK ALL checkbox
		function check_all(){
			jQuery(document).on("change","input[name='checkall']",function(e){
			    e.preventDefault();
			    var el = jQuery(this);  
			    if(el.is(":checked")){
			        jQuery("input[name='timesheets_id[]']").prop("checked","checked");
			    }else{
			      jQuery("input[name='timesheets_id[]']").removeAttr("checked");
			    }
			});
		}

		// APPrOVE AND REMOVE function
		function approve_this(){
			var url_approve  = "/<?php echo $this->subdomain;?>/hr/approve_time_sheets/approve";	
			// APPROVE
			jQuery(document).on("click","#timesheet_approve",function(e){
				e.preventDefault();
				var mark = jQuery(".timesheets_id:checked").length;
				if(mark > 0){	
					// ASK HER IF HE WANTS
					jQuery(".option_alert").html("Are you sure you want to approve this?");
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
			var url_approve  = "/<?php echo $this->subdomain;?>/hr/approve_time_sheets/reject";	
			// APPROVE
			jQuery(document).on("click","#timesheet_reject",function(e){
				e.preventDefault();
				var mark = jQuery(".timesheets_id:checked").length;
				if(mark > 0){	
					// ASK HER IF HE WANTS
					jQuery(".option_alert").html("Are you sure you want to approve this?");
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
			var refresh = "/<?php echo $this->subdomain;?>/hr/approve_time_sheets/lists";
			jQuery.post(url,{"timesheets_id[]":fields(),'ZGlldmlyZ2luamM':jQuery.cookie(token),"submit":"true"},function(result){
				var res = jQuery.parseJSON(result);
				if(res.success == 1){
					$(".timesheets_id").each(function(e){
					    var el = jQuery(this);
					    if(el.is(":checked") == true){	
					        el.parents("tr").remove(); 
					    }
					});
					window.location.href = refresh;
				}else{
					alert(res.error);
				}
			});
		}

		function fields(){
			var checked_fields = array_fields("input[name='timesheets_id[]']:checked");
			return checked_fields;
		}
		
		jQuery(function(){
			check_all();
			approve_this();
			reject_this();
			hightlight_success();
		});
	</script>
	