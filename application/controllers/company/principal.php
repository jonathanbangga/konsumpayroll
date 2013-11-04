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
			$data['error'] = "";
				if($this->input->post('submit')) {
					$this->form_validation->set_rules("lname","Last name","required|trim|xss_clean");
					$this->form_validation->set_rules("fname","First name","required|trim|xss_clean");
					$this->form_validation->set_rules("mname","Middle name","required|trim|xss_clean");
					$this->form_validation->set_rules("position","Position","trim|xss_clean");
					$this->form_validation->set_rules("contact_no","Business phone","trim|xss_clean");
					$this->form_validation->set_rules("email","Email","required|valid_email|trim|is_unique[accounts.email]|xss_clean");
					$this->form_validation->set_rules("payroll_cloud_id","payroll_cloud_id","min_length[8]|max_length[36]required|trim|is_unique[accounts.payroll_cloud_id]|xss_clean");
					if($this->form_validation->run() == false) {
						 $data['error'] = validation_errors();	
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
						}	
					}
				}	
			$data['sidebar_menu'] = $this->sidebar_menu;
			$data['page_title'] = "Company Principal";		
			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/company/company_principal_view', $data);				
		}
	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company/company_approvers.php */