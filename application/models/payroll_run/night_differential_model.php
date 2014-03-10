<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Night_differential_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function nigh_differential_employee_listing($payroll_group_id,$offset="",$limit=""){
		$str_limit = "";
		if($limit!=""){
			$str_limit = "LIMIT {$offset}, {$limit}"; 
		}
		return $this->db->query("
			SELECT *, eti.`date` AS ti_date
			FROM `employee_time_in` AS eti
			LEFT JOIN `employee` AS e ON eti.`emp_id` = e.`emp_id`
			LEFT JOIN `accounts` AS a ON e.`account_id` = a.`account_id`
			LEFT JOIN `employee_shifts_schedule` AS ess ON eti.`emp_id` = ess.`emp_id`
			LEFT JOIN `payroll_period` AS pp ON ess.`payroll_group_id` = pp.`payroll_group_id` 
			LEFT JOIN `holiday` AS h ON h.`date` = eti.`date`
			LEFT JOIN `hours_type` AS ht ON h.`hour_type_id` = ht.`hour_type_id`
			WHERE ess.`payroll_group_id` ={$payroll_group_id}
			AND eti.`comp_id` ={$this->company_id}
			{$str_limit}
		");
	}
	
	public function get_payroll_period(){
		return $this->db->query("
			SELECT *
			FROM `payroll_period`
			WHERE `company_id` ={$this->company_id}
		");
	}
	
	public function employee_listings(){
		// GET night differential overtime SET TIME  ( kuhaon ang nightdifferential settings 
		if($this->company_id !=""){
			$query_nightdiff = $this->db->query("SELECT * FROM nightshift_differential_settings WHERE company_id={$this->company_id}");
			$night_diff_row = $query_nightdiff->row();
			$query_nightdiff->free_result();
			if($night_diff_row) { # MUST HAVE NIGHT SHIFT DIFFERENTIAL BEFORE PROCEEDING TO THIS SECTION
				$nd_from_time = strtotime($night_diff_row->from_time); #FROM TIME
				$nd_to_time = strtotime($night_diff_row->to_time); #TO TIME
				
				# GET OUR PAYROLL PERIOD FIRST 
					$query_payroll_period = $this->db->query("SELECT * FROM payroll_period WHERE company_id = '{$this->company_id}'");
					$p_period = $query_payroll_period->row();
					
					$query_payroll_period->free_result();
					$payroll_period = $p_period->payroll_period;
					$period_from = $p_period->period_from;
					$period_to = $p_period->period_to;		
				# END GET OUR PAYROLL PERIOD FIRST 
				# START TIME IN COUNTING 
					$sql_time_in = "SELECT * FROM `employee_time_in` eti
										LEFT JOIN employee e on e.emp_id = eti.emp_id 
										LEFT JOIN accounts a on a.account_id = e.account_id 
										WHERE  eti.comp_id = '{$this->company_id}' AND 
										eti.time_in BETWEEN '".date("Y-m-d",strtotime($period_from))."' AND '".date("Y-m-d",strtotime($period_to))."'";

				# END COUNTING TIME IN
				$query = $this->db->query($sql_time_in);
				$res = $query->result();
				$query->free_result();
	
				
				return $res;		
				#ONCE WE HAVE THIS SETTINGS TO NIGHT DIFF WE MUST GET THE TIME IN SO WE CAN INITIATE THE DIFFERENT IF THE DATES ARE VALID FOR DIFFERENTIAL
			}
			// END GET night differential overtime SET TIME 
			
		}else{
			return false;
		}
	}
	
	public function get_payroll_period_data(){
		$query_payroll_period = $this->db->query("SELECT * FROM payroll_period WHERE company_id = '{$this->company_id}'");
		$p_period = $query_payroll_period->row();
		$query_payroll_period->free_result();
		return $p_period;		
	}
	
	public function get_night_different(){
		$query_nightdiff = $this->db->query("SELECT * FROM nightshift_differential_settings WHERE company_id={$this->company_id}");
		$night_diff_row = $query_nightdiff->row();
		$query_nightdiff->free_result();
		return $night_diff_row;
	}
	
	public function nightdiff_approve($employee_timein,$employee_timeout){
		$nd_data = $this->get_night_different();
		if($nd_data) {
			$emp_timein = date("Y-m-d H:i:s",strtotime($employee_timein));
			$emp_timein_date = date("Y-m-d",strtotime($employee_timein));
			// logout on access
			$emp_timeout = date("Y-m-d H:i:s",strtotime($employee_timeout));
			$emp_timeout_date_out = date("Y-m-d",strtotime($employee_timeout));
			
			// Night different VALID DATETIME 
					
	#			$night_diff_start = date("Y-m-d H:i:s",strtotime($emp_timein_date." ".$nd_data->from_time." -1 day"));
	#		$night_diff_end = date("Y-m-d H:i:s",strtotime($emp_timeout_date_out." ".$nd_data->to_time));
			
			// if date in employee < date out employee 
			#$night_diff_start = date("Y-m-d H:i:s",strtotime($emp_timein_date." ".$nd_data->from_time));
			#$night_diff_end = date("Y-m-d H:i:s",strtotime($emp_timeout_date_out." ".$nd_data->to_time));
			
			// if date in employee == date out employee
				// if (time in employee <= 23:59 && time out employee >= time in night diff ) {
					#$night_diff_start = date("Y-m-d H:i:s",strtotime($emp_timein_date." ".$nd_data->from_time));
					#$night_diff_end = date("Y-m-d H:i:s",strtotime($emp_timeout_date_out." ".$nd_data->to_time.' +1 day'));
				// else { 
					#$night_diff_start = date("Y-m-d H:i:s",strtotime($emp_timein_date." ".$nd_data->from_time.' -1 day'));
					#$night_diff_end = date("Y-m-d H:i:s",strtotime($emp_timeout_date_out." ".$nd_data->to_time));
			if($emp_timein_date < $emp_timeout_date_out) {
				$night_diff_start = date("Y-m-d H:i:s",strtotime($emp_timein_date." ".$nd_data->from_time));
				$night_diff_end = date("Y-m-d H:i:s",strtotime($emp_timeout_date_out." ".$nd_data->to_time));
			}else if($emp_timein_date == $emp_timeout_date_out) {
				if($emp_timein <= date("H:i:s",strtotime("23:59:00")) && date("H:i:s",strtotime($emp_timeout) )>= $nd_data->from_time ){
					$night_diff_start = date("Y-m-d H:i:s",strtotime($emp_timein_date." ".$nd_data->from_time));
					$night_diff_end = date("Y-m-d H:i:s",strtotime($emp_timeout_date_out." ".$nd_data->to_time.' +1 day'));
				} else {
					$night_diff_start = date("Y-m-d H:i:s",strtotime($emp_timein_date." ".$nd_data->from_time.' -1 day'));
					$night_diff_end = date("Y-m-d H:i:s",strtotime($emp_timeout_date_out." ".$nd_data->to_time));
				}
			}
			if($emp_timein <= $night_diff_end && $emp_timeout >= $night_diff_start) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
}
/* End of file */