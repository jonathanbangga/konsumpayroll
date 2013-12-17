<?php print form_open('','onsubmit="return validate_form()" enctype="multipart/form-data"');?>
<div class="tbl-wrap">	
		  <?php print $this->session->flashdata('message');?>
          <!-- TBL-WRAP START -->
          <table style="width:1610px;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:50px;"></th>
              <th style="width:170px;">Employee Name</th>
              <th style="width:170px;">Employee Number</th>
              <th style="width:170px;">Current Basic Pay</th>
              <th style="width:170px;">New Basic Pay</th>
              <th style="width:170px;">Effective Date</th>
              <th style="width:170px;">Adjustment Date</th>
              <th style="width:170px;">Reason for Adjustment</th>
              <th style="width:200px;">Attachment</th>
              <th style="width:170px">Action</th>
            </tr>
            <?php 
            	if($basic_pay_adjustment == NULL){
            		$counter = 1;
            		foreach($basic_pay_adjustment as $row){
            ?>
	            <tr>
	              <td><?php print $counter++;?></td>
	              <td><?php print ucwords($row->first_name)." ".ucwords($row->last_name);?></td>
	              <td><?php print $row->payroll_cloud_id;?></td>
	              <td><?php print $row->current_basic_pay;?></td>
	              <td><?php print $row->new_basic_pay;?></td>
	              <td><?php print $row->effective_date;?></td>
	              <td><?php print $row->adjustment_date;?></td>
	              <td><?php print $row->reasons;?></td>
	              <td><?php print $row->attachment;?></td>
	              <td><a href="javascript:void(0);" class="btn btn-gray btn-action editBtnDb" attr_empid="<?php print $row->emp_id;?>">EDIT</a> <a href="javascript:void(0);" attr_photo_val="<?php print $row->attachment;?>" class="btn btn-red btn-action delBtnDb" attr_empid="<?php print $row->emp_id;?>">DELETE</a></td>
	            </tr>
            <?php
            		}
            	}else{
            		print "<tr class='msg_empt_cont'><td colspan='10' style='text-align:left;'>".msg_empty()."</td></tr>";
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
              <td style="width:155px">Current Basic Pay:</td>
              <td>
              <input type="text" value="" name="emp_idEdit" class="txtfield emp_idEdit ihide" />
              <input type="text" value="" name="current_basic_pay_edit" class="txtfield current_basic_pay_edit"></td>
            </tr>
            <tr>
              <td>New Basic Pay: </td>
              <td><input type="text" value="" name="new_basic_pay_edit" class="txtfield new_basic_pay_edit" /></td>
            </tr>
            <tr>
              <td>Effective Date: </td>
              <td><input type="text" value="" name="effective_date_edit" class="txtfield effective_date_edit datepickerCont" /></td>
            </tr>
            <tr>
              <td>Adjustment Date: </td>
              <td><input type="text" value="" name="adjustment_date_edit" class="txtfield adjustment_date_edit datepickerCont" /></td>
            </tr>
            <tr>
              <td>Reason for Adjustment: </td>
              	<td><input type="text" value="" name="reason_for_adjustment_edit" class="txtfield reason_for_adjustment_edit" /></td>
            </tr>
            <tr>
              <td>Attachment: </td>
              	<td>
	              	<input type="text" value="" class="txtfield attachment_val ihide" name="attachment_old_val" />
	              	<input type="file" value="" name="userfile" class="dob_edit" />
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
<script type="text/javascript"  src="/assets/theme_2013/js/external_js.js"></script>
<script>
	function addRow(size){
		var tbl = "<tr>";
	    tbl += "<td><input readonly='readonly' type='text' name='emp_id[]' class='ihide txtfield emp_id"+size+"' /></td>";
	    tbl += "<td><input type='text' name='emp_name[]' class='txtfield emp_name emp_name"+size+"' class_val='class_val"+size+"' attr_uname_val='"+size+"'></td>";
	    tbl += "<td><input readonly='readonly' type='text' name='emp_no[]' class='txtfield emp_no emp_no"+size+"' class_val='class_val"+size+"' attr_uname_val='"+size+"'></td>";
	    tbl += "<td><input type='text' name='current_basic_pay[]' class='current_basic_pay txtfield'></td>";
	    tbl += "<td><input type='text' name='new_basic_pay[]' class='new_basic_pay txtfield'></td>";
	    tbl += "<td><input type='text' name='effective_date[]' class='datepickerCont effective_date txtfield' id='effective_date"+size+"'></td>";
	    tbl += "<td><input type='text' name='adjustment_date[]' class='datepickerCont adjustment_date txtfield' id='adjustment_date"+size+"'></td>";
	    tbl += "<td><input type='text' name='reasons[]' class='reasons txtfield'></td>";
	    tbl += "<td><input type='text' name='array_val[]' class='ihide' value='"+size+"' /><input type='file' multiple name='userfile"+size+"' class='attachment userfile' style='width:180px;' /></td>";
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
			change_employee();
			_datepicker();

			// remove msg_empty
			_remove_msg_emp();
		});
    }

	function remove_row(){
		jQuery(".emp_conList tr").each(function(){
		    var _this = jQuery(this);
		    jQuery(this).find(".delRow").on("click", function(){
		        _this.remove();
		        var input_text_size = jQuery("input[name='emp_no[]']").length;
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

	function change_employee(){
		jQuery(".emp_name").focus(function(){
		    var _this = jQuery(this);
		    var _attr = _this.attr("attr_uname_val");
		    _this.removeAttr("readonly").val("");
		    jQuery(".emp_no"+_attr).val("");
		    jQuery(".emp_id"+_attr).val("");
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

	function _datepicker(){
		jQuery(".datepickerCont").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
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
		    jQuery(".successContBox").css("display","block");
		    setTimeout(function(){
		        jQuery(".successContBox").fadeOut('100');
		    },3000);
		}
	}

	function _delete_empDb(){
    	jQuery(".delBtnDb").on("click", function(){
    	    var _this = jQuery(this);
    	    var _id = _this.attr("attr_empid");
    	    var attr_photo_val = _this.attr("attr_photo_val");
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
 								'delete_basic_pay_adjustment':'1',
 								'emp_id': _id,
 								"attr_photo_val":attr_photo_val
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
							jQuery(".current_basic_pay_edit").blur().empty().val(status.current_basic_pay);
							jQuery(".new_basic_pay_edit").empty().val(status.new_basic_pay);
							jQuery(".effective_date_edit").val(status.effective_date);
							jQuery(".adjustment_date_edit").val(status.adjustment_date);
							jQuery(".reason_for_adjustment_edit").val(status.reasons);
							jQuery(".attachment_val").val(status.attachment);
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
		//jQuery(".updateBtn").on("click", function(){
			var emp_idEdit = jQuery.trim(jQuery(".emp_idEdit").val());
		    var current_basic_pay_edit = jQuery.trim(jQuery(".current_basic_pay_edit").val());
		    var new_basic_pay_edit = jQuery.trim(jQuery(".new_basic_pay_edit").val());
		    var effective_date_edit = jQuery.trim(jQuery(".effective_date_edit").val());
		    var adjustment_date_edit = jQuery.trim(jQuery(".adjustment_date_edit").val());
		    var reason_for_adjustment_edit = jQuery.trim(jQuery(".reason_for_adjustment_edit").val());
		    var attachment_val = jQuery.trim(jQuery(".attachment_val").val());
		    var error = "";
		    if(current_basic_pay_edit==""){
		        error = 1;
		        jQuery(".current_basic_pay_edit").addClass('emp_str');
		    }else{
		        jQuery(".current_basic_pay_edit").removeClass('emp_str');
		    }
		    
		    if(new_basic_pay_edit==""){
		        error = 1;
		        jQuery(".new_basic_pay_edit").addClass('emp_str');
		    }else{
		        jQuery(".new_basic_pay_edit").removeClass('emp_str');
		    }

		    if(effective_date_edit==""){
		        error = 1;
		        jQuery(".effective_date_edit").addClass('emp_str');
		    }else{
		        jQuery(".effective_date_edit").removeClass('emp_str');
		    }

		    if(adjustment_date_edit==""){
		        error = 1;
		        jQuery(".adjustment_date_edit").addClass('emp_str');
		    }else{
		        jQuery(".adjustment_date_edit").removeClass('emp_str');
		    }

		    if(reason_for_adjustment_edit==""){
		        error = 1;
		        jQuery(".reason_for_adjustment_edit").addClass('emp_str');
		    }else{
		        jQuery(".reason_for_adjustment_edit").removeClass('emp_str');
		    }

		    if(attachment_val==""){
		        error = 1;
		        jQuery(".attachment_val").addClass('emp_str');
		    }else{
		        jQuery(".attachment_val").removeClass('emp_str');
		    }

		    if(error == 1){
				return false;
		    }
		//});
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
    	_delete_empDb();
    	_edit_information();
    	_datepicker();
    	pagination();
    	payroll_info_li();
	});
</script>
<div class="footer-grp-btn">
 <!-- FOOTER-GRP-BTN START -->
 <a class="btn btn-gray left" href="javascript:history.go(-1);">BACK</a> 
 <!-- FOOTER-GRP-BTN END -->
 </div>