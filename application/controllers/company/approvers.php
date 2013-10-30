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
		
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->theme = $this->config->item('default');		
			$this->menu = 'content_holders/company_menu';	
			$this->sidebar_menu = 'content_holders/company_sidebar_menu';
			$this->load->model("company/company_model","company");
		}
		

		public function edit(){
			$valid_domain = $this->uri->segment(4);
			if(mod_is_mycompany(0,$valid_domain) == false){
				redirect("company/dashboard");
				return false;
			}	
			$data['page_title'] = "Company Approvers";			
			$data['sidebar_menu'] = $this->sidebar_menu;
			$data['page_title'] = "Government Registration";		
			$data['company_info'] =  $this->company->get_government_registration($valid_domain);
			$data['error']	= "";
			$data['category'] = array("regular","non-regular","household","probie");
			$check_add_update = $this->company->gov_info($valid_domain);
			if($this->input->post('submit')){
				$this->form_validation->set_rules("lname","Last name","required|trim|xss_clean");
				$this->form_validation->set_rules("fname","First name","required|trim|xss_clean");
				$this->form_validation->set_rules("mname","Middle name","required|trim|xss_clean");
				$this->form_validation->set_rules("position","Position","trim|xss_clean");
				$this->form_validation->set_rules("contact_no","Business phone","trim|xss_clean");
				$this->form_validation->set_rules("email","Email","required|valid_email|trim|xss_clean");
				if($this->form_validation->run() == false){
					$data['error'] = validation_errors("<span class='errors'>","</span>");
				}else{
					
					$fields = array(
							"last_name" 	=> $this->db->escape_str($this->input->post('lname')),
							"first_name" 	=> $this->db->escape_str($this->input->post('fname')),
							"middle_name"	=> $this->db->escape_str($this->input->post('mname')),
							"position"		=> $this->db->escape_str($this->input->post('position')),
							"contact_no"	=> $this->db->escape_str($this->input->post('contact_no'))
							);
					
					
					$assign_company_heads = array(
								"company_id" 	=>
								"emp_id"		=>
								"user_created"	=>
								"status"		=> "Active",
								"deleted"		=> "0"
							);
					$this->db->insert("assign_company_head",$assign_company_heads);
					
				} 
			}
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/company/company_approvers_view', $data);				
		}
		
	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company_approvers.php */