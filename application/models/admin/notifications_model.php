<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * Notifications model
 *
 * @subpackage Notifications_model
 * @category model
 * @version 1.0
 * @copyright Copyright (c) 2013, Konsum Technologies Inc.
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */

class Notifications_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function get_notifications(){
		$query = $this->db->get("notification");
		$result = $query->result();
		$query->free_results();
		return $result;
	}
	
}

/* End of file Company_setup_model.php */
/* Location: ./application/model/admin/Company_setup_model.php */