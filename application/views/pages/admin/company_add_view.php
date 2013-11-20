	<h1><?php echo $page_title;?></h1>
	<div class="main-content">
		<div class="tbl-wrap">
			<!-- company list -->
			<?php echo form_open("#",array("onsubmit"=>"return company_department();"));?>
			<table class="tbl" id="add_dept_company">
				<tbody>
					<tr>
					  <th style="width:165px;">Departname Name</th>
					  <th style="width:165px">Owner</th>
					  <th style="width:285px">Actions</th>
					</tr>	
					<?php 
					if($companies) { 
						foreach($companies as $all_comp) :
					?>
						<tr class="jdel_wrap" id="jcomplist_<?php echo $all_comp->payroll_system_account_id;?>">
						  <td><?php echo $all_comp->name;?></td>
						  <td><?php echo $all_comp->account_id;?></td>
						  <td>
							  <a href="#" class="btn btn-action jcomp_view" psa_id="<?php echo $all_comp->payroll_system_account_id;?>">VIEW</a> 
							  <a href="/admin/company_setup/edit/<?php echo $all_comp->payroll_system_account_id;?>" class="btn btn-gray btn-action jcomp_edit" psa_id="<?php echo $all_comp->payroll_system_account_id;?>">EDIT</a> 
							  <a href="#" class="btn btn-red btn-action jcomp_delete" set_id="<?php echo $all_comp->payroll_system_account_id;?>">DELETE</a>
						  </td>
						</tr>
			   		<?php
						endforeach;
					}
			  	 	?>
			  	</tbody>
			</table>
			<div id="paginative"><?php echo $pagi;?></div>
			<br />
			<a class="btn" id="jlight_addcompany" href="#">ADD  USER</a>
			<input type="submit" value="SAVE" class="btn jadd_dept" name="add_owner_company">
			<?php echo form_close();?>
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
		
		<div class="jedit_compform" title="Update Department Information">
		<div id="error" class="ihide"><?php echo validation_errors("<span>","</span><br />");?></div>
		<?php echo form_open("admin/company_setup/status",array("class"=>"company_reg","onsubmit"=>"return update_department();"));?>
			<table>
				<tbody>
				<tr>
					<td style="width:124px">Owner</td>
					<td>
						<input type="hidden" id="psa_id" name="psa_id"/>
						<select name="jowner" style="padding:5px;width: 182px;">
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
				  <td>Department Name:</td>
				  <td>
					  <input type="text" value="" name="psa_name"  id="psa_name"class="txtfield" style="width: 164px;">
					  <input type="hidden" value="" name="old_psa_name"  id="old_psa_name" class="txtfield" style="width: 164px;">
				  </td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" name="update_dept" class="btn" value="UPDATE" />		
						<input type="submit" name="update_close" class="btn" value="CLOSE" />	
					</td>
				</tr>
				</tbody>
			</table>
		<?php echo form_close();?>
		</div>
	</div>
	<!-- end popups -->
	
	<script type="text/javascript">
		var itokens = "<?php echo itoken_cookie();?>";
		// APPEND depart company setup MAIN COMPANY
		function append_main_company(){
			var html = '<tr  class="jdeptdel_wrap">';
			html +='<td>';
			html +='<input type="text" class="emp_fields" name="name[]">';
			html +='</td>';
			html +='<td>';
			html +='<select name="owner[]" class="emp_fields">';
			html +='<option value=""></option>';
			html +="<?php echo $option_owners;?>"
			html +='</select>';
			html +='</td>';
			html +='<td>';
			html +='<a set_id="1" class="btn btn-red btn-action jcomp_delete2" href="#" style="width: 196px;">DELETE</a>';
			html +='</td>';
			html +='</tr>';
			jQuery(document).on("click","#jlight_addcompany",function(e){
				e.preventDefault();
				var el = jQuery(this);
				jQuery("#add_dept_company").append(html);
			});
		}
		// DELETE FuNCTION
		function delete_append_row(){
			jQuery(document).on("click",".jcomp_delete2",function(e){
				e.preventDefault();
				jQuery(this).parents("tr").remove();
			});
		}	

		// SAVE COMPANY DEPARTMENT
		function company_department(){
			var fields = {
			        "owner[]"   :array_fields("select[name='owner[]']"),
			        "name[]"    :array_fields("input[name='name[]']"),
			        "ZGlldmlyZ2luamM": jQuery.cookie(itokens),
			        "add_owner_company":true
			};
			ierror_field("select[name='owner[]']");
			ierror_field("input[name='name[]']");
			ierror_duplicate("input[name='name[]']");
			if(ierror_mark(".emp_fields") >0){
				return false;
			}else{
				var urls = "/admin/company_setup/add_company";
				kpay.overall.ajax_save(urls,fields);
			}
			return false;
		}

		// UPDATE COMPANY
		function update_department(){
			var psa_id 		= jQuery.trim(jQuery("input[id^='psa_id']").val());
			var dept_owner 	= jQuery.trim(jQuery("select[name='jowner']").val());
			var dept_name 	= jQuery.trim(jQuery("input[name='psa_name']").val());
			var old_psa_name = jQuery.trim(jQuery("input[name='old_psa_name']").val());	
			var urls 	= "/admin/company_setup/update_psa";
			var fields = {
					"psa_id":psa_id,
					"dept_owner":dept_owner,
					"dept_name":dept_name,
					"update_dept":"true",
					"ZGlldmlyZ2luamM": jQuery.cookie(itokens),
					"old_psa_name":old_psa_name
			};
			kpay.overall.ajax_save(urls,fields);
			return false;
		}
	
		jQuery(function(){
			append_main_company();
			delete_append_row();
			kpay.admin.company.add_company();
			kpay.admin.company.delete_company("/admin/company_setup/delete","<?php echo itoken_cookie();?>");
			kpay.admin.company.show_view("/admin/company_setup/status","<?php echo itoken_cookie();?>");
			kpay.admin.company.update_department("/admin/company_setup/status","<?php echo itoken_cookie();?>");
		//	kpay.admin.company.popup_add_company("/admin/company_setup/status","<?php echo itoken_cookie();?>");
		
		});
	</script>