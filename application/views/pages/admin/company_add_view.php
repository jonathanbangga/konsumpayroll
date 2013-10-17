	<h1><?php echo $page_title;?></h1>
	<div id="error" class="ihide"><?php echo validation_errors("<span>","</span><br />");?></div>
	<?php echo form_open("admin/company_setup/add",array("class"=>"company_reg"));?>
	<table>
		<tbody>
		<tr>
		  <td style="width:155px">Registered Business Name:</td>
		  <td><input type="text" value="<?php echo set_value('reg_business_name'); ?>" name="reg_business_name" class="txtfield"></td>
		</tr>
		<tr>
		  <td>Trade Name: </td>
		  <td><input type="text" value="<?php echo set_value('trade_name'); ?>" name="trade_name" class="txtfield"></td>
		</tr>
		<tr>
		  <td>Business Address:</td>
		  <td><input type="text" value="<?php echo set_value('business_address'); ?>" name="business_address" class="txtfield"></td>
		</tr>
		<tr>
		  <td>City: </td>
		  <td><input type="text" value="<?php echo set_value('city'); ?>" name="city" class="txtfield"></td>
		</tr>
		<tr>
		  <td>Zip Code:</td>
		  <td><input type="text" value="<?php echo set_value('zip_code'); ?>" name="zip_code" class="txtfield"></td>
		</tr>
		<tr>
		  <td>Organization Type:</td>
		  <td><input type="text" value="<?php echo set_value('org_type'); ?>" name="org_type" class="txtfield"></td>
		</tr>
		<tr>
		  <td>Industry: </td>
		  <td><input type="text" value="<?php echo set_value('industry'); ?>" name="industry" class="txtfield"></td>
		</tr>
		<tr>
		  <td>Business Phone:</td>
		  <td><input type="text" value="<?php echo set_value('business_phone'); ?>" name="business_phone" class="txtfield"></td>
		</tr>
		<tr>
		  <td>Extension: </td>
		  <td><input type="text" value="<?php echo set_value('extension'); ?>" name="extension" class="txtfield"></td>
		</tr>
		<tr>
		  <td>Mobile Numer:</td>
		  <td><input type="text" value="<?php echo set_value('mobile_no'); ?>" name="mobile_no" class="txtfield"></td>
		</tr>
		<tr>
		  <td>Fax: </td>
		  <td><input type="text" value="<?php echo set_value('fax'); ?>" name="fax" class="txtfield"></td>
		</tr>
		</tbody>
	</table>
	<input type="submit" name="submit" value="ADD" class="btn">
	<?php echo form_close();?>
	<script type="text/javascript">
		jQuery(function(){
		kpay.admin.company.add_company();
		});
	
	</script>