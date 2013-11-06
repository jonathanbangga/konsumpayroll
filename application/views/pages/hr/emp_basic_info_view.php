<div class="tbl-wrap">
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
        	<a href="javascript:void(0);" class="btn left" onclick="addNewEmp();">DELETE</a>
        	<a href="javascript:void(0);" class="btn right" onclick="addNewEmp();">ADD ROW</a>
        	<div class="clearB"></div>
        </div>
        <div class="new_employee_contBox ihide" title="Add New Employee">
        	<table>
            <tbody><tr>
              <td style="width:155px">Registered Business Name:</td>
              <td><input type="text" value="Sample" name="" class="txtfield"></td>
            </tr>
            <tr>
              <td>Trade Name: </td>
              <td><input type="text" value="Sample" name="" class="txtfield"></td>
            </tr>
            <tr>
              <td>Business Address:</td>
              <td><input type="text" value="Sample" name="" class="txtfield"></td>
            </tr>
            <tr>
              <td>City: </td>
              <td><input type="text" value="Sample" name="" class="txtfield"></td>
            </tr>
            <tr>
              <td>Zip Code:</td>
              <td><input type="text" value="Sample" name="" class="txtfield"></td>
            </tr>
            <tr>
              <td>Organization Type:</td>
              <td><input type="text" value="Sample" name="" class="txtfield"></td>
            </tr>
            <tr>
              <td>Industry: </td>
              <td><input type="text" value="Sample" name="" class="txtfield"></td>
            </tr>
            <tr>
              <td>Business Phone:</td>
              <td><input type="text" value="Sample" name="" class="txtfield"></td>
            </tr>
            <tr>
              <td>Extension: </td>
              <td><input type="text" value="Sample" name="" class="txtfield"></td>
            </tr>
            <tr>
              <td>Mobile Numer:</td>
              <td><input type="text" value="Sample" name="" class="txtfield"></td>
            </tr>
            <tr>
              <td>Fax: </td>
              <td><input type="text" value="Sample" name="" class="txtfield"></td>
            </tr>
          </tbody></table>
        </div>
        <script>
        	function addNewEmp(){
        		/* jQuery(".new_employee_contBox").dialog({
        			width: 'inherit',
					draggable: false,
					modal: true,
					minWidth:'400',
					dialogClass:'transparent'
            	}); */

            	var tbl = "<tr>";
		        tbl += "<td></td>";
		        tbl += "<td><input type='text' name='' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='' class='txtfield'></td>";
		        tbl += "<td><input type='text' name='' class='txtfield'></td>";
	            tbl += "</tr>";
		              
	              // alert(tbl);
	              jQuery(".emp_conList").append(tbl);
			}
        </script>