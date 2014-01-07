<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payroll_journal_entries_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
    
    /**
     * Get Expense Reim
     * @param unknown_type $company_id
     */
    public function expense_reim($company_id){
    	$sql = $this->db->query("
    		SELECT *FROM payroll_journal_entries_expense_reimbursement
    		WHERE comp_id = '{$company_id}'
    		AND status = 'Active'
    	");
    	if($sql->num_rows() > 0){
    		$results = $sql->result();
    		$sql->free_result();
    		return $results;
    	}
    }
    
	/**
     * Get payroll_journal_entries_other_deductions
     * @param unknown_type $company_id
     */
    public function other_deduction($company_id){
    	$sql = $this->db->query("
    		SELECT *FROM payroll_journal_entries_other_deductions
    		WHERE comp_id = '{$company_id}'
    		AND status = 'Active'
    	");
    	if($sql->num_rows() > 0){
    		$results = $sql->result();
    		$sql->free_result();
    		return $results;
    	}
    }
    
	/**
     * Get payroll_journal_entries_witholding_tax
     * @param unknown_type $company_id
     */
    public function with_tax_others($company_id){
    	$sql = $this->db->query("
    		SELECT *FROM payroll_journal_entries_witholding_tax
    		WHERE comp_id = '{$company_id}'
    		AND status = 'Active'
    	");
    	if($sql->num_rows() > 0){
    		$results = $sql->result();
    		$sql->free_result();
    		return $results;
    	}
    }
    
    /**
     * Get Earnings Information
     * @param unknown_type $company_id
     */
    public function earnings($company_id){
    	$sql = $this->db->query("
    		SELECT *FROM payroll_journal_entries_earnings
    		WHERE comp_id = '{$company_id}'
    		AND status = 'Active'
    	");
    	if($sql->num_rows() > 0){
    		$results = $sql->result();
    		$sql->free_result();
    		return $results;
    	}
    }
    
	/**
     * Get Government Contributions Information
     * @param unknown_type $company_id
     */
    public function government_contributions($company_id){
    	$sql = $this->db->query("
    		SELECT *FROM payroll_journal_entries_government_contributions
    		WHERE comp_id = '{$company_id}'
    		AND status = 'Active'
    	");
    	if($sql->num_rows() > 0){
    		$results = $sql->result();
    		$sql->free_result();
    		return $results;
    	}
    }
    
    /**
     * Update Earnings Information
     * @param unknown_type $earnings_id
     * @param unknown_type $earnings
     * @param unknown_type $earnings_account_code
     * @param unknown_type $earnings_description
     * @param unknown_type $company_id
     */
    public function update_earnings_sql(
		$earnings_id,$earnings,$earnings_account_code,$earnings_description,$company_id
	){
		$sql = $this->db->query("
    		UPDATE payroll_journal_entries_earnings SET
    		earnings = '{$earnings}',
    		account_code = '{$earnings_account_code}',
    		description = '{$earnings_description}'
    		WHERE comp_id = '{$company_id}'
    		AND payroll_journal_entries_id = '{$earnings_id}'
    		AND status = 'Active'
    	");
    	if($sql){
    		return true;
    	}
	}
	
	/**
	 * Update Government Contributions Information
	 * @param unknown_type $government_contributions_id
	 * @param unknown_type $government_contributions
	 * @param unknown_type $government_contributions_account_code
	 * @param unknown_type $government_contributions_description
	 * @param unknown_type $company_id
	 */
	public function update_government_contributions_sql(
		$government_contributions_id,$government_contributions,$government_contributions_account_code,$government_contributions_description,$company_id
	){
		$sql = $this->db->query("
    		UPDATE payroll_journal_entries_government_contributions SET
    		government_contributions = '{$government_contributions}',
    		account_code = '{$government_contributions_account_code}',
    		description = '{$government_contributions_description}'
    		WHERE comp_id = '{$company_id}'
    		AND payroll_journal_entries_government_contributions_id = '{$government_contributions_id}'
    		AND status = 'Active'
    	");
    	if($sql){
    		return true;
    	}
	}
	
	/**
	 * Update Expense Reimbursement
	 * @param unknown_type $expense_reim_id
	 * @param unknown_type $expense_reim_account_code
	 * @param unknown_type $expense_reim_description
	 * @param unknown_type $company_id
	 */
	public function update_expense_reim_sql(
		$expense_reim_id,$expense_reim_account_code,$expense_reim_description,$company_id
	){
		$sql = $this->db->query("
    		UPDATE payroll_journal_entries_expense_reimbursement SET
    		account_code = '{$expense_reim_account_code}',
    		description = '{$expense_reim_description}'
    		WHERE comp_id = '{$company_id}'
    		AND payroll_journal_entries_expense_reimbursement_id = '{$expense_reim_id}'
    		AND status = 'Active'
    	");
    	if($sql){
    		return true;
    	}
	}
	
	/**
	 * Update Other Deductions Information
	 * @param unknown_type $other_deductions_id
	 * @param unknown_type $other_deductions
	 * @param unknown_type $other_deductions_account_code
	 * @param unknown_type $other_deductions_description
	 * @param unknown_type $company_id
	 */
	public function update_other_deductions_sql(
		$other_deductions_id,$other_deductions,$other_deductions_account_code,$other_deductions_description,$company_id
	){
		$sql = $this->db->query("
    		UPDATE payroll_journal_entries_other_deductions SET
    		other_deductions = '{$other_deductions}',
    		account_code = '{$other_deductions_account_code}',
    		description = '{$other_deductions_description}'
    		WHERE comp_id = '{$company_id}'
    		AND payroll_journal_entries_other_deductions_id = '{$other_deductions_id}'
    		AND status = 'Active'
    	");
    	if($sql){
    		return true;
    	}
	}
	
	/**
	 * Update Witholding tax
	 * @param unknown_type $witholding_tax_id
	 * @param unknown_type $witholding_tax
	 * @param unknown_type $witholding_tax_account_code
	 * @param unknown_type $witholding_tax_description
	 * @param unknown_type $company_id
	 */
	public function update_with_tax_sql(
		$witholding_tax_id,$witholding_tax,$witholding_tax_account_code,$witholding_tax_description,$company_id
	){
		$sql = $this->db->query("
    		UPDATE payroll_journal_entries_witholding_tax SET
    		others = '{$witholding_tax}',
    		account_code = '{$witholding_tax_account_code}',
    		description = '{$witholding_tax_description}'
    		WHERE comp_id = '{$company_id}'
    		AND payroll_journal_entries_witholding_tax_id = '{$witholding_tax_id}'
    		AND status = 'Active'
    	");
    	if($sql){
    		return true;
    	}
	}
	
	/**
	 * Delete Expense Reimbursement
	 * @param unknown_type $expense_reim_id
	 * @param unknown_type $company_id
	 */
	public function del_expense_reim($expense_reim_id,$company_id){
		$sql = $this->db->query("
    		DELETE FROM payroll_journal_entries_expense_reimbursement
    		WHERE comp_id = '{$company_id}'
    		AND payroll_journal_entries_expense_reimbursement_id = '{$expense_reim_id}'
    		AND status = 'Active'
    	");
    	if($sql){
    		return true;
    	}
	}
	
	/**
	 * Delete Other Deduction
	 * @param unknown_type $other_deduction_id
	 * @param unknown_type $company_id
	 */
	public function del_other_deduction($other_deduction_id,$company_id){
		$sql = $this->db->query("
    		DELETE FROM payroll_journal_entries_other_deductions
    		WHERE comp_id = '{$company_id}'
    		AND payroll_journal_entries_other_deductions_id = '{$other_deduction_id}'
    		AND status = 'Active'
    	");
    	if($sql){
    		return true;
    	}
	}
	
	/**
	 * Delete Witholding tax
	 * @param unknown_type $with_tax_others_id
	 * @param unknown_type $company_id
	 */
	public function del_with_tax_others($with_tax_others_id,$company_id){
		$sql = $this->db->query("
    		DELETE FROM payroll_journal_entries_witholding_tax
    		WHERE comp_id = '{$company_id}'
    		AND payroll_journal_entries_witholding_tax_id = '{$with_tax_others_id}'
    		AND status = 'Active'
    	");
    	if($sql){
    		return true;
    	}
	}

}
/* End of file */