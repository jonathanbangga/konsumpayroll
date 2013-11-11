       <p>You can assign departments and employees to specific cost centers.<br>
          Specify the cost center and it's description.</p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl">
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
            ?>  
            
            <?php 
            	}
            ?>
          </tbody></table>
          <!-- TBL-WRAP END -->
        </div>
        <a href="#" class="btn" id="cost_addmore">ADD MORE</a>
        
        <div id="jadd_costcenter" title="Add Cost Center" class="ihide">
        <?php echo form_open("",array("onsubmit"=>"return kpay.owner.cost_center.add_costcenter();"))?>
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
        	function show_more_center(){
        		jQuery(document).on("click","#cost_addmore",function(e){
        		    e.preventDefault();
        		    var el = jQuery(this);
        		    
        		    jQuery(".success_messages").empty().html("<p>You have Successfully Deleted</p>");
        			kpay.overall.show_pops("#jadd_costcenter");
        		});
        	}
        	jQuery(function(){
        		show_more_center();
            });
        </script>