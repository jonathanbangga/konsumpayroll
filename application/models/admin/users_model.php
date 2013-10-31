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
		return $this->db->insert("company_owner",$fields);
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
	 * 
	 * Selects users
	 * @param int $id
	 * @return object
	 */
	public function select_user($id){
		if(is_numeric($id)){
			$query = $this->db->get_where("company_owner",array("company_owner_id"=>$id));
			$row = $query->row();
			$query->free_result();
			return $row;
		}else{
			return false;
		}
	}
	
	/**
	 * 
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
	 * Updates admin users
	 * @param array $fields
	 * @param int $id
	 * @return boolean
	 */
	public function update_admin_user($fields,$id) {
		$this->db->where("konsum_admin_id",$this->db->escape_str($id));
	 	$this->db->update("konsum_admin",$fields);
		return $this->db->affected_rows();
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
	public function fetch_admin($limit,$start) {
		$this->db->limit($limit,$start);
		$query = $this->db->get("konsum_admin");
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
	
}

/* End of file Admin_model.php */
/* Location: ./application/model/admin/Admin_model.php */