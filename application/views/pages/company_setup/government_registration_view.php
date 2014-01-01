
        <?php echo form_open("/company/company_setup/government_registration/index",array("onsubmit"=>"return submit_gov();"));?>
		<?php echo $error;
			if($this->session->flashdata("success")){
				echo "<div class=\"successContBox highlight_message\">{$this->session->flashdata("success")}</div>";
			}
		?>
		<div class="tbl-wrap">
          <!-- TBL-WRAP START -->
			<table>
				<tr>
				  <td style="width:155px">TIN:</td>
				  <td>
				  <input class="txtfield jfields_capture" id="tin" name="tin" type="text" placeholder="xxx-xxx-xxx-xxx" value="<?php echo $company_info ? $company_info->tin : "";?>"> 
				  </td>
				</tr>
				<tr>
				  <td>RDO:</td>
				  <td><input class="txtfield jfields_capture" id="rdo" name="rdo" type="text"  placeholder="xxx"  value="<?php echo $company_info ? $company_info->rdo_code : "";?>" ></td>
				</tr>
				<tr>
				  <td>SSS ID:</td>
				  <td><input class="txtfield jfields_capture"  id="sss_id" name="sss_id" type="text" placeholder="xx-xxxxxxx-x"  value="<?php echo $company_info ? $company_info->sss_id : "";?>" ></td>
				</tr>
				<tr>
				  <td>HDMF:</td>
				  <td><input class="txtfield jfields_capture"  id="hdmf_id"  name="hdmf_id" type="text"  placeholder="xxxx-xxxx-xxxx"  value="<?php echo $company_info ? $company_info->hdmf : "";?>" ></td>
				</tr>
				<tr>
				  <td>PhilHealth: </td>
				  <td><input class="txtfield jfields_capture"  id="philhealth_id"  name="philhealth_id" type="text" placeholder="xx-xxxxxxxxx-x"  value="<?php echo $company_info ? $company_info->phil_health : "";?>" ></td>
				</tr>
				<tr>
				  <td>Category of your business:</td>
				  <td>
					<select name="category" class="emp_fields">
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
		<script type="text/javascript"  src="/assets/theme_2013/js/mask.js"></script>
		<script type="text/javascript">
			// MASKEDALL FORMATS ON EVERY INPUT
			function masking_format(){
				$('#tin').mask('999-999-999-999');
				$('#rdo').mask('999');
				$('#sss_id').mask('99-9999999-9');
				$('#hdmf_id').mask('9999-9999-9999');
				$('#philhealth_id').mask('99-999999999-9');
			}
			// SUBMIT GOVERNMENT CONFIDENTIALS SSS,PHILHEALTH ETC
			function submit_gov(){
				var tin = jQuery("#tin").val();
				var rdo = jQuery("#rdo").val();
				var sss_id = jQuery("#sss_id").val();
				var hdmf_id = jQuery("#hdmf_id").val();
				var philhealth_id = jQuery("#philhealth_id").val();
				var category = jQuery("select[name='category'] option:selected").val();
				var why = "";
				
				if(tin == "") why +="Tin number is required <br />";
				if(rdo == "") why +="RDO number is required <br />";
				if(sss_id =="")why +="SSS number is required <br />";
				if(hdmf_id =="")why +="HDMF number is required <br />";
				if(philhealth_id =="")why +="PHILHEALTH number is required <br />";
				if(category =="") why +="Category of your business is required";
				if(why !=""){
					alert(why);
					return false;
				}else{
					return true;
				}				
				return false;
			}
			
			jQuery(function(){
				masking_format();
			});
		</script>