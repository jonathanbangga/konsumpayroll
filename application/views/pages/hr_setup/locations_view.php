<div style="display:none;" class="highlight_message">Message</div>
<div class="main-content">
        <!-- MAIN-CONTENT START -->
        <p>Add all project locations to be able to create reports per locations. You would also be able to<br>
        create mulitple locations.</p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
		  <?php
		  if($locations->num_rows()>0){ ?>
			<table class="tbl">
				<tr>
				  <th style="width:125px;">Project</th>
				  <th style="width:153px">Location</th>
				  <th style="width:250px">Description</th>
				  <th style="width:153px">Action</th>
				</tr>
				<?php
				foreach($locations->result() as $row){ ?>
				 <tr>
				  <td><?php echo $row->project_name; ?></td>
				  <td><?php echo $row->location; ?></td>
				  <td><?php echo $row->description; ?></td>
				  <td><a class="btn btn-gray btn-action" href="#">EDIT</a> <a class="btn btn-red btn-action" href="#">DELETE</a></td>
				</tr>
				<?php
				}
				?>
          </table>
		  <?php
		  }else{
			echo "No project locations yet";
		  }
		  ?>
          <!-- TBL-WRAP END -->
        </div>
        <a class="btn" href="javascript:void(0);" id="add-more">ADD MORE</a>
        <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a href="#" class="btn btn-gray left">BACK</a> <a href="#" class="btn btn-gray right"> CONTINUE</a>
        <!-- FOOTER-GRP-BTN END -->
      </div>
	  
<div id="add-more-dialog" class="jdialog"  title="Add more">
	<div class="inner_div">
		<p>
			Project:<br /> 
			<?php
			if($sql_proj->num_rows()>0){ ?>
				<select id="project">
					<option value="0">Select Project</option>
					<?php
					foreach($sql_proj->result() as $proj){ ?>
					<option value="<?php echo $proj->project_id; ?>"><?php echo $proj->project_name; ?></option>
					<?php
					}
					?>
				</select>
			<?php
			}else{
				echo "No projects yet";
			}
			?>
			
		</p>
		<p>
			Location:<br /> 
			<input type="text" id="location" name="location" />
		</p>
		<p>
			Description:<br /> 
			<input type="text" id="description" name="description" />
		</p>
	</div>
</div>
	  
<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>
<script>
	// load highlight message script
	redirect_highlight_message();
	// add more
	jQuery("#add-more").click(function(){
		/*
		jQuery("#add-more-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				save: function() {
					var proj = jQuery("#project").val();
					var loc = jQuery("#location").val();
					var desc = jQuery("#description").val();
					var error = "";
					error = (proj=="0")?"Select Project":"";
					if(error!=""){
						alert(error);
					}else{
						if(proj!=""){
							// ajax call
							jQuery.ajax({
								type: "POST",
								url: "/company/hr_setup/locations/ajax_project_location",
								data: {
									proj: proj, 
									loc: loc,
									desc: desc,
									<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
								}
							}).done(function(ret){
								if(ret==1){
									jQuery.cookie("msg", "New project had been saved!");
									window.location="/company/hr_setup/locations";
								}
							});
						}else{
							alert('Enter employment type');
						}
					}					
				}
			},
		});
		*/						
		str = ''+
			'<tr>'+
				'<td>'+
					'<select id="project" style="width: 80px;">'+
						'<option value="0">--select--</option>'+
						<?php
						$str = "";
						foreach($sql_proj->result() as $proj){ 
							$str .= '<option value="'.$proj->project_id.'">'.$proj->project_name.'</option>';
						}
						?>
						'<?php echo $str; ?>'+
					'</select>'+
				'</td>'+
				'<td><input type="text" name="location" id="location"></td>'+
				'<td><input type="text" name="description" id="description"></td>'+
				'<td><a href="javascript:void();" class="btn btn-red btn-action btn-remove">REMOVE</a></td>'+
			'</tr>';
		jQuery("#save").show();
		jQuery(".tbl tbody").append(str);
	});
	// remove location
	jQuery(document).on("click",".btn-remove",function(){
		jQuery(this).parents("tr:first").remove();
	});
</script>