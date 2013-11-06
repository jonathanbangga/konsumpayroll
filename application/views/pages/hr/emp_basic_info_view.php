<?php print form_open('','onsubmit="return validateForm()"');?>
<div class="tbl-wrap">	
		  <div class="successContBox ihide"><?php print $this->session->flashdata('message');?></div>
          <!-- TBL-WRAP START -->
          <table style="width:2155px;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:40px;"></th>
              <th style="width:125px;">Employee Number</th>
              <th style="width:115px;">Last Name</th>
              <th style="width:115px;">First Name</th>
              <th style="width:115px;">Middle Name</th>
              <th style="width:115px;">Birth Date</th>
              <th style="width:115px;">Gender</th>
              <th style="width:115px;">Marital Status</th>
              <th style="width:115px;">Address</th>
              <th style="width:115px;">Contact Number</th>
              <th style="width:115px;">TIN</th>
              <th style="width:115px;">SSS</th>
              <th style="width:115px;">HDMF</th>
              <th style="width: 132px;">No. of Qualified Dependents</th>
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
	              <td></td>
	              <td><?php print $row->tin;?></td>	
	              <td><?php print $row->sss;?></td>
	              <td><?php print $row->hdmf;?></td>
	              <td></td>
	            </tr>
            <?php 			
            		}
            	}
            ?>
          </tbody></table>
          <!-- TBL-WRAP END -->
        </div>
        <div>
        	<input type="submit" class="btn left" value="DELETE" onclick="javascript:return false;"/>
        	<input type="submit" class="btn right addRowBtn" value="ADD ROW" onclick="javascript:return false;" />
        	<input type="submit" name="add" class="btn right" value="SAVE" />
        	<div class="clearB"></div>
        </div>
<?php print form_close();?>
        <script>
        	function addNewEmp(size){
            	var tbl = "<tr>";
		        tbl += "<td></td>";
		        tbl += "<td><input type='text' name='uname[]' class='txtfield'></td>";
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
		        tbl += "<td><input type='text' name='no_dependents' class='txtfield'></td>";
	            tbl += "</tr>";
		              
	              // alert(tbl);
	              jQuery(".emp_conList").append(tbl);
			}

        	function addRowBtn(){
				jQuery(".addRowBtn").click(function(){
					var size = jQuery(".dob").length + 1;
					addNewEmp(size);
					dob_datepicker();
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
        	    
				if(jQuery(".emp_conList tr input:text").hasClass("emp_str")){
        	    	return false;
        	    }
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
				    jQuery(".successContBox").css("display","block");
				    setTimeout(function(){
				        jQuery(".successContBox").fadeOut('100');
				    },3000);
				}
			}
			
			jQuery(function(){
				addRowBtn();
				_successContBox();
			});
        </script>