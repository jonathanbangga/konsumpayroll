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
					<th style="width:170px;">Leave Type</th>
					<th style="width:170px;">Date From</th>
					<th style="width:170px;">Days/Hours</th>
					<th style="width:170px;">Reasons</th>
					<th style="width:170px;">Status</th>
					<th style="width:170px;">Attachment</th>
					<th style="width:170px;">Note</th>
					<th style="width:170px;">Leave Balance</th>
				</tr>
				<?php 
					if($leave_application){
						foreach($leave_application as $key=>$approvers):
				?>
				<tr>
					<td><input type="checkbox" name="leave_ids[]" class="leave_ids" value="<?php echo $approvers->leaves_id;?>">
					<?php echo $approvers->leaves_id;?>
					</td>
					<td><div class="users_text"><?php echo $approvers->payroll_cloud_id;?></div></td>
					<td>
						<input type="hidden" id="account_id" name="update_account_id" value="<?php echo base64_encode($approvers->account_id);?>">
						<input type="hidden" name="update_email[]" value="<?php echo $approvers->email;?>" class="inp_user">
						<div class="users_text"><?php echo $approvers->email;?></div>
					</td>
					<td>
						
						<div class="users_text"><?php echo $approvers->full_name;?></div>
					</td>
					<td>
						
						<div class="users_text"><?php echo $approvers->leave_type;?></div>
					</td>
					<td>
						
						<div class="users_text"><?php echo $approvers->as_of;?></div>
					</td>
					<td>
						
						<div class="users_text"><?php echo $approvers->detail;?></div>
					</td>
					<td>
						<div class="users_text">&nbsp;</div>
					</td>
					<td>
						&nbsp;
					</td>
					<td>
						&nbsp;
					</td>
					<td>
						&nbsp;
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
	<a id="leave_approve" href="javascript:void(0);" class="btn">APPROVE</a>
	<a id="leave_reject" href="javascript:void(0);" class="btn">REJECT</a>
	</p>
	<p>&nbsp;</p>
	<?php echo form_close();?>
	<div class="footer-grp-btn">
	<!-- FOOTER-GRP-BTN START -->
	<a href="" class="btn btn-gray left ihide">BACK</a> <a href="/<?php echo $this->subdomain;?>/hr/approve_overtime/lists" class="btn btn-gray right"> CONTINUE</a>
	<!-- FOOTER-GRP-BTN END -->
	</div>
	
	<script type="text/javascript">
		var token = "<?php echo itoken_cookie();?>";
		function check_all(){
			jQuery(document).on("change","input[name='checkall']",function(e){
			    e.preventDefault();
			    var el = jQuery(this);  
			    if(el.is(":checked")){
			        jQuery("input[name='leave_ids[]']").prop("checked","checked");
			    }else{
			      jQuery("input[name='leave_ids[]']").removeAttr("checked");
			    }
			});
		}

		// APPrOVE AND REMOVE function
		function approve_this(){
			var url_approve  = "/<?php echo $this->subdomain;?>/hr/approve_leave/approve";	
			// APPROVE
			jQuery(document).on("click","#leave_approve",function(e){
				e.preventDefault();
				var mark = jQuery(".leave_ids:checked").length;
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
			var url_approve  = "/<?php echo $this->subdomain;?>/hr/approve_leave/reject";	
			// APPROVE
			jQuery(document).on("click","#leave_reject",function(e){
				e.preventDefault();
				var mark = jQuery(".leave_ids:checked").length;
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
			var refresh = "/<?php echo $this->subdomain;?>/hr/approve_leave/lists";
			jQuery.post(url,{"leave_ids[]":fields(),'ZGlldmlyZ2luamM':jQuery.cookie(token),"submit":"true"},function(result){
				var res = jQuery.parseJSON(result);
				if(res.success == 1){
					$(".leave_ids").each(function(e){
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
			var checked_fields = array_fields("input[name='leave_ids[]']:checked");
			return checked_fields;
		}
		

		jQuery(function(){
			check_all();
			approve_this();
			reject_this();
			hightlight_success();
		});
	</script>
	
	
	
	