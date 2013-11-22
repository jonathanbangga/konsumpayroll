      <ul>
        <li><a href="/company/company_setup/company_information">COMPANY SETUP</a></li>  
        <li>
        <?php 
        	$hs_url = "/company/company_setup/company_information";
        	$ps_url = "/company/company_setup/company_information";
        	if($this->session->userdata("company_id") != ""){
        		$hs_url = "/company/hr_setup/employment_type";
        		$ps_url = "/company/hr_setup/employment_type";
        	}
        ?>
        <a href="<?php echo $hs_url;?>">HR SETUP</a>
        </li>
        <li><a href="<?php echo $ps_url;?>">PAYROLL SETUP</a></li>
      </ul>
     