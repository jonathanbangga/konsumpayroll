<div class="error_msg_cont"></div>
<?php print form_open('','onsubmit="return validate_form()"');?>
<div class="tbl-wrap">	
		  <?php print $this->session->flashdata('message');?>
          <!-- TBL-WRAP START -->
            <table style="width:1580px;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:50px;"></th>
              <th style="width:170px;">Employee Name</th>
              <th style="width:170px;">Employee Number</th>
              <th style="width:170px;">Date From</th>
              <th style="width:170px;">Date To</th>
              <th style="width:170px;">Course Name</th>
              <th style="width:170px;">Organizer</th>
              <th style="width:170px;">Cost</th>
              <th style="width:170px;">Training Hours</th>
              <th style="width:170px">Action</th>
            </tr>

            <?php 
            	if($employee_list != NULL){
            		$counter = 1;
            		foreach($employee_list as $row){
            ?>
	            <tr>
	              <td><?php print $counter++;?></td>
	              <td><?php print ucwords($row->first_name)." ".ucwords($row->last_name);?></td>
	              <td><?php print $row->payroll_cloud_id;?></td>
	              <td><?php print $row->date_from;?></td>
	              <td><?php print $row->date_to;?></td>
	              <td><?php print $row->course_name;?></td>
	              <td><?php print $row->organizer;?></td>
	              <td><?php print $row->cost;?></td>
	              <td><?php print $row->training_hours;?></td>
	              <td><a href="javascript:void(0);" class="btn btn-gray btn-action editBtnDb" attr_empid="<?php print $row->emp_id;?>">EDIT</a> <a href="javascript:void(0);" class="btn btn-red btn-action delBtnDb" attr_empid="<?php print $row->emp_id;?>">DELETE</a></td>
	            </tr>
            <?php 			
            		}
            	}else{
            		print "<tr class='msg_empt_cont'><td colspan='10' style='text-align:left;'>".msg_empty()."</td></tr>";
            	}
            ?>

          </tbody></table>
          <!-- TBL-WRAP END -->
        </div>
        <div class="pagiCont_btnCont">
        	<div class="left"><?php print $links;?></div>
        	<input type="submit" class="btn right addRowBtn" value="ADD ROW" onclick="javascript:return false;" />
        	<input type="submit" name="save" class="btn right ihide saveBtn" value="SAVE" />&nbsp;&nbsp;
        	<div class="clearB"></div>
        </div>
        <div class='del_msg ihide' title='Are you sure?'>Oooppss! Are you sure you want to delete this user?</div>
        <div class='editCont ihide' title='Edit Information'>
			  <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table width="100%">
            <tbody><tr>
              <td style="width:155px">Date From:</td>
              <td>
              <input type="text" value="" name="" class="txtfield emp_idEdit ihide" />
              <input type="text" value="" name="" readonly="readonly" class="txtfield dateFrom dateFromEdit"></td>
            </tr>
            <tr>
              <td>Date To: </td>
              <td><input type="text" value="" name="" readonly="readonly" class="txtfield dateTo dateToEdit"></td>
            </tr>
            <tr>
              <td>Course Name:</td>
              <td><input type="text" value="" name="" class="txtfield courseNameEdit"></td>
            </tr>
            <tr>
              <td>Organizer: </td>
              <td><input type="text" value="" name="" class="txtfield organizerEdit"></td>
            </tr>
            <tr>
              <td>Cost:</td>
              <td><input type="text" value="" name="" class="txtfield costEdit"></td>
            </tr>
            <tr>
              <td>Training Hours:</td>
              <td><input type="text" value="" name="" class="txtfield trainingHoursEdit"></td>
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
<script>
	function addNewEmp(size){
		var tbl = "<tr>";
	    tbl += "<td><input readonly='readonly' type='text' name='emp_id[]' class='ihide txtfield emp_id"+size+"' /></td>";
	    tbl += "<td><input type='text' name='emp_name[]' class='txtfield emp_name emp_name"+size+"' class_val='class_val"+size+"' attr_uname_val='"+size+"'></td>";
	    tbl += "<td><input readonly='readonly' type='text' name='emp_no[]' class='txtfield emp_no emp_no"+size+"' class_val='class_val"+size+"' attr_uname_val='"+size+"'></td>";
	    tbl += "<td><input type='text' name='dateFrom[]' class='txtfield dateFrom dateFrom"+size+"' id='dateFrom"+size+"'></td>";
	    tbl += "<td><input type='text' name='dateTo[]' class='txtfield dateTo dateTo"+size+"' id='dateTo"+size+"'></td>";
	    tbl += "<td><input type='text' name='coursename[]' class='txtfield coursename"+size+"'></td>";
	    tbl += "<td><input type='text' name='organizer[]' class='txtfield organizer"+size+"'></td>";
	    tbl += "<td><input type='text' name='cost[]' class='txtfield cost"+size+"'></td>";
	    tbl += "<td><input type='text' name='training_hours[]' class='txtfield training_hours"+size+"'></td>";
	    tbl +=  "<td><a href='javascript:void(0);' style='width:127px;' class='btn btn-red btn-action delRow' attr_rowno='"+size+"'>DELETE</a></td>";
	    tbl += "</tr>";
	          
	      // alert(tbl);
	      jQuery(".emp_conList").append(tbl);
	}

	function _addRowBtn(){
		jQuery(".addRowBtn").click(function(){
			jQuery("input[name='save']").css({
				"margin-right":"5px",
				"display":"inline"
				});
			// var size = jQuery(".dateFrom").length + 1;
			var size = shuffle_str("1234frds");
			addNewEmp(size);
			//_datepicker();
			_datePicker_AddRow();
			_name_listing();
			change_employee();
			remove_row();

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
	
	function _datepicker(){
		$( ".dateFrom" ).datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            onClose: function( selectedDate ) {
              $( ".dateTo" ).datepicker( "option", "minDate", selectedDate );
            },
            inline: true
        });
        
        $( ".dateTo" ).datepicker({
        	dateFormat: 'yy-mm-dd',
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            onClose: function( selectedDate ) {
              $( ".dateFrom" ).datepicker( "option", "maxDate", selectedDate );
            },inline: true
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

        	    show_error_msg();
        	    
    	    	if(jQuery(".emp_conList tr input:text").hasClass("emp_str")){
        	    	return false;
        	    }else{
					// saving data
					
        	    	//var _size = jQuery("input[name='emp_name[]']").length;
        	    	var _size = parseInt(jQuery("input[name='emp_name[]']").length) - 1;
					var emp_id_val = [];
					var emp_name_val = [];
					var emp_no_val = [];
					var dateFrom_val = [];
					var dateTo_val = [];
					var coursename_val = [];
					var organizer_val = [];
					var cost_val = [];
					var training_hours_val = [];
					//for(var z = 1; z <= _size; z++){
					for(var z = 0; z <= _size; z++){

						/*if(emp_id_val.indexOf(jQuery(".emp_id"+z).val())==-1){
							emp_id_val.push(jQuery(".emp_id"+z).val());

							emp_name_val.push(jQuery(".emp_name"+z).val());
							emp_no_val.push(jQuery(".emp_no"+z).val());
							dateFrom_val.push(jQuery(".dateFrom"+z).val());
							dateTo_val.push(jQuery(".dateTo"+z).val());
							coursename_val.push(jQuery(".coursename"+z).val());
							organizer_val.push(jQuery(".organizer"+z).val());
							cost_val.push(jQuery(".cost"+z).val());
							training_hours_val.push(jQuery(".training_hours"+z).val());
						}else{
							var str_val = 1;
							alert("The Employee Name must contain a unique value");
						}*/

						if(emp_id_val.indexOf(jQuery("input[name='emp_id[]']").eq(z).val())==-1){
							emp_id_val.push(jQuery("input[name='emp_id[]']").eq(z).val());
						}else{
							var str_val = 1;
							alert(" Employee Name should be unique");
						}
						
						emp_name_val.push(jQuery("input[name='emp_name[]']").eq(z).val());
						emp_no_val.push(jQuery("input[name='emp_no[]']").eq(z).val());
						dateFrom_val.push(jQuery("input[name='dateFrom[]']").eq(z).val());
						dateTo_val.push(jQuery("input[name='dateTo[]']").eq(z).val());
						coursename_val.push(jQuery("input[name='coursename[]']").eq(z).val());
						organizer_val.push(jQuery("input[name='organizer[]']").eq(z).val());
						cost_val.push(jQuery("input[name='cost[]']").eq(z).val());
						training_hours_val.push(jQuery("input[name='training_hours[]']").eq(z).val());
					}

					if(str_val == 1){
						return false;
					}
					
					var urls = window.location.href;
        	    	$.ajax({
						url: urls,
						type: "POST",
						data: {
							'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
							'emp_id[]': emp_id_val,
							'emp_name[]': emp_name_val,
							'emp_no[]': emp_no_val,
							'dateFrom[]': dateFrom_val,
							'dateTo[]': dateTo_val,
							'coursename[]': coursename_val,
							'organizer[]': organizer_val,
							'cost[]': cost_val,
							'training_hours[]': training_hours_val,
							'save':'true'
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
				    return false;
            	}
        	}


	function show_error_msg(){
		// show error msg
		var why = "";
		var why_emp_name = "";
		var why_emp_no = "";
		var why_dateFrom = "";
		var why_dateTo = "";
		var why_coursename = "";
		var why_organizer = "";
		var why_cost = "";
		var why_training_hours = "";
		
		for(var a=0;a<=100;a++){ // a = dummy
			var emp_name = jQuery("input[name='emp_name[]']").eq(a).val();
			var emp_no = jQuery("input[name='emp_no[]']").eq(a).val();
			var dateFrom = jQuery("input[name='dateFrom[]']").eq(a).val();
			var dateTo = jQuery("input[name='dateTo[]']").eq(a).val();
			var coursename = jQuery("input[name='coursename[]']").eq(a).val();
			var organizer = jQuery("input[name='organizer[]']").eq(a).val();
			var cost = jQuery("input[name='cost[]']").eq(a).val();
			var training_hours = jQuery("input[name='training_hours[]']").eq(a).val();

			if(emp_name == "") why_emp_name = 1;
			if(emp_no == "") why_emp_no = 1;
			if(dateFrom == "") why_dateFrom = 1;
			if(dateTo == "") why_dateTo = 1;
			if(coursename == "") why_coursename = 1;
			if(organizer == "") why_organizer = 1;
			if(cost == "") why_cost = 1;
			if(training_hours == "") why_training_hours = 1;
		}

		if(why_emp_name != "") why += "<p>- Please fill up Employee Name</p>";
		if(why_emp_no != "") why += "<p>- Please fill up Employee Number</p>";
		if(why_dateFrom != "") why += "<p>- Please fill up Date From</p>";
		if(why_dateTo != "") why += "<p>- Please fill up Date To</p>";
		if(why_coursename != "") why += "<p>- Please fill up Course Name</p>";
		if(why_organizer != "") why += "<p>- Please fill up Organizer</p>";
		if(why_cost != "") why += "<p>- Please fill up Cost</p>";
		if(why_training_hours != "") why += "<p>- Please fill up Training Hours</p>";

		if(why != ""){
			jQuery(".error_msg_cont").html(why);
			return false;
		}else{
			jQuery(".error_msg_cont").html("");
		}
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

	function _edit_information(){
		jQuery(".editBtnDb").on("click", function(){
			jQuery(".dateFromEdit, .dateToEdit").datepicker( 'hide' );
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
							jQuery(".emp_idEdit").val(status.emp_id);
							jQuery(".dateFromEdit").blur().empty().val(status.dateFromInfo);
							jQuery(".dateToEdit").empty().val(status.dateToInfo).blur();
							jQuery(".courseNameEdit").val(status.course_name);
							jQuery(".organizerEdit").val(status.organizer);
							jQuery(".costEdit").val(status.cost);
							jQuery(".trainingHoursEdit").val(status.training_hours);
							jQuery(".trainingHoursEdit").focus();
							jQuery("#ui-datepicker-div").hide();
                        }else{
							alert("- Invalid parameter");
							return false;
                        }
				}
			});
		});
	}

	function _datePicker_editInfo(){
		jQuery(".dateFromEdit").focus(function(){
			jQuery("#ui-datepicker-div").show();
		});
	}

	function _datePicker_AddRow(){
		/*jQuery("input[name='dateTo[]']").each(function(e){
		    var _this = jQuery(this);
		    _this.on("focus", function(){
		    	jQuery("#ui-datepicker-div").show();
		    	_datePicker_AddRowProcess_DTo(e);
		    });
		});
		
		jQuery("input[name='dateFrom[]']").each(function(e){
		    var _this = jQuery(this);
		    _this.on("focus", function(){
		    	jQuery("#ui-datepicker-div").show();
		    	_datePicker_AddRowProcess_DFrom(e);
		    });
		});*/

		$( ".dateFrom" ).datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            /*onClose: function( selectedDate ) {
            	jQuery("input[name='dateTo[]']").datepicker( "option", "minDate", selectedDate );
            },*/
            inline: true
        });

		 $( ".dateTo" ).datepicker({
        	dateFormat: 'yy-mm-dd',
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            /*onClose: function( selectedDate ) {
              jQuery("input[name='dateFrom[]']").datepicker( "option", "minDate", selectedDate );
            },*/
            inline: true
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

	function _update_information(){
		jQuery(".updateBtn").on("click", function(){
			var emp_idEdit = jQuery.trim(jQuery(".emp_idEdit").val());
		    var dateFromEdit = jQuery.trim(jQuery(".dateFromEdit").val());
		    var dateToEdit = jQuery.trim(jQuery(".dateToEdit").val());
		    var courseNameEdit = jQuery.trim(jQuery(".courseNameEdit").val());
		    var organizerEdit = jQuery.trim(jQuery(".organizerEdit").val());
		    var costEdit = jQuery.trim(jQuery(".costEdit").val());
		    var trainingHoursEdit = jQuery.trim(jQuery(".trainingHoursEdit").val());
		    var error = "";
		    if(dateFromEdit==""){
		        error = 1;
		        jQuery(".dateFromEdit").addClass('emp_str');
		    }else{
		        jQuery(".dateFromEdit").removeClass('emp_str');
		    }
		    
		    if(dateToEdit==""){
		        error = 1;
		        jQuery(".dateToEdit").addClass('emp_str');
		    }else{
		        jQuery(".dateToEdit").removeClass('emp_str');
		    }

		    if(courseNameEdit==""){
		        error = 1;
		        jQuery(".courseNameEdit").addClass('emp_str');
		    }else{
		        jQuery(".courseNameEdit").removeClass('emp_str');
		    }

		    if(organizerEdit==""){
		        error = 1;
		        jQuery(".organizerEdit").addClass('emp_str');
		    }else{
		        jQuery(".organizerEdit").removeClass('emp_str');
		    }

		    if(costEdit==""){
		        error = 1;
		        jQuery(".costEdit").addClass('emp_str');
		    }else{
		        jQuery(".costEdit").removeClass('emp_str');
		    }

		    if(trainingHoursEdit==""){
		        error = 1;
		        jQuery(".trainingHoursEdit").addClass('emp_str');
		    }else{
		        jQuery(".trainingHoursEdit").removeClass('emp_str');
		    }

		    if(error == 1){
				return false;
		    }else{
				// updating information
				$.ajax({
					url: window.location.href,
					type: "POST",
					data: {
						'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
						'update_info':'1',
						'emp_idEdit':emp_idEdit,
						'dateFromEdit':dateFromEdit,
						'dateToEdit':dateToEdit,
						'courseNameEdit':courseNameEdit,
						'organizerEdit':organizerEdit,
						'costEdit':costEdit,
						'trainingHoursEdit':trainingHoursEdit
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
		_name_listing();
		_delete_emp_fromDB();
		_edit_information();
		_datePicker_editInfo();
		_datepicker();
		_successContBox();
		_update_information();
		pagination();
		basic_file_li();
	});
</script>
<?php print form_close();?>
<div class="footer-grp-btn">
 <!-- FOOTER-GRP-BTN START -->
 <a class="btn btn-gray left" href="javascript:history.go(-1);">BACK</a> 
 <!-- FOOTER-GRP-BTN END -->
 </div>
