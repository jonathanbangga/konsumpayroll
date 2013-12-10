<div class="main-content">
        <!-- MAIN-CONTENT START -->
        <?php echo form_open('/robby_dubdub',array("onsubmit"=>"return save_roles();","id"=>"form_permis"));?>
        <div class="tbl-wrap employment-type-wrap">
          <table>
            <tbody>
            <tr>
            <td>
            ACCOUNT TYPE
            </td>
              <td class="assign_permis">ROLES</td>
              <td></td>
            </tr>
            <tr>
              <td style="width: 221px;">
              	<select name="user_roles_type" class="txtselect" style="width:160px;">
                  <option value="">Please select</option>
                  <option value="1">Administrator</option>
                  <option value="2">Employee</option> 
                </select>
              </td>
              <td class="assign_permis"><input type="text" name="roles" class="txtfield"></td>
            </tr>
          </tbody></table>
        </div>
        <div class="employment-type-wrap assign_permis">
          <!-- EMPLOYMENT-TYPE-WRAP START -->
          <p>Assign permissions by moving right items from left to right</p>
          <div class="btn-move">
          	<a href="#" class="btn-move-left" id="sign_left">left</a>
            <a href="#" class="btn-move-right"  id="sign_right">right</a>
          </div>
          <select name="" multiple="multiple" class="txtselect select-employement-type left" id="select_assign">
            <option value="payroll_setup">payroll setup</option>
            <option value="payroll_setup_view">payroll setup view</option>
            <option value="payroll_setup_edit">payroll setup edit</option>
            <option value="payroll_setup_delete">payroll setup delete</option>
            <option value="employee">employee</option>
            <option value="employee_view">employee view</option>
            <option value="employee_edit">employee edit</option>
            <option value="employee_delete">employee delete</option>
            <option value="approval">approval</option>
            <option value="approval_view">approval view</option>
            <option value="approval_edit">approval edit</option>
            <option value="approval_delete">approval delete</option>
            <option value="inquiry">inquiry</option>
            <option value="inquiry_view">inquiry view</option>
            <option value="inquiry_edit">inquiry edit</option>
            <option value="inquiry_delete">inquiry delete</option>
            <option value="reports">reports</option>
            <option value="reports_view">reports view</option>
            <option value="reports_edit">reports edit</option>
            <option value="reports_delete">reports delete</option>
            <option value="tables">tables</option>
            <option value="tables_view">tables view</option>
            <option value="tables_edit">tables edit</option>
            <option value="tables_delete">tables delete</option>
          </select>
          <select name="roles_areas[]" multiple="multiple" id="select_choosen" class="txtselect select-employement-type right"></select>
          
          <select name="hidden_roles[]" class="para_choio" style="overflow:hidden;height:0;width:0" multiple="multiple" id="hidden_roles">
          
          </select>
        
          <!-- EMPLOYMENT-TYPE-WRAP END -->
          <div class="clearB right">
          <input type="submit" name="submit" value="SUBMIT" class="btn" />
          </div>
          
        </div>
        <?php echo form_close();?>
        <!-- MAIN-CONTENT END -->
      </div>
      <script type="text/javascript">
      	var token = "<?php echo itoken_cookie();?>";
      	// reset this
      	function reset_inputs(){
      		jQuery("select[name='user_roles_type']").val('');
      		jQuery("input[name='roles']").val('');
        }
      	
      	function move_left(){
      		jQuery(document).on("click","#sign_left",function(e){
      		    e.preventDefault();
      		    var clone_select = jQuery("#select_assign option:selected").clone().attr("selected","selected");
      		    jQuery("#select_choosen").append(clone_select);
      		    jQuery("#select_assign option:selected").remove();	
      		    var roles_choose = jQuery("#select_choosen option").clone().attr("selected","selected");
      			jQuery("#hidden_roles").html(roles_choose); 
       		   
      		}); 
        }
      	function move_right(){
      		jQuery(document).on("click","#sign_right",function(e){
      		    e.preventDefault();
      		    var clone_select = jQuery("#select_choosen option:selected").clone();
      		    jQuery("#select_assign").append(clone_select);
      		 	
      		    jQuery("#select_choosen option:selected").remove();

      		  	var roles_choose = jQuery("#select_choosen option").clone().attr("selected","selected");
    			jQuery("#hidden_roles").html(roles_choose); 
      		
      		});
        }

		// SAVES ROLES
		function save_roles(){
			jQuery("body").css("cursor","wait");
			var urls = "/<?php echo $this->subdomain;?>/hr/users/permissions";
			var fields = {
				"user_roles_type":jQuery("select[name='user_roles_type']").val(),
				"roles":jQuery("input[name='roles']").val(),
				"hidden_roles[]":jQuery("#hidden_roles").val(),
				"ZGlldmlyZ2luamM":jQuery.cookie(token),
				"submit":"true"
			};
			kpay.overall.ajax_save(urls,fields);
			jQuery("body").css("cursor","auto");
			return false;
		}

		// WHEN CHOOSE EMPLOYEE HIDE IT
		function hide_employee_options(){
			jQuery(document).on("change","select[name='user_roles_type']",function(e){
			    var el = jQuery(this);
			   if(el.val() == 2){
			    jQuery("#form_permis").attr("onsubmit","return false;");
			    jQuery(".assign_permis").fadeOut('slow');
			   }else if(el.val()== 1){
			    jQuery("#form_permis").attr("onsubmit","return save_roles();");
			    jQuery(".assign_permis").fadeIn('slow');
			   }else{
			   jQuery("#form_permis").attr("onsubmit","return false;");
			    jQuery(".assign_permis").fadeOut('slow');
			   }
			});
		}
		
      	
        jQuery(function(){
        	move_left();
        	move_right();
        	reset_inputs();
        	hide_employee_options();
        });
      </script>