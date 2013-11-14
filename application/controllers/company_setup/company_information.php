<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Approvers Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Company_information extends CI_Controller {
		
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
			$this->load->model("company/company_model","company");
			$this->company_id = $this->session->userdata("company_id");
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "Company Information";			
			$data['sidebar_menu'] = $this->sidebar_menu;
			$data['company_info'] = subdomain_checker();
			$data['errors']	= "";
			$data['company_info'] = $this->company->company_info($this->company_id);
			
			if($this->input->post('next')){
				$this->form_validation->set_rules("company_name","Company name","required|trim|xss_clean|is_unique[company.company_name]");
				$this->form_validation->set_rules("subdomain","subdomain","required|trim|xss_clean|is_unique[company.sub_domain]");
				$this->form_validation->set_rules("trade_name","Trade Name","required|trim|xss_clean");
				$this->form_validation->set_rules("business_address","Business address","required|trim|xss_clean");
				$this->form_validation->set_rules("city","hdmf id","required|trim|xss_clean");
				$this->form_validation->set_rules("zipcode","philhealth id","required|trim|xss_clean");
				$this->form_validation->set_rules("organization_type","organization type","required|trim|xss_clean");
				$this->form_validation->set_rules("industry","organization type","trim|xss_clean");
				$this->form_validation->set_rules("business_phone","organization type","trim|xss_clean");
				$this->form_validation->set_rules("mobile_number","organization type","trim|xss_clean");
				$this->form_validation->set_rules("fax","organization type","trim|xss_clean");	
				if($this->form_validation->run() == false){
					$data['errors'] = validation_errors("<span class='errors'>","</span>");
				}else{
					$fields = array(
								"company_name"	=> $this->db->escape_str($this->input->post("company_name")),
								"trade_name"	=> $this->db->escape_str($this->input->post("trade_name")),
								"business_address" => $this->db->escape_str($this->input->post("business_address")),
								"city"			=> $this->db->escape_str($this->input->post("city")),
								"zipcode"		=> $this->db->escape_str($this->input->post("zipcode")),
								"organization_type"	=> $this->db->escape_str($this->input->post("organization_type")),
								"industry"		=> $this->db->escape_str($this->input->post("industry")),
								"business_phone"=> $this->db->escape_str($this->input->post("business_phone")),
								"mobile_number"	=> $this->db->escape_str($this->input->post("mobile_number")),
								"fax"			=> $this->db->escape_str($this->input->post("fax")),
								"sub_domain"	=> $this->db->escape_str($this->input->post('subdomain')),
								"subscription_date" => idates_now(),
								"deleted"		=> "0",
								"status"		=> "Active"
							);
							
					if($data['company_info']){
						$where = array("company_id"=>$this->company_id);
						$this->company->update_fields("company",$fields,$where);
					}else{		
						$company_id = $this->company->add_company($fields);
						create_comp_directory($company_id);
						if($company_id){			
							$save_assign = array(
									"company_id" => $company_id,
									"payroll_system_account_id" => $this->session->userdata("psa_id")
								);	
							$this->company->save_fields("assigned_company",$save_assign);
							$this->session->set_userdata("company_id",$company_id);
							redirect("/company/company_setup/government_registration");
						}
					}
				}
			}
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/company_setup/company_information_view', $data);
		}

		public function test5(){
			p($this->session->all_userdata());
		}
		
	
	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company_approvers.php */