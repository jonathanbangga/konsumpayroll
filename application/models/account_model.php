<?php

class Account_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->load->database();
    }
	
	public function get_account($user,$pass){
		$sql = $this->db->query("
			SELECT *
			FROM `accounts`
			WHERE `payroll_cloud_id` = '{$user}'
			AND `password` = '{$pass}'
		");
		return $sql;
	}
	
}

?>