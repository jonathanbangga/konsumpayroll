<div class="error_msg_cont"></div>
<?php print form_open('','onsubmit="return validateForm()"');?>
<p>List of employees and their information.</p>
<div class="tbl-wrap">	
		  <?php print $this->session->flashdata('message');?>
          <!-- TBL-WRAP START -->
          <table style="width:2770px;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:50px;"></th>
              <th style="width:170px;">Employee Number</th>
              <th style="width:170px;">Last Name</th>
              <th style="width:170px;">First Name</th>
              <th style="width:170px;">Middle Name</th>
              <th style="width:170px;">Email Address</th>
              <th style="width:170px;">Birth Date</th>
              <th style="width:170px;">Gender</th>
              <th style="width:170px;">Marital Status</th>
              <th style="width:170px;">Address</th>
              <th style="width:170px;">Contact Number</th>
              <th style="width:170px;">TIN</th>
              <th style="width:170px;">SSS</th>
              <th style="width:170px;">HDMF</th>
              <th style="width:170px;">PhilHealth</th>
              <th style="width: 170px;">No. of Qualified Dependents</th>
              <th style="width:170px">Action</th>
            </tr>
            <?php 
            	if($employee != NULL){
            		$counter = 1;
            		foreach($employee as $row){
            ?>
	            <tr>
	              <td><?php print $counter++;?></td>
	              <td><?php print $row->payroll_cloud_id;?></td>
	              <td><?php print ucwords($row->last_name);?></td>
	              <td><?php print ucwords($row->first_name);?></td>
	              <td><?php print ucwords($row->middle_name);?></td>
	              <td><?php print $row->email;?></td>
	              <td><?php print $row->dob;?></td>
	              <td><?php print $row->gender;?></td>
	              <td><?php print $row->marital_status;?></td>
	              <td><?php print $row->address;?></td>
	              <td><?php print $row->home_no;?></td>
	              <td><?php print $row->tin;?></td>	
	              <td><?php print $row->sss;?></td>
	              <td><?php print $row->hdmf;?></td>
	              <td><?php print $row->phil_health;?></td>
	              <td><?php print $row->no_of_dependents;?></td>
	              <td><a href="javascript:void(0);" class="btn btn-gray btn-action editBtnDb" attr_empid="<?php print $row->emp_id;?>">EDIT</a> <a href="javascript:void(0);" class="btn btn-red btn-action delBtnDb" attr_empid="<?php print $row->emp_id;?>">DELETE</a></td>
	            </tr>
            <?php 			
            		}
            	}else{
            		print "<tr class='msg_empt_cont'><td colspan='16' style='text-align:left;'>".msg_empty()."</td></tr>";
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
			  <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table width="100%">
            <tbody><tr>
              <td style="width:155px">Last Name:</td>
              <td>
              <input type="text" value="" name="emp_idEdit" class="txtfield emp_idEdit ihide" />
              <input type="text" value="" name="" class="txtfield lastname_edit"></td>
            </tr>
            <tr>
              <td>First Name: </td>
              <td><input type="text" value="" name="" class="txtfield firstname_edit" /></td>
            </tr>
            <tr>
              <td>Middle Name: </td>
              <td><input type="text" value="" name="" class="txtfield middlename_edit" /></td>
            </tr>
            <tr>
              <td>Email: </td>
              <td>
              <input type="hidden" value="" name="" class="txtfield account_id ihide" />
              <input type="hidden" value="" name="" class="txtfield old_email_edit ihide" />
              <input type="text" value="" name="" class="txtfield email_edit" /></td>
            </tr>
            <tr>
              <td>Birth Date: </td>
              <td><input type="text" value="" name="" class="txtfield dob_edit" /></td>
            </tr>
            <tr>
              <td>Gender: </td>
              <td>
              	<select class='txtselect select-medium gender_edit' name='gender'>
              		<option value='Male<?php echo set_select('gender', 'Male'); ?>'>Male</option>
              		<option value='Female<?php echo set_select('gender', 'Female'); ?>'>Female</option>
              	</select>
              </td>
            </tr>
            <tr>
              <td>Marital Status: </td>
              <td>
              	<select class='txtselect select-medium marital_status_edit' name='marital_status'>
              		<option value='Single<?php echo set_select('marital_status', 'Single'); ?>'>Single</option>
              		<option value='Married<?php echo set_select('marital_status', 'Married'); ?>'>Married</option>
              		<option value='Widow<?php echo set_select('marital_status', 'Widow'); ?>'>Widow</option>
              		<option value='Divorce<?php echo set_select('marital_status', 'Divorce'); ?>'>Divorce</option>
              	</select>
              </td>
            </tr>
            <tr>
              <td>Address: </td>
              <td><input type="text" value="" name="" class="txtfield address_edit" /></td>
            </tr>
            <tr>
              <td>Contact Number: </td>
              <td><input type="text" value="" name="" class="txtfield contact_no_edit" /></td>
            </tr>
            <tr>
              <td>TIN: </td>
              <td><input type="text" value="" name="" class="txtfield tin_edit" /></td>
            </tr>
            <tr>
              <td>SSS: </td>
              <td><input type="text" value="" name="" class="txtfield sss_edit" /></td>
            </tr>
            <tr>
              <td>HDMF: </td>
              <td><input type="text" value="" name="" class="txtfield hdmf_edit" /></td>
            </tr>
            <tr>
              <td>PhilHealth: </td>
              <td><input type="text" value="" name="" class="txtfield philhealth_edit" /></td>
            </tr>
            <tr>
              <td>No. of Qualified Dependents: </td>
              <td><input type="text" value="" name="" class="txtfield no_qual_dep_edit" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>
	              <input type="submit" value="Update" name="UPDATE" class="btn updateBtn" />
              </td>
            </tr>
          </tbody></table>
          <!-- TBL-WRAP END -->
        </div>
        </div>
        <script type="text/javascript"  src="/assets/theme_2013/js/external_js.js"></script>
        <script type="text/javascript"  src="/assets/theme_2013/js/jquery.maskedinput.min.js"></script>
        <script>
        	function addNewEmp(size){
            	var tbl = "<tr>";
		        tbl += "<td></td>";
		        tbl += "<td><input type='text' name='uname[]' class='txtfield unameField class_val"+size+"' class_val='class_val"+size+"' attr_uname_val='"+size+"'></td>";
		        tbl += "<td><input type='text' name='last_name[]' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='first_name[]' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='middle_name[]' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='email[]' class='txtfield email_val' attr_email_val='"+size+"'></td>";
		        tbl += "<td><input type='text' name='dob[]' class='txtfield dob' id='dob"+size+"' readonly='readonly'></td>";
		        tbl += "<td><select class='txtselect select-medium' name='gender[]'><option value='Male <?php echo set_select('gender[]', 'Male'); ?>'>Male</option><option value='Female <?php echo set_select('gender[]', 'Female'); ?>'>Female</option></select></td>";
		        tbl += "<td><select class='txtselect select-medium' name='marital_status[]'><option value='Single <?php echo set_select('marital_status[]', 'Single'); ?>'>Single</option><option value='Married <?php echo set_select('marital_status[]', 'Married'); ?>'>Married</option><option value='Widow <?php echo set_select('marital_status[]', 'Widow'); ?>'>Widow</option><option value='Divorce <?php echo set_select('marital_status[]', 'Divorce'); ?>'>Divorce</option></select></td>";
		        tbl += "<td><input type='text' name='address[]' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='contact_no[]' class='txtfield' placeholder='(000) 000-0000'></td>";
		        tbl += "<td><input type='text' name='tin[]' class='txtfield' placeholder='000-000-000-000'></td>";
		        tbl += "<td><input type='text' name='sss[]' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='hdmf[]' class='txtfield' placeholder='0000-0000-0000'></td>";
		        tbl += "<td><input type='text' name='philhealth[]' class='txtfield' placeholder='00-000000000-0'></td>";
		        tbl += "<td><input type='text' name='no_dependents[]' class='txtfield'></td>";
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
					check_uname();
					check_email_address();
					remove_row();
					mask_format();
					
					// remove msg_empty
					_remove_msg_emp();
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
        	    show_error_msg();
        	    
				duplicate_str();
				duplicate_str_email();
				
				if(jQuery(".emp_conList tr input:text").hasClass("emp_str")){
        	    	return false;
        	    }
			}


			function show_error_msg(){
				// show error msg
				var why = "";
				var why_emp_no = "";
				var why_lastname = "";
				var why_firstname = "";
				var why_middlename = "";
				var why_email = "";
				var why_dob = "";
				var why_address = "";
				var why_contact_no = "";				
				var why_tin = "";
				var why_sss = "";
				var why_hdmf = "";
				var why_philhealth = "";
				var why_no_dependents = "";
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				
				for(var a=0;a<=100;a++){ // a = dummy
				    var emp_no = jQuery("input[name='uname[]']").eq(a).val();
				    var last_name = jQuery("input[name='last_name[]']").eq(a).val();
				    var first_name = jQuery("input[name='first_name[]']").eq(a).val();
				    var middle_name = jQuery("input[name='middle_name[]']").eq(a).val();
				    var email = jQuery("input[name='email[]']").eq(a).val();
				    var dob = jQuery("input[name='dob[]']").eq(a).val();
				    var address = jQuery("input[name='address[]']").eq(a).val();
				    var contact_no = jQuery("input[name='contact_no[]']").eq(a).val();
				    var tin = jQuery("input[name='tin[]']").eq(a).val();
				    var sss = jQuery("input[name='sss[]']").eq(a).val();
				    var hdmf = jQuery("input[name='hdmf[]']").eq(a).val();
				    var philhealth = jQuery("input[name='philhealth[]']").eq(a).val();
				    var no_dependents = jQuery("input[name='no_dependents[]']").eq(a).val();
				    
				    if(emp_no == "") why_emp_no = 1;
				    if(last_name == "") why_lastname = 1;
				    if(first_name == "") why_firstname = 1;
				    if(middle_name == "") why_middlename = 1;
				    if(email == "") why_email = 1;
				    if(dob == "") why_dob = 1;
				    if(address == "") why_address = 1;
				    if(contact_no == "") why_contact_no = 1;
				    if(tin == "") why_tin = 1;
				    if(sss == "") why_sss = 1;
				    if(hdmf == "") why_hdmf = 1;
				    if(philhealth == "") why_philhealth = 1;
				    if(no_dependents == "") why_no_dependents = 1;
				}

				if(why_emp_no != "") why += "<p>- Please enter Employee Number</p>";
				if(why_lastname != "") why += "<p>- Please enter Last Name</p>";
				if(why_firstname != "") why += "<p>- Please enter First Name</p>";
				if(why_middlename != "") why += "<p>- Please enter Middle Name</p>";
				if(why_email != "") why += "<p>- The Email Address field must contain a valid email address </p>";
				if(why_dob != "") why += "<p>- Please enter Birth Date</p>";
				if(why_address != "") why += "<p>- Please enter Address</p>";
				if(why_contact_no != "") why += "<p>- Please enter Contact Number</p>";
				if(why_tin != "") why += "<p>- Please enter TIN</p>";
				if(why_sss != "") why += "<p>- Please enter SSS</p>";
				if(why_hdmf != "") why += "<p>- Please enter HDMF</p>";
				if(why_philhealth != "") why += "<p>- Please enter PhilHealth</p>";
				if(why_no_dependents != "") why += "<p>- Please enter No. of Qualified Dependents</p>";
				
				if(why != ""){
					jQuery(".error_msg_cont").html(why);
					return false;
				}else{
					jQuery(".error_msg_cont").html("");
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

			function duplicate_str_email(){
				jQuery(".email_val").each(function(){
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
				    var uname_val = jQuery.trim(_this.val());
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

			function check_email_address(){
				jQuery(".email_val").bind("keyup",function(){
					var _this = jQuery(this);
				    var email_val = jQuery.trim(_this.val());
				    var attr_email_val = _this.attr("attr_email_val");
				    var class_val = _this.attr("class_val");
				    var urls = window.location.href;
				    if(jQuery.trim(email_val) != ""){
					    
					    // validate email address
				    	$.ajax({
							url: urls,
							type: "POST",
							data: {
								'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
								'check_email_address': '1',
								'email_val[]': email_val
							},
							success: function(data){
								var status = jQuery.parseJSON(data);
                            	if(status.success == 1){
									alert("<p>- The Email Address field must contain a unique value.</p>");
									_this.addClass("emp_str");
									_this.addClass("dup_str");
									return false;
	                            }else{
	                            	_this.removeClass("emp_str");
	                            	_this.removeClass("dup_str");
                                }
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
				        var input_text_size = jQuery("input[name='uname[]']").length;
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
				    var emp_id = _this.attr("attr_empid");
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
						              emp_id:emp_id,
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
	        	    var emp_id = _this.attr("attr_empid");
	        	    $.ajax({
						url: window.location.href,
						type: "POST",
						data: {
							'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
							'get_information': '1',
							'emp_id': emp_id
						},
						success: function(data){
							var status = jQuery.parseJSON(data);
                          	if(status.success == 1){

                              	jQuery(".gender_edit option").each(function(){
									var _this = jQuery(this);
									var this_val = _this.val();

									_this.removeAttr('selected')
									if(status.gender == this_val){
										_this.prop("selected", true);
									}
                                });

                              	jQuery(".marital_status_edit option").each(function(){
									var _this = jQuery(this);
									var this_val = _this.val();

									_this.removeAttr('selected')
									if(status.marital_status == this_val){
										_this.prop("selected", true);
									}
                                });
                              	
                              	jQuery(".emp_idEdit").empty().val(status.emp_id);
                              	jQuery(".lastname_edit").empty().val(status.last_name);
                              	jQuery(".firstname_edit").empty().val(status.first_name);
                              	jQuery(".middlename_edit").empty().val(status.middle_name);
                              	jQuery(".account_id").empty().val(status.account_id);
                              	jQuery(".old_email_edit").empty().val(status.email);
                              	jQuery(".email_edit").empty().val(status.email);
                              	jQuery(".dob_edit").empty().val(status.dob);
                              	jQuery(".address_edit").empty().val(status.address);
                              	jQuery(".contact_no_edit").empty().val(status.contact_no);
                              	jQuery(".tin_edit").empty().val(status.tin);
                              	jQuery(".sss_edit").empty().val(status.sss);
                              	jQuery(".hdmf_edit").empty().val(status.hdmf);
                              	jQuery(".philhealth_edit").empty().val(status.philhealth);
                              	jQuery(".no_qual_dep_edit").empty().val(status.no_of_dependents);
                              	
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

	        function _updateBtn(){
				jQuery(".updateBtn").on("click", function(){
					var emp_idEdit = jQuery(".emp_idEdit").val();
					var lastname_edit = jQuery(".lastname_edit").val();
					var firstname_edit = jQuery(".firstname_edit").val();
					var middlename_edit = jQuery(".middlename_edit").val();
					var old_email_edit = jQuery(".old_email_edit").val();
					var email_edit = jQuery(".email_edit").val();
					var dob_edit = jQuery(".dob_edit").val();
					var gender_edit = jQuery(".gender_edit").val();
					var marital_status_edit = jQuery(".marital_status_edit").val();
					var address_edit = jQuery(".address_edit").val();
					var contact_no_edit = jQuery(".contact_no_edit").val();
					var tin_edit = jQuery(".tin_edit").val();
					var sss_edit = jQuery(".sss_edit").val();
					var hdmf_edit = jQuery(".hdmf_edit").val();
					var philhealth_edit = jQuery(".philhealth_edit").val();
					var no_qual_dep_edit = jQuery(".no_qual_dep_edit").val();
					var error = "";
					
					error = check_emp_str("emp_idEdit");
					error += check_emp_str("lastname_edit");
					error += check_emp_str("firstname_edit");
					error += check_emp_str("middlename_edit");
					error += check_emp_str("email_edit");
					error += check_emp_str("dob_edit");
					error += check_emp_str("gender_edit");
					error += check_emp_str("marital_status_edit");
					error += check_emp_str("address_edit");
					error += check_emp_str("contact_no_edit");
					error += check_emp_str("tin_edit");
					error += check_emp_str("sss_edit");
					error += check_emp_str("hdmf_edit");
					error += check_emp_str("philhealth_edit");
					error += check_emp_str("no_qual_dep_edit");

					if(jQuery.trim(error) != ""){
						return false;
					}else{
						// updating information
						$.ajax({
							url: window.location.href,
							type: "POST",
							data: {
								'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
								'update_info':"1",
								'emp_idEdit':emp_idEdit,
								'lastname_edit':lastname_edit,
								'firstname_edit':firstname_edit,
								'middlename_edit':middlename_edit,
								'old_email_edit':old_email_edit,
								'email_edit':email_edit,
								'dob_edit':dob_edit,
								'gender_edit':gender_edit,
								'marital_status_edit':marital_status_edit,
								'address_edit':address_edit,
								'contact_no_edit':contact_no_edit,
								'tin_edit':tin_edit,
								'sss_edit':sss_edit,
								'hdmf_edit':hdmf_edit,
								'philhealth_edit':philhealth_edit,
								'no_qual_dep_edit':no_qual_dep_edit
							},
							success: function(data){
								var status = jQuery.parseJSON(data);
	                          	if(status.success == 1){
	                          		window.location.href = status.url;
	                          	}else if(status.success == 3){
		                          	alert(status.msg);
	                            	return false;
	                            }else{
	                            	return false;
                              	}
							}
						});
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

	        function _remove_msg_emp(){
	        	jQuery(".msg_empt_cont").remove();
	        }
	        
	        function pagination(){
	    		jQuery("#pagination li").each(function(){
	    		    jQuery(this).find("a").addClass("btn");
	    		});
	    	}

	        function mask_format(){
	        	jQuery("input[name='contact_no[]']").mask("(999) 999-9999");
	        	jQuery("input[name='hdmf[]']").mask("9999-9999-9999");
	        	jQuery("input[name='tin[]']").mask("999-999-999-999");
	        	jQuery("input[name='philhealth[]']").mask("99-999999999-9");
	        }

	        function edit_mask_format(){
	        	jQuery(".contact_no_edit").mask("(999) 999-9999");
	        	jQuery(".hdmf_edit").mask("9999-9999-9999");
	        	jQuery(".tin_edit").mask("999-999-999-999");
	        	jQuery(".philhealth_edit").mask("99-999999999-9");
	        }
	        
			jQuery(function(){
				_addRowBtn();
				_successContBox();
				_delete_emp_fromDB();
				_get_information();
				_updateBtn();
				pagination();
				basic_file_li();
				edit_mask_format();
			});
        </script>
<div class="footer-grp-btn">
 <!-- FOOTER-GRP-BTN START -->
 <a class="btn btn-gray left" href="javascript:history.go(-1);">BACK</a> 
 <!-- FOOTER-GRP-BTN END -->
 </div>
 <!--
 <table cellpadding="0" cellspacing="0" width="100%">
    <tr>
            <td width = "10%">ID</td>
            <td width = "20%">NAME</td>
            <td width = "20%">SHORT DESCRIPTION</td>
            <td width = "30%">LONG DESCRIPTION</td>
            <td width = "10%">STATUS</td>
            <td width = "10%">PARENTID</td>
    </tr>

            <?php foreach($csvData as $field){?>
                <tr>
                    <td><?php echo $field['id']?></td>
                    <td><?php echo $field['name']?></td>
                    <td><?php echo $field['shortdesc']?></td>
                    <td><?php echo $field['longdesc']?></td>
                    <td><?php echo $field['status']?></td>
                    <td><?php echo $field['parentid']?></td>
                </tr>
            <?php }?>
</table>
 -->
