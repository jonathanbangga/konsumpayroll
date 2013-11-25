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
		
		/**
		 * Check approvers users list
		 * @param int $comp_id
		 * @return object
		 */
		public function fetch_approvers_users($comp_id){
			if(is_numeric($comp_id)){
				$q = $this->db->query("SELECT DISTINCT * FROM company_approvers ca 
										LEFT JOIN employee e on e.account_id = ca.account_id
										LEFT JOIN accounts a on a.account_id = e.account_id
										WHERE ca.company_id = {$this->db->escape_str($comp_id)} and ca.deleted = '0' 
										AND e.deleted = '0' AND a.deleted = '0' ORDER BY ca.level DESC
										");
				
				$result	 = $q->result();
				$q->free_result();
				return $result;
			}else{
				return false;
			}
		}
		
		
	}

/* End of file Company_model.php */
/* Location: ./application/controllers/hr/Company_model.php */