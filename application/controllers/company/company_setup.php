<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Approvers Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Company_setup extends CI_Controller {
		
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
		
		/**
		 * index page
		 */
		public function add() {
			$data['page_title'] = "Company Information";			
			$data['sidebar_menu'] = $this->sidebar_menu;
			$data['company_info'] = subdomain_checker();
			$data['errors']	= "";
			if($this->input->post('next')){
				
				$this->form_validation->set_rules("company_name","Company name","required|trim|xss_clean");
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
								"fax"			=>$this->db->escape_str($this->input->post("fax")),
								"deleted"		=> "0",
								"status"		=> "Active"
							);
					
					$company_id = $this->company->add_company($fields);
					create_comp_directory($company_id);
					if($company_id){
						redirect("/company/government_registration/edit/".$company_id);
					}
				}
			}
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/company/company_information_view', $data);
		}
		
		
		public function edit() {
			$data['page_title'] = "Company Information";			
			$data['sidebar_menu'] = $this->sidebar_menu;
			$data['company_info'] = subdomain_checker();
			$data['errors']	= "";
			$data['company_info'] = $this->company->company_info($this->uri->segment(4));
			
			if($this->input->post('next')){
				
				$this->form_validation->set_rules("company_name","Company name","required|trim|xss_clean");
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
								"fax"			=>$this->db->escape_str($this->input->post("fax")),
								"deleted"		=> "0",
								"status"		=> "Active"
							);
					
					$company_id = $this->company->add_company($fields);
					if($company_id){
						redirect("/company/government_registration/edit/".$company_id);
					}
				}
			}
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/company/company_information_view', $data);
		}
		
		
	
	
	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company_approvers.php */