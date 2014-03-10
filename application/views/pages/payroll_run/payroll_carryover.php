<?php print form_open('','onsubmit="return validate_form()"');?>
<div class="main-content"> 
        <!-- MAIN-CONTENT START -->
        <?php print $this->session->flashdata('message');?>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt<br>
          ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation </p>
			<div style="margin-bottom: 15px;" class="jmenu">
				<?php print anchor($this->uri->segment(1)."/payroll_run/payroll/carry_over","Carry Over",'style="margin-right:5px" class="btn"');?>
				<?php print anchor($this->uri->segment(1)."/payroll_run/payroll/retroactive_gross_pay","Retroactive Gross Pay",'style="margin-right:5px" class="btn"');?>
				<?php print anchor($this->uri->segment(1)."/payroll_run/payroll/detail","Detail",'style="margin-right:5px" class="btn"');?>
			</div>
        <div class="tbl-wrap">
          <table width="1610" border="0" cellspacing="0" cellpadding="0" class="tbl emp_conList">
            <tr>
              <th width="91">Source </th>
              <th width="41">&nbsp;</th>
              <th width="146">Employee Name</th>
              <th width="94">Employee ID</th>
              <th width="96">Basic Pay</th>
              <th width="96">Absences</th>
              <th width="96">Tardiness</th>
              <th width="96">Undertime</th>
              <th width="96">Overtime</th>
              <th width="116">Leave w/ Pay</th>
              <th width="126">Night Differential</th>
              <th width="96">Earnings</th>
              <th width="96">Commission</th>
              <th width="96">Allowance</th>
              <th width="96">Expense</th>
              <th width="91">Loans</th>
            </tr>
            <?php 
            	if($employee != NULL){
            		$counter = 1;
            		foreach($employee as $row){
            ?>
            	<tr>
	              <td>&nbsp;</td>
	              <td><?php print $counter++;?></td>
	              <td><?php print $row->first_name." ".$row->last_name;?></td>
	              <td><?php print $row->payroll_cloud_id;?></td>
	              <td>
	              	<?php 
	              		if($row->basic_pay_id != NULL){
	              			$effective_date = strtotime(date('Y-m-d',strtotime($row->effective_date)));
	              			$current_date = strtotime(date('Y-m-d'));
	              			print ($effective_date <= $current_date) ? $row->new_basic_pay : $row->current_basic_pay ;
	              		}else{
	              			print "No records";
	              		}
	              	?>
	              </td>
	              <td>
		              <input type="hidden" name="emp_id[]" class="txtfield" value="<?php print $row->emp_id;?>">
		              <input disabled="disabled" type="text" name="absences[]" class="txtfield" style="width:60px;" value="<?php print carry_over_absences($row->emp_id, 'absences');?>">
	              </td>
	              <td><input disabled="disabled" type="text" name="tardiness[]" class="txtfield" style="width:60px;" value="<?php print carry_over_absences($row->emp_id, 'tardiness');?>"></td>
	              <td><input disabled="disabled" type="text" name="undertime[]" class="txtfield" style="width:60px;" value="<?php print carry_over_absences($row->emp_id, 'undertime');?>"></td>
	              <td><input disabled="disabled" type="text" name="overtime[]" class="txtfield" style="width:60px;" value="<?php print carry_over_absences($row->emp_id, 'overtime');?>"></td>
	              <td><input disabled="disabled" type="text" name="leave_pay[]" class="txtfield" style="width:60px;" value="<?php print carry_over_absences($row->emp_id, 'leave_pay');?>"></td>
	              <td><input disabled="disabled" type="text" name="night_differential[]" class="txtfield" style="width:60px;" value="<?php print carry_over_absences($row->emp_id, 'night_differential');?>"></td>
	              <td><input disabled="disabled" type="text" name="earnings[]" class="txtfield" style="width:60px;" value="<?php print carry_over_absences($row->emp_id, 'earnings');?>"></td>
	              <td><input disabled="disabled" type="text" name="commission[]" class="txtfield" style="width:60px;" value="<?php print carry_over_absences($row->emp_id, 'commission');?>"></td>
	              <td><input disabled="disabled" type="text" name="allowance[]" class="txtfield" style="width:60px;" value="<?php print carry_over_absences($row->emp_id, 'allowance');?>"></td>
	              <td><input disabled="disabled" type="text" name="expense[]" class="txtfield" style="width:60px;" value="<?php print carry_over_absences($row->emp_id, 'expense');?>"></td>
	              <td><input disabled="disabled" type="text" name="loans[]" class="txtfield" style="width:60px;" value="<?php print carry_over_absences($row->emp_id, 'loans');?>"></td>
	            </tr>
            <?php			
            		}
            	}else{
            		print "";
            	}
            ?>
          </table>
        </div>
        <div class="group-btns" style="margin:-25px 0 30px; width:800px; overflow:hidden">
        <a class="btn right update_btn_show" href="javascript:void(0);">Update</a>
        </div>
        <!-- MAIN-CONTENT END --> 
      </div>
      <div class="footer-grp-btn" style="width:820px;"> 
        <!-- FOOTER-GRP-BTN START --> 
        <a class="btn btn-gray left" href="#">BACK</a>
        <input class="btn right" name="save" type="submit" value="SAVE" style="display:none;">
        <!-- FOOTER-GRP-BTN END --> 
      </div>
      
      <script>
      		function update_info(){
      			jQuery(".update_btn_show").click(function(){
      			    var _this = jQuery(this);
      			    jQuery("form input[type='text']").removeAttr("disabled");
      			    _this.hide();
      			    jQuery("form input[name='save']").show();
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
	    	  update_info();
	    	  _successContBox();
	      });
      </script>
<?php print form_close();?>