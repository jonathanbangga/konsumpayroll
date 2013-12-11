		<div class="tbl-wrap">	
		  <?php print $this->session->flashdata('message');?>
          <!-- TBL-WRAP START -->
          <table class="tbl emp_conList">
            <tbody><tr>
              
              <th style="width:40px;">Salary Brackets</th>
              <th style="width:170px;">Range of Compensation From</th>
              <th style="width:170px;">Range of Compensation To</th>
              <th style="width:170px;">Monthly Salary Credit</th>
              <th style="width:170px;">Employee Contribution 1</th>
              <th style="width:170px;">Employee Contribution 2</th>
              <th style="width:170px;">Total</th>
            </tr>
            <?php 
            	if($philhealth_tbl != NULL){
            		$counter = 1;
            		foreach($philhealth_tbl as $row){
            ?>
	            <tr>
	            	
	              	<td><?php print $counter++;?></td>
					<td><?php print iprice($row->range_of_compensation_from);?></td>
					<td><?php print iprice($row->range_of_compensation_to);?></td>
					<td><?php print iprice($row->monthly_salary_credit);?></td>
					<td><?php print iprice($row->employer_contribution1);?></td>
					<td><?php print iprice($row->employer_contribution2);?></td>
					<td><?php print iprice($row->total);?></td>
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