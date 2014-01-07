<?php echo $this->session->flashdata("success");?>
<?php echo form_open($this->session->userdata('sub_domain')."/payroll_setup/priority_of_deductions",array("onsubmit"=>"return ivalidate_pod();"));?>
<div class="main-content">
        <!-- MAIN-CONTENT START -->
        <p>Define priority level for each deductions. This is used to determine the order of deductions that will be<br>
          applied. During deductions, if the employees net income become less than the minimum net pay amount<br>
          defined, that deduction and all subsequent deductions of lower priority will be deferred to the next<br>
          payroll period. Deductions will be done by priority during the payroll run starting from the priority 1<br>
          that is the highest rank. Example: If priority 3 deduction will cause the employee's net income amount to get <br>
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
              <td><input style="width:95px;" class="txtfield iwarn" name="philhealth" value="<?php echo $priority_deducations ? $priority_deducations->philhealth : ''; ?>" type="text"></td>
            </tr>
            <tr>
              <td>SSS</td>
              <td><input style="width:95px;" class="txtfield iwarn" name="sss" value="<?php echo $priority_deducations ? $priority_deducations->sss : ''; ?>" type="text"></td>
            </tr>
            <tr>
              <td>Withholding Tax</td>
              <td><input style="width:95px;" class="txtfield iwarn" name="withholding_tax" value="<?php echo $priority_deducations ? $priority_deducations->withholding_tax : ''; ?>" type="text"></td>
            </tr>
            <tr>
              <td>HDMF</td>
              <td><input style="width:95px;" class="txtfield iwarn" value="<?php echo $priority_deducations ? $priority_deducations->hdmf : ''; ?>" name="hdmf" type="text"></td>
            </tr>
          </table>
        </div>
        <h5>Other Deductions</h5>
        <div class="tbl-wrap">
          <table class="tbl" id="jother_deductions">
            <tr>
              <th style="width:152px;">Income</th>
              <th style="width:115px;">Priority</th>
              <th style="width:115px;">Status</th>
            </tr>
            <?php 
            	if($other_deducations){
            		foreach($other_deducations as $other_deduc):
           ?> 		
            	<tr>
            		<td>
            			<input type="hidden" value="<?php echo $other_deduc->priority_of_deductions_other_id;?>" class="txtfield" name="update_priority_id[]">
           				<input type="text" value="<?php echo $other_deduc->name;?>" class="txtfield iwarn" name="update_priority_name[]"></td>
            		<td>
            		<input type="text" value="<?php echo $other_deduc->priority;?>" class="txtfield iwarn" name="update_priority[]"></td>
            		<td>
            		<a class="btn btn-red btn-action btn-remove jremove_other_update" id="<?php echo $other_deduc->priority_of_deductions_other_id;?>" href="javascript:void(0);" >REMOVE</a></td>
            	</tr>
            <?php 		
            		endforeach;
            	}
            ?>
            
          </table>
          <br />
          <a id="jadd_other_deductions" href="#" class="btn">Add </a>
        </div>
        <h5>Loans</h5>
        <div class="tbl-wrap">
          <table class="tbl">
            <tr>
              <th style="width:152px;">Income</th>
              <th style="width:115px;">Priority</th>
            </tr>
            <tr>
              <td>Company Loan</td>
              <td><input style="width:95px;" class="txtfield iwarn" value="<?php echo $priority_deducations ? $priority_deducations->company_loan : ''; ?>" name="company_loan" type="text"></td>
            </tr>
            <tr>
              <td>SSS Salary Loan</td>
              <td><input style="width:95px;" class="txtfield iwarn" name="sss_salary_loan" value="<?php echo $priority_deducations ? $priority_deducations->sss_salary_loan : ''; ?>" type="text"></td>
            </tr>
            <tr>
              <td>SSS Calamity Loan</td>
              <td><input style="width:95px;" class="txtfield iwarn" name="sss_calamity_loan" type="text" value="<?php echo $priority_deducations ? $priority_deducations->sss_calamity_loan : ''; ?>"></td>
            </tr>
            <tr>
              <td>SSS Emergency Loan</td>
              <td><input style="width:95px;" class="txtfield iwarn" name="sss_emergency_loan" value="<?php echo $priority_deducations ? $priority_deducations->sss_emergency_loan : ''; ?>" type="text"></td>
            </tr>
          </table>
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
      		        html +='<td><input type="text" name="priority[]" class="txtfield iwarn"></td>';
      		        html +='<td><a href="javascript:void(0);" class="btn btn-red btn-action btn-remove jremove_other">REMOVE</a></td>';
      		        html +='</tr>';
      		    jQuery("#jother_deductions").append(html);      
      		});
        }
		// REMOVE OTHER FIELD
		function remove_other_field(){
			jQuery(document).on("click",".jremove_other",function(e){
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
			if(ierror_mark(".iwarn") > 0){
				
			}else{
				return true;
			}	
			return false;
		}
      	
        jQuery(function(){
        	add_other_fields();
        	remove_other_field(); // REMOVES THE OTHER FIELD WHICH IS NOT UPDATE WHICH IS NEW ONLY
        	remove_other_field_remove_updates(); // REMOVES THE OTHER WHICH HAS HAVE A VALUE
        	ishow_status();
        });
      	
      </script>