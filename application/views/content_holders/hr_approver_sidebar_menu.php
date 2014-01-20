	 <ul class="jsidebar">
		<li><?php echo anchor("/{$this->uri->segment(1)}/hr/approve_timeins/lists","Time Ins");?></li>
        <li><?php echo anchor("/{$this->uri->segment(1)}/hr/approve_leave/lists/","Leave Application");?></li>
        <li><?php echo anchor("/{$this->uri->segment(1)}/hr/approve_overtime/lists/","Overtime Application");?></li>
        <li><?php echo anchor("/{$this->uri->segment(1)}/hr/approve_expenses/lists/","Expenses Applications");?></li>
        <li><?php echo anchor("/{$this->uri->segment(1)}/hr/approve_time_sheets/lists/","Timesheets");?></li>
        <li><?php echo anchor("/{$this->uri->segment(1)}/hr/approve_payroll_run/lists/","Payroll Run");?></li>
      </ul>