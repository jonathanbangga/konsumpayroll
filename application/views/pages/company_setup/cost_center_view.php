       <p>You can assign departments and employees to specific cost centers.<br>
          Specify the cost center and it's description.</p>
         <?php echo form_open("",array("onsubmit"=>"return save_cost_center();"))?>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl" id="cost_center_table">
            <tbody><tr>
              <th>Cost Center Code</th>
              <th style="width:190px">Description</th>
              <th style="width:153px">Action</th>
            </tr>
            <?php 
            	if($cost_center_list){
            		foreach($cost_center_list as $clist):
            ?>
            		 <tr>
		              <td><?php echo $clist->cost_center_code;?></td>
		              <td><?php echo $clist->description;?></td>
		              <td><a href="#" class="btn btn-gray btn-action">EDIT</a> <a href="#" class="btn btn-red btn-action">DELETE</a></td>
           			</tr>	
            <?php
            		endforeach;
            	} else {
            	}
            ?>
          </tbody></table>
          <!-- TBL-WRAP END -->
        </div>
        <a href="#" class="btn" id="cost_addmore">ADD MORE</a> <input type="submit" name="submit" value="submit" class="btn" id="submit_cost_center" />
        <?php echo form_close();?>
        <div id="jadd_costcenter" title="Add Cost Center" class="ihide">
        <?php //echo form_open("",array("onsubmit"=>"return kpay.owner.cost_center.add_costcenter('/company/company_setup/cost_center/index');"))?>
         <?php echo form_open("");?>
        	<table>
			    <tbody>
			        <tr>
			            <td>Cost Center Code:</td>
			        </tr>
			        <tr>
			            <td>
			                <input type="text" class="txtfield" name="cost_center_code" value="" style="width:300px">
			            </td>
			        </tr>
			        <tr>
			            <td>Description:</td>
			         </tr>
			        <tr>
			            <td>
			              
			                <textarea style="width: 316px; height: 129px;" name="add_desc">
			                
			                </textarea>
			            </td>
			        </tr>
			        <tr>
			          
			            <td>
			                <table>
			                    <tr>
			                        <td style="width: 73px;">
			                            <input type="submit" class="btn" name="submit" value="Save">
			                        </td>
			                        <td>
			                            <input type="button" class="btn add_principal_cancel" name="cancel" value="Cancel">
			                        </td>
			                    </tr>
			                </table>
			            </td>
			        </tr>
			    </tbody>
			</table>
			<?php echo form_close();?>
        </div>
        
        <script type="text/javascript">
			// APPEND TABLE FIELD
			function more_center(){
				var html ='<tr>';
					html +='<td>';
					html +='<input type="text" name="cost_center_code[]" class="cost_inputs ccode">';
					html +='</td>';
					html +='<td>';
					html +='<input type="text" name="cost_center_description[]"  class="cost_inputs">';
					html +='</td>';
					html +='<td><a class="btn btn-red btn-action cost_append_del" href="#" >DELETE</a>';
					html +='</td>';
					html +='</tr>';
				return html;
			}
        
        	function show_more_center(){
        		jQuery(document).on("click","#cost_addmore",function(e){
        		    e.preventDefault();
        		    var el = jQuery(this);
        		    jQuery("#cost_center_table").append(more_center());
        		    jQuery(".success_messages").empty().html("<p>You have Successfully Deleted</p>");
        			//kpay.overall.show_pops("#jadd_costcenter");
        		});
        	}

			// DELETES THE APPEND MORE CENTER
			function delete_append_center(){
				jQuery(document).on("click",".cost_append_del",function(e){
					e.preventDefault();
					jQuery(this).parents("tr").remove();
				});
			}

			//  SUBMITS 
			function save_cost_center(){
				var icode = jQuery(".ccode").length;
				if(icode > 0){
					var cost_center_code = array_fields("input[name='cost_center_code[]']");
					var cost_center_desc = array_fields("input[name='cost_center_description[]']");
					// ADDD ERROR HERE
					ierror_field('.cost_inputs');
					if(ierror_mark(".cost_inputs") > 0){
						return false;
					}else{
						kpay.owner.cost_center.add_costcenter('/company/company_setup/cost_center/index',"<?php echo itoken_cookie();?>",cost_center_code,cost_center_desc);
						return false;
					}
				}else{
					return false;
				}
			}
			
        	
        	jQuery(function(){
        		show_more_center();
        		delete_append_center();
            });
        </script>