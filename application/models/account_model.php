<?php

class Account_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }
	
	public function get_account($user,$pass,$account_type){

		$sql = $this->db->query("
			SELECT *, a.`account_id` AS main_account_id
			FROM `accounts` AS a
			LEFT JOIN `payroll_system_account` AS psa ON ( a.`payroll_system_account_id` = psa.`payroll_system_account_id` ) 
			LEFT JOIN employee e ON a.account_id = e.account_id
			LEFT JOIN company c ON e.company_id = c.company_id
			WHERE a.`payroll_cloud_id` = '{$user}'
			AND a.`password` = '{$pass}'
			AND a.`account_type_id` = {$account_type}
		");

		return $sql;
		
	} 
	
	public function check_employee($account){
		$sql = $this->db->query("
			SELECT *FROM accounts
			WHERE account_id = '{$account}'
			AND deleted = '0'
		");
		if($sql->num_rows() > 0){
			$row = $sql->row();
			$sql->free_result();
			return $row->user_type_id;
		}else{
			return false;
		}
	}
	
}

?>