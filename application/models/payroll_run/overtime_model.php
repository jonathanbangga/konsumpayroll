<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Approve LEave model for approving overtime , leaves , loans
 *
 * @category Model
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Overtime_model extends CI_Model {
		
		/**
		 * CHECKS APPLICATION LEAVE FOR EVERY COMPANY
		 * @param int $company_id
		 * @return object
		 */
		public function overtime_list($company_id,$limit=10,$start=0){
			if(is_numeric($company_id)){
				$start = intval($start);
				$limit = intval($limit);
				$query = $this->db->query(
						"	SELECT *,concat(e.first_name,' ',e.last_name) as full_name FROM employee_overtime_application o
							LEFT JOIN employee e on e.emp_id = o.emp_id 
							LEFT JOIN accounts a on a.account_id = e.account_id  
							WHERE o.company_id = '{$this->db->escape_str($company_id)}' AND o.deleted = '0' AND o.overtime_status = 'approved' 
							LIMIT {$start},{$limit}
						"
				);
				$result = $query->result();
				$query->free_result();
				return $result;
			}else{
				return false;
			}
		}
		
		/**
		 * OVERTIME LIST VIA DDATE
		 * @param int $company_id
		 * @param int $limit
		 * @param int $start
		 * @param dates $date_from
		 * @param dates $date_to
		 * @return object
		 */
		public function overtime_list_by_date($company_id,$limit=10,$start=0,$date_from,$date_to){
			if(is_numeric($company_id)){
				$start = intval($start);
				$limit = intval($limit);
				$date_from = $this->db->escape($date_from);
				$date_to = $this->db->escape($date_to);
				$query = $this->db->query(
						"	SELECT *,concat(e.first_name,' ',e.last_name) as full_name FROM employee_overtime_application o
							LEFT JOIN employee e on e.emp_id = o.emp_id 
							LEFT JOIN accounts a on a.account_id = e.account_id 
							WHERE o.company_id = '{$this->db->escape_str($company_id)}' AND o.deleted = '0' AND o.overtime_status = 'approved' 
							AND o.overtime_from >= {$date_from}	AND o.overtime_to <={$date_to} 	
							LIMIT {$start},{$limit}
						"
				);
				$result = $query->result();
				$query->free_result();
				return $result;
			}else{
				return false;
			}
		}
		
		/**
		 * OVERTIME APPLICATION ACCOUNT COUNT DATES
		 * @param int $company_id
		 * @param dates $date_from
		 * @param dates $date_to
		 * @return integer
		 */
		public function overtime_application_count_date($company_id,$date_from,$date_to){
			if(is_numeric($company_id)){
				$date_from = $this->db->escape($date_from);
				$date_to = $this->db->escape($date_to);
				$query = $this->db->query("SELECT count(*) as val FROM employee_overtime_application WHERE overtime_status  = 'approved' 
						AND company_id = '{$this->db->escape_str($company_id)}' AND deleted='0' 
						AND overtime_from >= {$date_from}	AND overtime_to <={$date_to}
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
		 * Count Leaves application for pagination purposes only
		 * @param int $company_id
		 * @return integer
		 */
		public function overtime_application_count($company_id){
			if(is_numeric($company_id)){
				$query = $this->db->query("SELECT count(*) as val FROM employee_overtime_application WHERE overtime_status  = 'approved' 
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
		 * Update field
		 * @param string $database
		 * @param array $field
		 * @param array $where
		 * @return boolean
		 */
		public function update_field($database,$field,$where){
			$this->db->where($where);
			$this->db->update($database,$field);
			return $this->db->affected_rows();
		}
		
		/**
		 * REJECTS OVERTIME LOGS 
		 * rejects overtime logs
		 * @param int $overtime_id
		 * @param int $company_id
		 */
		public function ajax_overtime_logs_reject($overtime_id,$company_id) {
			if($this->session->userdata('user_type_id') == 2) { // IF OWNER 	
				$company_owner = $this->profile->get_account($this->session->userdata('account_id'),"company_owner");
				$fullname = $company_owner->first_name." ".$company_owner->last_name;
				if(is_numeric($overtime_id)){
					# CHECK THE LEAVE APPliCATION ID ONCE IT IS VAlID THEN WE TAKE OUT EMP_ID WHO FILED THIS 
					$leave_id = check_overtime_application($overtime_id); 
					# NOW Shreds the DATA and distributes its emp_id to the profile_getAccount
					$emp_who_filed = $this->profile->get_account($leave_id->emp_id,"employee_via_emp_id");
					# THEN instead of getting the fullname we just try to manually take out the fullname
					$emp_filed_fullname = $emp_who_filed->first_name." ".$emp_who_filed->last_name;
					# DECLARES OUR ACTIVITY language logs
					$lang_approve = sprintf(lang("reject_overtime_leave"),$fullname,$emp_filed_fullname,idates(idates_now())." on ".time_only(idates_now()));
					# ADD our activity
					add_activity($lang_approve,$company_id);
					
				}
			} else if($this->session->userdata('user_type_id') == 3){
				$company_owner = $this->profile->get_account($this->session->userdata('account_id'),"employee");
				$fullname = $company_owner->first_name." ".$company_owner->last_name;
				if(is_numeric($overtime_id)){
					# CHECK THE LEAVE APPliCATION ID ONCE IT IS VAlID THEN WE TAKE OUT EMP_ID WHO FILED THIS 
					$leave_id = check_leave_application($overtime_id); 
					# NOW Shreds the DATA and distributes its emp_id to the profile_getAccount
					$emp_who_filed = $this->profile->get_account($leave_id->emp_id,"employee_via_emp_id");
					# THEN instead of getting the fullname we just try to manually take out the fullname
					$emp_filed_fullname = $emp_who_filed->first_name." ".$emp_who_filed->last_name;
					# DECLARES OUR ACTIVITY language logs
					$lang_approve = sprintf(lang("reject_overtime_leave"),$fullname,$emp_filed_fullname,idates(idates_now())." on ".time_only(idates_now()));
					# ADD our activity
					add_activity($lang_approve,$company_id);
				}
			}
		}
		
		/**
		 * APPROVES OVERTIME LOGS
		 * THIS WILL APPROVE OVERTIME IN EVERY TRANSACTIONS MADE
		 * @param int $overtime_id
		 * @param int $company_id
		 */
		public function ajax_overtime_logs_approve($overtime_id,$company_id) {
			if($this->session->userdata('user_type_id') == 2) { // IF OWNER 	
				$company_owner = $this->profile->get_account($this->session->userdata('account_id'),"company_owner");
				$fullname = $company_owner->first_name." ".$company_owner->last_name;
				if(is_numeric($overtime_id)){
					# CHECK THE LEAVE APPliCATION ID ONCE IT IS VAlID THEN WE TAKE OUT EMP_ID WHO FILED THIS 
					$leave_id = check_overtime_application($overtime_id); 
					# NOW Shreds the DATA and distributes its emp_id to the profile_getAccount
					$emp_who_filed = $this->profile->get_account($leave_id->emp_id,"employee_via_emp_id");
					# THEN instead of getting the fullname we just try to manually take out the fullname
					$emp_filed_fullname = $emp_who_filed->first_name." ".$emp_who_filed->last_name;
					# DECLARES OUR ACTIVITY language logs
					$lang_approve = sprintf(lang("approve_ovetime_leave"),$fullname,$emp_filed_fullname,idates(idates_now())." on ".time_only(idates_now()));
					# ADD our activity
					add_activity($lang_approve,$company_id);
					
				}
			} else if($this->session->userdata('user_type_id') == 3){
				$company_owner = $this->profile->get_account($this->session->userdata('account_id'),"employee");
				$fullname = $company_owner->first_name." ".$company_owner->last_name;
				if(is_numeric($overtime_id)){
					# CHECK THE LEAVE APPliCATION ID ONCE IT IS VAlID THEN WE TAKE OUT EMP_ID WHO FILED THIS 
					$leave_id = check_leave_application($overtime_id); 
					# NOW Shreds the DATA and distributes its emp_id to the profile_getAccount
					$emp_who_filed = $this->profile->get_account($leave_id->emp_id,"employee_via_emp_id");
					# THEN instead of getting the fullname we just try to manually take out the fullname
					$emp_filed_fullname = $emp_who_filed->first_name." ".$emp_who_filed->last_name;
					# DECLARES OUR ACTIVITY language logs
					$lang_approve = sprintf(lang("approve_ovetime_leave"),$fullname,$emp_filed_fullname,idates(idates_now())." on ".time_only(idates_now()));
					# ADD our activity
					add_activity($lang_approve,$company_id);
				}
			}
		}
		
		/**
		*	CHECKS THE OVERTIME_TYPE
		*	@param int $company_id
		*	@return object
		*/
		public function overtime_type($company_id,$date){
			if(is_numeric($company_id)){
				$date = date("Y-m-d",strtotime($date));
				$query = $this->db->query("SELECT * FROM holiday h LEFT JOIN hours_type ht on ht.hour_type_id = h.hour_type_id WHERE ht.status = 'Active' AND h.status = 'Active' AND h.deleted = '0' AND h.company_id= '{$this->db->escape_str($company_id)}' AND date = '{$date}'");
				$row = $query->row();
				$query->free_result();
				return $row;
			}else{
				return false;
			}
		}
		
		/**
		*	WHEN OVERTIME TYPE CAN"T DETECT THE DATE THEN BY DEFAULT WE CHOOSE THIS FUNCTIONALITY
		*	@param int $company_id
		*	@return boolean
		*/
		public function overtime_default($company_id){
			if(is_numeric($company_id)){
				$query = $this->db->query("SELECT ot.pay_rate,ot.ot_rate,ot.company_id,ht.hour_type_id,ot.deleted='0',ht.hour_type_name FROM `hours_type` ht
														LEFT JOIN overtime_type ot  on ot.hour_type_id = ht.hour_type_id
														WHERE ot.deleted = '0' AND ot.status ='Active' AND ht.default='1' AND ht.status = 'Active' AND ht.company_id= '{$this->db->escape_str($company_id)}'");
				$row = $query->row();
				$query->free_result();
				return $row;
			}else{
				return false;
			}
		}
		
		/**
		*	DELETS OVERTIME 
		*	@param int $company_id
		*	@param int $overtime_id
		*	@return boolean
		*/
		public function overtime_delete($company_id,$overtime_id){
			if(is_numeric($company_id)){
				$where  = array(
						"overtime_id"=>$this->db->escape_str($overtime_id),
						"company_id"=>$this->db->escape_str($company_id)
				);
				$this->db->where($where);
				$this->db->delete("employee_overtime_application");
				return $this->db->affected_rows();
			}
		}

	}
/* End of file Approve_leave_model */
/* Location: ./application/models/hr/Approve_leave_model.php */;
	