<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Principal Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Principal extends CI_Controller {
		
		/**
		 * Theme options - default theme
		 * @var string
		 */
		var $theme;
		var $menu;
		var $sidebar_menu;
		
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->theme = $this->config->item('default');		
			$this->menu = 'content_holders/company_menu';	
			$this->sidebar_menu = 'content_holders/company_sidebar_menu';
			$this->load->model("company/company_principal_model","principal");
		}
		
		
		public function edit(){
			$valid_domain = $this->uri->segment(4);
			if(mod_is_mycompany(0,$valid_domain) == false){
				redirect("company/dashboard");
				return false;
			}		
			$data['company_principal'] = $this->principal->fetch_principals($valid_domain);
			$data['error'] = "";
			if($this->input->is_ajax_request()){
				if($this->input->post('submit')) {
					$this->form_validation->set_rules("lname","Last name","required|trim|xss_clean");
					$this->form_validation->set_rules("fname","First name","required|trim|xss_clean");
					$this->form_validation->set_rules("mname","Middle name","required|trim|xss_clean");
					$this->form_validation->set_rules("position","Position","trim|xss_clean");
					$this->form_validation->set_rules("contact_no","Business phone","trim|xss_clean");
					$this->form_validation->set_rules("email","Email","required|valid_email|trim|is_unique[accounts.email]|xss_clean");
					$this->form_validation->set_rules("payroll_cloud_id","payroll_cloud_id","min_length[8]|max_length[36]required|trim|is_unique[accounts.payroll_cloud_id]|xss_clean");
					if($this->form_validation->run() == false) {
						 $data['error'] = validation_errors("<span class='error_zone'>",'</span>');
						 echo json_encode(array("success"=>"0","error"=>$data['error']));
						 return false;
					} else {	
						$account_fields = array(
										"payroll_cloud_id" 	=> $this->db->escape_str($this->input->post('payroll_cloud_id')),
										"password"			=> md5(idates_now()),
										"email"				=> $this->db->escape_str($this->input->post('email')),
										"account_type_id" 	=> 3
									);	
						$account_id = $this->principal->save_fields("accounts",$account_fields);
						
						$fields = array(
									"last_name" 	=> $this->db->escape_str($this->input->post('lname')),
									"first_name" 	=> $this->db->escape_str($this->input->post('fname')),
									"middle_name"	=> $this->db->escape_str($this->input->post('mname')),
									"account_id"	=> $this->db->escape_str($account_id),
									"contact_no"	=> $this->db->escape_str($this->input->post('contact_no')),
									"company_id"	=> $valid_domain
									);
						$emp_id = $this->principal->save_fields("employee",$fields);
						if($emp_id){
								$principal_field = array(
										"emp_id" 	=> $this->db->escape_str($emp_id),
										"company_id"=> $this->db->escape_str($valid_domain),
										"status"	=> "Active",
										"deleted" 	=> "0"
								);	
								$this->principal->save_fields("company_principal",$principal_field);
								echo json_encode(array("success"=>"1","error"=>""));
								return false;
						}	
					}
				}	
			}
			$data['sidebar_menu'] = $this->sidebar_menu;
			$data['page_title'] = "Company Principal";		
			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/company/company_principal_view', $data);				
		}
		
		public function principal_id(){
			if($this->input->is_ajax_request()){
			$company_id = $this->input->post("company_id");
			$emp_id = $this->input->post("emp_id");
			if($this->input->post("edit")){		
				$this->form_validation->set_rules("company_id","company id","xss_clean|trim|required");
				$this->form_validation->set_rules("emp_id","company id","xss_clean|trim|required");
				if($this->form_validation->run() == false){				
					echo json_encode(array("success"=>"0","errors"=>validation_errors("<span class='error_zone'>",'</span>',"")));
					return false;
				}else{
					$fields = $this->principal->get_principal_emp($company_id,$emp_id);	
					echo json_encode($fields);
					return true;
				}
			}
			}else{
				show_404();
			}
		}
		
		public function update_company_principal(){
			if($this->input->is_ajax_request()){
				if($this->input->post('update')) {
					$this->form_validation->set_rules("principal_id","Principal","required|trim|xss_clean");
					$this->form_validation->set_rules("lname","Last name","required|trim|xss_clean");
					$this->form_validation->set_rules("fname","First name","required|trim|xss_clean");
					$this->form_validation->set_rules("mname","Middle name","required|trim|xss_clean");
					$this->form_validation->set_rules("position","Position","trim|xss_clean");
					$this->form_validation->set_rules("contact_no","Business phone","trim|xss_clean");
					$this->form_validation->set_rules("old_email","Email","required|valid_email|trim|xss_clean");
					$this->form_validation->set_rules("email","Email","required|valid_email|trim|xss_clean|callback_check_email");
					$this->form_validation->set_rules("company_id","company_id","required|xss_clean");
					$this->form_validation->set_rules("emp_id","Employee id","required|xss_clean");
					$this->form_validation->set_rules("payroll_cloud_id","Payroll Cloud Id","min_length[8]|max_length[36]required|trim|xss_clean|callback_check_payroll_cloud_id");
					$this->form_validation->set_rules("old_payroll_cloud_id","Payroll Cloud Id","min_length[8]|max_length[36]required|trim|xss_clean");	
					if($this->form_validation->run() == false){
						echo json_encode(array("success"=>"0","error"=>validation_errors("<span class='error_zone'>","</span>")));
						return false;
					} else { 
						$emp_id = $this->db->escape_str($this->input->post('emp_id'));
						$emp_where = array("emp_id" =>$emp_id);
						$fields = array(
									"last_name" 	=> $this->db->escape_str($this->input->post('lname')),
									"first_name" 	=> $this->db->escape_str($this->input->post('fname')),
									"middle_name"	=> $this->db->escape_str($this->input->post('mname')),
									"contact_no"	=> $this->db->escape_str($this->input->post('contact_no'))
									);
						$this->principal->update_fields("employee",$fields,$emp_where);
						$employee = $this->principal->get_employee($emp_id);
						if($employee){
							$account_where = array("account_id"=>$employee->account_id);
							$account_fields = array(
										"payroll_cloud_id" 	=> $this->db->escape_str($this->input->post('payroll_cloud_id')),
										"email"				=> $this->db->escape_str($this->input->post('email'))
									);	
							$this->principal->update_fields("accounts",$account_fields,$account_where);
							echo json_encode(array("success"=>"1","error"=>""));
							return true;
						}	
					}
				}
			}	
		}
		
		public function people_company_principal(){
			if($this->input->post("delete")){
				$this->form_validation->set_rules("company_principal_id","Company Principal ID","required|xss_clean");
				if($this->form_validation->run() == false){
					echo json_encode(array("success"=>"0","error"=>validation_errors("<span class='error_zone'>","</span>")));
					return false;
				}else{
					$fields = array("deleted"=>"1","status"=>"Inactive");
					$where = array("company_principal_id"=>$this->db->escape_str($this->input->post("company_principal_id")));
					$update_id = $this->principal->update_fields("company_principal",$fields,$where);
					echo json_encode(array("success"=>"1","error"=>"","we"=>$this->db->last_query()));
					return false;
				
				}
			}
		}
		
		/**
		 * Callbacks checking email on updates
		 * @param string $str
		 * @return error
		 */
		public function check_email($str){
			$check = $this->principal->check_email_exist($this->input->post('old_email'),$str);
			if($check == false){
				return TRUE;
			} else {
				$this->form_validation->set_message('check_email', 'The %s field is already in used');
				return FALSE;
			}
		}

		public function check_payroll_cloud_id($str){
			$check = $this->principal->check_payrol_cloud_id($this->input->post('old_payroll_cloud_id'),$str);
			if($check == false){
				return TRUE;
			} else {
				$this->form_validation->set_message('check_payroll_cloud_id', 'The %s field is already in used');
				return FALSE;
			}
		}
		
		
		
		
		
	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company/company_approvers.php */