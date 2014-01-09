<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Income_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
    
    /**
     * Income Information
     * @param unknown_type $comp_id
     */
    public function income_view($comp_id){
    	$sql = $this->db->query("
    		SELECT *FROM income
    		WHERE comp_id = '{$comp_id}'
    		AND status = 'Active'
    	");
    	
    	if($sql->num_rows() > 0){
    		$row = $sql->row();
    		$sql->free_result();
    		return $row;
    	}
    }
    
    /**
     * Update Income Information
     * @param unknown_type $income_id
     * @param unknown_type $basic_pay
     * @param unknown_type $overtime
     * @param unknown_type $fixed_allowance
     * @param unknown_type $holiday_premium_pay
     * @param unknown_type $night_shift_differential
     * @param unknown_type $commission
     * @param unknown_type $piece_rate_pay
     * @param unknown_type $comp_id
     */
    public function update_income(
		$income_id,$basic_pay,$overtime,$fixed_allowance,$holiday_premium_pay,$night_shift_differential,$commission,$piece_rate_pay,$comp_id
	){
		$sql = $this->db->query("
    		UPDATE income SET
    		basic_pay = '{$basic_pay}',
    		overtime = '{$overtime}',
    		fixed_allowance = '{$fixed_allowance}', 
    		holiday_premium_pay = '{$holiday_premium_pay}', 
    		night_shift_differential = '{$night_shift_differential}', 
    		commission = '{$commission}',
    		piece_rate_pay = '{$piece_rate_pay}' 
    		WHERE comp_id = '{$comp_id}'
    		AND status = 'Active'
    	");
    	
    	if($sql){
    		return true;
    	}
	}
		
}
/* End of file */