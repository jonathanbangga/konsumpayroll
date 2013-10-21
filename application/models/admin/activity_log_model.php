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
	
	public function fetch_activity_logs($limit,$start){
		$this->db->limit($limit,$start);
		$query = $this->db->get("activity_logs");
		
		$result = $query->result();
		$query->free_result();
		return $result;
	}
	
	public function count_activity_logs(){
		$val = $this->db->count_all("activity_logs");
		return $val;
	}

	
	
	
}

/* End of file Admin_model.php */
/* Location: ./application/model/admin/Admin_model.php */