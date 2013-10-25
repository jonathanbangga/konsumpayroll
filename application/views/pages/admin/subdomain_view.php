<h1><?php echo $page_title;?></h1>
	<div class="main-content">
		<p>Choose your subdomain for the specific site</p>
		<div class="ihide">
			<div class="errors"><?php  echo $error;?></div>
			<div class="success"><?php echo $this->session->flashdata("success");?></div>
		</div>
		<div class="tbl-wrap">
			<?php echo form_open("admin/subdomain/index/",array("class"=>"choose_company"));?>
			<table>
				<tbody>
					<tr>
						<td style="width:155px">Choose Company</td>
						<td>
							<select id="company" name="company">
								<option value="">Select Company</option>
								<?php
								if($company){
									foreach($company as $comps):
									echo "<option value=\"{$comps->company_id}\">{$comps->company_name}</option>";
									endforeach;
								}?>								
							</select>				
						</td>
					</tr>
					<tr>
					<td>Create Subdomain</td>
						<td><input type="text" class="txtfield" name="subdomain" value="<?php echo set_value('subdomain');?>"></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" class="btn" value="ADD" name="submit"></td>
					</tr>
				</tbody>
			</table>
			<?php echo form_close();?>			
		</div>
	</div>
	<script type="text/javascript">
		function errors(){
			var er = jQuery.trim(jQuery(".errors").html());
			if(er){
				alert(er);
			}
		}
		function success(){
			var er = jQuery.trim(jQuery(".success").html());
			if(er){
				alert(er);
			}
		}
		
		jQuery(function(){
			errors();
			success();
			kpay.admin.subdomain.select_company("/admin/subdomain/select_company","<?php echo itoken_cookie();?>");
		});
	</script>