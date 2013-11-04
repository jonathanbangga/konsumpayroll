	<!-- MAIN-CONTENT START -->
        <p>Input this form with the people you need to run the payroll process.<br>
          The person is responsible for confirming the payroll run before releasing the funds.</p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl">
            <tr>
              <th>Employee Number</th>
              <th style="width:170px">Name</th>
              <th>Level</th>
              <th style="width:160px">Action</th>
            </tr>
		<?php 
		if($approvers_list){
			foreach($approvers_list as $list):
		?>
             <tr id="jwrap_<?php echo $list->account_id?>">
              <td><?php echo $list->payroll_cloud_id;?></td>
              <td><?php echo $list->first_name." ".$list->last_name;?></td>
              <td><?php echo $list->first_name." ".$list->last_name;?></td>
              <td>
	              <a class="btn btn-gray btn-action jedit_approvers" href="#" account_id="<?php echo $list->account_id?>" comp_id="<?php echo $this->uri->segment(4);?>">EDIT</a> 
	              <a class="btn btn-red btn-action jdel_approvers" href="#" account_id="<?php echo $list->account_id?>" comp_id="<?php echo $this->uri->segment(4);?>" >DELETE</a>
              </td>
            </tr>
		<?php 		
			endforeach;
		} else {
		?>
			<tr>
              <td colspan="4"><?php echo msg_empty();?></td>
            </tr>
		<?php 
		}
		?>  
          </table>
          <!-- TBL-WRAP END -->
        </div>
        <input class="btn jpop_approver" name="" type="button" value="ADD APPROVER">
        <div class="ihides">
		<div class="jpop_approvers" title="Add Approver">
			<?php 
				echo form_open("",array("class"=>"we"));
				echo validation_errors("<span class='error_zone'>","</span>");
			?>
			<table>
				<tbody>
					<tr>
					  <td style="width:155px">Last Name:</td>
					  <td><input type="text" value="" name="lname" class="txtfield">					  
					  </td>
					</tr>
					<tr>
					  <td>First Name: </td>
					  <td><input type="text"  name="fname" class="txtfield">					 
					  </td>
					</tr>
					<tr>
					  <td>Middle Name: </td>
					  <td><input type="text"  name="mname" class="txtfield">					  
					  </td>
					</tr>
					<tr>
					  <td>Fax: </td>
					  <td><input type="text"  name="fax" class="txtfield">					  
					  </td>
					</tr>
					<tr>
					  <td>Email: </td>
					  <td><input type="text"  name="email" class="txtfield">					  
					  </td>
					</tr>
					<tr>
					  <td>Contact No: </td>
					  <td><input type="text"  name="contact_no" class="txtfield">
					  </td>
					</tr>
					<tr>
					  <td>Username: </td>
					  <td><input type="text"  name="username" class="txtfield">
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
		</div>
	<!-- MAIN-CONTENT END -->
	<script type="text/javascript">
		jQuery(function(){
			kpay.owner.approvers.popup_approver();
			kpay.owner.approvers.delete_approver('/company/approvers/remove_company_approver/','<?php echo itoken_cookie();?>',"Are you sure you want to delete this user?");
		});
	</script>