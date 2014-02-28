<!-- MAIN-CONTENT START -->
        <div class="tbl-wrap">
        <?php print $this->session->flashdata('message');?>
          <!-- TBL-WRAP START -->
          <table style="width:auto" class="tbl">
            <tr>
              <th style="width:width:auto;"></th>
              <th style="width:width:auto">Employee Number</th>
              <th>Employee Name</th>
              <th style="width:width:auto">Action</th>
            </tr>
            <?php 
            	if($employee != null){
            		$counter = 1;
            		foreach ($employee as $row){
            			
            ?>
            	<tr>
	              <td><?php print $counter++;?></td>
	              <td><?php print $row->payroll_cloud_id;?></td>
	              <td><?php print ucfirst($row->first_name)." ".ucfirst($row->last_name);?></td>
	              <td><a attr_empid = "<?php print $row->emp_id;?>" class="btn btn-gray btn-action view_emp_dep_btn" href="javascript:void(0);">VIEW</a></td>
	            </tr>
            <?php 	}	
            	}else{
            		print "<tr class='msg_empt_cont'><td colspan='4' style='text-align:left;'>".msg_empty()."</td></tr>";
            	}
            ?>
          </table>
          	<div class="emp_dep_contbox ihide" title="Add Employee Dependents">
          	<?php print form_open('','onsubmit="return check_dep()"');?>
          		<span class="ihide qual_no_cont"></span>
          		<h1 class="emp_name_dep custom_h1"></h1><span class="ihide emp_idVal emp_idMain"></span>
          		<p>To display the dependents of the employee, click view</p>
				  <table style="width:100%" class="tbl emp_dept_contList">
		            <tbody>
			            <tr>
			              <th style="width:50px;"></th>
			              <th style="width:170px;">Dependent's Name</th>
			              <th style="width:170px">Date of Birth</th>
			              <th style="width:170px">Action</th>
			            </tr>
		            </tbody>
		          </table>
		          <br />
		          <input type="submit" class="btn add_new_dep" value="ADD" name="add_dep" onclick="javascript:return false;">
		          <input type="hidden" value="" name="emp_id" class="emp_idVal" />
		          <input type="submit" class="btn ihide save_btn" value="SAVE" name="save_dep">
		          <input type="submit" class="btn ihide del_btn_dep" value="DELETE" name="del_dep">
	          <?php print form_close();?>
	        </div>
          <div class='del_msg ihide' title='Confirmation'>Ooopppss! Are you sure you want to delete this dependent?</div>
          <!-- TBL-WRAP END -->
        </div>
          <div class="pagiCont_btnCont">
          	<div class="left"><?php print $links;?></div>
          	<div class="clearB"></div>
          </div>
        <div class='editCont ihide' title='Edit Information'>
			  <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table width="100%">
            <tbody><tr>
              <td style="width:155px">Name:</td>
              <td>
              <input type="text" value="" name="" class="txtfield dep_idEdit ihide" />
              <input type="text" value="" name="" class="txtfield dep_name"></td>
            </tr>
            <tr>
              <td>Date of Birth: </td>
              <td><input type="text" value="" name="" class="txtfield dep_dob" /></td>
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
        <!-- MAIN-CONTENT END -->
        <script type="text/javascript"  src="/assets/theme_2013/js/external_js.js"></script>
        <script>
			function checkCheckBox(){
				if(!jQuery("input[name='qual_dep[]']").is(":checked")){
				    jQuery(".del_btn_dep").css("display","none");
				}else{
				    jQuery(".del_btn_dep").css("display","inline");
				}
			}

	        function clear_tbl(){
				jQuery(".clear_tbl").each(function(){
					jQuery(this).remove();
				});

				jQuery(".dept_name").each(function(){
					jQuery(this).remove();
				});

				jQuery(".dob").each(function(){
					jQuery(this).remove();
				});
			}

	        function add_emp_dependent_form(size){
		        var emp_id_val = jQuery.trim(jQuery(".emp_idMain").text());
				var _form = '<tr class="clear_tbl append_td_dep"><td><input name="emp_id_add[]" value='+emp_id_val+' type="text" class="txtfield ihide"></td><td><input name="dept_name_add[]" type="text" class="txtfield dept_name" id="dept_name'+size+'"></td><td><input type="text" name="dob_add[]" class="txtfield dob" id="dob'+size+'" readonly="readonly"></td><td><a href="javascript:void(0);" style="width:127px;" class="btn btn-red btn-action delBtnRow custom_white">DELETE</a></td></tr>';
				return _form;
			}
	        
			function view_dep(){
				jQuery(".view_emp_dep_btn").click(function(){
					clear_tbl();

					// remove no item row
					_remove_msg_emp();
					jQuery(".save_btn,.del_btn_dep").hide();
				    var _this = jQuery(this),
				    emp_id =  jQuery(this).attr("attr_empid"),
				    urls = window.location.href;
				    
				    		$.ajax({
								url:urls,
								type: "POST",
								data:{
									'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
									'emp_id':emp_id,
									'view_qual_dep':'1'
									},success: function(data) {
                                        var status = jQuery.parseJSON(data),
                                        view_dep = status.table,
										emp_name = status.name;
                                        emp_idVal = status.emp_id;
                                        jQuery(".emp_name_dep").text(emp_name);
										jQuery(".emp_idVal").text(emp_idVal);
										jQuery(".emp_idVal").val(emp_idVal);
										jQuery(".qual_no_cont").text(status.qual_no);
										
                                        jQuery(".emp_dep_contbox table:eq(0) tbody").append(view_dep);
                                        jQuery(".emp_dep_contbox").dialog({
                    						width: 'inherit',
                    						draggable: false,
                    						modal: true,
                    						minWidth:'400',
                    						dialogClass:'transparent'
                    					});
                    					
                                        //check_dep();
                                        _delete_dependentsDb();
                                        get_information();
                                        check_qual_dep_no();
										return false;
									}
							});
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
			
			function add_new_dep(){
				jQuery(".add_new_dep").click(function(){
					var size = shuffle_str("1234frds");
					var dep_form = add_emp_dependent_form(size);
			        jQuery(".emp_dept_contList tbody").append(dep_form);
			        jQuery(".save_btn").css("display","inline");
			        dob_datepicker();
			        remove_row();

			     	// remove no item row
					_remove_msg_emp();
					check_qual_dep_no();
				});	
			}

	        function check_dep(){
	        	    jQuery(".emp_dept_contList tr input:text").each(function(){
	        	        var _this = jQuery(this);
	        	        var txtfield = _this.val();
	        	        if(txtfield == ""){
	        	            _this.addClass("emp_str");
	        	        }else{
	        	        	_this.removeClass("emp_str");
	        	        }
	        	    });
	        	    
        	    	if(jQuery(".emp_dept_contList tr input:text").hasClass("emp_str")){
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

	        function remove_row(){
	        	jQuery(".emp_dept_contList tr").each(function(){
	        	    var _this = jQuery(this);
	        	    jQuery(this).find(".delBtnRow").on("click", function(){
	        	        _this.remove();
	        	        // var input_text_size = jQuery("input[name='dept_name[]']").length;
	        	        var input_text_size = jQuery("input[name='dept_name_add[]']").length;
	        	        check_qual_dep_no();
	        			if(parseInt(input_text_size) == 0) jQuery("input[name='save_dep']").css("display","none");
	        	    });
	        	});
	        }

	        function _delete_dependentsDb(){
	        	jQuery(".delBtnDb").on("click", function(){
	        	    var _this = jQuery(this);
	        	    var _id = _this.attr("attr_no");
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
	     								'delete_dep':'1',
	     								'dep_id':_id,
	     								'emp_id': jQuery.trim(jQuery(".emp_idVal").val())
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

	        function get_information(){
	        	jQuery(".editBtnDb").on("click", function(){
	        	    var _this = jQuery(this);
	        	    var dep_id = _this.attr("attr_no");
	        	    $.ajax({
						url: window.location.href,
						type: "POST",
						data: {
							'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
							'get_information': '1',
							'dep_id': dep_id
						},
						success: function(data){
							var status = jQuery.parseJSON(data);
                          	if(status.success == 1){
                          		jQuery(".dep_idEdit").val(status.dep_id);
                              	jQuery(".dep_name").val(status.name);
                              	jQuery(".dep_dob").val(status.dob);
                          		jQuery(".editCont").dialog({
                					width: 'inherit',
                					draggable: false,
                					modal: true,
                					minWidth:'400',
                					dialogClass:'transparent'
                              	});
                          		jQuery(".dep_name, .dep_dob").removeClass("emp_str");
                          		dob_datepicker();
                          	}else{
								alert("- Invalid parameter.");
								return false;
    						}
						}
	        	    });
	        	});
	        }

	        function update_information(){
	        	jQuery(".updateBtn").on("click", function(){
		        	var dep_id = jQuery(".dep_idEdit").val()
	        	    var name = jQuery(".dep_name").val();
	        	    var dep_dob = jQuery(".dep_dob").val();
	        	    var error = "";
	        	    if(jQuery.trim(name) == ""){
	        	        error = 1;   
	        	        jQuery(".dep_name").addClass("emp_str");
	        	    }else{
	        	        jQuery(".dep_name").removeClass("emp_str");
	        	    }
	        	    if(jQuery.trim(dep_dob) == ""){
	        	        error = 1;
	        	        jQuery(".dep_dob").addClass("emp_str");
	        	    }else{
	        	        jQuery(".dep_dob").removeClass("emp_str");
	        	    }
	        	    if(error == 1){
	        	        return false;
	        	    }else{
	        	        // updating infomation
	        	        $.ajax({
							url: window.location.href,
							type: "POST",
							data: {
								'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
								'dep_id': dep_id,
								'name': name,
								'dep_dob': dep_dob,
								'update_dep': '1'
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
	        	    }
	        	});
	        }

	        function _remove_msg_emp(){
	        	jQuery(".msg_empt_cont").remove();
	        }
	        
	        function dob_datepicker(){
				jQuery(".dep_dob, .dob").datepicker({
					changeMonth: true,
					changeYear: true,
					dateFormat: 'yy-mm-dd',
					maxDate: 0,
					yearRange: "-100:+0"
				});
			}

	        function check_qual_dep_no(){
	        	var active_qual_dep = jQuery(".clear_tbl").length;
	        	var qual_dep_no = jQuery(".qual_no_cont").text();

	        	var new_qual_dep = parseInt(qual_dep_no) - parseInt(active_qual_dep);
	        	if(new_qual_dep <= 0){
	        	    jQuery(".add_new_dep").hide();
	        	}else{
	        	    jQuery(".add_new_dep").css("display","inline-block");
	        	}
	        }
	        
			jQuery(function(){
				view_dep();
				add_new_dep();
				_successContBox();
				update_information();
				dob_datepicker();
				basic_file_li();
			});
       	</script>
<div class="footer-grp-btn">
 <!-- FOOTER-GRP-BTN START -->
 <a class="btn btn-gray left" href="javascript:history.go(-1);">BACK</a> 
 <!-- FOOTER-GRP-BTN END -->
 </div>
