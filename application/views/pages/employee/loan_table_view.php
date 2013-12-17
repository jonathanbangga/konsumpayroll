<div class="new_header_cont">
	<h1>Loan History</h1>
</div>
<div class="tbl-wrap">
	<?php print $this->session->flashdata('message');?>
	<div class="loan_history_cont">
		<select style='width: 175px;' class='txtselect select-medium loan_type' name='loan_type'>
			<?php 
				if($loan_type == null){ 
					print "<option value=''>".msg_empty()."</option>"; 
				}else{ 
					print "<option></option>";
					foreach($loan_type as $row_lype){
				?> <option value='<?php print $row_lype->loan_type_id;?><?php echo set_select('loan_type[]', $row_lype->loan_type_id); ?>'><?php print $row_lype->loan_type_name;?></option><?php } }?></select>
	</div>
	<table style="width:933px;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:auto;">Loan Type</th>
              <th style="width:auto;">Loan Number</th>
              <th style="width:auto;">Date Granted</th>
              <th style="width:auto">Principal</th>
              <th style="width:auto;">Loan Balance</th>
              <th style="width:auto;">Monthly Amortazation</th>
              <th style="width:auto">Interest Rate</th>
              <th style="width:auto">Action</th>
            </tr>
		<?php 
			if($loan != null){
				foreach($loan as $row){
		?>
			<tr class="row_list">
				<td><?php print $row->loan_type_name;?></td>
				<td><?php print $row->loan_no;?></td>
				<td><?php print $row->date_granted;?></td>
				<td><?php print $row->principal;?></td>
				<td>
					<?php 
						print loan_balance($comp_id, $row->emp_id, $row->employee_loans_id);
					?>
				</td>
				<td><?php print $row->monthly_amortization;?></td>
				<td><?php print $row->interest_rates;?></td>
				<td><a class="btn" href="/<?php print $this->uri->segment(1);?>/employee/emp_payment_history/index/<?php print $row->employee_loans_id;?>">PAYMENT HISTORY</a></td>
			</tr>
		<?php 		
				}
			}else{
            		print "<tr class='msg_empt_cont'><td colspan='12' style='text-align:left;'>".msg_empty()."</td></tr>";
            	}
		?>
	</table>
</div>
<script>

	function loan_filter(){
		jQuery(".loan_type").on("change", function(){
			var loan_type_val = jQuery(this).val();
			if(loan_type_val != ""){
				$.ajax({
					url: window.location.href,
					type: "POST",
					data: {
						'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
						'for_loan_type': '1',
						'loan_type': loan_type_val
					},
					success: function(data){
						var trim_data = jQuery.trim(data);
						jQuery(".row_list").remove();
						jQuery(".emp_conList").append(trim_data);
					}
			    });
			}
		});
	}

	jQuery(function(){
		loan_filter();
	});
	
</script>