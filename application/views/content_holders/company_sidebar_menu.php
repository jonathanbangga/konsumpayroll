	<?php
		$uri_company_id = $this->uri->segment(4);
		$check_edit_status = ($uri_company_id !="") ? "edit/".$uri_company_id : "add"; 
		
	?>
	 <ul class="jsidebar">
        <li><?php echo anchor("/company/company_setup/company_information/","Company Information");?></li>
        <li><?php echo anchor("/company/company_setup/government_registration/","Government Registrations");?></li>
        <li><?php echo anchor("/company/company_setup/approvers/","Company Approvers");?></li>
        <li><?php echo anchor("/company/company_setup/principal/","Company Principal");?></li>
        <li><?php echo anchor("/company/company_setup/cost_center/","Cost Center");?></li>
      </ul>