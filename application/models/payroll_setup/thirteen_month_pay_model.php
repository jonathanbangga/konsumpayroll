<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Thirteen moth pay model
 *
 * @category Model
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
class Thirteen_month_pay_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
    }
	
    /**
     * GET thirteen month pay 
     * this will be our getter for the thirteen_month_pay
     * @param int $company_id
     * @return object
     */ 
    public function get_thirteen_month_pay($company_id,$payroll_group_id){
    	if(is_numeric($company_id) && is_numeric($payroll_group_id)){
    		$query = $this->db->query("SELECT * FROM thirteen_month_pay WHERE company_id='{$this->db->escape_str($company_id)}' 
    				AND payroll_group_id = '{$this->db->escape_str($payroll_group_id)}' AND deleted='0'"
    		);
    		$row = $query->row();
    		$query->free_result();
    		return $row;
    	}else{
    		return false;
    	}
    }
    
    /**
     * UPDATE Thirteen month pay
     * updates this data for 13month
     * @param int $company_id
     * @param array $field
     * @return boolean
     */
    public function update_thirteen_month_pay($where,$field){
    	$this->db->where($where);
    	$this->db->update('thirteen_month_pay',$field);
		return $this->db->affected_rows();
    }
    
    /**
     * SAVES thirteen month pay
     * saves the thirteen month pay
     * @param array $field
     * @return integer
     */ 
    public function save_thirteen_month_pay($field){
    	$this->db->insert('thirteen_month_pay',$field);
    	return $this->db->insert_id();
    }
    
    /**
     * GET PAYROLL CALENDAR THIS WILL BE OUR PREFILLED DATA BETWEEN TAKING OUT 
     * CHECKS OUR PREFILLED PAYROLL_CALENDAR DEDICATED TO TAKE OUT 
     * @param int $company_id
     * @return $result
     */
    public function get_payroll_calendar($company_id){
    	if(is_numeric($company_id)){
    		$query = $this->db->query("SELECT * FROM payroll_calendar WHERE company_id = '{$this->db->escape_str($company_id)}'");
    		$result = $query->result();
    		$query->free_result();
    		return $result;
    	}else{
    		return false;
    	}
    }

    public function get_payroll_group_setup($company_id){
    	if(is_numeric($company_id)){
	    	$query = $this->db->query("SELECT * FROM payroll_group WHERE company_id='{$this->db->escape_str($company_id)}'");
	    	$result = $query->result();
	    	$query->free_result();
	    	return $result;
    	}else{
    		return false;
    	}
    }
    
    public function check_thirteen_month_pay_exist($company_id,$payroll_group_id){
    	if(is_numeric($company_id) && is_numeric($payroll_group_id)){
    		$query = $this->db->query("SELECT * FROM thirteen_month_pay WHERE company_id='{$company_id}' AND payroll_group_id='{$payroll_group_id}'");
    		$row = $query->row();
    		$query->free_result();
    		return $row;
    	}else{
    		return false;
    	}
    }
    
    public function check_payroll_calendar($company_id,$payroll_group_id){
    	$query = $this->db->query("SELECT * FROM payroll_calendar WHERE payroll_group_id = '{$this->db->escape_str($payroll_group_id)}'");
    	$row = $query->row();
    	$query->free_result();
    	return $row;
    }
    
    
}
/* End of file hr_setup_model.php */