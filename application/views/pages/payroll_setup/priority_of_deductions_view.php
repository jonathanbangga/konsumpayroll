<?php echo $this->session->flashdata("success");?>
<?php echo form_open($this->session->userdata('sub_domain')."/payroll_setup/priority_of_deductions",array("onsubmit"=>"return ivalidate_pod();"));?>
<div class="main-content">
        <!-- MAIN-CONTENT START -->
        <p>Define priority level for each deductions. This is used to determine the order of deductions that will be<br>
          applied. During deductions, if the employees net income become less than the minimum net pay amount<br>
          defined, that deduction and all subsequent deductions of lower priority will be deferred to the next<br>
          payroll period. Deductions will be done by priority during the payroll run starting from the priority 1<br>
          that is the highest rank.</p>
          <p> Example: If priority 3 deduction will cause the employee's net income amount to get <br>
          ower than the minimum net pay, that deduction and all other deductions priority 4and up will be moved<br>
          to the next payroll period for processing.</p>
        <h5>Mandatory Contribution</h5>
        <div class="show_success ihide" id="show_success">
			<div class="highlight_message" id="jmessages"><?php echo $this->session->flashdata("success");?></div>
			<div class="ihide">
			<?php echo validation_errors("<span class='error_zone'>","</span>");?>
			</div>
		</div>     
        <div class="tbl-wrap">
          <table class="tbl">
            <tr>
              <th style="width:152px;">Income</th>
              <th style="width:115px;">Priority</th>
            </tr>
            <tr>
              <td>PhilHealth</td>
              <td>
				<!-- <input style="width:95px;" class="txtfield iwarn iprior" name="philhealth" value="<?php echo $priority_deducations ? $priority_deducations->philhealth : ''; ?>" type="text">-->
				<select name="philhealth" class="txtselect select-medium">
					<?php priority_options($options,$priority_deducations,$priority_deducations->philhealth);?>
				</select>
			  </td>
            </tr>
            <tr>
              <td>SSS</td>
              <td><!-- <input style="width:95px;" class="txtfield iwarn iprior" name="sss" value="<?php echo $priority_deducations ? $priority_deducations->sss : ''; ?>" type="text">-->
			  	<select name="sss" class="txtselect select-medium">
					<?php priority_options($options,$priority_deducations,$priority_deducations->sss);?>
				</select>
			  
			  </td>
            </tr>
            <tr>
              <td>Withholding Tax</td>
              <td>
				<!-- <input style="width:95px;" class="txtfield iwarn iprior" name="withholding_tax" value="<?php echo $priority_deducations ? $priority_deducations->withholding_tax : ''; ?>" type="text">-->
				<select name="withholding_tax" class="txtselect select-medium">
					<?php priority_options($options,$priority_deducations,$priority_deducations->withholding_tax);?>
				</select>
				</td>
            </tr>
            <tr>
              <td>HDMF</td>
              <td>
				<!-- <input style="width:95px;" class="txtfield iwarn iprior" value="<?php echo $priority_deducations ? $priority_deducations->hdmf : ''; ?>" name="hdmf" type="text">-->
				<select name="hdmf" class="txtselect select-medium">
					<?php priority_options($options,$priority_deducations,$priority_deducations->hdmf);?>
				</select>
				</td>
            </tr>
          </table>
        </div>
		
		  <h5>Loans</h5>
        <div class="tbl-wrap">
          <table class="tbl" id="jmoreloan">
            <tr>
              <th style="width:152px;">Income</th>
              <th style="width:115px;">Priority</th>
            </tr>
			<?php	
				if($priority_loan_type == false && $get_loan_type) {
					foreach($get_loan_type as $glt):
			?>
            <tr>
              <td><?php echo $glt->loan_type_name;?></td>
              <td>
			 <!--  <input  class="txtfield iwarn iprior" value="<?php echo $priority_deducations ? $priority_deducations->company_loan : ''; ?>" name="company_loan" type="text"> -->
				<input type="hidden" name="loan_type_id[]" value="<?php echo $glt->loan_type_id;?>"/>
			  	<select name="add_loan_priority[]" class="txtselect select-medium">
					<option value="first payroll of the month">first payroll of the month</option>
					<option selected="" value="last payroll of the month">last payroll of the month</option>
					<option value="equal in every payroll">equal in every payroll</option>
				</select>
			  </td>  
            </tr>
			<?php
					endforeach;
				} else { 
					if($priority_loan_type) {	
						foreach($priority_loan_type as $plt) :
			?>
					<tr>
						<td><?php echo $plt->loan_type_name;?></td>
						<td>					
						<input type="hidden" name="update_loan_type_id[]" value="<?php echo $plt->priority_of_deductions_other_loans_id;?>"/>
							<select name="update_loan_priority[]" class="txtselect select-medium">
							<?php priority_options($options,$priority_loan_type,$plt->priority);?>
							</select>
						</td>  
					</tr>
			
			<?php
						endforeach;
					}
				}
			?>
			</table>
       
        </div>
		
        <h5>Other Deductions</h5>
        <div class="tbl-wrap">
          <table class="tbl" id="jother_deductions">
            <tr>
              <th style="width:152px;">Income</th>
              <th style="width:115px;">Priority</th>
            </tr>
            <?php 
            	if($priority_other == false && $other_deducations){
            		foreach($other_deducations as $other_deduc):
           ?> 		
					<tr>
						<td>
						<?php echo $other_deduc->name;?>
						</td>
						<td>
						<input type="hidden" name="other_deductions_id[]" value="<?php echo $other_deduc->deductions_other_deductions_id?>" />
						<select name="priority_other_deductions[]" class="txtselect select-medium">
							<?php priority_options($options,$priority_deducations,"");?>
						</select>
						</td>
					</tr>
            <?php 		
            		endforeach;
            	}else{
					if($priority_other) {
						foreach($priority_other as $po_key=>$po_val):
            ?>
					<tr>
						<td>
						<?php echo $po_val->name;?>
						</td>
						<td>
							<input type="hidden" name="update_other_deductions_id[]" value="<?php echo $po_val->priority_of_deductions_other_id?>" />
							<select name="update_priority_other_deductions[]" class="txtselect select-medium">
								<?php priority_options($options,$priority_other,$po_val->priority);?>
							</select>
						</td>
					</tr>

			<?php
						endforeach;
					}
				}
			?>
          </table>
          <br />
          <!-- <a id="jadd_other_deductions" href="#" class="btn">Add More</a> -->
        </div>
      
        <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray left" href="#">BACK</a> <a class="btn btn-gray right" href="#"> CONTINUE</a>
        <input style="margin-right:10px;" class="btn right" name="submit" type="submit" value="SAVE">
        <!-- FOOTER-GRP-BTN END -->
      </div>
      <?php echo form_close();?>
      <script type="text/javascript">
      	var itoken = "<?php echo itoken_cookie();?>";
      	//OTHER DEDUCTION MORE FIELDS
      	function add_other_fields(){
      		jQuery(document).on("click","#jadd_other_deductions",function(e){
      		    e.preventDefault();
      		    var el = jQuery(this);
      		    var html = '<tr>';
      		        html +='<td><input type="text" name="name[]" class="txtfield iwarn"></td>';
      		        html +='<td><input type="text" name="priority[]" class="txtfield iwarn iprior"></td>';
      		        html +='<td><a href="javascript:void(0);" class="btn btn-red btn-action btn-remove jremove_other">REMOVE</a></td>';
      		        html +='</tr>';
      		    jQuery("#jother_deductions").append(html);      
      		});
        }
		// ADD OTHE RLOANS
		function add_other_loans(){
			jQuery(document).on("click","#jadd_other_loan",function(e){
      		    e.preventDefault();
      		    var el = jQuery(this);
      		    var html = '<tr>';
      		        html +='<td><input type="text" name="add_loan_name[]" class="txtfield iwarn"></td>';
      		        html +='<td><input type="text" name="add_loan_priority[]" class="txtfield iwarn iprior"></td>';
      		        html +='<td><a href="javascript:void(0);" class="btn btn-red btn-action btn-remove jremove_other_loan">REMOVE</a></td>';
      		        html +='</tr>';
      		    jQuery("#jmoreloan").append(html);      
      		});	
		}
        
		// REMOVE OTHER FIELD
		function remove_other_field() {
			jQuery(document).on("click",".jremove_other",function(e){
			    e.preventDefault();
			    var el = jQuery(this);
			   	el.parents("tr").remove();
			});
		}

		// REMOVE MORE LOANS
		function remove_other_loans() {
			jQuery(document).on("click",".jremove_other_loan",function(e){
				e.preventDefault();
				var el = jQuery(this);
				el.parents("tr").remove();
			});			
		}

		// REMOVE  UPDATE OTHER FIELD
		function remove_other_field_remove_updates(){
			jQuery(document).on("click",".jremove_other_update",function(e){
				e.preventDefault();
				var el = jQuery(this);
				var id = el.attr("id");
				var urls = "/<?php echo $this->session->userdata('sub_domain');?>/payroll_setup/priority_of_deductions/ajax_remove_other_deductions";
				if(id){
					var fields = {
					    "priority_of_deductions_other_id":id,
					    "ZGlldmlyZ2luamM": jQuery.cookie(itoken),
					    "async":false
					};
					jQuery(".option_alert").empty().html("Are you sure you want to delete this?");
					jQuery(".option_alert").dialog({
						resizable: false,
						height: 150,
						width:"320",
						modal: true,
						dialogClass: 'transparent',
						buttons: {
							"Yes": function () {
								jQuery.post(urls,fields,function(json){				
									el.parents("tr").remove();		
								 	jQuery(".option_alert").dialog('close');
									location.reload();									
								});	
							},
							"No": function () {
								 jQuery(".option_alert").dialog('close');
							}
						}
					});
				}else{

				}
			});
		}

		// CHECK STATUS IF SAVED OR NOT 
		// VALIIDATE THIS
		function ivalidate_pod(){
			ierror_field(".iwarn");
			ierror_duplicate(".iprior");
			if(ierror_mark(".iwarn") > 0){
				return false;
			}else{
				return true;
			}	
			return false;
		}
		
		// REMOVE OTHER FIELD UPDATE
		function remove_loan_field_update(){
			jQuery(document).on("click",".jremove_other_loan_update",function(e){
				e.preventDefault();
				var el = jQuery(this);
				var urls = "/<?php echo $this->session->userdata('sub_domain');?>/payroll_setup/priority_of_deductions/ajax_remove_other_loans";
				var ids = el.attr("id");
				var fields = {
					    "priority_of_deductions_other_id":ids,
					    "ZGlldmlyZ2luamM": jQuery.cookie(itoken)    
					};
					jQuery(".option_alert").empty().html("Are you sure you want to delete this?");
					jQuery(".option_alert").dialog({
						resizable: false,
						height: 150,
						width:"320",
						modal: true,
						dialogClass: 'transparent',
						buttons: {
							"Yes": function () {		
								jQuery.post(urls,fields,function(json){				
									el.parents("tr").remove();		
								 	jQuery(".option_alert").dialog('close');	
									location.reload();
								});	
							},
							"No": function () {
								 jQuery(".option_alert").dialog('close');
							}
						}
					});	
			});		
		}
      	
        jQuery(function(){
        	add_other_fields();
        	add_other_loans() // ADD LOAN MORE 
        	remove_other_field(); // REMOVES THE OTHER FIELD WHICH IS NOT UPDATE WHICH IS NEW ONLY
        	remove_other_field_remove_updates(); // REMOVES THE OTHER WHICH HAS HAVE A VALUE
        	remove_other_loans(); // REMOVES OTHER LOANS
        	ishow_status();
			remove_loan_field_update();
        	inum('.iprior');
        });
      	
      </script>
