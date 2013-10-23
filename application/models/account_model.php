<?php

class Account_model extends CI_Model {

    function __construct(){
        parent::__construct();
		$this->load->database();
    }
	
	public function get_account($user,$pass,$account_type){
	
		$user_str = ($account_type==1)?'email':'payroll_cloud_id';
		$sql = $this->db->query("
			SELECT *
			FROM `accounts`
			WHERE `{$user_str}` = '{$user}'
			AND `password` = '{$pass}'
			AND `account_type_id` = {$account_type}
		");
		return $sql;
		
	}
	
}

?>