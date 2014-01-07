	<div class="show_success ihide" id="show_success">
		<div class="highlight_message" id="jmessages"><?php echo $this->session->flashdata("success");?></div>
		<div class="ihide">
		<?php echo validation_errors("<span class='error_zone'>","</span>");?>
		</div>
	</div>
	
	<?php echo form_open($this->session->userdata('sub_domain')."/payroll_setup/thirteen_month_pay_settings",array("onsubmit"=>"return validate_this_form();"));?>
	<div class="main-content">
        <!-- MAIN-CONTENT START -->
        <p>Identify the income to be included in 13th month pay. </p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl">
            <tr>
              <th style="width:135px;">Income</th>
              <th style="width:135px">Include</th>
            </tr>
            <tr>
              <td>Basic Pay</td>
              <td>
              	<select style="width:115px;" class="txtselect jselect" name="basic_pay">              	
              	 <?php 
              		foreach($options as $key=>$val){
              			$iselect = "";
              			if($settings){
              				$iselect = $settings->basic_pay == $val ? 'selected="selected"': "";
              			}
              			echo "<option value=\"{$val}\" {$iselect}>{$key}</option>";
              		}
              	?>
                </select>      
                </td>
            </tr>
            <tr>
              <td>Overtime</td>
              <td>
              	<select style="width:115px;" class="txtselect jselect" name="overtime">
              	 <?php 
              		foreach($options as $key=>$val){
              			$iselect = "";
              			if($settings){
              				$iselect = $settings->overtime == $val ? 'selected="selected"': "";
              			}
              			echo "<option value=\"{$val}\" {$iselect}>{$key}</option>";
              		}
              	?>
                </select>
              </td>
            </tr>
            <tr>
              <td>Holiday/Premium Pay</td>
              <td>
             	 <select style="width:115px;" class="txtselect jselect" name="holiday_or_premium_pay">
              	 <?php 
              		foreach($options as $key=>$val){
              			$iselect = "";
              			if($settings){
              				$iselect = $settings->holiday_or_premium_pay == $val ? 'selected="selected"': "";
              			}
              			echo "<option value=\"{$val}\" {$iselect}>{$key}</option>";
              		}
              	?>
                </select>
                
                </td>
            </tr>
            <tr>
              <td>Night Shift Differential</td>
              <td>
              <select style="width:115px;" class="txtselect jselect" name="night_shift_differential">
              	<?php 
              		foreach($options as $key=>$val){
              			$iselect = "";
              			if($settings){
              				$iselect = $settings->night_shift_differential == $val ? 'selected="selected"': "";
              			}
              			echo "<option value=\"{$val}\" {$iselect}>{$key}</option>";
              		}
              	?>
                </select>
                </td>
            </tr>
          </table>
          <!-- TBL-WRAP END -->
        </div>
        <p>What type of basic pay do you process for your 13th month?</p>
        <table style="margin-left:10px;" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="width:150px;" >
            	<?php
            		$select_basic_pay = "";
            		$select_average_pay = "";
            		if($settings){
            			$select_basic_pay = $settings->type_of_basic_pay_process == '1' ? "checked='checked'" : '';
            			$select_average_pay = $settings->type_of_basic_pay_process == '2' ? "checked='checked'" : '';
            		}
            	?>
            	<input style="margin-right:5px;" type="radio" name="type_of_basic_pay_process" value="1" <?php echo $select_basic_pay;?>>
              Current Basic Pay
            </td>
            <td style="width:170px;">
            <input style="margin-right:5px;" type="radio" name="type_of_basic_pay_process" value="2" <?php echo $select_average_pay;?>>
              Average annual basic pay</td>
          </tr>
        </table>
        <br>
        <br>
        <p>Identify the other earnings to be included in 13th month pay.</p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl">
            <tr>
              <th style="width:135px;">Other Earnings</th>
              <th style="width:135px">Include</th>
            </tr>          
            <?php 
            	if($earnings){
            		foreach($earnings as $earn):
         	?>
         			<tr>	
         			<td>
         				<input type="hidden" name="earning_id[]" value="<?php echo $earn->earning_id;?>" />
         				<?php 
         					#displays name of earning
         					echo $earn->earning_name;
         					# GET THE VALUES ON THE			
         				?>
         			</td>
					<td>
						<?php 
            				if($earn->earning_id){
         						$earning_save = $this->thirteen_month_pay_settings->get_earnings_13month($earn->earning_id);
         					}
						?>
						<select style="width:115px;" class="txtselect jselect" name="earning_status[]">
						<?php 
		              		foreach($options as $key=>$val){
		              			$iselect = "";
		              			if($earning_save){
		              				$iselect = $earning_save->include_status == $val ? 'selected="selected"' :"";
		              			}
		              			echo "<option value=\"{$val}\" {$iselect}>{$key}</option>";
		              		}
              			?>
						</select>
					</td>
         			 </tr>
         	<?php     		 
            		endforeach;
            	}
            ?>
            
          </table>
          <!-- TBL-WRAP END -->
        </div>
        <p> Select whether to include tardiness, absences, or under time as deduction from the total employee income</p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl" id="jadjustment_zone">
            <tr>
              <th style="width:135px;">Adjustments</th>
              <th style="width:135px">Include</th>
            </tr>
            <tr>
              <td>Tardiness</td>
              <td><select style="width:115px;" class="txtselect jselect" name="tardiness">
             	 <?php 
					foreach($options as $key=>$val){
						$iselect = "";
						if($settings){
              				$iselect = $settings->tardiness == $val ? 'selected="selected"': "";
              			}
						echo "<option value=\"{$val}\" {$iselect}>{$key}</option>";
					}
				?>
                </select></td>
            </tr>
            <tr>
              <td>Absences</td>
              <td><select style="width:115px;" class="txtselect jselect" name="absences">
              	<?php 
					foreach($options as $key=>$val){
						$iselect = "";
						if($settings){
              				$iselect = $settings->absences == $val ? 'selected="selected"': "";
              			}
						echo "<option value=\"{$val}\" {$iselect}>{$key}</option>";
					}
				?>
                </select></td>
            </tr>
            <tr>
              <td>Undertime</td>
              <td><select style="width:115px;" class="txtselect jselect" name="undertime">
              	<?php 
					foreach($options as $key=>$val){
						$iselect = "";
						if($settings){
              				$iselect = $settings->undertime == $val ? 'selected="selected"': "";
              			}
						echo "<option value=\"{$val}\" {$iselect}>{$key}</option>";
					}
				?>
                </select></td>
            </tr>
            <?php 
            	if($more_adjustments){
            		foreach($more_adjustments as $adjust):
            ?>
	             <tr>
	              <td>
	              	<?php echo $adjust->name;?>
	              	<input type="hidden" name="thirteen_month_other_adjustments_id[]" value="<?php echo $adjust->thirteen_month_other_adjustments_id;?>" />      	
	              </td>
	              <td><select style="width:115px;" class="txtselect jselect" name="additional_adjustments_name[]">
	              	<?php 
						foreach($options as $key=>$val){
							$iselect = "";
							if($adjust){
								$iselect = ($val == $adjust->adjustments_status) ? 'selected="selected"': "";
							}
							echo "<option value=\"{$val}\" {$iselect}>{$key}</option>";
						}
					?>
	                </select></td>
	            </tr>
            <?php 
            		endforeach;
            	}
            ?>
            
          </table>
          <br />
          <a class="btn" href="#" id="jadd_adjustments">Add </a>      
          <!-- TBL-WRAP END -->
        </div>
        <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray left" href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/witholding_tax">BACK</a> 
		<a class="btn btn-gray right" href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/thirteen_month_pay">CONTINUE</a>
        <input style="margin-right:10px;" class="btn right" name="submit" type="submit" value="SAVE">
        <!-- FOOTER-GRP-BTN END -->
      </div>
      <?php echo form_close();?>
      <script type="text/javascript">
      // ADD MORE ADJUSTMENTS APPEND STYLE
      	function add_more_adjustments(){
    	  jQuery(document).on("click","#jadd_adjustments",function(e){
    		    e.preventDefault();
    		    var html = '<tr>';
    		    html +='     <td><input type="text" value="" class="txtfield jselect" name="more_adjustments_name[]"  /></td>';
    		    html +='     <td><select name="more_adjustments_option[]" class="txtselect jselect" style="width:115px;">';
    		    html +='     <option value="">Select</option><option value="yes">Yes</option><option value="no">No</option>';
    		    html +='     </select></td>';
    		    html +='      </tr>';
    		    jQuery("#jadjustment_zone").append(html);            
    		});
      	}
      // GIVES SAVE STATUS
      	function thirteen_status(){
			var check_text = jQuery.trim(jQuery("#jmessages").text());
			if(check_text !=""){
				jQuery("#show_success").fadeIn('slow',function(){
					jQuery(this).fadeOut(6000);
				});
			}
		}
		// VALIDATES FORMS BEFORE SUBMITTINGS
		function validate_this_form(){
			ierror_field(".jselect");
			if(ierror_mark(".jselect") > 0){
				
			}else{
				return true;
			}
			return false;
		}

      jQuery(function(){
    	  add_more_adjustments();    
    	  thirteen_status();  
      });
      </script>