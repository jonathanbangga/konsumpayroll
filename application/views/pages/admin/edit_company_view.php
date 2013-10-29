	<h1><?php echo $page_title;?></h1>
	<div class="main-content">
	<?php
	echo $error;
	echo $this->session->flashdata("success");
	?>
		<div class="tbl-wrap">
<?php echo form_open("admin/company_setup/edit/".$this->uri->segment(4),array("class"=>"company_reg","onsubmit"=>"return kpay.admin.company.update_company('/admin/company_setup/status',".itoken_cookie().")"));?>
			<table>
				<tbody>
				<tr>
					<td style="width:155px">Owner</td>
					<td>
						<input type="hidden" id="ucomp_id" name="ucompid" value="<?php echo $this->uri->segment(4);?>" />
						
						<select name="jowner" style="padding:5px;">
							<option value="">Please select owner</option>
							<?php 
								if($owners){
									foreach($owners as $rows){
										$iselect = ($rows->company_owner_id == $company_info-> company_owner_id) ? "selected='selected'" : "";
										echo "<option value=\"{$rows->company_owner_id}\" {$iselect}>{$rows->owner_name}</option>";
									}
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
				  <td>Company Name:</td>
				  <td>
				  <input type="hidden" value="<?php echo $company_info->company_name;?>" name="old_company_name"  id="company_name"class="txtfield">
				  <input type="text" value="<?php echo $company_info->company_name;?>" name="company_name"  id="company_name"class="txtfield"></td>
				</tr>
				<tr>
				  <td>Trade Name: </td>
				  <td><input type="text" value="<?php echo $company_info->trade_name;?>" name="utrade_name" id="utrade_name" class="txtfield"></td>
				</tr>
				<tr>
				  <td>Business Address:</td>
				  <td><input type="text" value="<?php echo $company_info->business_address;?>" name="ubusiness_address" id="ubusiness_address" class="txtfield"></td>
				</tr>
				<tr>
				  <td>City: </td>
				  <td><input type="text" value="<?php echo $company_info->city;?>" name="ucity" id="ucity" class="txtfield"></td>
				</tr>
				<tr>
				  <td>Zip Code:</td>
				  <td><input type="text" value="<?php echo $company_info->zipcode;?>" name="uzip_code" id="uzip_code" class="txtfield"></td>
				</tr>
				<tr>
				  <td>Organization Type:</td>
				  <td><input type="text" value="<?php echo $company_info->organization_type;?>" name="uorg_type" id="uorg_type" class="txtfield"></td>
				</tr>
				<tr>
				  <td>Industry: </td>
				  <td><input type="text" value="<?php echo $company_info->industry;?>" name="uindustry" id="uindustry"  class="txtfield"></td>
				</tr>
				<tr>
				  <td>Business Phone:</td>
				  <td><input type="text" value="<?php echo $company_info->business_phone;?>" name="ubusiness_phone" id="ubusiness_phone" class="txtfield"></td>
				</tr>
				<tr>
				  <td>Extension: </td>
				  <td><input type="text" value="<?php echo $company_info->extension;?>" name="uextension" id="uextension"  class="txtfield"></td>
				</tr>
				<tr>
				  <td>Mobile Numer:</td>
				  <td><input type="text" value="<?php echo $company_info->mobile_number;?>" name="umobile_no"  id="umobile_no" class="txtfield"></td>
				</tr>
				<tr>
				  <td>Fax: </td>
				  <td><input type="text" value="<?php echo $company_info->fax;?>" name="ufax" id="ufax" class="txtfield"></td>
				</tr>
				</tbody>
			</table>
			<input type="submit" name="update" value="UPDATE" class="btn">
		<?php echo form_close();?>
		</div>
	</div>