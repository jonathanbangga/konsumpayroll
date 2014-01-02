<?php print form_open('','onsubmit="return validate_form()" enctype="multipart/form-data"');?>
<div class="tbl-wrap">	
		  <?php print $this->session->flashdata('message');?>
          <!-- TBL-WRAP START -->
          <table style="width:2160px;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:50px;"></th>
              <th style="width:170px;">Employee Name</th>
              <th style="width:170px;">Employee Number</th>
              <th style="width:170px;">Minimum Wage Earner?</th>
              <th style="width:170px;">Minimum Wage Amt</th>
              <th style="width:170px;">Entitled to Basic Pay</th>
              <th style="width:170px">Pay Rate Type</th>
              <th style="width:170px">Timesheet Required</th>
              <th style="width:170px">Entitled to Overtime</th>
              <th style="width:170px">Entitled to NSD</th>
              <th style="width:170px">Night Shift Differential Rate</th>
              <th style="width:170px">Entitled to Commission</th>
              <th style="width:170px">Entitled to Holiday/Premium</th>
              <th style="width:170px">Action</th>
            </tr>
            <?php 
            	if($emp_earnings != NULL){
            		$counter = 1;
            		foreach($emp_earnings as $row){
            ?>
	            <tr>
	              <td><?php print $counter++;?></td>
	              <td><?php print ucwords($row->first_name)." ".ucwords($row->last_name);?></td>
	              <td><?php print $row->payroll_cloud_id;?></td>
	              <td><?php print $row->minimum_wage_earner;?></td>
	              <td><?php print $row->statutory_min_wage;?></td>
	              <td><?php print $row->entitled_to_basic_pay;?></td>
	              <td><?php print $row->pay_rate_type;?></td>
	              <td><?php print $row->timesheet_required;?></td>
	              <td><?php print $row->entitled_to_overtime;?></td>
	              <td><?php print $row->entitled_to_night_differential_pay;?></td>
	              <td><?php print $row->night_diff_rate;?></td>
	              <td><?php print $row->entitled_to_commission;?></td>
	              <td><?php print $row->entitled_to_holiday_or_premium_pay;?></td>
	              <td><a href="javascript:void(0);" class="btn btn-gray btn-action editBtnDb" attr_empid="<?php print $row->emp_id;?>">EDIT</a> <a href="javascript:void(0);" class="btn btn-red btn-action delBtnDb" attr_empid="<?php print $row->emp_id;?>">DELETE</a></td>
	            </tr>
            <?php
            		}
            	}else{
            		print "<tr class='msg_empt_cont'><td colspan='14' style='text-align:left;'>".msg_empty()."</td></tr>";
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
              <td style="width:155px">Employee Name</td>
              <td>
              <input type="text" value="" name="emp_nameEdit" class="txtfield emp_nameEdit" readonly="readonly" />
              <input type="text" value="" name="emp_idEdit" class="txtfield emp_idEdit ihide" />
            </tr>
		    <tr>
			    <td style="width:155px">Minimum Wage Earner</td>
			    <td><select class='txtselect select-medium min_wage_earner_edit' name='min_wage_earner'><option value='Yes<?php echo set_select('min_wage_earner', 'Yes'); ?>'>Yes</option><option value='No<?php echo set_select('min_wage_earner', 'No'); ?>'>No</option></select></td></tr>
		    <tr>
		    	<td style="width:155px">Minimum Wage Amt</td>
		    <td><input type='text' name='amount' class='valid_to txtfield'></td></tr>
		    <tr>
		    	<td style="width:155px">Entitled to Basic Pay</td>
		    <td><select class='txtselect select-medium entitled_to_basic_pay_edit' name='entitled_to_basic_pay'><option value='Yes<?php echo set_select('entitled_to_basic_pay', 'Yes'); ?>'>Yes</option><option value='No<?php echo set_select('entitled_to_basic_pay', 'No'); ?>'>No</option></select></td></tr>
		    <tr>
		    	<td style="width:155px">Pay Rate Type</td>
		    <td><select class='txtselect select-medium pay_rate_type_edit' name='pay_rate_type'><option value='Month<?php echo set_select('pay_rate_type', 'Month'); ?>'>Month</option><option value='Half Month<?php echo set_select('pay_rate_type', 'Half Month'); ?>'>Half Month</option></select></td></tr>
		    <tr>
		    	<td style="width:155px">Timesheet Required 	</td>
		    <td><select class='txtselect select-medium time_sheet_required_edit' name='time_sheet_required'><option value='Yes<?php echo set_select('time_sheet_required', 'Yes'); ?>'>Yes</option><option value='No<?php echo set_select('time_sheet_required', 'No'); ?>'>No</option></select></td></tr>
		    <tr>
		    	<td style="width:155px">Entitled to Overtime 	</td>
		    <td><select class='txtselect select-medium entitled_to_ot_edit' name='entitled_to_ot'><option value='Yes<?php echo set_select('entitled_to_ot', 'Yes'); ?>'>Yes</option><option value='No<?php echo set_select('entitled_to_ot', 'No'); ?>'>No</option></select></td></tr>
		    <tr>
		    	<td style="width:155px">Entitled to NSD</td>
		    <td><select class='txtselect select-medium entitled_to_nsd_edit' name='entitled_to_nsd'><option value='Yes<?php echo set_select('entitled_to_nsd', 'Yes'); ?>'>Yes</option><option value='No<?php echo set_select('entitled_to_nsd', 'No'); ?>'>No</option></select></td></tr>
		    <tr>
		    	<td style="width:155px">NSD Rate</td>
		    <td><input type='text' name='night_shift_diff_rate' class='valid_to txtfield night_shift_diff_rate_edit'></td></tr>
		    <tr>
		    	<td style="width:155px">Entitled to Commission</td>
		    <td><select class='txtselect select-medium entitled_commission_edit' name='entitled_commission'><option value='Yes<?php echo set_select('entitled_commission', 'Yes'); ?>'>Yes</option><option value='No<?php echo set_select('entitled_commission', 'No'); ?>'>No</option></select></td></tr>
		    <tr>
		    	<td style="width:155px">Entitled to Holiday/Premium</td>
		    <td><select class='txtselect select-medium entitled_holi_pre_edit' name='entitled_holi_pre'><option value='Yes<?php echo set_select('entitled_holi_pre', 'Yes'); ?>'>Yes</option><option value='No<?php echo set_select('entitled_holi_pre', 'No'); ?>'>No</option></select></td></tr>
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
	    tbl += "<td><select class='txtselect select-medium' name='min_wage_earner[]'><option value='Yes<?php echo set_select('min_wage_earner[]', 'Yes'); ?>'>Yes</option><option value='No<?php echo set_select('min_wage_earner[]', 'No'); ?>'>No</option></select></td>";
	    tbl += "<td><input type='text' name='amount[]' class='valid_to txtfield'></td>";
	    tbl += "<td><select class='txtselect select-medium' name='entitled_to_basic_pay[]'><option value='Yes<?php echo set_select('entitled_to_basic_pay[]', 'Yes'); ?>'>Yes</option><option value='No<?php echo set_select('entitled_to_basic_pay[]', 'No'); ?>'>No</option></select></td>";
	    tbl += "<td><select class='txtselect select-medium' name='pay_rate_type[]'><option value='Month<?php echo set_select('pay_rate_type[]', 'Month'); ?>'>Month</option><option value='Half Month<?php echo set_select('pay_rate_type[]', 'Half Month'); ?>'>Half Month</option></select></td>";
	    tbl += "<td><select class='txtselect select-medium' name='time_sheet_required[]'><option value='Yes<?php echo set_select('time_sheet_required[]', 'Yes'); ?>'>Yes</option><option value='No<?php echo set_select('time_sheet_required[]', 'No'); ?>'>No</option></select></td>";
	    tbl += "<td><select class='txtselect select-medium' name='entitled_to_ot[]'><option value='Yes<?php echo set_select('entitled_to_ot[]', 'Yes'); ?>'>Yes</option><option value='No<?php echo set_select('entitled_to_ot[]', 'No'); ?>'>No</option></select></td>";
	    tbl += "<td><select class='txtselect select-medium' attr_size_val="+size+" name='entitled_to_nsd[]'><option value='Yes<?php echo set_select('entitled_to_nsd[]', 'Yes'); ?>'>Yes</option><option value='No<?php echo set_select('entitled_to_nsd[]', 'No'); ?>'>No</option></select></td>";
	    tbl += "<td><input type='text' name='night_shift_diff_rate[]' class='valid_to txtfield nsd_rate_val"+size+"'></td>";
	    tbl += "<td><select class='txtselect select-medium' name='entitled_commission[]'><option value='Yes<?php echo set_select('entitled_commission[]', 'Yes'); ?>'>Yes</option><option value='No<?php echo set_select('entitled_commission[]', 'No'); ?>'>No</option></select></td>";
	    tbl += "<td><select class='txtselect select-medium' name='entitled_holi_pre[]'><option value='Yes<?php echo set_select('entitled_holi_pre[]', 'Yes'); ?>'>Yes</option><option value='No<?php echo set_select('entitled_holi_pre[]', 'No'); ?>'>No</option></select></td>";
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

	    for(var a=0;a<=100;a++){ // a = dummy
	    	var entitle_nsd = jQuery("select[name='entitled_to_nsd[]']").eq(a).val();
	    	var entitle_nsd_size = jQuery("select[name='entitled_to_nsd[]']").eq(a).attr("attr_size_val");
	    	if(entitle_nsd == "Yes"){
				if(jQuery("input[name='night_shift_diff_rate[]']").eq(a).val() == ""){
					jQuery("input[name='night_shift_diff_rate[]']").eq(a).addClass("emp_str");
				}else{
					jQuery("input[name='night_shift_diff_rate[]']").eq(a).removeClass("emp_str");
				}
	    	}else{
	    		jQuery("input[name='night_shift_diff_rate[]']").eq(a).removeClass("emp_str");
	    	}

	    	var min_wage_earner = jQuery("select[name='min_wage_earner[]']").eq(a).val();
	    	var entitled_to_basic_pay = jQuery("select[name='entitled_to_basic_pay[]']").eq(a).val();
	    	var pay_rate_type = jQuery("select[name='pay_rate_type[]']").eq(a).val();
	    	var time_sheet_required = jQuery("select[name='time_sheet_required[]']").eq(a).val();
	    	var entitled_to_ot = jQuery("select[name='entitled_to_ot[]']").eq(a).val();
	    	var entitled_to_nsd = jQuery("select[name='entitled_to_nsd[]']").eq(a).val();
	    	var entitled_commission = jQuery("select[name='entitled_commission[]']").eq(a).val();
	    	var entitled_holi_pre = jQuery("select[name='entitled_holi_pre[]']").eq(a).val();

	    	if(min_wage_earner == ""){
	    		jQuery("select[name='min_wage_earner[]']").eq(a).addClass("emp_str");
	    	}else{
	    		jQuery("select[name='min_wage_earner[]']").eq(a).removeClass("emp_str");
	    	}

	    	if(entitled_to_basic_pay == ""){
	    		jQuery("select[name='entitled_to_basic_pay[]']").eq(a).addClass("emp_str");
	    	}else{
	    		jQuery("select[name='entitled_to_basic_pay[]']").eq(a).removeClass("emp_str");
	    	}

	    	if(pay_rate_type == ""){
	    		jQuery("select[name='pay_rate_type[]']").eq(a).addClass("emp_str");
	    	}else{
	    		jQuery("select[name='pay_rate_type[]']").eq(a).removeClass("emp_str");
	    	}

	    	if(time_sheet_required == ""){
	    		jQuery("select[name='time_sheet_required[]']").eq(a).addClass("emp_str");
	    	}else{
	    		jQuery("select[name='time_sheet_required[]']").eq(a).removeClass("emp_str");
	    	}

	    	if(entitled_to_ot == ""){
	    		jQuery("select[name='entitled_to_ot[]']").eq(a).addClass("emp_str");
	    	}else{
	    		jQuery("select[name='entitled_to_ot[]']").eq(a).removeClass("emp_str");
	    	}

	    	if(entitled_to_nsd == ""){
	    		jQuery("select[name='entitled_to_nsd[]']").eq(a).addClass("emp_str");
	    	}else{
	    		jQuery("select[name='entitled_to_nsd[]']").eq(a).removeClass("emp_str");
	    	}

	    	if(entitled_commission == ""){
	    		jQuery("select[name='entitled_commission[]']").eq(a).addClass("emp_str");
	    	}else{
	    		jQuery("select[name='entitled_commission[]']").eq(a).removeClass("emp_str");
	    	}

	    	if(entitled_holi_pre == ""){
	    		jQuery("select[name='entitled_holi_pre[]']").eq(a).addClass("emp_str");
	    	}else{
	    		jQuery("select[name='entitled_holi_pre[]']").eq(a).removeClass("emp_str");
	    	}
	    }
	    
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
							jQuery("input[name='amount']").val(status.statutory_min_wage);
							jQuery(".min_wage_earner_edit option").each(function(){
								var _this = jQuery(this);
								if(_this.val() == status.minimum_wage_earner){
									_this.prop("selected",true);
								}
							});

							jQuery(".entitled_to_basic_pay_edit option").each(function(){
								var _this = jQuery(this);
								if(_this.val() == status.entitled_to_basic_pay){
									_this.prop("selected",true);
								}
							});

							jQuery(".pay_rate_type_edit option").each(function(){
								var _this = jQuery(this);
								if(_this.val() == status.pay_rate_type){
									_this.prop("selected",true);
								}
							});

							jQuery(".time_sheet_required_edit option").each(function(){
								var _this = jQuery(this);
								if(_this.val() == status.timesheet_required){
									_this.prop("selected",true);
								}
							});

							jQuery(".entitled_to_ot_edit option").each(function(){
								var _this = jQuery(this);
								if(_this.val() == status.entitled_to_overtime){
									_this.prop("selected",true);
								}
							});

							jQuery(".entitled_to_nsd_edit option").each(function(){
								var _this = jQuery(this);
								if(_this.val() == status.entitled_to_night_differential_pay){
									_this.prop("selected",true);
								}
							});

							jQuery("input[name='night_shift_diff_rate']").val(status.night_diff_rate);

							jQuery(".entitled_commission_edit option").each(function(){
								var _this = jQuery(this);
								if(_this.val() == status.entitled_to_commission){
									_this.prop("selected",true);
								}
							});

							jQuery(".entitled_holi_pre_edit option").each(function(){
								var _this = jQuery(this);
								if(_this.val() == status.entitled_to_holiday_or_premium_pay){
									_this.prop("selected",true);
								}
							});
							
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
	    var amount = jQuery.trim(jQuery("input[name='amount']").val());
	    var night_shift_diff_rate_edit = jQuery.trim(jQuery(".night_shift_diff_rate_edit").val());
	    var error = "";
	    if(amount==""){
	        error = 1;
	        jQuery("input[name='amount']").addClass('emp_str');
	    }else{
	    	jQuery("input[name='amount']").removeClass('emp_str');
	    }

	    if(night_shift_diff_rate_edit==""){
	        error = 1;
	        jQuery(".night_shift_diff_rate_edit").addClass('emp_str');
	    }else{
	    	jQuery(".night_shift_diff_rate_edit").removeClass('emp_str');
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