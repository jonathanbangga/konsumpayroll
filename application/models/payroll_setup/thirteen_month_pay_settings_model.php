<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Thirteen_month_pay_settings_model for 13month settings
 *
 * @category Model
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */

class Thirteen_month_pay_settings_model extends CI_Model {

	

    public function __construct(){
        parent::__construct();
		// default
	
    }
    
    /**
     * CHECK THE 13months settings
     * displays 13month settings 
     * @param int $company_id
     * @return object
     */
    public function get_settings($company_id){
    	if(is_numeric($company_id)){
	    	$query = $this->db->query("SELECT * FROM thirteen_month_settings WHERE company_id = '{$this->db->escape_str($company_id)}' AND deleted='0'");
	    	$row = $query->row();
	    	$query->free_result();
	    	return $row;
   	 	}else{
   	 		return false;
   	 	}
    }
    
    /**
     * GET earnings 
     * Enter description here ...
     * @param unknown_type $company_id
     */
    public function get_earnings($company_id){
    	if(is_numeric($company_id)){
	    	$query = $this->db->get_where("earnings",array("company_id"=>$this->db->escape_str($company_id),"status"=>"Active","deleted"=>"0"));
	    	$result = $query->result();
	    	$query->free_result();
	    	return $result;
    	}else{
    		return false;
    	}
    }
    
    public function save_field($table,$field){
    	return $this->db->insert($table,$field);
    	//return $this->db->insert_id();
    }
    
    public function update_field($table,$field,$where){
    	$this->db->where($where);
    	$this->db->update($table,$field);
    	return $this->db->affected_rows();
    }
    
    public function delete_include_earnings($company_id){
    	if(is_numeric($company_id)){
    		$this->db->delete("thirteen_month_include_earnings",array("company_id"=>$company_id));
    	}
    }
    
    /**
     * GET other adjustments
     * gets the value of the current other adjustments
     * @param int $company_id
     * @return object
     */
    public function get_other_adjustments($company_id){
    	if(is_numeric($company_id)){
	    	$query = $this->db->query("SELECT * FROM thirteen_month_other_adjustments WHERE company_id = '{$this->db->escape_str($company_id)}' and deleted = '0' ");
	    	$result = $query->result();
	    	$query->free_result();
	    	return $result;
    	}else{
    		return false;
    	}
    }
    
    /**
     * GET EARNING VIA SAVE ONLY ON THE THIRTHEEN MONTH
     * Enter description here ...
     * @param unknown_type $earning_id
     */
    public function get_earnings_13month($earning_id){
    	if(is_numeric($earning_id)){
	    	$query = $this->db->query("SELECT * FROM thirteen_month_include_earnings WHERE company_id = '{$this->company_id}' 
	    			AND earning_id = '{$this->db->escape_str($earning_id)}'");
	    	$row = $query->row();
	    	$query->free_result();
	    	return $row;
    	}else{
    		return false;
    	}
    }
		
}
/* End of file hr_setup_model.php */