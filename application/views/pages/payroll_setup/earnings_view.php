<div style="display:none;" class="highlight_message">Message</div>
<div class="main-content">
        <!-- MAIN-CONTENT START -->
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt<br>
          ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation </p>
        <div class="tbl-wrap">
          <!-- TBL-WRAP START -->
          <table class="tbl">
            <tbody>
              <tr>
                <th style="width:135px;">Earnings</th>
                <th style="width:135px">Taxable</th>
                <th style="width:135px;">Max Non Taxable</th>
                <th style="width:135px">Witholding Tax Rate</th>
                <th style="width:160px">Action</th>
              </tr>
				<?php
				if($esql->num_rows()>0){
					foreach($esql->result() as $e){ ?>
						<tr>
							<td><span class="earnings_span"><?php echo $e->earning_name; ?></span></td>
							<td>
								<input type="hidden" class="taxable_span" value="<?php echo $e->taxable; ?>" />
								<?php echo ($e->taxable==1)?"yes":"no"; ?>
							</td>
							<td><span class="max_non_taxable_span"><?php echo $e->max_non_taxable; ?></span></td>
							<td><span class="withholding_tax_rate_span"><?php echo $e->withholding_tax_rate; ?></span></td>
							<td>
								<a href="javascript:void(0);" class="btn btn-gray btn-action btn-edit">EDIT</a> 
								<a href="javascript:void(0);" class="btn btn-red btn-action btn-delete">DELETE</a>
								<input type="hidden" class="earnings_id" value="<?php echo $e->earning_id; ?>" />
							</td>
						</tr>
					<?php
					}
				}else{
					echo '<tr><td colspan="5" id="empty">No earnings yet</td></tr>';
				}
				?>
            </tbody>
          </table>
          <!-- TBL-WRAP END -->
        </div>
        <a href="javascript:void(0);" id="add-more" class="btn">ADD MORE</a>
		<a class="btn" id="save" style="display:none" href="javascript:void(0);" id="add-project" >SAVE</a>
        <!-- MAIN-CONTENT END -->
      </div>
      <div class="footer-grp-btn">
        <!-- FOOTER-GRP-BTN START -->
        <a class="btn btn-gray left" href="#">BACK</a> <a class="btn btn-gray right" href="#"> CONTINUE</a>
        <!-- FOOTER-GRP-BTN END -->
      </div>
	  
<div id="confirm-delete-dialog" class="jdialog"  title="Add more">
	<div class="inner_div">
		Are you sure you want to delete? 
	</div>
</div>  

<div id="project-details-dialog" class="jdialog"  title="Edit Project">
	<div class="inner_div">
		<p>
			Earnings:<br />
			<input type="text" id="edit_earnings" name="edit_earnings" class="txtfield" />
		</p>
		<p>
			Taxable:<br />
			<select class="txtselect taxable" id="edit_taxable" style="width: 85px !important;margin-top: 10px;">
				<option value="-1">Select</option>
				<option value="1">Yes</option>
				<option value="0">No</option>
			</select>
		</p>
		<p>
			Max Non Taxable:<br />
			<input type="text" id="edit_max_non_taxable" name="edit_max_non_taxable" class="txtfield" />
		</p>
		<p>
			Witholding Tax Rate:<br />
			<input type="text" id="edit_witholding_tax" name="edit_witholding_tax" class="txtfield" />
		</p>
	</div>
</div>
	  
	  
<link href="/assets/theme_2013/css/custom/jc.css" rel="stylesheet" />
<script type="text/javascript"  src="/assets/theme_2013/js/jc.js"></script>

<style>
select{
	width: 75px!important;
}
</style>

<script>
jQuery(document).ready(function(){

	// load highlight message script
	redirect_highlight_message();
	
	// add earnings
	jQuery("#add-more").click(function(){
		jQuery("#empty").hide();
		str = ''+
			'<tr>'+
							'<td><input style="width:115px;" class="txtfield earnings" name="" type="text"></td>'+
							'<td>'+
								'<select class="txtselect taxable">'+
									'<option value="-1">Select</option>'+
									'<option value="1">Yes</option>'+
									'<option value="0">No</option>'+
								'</select>'+
							'</td>'+
							'<td><input style="width:115px;" class="txtfield max_non_taxable" name="" type="text"></td>'+
							'<td><input style="width:115px;" class="txtfield withholding_tax" name="" type="text"></td>'+
							'<td><a href="#" class="btn btn-gray btn-action">EDIT</a> <a href="javascript:void(0);" class="btn btn-red btn-action btn-remove">REMOVE</a></td>'+
						'</tr>';
		jQuery("#save").show();
		jQuery(".tbl tbody").append(str);
	});
	
	// remove earnings row
	jQuery(document).on("click",".btn-remove",function(){
		jQuery(this).parents("tr:first").remove();
		if(jQuery(".earnings").length==0){
			jQuery("#save").hide();
			jQuery("#empty").show();
		}
	});
	
	// save earnings
	jQuery("#save").click(function(){
		var empty = false;
		var earnings = new Array();
		jQuery(".earnings").each(function(index){
			if(jQuery(this).val()==""){
				empty = true;
			}
			earnings[index] = jQuery(this).val();
		});
		var taxable = new Array();
		jQuery(".taxable").each(function(index){
			taxable[index] = jQuery(this).val();
		});
		var max_non_taxable = new Array();
		jQuery(".max_non_taxable").each(function(index){
			max_non_taxable[index] = jQuery(this).val();
		});
		var withholding_tax = new Array();
		jQuery(".withholding_tax").each(function(index){
			withholding_tax[index] = jQuery(this).val();
		});
		if(empty==true){
			alert("Some Earning fields are empty");
		}else{
			// ajax call
			jQuery.ajax({
				type: "POST",
				url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/earnings/ajax_add_earnings",
				data: {
					earnings: earnings, 
					taxable: taxable,
					max_non_taxable: max_non_taxable,
					withholding_tax: withholding_tax,
					<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
				}
			}).done(function(ret){
				jQuery.cookie("msg", "New earnings had been saved!");
				window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/earnings";
			});
		}	
	});
	
	// delete earnings
	jQuery(".btn-delete").click(function(){
		var obj = jQuery(this);
		jQuery("#confirm-delete-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'yes': function() {
					var earnings_id = obj.parents("tr").find(".earnings_id").val();
					// ajax call
					jQuery.ajax({
						type: "POST",
						url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/earnings/ajax_delete_earnings",
						data: {
							earnings_id: earnings_id,
							<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
						}
					}).done(function(ret){
						jQuery.cookie("msg", "Earning has been deleted");
						window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/earnings";
					});				
				},
				'no': function() {
					jQuery(this).dialog( 'close' );					
				}
			}
		});
	});
	
	// edit project
	jQuery(".btn-edit").click(function(){
		var obj = jQuery(this);
		var earnings_id = obj.parents("tr").find(".earnings_id").val();
		var earnings = obj.parents("tr").find(".earnings_span").html();
		var taxable = obj.parents("tr").find(".taxable_span").val();
		var max_non_taxable = obj.parents("tr").find(".max_non_taxable_span").html();
		var witholding_tax_rate = obj.parents("tr").find(".withholding_tax_rate_span").html();
		jQuery("#edit_earnings").val(earnings);
		jQuery("#edit_taxable option").each(function(){
			if(jQuery(this).val()==taxable){
				jQuery(this).prop("selected",true);
			}
		});
		jQuery("#edit_max_non_taxable").val(max_non_taxable);
		jQuery("#edit_witholding_tax").val(witholding_tax_rate);
		jQuery("#project-details-dialog").dialog({
			modal: true,
			show: {
				effect: "blind"
			},
			buttons: {
				'update': function() {
					var earnings = jQuery("#edit_earnings").val();
					var taxable = jQuery("#edit_taxable").val();
					var max_non_taxable = jQuery("#edit_max_non_taxable").val();
					var witholding_tax = jQuery("#edit_witholding_tax").val();
					// ajax call
					jQuery.ajax({
						type: "POST",
						url: "/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/earnings/ajax_update_earnings",
						data: {
							earnings_id: earnings_id,
							earnings: earnings,
							taxable: taxable,
							max_non_taxable: max_non_taxable,
							witholding_tax: witholding_tax,
							<?php echo itoken_name();?>: jQuery.cookie("<?php echo itoken_cookie(); ?>")
						}
					}).done(function(ret){
						jQuery.cookie("msg", "Earnings has been updated");
						window.location="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/earnings";
					});	
				}
			}
		});
	});
	
});
</script>