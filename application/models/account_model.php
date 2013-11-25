<?php

class Account_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }
	
	public function get_account($user,$pass,$account_type){

		$sql = $this->db->query("
			SELECT *
			FROM `accounts` AS a
			LEFT JOIN `payroll_system_account` AS psa ON ( a.`payroll_system_account_id` = psa.`payroll_system_account_id` ) 
			WHERE a.`payroll_cloud_id` = '{$user}'
			AND a.`password` = '{$pass}'
			AND a.`account_type_id` = {$account_type}
		");
		return $sql;
		
	}
	
}

?>