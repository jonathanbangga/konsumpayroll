 <div class="tbl-wrap">
        <h1>Company List</h1>
	<?php if($company->num_rows()>0){ ?>
		<table class="company-list-tbl">
			<?php 
			if($company->result()){
				foreach($company->result() as $row){?>
				 <tr>
	              <td class="txtcenter" style="width:200px;">
	             	 <img src="<?php echo image_exist($row->company_logo,$row->company_id);?>" class="list_logos" alt=" ">              
	              </td>
	              <td style="width:340px;"><h1><?php echo $row->company_name;?></h1></td>
	              <td style="width:200px;" class="txtright">
	              <a class="btn btn-gray" href="<?php echo "/{$sub_domain}/dashboard/company_list/manage/{$row->company_id}/{$row->sub_domain}"; ?>">MANAGE</a> 
	              <a class="btn btn-red jdash_delete" company_id="<?php echo $row->company_id;?>" href="#">DELETE</a>
	              </td>
	            </tr>
				<?php 
				} 
			}else{
				echo "<tr>";
				echo "<td>".msg_empty()."</td>";
				echo "</tr>";
			}
			?>
          </table>
	<?php
	}else{
		echo "No company has been set up yet. To create, please click [Add Company]";
	}
	?>   
        </div>
        <a href="/<?php echo $sub_domain; ?>/company_setup/company_information/" class="btn">ADD COMPANY</a>

        <script type="text/javascript">
        	var token = "<?php echo itoken_cookie();?>";
        	// DELETES THE COMPANY
        	function jcompany_delete(){
				jQuery(document).on("click",".jdash_delete",function(e){
					e.preventDefault();
					var el = jQuery(this);
					var comp_id = el.attr("company_id");
					var urls = "/<?php echo $this->uri->segment(1);?>/dashboard/company_list/delete_company";
					var fields = {
							"company_id":comp_id,
							"ZGlldmlyZ2luamM": jQuery.cookie(token)	
					};

					jQuery(".opt_selection").empty().html("If you delete this company all data to this company will be deleted.<br/> Are you sure you want to delete this?");
					jQuery(".opt_selection").dialog({
						resizable: false,
						draggable: false,
						height: 150,
						modal: true,
						width: '320',
						maxWidth: '600',
						buttons: {
							"Yes": function () {
					
							jQuery.post(urls,fields,function(json){
								var res = jQuery.parseJSON(json);	
								console.log(res);
								if(res.success == '0'){
									alert(res.error);
								}else{
									jQuery(".success_messages").empty().html("<p>Successfully Deleted !</p>");
									window.location.href = "/<?php echo $this->uri->segment(1);?>/dashboard/company_list";
								}
							});	
							},
							No: function () {
								jQuery(".opt_selection").dialog("close");
							}
						}
					});
				});
            }
        	jQuery(function(){
        		jcompany_delete();
            });
        </script>
