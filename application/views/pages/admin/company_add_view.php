	<h1><?php echo $page_title;?></h1>
	
	<!-- company list -->
	<table class="tbl">
        <tbody>
		<tr>
          <th style="width:165px;">Company Name</th>
          <th style="width:165px">Sub Domain</th>
          <th style="width:210px">Actions</th>
        </tr>
		<?php 
			if($companies) { 
				foreach($companies as $all_comp) :
		?>
				<tr class="jdel_wrap" id="jcomplist_<?php echo $all_comp->company_id;?>">
				  <td><?php echo $all_comp->registered_business_name;?></td>
				  <td>&nbsp;</td>
				  <td>
					  <a href="#" class="btn btn-action jcomp_view" set_id="<?php echo $all_comp->company_id;?>">VIEW</a> 
					  <a href="#" class="btn btn-gray btn-action jcomp_edit" set_id="<?php echo $all_comp->company_id;?>">EDIT</a> 
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
	<!-- end company list -->
	
	
	<div id="error" class="ihide"><?php echo validation_errors("<span>","</span><br />");?></div>
	<?php echo form_open("admin/company_setup/add",array("class"=>"company_reg"));?>
	<table>
		<tbody>
		<tr>
			<td style="width:155px">Owner</td>
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
		  <td >Registered Business Name:</td>
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
	
	<!-- for popups -->
	<div class="ihide">
		<div class="view_company" title="Company profile">
			<table>
				<tbody>
					<tr>
						<td style="width:130px">Owner</td>
						<td>
							<div id="jowner"></div>
						</td>
					</tr>
					<tr>
						<td>Business Name:</td>
						<td>
							<div id="jregname"></div>
						</td>
					</tr>
					<tr>
						<td>Trade Name:</td>
						<td>
							<div id="jtradename"></div>
						</td>
					</tr>
					<tr>
						<td>Business Address:</td>
						<td>
							<div id="jbus_add"></div>
						</td>
					</tr>
					<tr>
						<td>City:</td>
						<td>
							<div id="jcity"></div>
						</td>
					</tr>
					<tr>
						<td>Zip Code:</td>
						<td>
							<div id="jzip"></div>
						</td>
					</tr>
					<tr>
						<td>Organization Type:</td>
						<td>
							<div id="jorg"></div>
						</td>
					</tr>
					<tr>
						<td>Industry:</td>
						<td>
							<div id="jind"></div>
						</td>
					</tr>
					<tr>
						<td>Business Phone:</td>
						<td>
							<div id="jbpno"></div>
						</td>
					</tr>
					<tr>
						<td>Extension:</td>
						<td>
							<div id="jext"></div>
						</td>
					</tr>
					<tr>
						<td>Mobile Numer:</td>
						<td>
							<div id="jmob"></div>
						</td>
					</tr>
					<tr>
						<td>Fax:</td>
						<td>
							<div id="jfax"></div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<!-- end popups -->
	
	<script type="text/javascript">
		jQuery(function(){
		kpay.admin.company.add_company();
		kpay.admin.company.delete_company("/admin/company_setup/delete","<?php echo itoken_cookie();?>");
		kpay.admin.company.show_view("/admin/company_setup/update","<?php echo itoken_cookie();?>");
		});
	</script>