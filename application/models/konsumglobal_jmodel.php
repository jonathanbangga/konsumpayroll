<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Konsumglobal jmodel Model
 *
 * @category Model
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Konsumglobal_jmodel extends CI_Model {
		
		/**
		 * Insert data
		 * @param unknown_type $table_name
		 * @param unknown_type $data
		 */
		public function insert_data($table_name,$data){
			$insert = $this->db->insert($this->db->dbprefix($table_name),$data);
			if($insert){
				return true;
			}else{
				return false;
			}
		}
		
		/**
		 * Get maximum id
		 * @param field_name
		 * @param tbl_name
		 * @return maximum id
		 */
		public function maxid($field_name,$tbl_name){
			$this->db->select_max($field_name);
			$query = $this->db->get($this->db->dbprefix($tbl_name));
			$result = $query->result(); 
			if($query->num_rows() > 0){
				$query->free_result();
				foreach($result as $row){
					$maxid = $row->$field_name + 1;
				}
				return $maxid;
			}else{
				$maxid = 1;
				return $maxid;
			}
		}
		
	}
	
/* End of file konsumglobal_jmodel.php */
/* Location: ./application/controllers/hr/konsumglobal_jmodel.php */