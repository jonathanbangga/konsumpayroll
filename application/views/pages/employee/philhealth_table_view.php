		<div class="tbl-wrap">	
		  <?php print $this->session->flashdata('message');?>
          <!-- TBL-WRAP START -->
          <table class="tbl emp_conList">
            <tbody><tr>
              <th style="width:170px;">Salary Bracket</th>
              <th style="width:170px;">Salary Range</th>
              <th style="width:170px;">Salary Base</th>
              <th style="width:170px;">Total Monthly Premium</th>
              <th style="width:170px;">Employee Share</th>
              <th style="width:170px;">Employer Share</th>
            </tr>
            <?php 
            	if($philhealth_tbl != NULL){
            		$counter = 1;
            		foreach($philhealth_tbl as $row){
            ?>
	            <tr>
	            	
	              	<td><?php print $counter++;?></td>
					<td><?php print $row->salary_range;?></td>
					<td><?php print iprice($row->salary_base);?></td>
					<td><?php print iprice($row->total_monthly_premium);?></td>
					<td><?php print iprice($row->employee_share);?></td>
					<td><?php print iprice($row->employer_share);?></td>
	            </tr>
            <?php
            		}
            	}else{
            		print "<tr><td colspan='9'>".msg_empty()."</td></tr>";
            	}
            ?>
          </tbody></table>
          <!-- TBL-WRAP END -->
        </div>