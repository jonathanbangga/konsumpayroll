<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Model 
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Users_model extends CI_Model {
		
		public function __construct() {
			parent::__construct();
		}

		public function get_government_registration($company_id) {
			$query = $this->db->get_where("government_registration",array("status"=>"Active","deleted"=>"0","company_id"=>$this->db->escape_str($company_id)));
			$row = $query->row();
			$query->free_result();
			return $row;
		}
		
		public function test(){
			echo 'we';
		}
		
		
		
	}

/* End of file Company_model.php */
/* Location: ./application/controllers/hr/Company_model.php */