 	<!-- MAIN-CONTENT START -->
        <p>You can assign departments and employees to specific cost centers.<br>
          Specify the cost center and it's description.</p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl" style="width:100%">
            <tbody><tr>
              <th>Employee Number</th>
              <th style="width:130px">Name</th>
              <th>Level</th>
              <th style="width:150px">Email</th>
              <th style="width:90">Business Phone</th>
              <th style="width:90">Mobile Phone</th>
              <th style="width:153px">Action</th>
            </tr>
            <?php 
            if($company_principal){
            	foreach($company_principal as $cprincipal): 
            ?>
	            <tr>
	              <td><?php echo $cprincipal->payroll_cloud_id;?></td>
	              <td><?php echo $cprincipal->fullname;?></td>
	              <td>1</td>
	              <td><?php echo $cprincipal->email;?></td>
	              <td><?php echo $cprincipal->mobile_no;?></td>
	              <td><?php echo $cprincipal->contact_no;?></td>
	              <td>
	              <a href="#" class="btn btn-gray btn-action jedit_principals" principal_id="<?php echo $cprincipal->emp_id;?>">EDIT</a> 
	              <a href="#" class="btn btn-red btn-action jdelete_principals" principal_id="<?php echo $cprincipal->company_principal_id;?>">DELETE</a>  
	              </td>
	            </tr>
            <?php 	
            	endforeach;
            }
            ?>
            
          </tbody>
         </table>
          <!-- TBL-WRAP END -->
        </div>
        <a href="#" class="btn" id="add_more_principal">ADD MORE PRINCIPAL</a>
        
        <!--  pops here  -->
        <div class="ihide">
			<div class="add_principal" title="Add Company Principal">
			<p>
			<a href="#new_only" id="j_newemployee" class="jprin_choose">New Employee</a> | <a href="#new_exist" id="j_newexist" class="jprin_choose">Existing Employee</a>  
			</p>
			<div class="princi_list new_only" id="new_only">
			<?php echo form_open("",array("onsubmit"=>"return kpay.owner.principal.add_principal('/company/principal/edit/{$this->uri->segment(4)}','".itoken_cookie()."')"));?>
	        	<table>
				    <tbody>
				        <tr>
				            <td style="width:155px">Last Name:</td>
				            <td>
				                <input type="text" class="txtfield" name="lname" value="">
				            </td>
				        </tr>
				        <tr>
				            <td>First Name:</td>
				            <td>
				                <input type="text" class="txtfield" name="fname">
				            </td>
				        </tr>
				        <tr>
				            <td>Middle Name:</td>
				            <td>
				                <input type="text" class="txtfield" name="mname">
				            </td>
				        </tr>
				        
				        <tr>
				            <td>Email:</td>
				            <td>
				                <input type="text" class="txtfield" name="email">
				            </td>
				        </tr>
				        <tr>
				            <td>Contact No:</td>
				            <td>
				                <input type="text" class="txtfield" name="contact_no">
				            </td>
				        </tr>
				       <tr>
				            <td>Payroll Cloud Id:</td>
				            <td>
				            	
				                <input type="text" class="txtfield" name="payroll_cloud_id">
				            </td>
				        </tr>
				        <tr>
				            <td>&nbsp;</td>
				            <td>
				                <table>
				                    <tr>
				                        <td style="width: 73px;">
				                            <input type="submit" class="btn" name="submit" value="Save">
				                        </td>
				                        <td>
				                            <input type="button" class="btn add_principal_cancel" name="cancel" value="Cancel">
				                        </td>
				                    </tr>
				                </table>
				            </td>
				        </tr>
				    </tbody>
				</table>
			<?php echo form_close();?>
			</div>
			<div class="princi_list new_exist" id="new_exist" style="display:none;">
				<table>
					<tr>
						<td>Choose Employee</td>
					</tr>
					<tr>
						<td>
							<select name="employee">
								<option value="3">we</option>
							</select>
						</td>
					</tr>
				</table>
			</div>
			</div>
			<!--  edit section here -->
			<div class="jedit_principal" title="Edit Company Principal">
			<?php echo form_open("/company/principal/update_company_principal/{$this->uri->segment(4)}",array("onsubmit"=>"return kpay.owner.principal.updated_principal('/company/principal/update_company_principal/{$this->uri->segment(4)}','".itoken_cookie()."')"));?>
	        	<table id="jedit_wrap">
				    <tbody>
				        <tr>
				            <td style="width:155px">Last Name:</td>
				            <td>
				                <input type="text" class="txtfield" name="lname" value="">
				            </td>
				        </tr>
				        <tr>
				            <td>First Name:</td>
				            <td>
				                <input type="text" class="txtfield" name="fname">
				            </td>
				        </tr>
				        <tr>
				            <td>Middle Name:</td>
				            <td>
				                <input type="text" class="txtfield" name="mname">
				            </td>
				        </tr>
				        <tr>
				            <td>Email:</td>
				            <td>
				            	<input type="hidden" class="txtfield" name="old_email">
				                <input type="text" class="txtfield" name="email">
				            </td>
				        </tr>
				        <tr>
				            <td>Contact No:</td>
				            <td>
				                <input type="text" class="txtfield" name="contact_no">
				            </td>
				        </tr>
				       <tr>
				            <td>Payroll Cloud Id:</td>
				            <td>
				            	<!--  MINESKI HIDDEN FIELDS -->
				                <input type="text" class="txtfield" name="payroll_cloud_id">
				                <input type="hidden" class="txtfield" name="old_payroll_cloud_id">
				                <input type="hidden"  class="txtfield" name="cprincipal_id">		
				                <input type="hidden" class="txtfield" name="company_id" value="<?php echo $this->uri->segment(4);?>">
				                <input type="hidden"  class="txtfield" name="emp_id" value="">
				            </td>
				        </tr>
				        <tr>
				            <td>&nbsp;</td>
				            <td>
				                <table>
				                    <tr>
				                        <td style="width: 73px;">
				                            <input type="submit" class="btn" name="update" value="Update">
				                        </td>
				                        <td>
				                           
				                            <a id="add_principal_cancel" class="btn" href="#" style="color:#fff;">CANCEL</a>
				                        </td>
				                    </tr>
				                </table>
				            </td>
				        </tr>
				    </tbody>
				</table>
			<?php echo form_close();?>
			</div>
			<!--  end section here -->
			
        </div>
        <!-- end pops here -->
	<!-- MAIN-CONTENT END -->
<script type="text/javascript">
	// WHEN EDIT IS TRIGGER THIS FUNCTION AUTOFILL THE FIELDS OF THE EMPLOYEE
	function show_principal_fields(){
		jQuery(document).on("click",".jedit_principals",function(e){
		    e.preventDefault();
		    var comp_id = "<?php echo $this->uri->segment(4);?>";
		    jQuery.post("/company/principal/principal_id",
				    	{
		    				'<?php echo itoken_name();?>':jQuery.cookie("<?php echo itoken_cookie();?>"),
						 	"company_id":comp_id,
						 	"emp_id":jQuery(this).attr("principal_id"),
						 	"edit":"true"
				    	},function(res){
							var result = jQuery.parseJSON(res);
							if(res){
								jQuery("#jedit_wrap input[name='lname']").empty().val(result.last_name);
								jQuery("#jedit_wrap input[name='fname']").empty().val(result.first_name);
								jQuery("#jedit_wrap input[name='mname']").empty().val(result.middle_name);
								jQuery("#jedit_wrap input[name='fax']").empty().val(result.fax);
								jQuery("#jedit_wrap input[name='email']").empty().val(result.email);
								jQuery("#jedit_wrap input[name='old_email']").empty().val(result.email);
								jQuery("#jedit_wrap input[name='contact_no']").empty().val(result.contact_no);
								jQuery("#jedit_wrap input[name='payroll_cloud_id']").empty().val(result.payroll_cloud_id);
								jQuery("#jedit_wrap input[name='old_payroll_cloud_id']").empty().val(result.payroll_cloud_id);	
								jQuery("#jedit_wrap input[name='cprincipal_id']").empty().val(result.company_principal_id);	
								jQuery("#jedit_wrap input[name='emp_id']").empty().val(result.emp_id);
							}
					    });
		    kpay.overall.show_pops(".jedit_principal");
		});
	}

	function close_cancel(){
		jQuery(document).on("click",".add_principal_cancel",function(e){
			e.preventDefault();
			jQuery(".jedit_principal").dialog("close");
		});
	}

	// function checks the users existing one
	function existing_employee(){
		jQuery(document).on("click",".jprin_choose",function(e){
		    e.preventDefault();
		    jQuery(".princi_list").hide();
		    var el = jQuery(this).attr("href");
		    jQuery(el).show();
		});
	}

	//DELETE THE FUNCTION
	function delete_company_approver(){
		jQuery(document).on("click",".jdelete_principals",function(e){
		    e.preventDefault();
		    var el = jQuery(this);
		    var cpid = el.attr("principal_id");
		    var url = "/company/principal/people_company_principal";
		    jQuery.post(url,{
		            "company_principal_id":cpid,
		            "<?php echo itoken_name();?>":jQuery.cookie("<?php echo itoken_cookie();?>"),
		            "delete":"true"
		            },function(res){
		     		var res = jQuery.parseJSON(res);
		     		if(res.success == 0){
						alert(res.error);
			     	}else{
			     		jQuery(".success_messages").empty().html("<p>You have Successfully Deleted</p>");
						kpay.overall.show_success(".success_messages");
			     	}
		    });
		});
	}
	
	jQuery(function(){
		kpay.owner.principal.show_pop();
		show_principal_fields();
		close_cancel();
		existing_employee();
		delete_company_approver();
	});
</script>