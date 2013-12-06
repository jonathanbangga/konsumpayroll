<div class="main-content">
<div style="display:none;" class="highlight_message">Message</div>
        <!-- MAIN-CONTENT START -->
        <p>Select the basis of determining the column for compensation level when using the table based method.</p>
        <div>
		<?php
		if($wt_sql->num_rows()>0){
			$wt = $wt_sql->row();
			if($wt->compensation_type=="Net Taxable Compensation Income"){
				$sel1 = 'checked="checked"';
				$sel2 = '';
			}else{
				$sel1 = '';
				$sel2 = 'checked="checked"';
			}
		}else{
			$sel1 = "";
			$sel2 = "";
		}
		?>
          <table class="withholdingtax-imba" style="width:615px;">
            <tr>
              <td style="width:25px; vertical-align:top;"><input style="margin-top:2px;" class="withholding_tax" name="withholding_tax" type="radio" value="Net Taxable Compensation Income" <?php echo $sel1; ?> /></td>
              <td><p>Net Taxable Compensation Income. Uses all taxable income like basic pay (net of absences, tardiness and undertime), taxable fixed allowance, overtime pay, paid leave, holiday pay, hazard pay, night shift differential pay, commission, other taxable earnings and net of allowable deductions.</p></td>
            </tr>
            <tr>
              <td style="width:25px; vertical-align:top;"><input style="margin-top:2px;" class="withholding_tax" name="withholding_tax" type="radio" value="Regular Taxable Compenstation Income" <?php echo $sel2; ?> /></td>
              <td><p>Regular Taxable Compenstation Income. Uses basic pay (net of absences, tardiness, and undertime) and taxable fixed allowance, net of allowable deductions. The supplementary income like overtime pay, paid leave, holiday pay, hazard pay, night shift differential pay, commission, and other taxable earnings are not considered.</p></td>
            </tr>
          </table>
        </div>
		<a href="javascript:void(0);" class="btn" id="btn-save">SAVE</a>
        <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray left" href="#">BACK</a> <a class="btn btn-gray right" href="#"> CONTINUE</a>
        <!-- FOOTER-GRP-BTN END -->
      </div>
	  
<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>
	  
<script>
jQuery(document).ready(function(){
	
	// load highlight message script
	redirect_highlight_message();

	jQuery("#btn-save").click(function(){
	
		var comp = jQuery(".withholding_tax:checked").val();
		<?php 
		$url = ($wt_sql->num_rows()>0)?"ajax_update_withholding_tax":"ajax_set_withholding_tax"; 
		$msg = ($wt_sql->num_rows()>0)?"updated":"saved";
		?>	
		// ajax call
		jQuery.ajax({
			type: "POST",
			url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/withholding_tax/<?php echo $url; ?>",
			data: {
				comp: comp,
				<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
			}
		}).done(function(ret){
			jQuery.cookie("msg", "Withholding tax has been <?php echo $msg; ?>");
			window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/withholding_tax";
		});	
	
	});
	
});
</script>