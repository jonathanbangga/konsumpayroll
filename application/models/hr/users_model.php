<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Model 
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Users_model extends CI_Model {
		
		public function __construct() {
			parent::__construct();
		}

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
						WHERE ca.company_id = {$this->db->escape_str($comp_id)} and ca.deleted = '0' 
						AND e.deleted = '0' AND a.deleted = '0' ORDER BY ca.level DESC
						";
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
	}

/* End of file Company_model.php */
/* Location: ./application/controllers/hr/Company_model.php */