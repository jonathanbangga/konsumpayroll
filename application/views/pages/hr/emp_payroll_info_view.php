<?php print form_open('','onsubmit="return validate_form()" enctype="multipart/form-data"');?>
<div class="tbl-wrap">	
		  <?php print $this->session->flashdata('message');?>
          <!-- TBL-WRAP START -->
          <table style="width:4470px;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:50px;"></th>
              <th style="width:170px;">Employee Name</th>
              <th style="width:170px;">Employee Number</th>
              <th style="width:170px;">Department </th>
              <th style="width:170px;">Sub Department</th>
              <th style="width:170px;">Employment Type</th>
              <th style="width:170px">Position</th>
              <th style="width:170px">Date Hired</th>
              <th style="width:170px">Last Date</th>
              <th style="width:170px">Tax Status</th>
              <th style="width:170px">Payment Method</th>
              <th style="width:170px">Bank Route</th>
              <th style="width:170px">Bank Account</th>
              <th style="width:170px">Account Type</th>
              <th style="width:170px">Payroll Group</th>
              <th style="width:170px">Default Project</th>
              <th style="width:170px">TimeSheet Approval Grp</th>
              <th style="width:170px">Overtime Approval Grp</th>
              <th style="width:170px">Leave Approval Grp</th>
              <th style="width:170px">Expense Approval Grp</th>
              <th style="width:170px">eBundy Approval Grp</th>
              <th style="width:170px">SSS Contribution Amount</th>
              <th style="width:170px">HDMF Contribution Amount</th>
              <th style="width:170px">Philhealth Contribution Amount</th>
              <th style="width:170px">Witholding Tax</th>
              <th style="width:170px">Cost Center</th>
              <th style="width:170px">Action</th>
            </tr>
            <?php 
            	if($emp_payroll_info != NULL){
            		$counter = 1;
            		foreach($emp_payroll_info as $row){
            ?>
	            <tr>
	              <td><?php print $counter++;?></td>
	              <td><?php print ucwords($row->first_name)." ".ucwords($row->last_name);?></td>
	              <td><?php print $row->payroll_cloud_id;?></td>
	              <td><?php print $row->department_name;?></td>
	              <td><?php print $row->sub_department_id;?></td>
	              <td><?php print $row->employment_type;?></td>
	              <td><?php print $row->position;?></td>
	              <td><?php print $row->date_hired;?></td>
	              <td><?php print $row->last_date;?></td>
	              <td><?php print $row->tax_status;?></td>
	              <td><?php print $row->payment_method;?></td>
	              <td><?php print $row->bank_route;?></td>
	              <td><?php print $row->bank_account;?></td>
	              <td><?php print $row->account_type;?></td>
	              <td><?php print $row->payroll_group_name;?></td>
	              <td><?php print $row->default_project;?></td>
	              <td><?php print $row->timeSheet_approval_grp;?></td>
	              <td><?php print $row->overtime_approval_grp;?></td>
	              <td><?php print $row->leave_approval_grp;?></td>
	              <td><?php print $row->expense_approval_grp;?></td>
	              <td><?php print $row->eBundy_approval_grp;?></td>
	              <td><?php print $row->sss_contribution_amount;?></td>
	              <td><?php print $row->hdmf_contribution_amount;?></td>
	              <td><?php print $row->philhealth_contribution_amount;?></td>
	              <td><?php print $row->witholding_tax;?></td>
	              <td><?php print $row->cost_center;?></td>
	              <td><a href="javascript:void(0);" class="btn btn-gray btn-action editBtnDb" attr_empid="<?php print $row->emp_id;?>">EDIT</a> <a href="javascript:void(0);" class="btn btn-red btn-action delBtnDb" attr_empid="<?php print $row->emp_id;?>">DELETE</a></td>
	            </tr>
            <?php
            		}
            	}else{
            		print "<tr class='msg_empt_cont'><td colspan='27' style='text-align:left;'>".msg_empty()."</td></tr>";
            	}
            ?>
          </tbody></table>
          <span class="ihides unameContBoxTrick"></span>
          <!-- TBL-WRAP END -->
        </div>
        <div class="pagiCont_btnCont">
        	<div class="left"><?php print $links;?></div>
        	<input type="submit" class="btn right addRowBtn" value="ADD ROW" onclick="javascript:return false;" />
        	<input type="submit" name="add" class="btn right ihide saveBtn" value="SAVE" />&nbsp;&nbsp;
        	<div class="clearB"></div>
        </div>
        <div class='del_msg ihide' title='Confirmation'>Do you really want to delete this user?</div>
<?php print form_close();?>

		<div class='editCont ihide' title='Edit Information'>
		<?php print form_open('','onsubmit="return validate_edit_form()" enctype="multipart/form-data"');?>
			  <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table width="100%">
            <tbody>
            <tr>
              <td style="width:155px;">Employee Name</td>
              <td>
              <input type="text" value="" name="emp_nameEdit" class="txtfield emp_nameEdit" readonly="readonly" />
              <input type="text" value="" name="emp_idEdit" class="txtfield emp_idEdit ihide" />
            </tr>
		    
		    <tr>
		    	<td style="width:155px;">Department </td>
		    <td><select style='min-width: 148px;' class='txtselect select-medium department_edit' name='department'><?php if($department == null){ print "<option>".msg_empty()."</option>"; }else{ foreach($department as $row_dept){?> <option value='<?php print $row_dept->dept_id;?><?php echo set_select('department', $row_dept->department_name); ?>'><?php print $row_dept->department_name;?></option><?php } }?></select></td></tr>
		    <tr>
		    	<td style="width:155px;">Sub Department 	</td>
		    <td><input type='text' name='sub_dept' class='valid_to txtfield'></td></tr>
		    <tr>
		   	 <td style="width:155px;">Employment Type</td>
		    <td><select class='txtselect select-medium employment_type_edit' name='employment_type'><option value='Apprentice<?php echo set_select('employment_type', 'Apprentice'); ?>'>Apprentice</option><option value='Real/Fixed<?php echo set_select('employment_type', 'Real/Fixed'); ?>'>Real/Fixed</option></select></td></tr>
		    <tr>
		    	<td style="width:155px;">Position</td>
		    <td><input type='text' name='position' class='valid_to txtfield'></td></tr>
		    <tr>
		    	<td style="width:155px;">Date Hired</td>
		    <td><input type='text' name='date_hired' class='valid_to txtfield datepickerCont'></td></tr>
		    <tr>
		    	<td style="width:155px;">Last Date</td>
		    <td><input type='text' name='last_date' class='valid_to txtfield datepickerCont'></td></tr>
		    <tr>
		    	<td style="width:155px;">Tax Status</td>
		    <td><input type='text' name='tax_status' class='valid_to txtfield'></td></tr>
		    <tr>
		    	<td style="width:155px;">Payment Method</td>
		    <td><select class='txtselect select-medium payment_method_edit' name='payment_method'><option value='Cash<?php echo set_select('payment_method', 'Cash'); ?>'>Cash</option><option value='Debit<?php echo set_select('payment_method', 'Debit'); ?>'>Debit</option></select></td></tr>
		    <tr>
		    	<td style="width:155px;">Bank Route</td>
		    <td><input type='text' name='bank_route' class='valid_to txtfield'></td></tr>
		    <tr>
		    	<td style="width:155px;">Bank Account</td>
		    <td><input type='text' name='bank_account' class='valid_to txtfield'></td></tr>
		    <tr>
		    	<td style="width:155px;">Account Type</td>
		    <td><input type='text' name='account_type' class='valid_to txtfield'></td></tr>
		    <tr>
		    	<td style="width:155px;">Payroll Group</td>
		    <td><select style='min-width: 148px;' class='txtselect select-medium payroll_group_edit' name='payroll_group'><?php if($payroll_group == null){ print "<option>".msg_empty()."</option>"; }else{ foreach($payroll_group as $row_payroll_group){?> <option value='<?php print $row_payroll_group->payroll_group_id;?><?php echo set_select('payroll_group', $row_payroll_group->payroll_group_name); ?>'><?php print $row_payroll_group->payroll_group_name;?></option><?php } }?></select></td></tr>
		    <tr>
		    	<td style="width:155px;">Default Project</td>
		    <td><select class='txtselect select-medium default_project_edit' name='default_project'><option value='Real<?php echo set_select('default_project', 'Real'); ?>'>Real</option><option value='Real Regular<?php echo set_select('default_project', 'Real Regular'); ?>'>Real Regular</option></select></td></tr>
		    <tr>
		    	<td style="width:155px;">TimeSheet Approval Grp</td>
		    <td><input type='text' name='timeSheet_approval_grp' class='valid_to txtfield'></td></tr>
		    <tr>
		    	<td style="width:155px;">Overtime Approval Grp</td>
		    <td><input type='text' name='overtime_approval_grp' class='valid_to txtfield'></td></tr>
		    <tr>
		    	<td style="width:155px;">Leave Approval Grp</td>
		    <td><input type='text' name='leave_approval_grp' class='valid_to txtfield'></td></tr>
		    <tr>
		    	<td style="width:155px;">Expense Approval Grp</td>
		    <td><input type='text' name='expense_approval_grp' class='valid_to txtfield'></td></tr>
		    <tr>
		    	<td style="width:155px;">eBundy Approval Grp</td>
		    <td><input type='text' name='eBundy_approval_grp' class='valid_to txtfield'></td></tr>
		    <tr>
		    	<td style="width:155px;">SSS Contribution Amount</td>
		    <td><input type='text' name='sss_contribution_amount' class='valid_to txtfield'></td></tr>
		    <tr>
		    	<td style="width:155px;">HDMF Contribution Amount</td>
		    <td><input type='text' name='hdmf_contribution_amount' class='valid_to txtfield'></td></tr>
		    <tr>
		    	<td style="width:155px;">Philhealth Contribution Amount</td>
		    <td><input type='text' name='philhealth_contribution_amount' class='valid_to txtfield'></td></tr>
		    <tr>
		    	<td style="width:155px;">Witholding Tax</td>
		    <td><select class='txtselect select-medium witholding_tax_edit' name='witholding_tax'><option value='Yes<?php echo set_select('witholding_tax', 'Yes'); ?>'>Yes</option><option value='No<?php echo set_select('witholding_tax', 'No'); ?>'>No</option></select></td></tr>
		    <tr>
		    	<td style="width:155px;">Cost Center 	</td>
		    <td><input type='text' name='cost_center' class='valid_to txtfield'></td></tr>
		    
            <tr>
              <td>&nbsp;</td>
              <td>
	              <input type="submit" value="Update" name="update_info" class="btn" />
              </td>
            </tr>
          </tbody></table>
          <!-- TBL-WRAP END -->
        </div>
        <?php print form_close();?>
        </div>
<script type="text/javascript"  src="/assets/theme_2013/js/external_js.js"></script>
<script>
	function addRow(size){
		var tbl = "<tr>";
	    tbl += "<td><input readonly='readonly' type='text' name='emp_id[]' class='ihide txtfield emp_id"+size+"' /></td>";
	    tbl += "<td><input type='text' name='emp_name[]' class='txtfield emp_name emp_name"+size+"' class_val='class_val"+size+"' attr_uname_val='"+size+"'></td>";
	    tbl += "<td><input type='text' name='emp_no[]' readonly='readonly' class='txtfield emp_no"+size+"' class_val='class_val"+size+"'></td>";
	    tbl += "<td><select style='min-width: 148px;' class='txtselect select-medium' name='department[]'><?php if($department == null){ print "<option>".msg_empty()."</option>"; }else{ foreach($department as $row_dept){?> <option value='<?php print $row_dept->dept_id;?><?php echo set_select('department[]', $row_dept->department_name); ?>'><?php print $row_dept->department_name;?></option><?php } }?></select></td>";
	    tbl += "<td><input type='text' name='sub_dept[]' class='valid_to txtfield'></td>";
	    tbl += "<td><select class='txtselect select-medium' name='employment_type[]'><option value='Apprentice<?php echo set_select('employment_type[]', 'Apprentice'); ?>'>Apprentice</option><option value='Real/Fixed<?php echo set_select('employment_type[]', 'Real/Fixed'); ?>'>Real/Fixed</option></select></td>";
	    tbl += "<td><input type='text' name='position[]' class='valid_to txtfield'></td>";
	    tbl += "<td><input type='text' name='date_hired[]' class='valid_to txtfield datepickerCont'></td>";
	    tbl += "<td><input type='text' name='last_date[]' class='valid_to txtfield datepickerCont'></td>";
	    tbl += "<td><input type='text' name='tax_status[]' class='valid_to txtfield'></td>";
	    tbl += "<td><select class='txtselect select-medium' name='payment_method[]'><option value='Cash<?php echo set_select('payment_method[]', 'Cash'); ?>'>Cash</option><option value='Debit<?php echo set_select('payment_method[]', 'Debit'); ?>'>Debit</option></select></td>";
	    tbl += "<td><input type='text' name='bank_route[]' class='valid_to txtfield'></td>";
	    tbl += "<td><input type='text' name='bank_account[]' class='valid_to txtfield'></td>";
	    tbl += "<td><input type='text' name='account_type[]' class='valid_to txtfield'></td>";
	    tbl += "<td><select style='min-width: 148px;' class='txtselect select-medium' name='payroll_group[]'><?php if($payroll_group == null){ print "<option>".msg_empty()."</option>"; }else{ foreach($payroll_group as $row_payroll_group){?> <option value='<?php print $row_payroll_group->payroll_group_id;?><?php echo set_select('payroll_group[]', $row_payroll_group->payroll_group_name); ?>'><?php print $row_payroll_group->payroll_group_name;?></option><?php } }?></select></td>";
	    tbl += "<td><select class='txtselect select-medium' name='default_project[]'><option value='Real<?php echo set_select('default_project[]', 'Real'); ?>'>Real</option><option value='Real Regular<?php echo set_select('default_project[]', 'Real Regular'); ?>'>Real Regular</option></select></td>";
	    tbl += "<td><input type='text' name='timeSheet_approval_grp[]' class='valid_to txtfield'></td>";
	    tbl += "<td><input type='text' name='overtime_approval_grp[]' class='valid_to txtfield'></td>";
	    tbl += "<td><input type='text' name='leave_approval_grp[]' class='valid_to txtfield'></td>";
	    tbl += "<td><input type='text' name='expense_approval_grp[]' class='valid_to txtfield'></td>";
	    tbl += "<td><input type='text' name='eBundy_approval_grp[]' class='valid_to txtfield'></td>";
	    tbl += "<td><input type='text' name='sss_contribution_amount[]' class='valid_to txtfield'></td>";
	    tbl += "<td><input type='text' name='hdmf_contribution_amount[]' class='valid_to txtfield'></td>";
	    tbl += "<td><input type='text' name='philhealth_contribution_amount[]' class='valid_to txtfield'></td>";
	    tbl += "<td><select class='txtselect select-medium' name='witholding_tax[]'><option value='Yes<?php echo set_select('witholding_tax[]', 'Yes'); ?>'>Yes</option><option value='No<?php echo set_select('witholding_tax[]', 'No'); ?>'>No</option></select></td>";
	    tbl += "<td><input type='text' name='cost_center[]' class='valid_to txtfield'></td>";
	    tbl += "<td><a href='javascript:void(0);' style='width:127px;' class='btn btn-red btn-action delRow' attr_rowno='"+size+"'>DELETE</a></td>";
	    tbl += "</tr>";
	          
	      // alert(tbl);
	      jQuery(".emp_conList").append(tbl);
	}
	
	function _addRowBtn(){
		jQuery(".addRowBtn").click(function(){
			jQuery("input[name='add']").css({
				"margin-right":"5px",
				"display":"inline"
				});
			var size = shuffle_str("1234frds");
			addRow(size);
			remove_row();
			_name_listing();
			_datepicker();

			// remove msg_empty
			_remove_msg_emp();
		});
	}

	function shuffle_str(str) {
	    var a = str.split(""),
	        n = a.length;

	    for(var i = n - 1; i > 0; i--) {
	        var j = Math.floor(Math.random() * (i + 1));
	        var tmp = a[i];
	        a[i] = a[j];
	        a[j] = tmp;
	    }
	    return a.join("");
	}

	function remove_row(){
		jQuery(".emp_conList tr").each(function(){
		    var _this = jQuery(this);
		    jQuery(this).find(".delRow").on("click", function(){
		        _this.remove();
		        var input_text_size = jQuery("input[name='emp_id[]']").length;
				if(parseInt(input_text_size) == 0) jQuery(".saveBtn").css("display","none");
		    });
		});
	}

	function _name_listing(){
		var emp_list_val = "<?php print substr($employee, 0, -1);?>";
		if(jQuery.trim(emp_list_val) == ""){
			var availableTags = ["No results found"];
		}else{
			var availableTags = [<?php print substr($employee, 0, -1);?>];
		}
		
		jQuery( "input[name='emp_name[]']" ).autocomplete({
			source: availableTags,
			select: function (event, ui) {
				var attr_no = jQuery(this).attr('attr_uname_val');
				jQuery(".emp_id"+attr_no).val(ui.item.emp_id);
				jQuery(".emp_no"+attr_no).val(ui.item.emp_no);
				jQuery(this).attr("readonly",true);
			},minLength: 0
		});

		// bind keyup
		jQuery( "input[name='emp_name[]']" ).on("keyup", function(){
			var attr_no = jQuery(this).attr('attr_uname_val');
			if(jQuery(this).val() == "") jQuery(".emp_no"+attr_no).val("");
			if(jQuery.trim(emp_list_val) == ""){
				jQuery(".ui-autocomplete").css("display","block");
			}
		});
	}

	function validate_form(){
	    jQuery(".emp_conList tr input:text").each(function(){
	        var _this = jQuery(this);
	        var txtfield = _this.val();
	        if(txtfield == ""){
	            _this.addClass("emp_str");
	        }else{
	        	_this.removeClass("emp_str");
	        }
	    });
	    
    	if(jQuery(".emp_conList tr input:text").hasClass("emp_str")){
	    	return false;
	    }else{
	    	// saving data
	    	var _size = parseInt(jQuery("input[name='emp_name[]']").length) - 1;
			var emp_id = [];
			for(var z = 0; z <= _size; z++){
				if(emp_id.indexOf(jQuery("input[name='emp_id[]']").eq(z).val())==-1){
					emp_id.push(jQuery("input[name='emp_id[]']").eq(z).val());
				}else{
					var str_val = 1;
					alert("The Employee Name must contain a unique value");
				}
			}

			if(str_val == 1){
				// The Employee Name must contain a unique value
				return false;
			}
	    }
	}

	function _successContBox(){
		var successContBox = jQuery.trim(jQuery(".successContBox").text());
		if(successContBox != ""){
		    jQuery(".successContBox").css("display","inline-block");
		    setTimeout(function(){
		        jQuery(".successContBox").fadeOut('100');
		    },3000);
		}
	}

	function _delete_empDb(){
    	jQuery(".delBtnDb").on("click", function(){
    	    var _this = jQuery(this);
    	    var _id = _this.attr("attr_empid");
    	    jQuery(".del_msg").dialog({
 		       width: 'inherit',
 			   draggable: false,
 			   modal: true,
 			   width:'auto',
 			   minWidth:'400',
 			   dialogClass:'transparent',
 				buttons: {
 				    'Yes': function(){
 				    	$.ajax({
 							url: window.location.href,
 							type: "POST",
 							data: {
 								'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
 								'delete_db':'1',
 								'emp_id': _id,
 							},
 							success: function(data){
 								var status = jQuery.parseJSON(data);
 	                          	if(status.success == 1){
 	                          		window.location.href = status.url;
 	                            }else{
 	                            	return false;
 	                          	}
 							}
 		        	    });
 				    },
 					'No': function() {
 						$( this ).dialog( "close" );
 					}
 				},
 			   overlay: {
 		   		   opacity: 0
 		   	   }
 		    });
    	});
    }

	function _edit_information(){
		jQuery(".editBtnDb").on("click", function(){
			var _this = jQuery(this);
			var emp_id = _this.attr("attr_empid");
			$.ajax({
				url: window.location.href,
				type: "POST",
				data: {
					get_information: "1",
					emp_id: emp_id,
					'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>")
				},
				success: function(data){
		        	  var status = jQuery.parseJSON(data);
						if(status.success == 1){
							jQuery(".editCont").dialog({
							   	draggable: false,
							   	modal: true,
							   	width:'auto',
							   	minWidth:'400',
							   	dialogClass:'transparent'
							});
							jQuery(".emp_nameEdit").val(status.emp_name);
							jQuery(".emp_idEdit").val(status.emp_id);
							
							jQuery(".department_edit option").each(function(){
								var _this = jQuery(this);
								if(_this.val() == status.department_id){
									_this.prop("selected",true);
								}
							});

							jQuery("input[name='sub_dept']").val(status.sub_department_id);
							
							jQuery(".employment_type_edit option").each(function(){
								var _this = jQuery(this);
								if(_this.val() == status.employment_type){
									_this.prop("selected",true);
								}
							});
							
							jQuery("input[name='position']").val(status.position);
							jQuery("input[name='date_hired']").val(status.date_hired);
							jQuery("input[name='last_date']").val(status.last_date);
							jQuery("input[name='tax_status']").val(status.tax_status);

							jQuery(".payment_method_edit option").each(function(){
								var _this = jQuery(this);
								if(_this.val() == status.payment_method){
									_this.prop("selected",true);
								}
							});

							jQuery("input[name='bank_route']").val(status.bank_route);
							jQuery("input[name='bank_account']").val(status.bank_account);
							jQuery("input[name='account_type']").val(status.account_type);

							jQuery(".payroll_group_edit option").each(function(){
								var _this = jQuery(this);
								if(_this.val() == status.payroll_group_id){
									_this.prop("selected",true);
								}
							});

							jQuery(".default_project_edit option").each(function(){
								var _this = jQuery(this);
								if(_this.val() == status.default_project){
									_this.prop("selected",true);
								}
							});

							jQuery("input[name='timeSheet_approval_grp']").val(status.timeSheet_approval_grp);
							jQuery("input[name='overtime_approval_grp']").val(status.overtime_approval_grp);
							jQuery("input[name='leave_approval_grp']").val(status.leave_approval_grp);
							jQuery("input[name='expense_approval_grp']").val(status.expense_approval_grp);
							jQuery("input[name='eBundy_approval_grp']").val(status.eBundy_approval_grp);
							jQuery("input[name='sss_contribution_amount']").val(status.sss_contribution_amount);
							jQuery("input[name='hdmf_contribution_amount']").val(status.hdmf_contribution_amount);
							jQuery("input[name='philhealth_contribution_amount']").val(status.philhealth_contribution_amount);
							
							jQuery(".witholding_tax_edit option").each(function(){
								var _this = jQuery(this);
								if(_this.val() == status.witholding_tax){
									_this.prop("selected",true);
								}
							});
							
							jQuery("input[name='cost_center']").val(status.cost_center);
							
							jQuery(".editCont input").removeClass("emp_str");
                        }else{
							alert("- Invalid parameter");
							return false;
                        }
				}
			});
		});
	}

	function validate_edit_form(){
		var emp_idEdit = jQuery.trim(jQuery(".emp_idEdit").val());
	    var sub_dept = jQuery.trim(jQuery("input[name='sub_dept']").val());
	    var position = jQuery.trim(jQuery("input[name='position']").val());
	    var date_hired = jQuery.trim(jQuery("input[name='date_hired']").val());
	    var last_date = jQuery.trim(jQuery("input[name='last_date']").val());
	    var tax_status = jQuery.trim(jQuery("input[name='tax_status']").val());
	    var bank_route = jQuery.trim(jQuery("input[name='bank_route']").val());
	    var bank_account = jQuery.trim(jQuery("input[name='bank_account']").val());
	    var account_type = jQuery.trim(jQuery("input[name='account_type']").val());
	    var timeSheet_approval_grp = jQuery.trim(jQuery("input[name='timeSheet_approval_grp']").val());
	    var overtime_approval_grp = jQuery.trim(jQuery("input[name='overtime_approval_grp']").val());
	    var leave_approval_grp = jQuery.trim(jQuery("input[name='leave_approval_grp']").val());
	    var expense_approval_grp = jQuery.trim(jQuery("input[name='expense_approval_grp']").val());
	    var eBundy_approval_grp = jQuery.trim(jQuery("input[name='eBundy_approval_grp']").val());
	    var sss_contribution_amount = jQuery.trim(jQuery("input[name='sss_contribution_amount']").val());
	    var hdmf_contribution_amount = jQuery.trim(jQuery("input[name='hdmf_contribution_amount']").val());
	    var philhealth_contribution_amount = jQuery.trim(jQuery("input[name='philhealth_contribution_amount']").val());
	    var cost_center = jQuery.trim(jQuery("input[name='cost_center']").val());
	    var error = "";
	    if(sub_dept==""){
	        error = 1;
	        jQuery("input[name='sub_dept']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='sub_dept']").removeClass('emp_str');
	    }

	    if(position==""){
	        error = 1;
	        jQuery("input[name='position']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='position']").removeClass('emp_str');
	    }

	    if(date_hired ==""){
	        error = 1;
	        jQuery("input[name='date_hired']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='date_hired']").removeClass('emp_str');
	    }

	    if(last_date ==""){
	        error = 1;
	        jQuery("input[name='last_date']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='last_date']").removeClass('emp_str');
	    }

	    if(tax_status ==""){
	        error = 1;
	        jQuery("input[name='tax_status']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='tax_status']").removeClass('emp_str');
	    }

	    if(bank_route ==""){
	        error = 1;
	        jQuery("input[name='bank_route']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='bank_route']").removeClass('emp_str');
	    }

	    if(bank_account ==""){
	        error = 1;
	        jQuery("input[name='bank_account']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='bank_account']").removeClass('emp_str');
	    }

	    if(account_type ==""){
	        error = 1;
	        jQuery("input[name='account_type']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='account_type']").removeClass('emp_str');
	    }

	    if(timeSheet_approval_grp ==""){
	        error = 1;
	        jQuery("input[name='timeSheet_approval_grp']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='timeSheet_approval_grp']").removeClass('emp_str');
	    }

	    if(overtime_approval_grp ==""){
	        error = 1;
	        jQuery("input[name='overtime_approval_grp']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='overtime_approval_grp']").removeClass('emp_str');
	    }

	    if(leave_approval_grp ==""){
	        error = 1;
	        jQuery("input[name='leave_approval_grp']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='leave_approval_grp']").removeClass('emp_str');
	    }

	    if(expense_approval_grp ==""){
	        error = 1;
	        jQuery("input[name='expense_approval_grp']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='expense_approval_grp']").removeClass('emp_str');
	    }

	    if(eBundy_approval_grp ==""){
	        error = 1;
	        jQuery("input[name='eBundy_approval_grp']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='eBundy_approval_grp']").removeClass('emp_str');
	    }

	    if(sss_contribution_amount ==""){
	        error = 1;
	        jQuery("input[name='sss_contribution_amount']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='sss_contribution_amount']").removeClass('emp_str');
	    }

	    if(hdmf_contribution_amount ==""){
	        error = 1;
	        jQuery("input[name='hdmf_contribution_amount']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='hdmf_contribution_amount']").removeClass('emp_str');
	    }

	    if(philhealth_contribution_amount ==""){
	        error = 1;
	        jQuery("input[name='philhealth_contribution_amount']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='philhealth_contribution_amount']").removeClass('emp_str');
	    }

	    if(cost_center ==""){
	        error = 1;
	        jQuery("input[name='cost_center']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='cost_center']").removeClass('emp_str');
	    }
	    
	    if(error == 1){
			return false;
	    }
	}

	function _datepicker(){
		jQuery(".datepickerCont").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	}

	function _remove_msg_emp(){
    	jQuery(".msg_empt_cont").remove();
    }
	
	function pagination(){
		jQuery("#pagination li").each(function(){
		    jQuery(this).find("a").addClass("btn");;
		});
	}
	
	jQuery(function(){
		_addRowBtn();
		_successContBox();
		_datepicker();
		_delete_empDb();
		_edit_information();
		pagination();
		payroll_info_li();
	});
</script>
<div class="footer-grp-btn">
 <!-- FOOTER-GRP-BTN START -->
 <a class="btn btn-gray left" href="javascript:history.go(-1);">BACK</a> 
 <!-- FOOTER-GRP-BTN END -->
 </div>