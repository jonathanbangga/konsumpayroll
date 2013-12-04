<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Approve LEave model for approving overtime , leaves , loans
 *
 * @category Model
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Approve_payroll_run_model extends CI_Model {
		
		/**
		 * CHECKS APPLICATION LEAVE FOR EVERY COMPANY
		 * @param int $company_id
		 * @return object
		 */
		public function payroll_run_list($company_id,$limit=10,$start=0){
			if(is_numeric($company_id)){
				$this->db->select("*");
				$this->db->from("payroll_run pr");
				$this->db->join("employee e","e.emp_id = pr.emp_id","left");
				$this->db->join("accounts a","a.account_id = e.account_id","left");
				$this->db->where(array("pr.company_id"=>$this->db->escape_str($company_id),"pr.deleted"=>'0','pr.payroll_run_status'=>'pending'));
				$this->db->limit($limit,$start);
				$query = $this->db->get();
				$result = $query->result();
				$query->free_result();
				$data = array();
				if($result){
					foreach($result as $key){
						$data[] = $key;
					}
					return $data;
				}else{
					return false;
				}
				
			}else{
				return false;
			}
		}
		
		/**
		 * Payroll run list via NAMES employee
		 * CHECK payrollrun via employee fullname
		 * @param int $company_id
		 * @param int $limit
		 * @param int $start
		 * @param string $employee_name
		 * @return object
		 */
		public function payroll_run_list_by_names($company_id,$limit=10,$start=0,$employee_name){
			if(is_numeric($company_id)){
				$employee_name = $this->db->escape_like_str($employee_name);
				$this->db->select("*");
				$this->db->from("payroll_run pr");
				$this->db->join("employee e","e.emp_id = pr.emp_id","left");
				$this->db->join("accounts a","a.account_id = e.account_id","left");
				$this->db->where(array("pr.company_id"=>$this->db->escape_str($company_id),"pr.deleted"=>'0','pr.payroll_run_status'=>'pending'));
				$this->db->like('concat(e.first_name," ",e.last_name)',$employee_name,'both');
				$this->db->limit($limit,$start);
				$query = $this->db->get();
				$result = $query->result();
				$query->free_result();
				$data = array();
				if($result){
					foreach($result as $key){
						$data[] = $key;
					}
					return $data;
				}else{
					return false;
				}
				
			}else{
				return false;
			}
		}
		
		/**
		 * PAYROL RUN LIST BY DATE
		 * ENABLES PAYROLL DDATE
		 * @param int $company_id
		 * @param int $limit
		 * @param int $start
		 * @param dates $date_from
		 * @param dates $date_to
		 * @return object
		 */
		public function payroll_run_list_by_date($company_id,$limit=10,$start=0,$date_from,$date_to){
			if(is_numeric($company_id)){
				$date_from =  $this->db->escape_str($date_from);
				$date_to =  $this->db->escape_str($date_to);
				$this->db->select("*");
				$this->db->from("payroll_run pr");
				$this->db->join("employee e","e.emp_id = pr.emp_id","left");
				$this->db->join("accounts a","a.account_id = e.account_id","left");
				$this->db->where(
								array("pr.company_id"=>$this->db->escape_str($company_id),
								"pr.deleted"=>'0',
								'pr.payroll_run_status'=>'pending',
								'CAST(pr.period_from as DATE) >='=>$date_from,
								'CAST(pr.period_from as DATE) <='=>$date_to
								));
				$this->db->or_where(
								array(
									"CAST(pr.period_from as DATE)>="=>$date_from,
									"CAST(pr.period_to as DATE)<="=>$date_to
								)
				);
				$this->db->limit($limit,$start);
				$query = $this->db->get();
				$result = $query->result();
				$query->free_result();
				$data = array();
				if($result){
					foreach($result as $key){
						$data[] = $key;
					}
					return $data;
				}else{
					return false;
				}
				
			}else{
				return false;
			}
		}
		
		/**
		 * Count payroll run
		 * @param int $company_id
		 * @return integer
		 */
		public function payroll_run_count($company_id){
			if(is_numeric($company_id)){
				$query = $this->db->query("SELECT count(*) as val FROM payroll_run WHERE payroll_run_status = 'pending' 
						AND company_id = '{$this->db->escape_str($company_id)}' AND deleted='0'
				");
				$row = $query->row();
				$num_row = $query->num_rows();
				$query->free_result();
				return $num_row ? $row->val : 0;
			}else{
				return false;
			}
		}
		
		/**
		 * PAYROLL RUN FETCH VIA NAME COUNT PAGINATION PURPOSES
		 * Count payroll run by name
		 * @param int $company_id
		 * @param string $employee_name
		 * @return int
		 */
		public function payroll_run_count_name($company_id,$employee_name){
			if(is_numeric($company_id)){
				$employee_name = $this->db->escape_like_str($employee_name);
				$query = $this->db->query("SELECT count(*) as val FROM payroll_run p
						LEFT JOIN employee e on e.emp_id = p.emp_id 
						WHERE p.payroll_run_status = 'pending' 
						AND p.company_id = '{$this->db->escape_str($company_id)}' AND p.deleted='0' 
						AND concat(e.first_name,' ',e.last_name) like '%{$employee_name}%'
				");
				$row = $query->row();
				$num_row = $query->num_rows();
				$query->free_result();
				return $num_row ? $row->val : 0;
			}else{
				return false;
			}
		}
		
		/**
		 * Counts payroll run by dates
		 * count payroll run by dates
		 * @param int $company_id
		 * @param dates $date_from
		 * @param dates $date_to
		 * @return object
		 */
		public function payroll_run_count_dates($company_id,$date_from,$date_to){
			if(is_numeric($company_id)){
				$date_from =  $this->db->escape_str($date_from);
				$date_to =  $this->db->escape_str($date_to);
				$query = $this->db->query("SELECT count(*) as val FROM payroll_run WHERE payroll_run_status = 'pending' 
						AND company_id = '{$this->db->escape_str($company_id)}' AND deleted='0' 
						AND CAST(period_from as DATE)>=$date_from
						AND CAST(period_from as DATE)<=$date_to
						OR CAST(period_from as DATE)>=$date_from
						AND CAST(period_to as DATE)<=$date_to
				");
				$row = $query->row();
				$num_row = $query->num_rows();
				$query->free_result();
				return $num_row ? $row->val : 0;
			}else{
				return false;
			}
		}
		
		/**
		 * Update global fields
		 * use for all
		 * @param string $database
		 * @param array $fields
		 * @param array $where
		 */
		public function update_field($database,$fields,$where){
			$this->db->where($where);
			$this->db->update($database,$fields);
			return $this->db->affected_rows();
		}
		
	}
	
/* End of file Approve_leave_model */
/* Location: ./application/models/hr/Approve_leave_model.php */;
	