<div class="tbl-wrap">	
		  <?php print $this->session->flashdata('message');?>
          <!-- TBL-WRAP START -->
          <table style="width:auto;" class="tbl emp_conList">
            <tbody><tr>
              <th style="width:50px;"></th>
              <th style="width:auto;">Employee Number</th>
              <th style="width:auto;">Employee Name</th>
              <th style="width:auto">Action</th>
            </tr>
            <?php 
            	if($emp_loan != NULL){
            		$counter = 1;
            		foreach($emp_loan as $row){
            ?>
	            <tr>
	              <td><?php print $counter++;?></td>
	              <td><?php print $row->payroll_cloud_id;?></td>
	              <td><?php print ucwords($row->first_name)." ".ucwords($row->last_name);?></td>
	              <td>
	              	<a href="/<?php print $this->uri->segment(1);?>/hr/emp_loan/index/<?php print $row->emp_id;?>" class="btn editBtnDb" attr_empid="<?php print $row->emp_id;?>">VIEW LOANS</a> 
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
        <div class="pagiCont_btnCont">
	        	<div class="left"><?php print $links;?></div>
	        	<div class="clearB"></div>
        	</div>
        <script>
	        function pagination(){
	    		jQuery("#pagination li").each(function(){
	    		    jQuery(this).find("a").addClass("btn");;
	    		});
	    	}

	    	jQuery(function(){
	    		pagination();
	    	});
        </script>
		<div class="footer-grp-btn">
		 <!-- FOOTER-GRP-BTN START -->
		 <a class="btn btn-gray left" href="javascript:history.go(-1);">BACK</a> 
		 <!-- FOOTER-GRP-BTN END -->
		 </div>