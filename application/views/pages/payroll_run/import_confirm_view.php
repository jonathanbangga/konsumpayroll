<?php
$attr = array("id"=>"jform");
echo form_open("/{$this->session->userdata('sub_domain2')}/payroll_run/timesheets/import_confirm",$attr); 
?>
<div class="main-content"> 
<!-- MAIN-CONTENT START -->
<p>Some time-in dates already exist and is in conflict with the existing time-in dates in the database.<br />
The dates are follows:</p>
<ul style="list-style-type: none;margin-bottom: 17px;">
	<?php foreach($conflict as $val){ ?>
		<li><?php echo $val; ?></li>
	<?php } ?>
</ul>
<p>Do you want to proceed? this will overwrite existing time in dates.</p>
<input type="button" name="Yes" id="btn_yes" class="btn" value="Yes" /> 
<input type="button" name="No" id="btn_no" class="btn" value="No" />
<input type="hidden" name="path_to_file" id="path_to_file" class="btn" value="<?php echo $path_to_file; ?>" />
<input type="hidden" name="hid_yes" id="hid_yes" value="0" />
<!-- MAIN-CONTENT END --> 
</div>
<?php
echo form_close(); 
?>
<script>
jQuery(document).ready(function(){

	// yes
	jQuery("#btn_yes").click(function(){
		jQuery("#hid_yes").val(1);
		jQuery("#jform").submit();
	});
	
	// no
	jQuery("#btn_no").click(function(){
		jQuery("#hid_yes").val(0);
		jQuery("#jform").submit();
	});

});
</script>

