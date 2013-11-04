        <?php echo form_open("/company/government_registration/edit/".$this->uri->segment(4));?>
		<?php echo $error;
			echo $this->session->flashdata("success");
		?>
		<div class="tbl-wrap">
          <!-- TBL-WRAP START -->
			<table>
				<tr>
				  <td style="width:155px">TIN:</td>
				  <td><input class="txtfield" name="tin" type="text" value="<?php echo $company_info ? $company_info->tin : "";?>"></td>
				</tr>
				<tr>
				  <td>RDO:</td>
				  <td><input class="txtfield" name="rdo" type="text" value="<?php echo $company_info ? $company_info->rdo_code : "";?>" ></td>
				</tr>
				<tr>
				  <td>SSS ID:</td>
				  <td><input class="txtfield" name="sss_id" type="text" value="<?php echo $company_info ? $company_info->sss_id : "";?>" ></td>
				</tr>
				<tr>
				  <td>HDMF:</td>
				  <td><input class="txtfield" name="hdmf_id" type="text" value="<?php echo $company_info ? $company_info->hdmf : "";?>" ></td>
				</tr>
				<tr>
				  <td>PhilHealth: </td>
				  <td><input class="txtfield" name="philhealth_id" type="text" value="<?php echo $company_info ? $company_info->phil_health : "";?>" ></td>
				</tr>
				<tr>
				  <td>Category of your business:</td>
				  <td>
					<select name="category">
						<option value="">Please select</option>
						<?php 
							foreach($category as $categories):
							$iselect = ( $company_info &&  $company_info->category && $company_info->category ==$categories) ? 'selected="selected"' : '';				
							echo "<option value=\"{$categories}\" {$iselect}>{$categories}</option>";
							endforeach;
						?>
					</select>
				  </td>
				</tr>
			</table>
          <!-- TBL-WRAP END -->
        </div>
		<input type="submit" name="save" class="btn" value="save"/>
		<?php echo form_close();?>