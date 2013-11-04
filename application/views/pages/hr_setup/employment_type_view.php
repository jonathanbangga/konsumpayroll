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
        <a class="btn btn-gray left" href="#">BACK</a> <a class="btn btn-gray right" href="#">CONTINUE</a>
        <!-- FOOTER-GRP-BTN END -->
</div>

<div id="add-more-dialog" title="Add more">
	<div id="et-div">
		Employment type: 
		<input type="text" name="employment_type" />
	</div>
</div>
<style>
#add-more-dialog #et-div{
	margin-top: 15px;
}
#add-more-dialog input{
	height: 25px;
	margin-top: 12px;
	width: 160px;
}
.ui-dialog-buttonpane{
	border-top: none;
}
</style>
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
				submit: function() {
					//jQuery( this ).dialog( "close" );
					console.log('save');
				}
			},
		});
	});
});
</script>
