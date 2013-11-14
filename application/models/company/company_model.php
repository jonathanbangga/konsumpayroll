<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Model 
 *
 * @category model
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Company_model extends CI_Model {
		
		public function __construct() {
			parent::__construct();
		}

		/**
		 * 
		 * Fetch government registration for the company
		 * @param int $company_id
		 * @return object
		 */
		public function get_government_registration($company_id) {
			$query = $this->db->get_where("government_registration",array("status"=>"Active","deleted"=>"0","company_id"=>$this->db->escape_str($company_id)));
			$row = $query->row();
			$query->free_result();
			return $row;
		}
		
		/**
		 * 
		 * save government on db
		 * @param array $fields
		 * @return integer
		 */
		public function gov_save($fields){
			$this->db->insert("government_registration",$fields);
			return $this->db->insert_id();
		}
		
		/**
		 * 
		 * adds the company
		 * @param array $fields
		 * @return integer
		 */
		public function add_company($fields){
			$this->db->insert("company",$fields);
			return $this->db->insert_id();
		}
		
		/**
		 * 
		 * updates government table
		 * @param array $fields
		 * @param integer $company_id
		 * @return boolean
		 */
		public function gov_update($fields,$company_id){
			$this->db->where("company_id",$this->db->escape_str($company_id));
			$this->db->update("government_registration",$fields);
			return $this->db->affected_rows();
		}
		
		/**
		 * 
		 * Checks the company information
		 * @param int $company_id
		 * @return object
		 */
		public function company_info($company_id){
			$query = $this->db->get_where("company",array("status"=>"Active","deleted"=>"0","company_id"=>$this->db->escape_str($company_id)));
			$row = $query->row();
			$query->free_result();
			return $row;
		}
		
		/**
		 * 
		 * get owners company 
		 * @param int $company_id
		 * @return object
		 */
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
		
		/**
		 * save from database
		 * Enter description here ...
		 * @param unknown_type $database
		 * @param unknown_type $fields
		 */
		public function save_fields($database,$fields){
			$this->db->insert($database,$fields);
			return $this->db->insert_id();
		}
		
		/**
		 * Updates databases
		 * Enter description here ...
		 * @param unknown_type $database
		 * @param unknown_type $fields
		 * @param unknown_type $where
		 */
		public function update_fields($database,$fields,$where){
			$this->db->where($where);
			$this->db->update($database,$fields);
			return $this->db->affected_rows();
		}
	}

/* End of file Company_model.php */
/* Location: ./application/controllers/company/Company_model.php */