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
		
	/**
	 * CHECK OWNER companies
	 * Check owners company
	 * @param int $start
	 * @param int $limit
	 */
	public function get_companies_owned($start=0,$limit=5){
		$sql = "SELECT * FROM company c
				LEFT JOIN assigned_company ac on ac.company_id = c.company_id 
				WHERE ac.payroll_system_account_id = '{$ththis->session->usedata('psa_id')}' 
				AND c.status = 'Active' AND c.deleted='0' AND ac.deleted = '0'";
		$query = $this->db->query($sql);
		$result = $query->result();
		$query->free_result();
		return $result;
	}
	
}
/* End of file */