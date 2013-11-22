<?php echo form_open($this->uri->uri_string);?>

<div class="main-content">
    <!-- MAIN-CONTENT START -->
    <div class="success_trigger">
    	<div class="isuccess_profile"><?php echo $this->session->flashdata("success");?></div>
    	 <div class="error ihide" id="error_trigger"><?php echo $error;?></div>
    </div>
    <div class="tbl-wrap">
        <!-- TBL-WRAP START -->
        <table>
            <tr>
                <td style="vertical-align:top;width:400px;">
					<h1>My Profile</h1>
                    <table>
                        <tr>
                            <td style="width:155px">First Name:</td>
                            <td>
                                <input type="text" name="first_name" value="<?php echo set_value("first_name",$name->first_name);?>" class="txtfield">
                            </td>
                        </tr>
                        <tr>
                            <td>Last Name:</td>
                            <td>
                                <input type="text" name="last_name" value="<?php echo set_value("last_name",$name->last_name);?>" class="txtfield">
                            </td>
                        </tr>
                        <tr>
                            <td>Middle Name:</td>
                            <td>
                                <input type="text" name="middle_name" value="<?php echo set_value("middle_name",$name->middle_name);?>" class="txtfield">
                            </td>
                        </tr>
                        <tr>
                            <td>BirthDate:</td>
                            <td>
                                <input type="text" name="birth_date" value="<?php echo set_value("birth_date",$name->dob);?>" class="txtfield">
                            </td>
                        </tr>  
                    </table>
                </td>
                <td>
                	<h1>Contact Information</h1>
                    <table>
                        <tr>
                            <td style="width: 205px;">Mobile Number:</td>
                            <td>
                                <input type="text" name="mobile_no" value="<?php echo set_value("mobile_no",$name->mobile_no);?>" class="txtfield">
                            </td>
                        </tr>
                        <tr>
                            <td>Telephone Number:</td>
                            <td>
                                <input type="text" name="home_no" value="<?php echo set_value("home_no",$name->home_no);?>" class="txtfield">
                            </td>
                        </tr>
                        <?php if($this->access_type !=2){?>
                        <tr>
                            <td>Email:</td>
                            <td>
                                <input type="text"  name="email_add" value="<?php echo set_value("email_add",$name->email);?>" class="txtfield">
                                 <input type="hidden"  name="old_email_add" value="<?php echo $name->email;?>" class="txtfield">
                            </td>
                        </tr>
                        <?php }?>
                        <tr>
                            <td>Home Address:</td>
                            <td>
                                <input type="text"   name="home_add"  value="<?php echo set_value("home_add",$name->home_no);?>"  class="txtfield">
                            </td>
                        </tr>
                        <tr>
                            <td>Emergency Contact Person:</td>
                            <td>
                                <input type="text"  value="<?php echo set_value("emergency_contact_person",$name->emergency_contact_person);?>" name="emergency_contact_person" class="txtfield">
                            </td>
                        </tr>
                        <tr>
                            <td>Emergency Contact Number:</td>
                            <td>
                                <input type="text"  value="<?php echo set_value("emergency_contact_number",$name->emergency_contact_number);?>"  name="emergency_contact_number" class="txtfield">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                <h1>Account Information</h1>
                    <table>
                    <?php if($this->access_type !=2){ ?>
                    		<tr>
	                            <td style="width:155px">Username:</td>
	                            <td>
	                                <input type="text" name="payroll_cloud_id" value="<?php echo set_value("payroll_cloud_id",$name->payroll_cloud_id);?>" class="txtfield" readonly="readonly">
	                            </td>
                        	</tr>
	                        
                   <?php }else{ ?>
                    		<tr>
	                            <td style="width:155px">Email:</td>
	                            <td>
	                                <input type="text"  name="email_add" value="<?php echo set_value("email_add",$name->email);?>" class="txtfield">
	                            </td>
	                        </tr>
                   <?php }?>
                        <tr>
                            <td>Old Password:</td>
                            <td>
                                <input type="password" name="old_password" class="txtfield">
                            </td>
                        </tr>
                        <tr>
                            <td>New Password:</td>
                            <td>
                                <input type="password" name="new_password" class="txtfield">
                            </td>
                        </tr>
                        <tr>
                            <td>Retype Password:</td>
                            <td>
                                <input type="password" name="retype_password" class="txtfield">
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <td style="width: 205px;">Security Question:</td>
                            <td>
                                <input type="text" name="security_question" value="<?php echo $name->security_question;?>" class="txtfield">
                            </td>
                        </tr>

                        <tr>
                            <td>Security Answer:</td>
                            <td>
                                <input type="password" value="<?php echo $name->security_answer;?>"  name="security_answer" class="txtfield">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
            	<td>&nbsp;
            	</td>
            	<td style="text-align:right;">
            		
            		<input type="submit" name="save" value="SUBMIT" class="btn">
            		<a href="#" class="btn">CANCEL</a>
            	</td>
            </tr>
        </table>
        
        <!-- TBL-WRAP END -->
    </div>
    <!-- MAIN-CONTENT END -->
</div>
 <?php echo form_close();?>
 <script type="text/javascript">
	function error_show(){
		var a = jQuery.trim(jQuery("#error_trigger").html());
		if(a){
			alert(a);
			return false;
		}
	}
	jQuery(window).load(function(){
		error_show();
 	});
 </script>