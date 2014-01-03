<p>Employee Name: <?php print $fullname;?></p>
<p>Employee Number: <?php print $payroll_cloud_id;?></p>
<div class="error_msg_cont"></div>
<?php print form_open('','onsubmit="return validate_form()" enctype="multipart/form-data"');?>
<div class="tbl-wrap">	
		  <?php print $this->session->flashdata('message');?>
          <!-- TBL-WRAP START -->
          <table style="width:2526px;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:50px;"></th>
              <th style="width:170px;">Loan Number</th>
              <th style="width:170px;">Loan Type</th>
              <th style="width:170px;">Date Granted</th>
              <th style="width:170px;">Loan Amount</th>
              <th style="width:170px;">Term(months)</th>
              <th style="width:170px;">Interest Rate%</th>
              <th style="width:170px;">Penalty Rate%</th>
              <th style="width:170px;">Beginning Balance</th>
              <th style="width:170px;">Bank Route</th>
              <th style="width:170px;">Bank Account</th>
              <th style="width:170px;">Account Type</th>
              <th style="width:170px;">Monthly Amortization</th>
              <th style="width:436px">Action</th>
            </tr>
            <?php 
            	if($emp_loan != NULL){
            		$counter = 1;
            		foreach($emp_loan as $row){
            ?>
	            <tr>
	              <td><?php print $counter++;?></td>
	              <td><?php print $row->loan_no;?></td>
	              <td><?php print $row->loan_type_name;?></td>
	              <td><?php print $row->date_granted;?></td>
	              <td><?php print $row->principal;?></td>
	              <td><?php print $row->terms;?></td>
	              <td><?php print $row->interest_rates;?></td>
	              <td><?php print $row->penalty_rates;?></td>
	              <td><?php print $row->beginning_balance;?></td>
	              <td><?php print $row->bank_route;?></td>
	              <td><?php print $row->bank_account;?></td>
	              <td><?php print $row->account_type;?></td>
	              <td><?php print $row->monthly_amortization;?></td>
	              <td>
	              	<a href="javascript:void(0);" class="btn btn-gray btn-action editBtnDb" employee_loans_id="<?php print $row->employee_loans_id;?>" attr_empid="<?php print $row->emp_id;?>">EDIT</a> 
	              	<a href="javascript:void(0);" class="btn btn-red btn-action delBtnDb" attr_empid="<?php print $row->emp_id;?>" employee_loans_id="<?php print $row->employee_loans_id;?>">DELETE</a>
	              	<a href="<?php print $this->uri->segment(1);?>/hr/emp_amortization_schedule/index/<?php print $row->employee_loans_id;?>" class="btn">AMORTIZATION SCHEDULE</a> 
	              	<a href="<?php print $this->uri->segment(1);?>/hr/emp_payment_history/index/<?php print $row->employee_loans_id;?>" class="btn">PAYMENT HISTORY</a>
              	  </td>
	            </tr>
            <?php
            		}
            	}else{
            		print "<tr class='msg_empt_cont'><td colspan='14' style='text-align:left;'>".msg_empty()."</td></tr>";
            	}
            ?>
          </tbody></table>
          <!-- TBL-WRAP END -->
        </div>
       		 <div class="pagiCont_btnCont">
        	<div class="left"><?php print $links;?></div>
        	<input type="submit" class="btn right addRowBtn" value="ADD ROW" onclick="javascript:return false;" />
	        	<input type="submit" name="add" class="btn right ihide saveBtn" value="SAVE" />&nbsp;&nbsp;	
	        	<div class="clearB"></div>
        	</div>
        	<div class="footer-grp-btn">
			 <!-- FOOTER-GRP-BTN START -->
			 <a class="btn btn-gray left" href="javascript:history.go(-1);">BACK</a> 
			 <!-- FOOTER-GRP-BTN END -->
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
              <td style="width:155px">Employee Name</td>
              <td>
              <input type="text" value="" name="employee_loans_id_edit" class="txtfield employee_loans_id_edit ihide" />
              <input type="text" value="" name="emp_nameEdit" class="txtfield emp_nameEdit" readonly="readonly" />
            </tr>
            <tr>
              <td style="width:155px">Loan Number</td>
              <td><input type='text' name='loan_no' class='amount txtfield'></td></tr>
              <td style="width:155px">Date Granted</td>
              <td><input type='text' name='date_granted' class='date_granted txtfield datepickerCont'></td></tr>
		    <tr>
              <td style="width:155px">Principal</td>
              <td><input type='text' name='principal' class='principal txtfield'></td></tr>
		    <tr>
              <td style="width:155px">Term(months)</td>
              <td><input type='text' name='terms' class='terms txtfield'></td></tr>
		    <tr>
              <td style="width:155px">Interest Rate%</td>
              <td><input type='text' name='interest_rate' class='txtfield interest_rate'></td></tr>
		    <tr>
              <td style="width:155px">Penalty Rate%</td>
              <td><input type='text' name='penalty_rate' class='penalty_rate txtfield'></td></tr>
		    <tr>
              <td style="width:155px">Beginning Balance</td>
              <td><input type='text' name='beginning_balance' class='beginning_balance txtfield'></td></tr>
		    <tr>
              <td style="width:155px">Bank Route</td>
              <td><input type='text' name='bank_route' class='bank_route txtfield'></td></tr>
		    <tr>
              <td style="width:155px">Bank Account</td>
              <td><input type='text' name='bank_account' class='txtfield bank_account'></td></tr>
		    <tr>
              <td style="width:155px">Account Type</td>
              <td><input type='text' name='account_type' class='account_type txtfield'></td></tr>
		    <tr>
              <td style="width:155px">Monthly Amortization 	</td>
              <td><input type='text' name='monthly_amortization' class='monthly_amortization txtfield'></td></tr>
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
	    tbl += "<td><input readonly='readonly' type='text' name='emp_id[]' class='ihide txtfield emp_id"+size+"' value='<?php print $emp_id;?>' /></td>";
	    tbl += "<td><input type='text' name='loan_no[]' class='amount txtfield'></td>";
	    tbl += "<td><select style='width: 120px;' class='txtselect select-medium loan_type' name='loan_type[]'><?php if($loan_type == null){ print "<option value=''>".msg_empty()."</option>"; }else{ foreach($loan_type as $row_lype){?> <option value='<?php print $row_lype->loan_type_id;?><?php echo set_select('loan_type[]', $row_lype->loan_type_id); ?>'><?php print $row_lype->loan_type_name;?></option><?php } }?></select></td>";
	    tbl += "<td><input type='text' name='date_granted[]' class='date_granted txtfield datepickerCont'></td>";
	    tbl += "<td><input type='text' name='principal[]' class='principal txtfield'></td>";
	    tbl += "<td><input type='text' name='terms[]' class='terms txtfield'></td>";
	    tbl += "<td><input type='text' name='interest_rate[]' class='txtfield interest_rate'></td>";
	    tbl += "<td><input type='text' name='penalty_rate[]' class='penalty_rate txtfield'></td>";
	    tbl += "<td><input type='text' name='beginning_balance[]' class='beginning_balance txtfield'></td>";
	    tbl += "<td><input type='text' name='bank_route[]' class='bank_route txtfield'></td>";
	    tbl += "<td><input type='text' name='bank_account[]' class='txtfield bank_account'></td>";
	    tbl += "<td><input type='text' name='account_type[]' class='account_type txtfield'></td>";
	    tbl += "<td><input type='text' name='monthly_amortization[]' class='monthly_amortization txtfield'></td>";
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
			change_employee();

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
				if(parseInt(input_text_size) == 0){
					jQuery(".saveBtn").css("display","none");
					jQuery(".error_msg_cont").html("");
				}
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

	    jQuery(".emp_conList tr select").each(function(){
	        var _this = jQuery(this);
	        var txtfield = _this.val();
	        if(txtfield == ""){
	            _this.addClass("emp_str");
	        }else{
	        	_this.removeClass("emp_str");
	        }
	    });

	 	// show error msg
	    var why = "";
		var why_loan_no = "";
		var why_loan_type = "";
		var why_date_granted = "";
		var why_principal = "";
		var why_terms = "";
		var why_interest_rate = "";
		var why_penalty_rate = "";
		var why_beginning_balance = "";
		var why_bank_route = "";
		var why_bank_account = "";
		var why_account_type = "";
		var why_monthly_amortization = "";
		
		for(var a=0;a<=100;a++){ // a = dummy
	    	var loan_no = jQuery("input[name='loan_no[]']").eq(a).val();
	    	var loan_type = jQuery("select[name='loan_type[]']").eq(a).val();
	    	var date_granted = jQuery("input[name='date_granted[]']").eq(a).val();
	    	var principal = jQuery("input[name='principal[]']").eq(a).val();
	    	var terms = jQuery("input[name='terms[]']").eq(a).val();
	    	var interest_rate = jQuery("input[name='interest_rate[]']").eq(a).val();
	    	var penalty_rate = jQuery("input[name='penalty_rate[]']").eq(a).val();
	    	var beginning_balance = jQuery("input[name='beginning_balance[]']").eq(a).val();
	    	var bank_route = jQuery("input[name='bank_route[]']").eq(a).val();
	    	var bank_account = jQuery("input[name='bank_account[]']").eq(a).val();
	    	var account_type = jQuery("input[name='account_type[]']").eq(a).val();
	    	var monthly_amortization = jQuery("input[name='monthly_amortization[]']").eq(a).val();

	    	if(loan_no == "") why_loan_no = 1;
	    	if(loan_type == "") why_loan_type = 1;
	    	if(date_granted == "") why_date_granted = 1;
	    	if(principal == "") why_principal = 1;
	    	if(terms == "") why_terms = 1;
	    	if(interest_rate == "") why_interest_rate = 1;
	    	if(penalty_rate == "") why_penalty_rate = 1;
	    	if(beginning_balance == "") why_beginning_balance = 1;
	    	if(bank_route == "") why_bank_route = 1;
	    	if(bank_account == "") why_bank_account = 1;
	    	if(account_type == "") why_account_type = 1;
	    	if(monthly_amortization == "") why_monthly_amortization = 1;
    	}

		if(why_loan_no != "") why += "<p>- Please enter Loan Number</p>";
		if(why_loan_type != "") why += "<p>- Please select Loan Type</p>";
		if(why_date_granted != "") why += "<p>- Please enter Date Granted</p>";
		if(why_principal != "") why += "<p>- Please enter Loan Amount</p>";
		if(why_terms != "") why += "<p>- Please enter Term(months)</p>";
		if(why_interest_rate != "") why += "<p>- Please enter Interest Rate%</p>";
		if(why_penalty_rate != "") why += "<p>- Please enter Penalty Rate%</p>";
		if(why_beginning_balance != "") why += "<p>- Please enter Beginning Balance</p>";
		if(why_bank_route != "") why += "<p>- Please enter Bank Route</p>";
		if(why_bank_account != "") why += "<p>- Please enter Bank Account</p>";
		if(why_account_type != "") why += "<p>- Please enter Account Type</p>";
		if(why_monthly_amortization != "") why += "<p>- Please enter Monthly Amortization</p>";

		if(why != ""){
			jQuery(".error_msg_cont").html(why);
			return false;
		}else{
			jQuery(".error_msg_cont").html("");
		}
	    
    	if(jQuery(".emp_conList tr input:text").hasClass("emp_str") || jQuery(".emp_conList tr select").hasClass("emp_str")){
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
    	    var _id = _this.attr("employee_loans_id");
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
 								'loan_id': _id,
 							},
 							success: function(data){
 								var status = jQuery.parseJSON(data);
 	                          	if(status.success == 1){
 	                          		window.location.href = status.url;
 	                          		$( this ).dialog( "close" );
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
			var employee_loans_id = _this.attr("employee_loans_id");
			$.ajax({
				url: window.location.href,
				type: "POST",
				data: {
					get_information: "1",
					employee_loans_id: employee_loans_id,
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
							jQuery(".employee_loans_id_edit").val(status.employee_loans_id);
							jQuery("input[name='loan_no']").val(status.loan_no);
							jQuery("input[name='date_granted']").val(status.date_granted);
							jQuery("input[name='principal']").val(status.principal);
							jQuery("input[name='terms']").val(status.terms);
							jQuery("input[name='interest_rate']").val(status.interest_rates);
							jQuery("input[name='penalty_rate']").val(status.penalty_rates);
							jQuery("input[name='beginning_balance']").val(status.beginning_balance);
							jQuery("input[name='bank_route']").val(status.bank_route);
							jQuery("input[name='bank_account']").val(status.bank_account);
							jQuery("input[name='account_type']").val(status.account_type);
							jQuery("input[name='monthly_amortization']").val(status.monthly_amortization);
							
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
	    var loan_no = jQuery.trim(jQuery("input[name='loan_no']").val());
	    var date_granted = jQuery.trim(jQuery("input[name='date_granted']").val());
	    var principal = jQuery.trim(jQuery("input[name='principal']").val());
	    var terms = jQuery.trim(jQuery("input[name='terms']").val());
	    var interest_rate = jQuery.trim(jQuery("input[name='interest_rate']").val());
	    var penalty_rate = jQuery.trim(jQuery("input[name='penalty_rate']").val());
	    var beginning_balance = jQuery.trim(jQuery("input[name='beginning_balance']").val());
	    var bank_route = jQuery.trim(jQuery("input[name='bank_route']").val());
	    var bank_account = jQuery.trim(jQuery("input[name='bank_account']").val());
	    var account_type = jQuery.trim(jQuery("input[name='account_type']").val());
	    var monthly_amortization = jQuery.trim(jQuery("input[name='monthly_amortization']").val());
	    
	    var error = "";
	    if(loan_no==""){
	        error = 1;
	        jQuery("input[name='loan_no']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='loan_no']").removeClass('emp_str');
	    }
	    
	    if(date_granted==""){
	        error = 1;
	        jQuery("input[name='date_granted']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='date_granted']").removeClass('emp_str');
	    }

	    if(principal==""){
	        error = 1;
	        jQuery("input[name='principal']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='principal']").removeClass('emp_str');
	    }

	    if(terms==""){
	        error = 1;
	        jQuery("input[name='terms']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='terms']").removeClass('emp_str');
	    }
	    if(interest_rate==""){
	        error = 1;
	        jQuery("input[name='interest_rate']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='interest_rate']").removeClass('emp_str');
	    }
	    
	    if(penalty_rate==""){
	        error = 1;
	        jQuery("input[name='penalty_rate']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='penalty_rate']").removeClass('emp_str');
	    }

	    if(beginning_balance==""){
	        error = 1;
	        jQuery("input[name='beginning_balance']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='beginning_balance']").removeClass('emp_str');
	    }

	    if(bank_route==""){
	        error = 1;
	        jQuery("input[name='bank_route']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='bank_route']").removeClass('emp_str');
	    }

	    if(bank_account==""){
	        error = 1;
	        jQuery("input[name='bank_account']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='bank_account']").removeClass('emp_str');
	    }

	    if(account_type==""){
	        error = 1;
	        jQuery("input[name='account_type']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='account_type']").removeClass('emp_str');
	    }

	    if(monthly_amortization==""){
	        error = 1;
	        jQuery("input[name='monthly_amortization']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='monthly_amortization']").removeClass('emp_str');
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
	
	function change_employee(){
		jQuery(".emp_name").focus(function(){
		    var _this = jQuery(this);
		    var _attr = _this.attr("attr_uname_val");
		    _this.removeAttr("readonly").val("");
		    jQuery(".emp_no"+_attr).val("");
		    jQuery(".emp_id"+_attr).val("");
		});
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
		loan_li();
	});
</script>