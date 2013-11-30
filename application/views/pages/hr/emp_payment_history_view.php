<p>Employee Name: <?php print ucwords($emp_info->first_name)." ".ucwords($emp_info->last_name);?></p>
<p>Employee Number: <?php print $emp_info->payroll_cloud_id;?></p>
<p>Loan Type: <?php print $emp_info->loan_type_name;?></p>
<p>Date Granted: <?php print $emp_info->date_granted;?></p>
<p>Loan Amount: <?php print $emp_info->principal;?></p>
<?php print form_open('','onsubmit="return validate_form()" enctype="multipart/form-data"');?>
<div class="tbl-wrap">	
		  <?php print $this->session->flashdata('message');?>
          <!-- TBL-WRAP START -->
          <table style="width:1240px;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:50px;"></th>
              <th style="width:170px;">Interest</th>
              <th style="width:170px;">Principal</th>
              <th style="width:170px;">Credit Balance on Principal</th>
              <th style="width:170px;">Credit Balance on Interest</th>
              <th style="width:170px">Penalty</th>
              <th style="width:170px;">Loan Balance</th>
              <th style="width:170px">Action</th>
            </tr>
            <?php 
            	if($emp_payment_history != NULL){
            		$counter = 1;
            		foreach($emp_payment_history as $row){
            ?>
	            <tr>
	              <td><?php print $counter++;?></td>
	              <td><?php print $row->interest;?></td>
	              <td><?php print $row->principal;?></td>
	              <td><?php print $row->credit_balance_on_principal;?></td>
	              <td><?php print $row->credit_balance_on_interest;?></td>
	              <td><?php print $row->penalty;?></td>
	              <td>Loan Balance</td>
	              <td>
	              	<a href="javascript:void(0);" class="btn btn-gray btn-action editBtnDb" employee_payment_history_id="<?php print $row->employee_payment_history_id;?>" >EDIT</a> 
	              	<a href="javascript:void(0);" class="btn btn-red btn-action delBtnDb" employee_payment_history_id="<?php print $row->employee_payment_history_id;?>" >DELETE</a>
              	  </td>
	            </tr>
            <?php
            		}
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
        <div class="footer-grp-btn">
		 <!-- FOOTER-GRP-BTN START -->
		 <a class="btn btn-gray left" href="javascript:history.go(-1);">BACK</a> 
		 <!-- FOOTER-GRP-BTN END -->
		 </div>
<?php print form_close();?>

		<div class='editCont ihide' title='Edit Information'>
		<?php print form_open('','onsubmit="return validate_edit_form()" enctype="multipart/form-data"');?>
			  <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table width="100%">
            <tbody>
            <tr>
              <td style="width:155px">Interest</td>
              <td>
              <input type="text" name="employee_payment_history_id" class="txtfield employee_payment_history_id ihide" />
              <input type='text' name='interest' class='payment txtfield'></td>
              </tr>
		    <tr>
            <tr>
              <td style="width:155px">Principal</td>
              <td>
              <input type="text" name="principal" class="principal txtfield" />
            </tr>
              <tr><td style="width:155px">Credit Balance on Principal</td>
              <td><input type='text' name='credit_balance_on_principal' class='credit_balance_on_principal txtfield'></td></tr>
		    <tr>
              <td style="width:155px">Credit Balance on Interest</td>
              <td><input type='text' name='credit_balance_on_interest' class='credit_balance_on_interest txtfield'></td></tr>
           	<tr>
              <td style="width:155px">Penalty</td>
              <td><input type='text' name='penalty' class='penalty txtfield'></td></tr>
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
<script>
	function addRow(size){
		var tbl = "<tr>";
	    tbl += "<td><input readonly='readonly' type='text' name='loan_no[]' class='ihide txtfield loan_no"+size+"' value='<?php print $emp_info->employee_loans_id;?>' /></td>";
	    tbl += "<td><input type='text' name='interest[]' class='interest txtfield'></td>";
	    tbl += "<td><input type='text' name='principal[]' class='principal txtfield'></td>";
	    tbl += "<td><input type='text' name='credit_bal_principal[]' class='credit_bal_principal txtfield'></td>";
	    tbl += "<td><input type='text' name='credit_bal_interest[]' class='credit_bal_interest txtfield'></td>";
	    tbl += "<td><input type='text' name='penalty[]' class='penalty txtfield'></td>";
	    tbl += "<td></td>";
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
			_datepicker();
			change_employee();
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
    	    var _id = _this.attr("employee_payment_history_id");
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
			var employee_payment_history_id = _this.attr("employee_payment_history_id");
			$.ajax({
				url: window.location.href,
				type: "POST",
				data: {
					get_information: "1",
					employee_payment_history_id: employee_payment_history_id,
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
							
							jQuery("input[name='employee_payment_history_id']").val(status.employee_payment_history_id);
							jQuery("input[name='interest']").val(status.interest);
							jQuery("input[name='principal']").val(status.principal);
							jQuery("input[name='credit_balance_on_principal']").val(status.credit_balance_on_principal);
							jQuery("input[name='credit_balance_on_interest']").val(status.credit_balance_on_interest);
							jQuery("input[name='penalty']").val(status.penalty);
							
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
	    var employee_payment_history_id = jQuery.trim(jQuery("input[name='employee_payment_history_id']").val());
	    var interest = jQuery.trim(jQuery("input[name='interest']").val());
	    var principal = jQuery.trim(jQuery("input[name='principal']").val());
	    var credit_balance_on_principal = jQuery.trim(jQuery("input[name='credit_balance_on_principal']").val());
	    var credit_balance_on_interest = jQuery.trim(jQuery("input[name='credit_balance_on_interest']").val());
	    var penalty = jQuery.trim(jQuery("input[name='penalty']").val());
	    
	    var error = "";
	    if(employee_payment_history_id==""){
	        error = 1;
	        jQuery("input[name='employee_payment_history_id']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='employee_payment_history_id']").removeClass('emp_str');
	    }
	    
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

	    if(credit_balance_on_principal==""){
	        error = 1;
	        jQuery("input[name='credit_balance_on_principal']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='credit_balance_on_principal']").removeClass('emp_str');
	    }
	    if(credit_balance_on_interest==""){
	        error = 1;
	        jQuery("input[name='credit_balance_on_interest']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='credit_balance_on_interest']").removeClass('emp_str');
	    }
	    
	    if(penalty==""){
	        error = 1;
	        jQuery("input[name='penalty']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='penalty']").removeClass('emp_str');
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
	});
</script>