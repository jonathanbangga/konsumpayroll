      <ul>
        <li><a href="/<?php echo $this->session->userdata("sub_domain");?>/company_setup/company_information">COMPANY SETUP</a></li>  
        <li>
        <?php 
        	$hs_url = "/{$this->session->userdata("sub_domain")}/company_setup/company_information";
        	$ps_url = "/{$this->session->userdata("subdomain")}/company_setup/company_information";
        	if($this->session->userdata("company_id") != ""){
        		$hs_url = "/{$this->session->userdata("sub_domain")}/hr_setup/employment_type";
        		$ps_url = "/{$this->session->userdata("sub_domain")}/payroll_setup/payroll_group";
        	}else{
        		
        	}
        ?>
        <a href="<?php echo $hs_url;?>">HR SETUP</a>
        </li>
        <li><a href="<?php echo $ps_url;?>">PAYROLL SETUP</a></li>
      </ul>
     