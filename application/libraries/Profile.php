<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Profile Libraries checks account details
 * 
 * @category libraries
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Profile{
		/**
		 * Ci extends functionalities on libraries
		 * @var object
		 */
		protected $ci;
		
		public function __construct(){
			$this->ci =& get_instance();
			$this->ci->load->model('profile_model','profile');
		}
		
		/**
		 * CHECK ACCOUNTS CREDENTAILS
		 */
		public function accounts(){
			if($this->ci->session->userdata("account_id")){
				$query = $this->ci->db->query(
					"SELECT a.account_id,e.first_name,e.last_name,a.email,concat(e.first_name,' ',e.last_name) as full_name FROM accounts a
					LEFT JOIN employee e on e.account_id = a.account_id
					WHERE a.account_id = {$this->ci->session->userdata("account_id")}
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
		 * GET ADMINS ACCOUNT DETAILS
		 * get admin account return value
		 */
		public function account_admin(){
			$query = $this->ci->db->get_where("konsum_admin",array("account_id"=>$this->ci->session->userdata("account_id")));
			$row = $query->row();
			$query->free_result();
			return $row;
		}
		
		
		
	}