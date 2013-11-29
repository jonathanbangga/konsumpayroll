	<div class="tbl-wrap">	
		<div class="successContBox ihide"></div>
		<?php echo validation_errors();?>
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
					if($leave_application){
						foreach($leave_application as $key=>$approvers):
				?>
				<tr>
					<td><input type="checkbox" name="leave_ids"></td>
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
	<a href="/company/hr_setup/locations" class="btn btn-gray left">BACK</a> <a href="/company/hr_setup/leaves" class="btn btn-gray right"> CONTINUE</a>
	<!-- FOOTER-GRP-BTN END -->
	</div>
	
	<script type="text/javascript">
		function check_all(){
			jQuery(document).on("change","input[name='checkall']",function(e){
			    e.preventDefault();
			    var el = jQuery(this);  
			    if(el.is(":checked")){
			        jQuery("input[name='leave_ids']").prop("checked","checked");
			    }else{
			      jQuery("input[name='leave_ids']").removeAttr("checked");
			    }
			});
		}

		jQuery(function(){
			check_all();
		});
	</script>
	
	
	
	