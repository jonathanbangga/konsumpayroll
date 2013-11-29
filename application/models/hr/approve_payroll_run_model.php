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
				$query2 = $this->db->query(
						"	SELECT *,concat(e.first_name,' ',e.last_name) as full_name FROM payroll_run pr
							LEFT JOIN employee e on e.emp_id = pr.emp_id 
							LEFT JOIN accounts a on a.account_id = e.account_id 
							WHERE pr.company_id = '{$this->db->escape_str($company_id)}' AND pr.deleted = '0'
						"
				);
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
		
	}
	
/* End of file Approve_leave_model */
/* Location: ./application/models/hr/Approve_leave_model.php */;
	