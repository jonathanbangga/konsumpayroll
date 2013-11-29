	 <ul class="jsidebar">
        <li><?php echo anchor("/{$this->session->userdata("sub_domain")}/company_setup/company_information/","Company Information");?></li>
        <li><?php echo anchor("/{$this->session->userdata("sub_domain")}/company_setup/government_registration/","Government Registrations");?></li>
        <li><?php echo anchor("/{$this->session->userdata("sub_domain")}/company_setup/approvers/","Company Approvers");?></li>
        <li><?php echo anchor("/{$this->session->userdata("sub_domain")}/company_setup/principal/","Company Principal");?></li>
        <li><?php echo anchor("/{$this->session->userdata("sub_domain")}/company_setup/cost_center/","Cost Center");?></li>
      </ul>