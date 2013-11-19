	<!-- MAIN-CONTENT START -->
		<?php echo form_open_multipart("company/company_setup/company_information/index");?>
		<div class="error_message ihide" id="error_sections_reg">
		<?php  echo $errors; ?>	
		</div>
		
        <div class="tbl-wrap">
	
          <!-- TBL-WRAP START -->
          <table>
            <tr>
              <td style="width:155px">Registered Business Name:</td>
              <td>
              	<input class="txtfield" name="old_company_name" type="hidden" value="<?php echo $company_info ? $company_info->company_name : "";?>" >
              	<input class="txtfield" name="company_name" type="text" value="<?php echo $company_info ? $company_info->company_name : "";?>" >
              	<input type="hidden" name="subdomain" status="<?php echo $this->company_id;?>" value="<?php echo  $company_info ? $company_info->sub_domain : '';?>"/>
              </td>
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
				<?php 
					$select_org_type = $company_info ? $company_info->organization_type : "";
					$org_type_selection = array("government","private","non-profit organization");
					foreach($org_type_selection as $otypekey=>$otypeval):
					
					$state_check = $select_org_type == $otypeval ? "checked=\"checked\"": '';
					echo "&nbsp;<input type=\"radio\" value=\"{$otypeval}\" name=\"organization_type\" {$state_check}> ".$otypeval;
					endforeach;
				?>
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
            <tr>
              <td>Logo: </td>
              <td>
              <input type="hidden" name="upload_image" value="<?php echo $company_info ? $company_info->company_logo : ''?>" />
              <input class="txtfields cssupload" name="upload" type="file" value="" >
              	
              </td>
            </tr>
          </table>
          <!-- TBL-WRAP END -->
        </div>
		<input type="submit" name="next" class="btn" value="Next"/>
		<?php echo form_close();?>
	<!-- MAIN-CONTENT END -->
	
	<script type="text/javascript">
		// CREATE SUB DOMAIN
		function create_subdomain(){
			jQuery("input[name='company_name']").keyup(function(){
			    var v = jQuery.trim(jQuery(this).val());
			    var clean = v.replace(/\s/g, '');
				var check_add_update = jQuery("input[name='subdomain']").attr("status");
			    	jQuery("input[name='subdomain']").val(clean);
			});
		}

		// CHECK ERRORS ON SUBMISSION
		function have_error(){
			var error = jQuery.trim(jQuery("#error_sections_reg").text());
			if(error !=""){
				alert(jQuery("#error_sections_reg").html());
			}
		}

		jQuery(function(){
			create_subdomain();
		});
		jQuery(window).load(function(){
			have_error();
		});
	</script>