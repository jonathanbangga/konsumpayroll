	<!-- MAIN-CONTENT START -->
		<?php echo form_open("company/company_setup/add");?>
		<?php 
			echo $errors;
		?>	
        <div class="tbl-wrap">
	
          <!-- TBL-WRAP START -->
          <table>
            <tr>
              <td style="width:155px">Registered Business Name:</td>
              <td><input class="txtfield" name="company_name" type="text" value="<?php echo $company_info ? $company_info->company_name : "";?>" ></td>
            </tr>
            <tr>
              <td>Trade Name: </td>
              <td><input class="txtfield" name="trade_name" type="text" value="<?php echo $company_info ? $company_info->trade_name : "";?>" ></td>
            </tr>
            <tr>
              <td>Business Address:</td>
              <td><input class="txtfield" name="business_address" type="text" value="<?php echo $company_info ? $company_info->business_address : "";?>" ></td>
            </tr>
            <tr>
              <td>City: </td>
              <td><input class="txtfield" name="city" type="text" value="<?php echo $company_info ? $company_info->city : "";?>" ></td>
            </tr>
            <tr>
              <td>Zip Code:</td>
              <td><input class="txtfield" name="zipcode" type="text" value="<?php echo $company_info ? $company_info->zipcode : "";?>" ></td>
            </tr>
            <tr>
              <td>Organization Type:</td>
              <td>
				<input type="radio" value="government" name="organization_type">Government
				<input type="radio" value="private" name="organization_type">Private
				<input type="radio" value="non-profit organization" name="organization_type">Non-profit organization
			  
			  </td>
            </tr>
            <tr>
              <td>Industry: </td>
              <td><input class="txtfield" name="industry" type="text" value="<?php echo $company_info ? $company_info->industry : "";?>" ></td>
            </tr>
            <tr>
              <td>Office Phone:</td>
              <td><input class="txtfield" name="business_phone" type="text" value="<?php echo $company_info ? $company_info->business_phone : "";?>" ></td>
            </tr>
            
            <tr>
              <td>Mobile Phone:</td>
              <td><input class="txtfield" name="mobile_number" type="text" value="<?php echo $company_info ? $company_info->mobile_number : "";?>" ></td>
            </tr>
            <tr>
              <td>Fax: </td>
              <td><input class="txtfield" name="fax" type="text" value="<?php echo $company_info ? $company_info->fax : "";?>" ></td>
            </tr>
          </table>
          <!-- TBL-WRAP END -->
        </div>
		<input type="submit" name="next" class="btn" value="Next"/>
		<?php echo form_close();?>
	<!-- MAIN-CONTENT END -->