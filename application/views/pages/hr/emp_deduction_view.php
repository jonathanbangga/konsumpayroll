<?php print form_open('','onsubmit="return validate_form()" enctype="multipart/form-data"');?>
<div class="tbl-wrap">	
		  <?php print $this->session->flashdata('message');?>
          <!-- TBL-WRAP START -->
          <table style="width:1410px;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:50px;"></th>
              <th style="width:170px;">Employee Name</th>
              <th style="width:170px;">Employee Number</th>
              <th style="width:170px;">Deduction Type</th>
              <th style="width:170px;">Amount</th>
              <th style="width:170px;">Valid From</th>
              <th style="width:170px;">Valid To</th>
              <th style="width:170px;">Recurring</th>
              <th style="width:170px">Action</th>
            </tr>
            <?php 
            	if($emp_deduction != NULL){
            		$counter = 1;
            		foreach($emp_deduction as $row){
            ?>
	            <tr>
	              <td><?php print $counter++;?></td>
	              <td><?php print ucwords($row->first_name)." ".ucwords($row->last_name);?></td>
	              <td><?php print $row->payroll_cloud_id;?></td>
	              <td><?php print $row->deduction_name;?></td>
	              <td><?php print $row->amount;?></td>
	              <td><?php print $row->valid_from;?></td>
	              <td><?php print $row->valid_until;?></td>
	              <td><?php print $row->recurring;?></td>
	              <td><a href="javascript:void(0);" class="btn btn-gray btn-action editBtnDb" attr_empid="<?php print $row->emp_id;?>">EDIT</a> <a href="javascript:void(0);" class="btn btn-red btn-action delBtnDb" attr_empid="<?php print $row->emp_id;?>">DELETE</a></td>
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
            </tr>
            <tr>
              <td style="width:155px">Deduction Type:</td>
              <td>
              <input type="text" value="" name="emp_idEdit" class="txtfield emp_idEdit ihide" />
              <select style='min-width: 130px;' class='txtselect select-medium deductionType_edit' name='deduction_type'>
              	<?php 
              		foreach($emp_deduction_type as $row_dtype){?> 
              		<option value='<?php print $row_dtype->deduction_id;?><?php echo set_select('deduction_type', $row_dtype->deduction_name); ?>'><?php print $row_dtype->deduction_name;?></option>
				<?php } ?>
              </select>
              </td>
            </tr>
            <tr>
              <td>Amount: </td>
              <td><input type="text" value="" name="amount_edit" class="txtfield amount_edit" /></td>
            </tr>
            <tr>
              <td>Valid From: </td>
              <td><input type="text" value="" name="valid_from" class="txtfield valid_from datepickerCont" /></td>
            </tr>
            <tr>
              <td>Valid To: </td>
              <td><input type="text" value="" name="valid_to" class="txtfield valid_to datepickerCont" /></td>
            </tr>
            <tr>
              <td>Recurring: </td>
              <td>
              	<select class='txtselect select-medium recurring_edit' name='recurring'><option value='Yes<?php echo set_select('recurring', 'Yes'); ?>'>Yes</option><option value='No<?php echo set_select('recurring', 'No'); ?>'>No</option></select>
              </td>
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
<script>
	function addRow(size){
		var tbl = "<tr>";
	    tbl += "<td><input readonly='readonly' type='text' name='emp_id[]' class='ihide txtfield emp_id"+size+"' /></td>";
	    tbl += "<td><input type='text' name='emp_name[]' class='txtfield emp_name emp_name"+size+"' class_val='class_val"+size+"' attr_uname_val='"+size+"'></td>";
	    tbl += "<td><input type='text' name='emp_no[]' readonly='readonly' class='txtfield emp_no"+size+"' class_val='class_val"+size+"'></td>";
	    tbl += "<td><select style='min-width: 130px;' class='txtselect select-medium' name='deduction_type[]'><?php foreach($emp_deduction_type as $row_deductiontype){?> <option value='<?php print $row_deductiontype->deduction_id;?><?php echo set_select('deduction_type[]', $row_deductiontype->deduction_name); ?>'><?php print $row_deductiontype->deduction_name;?></option><?php } ?></select></td>";
	    tbl += "<td><input type='text' name='amount[]' class='amount txtfield'></td>";
	    tbl += "<td><input type='text' name='valid_from[]' class='valid_from txtfield datepickerCont'></td>";
	    tbl += "<td><input type='text' name='valid_to[]' class='valid_to txtfield datepickerCont'></td>";
	    tbl += "<td><select class='txtselect select-medium' name='recurring[]'><option value='Yes<?php echo set_select('recurring[]', 'Yes'); ?>'>Yes</option><option value='No<?php echo set_select('recurring[]', 'No'); ?>'>No</option></select></td>";
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
							jQuery(".amount_edit").val(status.amount);
							jQuery(".valid_from").val(status.valid_from);
							jQuery(".valid_to").val(status.valid_until);
							jQuery(".deductionType_edit option").each(function(){
								var _this = jQuery(this);
								if(_this.val() == status.deduction_type_id){
									_this.prop("selected",true);
								}
							});
							jQuery(".recurring_edit option").each(function(){
								var _this = jQuery(this);
								if(_this.val() == status.recurring){
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
	    var amount_edit = jQuery.trim(jQuery(".amount_edit").val());
	    var valid_from = jQuery.trim(jQuery(".valid_from").val());
	    var valid_to = jQuery.trim(jQuery(".valid_to").val());
	    var error = "";
	    if(amount_edit==""){
	        error = 1;
	        jQuery(".amount_edit").addClass('emp_str');
	    }else{
	        jQuery(".amount_edit").removeClass('emp_str');
	    }
	    
	    if(valid_from==""){
	        error = 1;
	        jQuery(".valid_from").addClass('emp_str');
	    }else{
	        jQuery(".valid_from").removeClass('emp_str');
	    }

	    if(valid_to==""){
	        error = 1;
	        jQuery(".valid_to").addClass('emp_str');
	    }else{
	        jQuery(".valid_to").removeClass('emp_str');
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
<div class="footer-grp-btn">
 <!-- FOOTER-GRP-BTN START -->
 <a class="btn btn-gray left" href="javascript:history.go(-1);">BACK</a> 
 <!-- FOOTER-GRP-BTN END -->
 </div>