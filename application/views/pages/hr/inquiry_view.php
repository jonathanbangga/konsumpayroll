	<div class="filter_menus">
	<?php echo form_open($this->uri->segment(1)."/hr/inquiry/search");?>
		<div class="left">
			<table>
		    	<tbody>
			        <tr>
			            <td><div class="ipadright"><input type="text" placeholder="Employee Number" class="txtfield hasDatepicker"></div></td>
			            <td><div class="ipadright"><input type="text" placeholder="Employee Name"  class="txtfield hasDatepicker"></div></td>
			            <td>
				            <div class="ipadright">
					            <select name="year" class="inp_user">
					            	<?php 
					            		for($year = 2010;$year <= 2050; $year++):
					            	?>
					            		<option value="yearly" ><?php echo $year;?></option>
					            	<?php 
					            		endfor;
					            	?>
					            </select> 
				            </div>
			            </td>
			            <td><input type="submit" id="jleave_go" class="btn" value="GO"></td>
			        </tr>
		    	</tbody>
			</table>
		</div>
	<?php echo form_close();?>
	<div class="clearB"></div>	
	</div>
	<br />
	<br />
	<div class="tbl-wrap">	
		            <!-- TBL-WRAP START -->
          <table class="tbl emp_conList" style="width:2430px;">
            <tbody>
	            <tr>
					
					<th style="width:30px;">Period</th>
					<th style="width:70px;">Leave Type</th>
					<th style="width:70px;">Total Credits</th>
					<th style="width:70px;">Accrued Leaves</th>
					<th style="width:70px;">Used Leaves</th>
					<th style="width:70px;">Adjustments</th>
					<th style="width:70px;">Ending Balance</th>
					<th style="width:70px;">Adjustment Reason</th>
	            </tr>
            	<tr>
					<td>10060</td>
					<td>10060</td>
					<td>10060</td>
					<td>10060</td>
					<td>10060</td>
					<td>10060</td>
					<td>10060</td>
					<td>10060</td>  
	            </tr>
            </tbody>
            </table>
          <span class="ihides unameContBoxTrick"></span>
          <!-- TBL-WRAP END -->
        </div>