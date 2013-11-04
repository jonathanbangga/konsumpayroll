<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company principal model
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Company_principal_model extends CI_Model {
		
		public function __construct() {
			parent::__construct();
		}

		/**
		 * 
		 * add global for approvers
		 * @param string $table
		 * @param array $fields
		 * @
		 * @return integer
		 */
		public function save_fields($table,$fields){
			$this->db->insert($table,$fields);
			return $this->db->insert_id();
		}
		
		/** 
		 * Updates global fields
		 * @example $this->approvers->update_fields("employee",array("id"=>1,"status"=>"Active"),array("emp_id"=>3));
		 * @param string $table
		 * @param array $fields
		 * @param array $where_array
		 * @return boolean
		 */
		public function update_fields($table,$fields,$where_array){
			$this->db->where($where_array);
			$this->db->insert($table,$fields);
			return $this->db->affected_rows();
		}
		
		/**
		 * Get the comapny principals  
		 * @param int $company_id
		 */
		public function fetch_principals($company_id,$start=0,$limit=15){
			if(is_numeric($start)){
				$sql = "SELECT DISTINCT * FROM employee e
					LEFT JOIN company_principal cp on e.emp_id = cp.emp_id
					LEFT JOIN accounts a on a.account_id = e.account_id WHERE cp.company_id={$this->db->escape_str()}
					WHERE e.status = 'Active' and e.deleted = '0' and cp.status = 'Active' and cp.deleted = '0' 
					and a.status = 'Active' and a.deleted = '0'
					";
				$sql .=" LIMIT $start,$limit";
				$query = $this->db->query($sql);
				$result = $query->result();
				$query->free_result();
				return $result;
			}else{
				return false;
			}
		}
		
		
	}
/* End of file Company_principal_model */
/* Location: ./application/model/company/Company_principal_model.php */