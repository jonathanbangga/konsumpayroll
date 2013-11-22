	<?php 
		$who = "";
		switch($this->session->userdata("user_type_id")):	
			case "2": //company owner
				$who = $this->profile->get_account($this->session->userdata("account_id"),"company_owner");
			break;
			case "3":
				$who = $this->profile->get_account($this->session->userdata("account_id"),"employee");		
			break;
		endswitch;	
	?>
	  <ul>
        <li><img src="/assets/theme_2013/images/img-user-icon.png" alt=" ">welcome, <?php echo $who ? $who->first_name." ".$who->last_name : "UNKNOWN";?>!</li>
        <li><img src="/assets/theme_2013/images/img-close-icon.png" alt=" "><a href="/login/logout">Logout</a></li>
      </ul>