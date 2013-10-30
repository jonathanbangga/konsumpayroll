	<h1><?php echo $page_title;?></h1>
	<div class="main-content">
		<div class="tbl-wrap">
			<!-- company list -->
			<table class="tbl">
				<tbody>
				<tr>
				  <th style="width:165px;">Company Name</th>
				  <th style="width:165px">Sub Domain</th>
				  <th style="width:285px">Actions</th>
		
				</tr>
				<?php 
					if($companies) { 
						foreach($companies as $all_comp) :
				?>
						<tr class="jdel_wrap" id="jcomplist_<?php echo $all_comp->company_id;?>">
						  <td><?php echo $all_comp->company_name;?></td>
						  <td><?php echo $all_comp->sub_domain;?></td>
						  <td>
							  <a href="#" class="btn btn-action jcomp_view" set_id="<?php echo $all_comp->company_id;?>">VIEW</a> 
							  <a href="/admin/company_setup/edit/<?php echo $all_comp->company_id;?>" class="btn btn-gray btn-action jcomp_edit2" set_id="<?php echo $all_comp->company_id;?>">EDIT</a> 
							  <a href="#" class="btn btn-red btn-action jcomp_delete" set_id="<?php echo $all_comp->company_id;?>">DELETE</a>
						  </td>
						</tr>
			   <?php
						endforeach;
					}
			   ?>
			  </tbody>
			</table>
			<div id="paginative"><?php echo $pagi;?></div>
			<a class="btn" id="jlight_addcompany" href="#">ADD  USER</a>
		</div>	
	<!-- end company list -->
	</div>
	
	<div id="error" class="ihide"><?php echo validation_errors("<span>","</span><br />");?></div>
	<div class="ihide jpop_container" title="Add Company">
	<?php echo form_open("admin/company_setup/add",array("class"=>"company_reg jpopreg","onsubmit"=>"return kpay.admin.company.form_add_company('/admin/company_setup/add_company','".itoken_cookie()."')"));?>
	<table>
		<tbody>
		<tr>
			<td style="width:155px">Business Owner</td>
			<td>
				<select name="owner">
					<option value="">Please select owner</option>
					<?php 
						if($owners){
							foreach($owners as $rows){
								echo "<option value=\"{$rows->company_owner_id}\">{$rows->owner_name}</option>";
							}
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
		  <td>Company Name:</td>
		  <td><input type="text" value="<?php echo set_value('reg_business_name'); ?>" name="reg_business_name" class="txtfield"></td>
		</tr>
		<tr>
		  <td>Subscription Date:</td>
		  <td><input type="text" value="<?php echo date_today(); ?>" name="subscription_date" readonly="readonly" class="txtfield"></td>
		</tr>
		<tr>
		  <td>No of employees:</td>
		  <td><input type="text" value="<?php echo set_value('no_employees'); ?>" name="no_employees" class="txtfield"></td>
		</tr>
		<tr>
		  <td>Email Address:</td>
		  <td><input type="text" value="<?php echo set_value('email_add'); ?>" name="email_add" class="txtfield"></td>
		</tr>
		<tr>
		  <td>Office Phone Number:</td>
		  <td><input type="text" value="<?php echo set_value('business_phone'); ?>" name="business_phone" class="txtfield"></td>
		</tr>
		<tr>
		  <td>Office Mobile Number:</td>
		  <td><input type="text" value="<?php echo set_value('mobile_no'); ?>" name="mobile_no" class="txtfield"></td>
		</tr>
		<tr>
		  <td>Office Fax Number: </td>
		  <td><input type="text" value="<?php echo set_value('fax'); ?>" name="fax" class="txtfield"></td>
		</tr>
		<tr>
		  <td>Business Address:</td>
		  <td><input type="text" value="<?php echo set_value('business_address'); ?>" name="business_address" class="txtfield"></td>
		</tr>
		<tr>
		  <td>Business City:</td>
		  <td><input type="text" value="<?php echo set_value('city'); ?>" name="city" class="txtfield"></td>
		</tr>
		<tr>
		  <td>Business Province:</td>
		  <td><input type="text" value="<?php echo set_value('province'); ?>" name="province" class="txtfield"></td>
		</tr>
		<tr>
		  <td>Business Postcode:</td>
		  <td><input type="text" value="<?php echo set_value('zip_code'); ?>" name="zip_code" class="txtfield"></td>
		</tr>
		</tbody>
	</table>
	<input type="submit" name="submit" value="ADD" class="btn" id="jadd_companies">
	<?php echo form_close();?>
	</div>
	<!-- for popups -->
	<div class="ihide">
		<div class="view_company" title="Company profile">
			<table>
				<tbody>
					<tr>
						<td style="width:163px">Owner</td>
						<td>
							<div id="jowner"></div>
						</td>
					</tr>
					<tr>
						<td>Company Name:</td>
						<td>
							<div id="jregname"></div>
						</td>
					</tr>
					<tr>
						<td>Subscription Date:</td>
						<td>
							<div id="jsubscription_date"></div>
						</td>
					</tr>
					<tr>
						<td>No of employees:</td>
						<td>
							<div id="jno_employee"></div>
						</td>
					</tr>
					<tr>
						<td>Email Address:</td>
						<td>
							<div id="jemail"></div>
						</td>
					</tr>
					<tr>
						<td>Office Phone Number:</td>
						<td>
							<div id="jbpno"></div>
						</td>
					</tr>
					<tr>
						<td>Office Mobile Number:</td>
						<td>
							<div id="jmob"></div>
						</td>
					</tr>
					<tr>
						<td>Office Fax Number: </td>
						<td>
							<div id="jfax"></div>
						</td>
					</tr>
					<tr>
						<td>Business Address:</td>
						<td>
							<div id="jbus_add"></div>
						</td>
					</tr>
					<tr>
						<td>Business City:</td>
						<td>
							<div id="jcity"></div>
						</td>
					</tr>
					<tr>
						<td>Business Province:</td>
						<td>
							<div id="jprovince"></div>
						</td>
					</tr>
					<tr>
						<td>Business Postcode:</td>
						<td>
							<div id="jzip"></div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		<div class="jedit_compform" title="Update Company Information">
		
		<div id="error" class="ihide"><?php echo validation_errors("<span>","</span><br />");?></div>
		<?php echo form_open("admin/company_setup/status",array("class"=>"company_reg","onsubmit"=>"return kpay.admin.company.update_company('/admin/company_setup/add_company',".itoken_cookie().")"));?>
			<table>
				<tbody>
				<tr>
					<td style="width:155px">Owner</td>
					<td>
						<input type="hidden" id="ucomp_id" name="ucompid" />
						<select name="jowner" style="padding:5px;">
							<option value="">Please select owner</option>
							<?php 
								if($owners){
									foreach($owners as $rows){
										echo "<option value=\"{$rows->company_owner_id}\">{$rows->owner_name}</option>";
									}
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
				  <td>Company Name:</td>
				  <td><input type="text" value="<?php echo set_value('reg_business_name'); ?>" name="ureg_business_name"  id="ureg_business_name"class="txtfield"></td>
				</tr>
				<tr>
				  <td>Trade Name: </td>
				  <td><input type="text" value="<?php echo set_value('trade_name'); ?>" name="utrade_name" id="utrade_name" class="txtfield"></td>
				</tr>
				<tr>
				  <td>Business Address:</td>
				  <td><input type="text" value="<?php echo set_value('business_address'); ?>" name="ubusiness_address" id="ubusiness_address" class="txtfield"></td>
				</tr>
				<tr>
				  <td>City: </td>
				  <td><input type="text" value="<?php echo set_value('city'); ?>" name="ucity" id="ucity" class="txtfield"></td>
				</tr>
				<tr>
				  <td>Zip Code:</td>
				  <td><input type="text" value="<?php echo set_value('zip_code'); ?>" name="uzip_code" id="uzip_code" class="txtfield"></td>
				</tr>
				<tr>
				  <td>Organization Type:</td>
				  <td><input type="text" value="<?php echo set_value('org_type'); ?>" name="uorg_type" id="uorg_type" class="txtfield"></td>
				</tr>
				<tr>
				  <td>Industry: </td>
				  <td><input type="text" value="<?php echo set_value('industry'); ?>" name="uindustry" id="uindustry"  class="txtfield"></td>
				</tr>
				<tr>
				  <td>Business Phone:</td>
				  <td><input type="text" value="<?php echo set_value('business_phone'); ?>" name="ubusiness_phone" id="ubusiness_phone" class="txtfield"></td>
				</tr>
				<tr>
				  <td>Extension: </td>
				  <td><input type="text" value="<?php echo set_value('extension'); ?>" name="uextension" id="uextension"  class="txtfield"></td>
				</tr>
				<tr>
				  <td>Mobile Numer:</td>
				  <td><input type="text" value="<?php echo set_value('mobile_no'); ?>" name="umobile_no"  id="umobile_no" class="txtfield"></td>
				</tr>
				<tr>
				  <td>Fax: </td>
				  <td><input type="text" value="<?php echo set_value('fax'); ?>" name="ufax" id="ufax" class="txtfield"></td>
				</tr>
				</tbody>
			</table>
			<input type="submit" name="update" value="UPDATE" class="btn">
		<?php echo form_close();?>
		</div>
	</div>
	<!-- end popups -->
	
	<script type="text/javascript">
		jQuery(function(){
		kpay.admin.company.add_company();
		kpay.admin.company.delete_company("/admin/company_setup/delete","<?php echo itoken_cookie();?>");
		kpay.admin.company.show_view("/admin/company_setup/status","<?php echo itoken_cookie();?>");
		kpay.admin.company.update_company("/admin/company_setup/status","<?php echo itoken_cookie();?>");
		kpay.admin.company.popup_add_company("/admin/company_setup/status","<?php echo itoken_cookie();?>");
		
		});
	</script>