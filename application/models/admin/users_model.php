<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * Admin Users 
 *
 * @subpackage Admin Users
 * @category model
 * @version 1.0
 * @copyright Copyright (c) 2013, Konsum Technologies Inc.
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */

class Users_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * 
	 * Get all users list
	 * @param int $limit
	 * @param int $start
	 * @return object
	 */
	public function users_list($limit,$start){
		$this->db->limit($limit,$start);
		$this->db->where(array("status"=>"Active","deleted"=>"0"));
		$query = $this->db->get("company_owner");
		$result = $query->result();
		$query->free_result();
		return $result;
	}
	
	/**
	 * 
	 * Counts all users and passes the return value for pagination purposes
	 * @return integer
	 */
	public function users_count_list(){
		$query 	= $this->db->query("SELECT COUNT(*) as val from company_owner WHERE status='Active' and deleted = '0'");
		$row	= $query->num_rows();
		$res 	= $query->row();
		$query->free_result();
		return $row ? $res->val : 0;
	}
	
	/**
	 * 
	 * Adds users as a company_owner to admin
	 * @param array $fields
	 * @return boolean
	 */
	public function add_all_user($fields) {
		$this->db->insert("company_owner",$fields);
		return $this->db->insert_id();
	}
	
	/**
	 * 
	 * Update users
	 * @param array $fields
	 * @param int $owner_id
	 * @return boolean
	 */
	public function update_all_user($fields,$owner_id) {
		$this->db->where("company_owner_id",$this->db->escape_str($owner_id));
		return $this->db->update("company_owner",$fields);
	}

	/**
	 * 
	 * Disables users 
	 * @param array $fields
	 * @param int $owner_id
	 * @return boolean
	 */
	public function disable_user($fields,$owner_id){
		$this->db->where("company_owner_id",$this->db->escape_str($owner_id));
		return $this->db->update("company_owner",$fields);
	}

	/**
	 * 
	 * Select admin users
	 * @param int $id
	 * @return object
	 */
	public function select_admin_user($id){
		if(is_numeric($id)){
			$query = $this->db->get_where("konsum_admin",array("konsum_admin_id"=>$id));
			$row = $query->row();
			$query->free_result();
			return $row;
		}else{
			return false;
		}
	}
	
	/**
	 * CHECK ADMINS FULL DETAILS SINCE I GOT LOST SO I MADE THIS MODEL TO FIND WHO IS THE FULL ADMIN
	 * @param int $konsum_admin_id
	 * @return object
	 */
	public function get_admin_fulldetails($konsum_admin_id){
		if(is_numeric($konsum_admin_id)){
			$sql = "SELECT * FROM accounts a
					LEFT JOIN konsum_admin ka on ka.account_id = a.account_id
					WHERE a.deleted='0' AND ka.status = 'Active' AND ka.deleted = '0'
					AND konsum_admin_id =".$this->db->escape_str($konsum_admin_id);
			$query = $this->db->query($sql);
			$row = $query->row();
			$query->free_result();
			return $row;
		}else{
			return false;
		}
	}
	
	/**
	 * 
	 * Selects users
	 * @param int $id
	 * @return object
	 */
	public function select_user($id){
		if(is_numeric($id)){
			#$query = $this->db->get_where("company_owner",array("company_owner_id"=>$id));
			$query = $this->db->query(
			"SELECT co.company_owner_id,co.owner_name,co.mobile,co.country,co.date,co.`status`,co.deleted AS company_deleted,co.account_id,co.address,co.street,
			a.payroll_cloud_id,a.payroll_system_account_id,a.`password`,a.email,a.deleted AS account_deleted,psa.`status` AS psa_status
			FROM `company_owner` co
			LEFT JOIN accounts a on a.account_id = co.account_id 
			LEFT JOIN payroll_system_account psa on psa.payroll_system_account_id = a.payroll_system_account_id
			WHERE co.company_owner_id = {$id} AND a.account_type_id = 2 
			AND co.`status` = 'Active' 
			AND co.deleted='0' AND a.deleted = '0'
			AND psa.`status`= 'Active'
			");
			$row = $query->row();
			$query->free_result();
			return $row;
		}else{
			return false;
		}
	}
	
	/**
	 * Add all admin
	 * @param array $fields
	 * @return integer
	 */
	public function add_all_admin($fields) {
		$this->db->insert("konsum_admin",$fields);
		return $this->db->insert_id();
	}

	/**
	 * 
	 * add data fields
	 * @param string $database
	 * @param array $fields
	 * @return integer
	 */
	public function add_data_fields($database,$fields){
		$this->db->insert($database,$fields);
		return $this->db->insert_id(); 
	}
	
	public function update_data_fields($database,$fields,$where){
		$this->db->where($where);
		$this->db->update($database,$fields);
		return $this->db->affected_rows(); 
	}
	
	/**
	 * 
	 * Delete users_id 
	 * @param string $db
	 * @param array $id
	 * return boolean
	 */
	public function delete_users_id($db,$id) {
		$this->db->delete($db,$id);
		return $this->db->affected_rows();
	}
	
	/**
	*	fetch all admin
	*	@param int $limit
	*	@param int $start
	*	@return object
	*/
	public function fetch_admin($limit=1,$start=0) {
		#$this->db->limit($limit,$start);
		$sql = "SELECT * FROM `konsum_admin` ka
				LEFT JOIN accounts a on a.account_id = ka.account_id
				WHERE ka.status = 'Active' and ka.deleted='0' and a.deleted='0' limit {$start},{$limit}";
		#$query = $this->db->get("konsum_admin");
		$query = $this->db->query($sql);
		$result = $query->result();
		$query->free_result();
		return $result;
	}

	/**
	 * 
	 * count all admin
	 */
	public function count_admin(){
		$query 	= $this->db->query("SELECT COUNT(*) as val from konsum_admin WHERE status='Active' and deleted = '0'");
		$row	= $query->num_rows();
		$res 	= $query->row();
		$query->free_result();
		return $row ? $res->val : 0;
	}
	
	/**
	 * 
	 * owners company listtings
	 * @param int $company_owner_id
	 * @return object
	 */
	public function owners_company_list($company_owner_id){
		$where_array = array(
						"company_owner_id"	=> $this->db->escape_str($company_owner_id),
						"status"	=> "Active",
						"deleted"	=> "0"
						);
		$query = $this->db->get_where("company",$where_array);
		$result = $query->result();
		$query->free_result();
		return $result;
	}
	
	/**
	 * Checks the comapny owner individual data
	 * @param int $company_owner_id
	 */
	public function single_company_owner($company_owner_id){
		if(is_numeric($company_owner_id)){
			$sql  = "SELECT * FROM company_owner co
						LEFT JOIN accounts a on a.account_id = co.account_id
						WHERE a.user_type_id = '2' and a.deleted = '0' and co.deleted = '0' AND 
						co.company_owner_id={$this->db->escape_str($company_owner_id)} and co.status = 'Active'";	
			$query = $this->db->query($sql);
			$result = $query->row();
			$query->free_result();
			return $result;
		}else{
			return false;
		}
	}
	
	/**
	 * SAVE OWNERS FOR LOOP
	 * Enter description here ...
	 * @param unknown_type $owners_name
	 * @param unknown_type $email_address
	 */
	public function save_owners($owners_name,$email_address){
		$owners_name = $this->db->escape_str($owners_name);
		$email =  $this->db->escape_str($email_address);
		#---------- ACCOUNT --------------------#
			$account_field = array(
						"payroll_system_account_id" => 0,
						"email"				=> $email,
						"account_type_id"	=> 2,
						"password"			=> md5(idates_now()),
						"user_type_id"		=> 2,
						"deleted"			=> '0'
				);		
			$account_id = $this->add_data_fields("accounts",$account_field);	
		#--------- COMPANY_OWNER ---------------#
			if($account_id){
				$company_owner_field = array(
						"owner_name"		=> $owners_name,
						"account_id"		=> $account_id,
						"date"				=> idates_now(),
						"status"			=> "Active"
				);		
				$this->add_data_fields("company_owner",$company_owner_field);
				return true;
			}else{
				return false;
			}
	}
	
}

/* End of file Admin_model.php */
/* Location: ./application/model/admin/Admin_model.php */