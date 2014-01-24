<?php $uri =  $this->uri->segment(3); ?>
<ul>
<li <?php if($uri=='payroll_period'){ echo 'class="selected"'; } ?>>
	<a href="/<?php echo $this->session->userdata('sub_domain2'); ?>/payroll_run/payroll_period">
		Payroll Period
	</a>
</li>
<li <?php if($uri=='exclude_list'){ echo 'class="selected"'; } ?>>
	<a href="/<?php echo $this->session->userdata('sub_domain2'); ?>/payroll_run/exclude_list">
		Exclude List
	</a>
</li>
<li <?php if($uri=='timesheets'){ echo 'class="selected"'; } ?>>
	<a href="/<?php echo $this->session->userdata('sub_domain2'); ?>/payroll_run/timesheets">
		Timesheet
	</a>
</li>			
<li><a href="">Timekeeping &amp; Leave</a>
  <ul>
	<li><a href="">Leave</a></li>
	<li><a href="">Holiday/Premium</a></li>
	<li><a href="">Night Differential</a></li>
	<li><a href="">Overtime</a></li>
	<li><a href="">Hours Worked</a></li>
  </ul>
</li>
<li><a href="">Earnings &amp; Commissions</a></li>
<li><a href="">Allowances</a></li>
<li><a href="">Expense</a></li>
<li><a href="">Loans &amp; Deductions</a></li>
<li><a href="">Payroll</a></li>
</ul>