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
		              <td>
		              <a href="#" class="btn btn-gray btn-action jedit_cost_center" cost_id="<?php echo $clist->cost_center_id;?>" comp_id="<?php echo $this->company_id;?>">EDIT</a> 
		              <a href="javascript:void(0);" class="btn btn-red btn-action jdelete_cost_center" cost_id="<?php echo $clist->cost_center_id;?>"  comp_id="<?php echo $this->company_id;?>">DELETE</a>
		              </td>
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
        <div id="jeditparent_costcenter" title="Edit Cost Center" class="ihide">
         <?php echo form_open("",array("onsubmit"=>"return update_cost_center();"));?>
        	<table>
			    <tbody>
			        <tr>
			            <td>Cost Center Code:</td>
			        </tr>
			        <tr>
			            <td>
			            	<input type="hidden" class="old_edit_cost_center_code" id="old_edit_cost_center_code" name="old_edit_cost_center_code" readonly="readonly" />
			            	<input type="hidden" class="edit_id_cost_center" id="edit_id_cost_center" name="edit_id_cost_center" readonly="readonly" />
			            	<input type="hidden" class="edit_company_id" id="edit_company_id" name="edit_company_id" value="" readonly="readonly" />
			                <input type="text" readonly="readonly" class="txtfield" id="edit_cost_center_code" name="edit_cost_center_code" value="" style="width:300px">
			            </td>
			        </tr>
			        <tr>
			            <td>Description:</td>
			         </tr>
			        <tr>
			            <td>
			                <textarea style="width: 316px; height: 129px;" name="edit_desc" id="edit_desc"></textarea>
			            </td>
			        </tr>
			        <tr>
			            <td>
			                <table>
			                    <tr>
			                        <td style="width: 90px;">
			                            <input type="submit" class="btn" name="update_cost_centre" value="Update">
			                        </td>
			                        <td>
			                            <input type="button" class="btn cancel_cost_center" name="cancel" value="Cancel">
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

			//  SUBMITS COST CENTER
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

			// DELETES COST CENTER 
			function delete_cost_center(){
				jQuery(document).on("click",".jdelete_cost_center",function(e){
				    e.preventDefault();
				    var el = jQuery(this);
				    var cost_id = el.attr("cost_id");
				    var comp_id = el.attr("comp_id");
				    var cost_parents = el.parents("tr");

				    jQuery(".opt_selection").empty().html("Are you sure you want to delete this Cost center?");
					jQuery(".opt_selection").dialog({
						resizable: false,
						draggable: false,
						height: 150,
						modal: true,
						width: '320',
						maxWidth: '600',
						buttons: {
							"Yes": function () {
								kpay.owner.cost_center.delete_costcenter("/company/company_setup/cost_center/delete_cost_center","<?php echo itoken_cookie();?>",cost_id,comp_id);
								jQuery(".opt_selection").dialog("close");
								cost_parents.remove();
								jQuery(".success_messages").empty().html("<p>You have Successfully deleted</p>");
								kpay.overall.show_success(".success_messages");
							},
							No: function () {
								jQuery(".opt_selection").dialog("close");
							}
						}
					});
				    
				    
				});
			}

			// EDITS COST CENTER
			function edit_cost_centers(){
				jQuery(document).on("click",".jedit_cost_center",function(e){
				    e.preventDefault();
				    var el = jQuery(this);
				    var comp_id = el.attr("comp_id");
				    var cost_id = el.attr("cost_id");
				    if(comp_id !="" && cost_id !=""){
				    	var url = "/company/company_setup/cost_center/fetch_cost_center";
				    	kpay.owner.cost_center.get_cost_center(url,"<?php echo itoken_cookie();?>",comp_id,cost_id); 
				    }else{
					    alert("Something went wrong please contact administrator <br />if problem still persist, Sorry for the inconvenience");
						console.log("Naay error");
				    }   
				});
			}

			// CANCELS EDIT COST CENTERS
			function cancel_input_cost_centers(){
				jQuery(document).on("click",".cancel_cost_center",function(e){
				    jQuery("#jeditparent_costcenter").dialog("close");
				});
			}

			// UPDATES COST CENTER
			function update_cost_center(){
				var url = "/company/company_setup/cost_center/update_cost_center/";
				var token = "<?php echo itoken_cookie();?>";
				var cost_center_id = jQuery("input[id^='edit_id_cost_center']").val();
				var company_id = jQuery("input[id^='edit_company_id']").val();
				var cost_code = jQuery("input[id^='edit_cost_center_code']").val();
				var desc = jQuery("#edit_desc").val();
				var old_cost_center_id =  jQuery("input[id^='old_edit_cost_center_code']").val();
				kpay.owner.cost_center.update_cost_center(url,token,company_id,cost_center_id,cost_code,desc,old_cost_center_id);
				return false;
			}
        	
        	jQuery(function(){
        		show_more_center();
        		delete_append_center();
        		delete_cost_center();
        		edit_cost_centers();
        		cancel_input_cost_centers();
            });
        </script>