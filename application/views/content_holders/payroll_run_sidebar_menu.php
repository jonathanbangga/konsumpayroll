<?php $uri =  $this->uri->segment(3); ?>
<!-- what the f ngano gi session mani <?php echo $this->session->userdata('sub_domain2'); ?> -->
<ul>
	<li <?php if($uri=='payroll_period'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->uri->segment(1);?>/payroll_run/payroll_period">
			Payroll Period
		</a>
	</li>
	<li <?php if($uri=='exclude_list'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->uri->segment(1);?>/payroll_run/exclude_list">
			Exclude List
		</a>
	</li>
	<li <?php if($uri=='timesheets'){ echo 'class="selected"'; } ?>>
		<a href="/<?php echo $this->uri->segment(1);?>/payroll_run/timesheets">
			Timesheet
		</a>
	</li>			
	<li id="tl_parent_menu"><a href="javascript:void(0);">Timekeeping &amp; Leave</a>
	  <ul id="tl_child_menu" style="<?php echo ($uri=='leave'||$uri=='holiday_premium'||$uri=='night_differential')?'display:block;':'display:none;'; ?>">
		<li <?php if($uri=='leave'){ echo 'class="selected"'; } ?>>
			<a href="/<?php echo $this->uri->segment(1);?>/payroll_run/leave">
				Leave
			</a>
		</li>
		<li <?php if($uri=='holiday_premium'){ echo 'class="selected"'; } ?>>
			<a href="/<?php echo $this->uri->segment(1);?>/payroll_run/holiday_premium">
				Holiday/Premium
			</a>
		</li>
		<li <?php if($uri=='night_differential'){ echo 'class="selected"'; } ?>>
			<a href="/<?php echo $this->uri->segment(1);?>/payroll_run/night_differential">
				Night Differential
			</a>
		</li>
		<li <?php echo $uri=="overtime" ?  'class="selected"' : "";?>><a href="/<?php echo $this->uri->segment(1);?>/payroll_run/overtime/lists" >Overtime</a></li>
		<li><a href="/<?php echo $this->uri->segment(1);?>/payroll_run/hoursworked/lists">Hours Worked</a></li>
	  </ul>
	</li>
	<li <?php echo ($uri=='earnings_commissions') ? 'class="selected"' : ''?>>
	<?php echo anchor('/'.$this->uri->segment(1).'/payroll_run/earnings_commissions/commission','Earnings &amp; Commissions')?>
	</li>
	<li <?php echo ($uri=='allowance') ? 'class="selected"' : ''?>>
	<?php echo anchor('/'.$this->uri->segment(1).'/payroll_run/allowance','Allowances')?>
	</li>
	<li <?php echo ($uri=='expense') ? 'class="selected"' : ''?>>
	<?php echo anchor('/'.$this->uri->segment(1).'/payroll_run/expense','Expense')?>
	</li>
	<li <?php echo ($uri=='loan_deduction') ? 'class="selected"' : ''?>>
	<?php echo anchor('/'.$this->uri->segment(1).'/payroll_run/loan_deduction/loans','Loans &amp; Deductions')?>
	</li>
	<li>
	<?php echo anchor('/'.$this->uri->segment(1).'/payroll_run/payroll/carry_over','Payroll')?>
	</li>
</ul>
<script>
jQuery(document).ready(function(){
	jQuery("#tl_parent_menu").click(function(){
		jQuery("#tl_child_menu").slideToggle();
	});
});
</script>