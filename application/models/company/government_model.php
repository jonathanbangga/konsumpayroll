<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Government_model Model 
 *
 * @category Model
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Government_model extends CI_Model {
		
		public function __construct() {
			parent::__construct();
		}

		/**
		 * 
		 * Fetch government registration
		 * @param int $company_id
		 * @return object
		 */
		public function get_government_registration($company_id) {
			$query = $this->db->get_where("government_registration",array("status"=>"Active","deleted"=>"0","company_id"=>$this->db->escape_str($company_id)));
			$row = $query->row();
			$query->free_result();
			return $row;
		}
	
	}

/* End of file Company_model.php */
/* Location: ./application/controllers/company/Government_model.php */