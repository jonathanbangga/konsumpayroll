<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Government_model Model 
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Cost_center_model extends CI_Model {
		
		public function __construct() {
			parent::__construct();
		}

		/**
		 * 
		 * add global for approvers
		 * @param string $table
		 * @param array $fields
		 * @
		 * @return integer
		 */
		public function save_fields($table,$fields){
			$this->db->insert($table,$fields);
			return $this->db->insert_id();
		}
		
		/** 
		 * Updates global fields
		 * @example $this->approvers->update_fields("employee",array("id"=>1,"status"=>"Active"),array("emp_id"=>3));
		 * @param string $table
		 * @param array $fields
		 * @param array $where_array
		 * @return boolean
		 */
		public function update_fields($table,$fields,$where_array){
			$this->db->where($where_array);
			$this->db->update($table,$fields);
			return $this->db->affected_rows();
		}
		
		/**
		 * Get cost center
		 * @param int $company_id
		 * @return object
		 */
		public function get_cost_center($company_id){
			if(is_numeric($company_id)){
				$where = array("company_id"=>$this->db->escape_str($company_id),"deleted"=>"0","status"=>"Active");
				$query = $this->db->get_where("cost_center",$where);
				$result = $query->result();
				$query->free_result();
				return $result;
			}else{
				return false;
			}
		}
		
		/**
		 * Get cost center individual
		 * @param int $company_id
		 * @param int $cost_center
		 * @return object
		 */
		public function row_cost_center($company_id,$cost_center){
			if(is_numeric($company_id) && is_numeric($cost_center)){
				$where = array("company_id"=>$this->db->escape_str($company_id),"cost_center_id"=>$this->db->escape_str($cost_center),"deleted"=>"0","status"=>"Active");
				$query = $this->db->get_where("cost_center",$where);
				$result = $query->row();
				$query->free_result();
				return $result;
			}else{
				return false;
			}
		}

		public function cost_code_update_valid($str,$old_edit_id_cost_center){
			$check_cost_center = $this->db->query("
									SELECT * FROM `cost_center` WHERE cost_center_code = '{$str}' 
									AND cost_center_code NOT IN ('{$this->db->escape_str($old_edit_id_cost_center)}')");
			$row = $check_cost_center->num_rows();
			$check_cost_center->free_result();
			return $row;
		}
		
	}
/* End of file Approvers_model.php */
/* Location: ./application/controllers/company/Approvers_model.php */