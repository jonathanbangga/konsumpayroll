<!-- MAIN-CONTENT START -->
        <div class="tbl-wrap">
        <?php print $this->session->flashdata('message');?>
          <!-- TBL-WRAP START -->
          <table style="width:100%" class="tbl">
            <tr>
              <th style="width:50px;"></th>
              <th style="width:130px">Employee Number</th>
              <th>Employee Name</th>
              <th style="width:150px">Details</th>
              <th style="width:170px">Action</th>
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
	              <td></td>	
	              <td><a attr_empid = "<?php print $row->emp_id;?>" class="btn btn-gray btn-action view_emp_dep_btn" href="javascript:void(0);">VIEW</a></td>
	            </tr>
            <?php 	}	
            	}
            ?>
          </table>
          	<div class="emp_dep_contbox ihide" title="Add Employee Dependents">
          	<?php print form_open('','onsubmit="return check_dep()"');?>
          		<h1 class="emp_name_dep custom_h1"></h1><span class="ihide emp_idVal"></span>
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
          <div class='del_msg ihide' title='Confirmation'>Do you really want to delete this dependent?</div>
          <!-- TBL-WRAP END -->
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
				var _form = '<tr class="clear_tbl append_td_dep"><td></td><td><input name="dept_name[]" type="text" class="txtfield dept_name" id="dept_name'+size+'"></td><td><input type="text" name="dob[]" class="txtfield dob" id="dob'+size+'" readonly="readonly"></td><td><a href="javascript:void(0);" style="width:127px;" class="btn btn-red btn-action delBtnRow custom_white">DELETE</a></td></tr>';
				return _form;
			}
	        
			function view_dep(){
				jQuery(".view_emp_dep_btn").click(function(){
					clear_tbl();
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
										
                                        jQuery(".emp_dep_contbox table:eq(0) tbody").append(view_dep);
                                        jQuery(".emp_dep_contbox").dialog({
                    						width: 'inherit',
                    						draggable: false,
                    						modal: true,
                    						minWidth:'400',
                    						dialogClass:'transparent'
                    					});
                    					
                                        check_dep();
                                        _delete_dependentsDb();
                                        get_information();
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
			
			function add_new_dep(){
				jQuery(".add_new_dep").click(function(){
					var size = jQuery(".dob").length + 1;
					var dep_form = add_emp_dependent_form(size);
			        jQuery(".emp_dept_contList tbody").append(dep_form);
			        jQuery(".save_btn").css("display","inline");
			        dob_datepicker();
			        remove_row();
				});	
			}

	        function check_dep(){
	        	//jQuery(".save_new_dep").click(function(){
	        	    jQuery(".emp_dept_contList tr input:text").each(function(){
	        	        var _this = jQuery(this);
	        	        var txtfield = _this.val();
	        	        if(txtfield == ""){
	        	            _this.addClass("emp_str");
	        	        }else{
	        	        	_this.removeClass("emp_str");
	        	        }
	        	    });
	        	    
	        	    //if(!jQuery(".emp_dept_contList tr input:text").hasClass("emp_str")){
        	    	if(jQuery(".emp_dept_contList tr input:text").hasClass("emp_str")){
	        	    	//save_dep();
	        	    	return false;
	        	    }
	        	//});
	        }

	        function save_dep2(){
	        	urls = window.location.href;
			    //jQuery(".emp_dept_contList tr.append_td_dep").each(function(){
			    jQuery(".emp_dept_contList tr").each(function(){
				    //if(jQuery(this).hasClass("append_td_dep")){
				    	var _this = jQuery(this);
				    	var dept_name = jQuery(this).find(".dept_name").val();
						var dob = jQuery(this).find(".dob").val();
						var emp_id = jQuery.trim(jQuery(".emp_idVal").text());
						if(jQuery.trim(dept_name) && jQuery.trim(dob)){
							if(jQuery.trim(dept_name) != "" && jQuery.trim(dob) != ""){
								$.ajax({
									url:urls,
									type: "POST",
									data:{
										'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
										'emp_id':emp_id,
										'dept_name':dept_name,
										'dob':dob,
										'add_qual_dep':'1'
										},success: function(data) {
		                                    var status = jQuery.parseJSON(data);
		                                    if(status.success == 1){
		                                    	//_this.find(".dept_name").val("");
		                                    	//_this.find(".dob").val("");
		                                    	//jQuery(".emp_dept_contList .clear_tbl").each(function(){
												//	jQuery(this).remove();
		                                        //    });
												//jQuery(".emp_dept_contList tbody").append(status.table);
												//window.location.href = urls;
		                                    }
										}
								});
							}
						}
				    //}
			    });
	        }


	        function save_dep(){
	        	var dept_size = jQuery(".dept_name").length;
	        	var dob_size = jQuery(".dob").length;

	        	for(var a=1;a<=dept_size;a++){
	        	    var dept_name = jQuery("#dept_name"+a).val();
	        	    var dob = jQuery("#dob"+a).val();
	        	    var emp_id = jQuery.trim(jQuery(".emp_idVal").text());

	        	    var urls = window.location.href;
	        	    $.ajax({
						url:urls,
						type: "POST",
						data:{
							'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
							'emp_id':emp_id,
							'dept_name':dept_name,
							'dob':dob,
							'add_qual_dep':'1'
							},success: function(data) {
                                var status = jQuery.parseJSON(data);
                                if(status.success == 1){
                                	//_this.find(".dept_name").val("");
                                	//_this.find(".dob").val("");
                                	//jQuery(".emp_dept_contList .clear_tbl").each(function(){
									//	jQuery(this).remove();
                                    //    });
									//jQuery(".emp_dept_contList tbody").append(status.table);
									//window.location.href = urls;
                                }
							}
					});
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
	        	        var input_text_size = jQuery("input[name='dept_name[]']").length;
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
	     	                          		window.location.href = window.location.href;
	     	                          		$( this ).dialog( "close" );
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
 	                          		window.location.href = window.location.href;
 	                          		$( this ).dialog( "close" );
 	                            }else{
 	                            	return false;
 	                          	}
							}
	        	        });
	        	    }
	        	});
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
	        
			jQuery(function(){
				view_dep();
				add_new_dep();
				_successContBox();
				update_information();
				dob_datepicker();
				//check_dep();
			});
       	</script>
<div class="footer-grp-btn">
 <!-- FOOTER-GRP-BTN START -->
 <a class="btn btn-gray left" href="javascript:history.go(-1);">BACK</a> 
 <!-- FOOTER-GRP-BTN END -->
 </div>