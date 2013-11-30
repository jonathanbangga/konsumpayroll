<div class="main-content">
<div style="display:none;" class="highlight_message">Message</div>
        <!-- MAIN-CONTENT START -->
		<?php
		$monetized_unused_leave = -1;
		$daily_meal_allowance = "";
		$ceiling = "";
		if($sql_dm->num_rows()>0){
			$dm = $sql_dm->row();
			$monetized_unused_leave = $dm->monetized_unused_leave;
			$daily_meal_allowance = $dm->daily_meal_allowance;
			$ceiling = $dm->ceiling;
		}
		?>
        <p>Specify the items to be included as de minimis benefits not subject to income tax.<br>
        Also specify the ceiling amount for annualization purposes.</p>
        
        <p>
			Monetized Unused Leave 
			<select class="txtselect" id="monetized_unused_leave" style="width: 80px;">
				<option value="-1" <?php if($monetized_unused_leave==-1){ echo 'selected="selected"'; } ?>>Select</option>
				<option value="1" <?php if($monetized_unused_leave==1){ echo 'selected="selected"'; } ?>>Yes</option>
				<option value="0" <?php if($monetized_unused_leave==0){ echo 'selected="selected"'; } ?>>No</option>
			</select>
		</p>
        
        <p>
			Daily meal allowance for overtime work (% based from the basic minimum wage) 
			<input style="margin-left:15px;" id="daily_meal_allowance" class="txtfield" name="" type="text" value="<?php echo $daily_meal_allowance ?>" />
		</p>
        
        <p>Any excess in non taxable amount of de minimis benefits will be included to the ceiling for other<br>

earnings and benefits.Specify the ceiling for non taxable earnings and benefits<br>

for annual withholding tax per year<br>
<br>
<input class="txtfield" id="ceiling" name="" type="text" value="<?php echo $ceiling ?>" />

</p>

<input style="margin-right:10px;" class="btn left" name="" type="button" id="btn-save" value="SAVE">

        
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
		var mul = jQuery("#monetized_unused_leave").val();
		var dma = jQuery("#daily_meal_allowance").val();
		var ceiling = jQuery("#ceiling").val();
		<?php 
		if($sql_dm->num_rows()>0){ ?>
			jQuery.ajax({
				type: "POST",
				url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/de_minimis/ajax_update_de_minimiss",
				data: {
					mul: mul,
					dma: dma,
					ceiling: ceiling,
					<?php echo itoken_name(); ?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
				}
			}).done(function(ret){
				jQuery.cookie("msg", "De minimiss has been updated");
				window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/de_minimis";
			});
		<?php
		}else{ ?>
			jQuery.ajax({
				type: "POST",
				url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/de_minimis/ajax_add_de_minimiss",
				data: {
					mul: mul,
					dma: dma,
					ceiling: ceiling,
					<?php echo itoken_name(); ?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
				}
			}).done(function(ret){
				jQuery.cookie("msg", "De minimiss has been saved");
				window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/de_minimis";
			});
		<?php
		} ?>
		
	});	
});
</script>