<?php $uri =  $this->uri->segment(3); ?>
<ul>
	<li><a href="#">Payroll Group</a></li>
	<li><a href="#">Payroll Calendar</a></li>
	<li><a href="#">Hours Type</a></li>
	<li><a href="#">Workday</a></li>
	<li><a href="#">Overtime Settings</a></li>
	<li><a href="#">Holiday Settings</a></li>
	<li><a href="#">Night Differential</a></li>
	<li><a href="#">Rest Day</a></li>
	<li><a href="#">Income</a></li>
	<li><a href="#">Earnings</a></li>
	<li><a href="#">Deductions</a></li>
	<li><a href="#">Priority of Deductions</a></li>
	<li><a href="#">Loans</a></li>
	<li><a href="#">Expenses</a></li>
	<li><a href="#">Payroll Journal Entries</a></li>
	<li><a href="#">Witholding Tax</a></li>
	<li><a href="#">13th Month Settings</a></li>
	<li <?php if($uri=='thirteen_month_pay'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/thirteen_month_pay">13th Month Pay</a>
	</li>
	<li><a href="#">De Minimis</a></li>
	<li><a href="#">Banks</a></li>
</ul>