<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_list_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

	public function get_company(){
		return $this->db->query("
			SELECT *
			FROM `company` c
		");
	}
	
	/**
	 * Save fields 
	 * @param string $database
	 * @param array $field
	 * @return integer
	 */
	public function save_fields($database,$field){
		$this->db->insert($database,$field);
		return $this->db->insert_id();
	}
	
	/**
	 * Update fields
	 * @param string $database
	 * @param array $field
	 * @param array $where
	 * @return boolean
	 */
	public function update_fields($database,$field,$where){
		$this->db->where($where);
		$this->db->update($database,$field);
		return $this->db->affected_rows();
	}
		
}
/* End of file */