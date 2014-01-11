<?php print form_open('','onsubmit="return validateForm()"');?>
<?php print $this->session->flashdata('message');?>
	  <div class="main-content">
        <!-- MAIN-CONTENT START -->
        
        <?php 
        	if($income_view != NULL){
        ?>
        	<div class="edit_cont">
	        	<p>Please select income applicable to all your employees</p>
	        	<div class="error_msg_cont"></div>
		        <p>
		        <input disabled type="hidden" name="edit_income_id" value="<?php print $income_view->income_id;?>" />
		        <input disabled type="checkbox" name="edit_income_basic_pay" value="Yes" <?php if($income_view->basic_pay=="Yes"){print 'checked="checked"';}?> /> Basic Pay</p>
		        <p><input disabled type="checkbox" name="edit_income_overtime" value="Yes" <?php if($income_view->overtime=="Yes"){print 'checked="checked"';}?> /> Overtime</p>
		        <p><input disabled type="checkbox" name="edit_income_fixed_allowance" value="Yes" <?php if($income_view->fixed_allowance=="Yes"){print 'checked="checked"';}?> /> Fixed Allowance</p>
		        <p><input disabled type="checkbox" name="edit_income_hpp" value="Yes" <?php if($income_view->holiday_premium_pay=="Yes"){print 'checked="checked"';}?> /> Holiday/Premium Pay</p>
		        <p><input disabled type="checkbox" name="edit_income_nsd" value="Yes" <?php if($income_view->night_shift_differential=="Yes"){print 'checked="checked"';}?> /> Night Shift Differential</p>
		        <p><input disabled type="checkbox" name="edit_income_commission" value="Yes" <?php if($income_view->commission=="Yes"){print 'checked="checked"';}?> /> Commission</p>
		        <p><input disabled type="checkbox" name="edit_income_piece_rate_pay" value="Yes" <?php if($income_view->piece_rate_pay=="Yes"){print 'checked="checked"';}?> /> Piece Rate Pay</p>
	        </div>
        <?php 
        	}else{
        ?>
        <div class="add_cont">
	        <p>Please select income applicable to all your employees</p>
	        <div class="error_msg_cont"></div>
	        <p><input type="checkbox" name="income_basic_pay" value="Yes" /> Basic Pay</p>
	        <p><input type="checkbox" name="income_overtime" value="Yes" /> Overtime</p>
	        <p><input type="checkbox" name="income_fixed_allowance" value="Yes" /> Fixed Allowance</p>
	        <p><input type="checkbox" name="income_hpp" value="Yes" /> Holiday/Premium Pay</p>
	        <p><input type="checkbox" name="income_nsd" value="Yes" /> Night Shift Differential</p>
	        <p><input type="checkbox" name="income_commission" value="Yes" /> Commission</p>
	        <p><input type="checkbox" name="income_piece_rate_pay" value="Yes" /> Piece Rate Pay</p>
        </div>
        <?php } ?>
        <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray left" href="javascript:history.go(-1);">BACK</a>
        <?php 
        	if($income_view != NULL){
        		print '<input class="btn right ihide update_btn" name="update" type="submit" value="UPDATE">';
        		print '<a class="btn right edit_btn" href="javascript:void(0);">Edit</a>';
        	}
        ?>
        <?php 
        	if($income_view == NULL){
				print '<input class="btn right" name="save" type="submit" value="SAVE">';        		
        	}
        ?>
        <!-- FOOTER-GRP-BTN END -->
      </div>
<?php print form_close();?>
<script>
	function validateForm(){
		<?php 
        	if($income_view == NULL){
        ?>
			if(!jQuery(".add_cont input:checkbox").is(":checked")){
				var income_val = "1";
			}
		<?php }else{ ?>
			if(!jQuery(".edit_cont input:checkbox").is(":checked")){
				var income_val = "1";
			}
		<?php } ?>

		if(income_val == "1"){
		    jQuery(".error_msg_cont").html("<p>- Please select income</p>");
		    return false;
		}
	}

	function edit_cont(){
		jQuery(".edit_btn").click(function(){
			jQuery(this).hide();
		    jQuery(".add_cont").hide();
		    jQuery(".edit_cont, .update_btn").fadeIn('100');
		    jQuery(".edit_cont input:checkbox").each(function(){
		        jQuery(this).removeAttr("disabled");
		    });
		});
	}

	function _successContBox(){
		var successContBox = jQuery.trim(jQuery(".successContBox").text());
		if(successContBox != ""){
		    jQuery(".successContBox").css("display","inline-block");
		    setTimeout(function(){
		        jQuery(".successContBox").fadeOut('100');
		    },3000);
		}
	}
	
	jQuery(function(){
		edit_cont();
		_successContBox();
	});
	
</script>