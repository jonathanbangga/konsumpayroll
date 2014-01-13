<?php print form_open('','onsubmit="return validateForm()"');?>
<?php print $this->session->flashdata('message');?>
<div class="main-content">
        <!-- MAIN-CONTENT START -->
        <p>Deductions refers to the employees contributions to SSS, PhilHealth and HDMF.</p>
        <br>
        <p>Select when to deduct government contributions from employees, payroll for each payroll group.</p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl">
            <tbody>
              <tr>
                <th style="width:125px;">Payroll Group</th>
                <th style="width:125px">SSS</th>
                <th style="width:125px;">PhilHealth</th>
                <th style="width:125px">HDMF</th>
                <th style="width:120px">Withholding Tax</th>
              </tr>
              <?php 
              	if($payroll_group != NULL){
              		foreach($payroll_group as $row){
              ?>
              <tr>
                <td>
                  <select class="txtselect select-medium" name="deduction_payroll_group[]">
                  	<option value='<?php print $row->payroll_group_id;?><?php echo set_select('deduction_payroll_group', $row->payroll_group_name); ?>'><?php print $row->payroll_group_name;?></option>
                  </select>
                 </td>
                 <?php 
                 	if($deductions_payroll_group != NULL){
                 ?>
	                <td>
	                  <select class="txtselect select-medium" name="deduction_sss[]">
	                  	<option value="first payroll of the month" <?php print (deduction_payroll_group($row->payroll_group_id,"sss") == "first payroll of the month") ? "selected" : "" ;?>>first payroll of the month</option>
	                  	<option value="last payroll of the month" <?php print (deduction_payroll_group($row->payroll_group_id,"sss") == "last payroll of the month") ? "selected" : "" ;?>>last payroll of the month</option>
	                  	<option value="equal in every payroll" <?php print (deduction_payroll_group($row->payroll_group_id,"sss") == "equal in every payroll") ? "selected" : "" ;?>>equal in every payroll</option>
	                  </select>
	                 </td>
	                 <td>
	                  <select class="txtselect select-medium" name="deduction_philhealth[]">
	                  	<option value="first payroll of the month" <?php print (deduction_payroll_group($row->payroll_group_id,"philhealth") == "first payroll of the month") ? "selected" : "" ;?>>first payroll of the month</option>
	                  	<option value="last payroll of the month" <?php print (deduction_payroll_group($row->payroll_group_id,"philhealth") == "last payroll of the month") ? "selected" : "" ;?>>last payroll of the month</option>
	                  	<option value="equal in every payroll" <?php print (deduction_payroll_group($row->payroll_group_id,"philhealth") == "equal in every payroll") ? "selected" : "" ;?>>equal in every payroll</option>
	                  </select>
	                 </td>
	                 <td>
	                  <select class="txtselect select-medium" name="deduction_hdmf[]">
	                  	<option value="first payroll of the month" <?php print (deduction_payroll_group($row->payroll_group_id,"hdmf") == "first payroll of the month") ? "selected" : "" ;?>>first payroll of the month</option>
	                  	<option value="last payroll of the month" <?php print (deduction_payroll_group($row->payroll_group_id,"hdmf") == "last payroll of the month") ? "selected" : "" ;?>>last payroll of the month</option>
	                  	<option value="equal in every payroll" <?php print (deduction_payroll_group($row->payroll_group_id,"hdmf") == "equal in every payroll") ? "selected" : "" ;?>>equal in every payroll</option>
	                  </select>
	                 </td>
	                 <td>
	                  <select class="txtselect select-medium" name="deduction_withholding_tax[]">
	                  	<option value="first payroll of the month" <?php print (deduction_payroll_group($row->payroll_group_id,"withholding_tax") == "first payroll of the month") ? "selected" : "" ;?>>first payroll of the month</option>
	                  	<option value="last payroll of the month" <?php print (deduction_payroll_group($row->payroll_group_id,"withholding_tax") == "last payroll of the month") ? "selected" : "" ;?>>last payroll of the month</option>
	                  	<option value="equal in every payroll" <?php print (deduction_payroll_group($row->payroll_group_id,"withholding_tax") == "equal in every payroll") ? "selected" : "" ;?>>equal in every payroll</option>
	                  </select>
	                 </td>
                 <?php 
              		}else{
              	 ?>
              	 	<td>
	                  <select class="txtselect select-medium" name="deduction_sss[]">
	                  	<option value="first payroll of the month">first payroll of the month</option>
	                  	<option value="last payroll of the month">last payroll of the month</option>
	                  	<option value="equal in every payroll">equal in every payroll</option>
	                  </select>
	                 </td>
	                 <td>
	                  <select class="txtselect select-medium" name="deduction_philhealth[]">
	                  	<option value="first payroll of the month">first payroll of the month</option>
	                  	<option value="last payroll of the month">last payroll of the month</option>
	                  	<option value="equal in every payroll">equal in every payroll</option>
	                  </select>
	                 </td>
	                 <td>
	                  <select class="txtselect select-medium" name="deduction_hdmf[]">
	                  	<option value="first payroll of the month">first payroll of the month</option>
	                  	<option value="last payroll of the month">last payroll of the month</option>
	                  	<option value="equal in every payroll">equal in every payroll</option>
	                  </select>
	                 </td>
	                 <td>
	                  <select class="txtselect select-medium" name="deduction_withholding_tax[]">
	                  	<option value="first payroll of the month">first payroll of the month</option>
	                  	<option value="last payroll of the month">last payroll of the month</option>
	                  	<option value="equal in every payroll">equal in every payroll</option>
	                  </select>
	                 </td>
              	 <?php		
              		}
              		
                 ?>
              </tr>
              <?php 
              		} 
              	}
              ?>
            </tbody>
          </table>
          <!-- TBL-WRAP END -->
        </div>
        <p>Identify the earnings to be included in employees compensation for purposes of the government contributions.</p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl">
            <tbody>
              <tr>
                <th style="width:125px;">Income</th>
                <th style="width:125px">Basis for SSS</th>
                <th style="width:140px;">Basis for PhilHealth</th>
                <th style="width:125px">Basis for HDMF</th>
              </tr>
	              <tr>
	                <td>
	                	<input type="text" value="Basic Pay" name="ded_income[]" style="width:160px;background:none;border:0;text-align: center;color: #333333;font-size:11px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;" readonly="readonly" />
	                </td>
	                <td>
	                	<select class="txtselect select-medium" name="ded_income_basic_sss[]">
	                		<option value="Yes" <?php if($income != NULL){if(deduction_income("Basic Pay", "basis_for_sss",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
	                		<option value="No" <?php if($income != NULL){if(deduction_income("Basic Pay", "basis_for_sss",$comp_id) == "No"){print "selected";}}?>>No</option>
	                  	</select>
	                </td>
	                <td>
	                	<select class="txtselect select-medium" name="ded_income_basic_philhealth[]">
	                		<option value="Yes" <?php if($income != NULL){if(deduction_income("Basic Pay", "basis_for_philhealth",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
	                		<option value="No" <?php if($income != NULL){if(deduction_income("Basic Pay", "basis_for_philhealth",$comp_id) == "No"){print "selected";}}?>>No</option>
	                  	</select>
	                </td>
	                <td>
	                	<select class="txtselect select-medium" name="ded_income_basic_hdmf[]">
	                		<option value="Yes" <?php if($income != NULL){if(deduction_income("Basic Pay", "basis_for_hdmf",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
	                		<option value="No" <?php if($income != NULL){if(deduction_income("Basic Pay", "basis_for_hdmf",$comp_id) == "No"){print "selected";}}?>>No</option>
	                  	</select>
	                </td>
	              </tr>
	              <tr>
	                <td>
	                	<input type="text" value="Overtime Pay" name="ded_income[]" style="width:160px;background:none;border:0;text-align: center;color: #333333;font-size:11px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;" readonly="readonly" />
	                </td>
	                <td>
	                	<select class="txtselect select-medium" name="ded_income_basic_sss[]">
	                		<option value="Yes" <?php if($income != NULL){if(deduction_income("Overtime Pay", "basis_for_sss",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
	                		<option value="No" <?php if($income != NULL){if(deduction_income("Overtime Pay", "basis_for_sss",$comp_id) == "No"){print "selected";}}?>>No</option>
	                  	</select>
	                </td>
	                <td>
	                	<select class="txtselect select-medium" name="ded_income_basic_philhealth[]">
	                		<option value="Yes" <?php if($income != NULL){if(deduction_income("Overtime Pay", "basis_for_philhealth",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
	                		<option value="No" <?php if($income != NULL){if(deduction_income("Overtime Pay", "basis_for_philhealth",$comp_id) == "No"){print "selected";}}?>>No</option>
	                  	</select>
	                </td>
	                <td>
	                	<select class="txtselect select-medium" name="ded_income_basic_hdmf[]">
	                		<option value="Yes" <?php if($income != NULL){if(deduction_income("Overtime Pay", "basis_for_hdmf",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
	                		<option value="No" <?php if($income != NULL){if(deduction_income("Overtime Pay", "basis_for_hdmf",$comp_id) == "No"){print "selected";}}?>>No</option>
	                  	</select>
	                </td>
	              </tr>
	              <tr>
	                <td>
	                	<input type="text" value="Holiday/Premium Pay" name="ded_income[]" style="width:160px;background:none;border:0;text-align: center;color: #333333;font-size:11px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;" readonly="readonly" />
	                </td>
	                <td>
	                	<select class="txtselect select-medium" name="ded_income_basic_sss[]">
	                		<option value="Yes" <?php if($income != NULL){if(deduction_income("Holiday/Premium Pay", "basis_for_sss",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
	                		<option value="No" <?php if($income != NULL){if(deduction_income("Holiday/Premium Pay", "basis_for_sss",$comp_id) == "No"){print "selected";}}?>>No</option>
	                  	</select>
	                </td>
	                <td>
	                	<select class="txtselect select-medium" name="ded_income_basic_philhealth[]">
	                		<option value="Yes" <?php if($income != NULL){if(deduction_income("Holiday/Premium Pay", "basis_for_philhealth",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
	                		<option value="No" <?php if($income != NULL){if(deduction_income("Holiday/Premium Pay", "basis_for_philhealth",$comp_id) == "No"){print "selected";}}?>>No</option>
	                  	</select>
	                </td>
	                <td>
	                	<select class="txtselect select-medium" name="ded_income_basic_hdmf[]">
	                		<option value="Yes" <?php if($income != NULL){if(deduction_income("Holiday/Premium Pay", "basis_for_hdmf",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
	                		<option value="No" <?php if($income != NULL){if(deduction_income("Holiday/Premium Pay", "basis_for_hdmf",$comp_id) == "No"){print "selected";}}?>>No</option>
	                  	</select>
	                </td>
	              </tr>
	              <tr>
	                <td>
	                	<input type="text" value="Night Shift Differential" name="ded_income[]" style="width:160px;background:none;border:0;text-align: center;color: #333333;font-size:11px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;" readonly="readonly" />
	                </td>
	                <td>
	                	<select class="txtselect select-medium" name="ded_income_basic_sss[]">
	                		<option value="Yes" <?php if($income != NULL){if(deduction_income("Night Shift Differential", "basis_for_sss",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
	                		<option value="No" <?php if($income != NULL){if(deduction_income("Night Shift Differential", "basis_for_sss",$comp_id) == "No"){print "selected";}}?>>No</option>
	                  	</select>
	                </td>
	                <td>
	                	<select class="txtselect select-medium" name="ded_income_basic_philhealth[]">
	                		<option value="Yes" <?php if($income != NULL){if(deduction_income("Night Shift Differential", "basis_for_philhealth",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
	                		<option value="No" <?php if($income != NULL){if(deduction_income("Night Shift Differential", "basis_for_philhealth",$comp_id) == "No"){print "selected";}}?>>No</option>
	                  	</select>
	                </td>
	                <td>
	                	<select class="txtselect select-medium" name="ded_income_basic_hdmf[]">
	                		<option value="Yes" <?php if($income != NULL){if(deduction_income("Night Shift Differential", "basis_for_hdmf",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
	                		<option value="No" <?php if($income != NULL){if(deduction_income("Night Shift Differential", "basis_for_hdmf",$comp_id) == "No"){print "selected";}}?>>No</option>
	                  	</select>
	                </td>
	              </tr>
	              <tr>
	                <td>
	                	<input type="text" value="Taxable Other Earnings" name="ded_income[]" style="width:160px;background:none;border:0;text-align: center;color: #333333;font-size:11px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;" readonly="readonly" />
	                </td>
	                <td>
	                	<select class="txtselect select-medium" name="ded_income_basic_sss[]">
	                		<option value="Yes" <?php if($income != NULL){if(deduction_income("Taxable Other Earnings", "basis_for_sss",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
	                		<option value="No" <?php if($income != NULL){if(deduction_income("Taxable Other Earnings", "basis_for_sss",$comp_id) == "No"){print "selected";}}?>>No</option>
	                  	</select>
	                </td>
	                <td>
	                	<select class="txtselect select-medium" name="ded_income_basic_philhealth[]">
	                		<option value="Yes" <?php if($income != NULL){if(deduction_income("Taxable Other Earnings", "basis_for_philhealth",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
	                		<option value="No" <?php if($income != NULL){if(deduction_income("Taxable Other Earnings", "basis_for_philhealth",$comp_id) == "No"){print "selected";}}?>>No</option>
	                  	</select>
	                </td>
	                <td>
	                	<select class="txtselect select-medium" name="ded_income_basic_hdmf[]">
	                		<option value="Yes" <?php if($income != NULL){if(deduction_income("Taxable Other Earnings", "basis_for_hdmf",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
	                		<option value="No" <?php if($income != NULL){if(deduction_income("Taxable Other Earnings", "basis_for_hdmf",$comp_id) == "No"){print "selected";}}?>>No</option>
	                  	</select>
	                </td>
	              </tr>
	              <tr>
	                <td>
	                	<input type="text" value="Non-Taxable Other Earnings" name="ded_income[]" style="width:160px;background:none;border:0;text-align: center;color: #333333;font-size:11px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;" readonly="readonly" />
	                </td>
	                <td>
	                	<select class="txtselect select-medium" name="ded_income_basic_sss[]">
	                		<option value="Yes" <?php if($income != NULL){if(deduction_income("Non-Taxable Other Earnings", "basis_for_sss",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
	                		<option value="No" <?php if($income != NULL){if(deduction_income("Non-Taxable Other Earnings", "basis_for_sss",$comp_id) == "No"){print "selected";}}?>>No</option>
	                  	</select>
	                </td>
	                <td>
	                	<select class="txtselect select-medium" name="ded_income_basic_philhealth[]">
	                		<option value="Yes" <?php if($income != NULL){if(deduction_income("Non-Taxable Other Earnings", "basis_for_philhealth",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
	                		<option value="No" <?php if($income != NULL){if(deduction_income("Non-Taxable Other Earnings", "basis_for_philhealth",$comp_id) == "No"){print "selected";}}?>>No</option>
	                  	</select>
	                </td>
	                <td>
	                	<select class="txtselect select-medium" name="ded_income_basic_hdmf[]">
	                		<option value="Yes" <?php if($income != NULL){if(deduction_income("Non-Taxable Other Earnings", "basis_for_hdmf",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
	                		<option value="No" <?php if($income != NULL){if(deduction_income("Non-Taxable Other Earnings", "basis_for_hdmf",$comp_id) == "No"){print "selected";}}?>>No</option>
	                  	</select>
	                </td>
	              </tr>
	              
            </tbody>
          </table>
          <!-- TBL-WRAP END -->
        </div>
        <p>Select whether to deduct tardiness, absences, or undertime from the employee income to get the<br>
          basis of the contribution. The net amount will determine which salary bracket an employee belongs<br>
          and the corresponding amount of contribition</p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl">
            <tbody>
              <tr>
                <th style="width:125px;">Adjustments</th>
                <th style="width:125px">Basis for SSS</th>
                <th style="width:140px;">Basis for PhilHealth</th>
                <th style="width:125px">Basis for HDMF</th>
              </tr>
              <tr>
                <td>
                	<input type="text" value="Tardiness" name="ded_adj[]" style="width:160px;background:none;border:0;text-align: center;color: #333333;font-size:11px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;" readonly="readonly" />
                </td>
                <td>
                	<select class="txtselect select-medium" name="ded_adj_basic_sss[]">
                		<option value="Yes" <?php if($adjustments != NULL){if(deduction_adjustments("Tardiness", "basis_for_sss",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
                		<option value="No" <?php if($adjustments != NULL){if(deduction_adjustments("Tardiness", "basis_for_sss",$comp_id) == "No"){print "selected";}}?>>No</option>
                  	</select>
                </td>
                <td>
                	<select class="txtselect select-medium" name="ded_adj_basic_philhealth[]">
                		<option value="Yes" <?php if($adjustments != NULL){if(deduction_adjustments("Tardiness", "basis_for_philhealth",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
                		<option value="No" <?php if($adjustments != NULL){if(deduction_adjustments("Tardiness", "basis_for_philhealth",$comp_id) == "No"){print "selected";}}?>>No</option>
                  	</select>
                </td>
                <td>
                	<select class="txtselect select-medium" name="ded_adj_basic_hdmf[]">
                		<option value="Yes" <?php if($adjustments != NULL){if(deduction_adjustments("Tardiness", "basis_for_hdmf",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
                		<option value="No" <?php if($adjustments != NULL){if(deduction_adjustments("Tardiness", "basis_for_hdmf",$comp_id) == "No"){print "selected";}}?>>No</option>
                  	</select>
                </td>
              </tr>
              <tr>
                <td>
                	<input type="text" value="Absences" name="ded_adj[]" style="width:160px;background:none;border:0;text-align: center;color: #333333;font-size:11px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;" readonly="readonly" />
                </td>
                <td>
                	<select class="txtselect select-medium" name="ded_adj_basic_sss[]">
                		<option value="Yes" <?php if($adjustments != NULL){if(deduction_adjustments("Absences", "basis_for_sss",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
                		<option value="No" <?php if($adjustments != NULL){if(deduction_adjustments("Absences", "basis_for_sss",$comp_id) == "No"){print "selected";}}?>>No</option>
                  	</select>
                </td>
                <td>
                	<select class="txtselect select-medium" name="ded_adj_basic_philhealth[]">
                		<option value="Yes" <?php if($adjustments != NULL){if(deduction_adjustments("Absences", "basis_for_philhealth",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
                		<option value="No" <?php if($adjustments != NULL){if(deduction_adjustments("Absences", "basis_for_philhealth",$comp_id) == "No"){print "selected";}}?>>No</option>
                  	</select>
                </td>
                <td>
                	<select class="txtselect select-medium" name="ded_adj_basic_hdmf[]">
                		<option value="Yes" <?php if($adjustments != NULL){if(deduction_adjustments("Absences", "basis_for_hdmf",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
                		<option value="No" <?php if($adjustments != NULL){if(deduction_adjustments("Absences", "basis_for_hdmf",$comp_id) == "No"){print "selected";}}?>>No</option>
                  	</select>
                </td>
              </tr>
              <tr>
                <td>
                	<input type="text" value="Undertime" name="ded_adj[]" style="width:160px;background:none;border:0;text-align: center;color: #333333;font-size:11px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;" readonly="readonly" />
                </td>
                <td>
                	<select class="txtselect select-medium" name="ded_adj_basic_sss[]">
                		<option value="Yes" <?php if($adjustments != NULL){if(deduction_adjustments("Undertime", "basis_for_sss",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
                		<option value="No" <?php if($adjustments != NULL){if(deduction_adjustments("Undertime", "basis_for_sss",$comp_id) == "No"){print "selected";}}?>>No</option>
                  	</select>
                </td>
                <td>
                	<select class="txtselect select-medium" name="ded_adj_basic_philhealth[]">
                		<option value="Yes" <?php if($adjustments != NULL){if(deduction_adjustments("Undertime", "basis_for_philhealth",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
                		<option value="No" <?php if($adjustments != NULL){if(deduction_adjustments("Undertime", "basis_for_philhealth",$comp_id) == "No"){print "selected";}}?>>No</option>
                  	</select>
                </td>
                <td>
                	<select class="txtselect select-medium" name="ded_adj_basic_hdmf[]">
                		<option value="Yes" <?php if($adjustments != NULL){if(deduction_adjustments("Undertime", "basis_for_hdmf",$comp_id) == "Yes"){print "selected";}}?>>Yes</option>
                		<option value="No" <?php if($adjustments != NULL){if(deduction_adjustments("Undertime", "basis_for_hdmf",$comp_id) == "No"){print "selected";}}?>>No</option>
                  	</select>
                </td>
              </tr>
            </tbody>
          </table>
          <!-- TBL-WRAP END -->
        </div>
        <p>Other Deductions</p>
        <div>
        	<div class="error_msg_cont"></div>
          <table class="other_deduction_cont">
          <?php 
              	if($other_deduction != NULL){
              		foreach($other_deduction as $row){
              ?>
            <tr>
              <td style="width:auto;">
              <input style="margin:2px 5px 0 0" name="payroll_group_input_other_dd_id[]" type="hidden" value="<?php print $row->deductions_other_deductions_id;?>" />
              <input style="margin:2px 5px 0 0" <?php if($row->view == "Yes"){print "checked";}?> attr_id = "<?php print $row->deductions_other_deductions_id;?>" name="payroll_group_input_other_dd[]" type="checkbox" value="Yes" <?php echo set_checkbox('payroll_group_input_other_dd[]', 'Yes'); ?> />
                <?php print $row->name;?> </td>
              <?php } }else{	
              	print "<tr class='msg_empt_cont'><td style='text-align:left;'>- ".msg_empty()."</td></tr>";
              } ?>
            </tr>
          </table>
        </div>
        <br />
        <p><a href="javascript:void(0);" class="btn add_btn_other_dd">Add More</a></p>
        <br>
        <br>
        <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray left" href="javascript:history.go(-1);">BACK</a> 
        <?php 
        	if($deductions_payroll_group != NULL){
        		print '<input class="btn right ihide update_btn" name="update" type="submit" value="UPDATE">';
        		print '<a class="btn right edit_btn" href="javascript:void(0);">Edit</a>';
        	}
        ?>
        <?php 
        	if($deductions_payroll_group == NULL){
				print '<input style="margin-right:10px;" class="btn right" name="save" type="submit" value="SAVE">';
				        		
        	}
        ?>
        <!-- FOOTER-GRP-BTN END -->
      </div>
<?php print form_close();?>
	<div class="ihide add_other_dd_cont" title="Add Other Deduction">
		<?php print form_open('','onsubmit="return add_other_dd()"');?>
      	<table>
      		<tr>
      			<td style="width: 100px;">
        			Other Deduction 
        		</td>
        		<td>
        			<input type='text' class='txtfield other_deduction' name='other_deduction' />&nbsp;
        		</td>
        	</tr>
        	<tr>
        		<td colspan="2">
        			<input type="submit" value="SAVE" name="save_other_dd" class="btn right" style="margin-right:10px;">
        		</td>
        	</tr>
      	</table>
      	<?php print form_close();?>
      </div>
<script>

	function add_other_dd(){
		var why = "";
		var other_deduction = jQuery(".other_deduction").val();
		if(other_deduction == ""){
			why += "1";
			jQuery(".other_deduction").addClass("emp_str");
		}
		if(why != ""){
			return false;
		}
	}

	function validateForm(){
		if(!jQuery(".other_deduction_cont input:checkbox").is(":checked")){
			var error = "1";
		}

		if(error == "1"){
		    jQuery(".error_msg_cont").html("<p>- Please select payroll group</p>");
		    return false;
		}
	}

	function addRow(){
        jQuery(".add_other_dd_cont").dialog({
        	width: 'inherit',
		   draggable: false,
		   modal: true,
		   width:'auto',
		   minWidth:'400',
		   dialogClass:'transparent'
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

	function all_payroll_group_trigger(){
		jQuery(".all_group_btn").bind("change", function(){
		    var _this = jQuery(this);
		    if(_this.is(":checked")){
		        jQuery(".payroll_group_input_other_dd").each(function(){
		            jQuery(this).prop("checked",true);
		        });
		    }else{
		        jQuery(".payroll_group_input_other_dd").each(function(){
		            jQuery(this).removeAttr("checked");
		        });
		    }
		});
	}

	function add_new_other_deduction(){
		jQuery(".add_btn_other_dd").click(function(){
		    jQuery(".msg_empt_cont").remove();
		    addRow();
		    remove_row();
		});
	}

	function remove_row(){
		jQuery(".other_deduction_cont tr").each(function(){
		    var _this = jQuery(this);
		    jQuery(this).find(".delRow").on("click", function(){
		        _this.remove();
		    });
		});
	}

	function update_other_dd(){
		jQuery("input[name='payroll_group_input_other_dd[]']").bind("change", function(){
		    var _this = jQuery(this);
		    var id = _this.attr('attr_id');
		    if(_this.is(":checked")){
		    	$.ajax({
    				url: window.location.href,
    				type: "POST",
    				async: false,
    				data: {
    					'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
    					'update_other_dd': '1',
    					'id':id,
    					'view':'Yes'
    				},
    				success: function(data){
    					var status = jQuery.parseJSON(data);
    					return false;
    				}
    			});
		    }else{
		    	$.ajax({
    				url: window.location.href,
    				type: "POST",
    				async: false,
    				data: {
    					'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
    					'update_other_dd': '1',
    					'id':id,
    					'view':'No'
    				},
    				success: function(data){
    					var status = jQuery.parseJSON(data);
    					return false;
    				}
    			});
		    }
		});
	}

	function disabled_select(){
		<?php 
			if($deductions_payroll_group != NULL){
		?>
			jQuery(".tbl td").each(function(){
			    jQuery(this).find("select").attr("disabled","disabled");
			});
		<?php } ?>
	}

	function edit_btn(){
		<?php 
			if($deductions_payroll_group != NULL){
		?>
			jQuery(".edit_btn").click(function(){
				jQuery(".tbl td").each(function(){
				    jQuery(this).find("select").removeAttr("disabled");
				});
				jQuery(".edit_cont, .update_btn").fadeIn('100');
				jQuery(this).hide();
				jQuery('body,html').animate({scrollTop:0},800);
			});
		<?php } ?>
	}
	
	jQuery(function(){
		_successContBox();
		all_payroll_group_trigger();
		add_new_other_deduction();
		update_other_dd();
		disabled_select();
		edit_btn();
	});
</script>