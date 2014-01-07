<?php print form_open('','onsubmit="return validateForm()"');?>
<div class="main-content add_payroll_journal_entries">
<?php print $this->session->flashdata('message');?>
        <!-- MAIN-CONTENT START -->
        <p>Enter the account code and/or account description for each type of employee's income or earnings.<br>
          If you use one generic account for any kind of earnings, enter the same account for each.</p>
        <div class="tbl-wrap">
          <table class="tbl">
            <tr>
              <th style="width:172px;">Earnings</th>
              <th style="width:135px;">Account Code</th>
              <th style="width:135px;">Description</th>
            </tr>
            <?php 
            	if($earnings != NULL){
            		foreach($earnings as $row){
            ?>
	            <tr>
	              <td>
	              <input class="txtfield ihide" name="earnings_id[]" type="hidden" value="<?php print $row->payroll_journal_entries_id;?>">
	              <input readonly="readonly" style="width:115px;background:none;border:0;text-align: center;color: #333333;font-size:11px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;" class="" name="earnings[]" type="text" value="<?php print $row->earnings;?>"></td>
	              <td><input readonly="readonly" style="width:115px;" class="txtfield" name="earnings_account_code[]" type="text" value="<?php print $row->account_code;?>"></td>
	              <td><input readonly="readonly" style="width:115px;" class="txtfield" name="earnings_description[]" type="text" value="<?php print $row->description;?>"></td>
	            </tr>
			<?php
            		}
            	}else{
            ?>
            
            	<tr>
	              <td><input readonly="readonly" style="width:115px;background:none;border:0;text-align: center;color: #333333;font-size:11px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;" class="" name="earnings[]" type="text" value="Basic Pay"></td>
	              <td><input style="width:115px;" class="txtfield" name="earnings_account_code[]" type="text"></td>
	              <td><input style="width:115px;" class="txtfield" name="earnings_description[]" type="text"></td>
	            </tr>
	            <tr>
	              <td><input readonly="readonly" style="width:115px;background:none;border:0;text-align: center;color: #333333;font-size:11px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;" class="" name="earnings[]" type="text" value="Overtime"></td>
	              <td><input style="width:115px;" class="txtfield" name="earnings_account_code[]" type="text"></td>
	              <td><input style="width:115px;" class="txtfield" name="earnings_description[]" type="text"></td>
	            </tr>
	            <tr>
	              <td><input readonly="readonly" style="width:115px;background:none;border:0;text-align: center;color: #333333;font-size:11px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;" class="" name="earnings[]" type="text" value="Holiday/Premium Pay"></td>
	              <td><input style="width:115px;" class="txtfield" name="earnings_account_code[]" type="text"></td>
	              <td><input style="width:115px;" class="txtfield" name="earnings_description[]" type="text"></td>
	            </tr>
	            <tr>
	              <td><input readonly="readonly" style="width:115px;background:none;border:0;text-align: center;color: #333333;font-size:11px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;" class="" name="earnings[]" type="text" value="Night Shift Differential"></td>
	              <td><input style="width:115px;" class="txtfield" name="earnings_account_code[]" type="text"></td>
	              <td><input style="width:115px;" class="txtfield" name="earnings_description[]" type="text"></td>
	            </tr>
            
            <?php
            	}
            ?>
          </table>
        </div>
        <p> Enter the account code and/or description for SSS, Philhealth and HDMF.The expense refers to the<br>
          employer share only while the payable refers to the total contribution amount to be remitted by the company.</p>
        <div class="tbl-wrap">
          <table class="tbl">
            <tr>
              <th style="width:172px;">Government Contributions</th>
              <th style="width:135px;">Account Code</th>
              <th style="width:135px;">Description</th>
            </tr>
            <?php 
            	if($government_contributions != NULL){
            		foreach($government_contributions as $row){
            ?>
            	<tr>
	              <td>
	              <input class="txtfield ihide" name="government_contributions_id[]" type="hidden" value="<?php print $row->payroll_journal_entries_government_contributions_id;?>">
	              <input readonly="readonly" style="width:160px;background:none;border:0;text-align: center;color: #333333;font-size:11px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;" class="" name="government_contributions[]" type="text" value="<?php print $row->government_contributions;?>"></td>
	              <td><input readonly="readonly" style="width:115px;" class="txtfield" name="government_contributions_account_code[]" type="text" value="<?php print $row->account_code;?>"></td>
	              <td><input readonly="readonly" style="width:115px;" class="txtfield" name="government_contributions_description[]" type="text" value="<?php print $row->description;?>"></td>
	            </tr>
            <?php
            		}
            	}else{
            ?>
            	<tr>
	              <td><input readonly="readonly" style="width:130px;background:none;border:0;text-align: center;color: #333333;font-size:11px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;" class="" name="government_contributions[]" type="text" value="SSS Contribution Expense"></td>
	              <td><input style="width:115px;" class="txtfield" name="government_contributions_account_code[]" type="text"></td>
	              <td><input style="width:115px;" class="txtfield" name="government_contributions_description[]" type="text"></td>
	            </tr>
	            <tr>
	              <td><input readonly="readonly" style="width:145px;background:none;border:0;text-align: center;color: #333333;font-size:11px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;" class="" name="government_contributions[]" type="text" value="HDMF Contribution Expense"></td>
	              <td><input style="width:115px;" class="txtfield" name="government_contributions_account_code[]" type="text"></td>
	              <td><input style="width:115px;" class="txtfield" name="government_contributions_description[]" type="text"></td>
	            </tr>
	            <tr>
	              <td><input readonly="readonly" style="width:160px;background:none;border:0;text-align: center;color: #333333;font-size:11px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;" class="" name="government_contributions[]" type="text" value="PhilHealth Contribution Payable"></td>
	              <td><input style="width:115px;" class="txtfield" name="government_contributions_account_code[]" type="text"></td>
	              <td><input style="width:115px;" class="txtfield" name="government_contributions_description[]" type="text"></td>
	            </tr>
	            <tr>
	              <td><input readonly="readonly" style="width:115px;background:none;border:0;text-align: center;color: #333333;font-size:11px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;" class="" name="government_contributions[]" type="text" value="Night Shift Differential"></td>
	              <td><input style="width:115px;" class="txtfield" name="government_contributions_account_code[]" type="text"></td>
	              <td><input style="width:115px;" class="txtfield" name="government_contributions_description[]" type="text"></td>
	            </tr>
            <?php } ?>
          </table>
        </div>
        <p>Enter the account to be used when employees have expenses for reimbursement.<br>
          If the expense type is chargeable to a client, you can enter a receivable account instead of an expense account.</p>
        <div class="tbl-wrap">
          <table class="tbl expense_reimbursement_cont">
            <tr>
              <th style="width:172px;">Expense Reimbursement</th>
              <th style="width:135px;">Account Code</th>
              <th style="width:135px;">Description</th>
              <th style="">Action</th>
            </tr>
            <?php 
            	if($expense_reim != NULL){
            		foreach($expense_reim as $row){
            ?>
	            <tr>
	              <td>&nbsp;</td>
	              <td>
	              <input class="txtfield ihide" name="expense_reim_id[]" type="hidden" value="<?php print $row->payroll_journal_entries_expense_reimbursement_id;?>">
	              <input style="width:115px;" class="txtfield" name="expense_reim_account_code[]" type="text" readonly="readonly" value="<?php print $row->account_code;?>"></td>
	              <td><input style="width:115px;" class="txtfield" name="expense_reim_description[]" type="text" readonly="readonly" value="<?php print $row->description;?>"></td>
	              <td><a href='javascript:void(0);' attr_expense_reim="<?php print $row->payroll_journal_entries_expense_reimbursement_id;?>" class='btn btn-red delRow_db expense_reim_del'>Delete</a></td>
	            </tr>
             <?php
            		}
            	}else{
            		print "<tr class='msg_empt_cont'><td colspan='4' style='text-align:left;'>".msg_empty()."</td></tr>";
            	}
            ?>
          </table>
          <br />
          <?php 
				print ($earnings != NULL) ? '<a href="javascript:void(0);" class="ihide btn add_more_btn expense_btn_add">ADD MORE</a>' : '<a href="javascript:void(0);" class="btn add_more_btn expense_btn_add">ADD MORE</a>' ;
          ?>
        </div>
        <p>Enter the account to be used for each type of other deduction to be used.<br>
          Cash advance may refer to a receivable from employee account.</p>
        <div class="tbl-wrap">
          <table class="tbl other_deductions_cont">
            <tr>
              <th style="width:172px;">Other Deductions</th>
              <th style="width:135px;">Account Code</th>
              <th style="width:135px;">Description</th>
              <th style="">Action</th>
            </tr>
            <?php 
            	if($other_deduction != NULL){
            		foreach($other_deduction as $row){
            ?>
            <tr>
              <td>
              <input class="txtfield ihide" name="other_deductions_id[]" type="hidden" value="<?php print $row->payroll_journal_entries_other_deductions_id;?>">
              <input style="width:115px;" class="txtfield" name="other_deductions[]" type="text" readonly="readonly" value="<?php print $row->other_deductions;?>"></td>
              <td><input style="width:115px;" class="txtfield" name="other_deductions_account_code[]" type="text" readonly="readonly" value="<?php print $row->account_code;?>"></td>
              <td><input style="width:115px;" class="txtfield" name="other_deductions_description[]" type="text" readonly="readonly" value="<?php print $row->description;?>"></td>
              <td><a href='javascript:void(0);' attr_other_deduction="<?php print $row->payroll_journal_entries_other_deductions_id;?>" class='btn btn-red delRow_db other_deduction_del'>Delete</a></td>
            </tr>
             <?php
            		}
            	}else{
            		print "<tr class='msg_empt_cont'><td colspan='4' style='text-align:left;'>".msg_empty()."</td></tr>";
            	}
            ?>
          </table>
          <br />
          <?php 
            	print ($earnings != NULL) ? '<a href="javascript:void(0);" class="ihide btn add_more_btn other_deductions_btn_add">ADD MORE</a>' : '<a href="javascript:void(0);" class="btn add_more_btn other_deductions_btn_add">ADD MORE</a>' ;
            ?>
        </div>
        <p>Witholding tax payable account is for the amount withheld from compensation to be<br>
          remitted to BIR Net Pay is the cash in bank account or salaries payable account for the employees take home pay.</p>
        <div class="tbl-wrap">
          <table class="tbl with_tax_cont">
            <tr>
              <th style="width:172px;">Others</th>
              <th style="width:135px;">Account Code</th>
              <th style="width:135px;">Description</th>
              <th style="">Action</th>
            </tr>
            <?php 
            	if($with_tax_others != NULL){
            		foreach($with_tax_others as $row){
            ?>
	            <tr>
	              <td>
	              <input class="txtfield ihide" name="witholding_tax_id[]" type="hidden" value="<?php print $row->payroll_journal_entries_witholding_tax_id;?>">
	              <input style="width:115px;" class="txtfield" name="witholding_tax[]" type="text" readonly="readonly" value="<?php print $row->others;?>"></td>
	              <td><input style="width:115px;" class="txtfield" name="witholding_tax_account_code[]" type="text" readonly="readonly" value="<?php print $row->account_code;?>"></td>
	              <td><input style="width:115px;" class="txtfield" name="witholding_tax_description[]" type="text" readonly="readonly" value="<?php print $row->description;?>"></td>
	              <td><a href='javascript:void(0);' attr_with_tax_others="<?php print $row->payroll_journal_entries_witholding_tax_id;?>" class='btn btn-red delRow_db with_tax_others_del'>Delete</a></td>
	            </tr>
            <?php
            		}
            	}else{
            		print "<tr class='msg_empt_cont'><td colspan='4' style='text-align:left;'>".msg_empty()."</td></tr>";
            	}
            ?>
          </table>
          <br />
          <?php 
            	print ($earnings != NULL) ? '<a href="javascript:void(0);" class="ihide btn add_more_btn with_tax_btn_add">ADD MORE</a>' : '<a href="javascript:void(0);" class="btn add_more_btn with_tax_btn_add">ADD MORE</a>' ;
            ?>
        </div>
        <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray left" href="#">BACK</a> 
        <!-- <a class="btn btn-gray right" href="#"> CONTINUE</a>  -->
        <?php 
            if($earnings == NULL){
        ?>
        	<input style="margin-right:10px;" class="btn right" name="save" type="submit" value="SAVE">
        <?php } ?>
        
        <?php 
            if($earnings != NULL){
        ?>
        	<a href="javascript:void(0);" class="btn right edit_info_btn">Edit</a>
        	<input style="margin-right:10px;" class="btn right ihide update_btn" name="update" type="submit" value="UPDATE">
        <?php } ?>
        <!-- FOOTER-GRP-BTN END -->
      </div>
<?php print form_close();?>
<div class='del_msg_expense_reim ihide' title='Confirmation'>Do you really want to delete this expense reimbursement?</div>
<div class='del_msg_other_deductions ihide' title='Confirmation'>Do you really want to delete this other deduction?</div>
<div class='del_msg_with_tax_others ihide' title='Confirmation'>Do you really want to delete this item?</div>
<script>
	function validateForm(){
		jQuery(".add_payroll_journal_entries tr input:text").each(function(){
	        var _this = jQuery(this);
	        var txtfield = _this.val();
	        if(txtfield == ""){
	            _this.addClass("emp_str");
	        }else{
	        	_this.removeClass("emp_str");
	        }
	    });
		
		if(jQuery(".add_payroll_journal_entries tr input:text").hasClass("emp_str")){
	    	return false;
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

	function addNew_expense_reimbursement(){
		<?php
			if($earnings != NULL){
		?>
			var tbl = "<tr>";
	        tbl += "<td></td>";
	        tbl += "<td><input style='width:115px;' type='text' name='new_expense_reimbursement_account_code[]' class='txtfield'></td>";
	        tbl += "<td><input style='width:115px;' type='text' name='new_expense_reimbursement_description[]' class='txtfield'></td>";
	        tbl += "<td><a href='javascript:void(0);' class='btn btn-red delRow'>Remove</a></td>";
	 		tbl += "</tr>";
		<?php 
			}else{
		?>
			var tbl = "<tr>";
	        tbl += "<td></td>";
	        tbl += "<td><input style='width:115px;' type='text' name='expense_reimbursement_account_code[]' class='txtfield'></td>";
	        tbl += "<td><input style='width:115px;' type='text' name='expense_reimbursement_description[]' class='txtfield'></td>";
	        tbl += "<td><a href='javascript:void(0);' class='btn btn-red delRow'>Remove</a></td>";
	 		tbl += "</tr>";
		<?php 
			}
		?>
	    
		   // alert(tbl);
		   jQuery(".expense_reimbursement_cont").append(tbl);
	}

	function remove_row_expense_reimbursement(){
		jQuery(".expense_reimbursement_cont tr").each(function(){
		    var _this = jQuery(this);
		    jQuery(this).find(".delRow").on("click", function(){
		        _this.remove();
		    });
		});
	}
	
	function add_expense_reim(){
		jQuery(".expense_btn_add").click(function(){
			addNew_expense_reimbursement();
		    jQuery(".msg_empt_cont").remove();
		    remove_row_expense_reimbursement();
		});
	}

	/* ======== */
	
	function addNew_other_deductions(){
		<?php
			if($earnings != NULL){
		?>
			var tbl = "<tr>";
			tbl += "<td><input style='width:115px;' type='text' name='new_other_deductions[]' class='txtfield'></td>";
	        tbl += "<td><input style='width:115px;' type='text' name='new_other_deductions_account_code[]' class='txtfield'></td>";
	        tbl += "<td><input style='width:115px;' type='text' name='new_other_deductions_description[]' class='txtfield'></td>";
	        tbl += "<td><a href='javascript:void(0);' class='btn btn-red delRow'>Remove</a></td>";
	 		tbl += "</tr>";
		<?php 
			}else{
		?>
			var tbl = "<tr>";
			tbl += "<td><input style='width:115px;' type='text' name='other_deductions[]' class='txtfield'></td>";
	        tbl += "<td><input style='width:115px;' type='text' name='other_deductions_account_code[]' class='txtfield'></td>";
	        tbl += "<td><input style='width:115px;' type='text' name='other_deductions_description[]' class='txtfield'></td>";
	        tbl += "<td><a href='javascript:void(0);' class='btn btn-red delRow'>Remove</a></td>";
	 		tbl += "</tr>";
		<?php 
			}
		?>
	    
		   // alert(tbl);
		   jQuery(".other_deductions_cont").append(tbl);
	}

	function remove_row_other_deductions(){
		jQuery(".other_deductions_cont tr").each(function(){
		    var _this = jQuery(this);
		    jQuery(this).find(".delRow").on("click", function(){
		        _this.remove();
		    });
		});
	}
	
	function add_other_deductions(){
		jQuery(".other_deductions_btn_add").click(function(){
			addNew_other_deductions();
		    jQuery(".msg_empt_cont").remove();
		    remove_row_other_deductions();
		});
	}

	/* ======== */
	
	function addNew_with_tax(){
		<?php
			if($earnings != NULL){
		?>
			var tbl = "<tr>";
			tbl += "<td><input style='width:115px;' type='text' name='new_witholding_tax[]' class='txtfield'></td>";
	        tbl += "<td><input style='width:115px;' type='text' name='new_witholding_tax_account_code[]' class='txtfield'></td>";
	        tbl += "<td><input style='width:115px;' type='text' name='new_witholding_tax_description[]' class='txtfield'></td>";
	        tbl += "<td><a href='javascript:void(0);' class='btn btn-red delRow'>Remove</a></td>";
	 		tbl += "</tr>";
		<?php 
			}else{
		?>
			var tbl = "<tr>";
			tbl += "<td><input style='width:115px;' type='text' name='witholding_tax[]' class='txtfield'></td>";
	        tbl += "<td><input style='width:115px;' type='text' name='witholding_tax_account_code[]' class='txtfield'></td>";
	        tbl += "<td><input style='width:115px;' type='text' name='witholding_tax_description[]' class='txtfield'></td>";
	        tbl += "<td><a href='javascript:void(0);' class='btn btn-red delRow'>Remove</a></td>";
	 		tbl += "</tr>";
		<?php 
			}
		?>
	    
		   // alert(tbl);
		   jQuery(".with_tax_cont").append(tbl);
	}

	function remove_row_with_tax(){
		jQuery(".with_tax_cont tr").each(function(){
		    var _this = jQuery(this);
		    jQuery(this).find(".delRow").on("click", function(){
		        _this.remove();
		    });
		});
	}
	
	function add_with_tax(){
		jQuery(".with_tax_btn_add").click(function(){
			addNew_with_tax();
		    jQuery(".msg_empt_cont").remove();
		    remove_row_with_tax();
		});
	}


	/* ========= */
	
	function edit_information(){
		jQuery(".edit_info_btn").click(function(){
		    jQuery(".add_payroll_journal_entries table tr").each(function(){
		        jQuery(this).find("input:text").removeAttr("readonly");
		    });
		    jQuery(this).remove();
		    jQuery(".update_btn").fadeIn("100");
		    jQuery(".add_more_btn").css("display","inline-block");
		    jQuery('body,html').animate({scrollTop:0},800);
		    
		    // add readonly for earnings
		    jQuery("input[name='earnings[]']").each(function(){
		        jQuery(this).attr("readonly","readonly");
		    });
		    
		    // add readonly for Government Contributions
		    jQuery("input[name='government_contributions[]']").each(function(){
		        jQuery(this).attr("readonly","readonly");
		    });
		});
	}

	function delete_expense_reim(){
		jQuery(".expense_reim_del").click(function(){
		    var _this = jQuery(this);
		    var expense_reim_id = _this.attr("attr_expense_reim");
		    jQuery(".del_msg_expense_reim").dialog({
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
		    		            'delete_expense_reim': '1',
		    		            'expense_reim_id':expense_reim_id
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

	function delete_other_deduction(){
		jQuery(".other_deduction_del").click(function(){
		    var _this = jQuery(this);
		    var other_deduction_id = _this.attr("attr_other_deduction");
		    jQuery(".del_msg_other_deductions").dialog({
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
		    		            'delete_other_deduction': '1',
		    		            'other_deduction_id':other_deduction_id
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

	function delete_witholding_tax(){
		jQuery(".with_tax_others_del").click(function(){
		    var _this = jQuery(this);
		    var with_tax_others_id = _this.attr("attr_with_tax_others");
		    jQuery(".del_msg_with_tax_others").dialog({
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
		    		            'delete_with_tax_others': '1',
		    		            'with_tax_others_id':with_tax_others_id
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
	
	jQuery(function(){
		_successContBox();
		add_expense_reim();
		add_other_deductions();
		add_with_tax();
		edit_information();
		delete_expense_reim();
		delete_other_deduction();
		delete_witholding_tax();
	});
</script>