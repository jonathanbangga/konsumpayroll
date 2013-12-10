		<div class="tbl-wrap">	
		  <?php print $this->session->flashdata('message');?>
          <!-- TBL-WRAP START -->
          <table class="tbl emp_conList">
            <tbody><tr>
             
              <th style="width:170px;">Salary Brackets</th>
              <th style="width:170px;">Range of Compensation From</th>
              <th style="width:170px;">Range of Compensation To</th>
              <th style="width:170px;">Monthly Salary Credit</th>
              <th style="width:170px;">Emp Monthly Contri Ss</th>
              <th style="width:170px;">Emp Monthly Contri Ec</th>
              <th style="width:170px;">Employee Ss</th>
              <th style="width:170px;">Total</th>
            </tr>
            <?php 
            	if($sss_tbl != NULL){
            		$counter = 1;
            		foreach($sss_tbl as $row){
            ?>
	            <tr>
	             
              	  	<td><?php print $counter++;?></td>
					<td><?php print iprice($row->range_compensation_from);?></td>
					<td><?php print iprice($row->range_compensation_to);?></td>
					<td><?php print iprice($row->monthly_salary_credit);?></td>
					<td><?php print iprice($row->employer_monthly_contribution_ss);?></td>
					<td><?php print iprice($row->employer_monthly_contribution_ec);?></td>
					<td><?php print iprice($row->employee_ss);?></td>
					<td>Total</td>
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