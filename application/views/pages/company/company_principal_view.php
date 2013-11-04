 	<!-- MAIN-CONTENT START -->
        <p>You can assign departments and employees to specific cost centers.<br>
          Specify the cost center and it's description.</p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl" style="width:100%">
            <tbody><tr>
              <th>Employee Number</th>
              <th style="width:130px">Name</th>
              <th>Level</th>
              <th style="width:150px">Email</th>
              <th style="width:90">Business Phone</th>
              <th style="width:90">Mobile Phone</th>
              <th style="width:153px">Action</th>
            </tr>
            <tr>
              <td>09-09090987</td>
              <td>Allan Villaon Vergara</td>
              <td>1</td>
              <td>Allan.Vergara@konsumtech.com</td>
              <td>987-9632-775</td>
              <td>987-9632-775</td>
              <td><a href="#" class="btn btn-gray btn-action">EDIT</a> <a href="#" class="btn btn-red btn-action">DELETE</a></td>
            </tr>
          </tbody>
         </table>
          <!-- TBL-WRAP END -->
        </div>
        <a href="#" class="btn" id="add_more_principal">ADD MORE PRINCIPAL</a>
        
        <!--  pops here  -->
        <?php echo $error . "we";?>
        <div class="ihide">
        	
			<div class="add_principal" title="Add Company Principal">
			<?php echo form_open("",array("onsubmit"=>""));?>
	        	<table>
				    <tbody>
				        <tr>
				            <td style="width:155px">Last Name:</td>
				            <td>
				                <input type="text" class="txtfield" name="lname" value="">
				            </td>
				        </tr>
				        <tr>
				            <td>First Name:</td>
				            <td>
				                <input type="text" class="txtfield" name="fname">
				            </td>
				        </tr>
				        <tr>
				            <td>Middle Name:</td>
				            <td>
				                <input type="text" class="txtfield" name="mname">
				            </td>
				        </tr>
				        <tr>
				            <td>Fax:</td>
				            <td>
				                <input type="text" class="txtfield" name="fax">
				            </td>
				        </tr>
				        <tr>
				            <td>Email:</td>
				            <td>
				                <input type="text" class="txtfield" name="email">
				            </td>
				        </tr>
				        <tr>
				            <td>Contact No:</td>
				            <td>
				                <input type="text" class="txtfield" name="contact_no">
				            </td>
				        </tr>
				       <tr>
				            <td>Payroll Cloud Id:</td>
				            <td>
				                <input type="text" class="txtfield" name="payroll_cloud_id">
				            </td>
				        </tr>
				        <tr>
				            <td>&nbsp;</td>
				            <td>
				                <table>
				                    <tr>
				                        <td style="width: 73px;">
				                            <input type="submit" class="btn" name="submit" value="Save">
				                        </td>
				                        <td>
				                            <input type="button" class="btn add_principal_cancel" name="cancel" value="Cancel">
				                        </td>
				                    </tr>
				                </table>
				            </td>
				        </tr>
				    </tbody>
				</table>
			<?php echo form_close();?>
			</div>
        </div>
        <!-- end pops here -->
	<!-- MAIN-CONTENT END -->
<script type="text/javascript">
	jQuery(function(){
		kpay.owner.principal.add_company_principal();
	});
</script>