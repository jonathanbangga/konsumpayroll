<div class="main-content">
        <!-- MAIN-CONTENT START -->
        <p>To generate payroll reports by department, select the department from the list and click arrow right otherwise<br>
          add department if it still doesn't exist.</p>
        <div class="tbl-wrap department-wrap">
          <!-- TBL-WRAP START -->
          <ul id="deptnpos">
            <li>
              <header>Departments</header>
              <div class="dept-box">
                <ul>
                <?php
				if($departments->num_rows()>0){
					foreach($departments->result() as $row){ 
				?>
						<li class="li_dept">
							<label>
								<input class="dept_id right" name="dept_id[]" type="checkbox" value="<?php echo $row->dept_id ?>">
								<span class="dept_name"><?php echo $row->department_name; ?></span>
							</label>
						</li>	  
					<?php
					}
				}
				?>
                </ul>
              </div>
              <a class="btn" href="javascript:void(0);" id="add-more-dept">ADD DEPARTMENT</a> 
			</li>
          </ul>
          <div class="clearB"></div>
          <!-- TBL-WRAP END -->
        </div>
        <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray left" href="#">BACK</a> <a class="btn btn-gray right" href="#">CONTINUE</a>
        <!-- FOOTER-GRP-BTN END -->
</div>

<div class="jdialog" id="add-more-dept-dialog" title="Add Department">
	<div class="inner_div">
		Enter department name: 
		<input type="text" id="department_name" name="department_name" />
	</div>
</div>


<div class="jdialog" id="add-more-position-dialog" title="Add Position">
	<div class="inner_div">
		Enter position: 
		<input type="text" id="position" name="position" />
	</div>
</div>

<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script>
jQuery(document).ready(function(){
	// department script
	jQuery(".dept_id").click(function(){
		var obj = jQuery(this);
		var dept_id = obj.val();
		var dept_name = obj.parents(".li_dept").find(".dept_name").html();
		var state = obj.prop("checked");
		// if checked
		if(state==true){
			// ajax call
			jQuery.ajax({
				type: "POST",
				url: "/tgg/hr_setup/department_and_positions/ajax_get_positions",
				data: {
					dept_id: dept_id,
					dept_name: dept_name,
					<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
				}
			}).done(function(ret){
				if(ret!=""){
					jQuery("#deptnpos").append(ret);
				}else{
					alert("No positions for this department")
					obj.removeProp("checked");
				}
			});
		}else{
			jQuery(".li"+dept_id).remove();
		}
	});
	// add more department
	jQuery("#add-more-dept").click(function(){
		jQuery("#add-more-dept-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				save: function() {
					var dept_name = jQuery("#department_name").val();
					if(dept_name!=""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/tgg/hr_setup/department_and_positions/ajax_add_department",
							data: {
								dept_name: dept_name, 
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
							if(ret==1){
								window.location="/tgg/hr_setup/department_and_positions";
							}
						});
					}else{
						alert('Enter department name');
					}	
				}
			},
		});
	});
	// add more position
	jQuery(document).on("click",".add-more-pos",function(){
		var obj = jQuery(this);
		jQuery("#add-more-position-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				save: function() {
					var pos = jQuery("#position").val();
					var dept_id = obj.parents(".li_dept").find(".dept_id").val();
					if(pos!=""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/tgg/hr_setup/department_and_positions/ajax_add_position",
							data: {
								pos: pos,
								dept_id: dept_id,
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
							if(ret==1){
								window.location="/tgg/hr_setup/department_and_positions";
							}
						});
					}else{
						alert('Enter position');
					}	
				}
			},
		});
	});
});
</script>
