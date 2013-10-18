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
	
	public function fetch_activity_logs($limit,$start){
		$this->db->limit($limit,$start);
		$query = $this->db->get("company_owner");
		$result = $query->result();
		$query->free_result();
		return $result;
	}
	
	public function count_activity_logs(){
		$val = $this->db->count_all("company_owner");
		return $val;
	}
	
	public function add_all_user($fields) {
		return $this->db->insert("company_owner",$fields);
	}
	
	/**
	*	fetch all admin
	*	@param int $limit
	*	@param int $start
	*	@return 
	*/
	public function fetch_admin($limit,$start) {
		$this->db->limit($limit,$start);
		$query = $this->db->get("konsum_admin");
		$result = $query->result();
		$query->free_result();
		return $result;
	}

	public function count_admin(){
		$val = $this->db->count_all("konsum_admin");
		return $val;
	}
	
}

/* End of file Admin_model.php */
/* Location: ./application/model/admin/Admin_model.php */