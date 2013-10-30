	<?php
		$uri_company_id = $this->uri->segment(4);
		$check_edit_status = ($uri_company_id !="") ? "edit/".$uri_company_id : "add"; 
		
	?>
	 <ul class="jsidebar">
        <li><?php echo anchor("/".$this->uri->segment(1)."/company_setup/".$check_edit_status,"Company Information");?></li>
        <li><?php echo anchor("/".$this->uri->segment(1)."/government_registration/edit/".$uri_company_id,"Government Registrations");?></li>
        <li><?php echo anchor("/".$this->uri->segment(1)."/approvers/edit/".$uri_company_id,"Company Approvers");?></li>
        <li><?php echo anchor("/".$this->uri->segment(1)."/principal/edit/".$uri_company_id,"Company Principal");?></li>
        <li><?php echo anchor("/".$this->uri->segment(1)."/cost_center/edit/".$uri_company_id,"Cost Center");?></li>
      </ul>