<div class="main-content">
<div style="display:none;" class="highlight_message">Message</div>
        <!-- MAIN-CONTENT START -->
        <p>Night Shift Differential is an additional payment for employees that are working on night shifts.<br>
          It is computed generally from work done between 10:00 PM until 6:00 AM the following day.<br>
          If you have a different time range for recognizing night shift differential, please select the time below.</p>
		  
		  <?php
		  
		  if($sql_nsd->num_rows()>0){
			  $nsd = $sql_nsd->row();
			  $from = date("h-i-A",strtotime($nsd->from_time));
			  $to = date("h-i-A",strtotime($nsd->to_time));
			  $orig_from = $nsd->from_time;
			  $orig_to = $nsd->to_time;
			  $from2 = explode("-",$from);
			  $from_hour = $from2[0];
			  $from_min = $from2[1];
			  $from_period = $from2[2];
			  $to2 = explode("-",$to);
			  $to_hour = $to2[0];
			  $to_min = $to2[1];
			  $to_period = $to2[2];
			  $rate = $nsd->rate;
		  }else{
			  $orig_from = "";
			  $orig_to = "";
			  $from_hour = "";
			  $from_min = "";
			  $from_period = "";
			  $to_hour = "";
			  $to_min = "";
			  $to_period = "";
			  $rate = "";
		  }
		  
		  ?>
		  
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table border="0" cellspacing="0" cellpadding="0" id="nsd_time_tbl">
            <tr>
				<td style="width:45px;">From</td>
				<td>
					<div id="from_div">
						<select style="width:60px;" class="txtselect" id="hour">
							<?php for($i=0;$i<=12;$i++){ ?>
								<option value="<?php echo sprintf("%02s", $i); ?>" <?php echo ($i==$from_hour)?'selected="selected"':""; ?>>
									<?php echo sprintf("%02s", $i); ?>
								</option>
							<?php } ?>
						</select> :
						<select style="width:60px;" class="txtselect" id="min">
							<?php for($i=0;$i<=59;$i++){ ?>
								<option value="<?php echo sprintf("%02s", $i); ?>" <?php echo ($i==$from_min)?'selected="selected"':""; ?>>
									<?php echo sprintf("%02s", $i); ?>
								</option>
							<?php } ?>
						</select>
						<select style="width:60px;" class="txtselect" id="period">
							<option value="AM" <?php echo ($from_period=="AM")?'selected="selected"':""; ?>>AM</option>
							<option value="PM" <?php echo ($from_period=="PM")?'selected="selected"':""; ?>>PM</option>
						</select>
					</div>
					<input type="hidden" id="nsd_from" value="<?php echo $orig_from; ?>" />
				</td>
				<td style="width:55px;" class="txtcenter">To</td>
				<td>
					<div id="to_div">
						<select style="width:60px;" class="txtselect" id="hour">
							<?php for($i=0;$i<=12;$i++){ ?>
								<option value="<?php echo sprintf("%02s", $i); ?>" <?php echo ($i==$to_hour)?'selected="selected"':""; ?>>
									<?php echo sprintf("%02s", $i); ?>
								</option>
							<?php } ?>
						</select> :
						<select style="width:60px;" class="txtselect" id="min">
							<?php for($i=0;$i<=59;$i++){ ?>
								<option value="<?php echo sprintf("%02s", $i); ?>" <?php echo ($i==$to_min)?'selected="selected"':""; ?>>
									<?php echo sprintf("%02s", $i); ?>
								</option>
							<?php } ?>
						</select>
						<select style="width:60px;" class="txtselect" id="period">
							<option value="AM" <?php echo ($to_period=="AM")?'selected="selected"':""; ?>>AM</option>
							<option value="PM" <?php echo ($to_period=="PM")?'selected="selected"':""; ?>>PM</option>
						</select>
					</div>
					<input type="hidden" id="nsd_to" value="<?php echo $orig_to; ?>" />
				</td>
            </tr>
          </table>
          <!-- TBL-WRAP END -->
        </div>
        <p> Night Differential Rate (%)
          <input style="width:55px; margin-left:5px;" class="txtfield" id="nsd_rate" type="text" value="<?php echo $rate; ?>">
        </p>
		<a href="javascript:void(0);" class="btn" id="save">SAVE</a>
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

	// time script
	jQuery("#nsd_time_tbl select").change(function(){
		// from
		var from_hour = jQuery("#from_div #hour").val();
		var from_min = jQuery("#from_div #min").val();
		var from_period = jQuery("#from_div #period").val();
		jQuery("#nsd_from").val(from_hour+":"+from_min+" "+from_period);
		// to
		var to_hour = jQuery("#to_div #hour").val();
		var to_min = jQuery("#to_div #min").val();
		var to_period = jQuery("#to_div #period").val();
		jQuery("#nsd_to").val(to_hour+":"+to_min+" "+to_period);
	});
	
	// save holiday
	jQuery("#save").click(function(){
		var empty = false;
		var nsd_from = jQuery("#nsd_from").val();
		var nsd_to = jQuery("#nsd_to").val();
		var nsd_rate = jQuery("#nsd_rate").val();
		var url = "<?php echo ($sql_nsd->num_rows()>0)?"ajax_update_nsd_settings":"ajax_add_nsd_settings" ?>";
		var msg = "<?php echo ($sql_nsd->num_rows()>0)?"updated":"saved" ?>";
		// ajax call
		jQuery.ajax({
			type: "POST",
			url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/night_shift_differential/"+url,
			data: {
				nsd_from: nsd_from, 
				nsd_to: nsd_to,
				nsd_rate: nsd_rate,
				<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
			}
		}).done(function(ret){
			jQuery.cookie("msg", "Night differential settings had been "+msg+"!");
			window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/night_shift_differential";
		});	
	});
	
});
</script>