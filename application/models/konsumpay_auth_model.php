<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Konsumpayroll Authentication Library
 *
 * @package Authentication
 * @subpackage models
 * @category Authentication
 * @author Jonthan Bangga <jonathanbangga@gmail.com>
 */

	class Konsumpay_auth_model extends CI_Model {
	
		/**
		 * Constructor
		 */
		public function __construct() 
		{
			parent::__construct();
			$this->_admin_tbl = $this->config->item('admin_tbl');
			$this->_owner_tbl = $this->config->item('owner_tbl');
		}
		
		/**
		 * Verify Admin
		 */
		public function verify_admin($username, $password)
		{
			if (!is_string($username) || !is_string($password)) {
				show_error('Parameters type invalid!',500);
			}	
					
			$where = array(
				'username' => $username,
				'status' => 'Active',
				'password' => $password);
					
			$this->db->select('konsum_admin_id');
			$this->db->where($where);
			$query = $this->db->get($this->_admin_tbl);
			
			if ($query->num_rows() > 0) {
	            $row = $query->row();
				$auth['group'] = 1; // konsum auth config for admin
				$auth['account_id'] = $row->konsum_admin_id;
				$query->free_result();
	            return $auth;
	        } else {
	            return FALSE;
	        }
		}
		
		/**
		 * Verify HR
		 */
		public function verify_owner($username, $password)
		{
			if (!is_string($username) || !is_string($password)) {
				show_error('Parameters type invalid!',500);
			}	
					
			$where = array(
				'email_address' => $username,
				'status' => 'Active',
				'password' => $password);
					
			$this->db->select('company_owner_id');
			$this->db->where($where);
			$query = $this->db->get($this->_owner_tbl);
			
			if ($query->num_rows() > 0) {
	            $row = $query->row();
				$auth['group'] = 3; // konsum auth config for owner
				$auth['account_id'] = $row->company_owner_id;
				$query->free_result();
	            return $auth;
	        } else {
	            return FALSE;
	        }
		}
		
		/**
		 * Verify Company Name
		 */
		public function verify_comp_name($comp_name){
			$sql = $this->db->query("
				SELECT *FROM company
				WHERE registered_business_name = '{$comp_name}'
				AND company_owner_id = '{$this->session->userdata('account_id')}'
				AND status = 'active'
			");
			
			if($sql->num_rows() == 1){
				return TRUE;
			}else{
				return FALSE;
			}
		}
	
	}

/* End of file konsumpay_auth_model.php */
/* Location: ./application/models/konsumpay_auth_model.php */