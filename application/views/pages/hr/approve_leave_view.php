	<!--  filter container -->
	<div class="filter_menus">
		<div class="left">
		
			<table>
		    	<tbody>
			        <tr>
			            <td> 
			                <input type="text" class="txtfield date_isearch" id="jdate_from" placeholder="Date From" readonly="readonly">
			            </td>
			            <td>
			                <input type="text" class="txtfield date_isearch" id="jdate_to"  placeholder="Date To" readonly="readonly">
			            </td>
			            <td>
			                <input type="submit" value="GO" class="btn" id="jleave_go">
			            </td>
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
					<th style="width:170px;">Leave Type</th>
					<th style="width:170px;">Date From</th>
					<th style="width:170px;">Date To</th>
					<th style="width:170px;">Days/Hours</th>
					<th style="width:170px;">Reasons</th>
					<th style="width:170px;">Status</th>
					<th style="width:170px;">Attachment</th>
					<th style="width:170px;">Note</th>
					<th style="width:170px;">Leave Balance</th>
				</tr>
				<?php 
					if($application){
						foreach($application as $key=>$approvers):
				?>
				<tr class="jleave_list">
					<td><input type="checkbox" name="leave_ids[]" class="leave_ids" value="<?php echo $approvers->employee_leaves_application_id;?>">
					</td>
					<td><div class="users_text"><?php echo $approvers->payroll_cloud_id;?></div></td>
					
					<td>
						
						<div class="users_text"><?php echo $approvers->full_name;?></div>
					</td>
					<td>
						
						<div class="users_text"><?php echo $approvers->leave_type_id;?></div>
					</td>
					<td>
						
						<div class="users_text"><?php echo idates($approvers->date_start);?></div>
					</td>
					<td>
						
						<div class="users_text"><?php echo idates_time($approvers->date_start);?></div>
					</td>
					<td>
						<div class="users_text"><?php echo $approvers->reasons;?></div>
					</td>
					<td>
						<div class="users_text"><?php echo $approvers->reasons;?></div>
					</td>
					<td>
						<div class="users_text"><?php echo $approvers->leave_application_status;?></div>
					</td>
					<td>
						<div class="users_text"><?php echo $approvers->attachments;?></div>
					</td>
					<td>
						<div class="users_text"><?php echo $approvers->note;?></div>
					</td>
					<td>
						<div class="users_text"></div>
					</td>
					
				</tr>
				
				<?php 		
						endforeach;
					}else{
				?>
					<tr>
						<td colspan="11">
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
	<a id="leave_approve" href="javascript:void(0);" class="btn">APPROVE</a>
	<a id="leave_reject" href="javascript:void(0);" class="btn">REJECT</a>
	</div>
	<div class="right pagi-rights"><?php  echo $pagi;?></div>
	<br /><br />
	<div class="clearB"></div>
	<?php }?>
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


		
		// DATEPICKERS
		function search_by_date(){
			jQuery(document).on("click","#jleave_go",function(e){
			    var d_from = jQuery("#jdate_from").val();
			    var d_to = jQuery("#jdate_to").val();
				if(d_from =="" || d_to == ""){
				alert("Required Dates");	
				}else{
			    window.location.href = "/<?php echo $this->subdomain;?>/hr/approve_leave/lists_dates/"+d_from+"/"+d_to;
				}
			});
		}
		// search name
		function search_by_name(){
			$('#jleave_search').keyup(function(e){
			    if(e.keyCode == 13)
			    {
			        if(jQuery(this).val() !=""){
			        var search = jQuery("#jleave_search").val();
			        window.location.href = "/<?php echo $this->subdomain;?>/hr/approve_leave/lists_names/"+search; 
			        }else{
			           
			        }
			    }else{
			      
			    }
			});
		}
		
		jQuery(function(){
			check_all();
			approve_this();
			reject_this();
			hightlight_success();
			idate_ranges();
			search_by_date();
			search_by_name();
		});
	</script>
	
	
	
	