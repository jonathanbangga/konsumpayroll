<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Priority_of_deductions_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
    
    public function get_priority_of_deductions($company_id){
    	if(is_numeric($company_id)){
    		$query = $this->db->query("SELECT * FROM priority_of_deductions WHERE company_id='{$this->db->escape_str($company_id)}' AND deleted='0'");
    		$row = $query->row();
    		$query->free_result();
    		return $row;
    	}else{
    		return false;
    	}
    }
    
    /**
     * SAVE PRIORITY OF DEDUCATIONS 
     * Enter description here ...
     * @param int $company_id
     * @param int $philhealth
     * @param int $sss
     * @param int $withholding_tax
     * @param int $hdmf
     * @param int $company_loan
     * @param int $sss_salary_loan
     * @param int $sss_calamity_loan
     * @param int $sss_emergency_loan
     */
    public function save_priority_of_deducations($company_id,$philhealth,$sss,$withholding_tax,$hdmf,$company_loan,$sss_salary_loan,$sss_calamity_loan,$sss_emergency_loan){
    	$fields = array(
    		"company_id"		=>$this->db->escape_str($company_id),
    		"philhealth"		=>$this->db->escape_str($philhealth),
    		"sss"				=>$this->db->escape_str($sss),
    		"withholding_tax"	=>$this->db->escape_str($withholding_tax),
    		"hdmf"				=>$this->db->escape_str($hdmf),
    		"company_loan"		=>$this->db->escape_str($company_loan),
    		"sss_salary_loan"	=>$this->db->escape_str($sss_salary_loan),
    		"sss_calamity_loan"	=>$this->db->escape_str($sss_calamity_loan),
    		"sss_emergency_loan"=>$this->db->escape_str($sss_emergency_loan),
    		"date"				=>idates_now()
    	);
    	$this->db->insert('priority_of_deductions',$fields);
    	return $this->db->insert_id();
    }
    
    /**
     * Save priority of deduction toher fields
     * Enter description here ...
     * @param int $company_id
     * @param int $name
     * @param int $priority
     */
    public function save_priority_of_deductions_other($company_id,$name,$priority){
    	$fields = array(
    		"company_id"=>$this->db->escape_str($company_id),
    		"name"		=>$this->db->escape_str($name),
    		"priority"	=>$this->db->escape_str($priority),
    		"date"		=>idates_now(),
    		"deleted"	=> '0'
    	);
    	$this->db->insert('priority_of_deductions_other',$fields);
    	return $this->db->insert_id();
    }
    
    /**
     * UPDATES PRIORITY OF DEDUCATIONS
     * Enter description here ...
     * @param int $company_id
     * @param int $philhealth
     * @param int $sss
     * @param int $withholding_tax
     * @param int $hdmf
     * @param int $company_loan
     * @param int $sss_salary_loan
     * @param int $sss_calamity_loan
     * @param int $sss_emergency_loan
     */
	public function update_priority_of_deducations($company_id,$philhealth,$sss,$withholding_tax,$hdmf,$company_loan,$sss_salary_loan,$sss_calamity_loan,$sss_emergency_loan){
		$where = array(
			"company_id" => $this->db->escape_str($company_id),
			"deleted" => "0"
		);
    	$this->db->where($where);
		$fields = array(
    		"philhealth"		=>$this->db->escape_str($philhealth),
    		"sss"				=>$this->db->escape_str($sss),
    		"withholding_tax"	=>$this->db->escape_str($withholding_tax),
    		"hdmf"				=>$this->db->escape_str($hdmf),
    		"company_loan"		=>$this->db->escape_str($company_loan),
    		"sss_salary_loan"	=>$this->db->escape_str($sss_salary_loan),
    		"sss_calamity_loan"	=>$this->db->escape_str($sss_calamity_loan),
    		"sss_emergency_loan"=>$this->db->escape_str($sss_emergency_loan),
    		"date"				=>idates_now()
    	);
    	$this->db->update('priority_of_deductions',$fields);
    	return $this->db->insert_id();
    }
    
    /**
     * 
     * Enter description here ...
     * @param unknown_type $company_id
     */
    public function get_priority_of_deductions_other($company_id){
    	if(is_numeric($company_id)){
    		$query = $this->db->query("SELECT * FROM priority_of_deductions_other where company_id = '{$this->db->escape_str($company_id)}'");
    		$result = $query->result();
    		$query->free_result();
    		return $result;
    	}else{
    		return false;
    	}
    }
    
	public function update_priority_of_deductions_other($company_id,$priority_of_deductions_other_id,$name,$priority){
		if(is_numeric($priority_of_deductions_other_id)){
	    	$fields = array(
	    		"name"		=>$this->db->escape_str($name),
	    		"priority"	=>$this->db->escape_str($priority),
	    		"date"		=>idates_now()
	    	);
	    	$where = array(
	    			"priority_of_deductions_other_id" => $priority_of_deductions_other_id,
	    			"company_id"	=> $this->db->escape_str($company_id)
	    	);
	    	$this->db->where($where);
	    	$this->db->update('priority_of_deductions_other',$fields);
	    	return $this->db->affected_rows();
		}else{
			
		}
    }
    
    /**
     * REMOVE PRIORITY OF DEDUCTION use for ajax
     * THIS WILL REMOVE PRIORITY DEDUCTIONS
     * @param int $company_id
     * @param int $priority_of_deductions_other_id
     * @return boolean
     */
    public function remove_priority_of_deductions_other($company_id,$priority_of_deductions_other_id){
    	if(is_numeric($company_id) && is_numeric($priority_of_deductions_other_id)){
	    	$where = array(
	    		"priority_of_deductions_other_id" => $priority_of_deductions_other_id,
	    		"company_id" => $company_id
	    	);
	    	$this->db->where($where);
	    	$this->db->delete('priority_of_deductions_other');
	    	return $this->db->affected_rows();
    	}else{
    		return false;
    	}
    }
    
    /**
     * SAVE MORE LOANS 
     * MAO NI MO SAVE KUNG MO ADD SIYA OG MORE LOANS
     * @param int $company_id
     * @param string $name
     * @param int $priority
     * @return integer
     */
 	public function save_priority_of_other_loan($company_id,$name,$priority){
 		if(is_numeric($company_id)){
	    	$fields = array(
	    		"company_id"=>$this->db->escape_str($company_id),
	    		"name"		=>$this->db->escape_str($name),
	    		"priority"	=>$this->db->escape_str($priority),
	    		"date"		=>idates_now(),
	    		"deleted"	=> '0'
	    	);
	    	$this->db->insert('priority_of_deductions_other_loans',$fields);
	    	return $this->db->insert_id();
 		}else{
 			return false;
 		}
    }
    
	public function update_priority_of_other_loan($company_id,$priority_of_deductions_other_loans_id,$name,$priority){
 		if(is_numeric($company_id)){
	    	$fields = array(
	    		"name"		=>$this->db->escape_str($name),
	    		"priority"	=>$this->db->escape_str($priority),
	    		"date"		=>idates_now(),
	    		"deleted"	=> '0'
	    	);
	    	$where = array(
	    		"company_id"=>$this->db->escape_str($company_id),
	    		"priority_of_deductions_other_loans_id" => $priority_of_deductions_other_loans_id
	    	);
	    	$this->db->where($where);
	    	$this->db->update('priority_of_deductions_other_loans',$fields);
	    	return $this->db->insert_id();
 		}else{
 			return false;
 		}
    }
    
    /**
     * REMOVES PRIORITY OF OTHER LOAN
     * removes priority loan
     * @param int $company_id
     * @param int $priority_of_deductions_other_loans_id
     * @return boolean
     */
	public function remove_priority_of_other_loan($company_id,$priority_of_deductions_other_loans_id){
 		if(is_numeric($company_id)){	
	    	$where = array(
	    		"company_id"=>$this->db->escape_str($company_id),
	    		"priority_of_deductions_other_loans_id" => $priority_of_deductions_other_loans_id
	    	);
	    	$this->db->where($where);
	    	$this->db->delete('priority_of_deductions_other_loans');
	    	return $this->db->affected_rows();
 		}else{
 			return false;
 		}
    }
    
    /**
     * GET PRIORITY OF OTHER LOANS
     * CHECK IF priority of other loans
     * @param int $company_id
     * @return object
     */
    public function get_priority_of_other_loan($company_id){
    	if($company_id){
    		$query = $this->db->query("SELECT * FROM priority_of_deductions_other_loans WHERE company_id = '{$company_id}' AND deleted='0' ");
    		$result = $query->result();
    		$query->free_result();
    		return $result;
    	}
    }
    
    
		
}
/* End of file */