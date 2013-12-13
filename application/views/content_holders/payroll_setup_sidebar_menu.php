<?php $uri =  $this->uri->segment(3); ?>
<ul>
	<li <?php if($uri=='payroll_group'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/payroll_group">Payroll Group</a>
	</li>
	<li><a href="#">Payroll Calendar</a></li>
	<li <?php if($uri=='hours_type'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/hours_type">
			Hours Type
		</a>
	</li>
	<li <?php if($uri=='workday'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/workday">
			Workday
		</a>
	</li>
	<li <?php if($uri=='overtime_settings'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/overtime_settings">
			Overtime Settings
		</a>
	</li>
	<li <?php if($uri=='holiday_settings'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/holiday_settings">
			Holiday Settings
		</a>
	</li>
	<li <?php if($uri=='night_shift_differential'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/night_shift_differential">
			Night Differential
		</a>
	</li>
	<li <?php if($uri=='rest_day'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/rest_day">Rest Day</a>
	</li>
	<li><a href="#">Income</a></li>
	<li <?php if($uri=='earnings'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/earnings">
			Earnings
		</a>
	</li>
	<li <?php if($uri=='deductions'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/deductions">Deductions</a>
	</li>
	<li <?php if($uri=='priority_of_deductions'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/priority_of_deductions">
			Priority of Deductions
		</a>
	</li>
	<li <?php if($uri=='loans'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/loans">
			Loans
		</a>
	</li>
	<li <?php if($uri=='expenses'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/expenses">
			Expenses
		</a>
	</li>
	<li <?php if($uri=='payroll_journal_entries'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/payroll_journal_entries">
			Payroll Journal Entries
		</a>
	</li>
	<li <?php if($uri=='withholding_tax'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/withholding_tax">
			Witholding Tax
		</a>
	</li>
	<li <?php if($uri=='thirteen_month_pay_settings'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/thirteen_month_pay_settings">
			13th Month Settings
		</a>
	</li>
	<li <?php if($uri=='thirteen_month_pay'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/thirteen_month_pay">
			13th Month Pay
		</a>
	</li>
	<li <?php if($uri=='de_minimis'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/de_minimis">
			De Minimis
		</a>
	</li>
	<li <?php if($uri=='accural'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/accural">
			Accural
		</a>
	</li>
	<li <?php if($uri=='banks'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->session->userdata('sub_domain'); ?>/payroll_setup/banks">
			Banks
		</a>
	</li>
</ul>