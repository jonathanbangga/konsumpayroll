<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Inquiry model 
 *
 * @category Model
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Inquiry_model extends CI_Model {
		
		/**
		 * GET employee inquiries
		 * When searching to inquiries this set of functions will display specific name,id,or year
		 * @param int $company_id
		 * @param string $payroll_account_id
		 * @param string $employee_name
		 * @param int $year
		 * @return object
		 */
		public function get_employee_inquiries($company_id,$payroll_account_id=NULL,$employee_name=NULL,$year=NULL){
			$where = "";
			if($payroll_account_id !=""){
				$where .="AND a.payroll_cloud_id='{$this->db->escape_str($payroll_account_id)}' ";
			}else if($employee_name !=""){
				$where .="AND CONCAT(e.first_name,' ',e.last_name) like '%{$this->db->escape_str($employee_name)}%' ";
			}else if($year !=""){
				//$where .="AND ";
			}
			if(is_numeric($company_id)){
				$sql = "SELECT * FROM employee_leaves el
						LEFT JOIN leave_type lt on lt.leave_type_id = el.leave_type_id
						LEFT JOIN leaves l on l.company_id  = el.company_id
						LEFT JOIN employee e on e.emp_id = el.emp_id
						LEFT JOIN accounts a  on a.account_id = e.account_id 
						WHERE el.company_id = '{$this->db->escape_str($company_id)}'
						";	
				$query = $this->db->query($sql.$where);
				$result = $query->result();
				$query->free_result();
				return $result;
			}else{
				return false;
			}
		}
	}
	
/* End of file Inquiry_model.php */
/* Location: ./application/models/hr/Inquiry_model.php */