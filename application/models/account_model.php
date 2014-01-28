<?php

class Account_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }
	
	public function get_account($user,$pass,$account_type){
		if($user !="" && $pass !="" && $account_type !=""){
		$sql = $this->db->query("
			SELECT *, a.`account_id` AS main_account_id, psa.sub_domain AS main_sub_domain
			FROM `accounts` AS a
			LEFT JOIN `payroll_system_account` AS psa ON ( a.`payroll_system_account_id` = psa.`payroll_system_account_id` ) 
			LEFT JOIN employee e ON a.account_id = e.account_id
			LEFT JOIN company c ON e.company_id = c.company_id
			WHERE a.`payroll_cloud_id` = '{$user}'
			AND a.`password` = '{$pass}'
			AND a.`account_type_id` = {$account_type}
		");
		return $sql;
		}else{
			return false;
		}
	} 
	
	public function check_employee($account){
		if(is_numeric($account)){
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
		}else{
			return false;
		}
	}
	
	/**** CHRIS CODES ADDED ****/
	/**
	*	DASHBOARD ACCESS ENABLES YOU TO DEFINE IF THE PERSON BEHIND THIS DASHBOARD IS THE RIGHT PERSON
	*	@param int $psa_id ( payroll_system_account_id )
	*	@param string $sub_domain
	*	@return boolean
	*/
	public function dashboard_access($psa_id,$sub_domain){
		if(is_numeric($psa_id) && $sub_domain !=""){
			$query = $this->db->query("SELECT count(*) as result FROM payroll_system_account psa WHERE psa.payroll_system_account_id = '{$this->db->escape_str($psa_id)}' AND sub_domain = '{$this->db->escape_str($sub_domain)}'");
			$row = $query->row();
			$query->free_result();
			return $row;
		}else{
			return false;
		}
	}
	/**** END CHRIS CODES ****/
	
	
}

?>