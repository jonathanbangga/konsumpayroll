<div class="main-content">
        <!-- MAIN-CONTENT START -->
        <p>Move employment type from left to right those that are applicable to your company. If there are employment <br>
          type your company has that are not on the list, click on add type button. To select multiple list hold ctrl key from<br>
          your keyboard while selecting lists. Do not remove your finger on ctl key until you're done with the selection.</p>
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
          </select>
          <!-- EMPLOYMENT-TYPE-WRAP END -->
          <div class="clearB">
          <a class="btn" id="add-more" href="javascript:void(0);">ADD MORE</a>          </div>
        </div>
        <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray right" href="/company/hr_setup/department_and_positions">CONTINUE</a>
        <!-- FOOTER-GRP-BTN END -->
</div>

<div id="add-more-dialog" class="jdialog"  title="Add more">
	<div class="inner_div">
		Enter employment type name: 
		<input type="text" id="employment_type" name="employment_type" />
	</div>
</div>
<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script>
jQuery(document).ready(function(){
	// assign employment type
	jQuery("#arrow-right").click(function(){
		jQuery("#area1 option:selected").appendTo("#area2")
	});
	jQuery("#arrow-left").click(function(){
		jQuery("#area2 option:selected").appendTo("#area1")
	});
	// add more
	jQuery("#add-more").click(function(){
		jQuery("#add-more-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				save: function() {
					var et = jQuery("#employment_type").val();
					if(et!=""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/company/hr_setup/employment_type/ajax_add_employment_type",
							data: {
								et: et, 
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
							if(ret==1){
								window.location="/company/hr_setup/employment_type";
							}
						});
					}else{
						alert('Enter employment type');
					}					
				}
			},
		});
	});
});
</script>