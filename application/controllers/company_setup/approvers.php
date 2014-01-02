<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Approvers Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Approvers extends CI_Controller {
		
		/**
		 * Theme options - default theme
		 * @var string
		 */
		var $theme;
		var $menu;
		var $sidebar_menu;
		var $company_id;
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->theme = $this->config->item('default');		
			$this->menu = 'content_holders/company_menu';	
			$this->sidebar_menu = 'content_holders/company_sidebar_menu';
			$this->load->model("company/approvers_model","approvers");
			$this->company_id = $this->session->userdata("company_id");
			$this->authentication->check_if_logged_in();		
		}
		
		
		public function index(){
			$valid_domain = $this->company_id;
			if($this->company_id){
			$data['page_title'] = "Company Approvers";			
			$data['sidebar_menu'] = $this->sidebar_menu;
			$data['error']	= "";
			$data['category'] = array("regular","non-regular","household","probie");
			$data['approvers_list'] = $this->approvers->fetch_approvers_users($valid_domain);
			if($this->input->is_ajax_request()){
					if($this->input->post('approver_save')){
						$emp_idfield = $this->input->post('emp_id');
						$emp_first 	= $this->input->post("first_name");
						$emp_middle = $this->input->post("middle_name");
						$emp_last 	= $this->input->post("last_name");
						$emp_level	= $this->input->post('level');
						if($emp_idfield){
							foreach($emp_idfield as $k=>$v){
								$this->form_validation->set_rules("emp_id[".$k."]","Employee number (".$k."):","required|trim|xss_clean|min_length[8]|max_length[30]|is_unique[accounts.payroll_cloud_id]");
								$this->form_validation->set_rules("first_name[".$k."]","Employee First Name (".$k."):","required|trim|xss_clean");
								$this->form_validation->set_rules("middle_name[".$k."]","Employee Middle Name (".$k."):","required|trim|xss_clean");
								$this->form_validation->set_rules("last_name[".$k."]","Employee Last Name (".$k."):","required|trim|xss_clean");
								$this->form_validation->set_rules("level[".$k."]","Employee level (".$k."):","required|trim|xss_clean|numeric");
							}		
						}		
						if($this->form_validation->run() == TRUE){	
							foreach($emp_idfield as $key=>$val):
								$emp_id = $val;
								// CREATE ACCOUNTS
								$account_fields = array(
											"payroll_cloud_id" 	=> $this->db->escape_str($emp_id),
											"password"			=> md5(idates_now()),
											"account_type_id"	=> 2, // 2 which is users only
											"user_type_id"		=> 3, // 3 Defines as HR on user_type table
											"payroll_system_account_id" => $this->session->userdata("psa_id")
								);	
								$account_id = $this->approvers->save_fields("accounts",$account_fields);
								// CREATE EMPLOYEE
								$fields = array(
									"last_name" 	=> $this->db->escape_str($emp_last[$key]),
									"first_name" 	=> $this->db->escape_str($emp_first[$key]),
									"middle_name"	=> $this->db->escape_str($emp_middle[$key]),
									"account_id"	=> $this->db->escape_str($account_id),
									"company_id"	=> $valid_domain
								);
								$emp_id = $this->approvers->save_fields("employee",$fields);
								// CREATE COMPANY APPROVERS
								$approvers_fields = array(
									"company_id"	=> $valid_domain,
									"account_id"	=> $account_id,
									"level"			=> $this->db->escape_str($emp_level[$key]),
									"deleted"		=> '0'
								);
								$this->approvers->save_fields("company_approvers",$approvers_fields);	
							endforeach;
							echo json_encode(array("success"=>"1","error"=>''));
							return false;
						}else{
							$data['error'] = validation_errors("<span class='errors'>","</span>");
							echo json_encode(array("success"=>"0","error"=>$data['error']));
							return false;
						}
					}
			}
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/company_setup/company_approvers_view', $data);		
			}else{
				redirect("/company/company_setup/company_information/");
			}		
		}
		
		public function remove_company_approver(){
			if($this->input->is_ajax_request()){
				$this->form_validation->set_rules('account_id',"account","trim|required|xss_clean");
				if($this->form_validation->run() == false){	
					echo json_encode(array("success"=>"false","error"=>validation_errors("<span class='error_zone'>","</span>")));
					return false;
				}else{
					$account_id = base64_decode($this->input->post('account_id'));
					$this->approvers->remove_assign_company_head($account_id);					
					$check = $this->approvers->remove_approvers($account_id);
					echo json_encode(array("success"=>$check,"error"=>""));
				}
			}else{
				show_404();
			}	
		}

	
		public function fetch_approvers(){
			$this->form_validation->set_rules("company_id","Company ID","trim|required|xss_clean");
			$this->form_validation->set_rules("account_id","Account ID","trim|required|xss_clean");
			if($this->form_validation->run() == true){
				$company_id = $this->db->escape_str(base64_decode($this->input->post('company_id')));
				$account_id = $this->db->escape_str(base64_decode($this->input->post('account_id')));
				$row = $this->approvers->check_approvers_account($company_id,$account_id);
				if($row){
					echo json_encode(array("success"=>"1","error"=>"","approvers"=>$row));
					return false;
				}else{
					echo json_encode(array("success"=>"0","error"=>validation_errors("<span class='errors'>","</span>")));
					return false;
				}	
			}
		}
		
		public function edit_approvers(){
			$this->form_validation->set_rules("edit_company_id","Company ID","trim|required|xss_clean");
			$this->form_validation->set_rules("edit_account_id","Account ID","trim|required|xss_clean");
			$this->form_validation->set_rules("edit_fname","First Name","trim|required|xss_clean");
			$this->form_validation->set_rules("edit_lname","Last Name","trim|required|xss_clean");
			$this->form_validation->set_rules("edit_mname","Middle Name","trim|required|xss_clean");
			$this->form_validation->set_rules("edit_email","Email","callback_check_email_exist|required|trim|valid_email|xss_clean");
			$this->form_validation->set_rules("edit_mobile","Mobile","trim|xss_clean");
			$this->form_validation->set_rules("edit_level","Level","required|numeric|trim|xss_clean");
			$this->form_validation->set_rules("edit_mobile","Mobile","required|xss_clean");
			if($this->form_validation->run() == true){
				// EMPLOYEE
				$where_emp = array(
					"account_id"	=> $this->db->escape_str($this->input->post('edit_account_id')),
					"company_id"	=> $this->db->escape_str($this->input->post('edit_company_id'))
				);
				$emp_fields = array(
					"last_name" 	=> $this->db->escape_str($this->input->post('edit_lname')),
					"first_name" 	=> $this->db->escape_str($this->input->post('edit_fname')),
					"middle_name"	=> $this->db->escape_str($this->input->post('edit_mname')),
					"mobile_no"		=> $this->db->escape_str($this->input->post('edit_mobile'))
				);
				$this->approvers->update_fields("employee",$emp_fields,$where_emp);
				// ACCOUNT
				$where_account= array(
					"account_id"	=> $this->db->escape_str($this->input->post('edit_account_id')),
				);
				$account_fields = array(
					"email" 		=> $this->db->escape_str($this->input->post('edit_email'))
				);
				$this->approvers->update_fields("accounts",$account_fields,$where_account);	
				// CHECK IF SUBMISSION IS TRUE
				echo json_encode(array("success"=>"1","error"=>""));
				return false;
			}else{
				echo json_encode(array("success"=>"0","error"=>validation_errors("<span class='errors'>","</span>")));
				return false;
			}
		}
		
		/** CALLBACK LEVEL CHECK **/
		public function level_in_use($str){
			
		}
		
		/**
		 * When updating on the site this FUNCTIONS SETS user to check if the email
		 * @filesource Is still valid if not rejects the email
		 * @param string $str
		 * @return callback
		 */
		public function check_email_exist($str){
			$old_email = $this->db->escape_str($this->input->post('old_edit_email'));
			// CHECK IF he has AN EMAIL
			if($this->input->post('old_edit_email') !=""){
				$query = $this->db->query("SELECT * FROM accounts where email='{$this->db->escape_str($str)}' AND email NOT IN ('{$old_email}')");
				$result = $query->num_rows();
				$query->free_result();
				if($result){
					$this->form_validation->set_message("check_email_exist","Email address is already in used please try new ones");
					return false;
				}else{
					return true;
				}
			}else{
			// IF NOT EMAIL HAS BEEN SETUP
				$query = $this->db->query("SELECT * FROM accounts where email='{$this->db->escape_str($str)}'");
				$result = $query->num_rows();
				$query->free_result();
				if($result){
					$this->form_validation->set_message("check_email_exist","Email address is already in used please try new ones");
					return false;
				}else{
					return true;
				}
			}
		}
		/** callback section here **/
		
	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company/company_approvers.php */