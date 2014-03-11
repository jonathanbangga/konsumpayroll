<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * HOURSWORKED  model for approving overtime , leaves , loans
 *
 * @category Model
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Hoursworked_model extends CI_Model {
	
		public function __construct(){
			parent::__construct();
		}
		
		/**
		 * CHECKS APPLICATION LEAVE FOR EVERY COMPANY
		 * @param int $company_id
		 * @return object
		 */
		public function hoursworked_list($company_id,$limit=10,$start=0){
			if(is_numeric($company_id)){
				$start = intval($start);
				$limit = intval($limit);
				$query2 = $this->db->query("SELECT distinct(e.emp_id),sum(eti.total_hours) as res,concat(e.first_name,' ',e.last_name) as full_name,a.payroll_cloud_id FROM employee  e
													LEFT JOIN `employee_time_in` eti on e.emp_id = eti.emp_id 
													LEFT JOIN accounts a on e.account_id= e.account_id 
													WHERE eti.comp_id = '{$this->db->escape_str($company_id)}' 
													AND e.deleted = '0' AND e.status = 'Active' AND a.deleted=  '0'  
													AND eti.deleted = '0' 
													group by e.emp_id LIMIT {$start},{$limit}"
				);			
				
				// PAYROLL PERIOD
				$payroll_period = $this->get_payrollperiod($company_id);
				
				
				if($payroll_period) {
					$time_in = $payroll_period->period_from;
					$time_out = $payroll_period->period_to;	
					$query = $this->db->query("SELECT e.last_name,e.first_name,e.last_name,e.emp_id,a.payroll_cloud_id,sum(eti.tardiness_min) as tardiness,sum(eti.undertime_min) as undertime FROM employee  e
														LEFT JOIN `employee_time_in` eti on e.emp_id = eti.emp_id 
														LEFT JOIN accounts a on e.account_id= a.account_id 
														WHERE eti.comp_id = '{$this->db->escape_str($company_id)}' 
														AND e.deleted = '0' AND e.status = 'Active' AND a.deleted=  '0'  AND a.user_type_id = '5' 
														AND eti.status = 'Active' 
														AND eti.time_in BETWEEN '{$time_in}' AND '{$time_out}' 
														AND eti.deleted = '0' AND eti.time_in_status = '' OR eti.time_in_status ='approved' group by eti.emp_id LIMIT {$start},{$limit}");
					$result = $query->result();
					$query->free_result();
					return $result;
				} else {
					return false;
				}
			}else{
				return false;
			}
		}
		
		/**
		*	COUNT HOURSWORKED FOR PAGINATION PURPOSES
		*	@param int $company_id
		*	@return int $val
		*/
		public function count_hoursworked_list($company_id) {
			if(is_numeric($company_id)) {
				$query = $this->db->query("SELECT count(*) as val from employee e LEFT JOIN `employee_time_in` eti on e.emp_id = eti.emp_id WHERE eti.comp_id = '{$this->db->escape_str($company_id)}' AND e.deleted = '0' AND e.status = 'Active' AND eti.deleted = '0'");
				$row = $query->row();
				$query->free_result();
				return $row;
			} else {
				return false;
			}
		}
		
		public function get_regular_holiday($company_id,$emp_id,$regular="yes") {
			if(is_numeric($company_id)) {
				$query = $this->db->query("SELECT * FROM `hours_type` where company_id ='{$this->db->escape_str($company_id)}'");
				$regular = $query->row();
				$query->free_result();
				if($regular){
					$query_timein = $this->db->query("SELECT sum(total_hours) as sum FROM  `employee_time_in` where comp_id= '{$company_id}' and emp_id = ".$emp_id);
					$result = $query_timein->row();
					$query_timein->free_result();
					return $result;
				}else{
					return 0;
				}
			} else {
				return false;
			}
		}
		
		/**
		*	FETCH LIST TABLE
		*	@param string $table
		*	@param array $where_array
		*	@return object
		*/
		public function fetch_list($table,$where_array){
			$where = array($where_array);
			$query = $this->db->get_where($table,$where);
			$result = $query->result();
			$query->free_result();
			return $result;
		}
		
		/*
		*   ROW LIST TABLE
		*	@param string $table
		*	@param array $where_array
		*	@return object
		*/
		public function row_list($table,$where_array) {
			if(!$table) {
				return FALSE;
			} else {
				$where	= array($where_array);
				$query	= $this->db->qet_where($table,$where);
				$result	= $query->result();
				$query->free_result();
				return $result;
			}
		}
		
		/**
		*	GET hours type for the company 
		*	@param int $company_id
		*/
		public function get_hourstype($company_id){
			if(is_numeric($company_id)) {
				$query = $this->db->query("SELECT * FROM `hours_type` where status ='active' and company_id = '{$this->db->escape_str($company_id)}'");
				$result = $query->result();
				$query->free_result();
				return $result;
			} else {
				return false;
			}
		}
		
		public function get_payrollperiod($company_id){
			if(is_numeric($company_id)){
				$query = $this->db->query("SELECT * FROM payroll_period where company_id = ".$this->db->escape_str($company_id));
				$row = $query->row();
				$query->free_result();
				return $row;
			}
		}
		
		
		//GET THE DAYS WITH Holidays SPECFIED WITHIN TH EPAYROLL PERIOD
		public function get_holiday_dates($company_id,$hour_type_id){
			if(is_numeric($company_id) && $hour_type_id) {
				$get_holiday = $this->db->get_where("holiday",array("company_id"=>$company_id,"status"=>"Active","hour_type_id"=>$hour_type_id));
				
				$holiday_result = $get_holiday->result();
				$get_holiday->free_result();
				$date = array();
					foreach($holiday_result as $holiday_date) {
						$date[] = "'".$holiday_date->date."'";
					}
				return implode(",",$date);
			}else{
				returnfalse;
			}
		}
		
		/**
		*	get employee time in Absences/Tardiness/Undertime in short abtarun
		*	@param int company_id
		*	@param int emp_id
		*	@return object
		*/
		public function get_employee_time_in_abtarun($company_id) {
			if(is_numeric($company_id)) {
				$sql = "
						SELECT * from 
				";
				$query = $this->db->query($sql);
				$result = $query->row();
				$query->free_result();
				return $result;
			} else {
				return false;
			}
		}
		
		/**
		*	CHECK GET PAID LEAVE
		*	@param int $emp_id
		*	@param int $company_id
		*	@param dates $date_start
		*	@param dates $date_end
		*	@return object
		*/
		public function get_paid_leave($emp_id,$company_id,$date_start=NULL,$date_end=NULL) {
			if(is_numeric($company_id) && is_numeric($emp_id) && $emp_id !="") {
				$sql = "
						SELECT sum(ela.total_leave_requested) as total_leave_requested  FROM `employee_leaves_application` ela 
						LEFT JOIN leave_type lt on lt.leave_type_id = ela.leave_type_id
						where ela.emp_id = {$this->db->escape_str($emp_id)} and ela.company_id ={$this->db->escape_str($company_id)} 
						AND lt.payable = '1' AND ela.leave_application_status = 'approve'  
						AND CAST(ela.date_start as date) >= '$date_start' && CAST(ela.date_start as date) <= '$date_end'
				";
				$query = $this->db->query($sql);
				$result = $query->row();
				$query->free_result();
				return $result;
			} else {
				return false;
			}
		}
		
	}
/* End of file Approve_leave_model */
/* Location: ./application/models/hr/Approve_leave_model.php */;
	