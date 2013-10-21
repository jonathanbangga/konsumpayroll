<?php 
	if($company_list != NULL){
		foreach($company_list as $row){
			$company_name = strtolower($row->registered_business_name);
			print "<p><a href='{$company_name}/company/dashboard'>".$row->registered_business_name."</a></p>";
		}
	}
?>