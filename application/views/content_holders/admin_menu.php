	<nav id="menu">
      <!-- MENU START -->
      <ul>
		<li><?php echo anchor("/".$this->uri->segment(1)."/dashboard","HOME");?></li>
		<li><?php echo anchor("/".$this->uri->segment(1)."/company_setup","COMPANY LIST");?></li>
		<li><?php echo anchor("/".$this->uri->segment(1)."/users/all_users","USERS ACCOUNT");?></li>
      </ul>
      <!-- MENU END -->
    </nav>