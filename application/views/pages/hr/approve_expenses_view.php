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
					<th style="width:170px;">Payroll Date</th>
					<th style="width:170px;">Amount</th>
					<th style="width:170px;">Details</th>
					<th style="width:170px;">Status</th>
				</tr>
				<?php 
					if($application){
						foreach($application as $key=>$approvers):
				?>
				<tr>
					<td>
						<input type="checkbox" name="expense_id[]" class="expense_id" value="<?php echo $approvers->expense_id;?>">
						
					</td>
					<td><div class="users_text"><?php echo $approvers->payroll_cloud_id;?></div></td>
					<td>	
						<div class="users_text"><?php echo $approvers->full_name;?></div>
					</td>
					<td>
						<div class="users_text"><?php echo $approvers->payroll_date;?></div>
					</td>
					<td>	
						<div class="users_text"><?php echo number_format($approvers->amount,2);?></div>
					</td>
					<td>				
						<div class="users_textdesc"><?php echo $approvers->details;?></div>
					</td>
					<td>
						<div class="users_text"><?php echo $approvers->expense_status;?></div>
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
	<a id="expense_approve" href="javascript:void(0);" class="btn">APPROVE</a>
	<a id="expense_reject" href="javascript:void(0);" class="btn">REJECT</a>
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
			        jQuery("input[name='expense_id[]']").prop("checked","checked");
			    }else{
			      jQuery("input[name='expense_id[]']").removeAttr("checked");
			    }
			});
		}

		// APPrOVE AND REMOVE function
		function approve_this(){
			var url_approve  = "/<?php echo $this->subdomain;?>/hr/approve_expenses/approve";	
			// APPROVE
			jQuery(document).on("click","#expense_approve",function(e){
				e.preventDefault();
				var mark = jQuery(".expense_id:checked").length;
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
			var url_approve  = "/<?php echo $this->subdomain;?>/hr/approve_expenses/reject";	
			// APPROVE
			jQuery(document).on("click","#expense_reject",function(e){
				e.preventDefault();
				var mark = jQuery(".expense_id:checked").length;
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
			var refresh = "/<?php echo $this->subdomain;?>/hr/approve_expenses/lists";
			jQuery.post(url,{"expense_id[]":fields(),'ZGlldmlyZ2luamM':jQuery.cookie(token),"submit":"true"},function(result){
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
			var checked_fields = array_fields("input[name='expense_id[]']:checked");
			return checked_fields;
		}
		
		jQuery(function(){
			check_all();
			approve_this();
			reject_this();
			hightlight_success();
		});
	</script>
	