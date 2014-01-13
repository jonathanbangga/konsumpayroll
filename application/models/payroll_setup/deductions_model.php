<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deductions_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
    
    /**
     * Payroll Group Information
     * @param unknown_type $comp_id
     */
    public function payroll_group($comp_id){
    	$sql = $this->db->query("
    		SELECT *FROM payroll_group
    		WHERE company_id = '{$comp_id}'
    		AND status = 'Active'
    	");

    	if($sql->num_rows() > 0){
    		$results = $sql->result();
    		$sql->free_result();
    		return $results;
    	}
    }
    
    /**
     * Other Deduction Information
     * @param unknown_type $comp_id
     */
    public function other_deduction($comp_id){
    	$sql = $this->db->query("
    		SELECT *FROM deductions_other_deductions
    		WHERE comp_id = '{$comp_id}'
    		AND status = 'Active'
    	");

    	if($sql->num_rows() > 0){
    		$results = $sql->result();
    		$sql->free_result();
    		return $results;
    	}
    }
    
    /**
     * View Deduction Payroll Group Informatio     
     * @param unknown_type $comp_id
     */
    public function deductions_payroll_group($comp_id){
    	$sql = $this->db->query("
    		SELECT *FROM deductions_payroll_group
    		WHERE comp_id = '{$comp_id}'
    		AND status = 'Active'
    	");

    	if($sql->num_rows() > 0){
    		$results = $sql->result();
    		$sql->free_result();
    		return $results;
    	}
    }
    
    /**
     * Update Payroll Group Other Deduction
     * @param unknown_type $payroll_group_input_other_dd_id
     * @param unknown_type $payroll_group_input_other_dd
     * @param unknown_type $comp_id
     */
    public function update_payroll_group_other_dd($payroll_group_input_other_dd_id,$payroll_group_input_other_dd,$comp_id){
   		$sql = $this->db->query("
    		UPDATE deductions_other_deductions SET
    		view = '{$payroll_group_input_other_dd}'
    		WHERE deductions_other_deductions_id = '{$payroll_group_input_other_dd_id}'
    		AND comp_id = '{$comp_id}'
    		AND status = 'Active'
    	");
   		
    	if($sql){
    		return true;
    	}
    }
    
    /**
     * Update Deduction Payroll Group
     * @param unknown_type $deduction_payroll_group
     * @param unknown_type $deduction_sss
     * @param unknown_type $deduction_philhealth
     * @param unknown_type $deduction_hdmf
     * @param unknown_type $deduction_withholding_tax
     * @param unknown_type $comp_id
     */
    public function update_deduction_payroll_group(
		$deduction_payroll_group, $deduction_sss, $deduction_philhealth, $deduction_hdmf, $deduction_withholding_tax,$comp_id
	){
		$sql = $this->db->query("
    		UPDATE deductions_payroll_group SET
    		sss = '{$deduction_sss}',
    		philhealth = '{$deduction_philhealth}',
    		hdmf = '{$deduction_hdmf}',
    		withholding_tax = '{$deduction_withholding_tax}'
    		WHERE deductions_payroll_group_id = '{$deduction_payroll_group}'
    		AND comp_id = '{$comp_id}'
    		AND status = 'Active'
    	");
   		
    	if($sql){
    		return true;
    	}
	}
	
	/**
	 * Income Information
	 * @param unknown_type $comp_id
	 */
	public function income_info($comp_id){
		$sql = $this->db->query("
    		SELECT *FROM deductions_income
    		WHERE comp_id = '{$comp_id}'
    		AND status = 'Active'
    	");

    	if($sql->num_rows() > 0){
    		$results = $sql->result();
    		$sql->free_result();
    		return $results;
    	}
	}
	
	/**
	 * Adjustments Information
	 * @param unknown_type $comp_id
	 */
	public function adjustments_info($comp_id){
		$sql = $this->db->query("
    		SELECT *FROM deductions_adjustments
    		WHERE comp_id = '{$comp_id}'
    		AND status = 'Active'
    	");

    	if($sql->num_rows() > 0){
    		$results = $sql->result();
    		$sql->free_result();
    		return $results;
    	}
	}
	
	/**
	 * Update Deduction Income
	 * @param unknown_type $ded_income
	 * @param unknown_type $ded_income_basic_sss
	 * @param unknown_type $ded_income_basic_philhealth
	 * @param unknown_type $ded_income_basic_hdmf
	 * @param unknown_type $comp_id
	 */
	public function update_deduction_income(
		$ded_income, $ded_income_basic_sss, $ded_income_basic_philhealth, $ded_income_basic_hdmf, $comp_id
	){
		$sql = $this->db->query("
    		UPDATE deductions_income SET
    		basis_for_sss = '{$ded_income_basic_sss}',
    		basis_for_philhealth  = '{$ded_income_basic_philhealth}',
    		basis_for_hdmf = '{$ded_income_basic_hdmf}'
    		WHERE income = '{$ded_income}'
    		AND comp_id = '{$comp_id}'
    		AND status = 'Active'
    	");
   		
    	if($sql){
    		return true;
    	}
	}
	
	/**
	 * Update Deduction Adjustment
	 * @param unknown_type $ded_adj
	 * @param unknown_type $ded_adj_basic_sss
	 * @param unknown_type $ded_adj_basic_philhealth
	 * @param unknown_type $ded_adj_basic_hdmf
	 * @param unknown_type $comp_id
	 */
	public function update_deduction_adjustments(
		$ded_adj, $ded_adj_basic_sss, $ded_adj_basic_philhealth, $ded_adj_basic_hdmf, $comp_id
	){
		$sql = $this->db->query("
    		UPDATE deductions_adjustments SET
    		basis_for_sss = '{$ded_adj_basic_sss}',
    		basis_for_philhealth  = '{$ded_adj_basic_philhealth}',
    		basis_for_hdmf = '{$ded_adj_basic_hdmf}'
    		WHERE adjustments = '{$ded_adj}'
    		AND comp_id = '{$comp_id}'
    		AND status = 'Active'
    	");
   		
    	if($sql){
    		return true;
    	}	
	}
		
}
/* End of file */