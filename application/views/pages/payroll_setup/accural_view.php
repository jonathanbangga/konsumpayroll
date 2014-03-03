<div class="main-content">
        <!-- MAIN-CONTENT START -->
      <p>This process is optional, only if your company accrues expenses like 13th month, christmas party,<br>

retrechment,and so on. Enter the name of the accrual process, define the variables that will be used (note: variables should be one of the columns in payroll run) and create the formula as accurate as possible.</p>

<div class="tbl-wrap">
<?php print $this->session->flashdata('message');?>
          <!-- TBL-WRAP START -->
          <table class="tbl">
            <tbody>
            <tr>
              <th style="width:135px;">Accrual Name</th>
              <th style="width:245px">Variables</th>
              <th style="width:230px;">Formula</th>
              <th style="width:160px">Action</th>
            </tr>
            <?php 
            	if($accural != NULL){
            		foreach($accural as $row){
            ?>
            <tr>
              <td><?php print $row->accural_name;?></td>
              <td><?php print $row->item_one.", ".$row->item_two.", ".$row->item_three;?></td>
              <td><?php print $row->formula;?></td>
              <td>
              	<a href="javascript:void(0);" class="btn btn-gray btn-action edit_btn" attr_accural_id="<?php print $row->accural_id;?>">EDIT</a> 
              	<a href="javascript:void(0);" class="btn btn-red btn-action del_btn" attr_accural_id="<?php print $row->accural_id;?>">DELETE</a>
              </td>
            </tr>
            <?php
            		}
            	}else{
            		print "<tr class='msg_empt_cont'><td colspan='4' style='text-align:left;'>".msg_empty()."</td></tr>";
            	}
            ?>
            
          </tbody></table>
          <!-- TBL-WRAP END -->
        </div>
      <a href="javascript:void(0);" class="btn add_more_btn">ADD MORE</a>
        <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray left" href="javascript:history.go(-1);">BACK</a> 
        <!-- FOOTER-GRP-BTN END -->
      </div>
      <div class='del_msg ihide' title='Confirmation'>Do you really want to delete this accural?</div>
      <script>
      	function accural_heigth(){
      		jQuery('.parent-vertical').each(function(){
      			var obj = $(this),
      				innerobj = obj.find('.inner-vertical'),
      				innerobjHeight = innerobj.height(),
      				parent_height = $(this).height(),
      				innerobjTop = (parent_height - innerobjHeight) / 2;
      				innerobj.css('margin-top',innerobjTop);
      			});
		}


      	function add_more_btn(){
			jQuery(".add_more_btn").click(function(){
				jQuery(".add_accural_cont").fadeIn('fast');
				accural_heigth();
				jQuery('body,html').animate({scrollTop:0},800);
			});
		}

		function cancel_btn(){
			jQuery(".cancel_btn").click(function(){
				jQuery(".addaccural-box").fadeOut('fast');
			});
		}
		
		function _successContBox(){
			var successContBox = jQuery.trim(jQuery(".successContBox").text());
			if(successContBox != ""){
			    jQuery(".successContBox").css("display","inline-block");
			    setTimeout(function(){
			        jQuery(".successContBox").fadeOut('100');
			    },3000);
			}
		}		

		function del_accural(){
			jQuery(".del_btn").click(function(){
			    var _this = jQuery(this);
			    var accural_id = _this.attr("attr_accural_id");
			    jQuery(".del_msg").dialog({
			    	width: 'inherit',
			    	draggable: false,
			    	modal: true,
			    	width:'auto',
			    	minWidth:'400',
			    	dialogClass:'transparent',
			    	buttons: {
			    		'Yes': function(){
			    			$.ajax({
			    				url: window.location.href,
			    				type: "POST",
			    				data: {
			    					'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
			    					'del_accural': '1',
			    					'accural_id':accural_id
			    				},
			    				success: function(data){
			    					var status = jQuery.parseJSON(data);
			    					if(status.success == 1){
			    						window.location.href = status.url;
			    					}else{
			    						return false;
			    					}
			    				}
			    			});
			    		},
			    		'No': function() {
			    			$( this ).dialog( "close" );
			    		}
			    	},
			    	overlay: {
			    	   opacity: 0
			    	}
			    });
			});
		}

		function edit_accural(){
			jQuery(".edit_btn").click(function(){
			    var _this = jQuery(this);
			    var accural_id = _this.attr("attr_accural_id");
			    jQuery(".edit_accural_cont").fadeIn("fast");
			    accural_heigth();
			    jQuery('body,html').animate({scrollTop:0},800);
			    $.ajax({
			        url: window.location.href,
			        type: "POST",
			        data: {
			            'ZGlldmlyZ2luamM':jQuery.cookie("<?php echo itoken_cookie();?>"),
			            'edit_accural': '1',
			            'accural_id':accural_id
			        },
			        success: function(data){
			            var status = jQuery.parseJSON(data);
						jQuery(".accural_id").val(status.accural_id);
						jQuery(".name_edit").val(status.accural_name);
						jQuery(".item_one_edit").val(status.item_one);
						jQuery(".item_two_edit").val(status.item_two);
						jQuery(".item_three_edit").val(status.item_three);
						jQuery(".formula_edit").val(status.formula);
			        }
			    });
			});
		}
		
		jQuery(function(){
			add_more_btn();
			cancel_btn();
			_successContBox();
			del_accural();
			edit_accural();
		});
      </script>
