<p>
	<input type="text" class="shift_search_empno txtfield" placeholder="Employee Number" />
	<input type="text" class="shift_search_empname txtfield" placeholder="Employee Name" />
</p>
<div class="error_msg_cont"></div>
<?php print form_open('','onsubmit="return validateForm()"');?>
<div class="tbl-wrap">	
		  <?php print $this->session->flashdata('message');?>
          <!-- TBL-WRAP START -->
          <table style="width:1170px;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:50px;"></th>
              <th style="width:170px;">Employee Name</th>
              <th style="width:170px;">Employee Number</th>
              <th style="width:170px;">Valid From</th>
              <th style="width:170px;">Until</th>
              <th style="width:170px;">Payroll Group</th>
              <th style="width:170px">Action</th>
            </tr>
            <?php 
            	if($employee != NULL){
            		$counter = 1;
            		foreach($employee as $row){
            ?>
	            <tr class="shift_row_list">
	              <td><?php print $counter++;?></td>
	              <td><?php print ucwords($row->first_name)." ".ucwords($row->last_name);?></td>
	              <td><?php print $row->payroll_cloud_id;?></td>
	              <td><?php print $row->valid_from;?></td>
	              <td><?php print $row->until;?></td>
	              <td><?php print $row->name;?></td>	              
	              <td><a href="javascript:void(0);" class="btn btn-gray btn-action editBtnDb" shifts_schedule_id="<?php print $row->shifts_schedule_id;?>">EDIT</a> <a href="javascript:void(0);" class="btn btn-red btn-action delBtnDb" shifts_schedule_id="<?php print $row->shifts_schedule_id;?>">DELETE</a></td>
	            </tr>
            <?php 			
            		}
            	}else{
            		print "<tr class='msg_empt_cont'><td colspan='13' style='text-align:left;'>".msg_empty()."</td></tr>";
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
              <td style="width: 105px;">Employee Name:</td>
              <td>
              <input readonly='readonly' type='text' name='shifts_schedule_id' class='shifts_schedule_id ihide txtfield emp_id"+size+"' />
              <input type='text' readonly="readonly" name='emp_name' class='txtfield emp_name emp_name"+size+"' class_val='class_val"+size+"' attr_uname_val='"+size+"'></td></tr>
	        <tr>
              <td>Valid From:</td><td><input type='text' name='valid_from' class='valid_from txtfield datepickerCont'></td></tr>
	        <tr>
              <td>Until:</td><td><input type='text' name='until' class='txtfield until datepickerCont' id='dob"+size+"'></td></tr>
	        <tr>
	          <td>Payroll Group:</td>
              <td>
              	<select style='min-width: 148px;' class='txtselect select-medium payroll_group_edit' name='payroll_group_edit'><?php if($payroll_group == NULL){print "<option value=''>".msg_empty()."</option>";}else{foreach($payroll_group as $row_pg){?> <option value='<?php print $row_pg->payroll_group_id;?><?php echo set_select('payroll_group[]', $row_pg->name); ?>'><?php print $row_pg->name;?></option><?php } }?></select>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>
	              <input type="submit" value="Update" name="update_info" class="btn updateBtn" />
              </td>
            </tr>
          </tbody></table>
          <!-- TBL-WRAP END -->
        </div>
        	<?php print form_close();?>
        </div>
        <script type="text/javascript"  src="/assets/theme_2013/js/external_js.js"></script>
        <script>
        	function addNewEmp(size){
            	var tbl = "<tr class='shift_row_list'>";
		        tbl += "<td><input readonly='readonly' type='text' name='emp_id[]' class='ihide txtfield emp_id"+size+"' /></td>";
			    tbl += "<td><input type='text' name='emp_name[]' class='txtfield emp_name emp_name"+size+"' class_val='class_val"+size+"' attr_uname_val='"+size+"'></td>";
			    tbl += "<td><input type='text' name='emp_no[]' readonly='readonly' class='txtfield emp_no"+size+"' class_val='class_val"+size+"'></td>";
		        tbl += "<td><input type='text' name='valid_from[]' class='valid_from txtfield datepickerCont'></td>";
		        tbl += "<td><input type='text' name='until[]' class='txtfield until datepickerCont' id='dob"+size+"'></td>";
		        tbl += "<td><select style='min-width: 130px;' class='txtselect select-medium' name='payroll_group[]'><?php if($payroll_group == NULL){print "<option value=''>".msg_empty()."</option>";}else{foreach($payroll_group as $row_pg){?> <option value='<?php print $row_pg->payroll_group_id;?><?php echo set_select('payroll_group[]', $row_pg->name); ?>'><?php print $row_pg->name;?></option><?php } }?></select></td>";
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
					var size = jQuery(".dob").length + 1;
					addNewEmp(size);
					dob_datepicker();
					_name_listing();
					change_employee();
					check_uname();
					remove_row();
					_datepicker();

					// remove msg_empty
					_remove_msg_emp();

					// remove no result item
					_remove_no_result();
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
            
			function validateForm(){
				jQuery(".emp_conList tr input:text").each(function(){
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
				var why_emp_name = "";
				var why_emp_no = "";
				var why_valid_from = "";
				var why_until = "";
				var why_payroll_group = "";
				
				for(var a=0;a<=100;a++){ // a = dummy
			    	var emp_name = jQuery("input[name='emp_name[]']").eq(a).val();
					var emp_no = jQuery("input[name='emp_no[]']").eq(a).val();
					var valid_from = jQuery("input[name='valid_from[]']").eq(a).val();
					var until = jQuery("input[name='until[]']").eq(a).val();
					var payroll_group = jQuery("select[name='payroll_group[]']").eq(a).val();

					if(emp_name == "") why_emp_name = 1;
					if(emp_no == "") why_emp_no = 1;
					if(valid_from == "") why_valid_from = 1;
					if(until == "") why_until = 1;
					if(payroll_group == ""){
						why_payroll_group = 1;
						jQuery("select[name='payroll_group[]']").eq(a).addClass("emp_str");
					}else{
						jQuery("select[name='payroll_group[]']").eq(a).removeClass("emp_str");
					}
				}

				if(why_emp_name != "") why += "<p>- Please enter Employee Name</p>";
				if(why_emp_no != "") why += "<p>- Please enter Employee Number</p>";
				if(why_valid_from != "") why += "<p>- Please enter Valid From</p>";
				if(why_until != "") why += "<p>- Please enter Until</p>";
				if(why_payroll_group != "") why += "<p>- Please select Payroll Group</p>";

				if(why != ""){
					jQuery(".error_msg_cont").html(why);
					return false;
				}else{
					jQuery(".error_msg_cont").html("");
				}
				
				duplicate_str();
				
				if(jQuery(".emp_conList tr input:text").hasClass("emp_str")){
        	    	return false;
        	    }
			}

			function duplicate_str(){
				jQuery(".unameField").each(function(){
					if(jQuery(this).hasClass("dup_str")){
							jQuery(this).addClass("emp_str");
						}
				});
			}
			
			function dob_datepicker(){
				jQuery(".dob").datepicker({
					changeMonth: true,
					changeYear: true,
					dateFormat: 'yy-mm-dd',
					maxDate: 0,
					yearRange: "-100:+0"
				});
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

			function check_uname(){
				jQuery(".unameField").bind("keyup",function(){
					var _this = jQuery(this);
				    var uname_val = _this.val();
				    var attr_uname_val = _this.attr("attr_uname_val");
				    var class_val = _this.attr("class_val");
				    var urls = window.location.href;
				    if(jQuery.trim(uname_val) != ""){
					    
					    // validate username from controller
				    	$.ajax({
							url: urls,
							type: "POST",
							data: {
								'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
								'check_uname': '1',
								'uname_val[]': uname_val
							},
							success: function(data){
								var status = jQuery.parseJSON(data);
	                            	if(status.success == 1){
										alert("<p>- The Employee Number field must contain a unique value.</p>");
										_this.addClass("emp_str");
										_this.addClass("dup_str");
										return false;
		                            }else{
		                            	_this.removeClass("emp_str");
		                            	_this.removeClass("dup_str");
	                                }

	                            	//check_val(uname_val);
							}
					    });
					}
				});
			}

			function check_val(val) { 
				
			    var isValid = true;
			    var emp_val_list = jQuery.trim(jQuery(".unameContBoxTrick").text());
			    var emp_val_split = emp_val_list.split(",");
			    var emp_val_length = emp_val_split.length;
				
				for(var n=0;n<emp_val_length;n++){
			    	if(emp_val_split[n] == val && emp_val_length != "") isValid = false;
			    	alert(emp_val_split[n]+" "+val);
			    }
			    
				if(isValid){
					jQuery(".unameContBoxTrick").text("");
					jQuery("input.unameField").livequery(function(){
					     jQuery(this).each(function(i, ele){
						     if(jQuery(this).val() != ""){
					            var _this_val = jQuery(this).val();
					               jQuery(".unameContBoxTrick").text(function(i, v) {
						        	var arr = v.split(',');
						        	arr.push(_this_val);
						        	return arr.join(',');
						        });
						     }
					      })
					 });
				}else{
					alert("<p>- The Employee Number field must contain a unique value.</p>");
					return false;
				}
			}

			function remove_row(){
				jQuery(".emp_conList tr").each(function(){
				    var _this = jQuery(this);
				    jQuery(this).find(".delRow").on("click", function(){
				        _this.remove();
				        var input_text_size = jQuery("input[name='emp_name[]']").length;
						if(parseInt(input_text_size) == 0){
							jQuery(".saveBtn").css("display","none");
							jQuery(".error_msg_cont").html("");
						}
				    });
				});
			}

			function _delete_emp_fromDB(){
				jQuery(".delBtnDb").on("click", function(){
				    var _this = jQuery(this);
				    var shifts_schedule_id = _this.attr("shifts_schedule_id");
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
							          del_empDB: "1",
						              ajax:"1",
						              shifts_schedule_id:shifts_schedule_id,
				                      'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>")
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

			function _get_information(){
	        	jQuery(".editBtnDb").on("click", function(){
	        	    var _this = jQuery(this);
	        	    var shifts_schedule_id = _this.attr("shifts_schedule_id");
	        	    $.ajax({
						url: window.location.href,
						type: "POST",
						data: {
							'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
							'get_information': '1',
							'shifts_schedule_id': shifts_schedule_id
						},
						success: function(data){
							var status = jQuery.parseJSON(data);
                          	if(status.success == 1){

                              	jQuery(".emp_name").val(status.emp_name);
                              	jQuery(".shifts_schedule_id").empty().val(status.shifts_schedule_id);
                              	jQuery(".valid_from").empty().val(status.valid_from);
                              	jQuery(".until").empty().val(status.until);
								jQuery(".payroll_group_edit option").each(function(){
									var _this = jQuery(this);
									if(_this.val() == status.payroll_group_id){
										_this.prop("selected",true);
									}else{
										_this.removeAttr("selected");
									}
								});
                              	
                          		jQuery(".editCont").dialog({
                					width: 'inherit',
                					draggable: false,
                					modal: true,
                					minWidth:'400',
                					dialogClass:'transparent'
                              	});

                          		jQuery(".editCont input").removeClass("emp_str");
                          	}else{
								alert("- Invalid parameter.");
								return false;
    						}
						}
	        	    });
	        	});
	        }

			function validate_edit_form(){
				var shifts_schedule_id = jQuery(".shifts_schedule_id").val();
				var valid_from = jQuery(".valid_from").val();
				var until = jQuery(".until").val();
				var payroll_group_edit = jQuery(".payroll_group_edit").val();
				var error = "";
				
				error = check_emp_str("shifts_schedule_id");
				error += check_emp_str("valid_from");
				error += check_emp_str("until");
				error += check_emp_str("payroll_group_edit");

				if(jQuery.trim(error) != ""){
					return false;
				}
	        }

	        function _name_listing(){
	    		var emp_list_val = "<?php print substr($employee_shift, 0, -1);?>";
	    		if(jQuery.trim(emp_list_val) == ""){
	    			var availableTags = ["No results found"];
	    		}else{
	    			var availableTags = [<?php print substr($employee_shift, 0, -1);?>];
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
	        
	        function check_emp_str(class_val){
		        var new_val = jQuery("."+class_val).val();
	        	if(jQuery.trim(new_val) == ""){
              		jQuery("."+class_val).addClass("emp_str");
              		return "1";
                }else{
                	jQuery("."+class_val).removeClass("emp_str");
                	return "";
                }
	        }

	        function pagination(){
	    		jQuery("#pagination li").each(function(){
	    		    jQuery(this).find("a").addClass("btn");;
	    		});
	    	}

	        function _datepicker(){
	    		jQuery(".datepickerCont").datepicker({
	    			changeMonth: true,
	    			changeYear: true,
	    			dateFormat: 'yy-mm-dd'
	    		});
	    	}

			function shift_search_empname(){
				jQuery(".shift_search_empname").on("keyup", function(){
					var _this = jQuery(this);
					var emp_name = _this.val();
					$.ajax({
						url: window.location.href,
						type: "POST",
						data: {
							'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
							'search_emp_name': '1',
							'emp_name': emp_name
						},
						success: function(data){
							jQuery(".shift_row_list").hide().remove();
							jQuery(".emp_conList tbody").append(data);

							// call delete function
							_delete_emp_fromDB();

							// call edit function
							_get_information();

							// remove msg_empty
							_remove_msg_emp();

							// hide save btn
							_hide_save_btn();
						}
	        	    });
				});
			}

			function shift_search_empno(){
				jQuery(".shift_search_empno").on("keyup", function(){
					var _this = jQuery(this);
					var emp_no = _this.val();
					$.ajax({
						url: window.location.href,
						type: "POST",
						data: {
							'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
							'search_emp_no': '1',
							'emp_no': emp_no
						},
						success: function(data){
							jQuery(".shift_row_list").hide().remove();
							jQuery(".emp_conList tbody").append(data);

							// call delete function
							_delete_emp_fromDB();

							// call edit function
							_get_information();

							// remove msg_empty
							_remove_msg_emp();

							// hide save btn
							_hide_save_btn();
						}
	        	    });
				});
			}

	        function _remove_msg_emp(){
	        	jQuery(".msg_empt_cont").remove();
	        }

	        function _remove_no_result(){
	        	jQuery(".no_result_cont").remove();
	        }

	        function _hide_save_btn(){
				jQuery(".saveBtn").hide();
		    }
	        
			jQuery(function(){
				_addRowBtn();
				_successContBox();
				_delete_emp_fromDB();
				_get_information();
				pagination();
				_datepicker();
				shift_search_empname();
				shift_search_empno();
				shift_li();
			});
        </script>
<div class="footer-grp-btn">
 <!-- FOOTER-GRP-BTN START -->
 <a class="btn btn-gray left" href="javascript:history.go(-1);">BACK</a> 
 <!-- FOOTER-GRP-BTN END -->
 </div>