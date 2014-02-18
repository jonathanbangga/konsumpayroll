<div class="main-content">
<div style="display:none;" class="highlight_message">Message</div>
        <!-- MAIN-CONTENT START -->
        <p>Move employment type from left to right those that are applicable to your company. If there are employment <br>
          type your company has that are not on the list, click on add more button. </p>
          <p>To select multiple list hold ctrl key from
          your keyboard while selecting lists. Do not remove your finger on ctrl key until you're done with the selection.</p>
        <div class="employment-type-wrap">
          <!-- EMPLOYMENT-TYPE-WRAP START -->
          <div class="btn-move">
          	<a class="btn-move-left" href="javascript:void(0);" id="arrow-right">right</a>
            <a class="btn-move-right" href="javascript:void(0);" id="arrow-left">left</a>
          </div>
          <select id="area1" class="txtselect select-employement-type left" multiple="multiple" name="">
            <?php
			if($et->num_rows()>0){
				foreach($et->result() as $row){
				?>
					<option value="<?php echo $row->emp_type_id; ?>"><?php echo $row->name; ?></option>
				<?php
				}
			}
			?>
          </select>
          <select id="area2" class="txtselect select-employement-type right" multiple="multiple" name="">
			<?php
			if($aet->num_rows()>0){
				foreach($aet->result() as $row){
				?>
					<option value="<?php echo $row->emp_type_id; ?>"><?php echo $row->name; ?></option>
				<?php
				}
			}
			?>
          </select>
          <!-- EMPLOYMENT-TYPE-WRAP END -->
		  <div class="clearB"></div>
          <div style="margin-top: 20px;">
			<a class="btn" id="add-more" href="javascript:void(0);">ADD MORE</a> 
			<a class="btn" id="btn-delete" href="javascript:void(0);" style="display:none;">DELETE</a>
		  </div>
        </div>
        <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray right" href="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/department_and_positions">CONTINUE</a>
        <!-- FOOTER-GRP-BTN END -->
</div>

<div id="add-more-dialog" class="jdialog"  title="Add more">
	<div class="inner_div">
		Enter employment type name: 
		<div class="inner_field"><input type="text" class="txtfield employment_type" name="employment_type" /></div>
	</div>
</div>

<div id="confirm-delete-dialog" class="jdialog"  title="Add more">
	<div class="inner_div">
		Are you sure you want to delete?
	</div>
</div>


<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>
<script>
jQuery(document).ready(function(){

	// load highlight message script
	redirect_highlight_message();
	
	if(jQuery(".employment-type-wrap option").length>0){
		jQuery("#btn-delete").show();
	}

	// assign employment type
	jQuery("#arrow-right").click(function(){
		var et = new Array();
		var i= 0;
		jQuery("#area1 option:selected").each(function(){
			et[i] = jQuery(this).val();
			i++;
		});
		// ajax call
		jQuery.ajax({
			type: "POST",
			url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/employment_type/ajax_assign_employment_type",
			data: {
				et: et,
				selected:1,
				<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
			}
		});
		highlight_message("Changes saved!");
		jQuery("#area1 option:selected").appendTo("#area2");
	});
	jQuery("#arrow-left").click(function(){
		var et = new Array();
		var i= 0;
		jQuery("#area2 option:selected").each(function(){
			et[i] = jQuery(this).val();
			i++;
		});
		var cid = 0	; // company id
		// ajax call
		jQuery.ajax({
			type: "POST",
			url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/employment_type/ajax_assign_employment_type",
			data: {
				et: et,
				selected:0,
				<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
			}
		});
		highlight_message("Changes saved!");
		jQuery("#area2 option:selected").appendTo("#area1");
	});
	// add more
	jQuery("#add-more").click(function(){
		jQuery(".employment_type").val("");
		jQuery("#add-more-dialog .inner_field").html('<input type="text" class="txtfield employment_type" name="employment_type" />');
		jQuery("#add-more-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'add': function(){
					jQuery("#add-more-dialog .inner_field").append('<input type="text" class="txtfield employment_type" name="employment_type" />');
				},
				save: function() {
					var et = new Array();
					var i = 0;
					jQuery(".employment_type").each(function(index){
						if(jQuery(this).val()!=""){
							et[i] = jQuery(this).val();
							i++;
						}
					});

					if(et!=""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/employment_type/ajax_add_employment_type",
							data: {
								et: et, 
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
								jQuery.cookie("msg", "New employee type had been saved!");
								window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/employment_type";
						});
					}else{
						alert('Enter employment type');
					}	
			
				}
			},
		});
	});
	
	// delete employment type
	jQuery("#btn-delete").click(function(){
		var obj = jQuery(this);
		jQuery("#confirm-delete-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'yes': function() {
					var et_id = new Array();
					jQuery("select option:selected").each(function(index){
						et_id[index] = jQuery(this).val();
					});
					if(et_id!=""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/employment_type/ajax_delete_employment_type",
							data: {
								et_id: et_id,
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
							jQuery.cookie("msg", "Employee type has been deleted");
							window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/hr_setup/employment_type";
						});
					}else{
						alert('Employment type Id is missing');
					}					
				},
				'no': function() {
					jQuery(this).dialog( 'close' );					
				}
			}
		});
	});
	
});
</script>
