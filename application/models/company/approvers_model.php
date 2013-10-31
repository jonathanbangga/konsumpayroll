<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Government_model Model 
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Approvers_model extends CI_Model {
		
		public function __construct() {
			parent::__construct();
		}

		/**
		 * 
		 * add global for approvers
		 * @param string $table
		 * @param array $fields
		 * @return integer
		 */
		public function save_fields($table,$fields){
			$this->db->insert($table,$fields);
			return $this->db->insert_id();
		}
		
		/**
		 * 
		 * Updates global fields
		 * @example $this->approvers->update_fields("employee",array("id"=>1,"status"=>"Active"),array("emp_id"=>3));
		 * @param string $table
		 * @param array $fields
		 * @param array $where_array
		 * @return boolean
		 */
		public function update_fields($table,$fields,$where_array){
			$this->db->where($where_array);
			$this->db->insert($table,$fields);
			return $this->db->affected_rows();
		}
		
		
	}

/* End of file Approvers_model.php */
/* Location: ./application/controllers/company/Approvers_model.php */