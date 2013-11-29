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
					<th style="width:170px;">Overtime Type</th>
					<th style="width:170px;">Overtime Date</th>
					<th style="width:170px;">Date From</th>
					<th style="width:170px;">Date To</th>
					<th style="width:170px;">Hours</th>
					<th style="width:170px;">NSD Hours</th>
					<th style="width:170px;">Reason</th>
					<th style="width:170px;">Note</th>
					<th style="width:170px;">Status</th>
				</tr>
				<?php 
					if($application){
						foreach($application as $key=>$approvers):
				?>
				<tr>
					<td><input type="checkbox" class="overtime_id" name="overtime_id[]" value="<?php echo $approvers->overtime_id;?>">
					
					</td>
					<td><div class="users_text"><?php echo $approvers->payroll_cloud_id;?></div></td>
					<td>
						<div class="users_text"><?php echo $approvers->full_name;?></div>
					</td>
					<td>
	
						<div class="users_text"><?php echo $approvers->overtime_type_id;?></div>
					</td>
					<td>
						
						<div class="users_text"><?php echo idates_only($approvers->overtime_date_applied);?></div>
					</td>
					<td>
						
						<div class="users_text"><?php echo idates_only($approvers->overtime_from);?></div>
					</td>
					<td>
						<div class="users_text"><?php echo idates_only($approvers->overtime_to);?></div>
					</td>
					<td>
						<div class="users_text"><?php echo $approvers->no_of_hours;?></div>
					</td>
					<td>
						<div class="users_text"><?php echo $approvers->with_nsd_hours;?></div>
					</td>
					<td>
						<div class="users_text"><?php echo $approvers->reason;?></div>
					</td>
					<td>
						<div class="users_text"><?php echo $approvers->notes;?></div>
					</td>
					<td>
						<div class="users_text">Status</div>
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
	<a id="overtime_approve" href="javascript:void(0);" class="btn">APPROVE</a>
	<a id="overtime_reject" href="javascript:void(0);" class="btn">REJECT</a>
	</div>
	<div class="right pagi-rights"><?php  echo $pagi;?></div>
	<br /><br />
	<div class="clearB"></div>
	
	
	<?php }?>
	<?php echo form_close();?>
	<div class="footer-grp-btn">
	<!-- FOOTER-GRP-BTN START -->
	<a href="/<?php echo $this->subdomain;?>/hr/approve_leave/lists" class="btn btn-gray left">BACK</a> 
	<a href="/<?php echo $this->subdomain;?>/hr/approve_expenses/lists" class="btn btn-gray right"> CONTINUE</a>
	<!-- FOOTER-GRP-BTN END -->
	</div>
	
	<script type="text/javascript">
		var token = "<?php echo itoken_cookie();?>";
		function check_all(){
			jQuery(document).on("change","input[name='checkall']",function(e){
			    e.preventDefault();
			    var el = jQuery(this);  
			    if(el.is(":checked")){
			        jQuery("input[name='overtime_id[]']").prop("checked","checked");
			    }else{
			      jQuery("input[name='overtime_id[]']").removeAttr("checked");
			    }
			});
		}

		// APPrOVE AND REMOVE function
		function approve_this(){
			var url_approve  = "/<?php echo $this->subdomain;?>/hr/approve_overtime/approve";	
			// APPROVE
			jQuery(document).on("click","#overtime_approve",function(e){
				e.preventDefault();
				var mark = jQuery(".overtime_id:checked").length;
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
			var url_approve  = "/<?php echo $this->subdomain;?>/hr/approve_overtime/reject";	
			// APPROVE
			jQuery(document).on("click","#overtime_reject",function(e){
				e.preventDefault();
				var mark = jQuery(".overtime_id:checked").length;
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
			var refresh = "/<?php echo $this->subdomain;?>/hr/approve_overtime/lists";
			jQuery.post(url,{"overtime_id[]":fields(),'ZGlldmlyZ2luamM':jQuery.cookie(token),"submit":"true"},function(result){
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
			var checked_fields = array_fields("input[name='overtime_id[]']:checked");
			return checked_fields;
		}
		
		jQuery(function(){
			check_all();
			approve_this();
			reject_this();
			hightlight_success();
		});
	</script>
	
	
	
	