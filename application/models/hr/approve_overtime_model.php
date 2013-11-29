<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Approve LEave model for approving overtime , leaves , loans
 *
 * @category Model
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Approve_overtime_model extends CI_Model {
		
		/**
		 * CHECKS APPLICATION LEAVE FOR EVERY COMPANY
		 * @param int $company_id
		 * @return object
		 */
		public function overtime_list($company_id){
			if(is_numeric($company_id)){
				$query = $this->db->query(
						"	SELECT *,concat(e.first_name,' ',e.last_name) as full_name FROM overtime o
							LEFT JOIN employee e on e.emp_id = o.emp_id 
							LEFT JOIN accounts a on a.account_id = e.account_id 
							WHERE o.company_id = '{$this->db->escape_str($company_id)}' AND o.deleted = '0'
						"
				);
				$result = $query->result();
				$query->free_result();
				return $result;
			}else{
				return false;
			}
		}
		
	}
	
/* End of file Approve_leave_model */
/* Location: ./application/models/hr/Approve_leave_model.php */;
	