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
					<th style="width:170px;">Period From</th>
					<th style="width:170px;">Period To</th>
					<th style="width:170px;">Run By</th>
					<th style="width:170px;">Payroll Group</th>
					<th style="width:170px;">Details</th>
					<th style="width:170px;">Note</th>
					<th style="width:170px;">Status</th>
				</tr>
			<?php 
				if($application){
					foreach($application as $key=>$approvers):
			?>
				<tr>
					<td>
						<input type="checkbox" name="payroll_run_id[]" class="mark_timeshit" value="<?php echo $approvers->payroll_run_id;?>">
					</td>
					<td><div class="users_text"><?php echo $approvers->payroll_cloud_id;?></div></td>
					<td>	
						<div class="users_text"><?php echo $approvers->first_name." ".$approvers->last_name;?></div>
					</td>
					<td>
						<div class="users_text"><?php echo idates_only($approvers->period_from);?></div>
					</td>
					<td>	
						<div class="users_text"><?php echo idates_only($approvers->period_to);?></div>
					</td>
					<td>				
						<div class="users_textdesc"><?php echo $approvers->run_by;?></div>
					</td>
					<td>
						<div class="users_text"><?php echo $approvers->payroll_group_id;?></div>
					</td>
					<td>
						<div class="users_text"><?php echo $approvers->details;?></div>
					</td>
					<td>
						<div class="users_text"><?php echo $approvers->note;?></div>
					</td>
					<td>
						<div class="users_text"><?php echo $approvers->payroll_run_status;?></div>
					</td>
				</tr>		
			<?php 		
					endforeach;
				}else{
			?>
				<tr>
					<td colspan="12">
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
	<a id="approve_payroll_run" href="javascript:void(0);" class="btn">APPROVE</a>
	<a id="reject_payroll_run" href="javascript:void(0);" class="btn">REJECT</a>
	</div>
	<div class="right pagi-rights"><?php  echo $pagi;?></div>
	<br /><br />
	<div class="clearB"></div>
	
	
	<?php }?>
	<?php echo form_close();?>
	<div class="footer-grp-btn">
	<!-- FOOTER-GRP-BTN START -->
	<a href="/<?php echo $this->subdomain;?>/hr/approve_time_sheets/lists" class="btn btn-gray left">BACK</a>
	<!-- FOOTER-GRP-BTN END -->
	</div>
	<script type="text/javascript">
		// CHECK ALL checkbox
		var token = "<?php echo itoken_cookie();?>";
		function check_all(){
			jQuery(document).on("change","input[name='checkall']",function(e){
			    e.preventDefault();
			    var el = jQuery(this);  
			    if(el.is(":checked")){
			        jQuery("input[name='payroll_run_id[]']").prop("checked","checked");
			    }else{
			    	jQuery("input[name='payroll_run_id[]']").removeAttr("checked");
			    }
			});
		}
		// function success 
		function return_success(){
			var icheck = jQuery.trim(jQuery(".highlight_message").text());
			if(icheck){
				jQuery(".successContBox").fadeIn("slow");
			
			}
		}

		// APPrOVE AND REMOVE function
		function approve_this(){
			var url_approve  = "/<?php echo $this->subdomain;?>/hr/approve_payroll_run/approve";	
			// APPROVE
			jQuery(document).on("click","#approve_payroll_run",function(e){
				e.preventDefault();
				var mark = jQuery(".mark_timeshit:checked").length;
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

		// REJECT AND REMOVE
		function reject_this(){
			var url_reject  = "/<?php echo $this->subdomain;?>/hr/approve_payroll_run/reject";	
			// APPROVE
			jQuery(document).on("click","#reject_payroll_run",function(e){
				e.preventDefault();
				var mark = jQuery(".mark_timeshit:checked").length;
				if(mark > 0){	
					// ASK HER IF HE WANTS
					jQuery(".option_alert").html("Are you sure you want to reject this?");
					jQuery(".option_alert").dialog({
						resizable: false,
						height: 150,
						modal: true,
						buttons: {
							"Yes": function () {
								trigger_return_response(url_reject);
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
			var refresh = "/<?php echo $this->subdomain;?>/hr/approve_payroll_run/lists";
			jQuery.post(url,{"payroll_run_id[]":fields(),'ZGlldmlyZ2luamM':jQuery.cookie(token),"submit":"true"},function(result){
				var res = jQuery.parseJSON(result);
				if(res.success == 1){
					$(".mark_timeshit").each(function(e){
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
			var checked_fields = array_fields("input[name='payroll_run_id[]']:checked");
			return checked_fields;
		}

		jQuery(function(){
			check_all();
			approve_this();
			reject_this();
			return_success();	
		});
	</script>
	