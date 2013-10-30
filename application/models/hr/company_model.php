<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Model 
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Company_model extends CI_Model {
		
		public function __construct() {
			parent::__construct();
		}

		public function get_government_registration($company_id) {
			$query = $this->db->get_where("government_registration",array("status"=>"Active","deleted"=>"0","company_id"=>$this->db->escape_str($company_id)));
			$row = $query->row();
			$query->free_result();
			return $row;
		}
		
		public function gov_save($fields){
			$this->db->insert("government_registration",$fields);
			return $this->db->insert_id();
		}
		
		public function gov_update($fields,$company_id){
			$this->db->where("company_id",$this->db->escape_str($company_id));
			$this->db->update("government_registration",$fields);
			return $this->db->affected_rows();
		}
		
		public function gov_info($company_id){
			if(is_numeric($company_id)){
				$query = $this->db->query("
						SELECT * FROM `government_registration` 
						g LEFT JOIN company c on c.company_id = g.company_id 
						where c.company_id={$this->db->escape_str($company_id)}");
				$row = $query->row();
				$query->free_result();
				return $row;
			}else{
				return false;
			}
		}
	}

/* End of file Company_model.php */
/* Location: ./application/controllers/hr/Company_model.php */