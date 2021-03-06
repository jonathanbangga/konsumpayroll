<p>Employee Name: <?php print ucwords($emp_info->first_name)." ".ucwords($emp_info->last_name);?></p>
<p>Employee Number: <?php print $emp_info->payroll_cloud_id;?></p>
<p>Loan Type: <?php print $emp_info->loan_type_name;?></p>
<div class="error_msg_cont"></div>
<?php print form_open('','onsubmit="return validate_form()" enctype="multipart/form-data"');?>
<div class="tbl-wrap">	
		  <?php print $this->session->flashdata('message');?>
          <!-- TBL-WRAP START -->
          
          <!-- 
          <table style="width:930px;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:50px;"></th>
              <th>Payroll Date</th>
              <th>Principal</th>
              <th>Interest</th>
              <th>Installment</th>
              <th>Loan Balance</th>
              <th style="width:170px">Action</th>
            </tr>
            <?php 
            	if($emp_amortization != NULL){
            		$counter = 1;
            		$zero_value = 0;
            		foreach($emp_amortization as $row){
            			$zero_value = $zero_value + $row->principal;
            ?>
	            <tr>
	              <td><?php print $counter++;?></td>
	              <td><?php print $row->payroll_date;?></td>
	              <td><?php print number_format($row->principal, 2);?></td>
	              <td><?php print number_format($row->interest, 2);?></td>
	              <td><?php print number_format($row->payment, 2);?></td>
	              <td>
	              	<?php 
	              		$total_loan_balance = $loan_amount - $zero_value; 
	              		print number_format($total_loan_balance, 2);
	              	?>
              	  </td>
	              <td>
	              	<a href="javascript:void(0);" class="btn btn-gray btn-action editBtnDb" employee_amortization_schedule_id="<?php print $row->employee_amortization_schedule_id;?>" >EDIT</a> 
	              	<a href="javascript:void(0);" class="btn btn-red btn-action delBtnDb" employee_amortization_schedule_id="<?php print $row->employee_amortization_schedule_id;?>" >DELETE</a>
              	  </td>
	            </tr>
            <?php
            		}
            	}else{
            		print "<tr class='msg_empt_cont'><td colspan='7' style='text-align:left;'>".msg_empty()."</td></tr>";
            	}
            ?>
          </tbody></table>
           -->
           
			<?php 
				if($emp_amortization != NULL){
					foreach($emp_amortization as $row){
            			print view_table_group_amortization($row->emp_loan_id,$row->employee_amortization_schedule_group,$row->loan_amount_child);
					}
				}else{
					print '
						<table style="width:930px;" class="tbl emp_conList">
			            <tbody><tr>
			              <th style="width:50px;"></th>
			              <th>Payroll Date</th>
			              <th>Principal</th>
			              <th>Interest</th>
			              <th>Installment</th>
			              <th>Loan Balance</th>
			              <th style="width:170px">Action</th>
			            </tr>
					';
            		print "<tr class='msg_empt_cont'><td colspan='7' style='text-align:left;'>".msg_empty()."</td></tr></tbody></table>";
            	}
			?>
           
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
        <div class="footer-grp-btn">
		 <!-- FOOTER-GRP-BTN START -->
		 <a class="btn btn-gray left" href="javascript:history.go(-1);">BACK</a> 
		 <!-- FOOTER-GRP-BTN END -->
		 </div>
		 <style>
			.tbl-wrap > p {
			    padding: 20px 0;
			}
		 </style>
<?php print form_close();?>

		<div class='editCont ihide' title='Edit Information'>
		<?php print form_open('','onsubmit="return validate_edit_form()" enctype="multipart/form-data"');?>
			  <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table width="100%">
            <tbody>
            <tr>
              <td style="width:155px">Principal</td>
              <td>
              <input type="text" name="employee_amortization_schedule_id" class="txtfield employee_amortization_schedule_id ihide" />
              <input type='text' name='principal' class='principal txtfield'></td></tr>
              <tr><td style="width:155px">Interest</td>
              <td><input type='text' name='interest' class='interest txtfield'></td></tr>
            <tr>
              <td style="width:155px">Payroll Date</td>
              <td>
              <input type="text" name="payroll_date" class="payroll_date txtfield datepickerCont" />
            </tr>
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
	    tbl += "<td><input readonly='readonly' type='text' name='loan_no[]' class='ihide txtfield loan_no"+size+"' value='<?php print $emp_info->employee_loans_id;?>' /></td>";
	    tbl += "<td><input type='text' name='payroll_date[]' class='payroll_date txtfield datepickerCont'></td>";
	    tbl += "<td><input type='text' name='principal[]' class='principal txtfield principal"+size+"' principal_attr="+size+"></td>";
	    tbl += "<td><input type='text' name='interest[]' class='interest txtfield interest"+size+"' interest_attr="+size+"></td>";
	    tbl += "<td></td>";
	    tbl += "<td></td>";
	    tbl += "<td><a href='javascript:void(0);' style='width:127px;' class='btn btn-red btn-action delRow' attr_rowno='"+size+"'>DELETE</a></td>";
	    tbl += "</tr>";
	          
	      // alert(tbl);
	      jQuery(".emp_conList").last().append(tbl);
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
		        var input_text_size = jQuery("input[name='payroll_date[]']").length;
				if(parseInt(input_text_size) == 0){
					jQuery(".error_msg_cont").html("");
					jQuery(".saveBtn").css("display","none");
				}
		    });
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
		var why_payroll_date = "";
		var why_principal = "";
		var why_interest = "";

		for(var a=0;a<=100;a++){ // a = dummy
			var payroll_date = jQuery("input[name='payroll_date[]']").eq(a).val();
	    	var principal = jQuery("input[name='principal[]']").eq(a).val();
	    	var interest = jQuery("input[name='interest[]']").eq(a).val();

	    	if(payroll_date == "") why_payroll_date = 1;
	    	if(principal == "") why_principal = 1;
	    	if(interest == "") why_interest = 1;
		}

		if(why_payroll_date != "") why += "<p>- Please enter Payroll Date</p>";
		if(why_principal != "") why += "<p>- Please enter Principal</p>";
		if(why_interest != "") why += "<p>- Please enter Interest</p>";

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
    	    var _id = _this.attr("employee_amortization_schedule_id");
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
			var employee_amortization_schedule_id = _this.attr("employee_amortization_schedule_id");
			$.ajax({
				url: window.location.href,
				type: "POST",
				data: {
					get_information: "1",
					employee_amortization_schedule_id: employee_amortization_schedule_id,
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
							jQuery("input[name='employee_amortization_schedule_id']").val(status.employee_amortization_schedule_id);
							jQuery("input[name='payroll_date']").val(status.payroll_date);
							jQuery("input[name='payment']").val(status.payment);
							jQuery("input[name='interest']").val(status.interest);
							jQuery("input[name='principal']").val(status.principal);
							
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
		var employee_amortization_schedule_id = jQuery.trim(jQuery(".employee_amortization_schedule_id").val());
	    var payroll_date = jQuery.trim(jQuery("input[name='payroll_date']").val());
	    // var payment = jQuery.trim(jQuery("input[name='payment']").val());
	    var interest = jQuery.trim(jQuery("input[name='interest']").val());
	    var principal = jQuery.trim(jQuery("input[name='principal']").val());
	    
	    var error = "";
	    
	    if(employee_amortization_schedule_id==""){
	        error = 1;
	        jQuery("input[name='employee_amortization_schedule_id']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='employee_amortization_schedule_id']").removeClass('emp_str');
	    }

	    if(payroll_date==""){
	        error = 1;
	        jQuery("input[name='payroll_date']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='payroll_date']").removeClass('emp_str');
	    }
	    
	    /* if(payment==""){
	        error = 1;
	        jQuery("input[name='payment']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='payment']").removeClass('emp_str');
	    } */

	    if(interest==""){
	        error = 1;
	        jQuery("input[name='interest']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='interest']").removeClass('emp_str');
	    }

	    if(principal==""){
	        error = 1;
	        jQuery("input[name='principal']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='principal']").removeClass('emp_str');
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

	function change_employee(){
		jQuery(".emp_name").focus(function(){
		    var _this = jQuery(this);
		    var _attr = _this.attr("attr_uname_val");
		    _this.removeAttr("readonly").val("");
		    jQuery(".emp_no"+_attr).val("");
		    jQuery(".emp_id"+_attr).val("");
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
		loan_li();
	});
</script>