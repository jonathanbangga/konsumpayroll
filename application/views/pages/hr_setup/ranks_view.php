<div style="display:none;" class="highlight_message">Message</div>
<!-- RBOX START -->
     <div class="main-content">
       <!-- MAIN-CONTENT START -->
     <p>The rank that you define here is assigned to the employees you create and is used to determine the leave entitlement</p>
      <div class="tbl-wrap">
      <!-- TBL-WRAP START -->
	  <?php
	  if($ranks_sql->num_rows()>0){ ?>
	  
		  <table class="tbl">
			  <tr>
				<th style="width:65px">Rank</th>
				<th style="width:276px">Description</th>
				<th style="width:90">Action</th>
			  </tr>
			  <?php
			  foreach($ranks_sql->result() as $rank){ ?>
				<tr>
					<td><?php echo $rank->rank; ?></td>
					<td><?php echo $rank->description; ?></td>
					<td>
						<a class="btn btn-red btn-action btn-delete" href="javascript:void(0)">DELETE</a>
						<input type="hidden" class="rank_id" value="<?php echo $rank->rank_id; ?>" />
					</td>
					
				</tr>
			  <?php
			  }
			  ?>
			</table>
	  
	  <?php
	  }else{
		echo "No ranks yet";
	  }
	  ?>
        
          <!-- TBL-WRAP END -->
      </div>
      <a class="btn" id="add-more" href="javascript:void(0);">ADD MORE</a>
	  <a class="btn" id="save" style="display:none;" href="javascript:void(0);">SAVE</a>
      <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
      <a class="btn btn-gray left" href="#">BACK</a> <a class="btn btn-gray right" href="#"> CONTINUE</a>
          <!-- FOOTER-GRP-BTN END -->
      </div>
      <!-- RBOX END -->

<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>

<div id="confirm-delete-dialog" class="jdialog"  title="Add more">
	<div class="inner_div">
		Are you sure you want to delete?: 
	</div>
</div>

<script>
jQuery(document).ready(function(){

	// load highlight message script
	redirect_highlight_message();
	
	jQuery("#add-more").click(function(){
		var obj = jQuery(this);
		var str = ''+
		'<tr>'+
			'<td>'+
				'<input type="text" name="rank" class="rank">'+
			'</td>'+
			'<td>'+
				'<input type="text" name="description" class="description">'+
			'</td>'+
			'<td>'+
				'<a href="javascript:void(0)" class="btn btn-red btn-action btn-remove">REMOVE</a>'+
			'</td>'+
		'</tr>';
		jQuery("#save").show();
		jQuery(".tbl tbody").append(str)
	});
	
	jQuery("#save").click(function(){		
		var rank = new Array();
		var empty_rank = false;
		var not_numeric = false;
		jQuery(".rank").each(function(index){
			if(jQuery(this).val()==""){
				empty_rank = true;
			}else{
				if(is_numeric(jQuery(this).val())==false){
					not_numeric = true;
				}
			}
			rank[index] = jQuery(this).val();
		});
		var desc = new Array();
		jQuery(".description").each(function(index){
			desc[index] = jQuery(this).val();
		});
		var error = "";
		error += (empty_rank==true)?"Some ranks are left empty<br />":"";
		if(empty_rank==false){
			error += (not_numeric==true)?"Invalid rank input":"";
		}
		if(error==""){
			// ajax call
			jQuery.ajax({
				type: "POST",
				url: "/company/hr_setup/ranks/ajax_add_rank",
				data: {
					rank: rank,
					desc: desc,
					<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
				}
			}).done(function(ret){
				jQuery.cookie("msg", "Rank has been saved");
				window.location="/company/hr_setup/ranks";
			});
		}else{
			alert(error);
		}
	});
	
	// delete ranks
	jQuery(".btn-delete").click(function(){
		var obj = jQuery(this);
		jQuery("#confirm-delete-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'yes': function() {
					var rank_id = obj.parents("tr").find(".rank_id").val();
					if(rank_id!=""){
						// ajax call
						jQuery.ajax({
							type: "POST",
							url: "/company/hr_setup/ranks/ajax_delete_rank",
							data: {
								rank_id: rank_id,
								<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
							}
						}).done(function(ret){
							jQuery.cookie("msg", "rank has been deleted");
							window.location="/company/hr_setup/ranks";
						});
					}else{
						alert('rank Id is missing');
					}					
				},
				'no': function() {
					jQuery(this).dialog( 'close' );					
				}
			}
		});
	});
	
	// remove rank row
	jQuery(document).on("click",".btn-remove",function(){
		jQuery(this).parents("tr:first").remove();
		if(jQuery(".rank").length==0){
			jQuery("#save").hide();
		}
	});

});
</script>
