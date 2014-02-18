<?php
$attr = array('id'=>'jform');
echo form_open("/{$this->session->userdata('sub_domain2')}/payroll_run/exclude_list",$attr); 
?>
<div class="main-content"> 
<div style="display:none;" class="highlight_message">Message</div>
        <!-- MAIN-CONTENT START -->
        <p>The exclude list allows you to specify employees that will be set aside for the selected payroll period of payroll group.</p>
        <p>The payroll of the employee that will be excluded will not be processed and will remain unprocessed until payroll admin unchecks the exclude checkbox. You can optionally specify the reason why not to include the employee in the payroll run
         such as: No submission of Timesheet, AWOL - absence without leave or notice.
         </p>
         <p>NOTE: On the succeeding payroll period, you can choose to process the missed payroll run of the employee in the carry over section.
         </p>
         <p>For employees whose salary for the current payroll period is subject to be released during the employee's last pay
         do not process the payroll and mark the employee as on hold. If you still want to process the payroll of that employee in the current run, you can do so.
         </p>
        <div class="tbl-wrap">
          <table width="705" border="0" cellspacing="0" cellpadding="0" class="tbl">
            <tr>
              <th width="136">Employee Number </th>
              <th width="166">Employee Name</th>
              <th width="126">Exclude</th>
              <th width="125">On-Hold</th>
              <th width="152">Reason</th>
            </tr>
			<?php
			foreach($emp_sql->result() as $emp){ 
			
			// get excluded list
			$el_sql = $this->exclude_list_model->get_exclude_list($emp->emp_id);
			  if($el_sql->num_rows()>0){	
				$el = $el_sql->row();
				$el_id = $el->exclude_list_id;
				$exclude = $el->exclude;
				$on_hold = $el->on_hold;
				$reason = $el->reason;
			  }else{
				$el_id = "";
				$exclude = "";
				$on_hold = "";
				$reason ="";
			  }
			?>
			<tr>
			  <td style="display:none">
				<input type="hidden" name="el_id[]" class="el_id" value="<?php echo $el_id; ?>" />
				<input type="hidden" name="emp_id[]" class="emp_id" value="<?php echo $emp->emp_id; ?>" />
			  </td>
              <td><?php echo $emp->payroll_cloud_id; ?></td>
              <td><?php echo $emp->first_name; ?> <?php echo $emp->last_name; ?></td>
			  
		
			  
              <td>
				  <select name="exclude[]" class="txtselect exclude" style="width:105px">
					<option value="0" <?php echo ($exclude==0)?'selected="selected"':''; ?>>No</option>
					<option value="1" <?php echo ($exclude==1)?'selected="selected"':''; ?>>Yes</option>					
				  </select>
			  </td>
              <td>
				<select name="on_hold[]" class="txtselect on_hold" style="width:105px">
					<option value="0" <?php echo ($on_hold==0)?'selected="selected"':''; ?>>No</option>
					<option value="1" <?php echo ($on_hold==1)?'selected="selected"':''; ?>>Yes</option>
				  </select>
			  </td>
              <td>
				<input type="text" name="reasons[]" class="txtfield reasons" value="<?php echo $reason; ?>" />
				</td>
            </tr>
			<?php
			}
			?>
            
          </table>
        </div>
		
        <div class="pagination" style="float: right;padding-top: 10px;position: relative;right: 207px;">
		<?php echo $pagination; ?>
		<div style="clear:both;"></div>
		</div>
        <!-- MAIN-CONTENT END --> 
      </div>
      <div class="footer-grp-btn" style="width:705px; margin-left:20px;"> 
        <!-- FOOTER-GRP-BTN START --> 
        <a class="btn btn-gray left" href="#">BACK</a>
        <input class="btn right" name="save" type="submit" value="SAVE">
        <!-- FOOTER-GRP-BTN END --> 
      </div>
<?php echo form_close(); ?>

<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>

<script>
jQuery(document).ready(function(){

	// load highlight message script
	redirect_highlight_message();
	
	// exclude script
	jQuery(".exclude, .on_hold, .reasons").change(function(){
		var el_id = jQuery(this).parents("tr").find(".el_id").val()
		var emp_id = jQuery(this).parents("tr").find(".emp_id").val()
		var exclude = jQuery(this).parents("tr").find(".exclude").val()
		var on_hold = jQuery(this).parents("tr").find(".on_hold").val();
		var reasons = jQuery(this).parents("tr").find(".reasons").val();
			// add exclude
			jQuery.ajax({
				type: "POST",
				url: "/<?php echo $this->session->userdata('sub_domain2'); ?>/payroll_run/exclude_list/ajax_add_exclude_list",
				data: {
					el_id: el_id,
					emp_id: emp_id,
					exclude: exclude,
					on_hold: on_hold,
					reasons: reasons,
					<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
				}
			}).done(function(ret){
				jQuery.cookie("msg", "Employee has been excluded!");
				location.reload();
			});	
		//console.log(exclude+" - "+on_hold+" - "+reasons);
	});
	
});
</script>
