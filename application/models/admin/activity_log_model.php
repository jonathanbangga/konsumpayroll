<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * Admin Dashboard
 *
 * @subpackage Admin Dashboard
 * @category model
 * @version 1.0
 * @copyright Copyright (c) 2013, Konsum Technologies Inc.
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */

class Activity_log_model extends CI_Model {

	var $theme;
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * 
	 * Fetch activity logs as well as preparation for pagination purposes
	 * @param int $limit
	 * @param int $start
	 * @return object
	 * @example $this->activity->fetch_activity_logs(0,1)
	 */
	public function fetch_activity_logs($limit,$start){
		if(is_numeric($limit) || is_numeric($start)){
			$this->db->where(array("deleted"=>"0"));
			$this->db->limit($limit,$start);
			$query = $this->db->get("activity_logs");
			$result = $query->result();
			$query->free_result();
			return $result;
		}else{
			return false;
		}
	}
	
	/**
	 * 
	 * get all overall value for activity logs
	 * @return integer
	 */
	public function count_activity_logs(){
		$val = $this->db->count_all("activity_logs");
		return $val;
	}
	
	/**
	 * Fetch notifications 
	 * get notification for admin usage
	 * @param int $limit
	 * @param int $start
	 */
	public function fetch_notification($limit = 10,$start = 0){
		if(is_numeric($limit) || is_numeric($start)){
			$this->db->where(array("deleted"=>"0"));
			$this->db->limit($limit,$start);
			$query = $this->db->get("notification");
			$result = $query->result();
			$query->free_result();
			return $result;
		}else{
			return false;
		}
	}

}

/* End of file Admin_model.php */
/* Location: ./application/model/admin/Admin_model.php */