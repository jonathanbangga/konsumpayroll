<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Model 
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Users_model extends CI_Model {
		
		/**
		 * PARENTS contstructor
		 */
		public function __construct() {
			parent::__construct();
			
		}

		/**
		 * GET government registrations
		 * checks government registrations
		 * @param int $company_id
		 * @return object
		 */
		public function get_government_registration($company_id) {
			$query = $this->db->get_where("government_registration",array("status"=>"Active","deleted"=>"0","company_id"=>$this->db->escape_str($company_id)));
			$row = $query->row();
			$query->free_result();
			return $row;
		}
		
		/**
		 * Check approvers users list
		 * @param int $comp_id
		 * @return object
		 */
		public function fetch_approvers_users($comp_id,$limit=10,$start=0){
			if(is_numeric($comp_id)){
				$sql = "SELECT DISTINCT * FROM company_approvers ca 
						LEFT JOIN employee e on e.account_id = ca.account_id
						LEFT JOIN accounts a on a.account_id = e.account_id
						WHERE ca.company_id = {$this->db->escape_str($comp_id)} and ca.deleted = '0' AND a.user_type_id = '3' 
						AND e.deleted = '0' AND a.deleted = '0' ORDER BY ca.level DESC ";
				if($limit){
					$sql .=" LIMIT {$start},{$limit}";
				}
				$q = $this->db->query($sql);		
				$result	 = $q->result();
				$q->free_result();
				return $result;
			}else{
				return false;
			}
		}
		
		/**
		 * CHECKS approvers 
		 * Checks users count
		 * @param int $comp_id
		 * @return object
		 */
		public function fetch_approvers_users_count($comp_id){
			if(is_numeric($comp_id)){
				$query = $this->db->query("SELECT DISTINCT count(*) as val FROM company_approvers ca 
							LEFT JOIN employee e on e.account_id = ca.account_id
							LEFT JOIN accounts a on a.account_id = e.account_id
							WHERE ca.company_id = {$this->db->escape_str($comp_id)} and ca.deleted = '0' 
							AND e.deleted = '0' AND a.deleted = '0'");
				$row = $query->row();
				$num_rows = $query->num_rows();
				$query->free_result();
				return ($num_rows) ? $row->val : 0;
			}else{
				return false;
			}		
		}
		
		/**
		 * Fetch approval groups
		 * @param int $comp_id
		 * @return json_encode
		 */
		public function fetch_approval_group($comp_id){
			$name = $this->input->post("name");
			$query = $this->db->query("SELECT * FROM approval_process WHERE company_id = '{$this->db->escape_str($comp_id)}'");
			$result = $query->result();
			$query->free_result();
			$data = array();
			$array = array();
			if($result){
				foreach($result as $key):
					$array[] = array("label"=>$key->name,"approval_process_id"=>$key->approval_process_id);			
				endforeach;
			}
			return json_encode($array); 
		}
		
		/**
		 * Save database
		 * @param string $database
		 * @param array $fields
		 * @return integer
		 */
		public function save_fields($database,$fields){
			$this->db->insert($database,$fields);
			return $this->db->insert_id();
		}
		
		/**
		 * Save database
		 * @param string $database
		 * @param array $fields
		 * @return integer
		 */
		public function update_fields($database,$fields,$where){
			$this->db->where($where);
			$this->db->update($database,$fields);
			return $this->db->affected_rows();
		}
		
		/**
		 * Approver groups
		 * @param int $approval_group_id
		 * @param int $company_id
		 * @param int $emp_id
		 * @return object
		 */
		public function approver_groups($company_id,$emp_id){
			$query = $this->db->query(
				"SELECT * FROM approval_groups ag 
				LEFT JOIN approval_process ap on ap.approval_process_id = ag.approval_process_id
				WHERE ag.emp_id = '{$this->db->escape_str($emp_id)}' AND ag.company_id = '{$this->db->escape_str($company_id)}'
				"
			);
			$row = $query->row();
			$query->free_result();
			return $row;
		}
		
		/**
		 * Process approval groups
		 * Enter description here ...
		 * @param int $comp_id
		 */
		public function approval_process($comp_id){
			$name = $this->input->post("name");
			$query = $this->db->query("SELECT * FROM approval_process WHERE company_id = '{$this->db->escape_str($comp_id)}'");
			$result = $query->result();
			$query->free_result();
			return $result;
		}
		
		/**
		 * Permission type 
		 * checks the permission all
		 * @param int $comp_id
		 * @return objec
		 */
		public function permission_type($comp_id){
			if(is_numeric($comp_id)){
				$query = $this->db->query("SELECT * FROM `user_roles` WHERE company_id = {$this->db->escape_str($comp_id)} AND deleted='0'");
				$result = $query->result();
				$query->free_result();
				return $result;
			}else{
				return false;
			}
		}
		
		/**
		 * CHECKS PERmission by each company id
		 * @param int $company_id
		 * @param int $account_id
		 * @return object
		 */
		public function permission_define($company_id,$account_id){
			if(is_numeric($company_id) && is_numeric($account_id)){
				$query = $this->db->query(
					"	SELECT ur.users_roles_id,ca.company_id,ur.roles FROM `user_roles` ur
						LEFT JOIN company_approvers ca on ca.users_roles_id = ur.users_roles_id
						WHERE ca.company_id = '{$this->db->escape_str($company_id)}' AND ca.account_id = '{$this->db->escape_str($account_id)}' 
						AND ur.deleted ='0' AND ca.deleted = '0'
					"
				);
				$row = $query->row();
				$query->free_result();
				return $row;
			}else{
				return false;
			}
		}
		
		/**
		 * Get employee info
		 * Enter description here ...
		 * @param int $account_id
		 * @return object
		 */
		public function employee_info($account_id){
			$query = $this->db->get_where("employee",array("account_id"=>$account_id));
			$row  = $query->row();
			$query->free_result();
			return $row;
		}
		
		/**
		*	DSPLAYS NORMAL EMPLOYEE NO  HR NO ACCOUNTANT
		*	@param int $company_id
		*	@return object
		*/
		public function normal_employee($company_id,$limit=10,$start=0){
			if(is_numeric($company_id)){
				$company_id = $this->db->escape_str($company_id);
				$sql = "SELECT * FROM accounts a LEFT JOIN employee e on e.account_id = a.account_id WHERE a.user_type_id = '5' AND e.company_id = '".$company_id."' AND a.deleted= '0' AND e.deleted = '0' ";
				if($limit){ $sql .=" LIMIT {$start},{$limit}"; }
				$query = $this->db->query($sql);			
				$result = $query->result();
				$query->free_result();
				return $result;
			}else{
				return false;
			}
		}
		
		/**
		*	THIS WILL COUNT THE NORMAL EMPLOYEE
		*	@param int $company_id
		*	@return integer
		*/
		public function count_normal_employee($comp_id){
			if(is_numeric($comp_id)){
				$query = $this->db->query("SELECT count(*) as val FROM accounts a LEFT JOIN employee e on e.account_id = a.account_id WHERE a.user_type_id = '5' AND e.company_id = '".$comp_id."' AND a.deleted= '0' AND e.deleted = '0'");
				$row = $query->row();
				$num_rows = $query->num_rows();
				$query->free_result();
				return ($num_rows) ? $row->val : 0;
			}else{
				return false;
			}		
		}
		
		
		/**
		*	CHECK IF EMAIL IS EXISTING OR N O T
		*	@param email
		* 	@return boolean
		*/
		public function existing_email($email){
			if($email !=""){
				$query = $this->db->query("SELECT * FROM accounts WHERE email='{$this->db->escape_str($email)}'");
				$row = $query->num_rows();
				$query->free_result();
				return $row;
			}else{
				return false;
			}
		}
		
				/**
		*	CHECK IF EMAIL IS EXISTING OR N O T
		*	@param email
		* 	@return boolean
		*/
		public function existing_account($payroll_cloud_id){
			if($payroll_cloud_id){
				$query = $this->db->query("SELECT * FROM accounts WHERE payroll_cloud_id='{$this->db->escape_str($payroll_cloud_id)}'");
				$row = $query->num_rows();
				$query->free_result();
				return $row;
			}else{
				return false;
			}
		}
			
		/**
		*	SEND INVITATIONS DATAS
		*	@param int $company_id
		*	@param int $account_id
		*	@return object
		*/
		public function send_invitation($company_id,$account_id){
			if(is_numeric($company_id) && is_numeric($account_id)){
				$company_id = $this->db->escape_str($company_id);
				$account_id = $this->db->escape_str($account_id);
				$query = $this->db->query("SELECT * FROM employee e LEFT JOIN accounts a on a.account_id = e.account_id WHERE e.company_id ='{$company_id}' AND a.account_id = '{$account_id}'");
				$row = $query->row();
				$query->free_result();
				return $row;
			}else{
				return false;
			}
		}
		
		/**
		*	CHECK ALL USER ROLES LISTIING 
		*	@param int $company_id
		*	@param string $users_account_type
		*	@return object
		*/
		public function user_roles_list($company_id,$users_account_type,$limit=10,$start=0){
			if(is_numeric($company_id)){
				#users_account_type when selecting this users_account_type (1 - admin , 2 - employee )
				switch($users_account_type): 
					case "administrator": // administrator
						$sql = "SELECT * FROM `user_roles` WHERE company_id = '{$this->db->escape_str($company_id)}' and users_account_type = '1' and deleted= '0' ";
						if($limit){
							$sql .=" LIMIT {$start},{$limit}";
						}
						$query = $this->db->query($sql);
						$result = $query->result();
						$query->free_result();
						return $result;
					break;
					case "employee": // employee
						$query = $this->db->query("SELECT * FROM `user_roles` WHERE company_id = '{$this->db->escape_str($company_id)}' and users_account_type = '2 and deleted= '0'");
						$result = $query->result();
						$query->free_result();
						return $result;
					break;
					default: 
						return false;
					break;
				endswitch;
			}else{
				return false;
			}
		}
		
		public function count_user_roles_list($company_id,$users_account_type){
			if(is_numeric($company_id)){
				#users_account_type when selecting this users_account_type (1 - admin , 2 - employee )
				switch($users_account_type): 
					case "administrator": // administrator
						$sql = "SELECT count(*) as val FROM `user_roles` WHERE company_id = '{$this->db->escape_str($company_id)}' and users_account_type = '1' and deleted= '0' ";
						$query = $this->db->query($sql);
						$num_rows = $query->num_rows();
						$row = $query->row();
						$query->free_result();
						return ($num_rows) ? $row->val: 0;
					break;
					case "employee": // employee
						$query = $this->db->query("SELECT count(*) as val FROM `user_roles` WHERE company_id = '{$this->db->escape_str($company_id)}' and users_account_type = '2 and deleted= '0'");
						$num_rows = $query->num_rows();
						$row = $query->row();
						$query->free_result();
						return ($num_rows) ? $row->val: 0;
					break;
					default: 
						return false;
					break;
				endswitch;
			}else{
				return false;
			}
		}
		
		
		
		
		
	}

/* End of file Company_model.php */
/* Location: ./application/controllers/hr/Company_model.php */