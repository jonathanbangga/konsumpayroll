<div class="main-content">
<div style="display:none;" class="highlight_message">Message</div>
        <!-- MAIN-CONTENT START -->
        <p>Select loan types that will be used as a deduction to employees<br>
          To add loan record for an employee, go to the loans tab in company settings</p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
		  <?php
		  if($l_sql->num_rows()>0){ ?>
			<table style="width:100%;">
			<?php
			foreach($l_sql->result() as $l){ ?>
				<tr>
					<td>
						<input style="margin:2px 5px 0 0;" class="loan_id" type="checkbox" value="<?php echo $l->loan_type_id; ?>" />
						<span class="edit"><?php echo $l->loan_type_name ?></span>
					</td>
				</tr>
			<?php
			}
			?>
			</table>
		  <?php
		  }else{
			echo "No loans yet";
		  }
		  ?>
          <!-- TBL-WRAP END -->
        </div>
        <a href="javascript:void(0);" class="btn" id="btn-add">ADD</a>
		<a href="javascript:void(0);" class="btn" id="btn-delete">DELETE</a>
        <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray left" href="#">BACK</a> <a class="btn btn-gray right" href="#"> CONTINUE</a>
        <!-- FOOTER-GRP-BTN END -->
      </div>
	  
<div id="add-more" class="jdialog"  title="Add">
	<div class="inner_div">
		<p>
			Enter Loan:<br />
			<input class="txtfield" id="loan" type="text">
		</p>
	</div>
</div>

<div id="confirm-delete-dialog" class="jdialog"  title="Delete">
	<div class="inner_div">
		Are you sure you want to delete? 
	</div>
</div>  

<div id="update-details" class="jdialog"  title="Edit">
	<div class="inner_div">
		<p>
			Loan:<br />
			<input class="txtfield" id="edit_loan" type="text">
		</p>
	</div>
</div>

<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>

<style>
.edit{
	cursor:pointer;
}
</style>
<script>
jQuery(document).ready(function(){

	// load highlight message script
	redirect_highlight_message();

	// add loan
	jQuery("#btn-add").click(function(){
		jQuery("#loan").val("");
		jQuery("#add-more").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'save': function() {
					var error = "";
					var loan = jQuery("#loan").val();
					error += (loan=="")?"Loan field is empty":"";
					if(error==""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/loans/ajax_add_loans",
							data: {
								loan: loan,
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
							jQuery.cookie("msg", "Loan has been Added");
							window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/loans";
						});	
					}else{
						alert(error);
					}		
				}
			}
		});		
	});
	
	// delete loan
	jQuery("#btn-delete").click(function(){
		var obj = jQuery(this);
		var loan_id;
		if(jQuery(".loan_id:checked").length>0){
			jQuery("#confirm-delete-dialog").dialog({
				modal: true,
				show: {
					effect: "blind"
				},
				buttons: {
					'yes': function() {
						var loan_id = new Array();
						jQuery(".loan_id:checked").each(function(index){
							loan_id[index] = jQuery(this).val();
						});
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/loans/ajax_delete_loans",
							data: {
								loan_id: loan_id,
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
							jQuery.cookie("msg", "Loan has been deleted");
							window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/loans";
						});				
					},
					'no': function() {
						jQuery(this).dialog( 'close' );					
					}
				}
			});
		}
	});
	
	// update load
	jQuery(".edit").click(function(){
		var obj = jQuery(this);
		var loan = obj.html();
		jQuery("#edit_loan").val(loan);
		jQuery("#update-details").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'update': function() {
					var loan_id = obj.parents("tr:first").find(".loan_id").val();
					var loan = jQuery("#edit_loan").val();
					var error = "";
					error += (loan=="")?"Loan field is empty":"";
					if(error==""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/loans/ajax_update_loans",
							data: {
								loan_id: loan_id,
								loan: loan,
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
							jQuery.cookie("msg", "Loan has been updated");
							window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/loans";
						});	
					}else{
						alert(error);
					}
								
				}
			}
		});

	});
	
});
</script>