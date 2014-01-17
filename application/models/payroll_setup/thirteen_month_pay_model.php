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
    public function get_thirteen_month_pay($company_id,$payroll_group_id,$thirteen_month_pay_id){
    	if(is_numeric($company_id) && is_numeric($thirteen_month_pay_id)){
    		$query = $this->db->query("SELECT * FROM thirteen_month_pay WHERE company_id='{$this->db->escape_str($company_id)}' 
    				AND payroll_group_id = '{$this->db->escape_str($payroll_group_id)}'  
    				AND thirteen_month_pay_id = '{$this->db->escape_str($thirteen_month_pay_id)}' 
    				AND deleted='0'"
    		);
    		$row = $query->row();
    		$query->free_result();
    		return $row;
    	}else{
    		return false;
    	}
    }
    
    /**
     * THIS IS TO CHECK AND COUNT ALL DATA
     * Enter description here ...
     * @param unknown_type $company_id
     */
    public function count_thirteen_month_pay($company_id){
    	$query = $this->db->query("SELECT count(*) as num FROM thirteen_month_pay WHERE company_id = '{$this->db->escape_str($company_id)}'");
    	$row = $query->row();
    	$query->free_result();
    	return $row ? $row->num : 0;
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
    		////LEFT JOIN thirteen_month_pay tmp on tmp.payroll_group_id = pg.payroll_group_id
	    	$query = $this->db->query("
	    			SELECT * FROM payroll_group pg 
	    			LEFT JOIN thirteen_month_pay tmp on tmp.payroll_group_id = pg.payroll_group_id 
					WHERE pg.company_id ='{$this->db->escape_str($company_id)}'
	    	");
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
    
	/**
	*	ADD MORE THIRTEEN LIKE FO URTEEN 
	*
	*/
    public function add_more_thirteen($company_id,$update_payroll_group_id,$parent_tmp_id){
    $ifields = array(
			'company_id'	=> $company_id,
			'parent_tmp_id'	=> $this->db->escape_str($parent_tmp_id),
			'payroll_group_id'=>$this->input->post('update_choose_payrollgroup'),
			'process_by'=>$this->input->post('thirteen_month_process'),
			'first_month_payroll_date'=>$this->input->post('first_month_payroll_date'),
			'first_month_payroll_from'=>$this->input->post('first_month_payroll_from'),
			'first_month_payroll_to'=>$this->input->post('first_month_payroll_to'),
			'second_month_payroll_date'=>$this->input->post('second_month_payroll_date'),
			'second_month_payroll_from'=>$this->input->post('second_month_payroll_from'),
			'second_month_payroll_to'=>$this->input->post('second_month_payroll_to'),
			'third_month_payroll_date'=>$this->input->post('third_month_payroll_date'),
			'third_month_payroll_from'=>$this->input->post('third_month_payroll_from'),
			'third_month_payroll_to'=>$this->input->post('third_month_payroll_to'),
			'fourth_month_payroll_date'=>$this->input->post('fourth_month_payroll_date'),
			'fourth_month_payroll_from'=>$this->input->post('fourth_month_payroll_from'),
			'fourth_month_payroll_to'=>$this->input->post('fourth_month_payroll_to'),
			'fifth_month_payroll_date'=>$this->input->post('fifth_month_payroll_date'),
			'fifth_month_payroll_from'=>$this->input->post('fifth_month_payroll_from'),
			'fifth_month_payroll_to'=>$this->input->post('fifth_month_payroll_to'),
			'sixth_month_payroll_date'=>$this->input->post('sixth_month_payroll_date'),
			'sixth_month_payroll_from'=>$this->input->post('sixth_month_payroll_from'),
			'sixth_month_payroll_to'=>$this->input->post('sixth_month_payroll_to'),
			'seventh_month_payroll_date'=>$this->input->post('seventh_month_payroll_date'),
			'seventh_month_payroll_from'=>$this->input->post('seventh_month_payroll_from'),
			'seventh_month_payroll_to'=>$this->input->post('seventh_month_payroll_to'),
			'eight_month_payroll_date'=>$this->input->post('eight_month_payroll_date'),
			'eight_month_payroll_from'=>$this->input->post('eight_month_payroll_from'),
			'eight_month_payroll_to'=>$this->input->post('eight_month_payroll_to'),
			'ninth_month_payroll_date'=>$this->input->post('ninth_month_payroll_date'),
			'ninth_month_payroll_from'=>$this->input->post('ninth_month_payroll_from'),
			'ninth_month_payroll_to'=>$this->input->post('ninth_month_payroll_to'),
			'tenth_month_payroll_date'=>$this->input->post('tenth_month_payroll_date'),
			'tenth_month_payroll_from'=>$this->input->post('tenth_month_payroll_from'),
			'tenth_month_payroll_to'=>$this->input->post('tenth_month_payroll_to'),
			'eleventh_month_payroll_date'=>$this->input->post('eleventh_month_payroll_date'),
			'eleventh_month_payroll_from'=>$this->input->post('eleventh_month_payroll_from'),
			'eleventh_month_payroll_to'=>$this->input->post('eleventh_month_payroll_to'),
			'twelveth_month_payroll_date'=>$this->input->post('twelveth_month_payroll_date'),
			'twelveth_month_payroll_from'=>$this->input->post('twelveth_month_payroll_from'),
			'twelveth_month_payroll_to'=>$this->input->post('twelveth_month_payroll_to'),
			'first_quarter_date'=>$this->input->post('first_quarter_date'),
			'first_quarter_from'=>$this->input->post('first_quarter_from'),
			'first_quarter_to'=>$this->input->post('first_quarter_to'),
			'second_quarter_date'=>$this->input->post('second_quarter_date'),
			'second_quarter_from'=>$this->input->post('second_quarter_from'),
			'second_quarter_to'=>$this->input->post('second_quarter_to'),
			'third_quarter_date'=>$this->input->post('third_quarter_date'),
			'third_quarter_from'=>$this->input->post('third_quarter_from'),
			'third_quarter_to'=>$this->input->post('third_quarter_to'),
			'thirteen_month_released_date'=>$this->input->post('thirteen_month_released_date'),
			'date'=>idates_now(),
    		'add_another_bonus'	=>'no'
		);
		return $this->save_thirteen_month_pay($ifields);
    }
    
	/**
	*	UPDATE THE MORE FOPURTTHEEN
	*	@param int $company_id
	*	@return object
	*/
	public function update_the_moreforteenth($company_id){
		if(is_numeric($company_id)){
			$uthirteen_month_pay_id = $this->input->post('uthirteen_month_pay_id');
			$uthirteen_month_process = $this->input->post('uthirteen_month_process');
			$upayroll_group_id = $this->input->post('upayroll_group_id');	
			$ufirst_month_payroll_date = $this->input->post('ufirst_month_payroll_date');
			$ufirst_month_payroll_from = $this->input->post('ufirst_month_payroll_from');
			$ufirst_month_payroll_to = $this->input->post('ufirst_month_payroll_to');			
			$usecond_month_payroll_date = $this->input->post('usecond_month_payroll_date');
			$usecond_month_payroll_from = $this->input->post('usecond_month_payroll_from');
			$usecond_month_payroll_to = $this->input->post('usecond_month_payroll_to');				
			$uthird_month_payroll_date = $this->input->post('uthird_month_payroll_date');
			$uthird_month_payroll_from = $this->input->post('uthird_month_payroll_from');
			$uthird_month_payroll_to = $this->input->post('uthird_month_payroll_to');				
			$ufourth_month_payroll_date = $this->input->post('ufourth_month_payroll_date');
			$ufourth_month_payroll_from = $this->input->post('ufourth_month_payroll_from');
			$ufourth_month_payroll_to = $this->input->post('ufourth_month_payroll_to');				
			$ufifth_month_payroll_date = $this->input->post('ufifth_month_payroll_date');
			$ufifth_month_payroll_from = $this->input->post('ufifth_month_payroll_from');
			$ufifth_month_payroll_to = $this->input->post('ufifth_month_payroll_to');				
			$usixth_month_payroll_date = $this->input->post('usixth_month_payroll_date');
			$usixth_month_payroll_from = $this->input->post('usixth_month_payroll_from');
			$usixth_month_payroll_to = $this->input->post('usixth_month_payroll_to');				
			$useventh_month_payroll_date = $this->input->post('useventh_month_payroll_date');
			$useventh_month_payroll_from = $this->input->post('useventh_month_payroll_from');
			$useventh_month_payroll_to = $this->input->post('useventh_month_payroll_to');				
			$ueight_month_payroll_date = $this->input->post('ueight_month_payroll_date');
			$ueight_month_payroll_from = $this->input->post('ueight_month_payroll_from');
			$ueight_month_payroll_to = $this->input->post('ueight_month_payroll_to');				
			$uninth_month_payroll_date = $this->input->post('uninth_month_payroll_date');
			$uninth_month_payroll_from = $this->input->post('uninth_month_payroll_from');
			$uninth_month_payroll_to = $this->input->post('uninth_month_payroll_to');				
			$utenth_month_payroll_date = $this->input->post('utenth_month_payroll_date');
			$utenth_month_payroll_from = $this->input->post('utenth_month_payroll_from');
			$utenth_month_payroll_to = $this->input->post('utenth_month_payroll_to');
			$ueleventh_month_payroll_date = $this->input->post('ueleventh_month_payroll_date');
			$ueleventh_month_payroll_from = $this->input->post('ueleventh_month_payroll_from');
			$ueleventh_month_payroll_to = $this->input->post('ueleventh_month_payroll_to');
			$utwelveth_month_payroll_date = $this->input->post('utwelveth_month_payroll_date');
			$utwelveth_month_payroll_from = $this->input->post('utwelveth_month_payroll_from');
			$utwelveth_month_payroll_to = $this->input->post('utwelveth_month_payroll_to');
			$ufirst_quarter_date = $this->input->post('ufirst_quarter_date');
			$ufirst_quarter_from = $this->input->post('ufirst_quarter_from');
			$ufirst_quarter_to = $this->input->post('ufirst_quarter_to');			
			$usecond_quarter_date = $this->input->post('usecond_quarter_date');
			$usecond_quarter_from = $this->input->post('usecond_quarter_from');
			$usecond_quarter_to = $this->input->post('usecond_quarter_to');			
			$uthird_quarter_date = $this->input->post('uthird_quarter_date');
			$uthird_quarter_from = $this->input->post('uthird_quarter_from');
			$uthird_quarter_to = $this->input->post('uthird_quarter_to');
			$uthirteen_month_released_date	= $this->input->post('uthirteen_month_released_date');		
				if($uthirteen_month_pay_id){
				foreach($uthirteen_month_pay_id as $pgi_key=>$utmp_val):
					$field = array(
						"process_by"				=> $uthirteen_month_process[$pgi_key],
						"first_month_payroll_date"	=> date_clean($ufirst_month_payroll_date[$pgi_key]),
						"first_month_payroll_from"	=> date_clean($ufirst_month_payroll_from[$pgi_key]),	
						"first_month_payroll_to"	=> date_clean($ufirst_month_payroll_to[$pgi_key]),
						"second_month_payroll_date"	=> date_clean($usecond_month_payroll_date[$pgi_key]),
						"second_month_payroll_from"	=> date_clean($usecond_month_payroll_from[$pgi_key]),	
						"second_month_payroll_to"	=> date_clean($usecond_month_payroll_to[$pgi_key]),			
						"third_month_payroll_date"	=> date_clean($uthird_month_payroll_date[$pgi_key]),			
						"third_month_payroll_from"	=> date_clean($uthird_month_payroll_from[$pgi_key]),
						"third_month_payroll_to"	=> date_clean($uthird_month_payroll_to[$pgi_key]),
						"fourth_month_payroll_date"	=> date_clean($ufourth_month_payroll_date[$pgi_key]),
						"fourth_month_payroll_from"	=> date_clean($ufourth_month_payroll_from[$pgi_key]),			
						"fourth_month_payroll_to"	=> date_clean($ufourth_month_payroll_to[$pgi_key]),
						"fifth_month_payroll_date"	=> date_clean($ufifth_month_payroll_date[$pgi_key]),
						"fifth_month_payroll_from"	=> date_clean($ufifth_month_payroll_from[$pgi_key]),			
						"fifth_month_payroll_to"	=> date_clean($ufifth_month_payroll_to[$pgi_key]),			
						"sixth_month_payroll_date"	=> date_clean($usixth_month_payroll_date[$pgi_key]),			
						"sixth_month_payroll_from"	=> date_clean($usixth_month_payroll_from[$pgi_key]),
						"sixth_month_payroll_to"	=> date_clean($usixth_month_payroll_to[$pgi_key]),
						"seventh_month_payroll_date"=> date_clean($useventh_month_payroll_date[$pgi_key]),
						"seventh_month_payroll_from"=> date_clean($useventh_month_payroll_from[$pgi_key]),			
						"seventh_month_payroll_to"	=> date_clean($useventh_month_payroll_to[$pgi_key]),
						"eight_month_payroll_date"	=> date_clean($ueight_month_payroll_date[$pgi_key]),
						"eight_month_payroll_from"	=> date_clean($ueight_month_payroll_from[$pgi_key]),			
						"eight_month_payroll_to"	=> date_clean($ueight_month_payroll_to[$pgi_key]),			
						"ninth_month_payroll_date"	=> date_clean($uninth_month_payroll_date[$pgi_key]),			
						"ninth_month_payroll_from"	=> date_clean($uninth_month_payroll_from[$pgi_key]),	
						"ninth_month_payroll_to"	=> date_clean($uninth_month_payroll_to[$pgi_key]),
						"tenth_month_payroll_date"	=> date_clean($utenth_month_payroll_date[$pgi_key]),
						"tenth_month_payroll_from"	=> date_clean($utenth_month_payroll_from[$pgi_key]),
						"tenth_month_payroll_to"	=> date_clean($utenth_month_payroll_to[$pgi_key]),
						"eleventh_month_payroll_date"	=> date_clean($ueleventh_month_payroll_date[$pgi_key]), 
						"eleventh_month_payroll_from"	=> date_clean($ueleventh_month_payroll_from[$pgi_key]),
						"eleventh_month_payroll_to"		=> date_clean($ueleventh_month_payroll_to[$pgi_key]),
						"twelveth_month_payroll_date"	=> date_clean($utwelveth_month_payroll_date[$pgi_key]),
						"twelveth_month_payroll_from"	=> date_clean($utwelveth_month_payroll_from[$pgi_key]),
						"twelveth_month_payroll_to"	=> date_clean($utwelveth_month_payroll_to[$pgi_key]),
						"first_quarter_date"	=> date_clean($ufirst_quarter_date[$pgi_key]),
						"first_quarter_from"	=> date_clean($ufirst_quarter_from[$pgi_key]),
						"first_quarter_to"		=> date_clean($ufirst_quarter_to[$pgi_key]),
						"second_quarter_date"	=> date_clean($usecond_quarter_date[$pgi_key]),
						"second_quarter_from"	=> date_clean($usecond_quarter_from[$pgi_key]),
						"second_quarter_to"		=> date_clean($usecond_quarter_to[$pgi_key]),
						"third_quarter_date"	=> date_clean($uthird_quarter_date[$pgi_key]),
						"third_quarter_from"	=> date_clean($uthird_quarter_from[$pgi_key]),
						"third_quarter_to"		=> date_clean($uthird_quarter_to[$pgi_key]),
						"thirteen_month_released_date" => date_clean($uthirteen_month_released_date[$pgi_key]),
						"date"					=> idates_now(),
						"deleted"				=> '0'	
					);
					
					$where_update = array("company_id"=>$company_id,"thirteen_month_pay_id"=>$this->db->escape_str($utmp_val));
					$this->update_thirteen_month_pay($where_update,$field);					
				endforeach;
			}else{
				return false;
			}
		}
	}
	
	
    
    /** libog hapsay mode **/
    public function g_thirteen_monthpay($company_id){
    	$query = $this->db->query("SELECT * FROM payroll_group WHERE company_id ='{$this->db->escape_str($company_id)}'");
    	$result = $query->result();
    	$query->free_result();
    	return $result;
    }
    
	public function get_thirteen_month_values($company_id,$payroll_group_id){
    	if(is_numeric($company_id) && is_numeric($payroll_group_id)){
    		$query = $this->db->query("SELECT * FROM thirteen_month_pay WHERE company_id='{$this->db->escape_str($company_id)}' 
    				AND payroll_group_id = '{$this->db->escape_str($payroll_group_id)}'  AND parent_tmp_id='0' 
    				AND deleted='0'"
    		);
    		$row = $query->row();
    		$query->free_result();
    		return $row;
    	}else{
    		return false;
    	}
    }
	
	public function get_fourthenth_months($the_tmp_id,$company_id){
		if(is_numeric($the_tmp_id) && is_numeric($company_id)){
			$query = $this->db->query("SELECT * FROM thirteen_month_pay WHERE parent_tmp_id = '{$the_tmp_id}' AND company_id = '{$company_id}'");
			$result = $query->result();
			$query->free_result();
			return $result;
		}else{
			return false;
		}
	}
    
    
    
    
}
/* End of file hr_setup_model.php */