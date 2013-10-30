	  <ul class="jsidebar">
	  	<?php 
  		  	switch($page_title):
				case "My Profile": 
	  	?>
	        <li><?php echo anchor("/".$this->uri->segment(1)."/hr/company/index","My Profile");?></li>
	        <li><?php echo anchor("/".$this->uri->segment(1)."/hr/company/gov_registration","Payroll");?></li>
        <?php 
        		break;
				case "Payroll": 
	  	?>
	  		<li><?php echo anchor("/".$this->uri->segment(1)."/hr/company/index","My Profile");?></li>
	        <li><?php echo anchor("/".$this->uri->segment(1)."/hr/company/gov_registration","Payroll");?></li>
        <?php 
  		  		break;
  			endswitch; 
	  	?>
	  	 <!-- 
	  	 <?php 
	  	 	#$konsum_profile_menu = array_search($page_title,$this->config->item('konsum_profile_menu'));
	  	 	
	  	 	$konsum_profile_menu = $this->config->item('konsum_profile_menu');
	  	 	#$title_val = array_search($page_title,$konsum_profile_menu,true); 
	  	 	#$title_val = array_key_exists("Payroll",$konsum_profile_menu);
			if(!is_int($title_val)){
				$konsum_profile_menu_flag = 1;		
			}else{
				$konsum_profile_menu_flag = 0;
			}
	  	 	
	  	 	#($konsum_profile_menu) ? $konsum_profile_menu_flag = 1: $konsum_profile_menu_flag = 0;
	  	 	if($konsum_profile_menu_flag == 1){
	  	 ?>
	  	 	<li><?php echo anchor("/".$this->uri->segment(1)."/hr/company/index","My Profile");?></li>
        	<li><?php echo anchor("/".$this->uri->segment(1)."/hr/company/gov_registration","Payroll");?></li>
	  	 <?php 
	  	 	}
	  	 ?> 
	  	 -->
      </ul>
      
      <script>
		function sidebar_addSelectedClass(){
			jQuery(".jsidebar a").each(function(e){
				var _title = document.title,
				_text = jQuery.trim(jQuery(this).text());
				if(_title == _text) {
					jQuery(this).parent().addClass("selected");
					return false;
				}
			});
		}
      
		jQuery(function(){
			sidebar_addSelectedClass();
		});
      </script>