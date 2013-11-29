<?php print form_open('','onsubmit="return validateForm()"');?>
<div class="tbl-wrap">	
		  <?php print $this->session->flashdata('message');?>
          <!-- TBL-WRAP START -->
          <table style="width:2430px;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:50px;"></th>
              <th style="width:170px;">Employee Number</th>
              <th style="width:170px;">Last Name</th>
              <th style="width:170px;">First Name</th>
              <th style="width:170px;">Middle Name</th>
              <th style="width:170px;">Birth Date</th>
              <th style="width:170px;">Gender</th>
              <th style="width:170px;">Marital Status</th>
              <th style="width:170px;">Address</th>
              <th style="width:170px;">Contact Number</th>
              <th style="width:170px;">TIN</th>
              <th style="width:170px;">SSS</th>
              <th style="width:170px;">HDMF</th>
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
	              <td><?php print $row->dob;?></td>
	              <td><?php print $row->gender;?></td>
	              <td><?php print $row->marital_status;?></td>
	              <td><?php print $row->address;?></td>
	              <td><?php print $row->home_no;?></td>
	              <td><?php print $row->tin;?></td>	
	              <td><?php print $row->sss;?></td>
	              <td><?php print $row->hdmf;?></td>
	              <td><?php print $row->no_of_dependents;?></td>
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
        <script>
        	function addNewEmp(size){
            	var tbl = "<tr>";
		        tbl += "<td></td>";
		        tbl += "<td><input type='text' name='uname[]' class='txtfield unameField class_val"+size+"' class_val='class_val"+size+"' attr_uname_val='"+size+"'></td>";
		        tbl += "<td><input type='text' name='last_name[]' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='first_name[]' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='middle_name[]' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='dob[]' class='txtfield dob' id='dob"+size+"'></td>";
		        tbl += "<td><select class='txtselect select-medium' name='gender[]'><option value='Male <?php echo set_select('gender[]', 'Male'); ?>'>Male</option><option value='Female <?php echo set_select('gender[]', 'Female'); ?>'>Female</option></select></td>";
		        tbl += "<td><select class='txtselect select-medium' name='marital_status[]'><option value='Married <?php echo set_select('marital_status[]', 'Married'); ?>'>Married</option><option value='Single <?php echo set_select('marital_status[]', 'Single'); ?>'>Single</option><option value='Widow <?php echo set_select('marital_status[]', 'Widow'); ?>'>Widow</option><option value='Divorce <?php echo set_select('marital_status[]', 'Divorce'); ?>'>Divorce</option></select></td>";
		        tbl += "<td><input type='text' name='address[]' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='contact_no[]' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='tin[]' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='sss[]' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='hdmf[]' class='txtfield'></td>";
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
					remove_row();
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
				        var input_text_size = jQuery("input[name='uname[]']").length;
						if(parseInt(input_text_size) == 0) jQuery(".saveBtn").css("display","none");
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
			                          		window.location.href = window.location.href;
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
                              	jQuery(".dob_edit").empty().val(status.dob);
                              	jQuery(".address_edit").empty().val(status.address);
                              	jQuery(".contact_no_edit").empty().val(status.contact_no);
                              	jQuery(".tin_edit").empty().val(status.tin);
                              	jQuery(".sss_edit").empty().val(status.sss);
                              	jQuery(".hdmf_edit").empty().val(status.hdmf);
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
					var dob_edit = jQuery(".dob_edit").val();
					var gender_edit = jQuery(".gender_edit").val();
					var marital_status_edit = jQuery(".marital_status_edit").val();
					var address_edit = jQuery(".address_edit").val();
					var contact_no_edit = jQuery(".contact_no_edit").val();
					var tin_edit = jQuery(".tin_edit").val();
					var sss_edit = jQuery(".sss_edit").val();
					var hdmf_edit = jQuery(".hdmf_edit").val();
					var no_qual_dep_edit = jQuery(".no_qual_dep_edit").val();
					var error = "";
					
					error = check_emp_str("emp_idEdit");
					error += check_emp_str("lastname_edit");
					error += check_emp_str("firstname_edit");
					error += check_emp_str("middlename_edit");
					error += check_emp_str("dob_edit");
					error += check_emp_str("gender_edit");
					error += check_emp_str("marital_status_edit");
					error += check_emp_str("address_edit");
					error += check_emp_str("contact_no_edit");
					error += check_emp_str("tin_edit");
					error += check_emp_str("sss_edit");
					error += check_emp_str("hdmf_edit");
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
								'dob_edit':dob_edit,
								'gender_edit':gender_edit,
								'marital_status_edit':marital_status_edit,
								'address_edit':address_edit,
								'contact_no_edit':contact_no_edit,
								'tin_edit':tin_edit,
								'sss_edit':sss_edit,
								'hdmf_edit':hdmf_edit,
								'no_qual_dep_edit':no_qual_dep_edit
							},
							success: function(data){
								var status = jQuery.parseJSON(data);
	                          	if(status.success == 1){
	                          		window.location.href = window.location.href;
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

	        function pagination(){
	    		jQuery("#pagination li").each(function(){
	    		    jQuery(this).find("a").addClass("btn");;
	    		});
	    	}
	        
			jQuery(function(){
				_addRowBtn();
				_successContBox();
				_delete_emp_fromDB();
				_get_information();
				_updateBtn();
				pagination();
			});
        </script>
<div class="footer-grp-btn">
 <!-- FOOTER-GRP-BTN START -->
 <a class="btn btn-gray left" href="javascript:history.go(-1);">BACK</a> 
 <!-- FOOTER-GRP-BTN END -->
 </div>