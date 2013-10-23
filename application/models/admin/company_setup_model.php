<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * Comapny SEtup
 *
 * @subpackage Company_setup_model
 * @category model
 * @version 1.0
 * @copyright Copyright (c) 2013, Konsum Technologies Inc.
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */

class Company_setup_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function display_owners(){ 
		$query 	= $this->db->get_where("company_owner",array("status"=>"Active","deleted"=>"0"));
		$row	= $query->result();
		$query->free_result();
		return $row;
	}
	
	public function save_fields($database,$fields){
		$this->db->insert($database,$fields);
		return $this->db->insert_id();
	}
	
	public function update_fields($database,$fields,$company_id) {
		$this->db->where("company_id",$this->db->escape_str($company_id));
		$this->db->update($database,$fields);
		return $this->db->insert_id();
	}
	
	public function company_info($comp_id){
		$query = $this->db->query("SELECT co.owner_name,c.registered_business_name,c.trade_name,c.business_address,c.city,c.zipcode,c.organization_type,
								c.industry,c.business_phone,c.extension,c.mobile_number,c.fax FROM company c 
								LEFT JOIN company_owner co on co.company_owner_id = c.company_owner_id WHERE 
								c.company_id='{$this->db->escape_str($comp_id)}' AND c.status='Active' AND c.deleted='0'");
		$rows = $query->row();
		$query->free_result();
		return $rows;
	}
	
	public function fetch_company($limit,$offset) {
		$this->db->limit($limit,$offset);
		$this->db->where(array("status"=>"Active","deleted"=>"0"));
		$query = $this->db->get("company");
		$result = $query->result();
		$query->free_result();
		return $result;
	}
	
	public function count_company() {
		$query 	= $this->db->query("SELECT COUNT(*) as val from company WHERE status='Active' and deleted = '0'");
		$row	= $query->num_rows();
		$res 	= $query->row();
		$query->free_result();
		return $row ? $res->val : 0;
	}
}

/* End of file Company_setup_model.php */
/* Location: ./application/model/admin/Company_setup_model.php */