	<!-- MAIN-CONTENT START -->
        <p>Input this form with the people you need to run the payroll process.<br>
          The person is responsible for confirming the payroll run before releasing the funds.</p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl">
            <tr>
              <th>Employee Number</th>
              <th style="width:170px">Name</th>
              <th>Level</th>
              <th style="width:160px">Action</th>
            </tr>
            <tr>
              <td>09-09090987</td>
              <td>Allan Villaon Vergara</td>
              <td>1</td>
              <td><a class="btn btn-gray btn-action" href="#">EDIT</a> <a class="btn btn-red btn-action" href="#">DELETE</a></td>
            </tr>
          </table>
          <!-- TBL-WRAP END -->
        </div>
        <input class="btn" name="" type="button" value="ADD APPROVER">
		<div class="jpop_approvers">
			<?php 
				echo form_open("",array("class"=>"we"));
				echo validation_errors("<span class='error_zone'>","</span>");
			?>
			<table>
				<tbody>
					<tr>
					  <td style="width:155px">Last Name:</td>
					  <td><input type="text" value="test" name="lname" class="txtfield"></td>
					</tr>
					<tr>
					  <td>First Name: </td>
					  <td><input type="text"  name="fname" class="txtfield"></td>
					</tr>
					<tr>
					  <td>Middle Name: </td>
					  <td><input type="text"  name="mname" class="txtfield"></td>
					</tr>
					<tr>
					  <td>Fax: </td>
					  <td><input type="text"  name="fax" class="txtfield"></td>
					</tr>
					<tr>
					  <td>Email: </td>
					  <td><input type="text"  name="email" class="txtfield"></td>
					</tr>
					<tr>
					  <td>Contact No: </td>
					  <td><input type="text"  name="contact_no" class="txtfield"></td>
					</tr>
					<tr>
					  <td>Username: </td>
					  <td><input type="text"  name="username" class="txtfield"></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" value="Save" name="submit" class="btn"></td>
					</tr>
			  </tbody>
			</table>
			<?php echo form_close();?>
		</div>
	<!-- MAIN-CONTENT END -->