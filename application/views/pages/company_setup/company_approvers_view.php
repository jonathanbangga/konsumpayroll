	<div class="main-content">
	<!-- MAIN-CONTENT START -->
        <p>Input this form with the people you need to run the payroll process.<br>
          The person is responsible for confirming the payroll run before releasing the funds.</p>
       <?php 
       	echo form_open("company/company_setup/approvers");
       	echo $error ? $error['error'] : '';
       ?>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl">
            <tr>
              <th>Employee Number</th>
              <th style="width:170px">First Name</th>
              <th style="width:170px">Middle Name</th>
              <th style="width:170px">Last Name</th>
              <th>Level</th>
              <th style="width:160px">Action</th>
            </tr>
		<?php 
		if($approvers_list){
			foreach($approvers_list as $list):
		?>
			<tr id="jwrap_<?php echo $list->account_id?>">
			<td><?php echo $list->payroll_cloud_id;?></td>
			<td><?php echo $list->first_name;?></td>
			<td><?php echo $list->middle_name;?></td>
			<td><?php echo $list->last_name;?></td>
			<td><?php echo $list->level;?></td>
              <td>
	              <a class="btn btn-gray btn-action jedit_approvers" href="#" account_id="<?php echo base64_encode($list->account_id);?>" comp_id="<?php echo base64_encode($this->company_id);?>">EDIT</a> 
	              <a class="btn btn-red btn-action jdel_approvers" href="#" account_id="<?php echo base64_encode($list->account_id);?>" comp_id="<?php echo base64_encode($this->company_id);?>" >DELETE</a>
              </td>
            </tr>
		<?php 		
			endforeach;
		} else {
		?>
			<tr>
              <td colspan="6" class="noyet"><?php echo msg_empty();?></td>
            </tr>
		<?php 
		}
		?>  
          </table>
          <!-- TBL-WRAP END -->
        </div>
       
        <a href="#" class="btn jpop_approver">ADD MORE</a>  <input class="btn jpop_approver_save" name="approver_save" type="submit" value="ADD APPROVER">
        <?php echo form_close();?>
      </div>
        <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
     		 <a href="#" class="btn btn-gray left">BACK</a> <a href="#" class="btn btn-gray right"> CONTINUE</a>
          <!-- FOOTER-GRP-BTN END -->
      	</div>
    
        <div class="ihide">
		<!--  edit here  -->
		<div class="jpop_edit_approvers ihide" title="EDIT Approver">
			<?php 
				echo form_open("/company/company_setup/approvers/edit_approvers",array("class"=>"jform_approvers","onsubmit"=>"return approvers_edits();"));
			?>
			<table>
				<tbody>
					<tr class="ihide">
					<td>
						<input type="text" name="edit_company_id" id="edit_company_id" readonly="readonly" />
						<input type="text" name="edit_account_id" id="edit_account_id" readonly="readonly" />
					</td>
					</tr>
					<tr>
					  <td>First Name: </td>
					  <td><input type="text" id="edit_fname" name="edit_fname" class="txtfield">					 
					  </td>
					</tr>
					<tr>
					  <td style="width:155px">Last Name:</td>
					  <td><input type="text" value="" id="edit_lname" name="edit_lname" class="txtfield">					  
					  </td>
					</tr>
					<tr>
					  <td>Middle Name: </td>
					  <td><input type="text"  id="edit_mname"  name="edit_mname" class="txtfield">					  
					  </td>
					</tr>
					<tr>
					  <td>Email: </td>
					  <td><input type="text"  id="edit_email"  name="edit_email" class="txtfield">					  
					  </td>
					</tr>
					<tr>
					  <td>Mobile No: </td>
					  <td><input type="text"  id="edit_mobile"  name="edit_mobile" class="txtfield">
					  </td>
					</tr>
					<tr>
					  <td>Level: </td>
					  <td><input type="text"  id="edit_level"  name="edit_level" class="txtfield">
					  </td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" value="Save" name="submit" class="btn">
						<input type="button" value="Cancel" name="cancel" class="btn jcancel">
						</td>
					</tr>
			  </tbody>
			</table>
			<?php echo form_close();?>
		</div>
		<!-- edit here lightbox -->
		</div>
	<!-- MAIN-CONTENT END -->
	<script type="text/javascript">
		var itokens = "<?php echo itoken_cookie();?>";
		function create_approvers(){
			var html = '<tr class="new_approvers">';
				html +='<td>';
				html +='    <input type="text" name="emp_id[]" class="emp_fields">';
				html +='</td>';
				html +='<td>';
				html +='    <input type="text" name="first_name[]" class="emp_fields">';
				html +='</td>';
				html +='<td>';
				html +='    <input type="text" name="middle_name[]" class="emp_fields">';
				html +=' </td>';
				html +=' <td>';
				html +='     <input type="text" name="last_name[]" class="emp_fields">';
				html +='</td>';
				html +=' <td>';
				html +='    <input type="text" name="level[]" class="input_level">';
				html +='</td>';
				html +=' <td>';
				html +='    <a class="btn btn-gray btn-action jedit_approvers" href="#" account_id="" comp_id="">EDIT</a>';
				html +='     <a class="btn btn-red btn-action jdel_approvers" href="#" account_id="" comp_id="">DELETE</a>';
				html +=' </td>';
				html +='</tr>';
			return html;
		}

		function show_approver_fields(){
			jQuery(document).on("click",".jpop_approver",function(e){
				e.preventDefault();
				   var html =  create_approvers();
				   jQuery(".noyet").remove();	
				   jQuery(".tbl").append(html);
			});
		}

		function get_approvers(){
			jQuery(document).on("click",".jedit_approvers",function(e){
			    e.preventDefault();
			    var el = jQuery(this);
			    var company_id = el.attr("comp_id");
			    var account_id = el.attr("account_id");
			    kpay.owner.approvers.get_approvers('/company/company_setup/approvers/fetch_approvers/',itokens,company_id,account_id);	
			});
		}

		// SUBMIT UPDATES
		function approvers_edits(){
			kpay.owner.approvers.update_approverscompany('/company/company_setup/approvers/edit_approvers/',itokens);
			return false;
		}
		
	
		jQuery(function(){
			//kpay.owner.approvers.popup_approver();
			show_approver_fields();
			kpay.owner.approvers.delete_approver('/company/company_setup/approvers/remove_company_approver/',itokens,"Are you sure you want to delete this user?");
			get_approvers();
			
		});
	</script>