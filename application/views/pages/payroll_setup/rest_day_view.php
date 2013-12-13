<div class="main-content">
<div style="display:none;" class="highlight_message">Message</div>
        <!-- MAIN-CONTENT START -->
        <p>Specify rest days for different payroll group</p>
		<?php
			// get payroll group
			foreach($pg_sql->result() as $pg){ 
			
			// get assigned rest day
			$rd_sql = $this->rest_day_model->get_rest_day($pg->payroll_group_setup_id);
		
			$sun_ck = "";
			$mon_ck = "";
			$tue_ck = "";
			$wed_ck = "";
			$thur_ck = "";
			$fri_ck = "";
			$sat_ck =  "";
			$str_ck = 'checked="checked"';
			$sun_hid = "";
			$mon_hid = "";
			$tue_hid = "";
			$wed_hid = "";
			$thur_hid = "";
			$fri_hid = "";
			$sat_hid =  "";
			foreach($rd_sql->result() as $rd){
				switch($rd->rest_day){
					case 'Sunday':
						$sun_ck = $str_ck;
						$sun_hid = $rd->rest_day_id;
					break;
					case 'Monday':
						$mon_ck =  $str_ck;
						$mon_hid = $rd->rest_day_id;
					break;
					case 'Tuesday':
						$tue_ck =  $str_ck;
						$tue_hid = $rd->rest_day_id;
					break;
					case 'Wednesday':
						$wed_ck =  $str_ck;
						$wed_hid = $rd->rest_day_id;
					break;
					case 'Thursday':
						$thur_ck =  $str_ck;
						$thur_hid = $rd->rest_day_id;
					break;
					case 'Friday':
						$fri_ck =  $str_ck;
						$fri_hid = $rd->rest_day_id;
					break;
					case 'Saturday':
						$sat_ck =  $str_ck;
						$sat_hid = $rd->rest_day_id;
					break;
					default:
						$str_ck = "";
				}
			}
			
			?>
			<h5><?php echo $pg->name; ?></h5>
			<div class="tbl-wrap">
				<table style="margin-left:20px;">
					<tr>
					  <td style="width:120px;"><input style="margin:2px 5px 0 0;" class="rest_day" type="checkbox" value="Sunday" <?php echo $sun_ck; ?> />
					  <input type="hidden" class="rd_id" value="<?php echo $sun_hid; ?>" />
						Sunday
						</td>
					  <td style="width:120px;"><input style="margin:2px 5px 0 0;" class="rest_day" type="checkbox" value="Thursday" <?php echo $thur_ck; ?> />
					   <input type="hidden" class="rd_id" value="<?php echo $thur_hid; ?>" />
						Thursday
						</td>
					</tr>
					<tr>
					  <td><input style="margin:2px 5px 0 0;" class="rest_day" type="checkbox" value="Monday" <?php echo $mon_ck; ?> />
					   <input type="hidden" class="rd_id" value="<?php echo $mon_hid; ?>" />
						Monday
						</td>
					  <td><input style="margin:2px 5px 0 0;" class="rest_day" type="checkbox" value="Friday" <?php echo $fri_ck; ?> />
					   <input type="hidden" class="rd_id" value="<?php echo $fri_hid; ?>" />
						Friday
						</td>
					</tr>
					<tr>
					  <td><input style="margin:2px 5px 0 0;" class="rest_day" type="checkbox" value="Tuesday" <?php echo $tue_ck; ?> />
					   <input type="hidden" class="rd_id" value="<?php echo $tue_hid; ?>" />
						Tuesday
						</td>
					  <td><input style="margin:2px 5px 0 0;" class="rest_day" type="checkbox" value="Saturday" <?php echo $sat_ck; ?> />
					   <input type="hidden" class="rd_id" value="<?php echo $sat_hid; ?>" />
						Saturday
						</td>
					</tr>
					<tr>
					  <td><input style="margin:2px 5px 0 0;" class="rest_day" type="checkbox" value="Wednesday" <?php echo $wed_ck; ?> />
					   <input type="hidden" class="rd_id" value="<?php echo $wed_hid; ?>" />
						Wednesday
						</td>
					  <td>&nbsp;</td>
					</tr>
				</table>
				<input type="hidden" class="pg_id" value="<?php echo $pg->payroll_group_setup_id ?>" />
			</div>
		<?php
			}
		?>
		

       
		
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
	
	// set rest day
	jQuery(".rest_day").click(function(){
		var pg_id = jQuery(this).parents(".tbl-wrap").find(".pg_id").val();
		var rest_day = jQuery(this).val();
		var rd_id = jQuery(this).parents("td:first").find(".rd_id").val();
		// set
		if(jQuery(this).prop("checked")==true){
			jQuery.ajax({
				type: "POST",
				url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/rest_day/ajax_set_rest_day",
				data: {
					pg_id: pg_id, 
					rest_day: rest_day,
					<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
				}
			}).done(function(ret){
				jQuery.cookie("msg", "Rest Day has been set!");
				window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/rest_day";
			});
		// unset
		}else{
			jQuery.ajax({
				type: "POST",
				url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/rest_day/ajax_unset_rest_day",
				data: {
					rd_id: rd_id, 
					<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
				}
			}).done(function(ret){
				jQuery.cookie("msg", "Rest Day has been removed!");
				window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/rest_day";
			});
		}
	});
		
});
</script>