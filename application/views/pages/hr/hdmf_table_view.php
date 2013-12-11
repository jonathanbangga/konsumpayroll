		<div class="tbl-wrap">	
		  <?php print $this->session->flashdata('message');?>
          <!-- TBL-WRAP START -->
          <table class="tbl emp_conList">
            <tbody><tr>
              <th style="width:50px;"></th>
              <th style="width:170px;">Salary Brackets</th>
              <th style="width:170px;">Range of Compensation From</th>
              <th style="width:170px;">Range of Compensation To</th>
              <th style="width:170px;">Monthly Salary Credit</th>
              <th style="width:170px;">Employee Contribution 1</th>
              <th style="width:170px;">Employee Contribution 2</th>
              <th style="width:170px;">Total</th>
            </tr>
            <?php 
            	if($hdmf_tbl != NULL){
            		$counter = 1;
            		foreach($hdmf_tbl as $row){
            ?>
	            <tr>
	            	<td><?php print $counter++;?></td>
	              	<td><?php print $row->salary_bracket_id;?></td>
					<td><?php print iprice($row->range_of_compensation_from);?></td>
					<td><?php print iprice($row->range_of_compensation_to);?></td>
					<td><?php print iprice($row->monthly_salary_credit);?></td>
					<td><?php print iprice($row->employer_contribution1);?></td>
					<td><?php print iprice($row->employee_contribution2);?></td>
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
                  <p>Note: By default, HDMF contribution is 2% of the basis salary amount, if the basis is less than 5,000.00.</p> 
          <p>If the basis amount is greater than 5,000.00 (which makes the contribution amount > 100), the amount should be looked up from the table.</p>