<div class="main-content">
<div style="display:none;" class="highlight_message">Message</div>
        <!-- MAIN-CONTENT START -->
		<?php echo form_open("/{$this->session->userdata('sub_domain')}/payroll_setup/banks");?>
        <p>Define the bank account to be debited in each payroll.<br>
          If you only use one bank account, enter the same bank account for each payroll group.</p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl">
            <tbody>
              <tr>
                <th style="width:135px;">Payroll Group</th>
                <th style="width:135px">Bank Name</th>
                <th style="width:135px;">Branch</th>
                <th style="width:135px">Bank Account No.</th>
                <th style="width:135px">Bank Account Type</th>
              </tr>
			  <?php
			  foreach($pg_sql->result() as $pg){ 
			  $ba_sql = $this->banks_model->get_payroll_bank_accounts($pg->payroll_group_setup_id);
			  
			  if($ba_sql->num_rows()>0){
				$ba = $ba_sql->row();
				$paba_id = $ba->payroll_assigned_bank_accounts_id;
				$bank_name = $ba->bank_name;
				$branch = $ba->branch;
				$bank_account_no = $ba->bank_account_no;
				$bank_account_type = $ba->bank_account_type;
			  }else{
				$paba_id = "";
				$bank_name = "";
				$branch = "";
				$bank_account_no = "";
				$bank_account_type = "";
			  }
			  
			  ?>
			  <tr>
                <td>
					<?php echo $pg->name; ?>
					<input type="hidden" name="pg_id[]" class="pg_id" value="<?php echo $pg->payroll_group_setup_id; ?>" />
					<input type="hidden" name="paba_id[]" class="paba_id" value="<?php echo $paba_id; ?>" />
				</td>
                <td><select style="width:115px;" class="txtselect bank" name="bank[]">
					<option value="">select</option>
					<option value="bank1" <?php echo ($bank_name=="bank1")?'selected="selected"':""; ?>>bank1</option>
					<option value="bank2" <?php echo ($bank_name=="bank2")?'selected="selected"':""; ?>>bank2</option>
					<option value="bank3" <?php echo ($bank_name=="bank3")?'selected="selected"':""; ?>>bank3</option>
                  </select></td>
                <td><input style="width:115px;" class="txtfield branch" name="branch[]" type="text" value="<?php echo $branch; ?>" /></td>
                <td><input style="width:115px;" class="txtfield bank_an" name="bank_an[]" type="text" value="<?php echo $bank_account_no; ?>" /></td>
                <td>
					<select style="width:115px;" class="txtselect bank_at" name="bank_at[]">
						<option value="">select</option>
						<option value="Savings" <?php echo ($bank_account_type=="Savings")?'selected="selected"':""; ?>>Savings</option>
						<option value="Current" <?php echo ($bank_account_type=="Current")?'selected="selected"':""; ?>>Current</option>
					</select>
				</td>
              </tr>
			  <?php
			  }
			  ?>
              
            </tbody>
          </table>
          <!-- TBL-WRAP END -->
        </div>
		<input type="submit" class="btn" id="save" name="save" value="save" />
		<?php echo form_close();?>
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
});
</script>