<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Government Registration Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Government_registration extends CI_Controller {
		
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
			$this->authentication->check_if_logged_in();		
			$this->company_id = $this->session->userdata("company_id");	
		}
		
		public function index(){
			if($this->company_id){
			$data['errors'] = "";
			$data['page_title'] = "Government Registration";			
			$data['sidebar_menu'] = $this->sidebar_menu;
			$data['page_title'] = "Government Registration";		
			$data['company_info'] =  $this->company->get_government_registration($this->company_id);
			$data['error']	= "";
			$data['category'] = array("regular","household");
			$check_add_update = $this->company->gov_info($this->company_id);
			if($this->input->post('save')) {
				$this->form_validation->set_rules("tin","tin id","required|trim|xss_clean|is_unique[company.tin]");
				$this->form_validation->set_rules("rdo","rdo id","required|trim|xss_clean|is_unique[company.rdo_code]");
				$this->form_validation->set_rules("sss_id","sss id","required|trim|xss_clean|is_unique[company.sss_id]");
				$this->form_validation->set_rules("hdmf_id","hdmf id","required|trim|xss_clean|is_unique[company.hdmf]");
				$this->form_validation->set_rules("philhealth_id","philhealth id","required|trim|xss_clean|is_unique[company.phil_health]");
				$this->form_validation->set_rules("category","category id","required|trim|xss_clean");
				if($this->form_validation->run() == false) {
					$data['errors'] = validation_errors("<span class='errors'>","</span>");
				} else {
					$fields = array(
								"tin"		=> $this->db->escape_str(str_replace("-","",$this->input->post('tin'))),
								"rdo_code"	=> $this->db->escape_str(str_replace("-","",$this->input->post('rdo'))),
								"sss_id"	=> $this->db->escape_str(str_replace("-","",$this->input->post('sss_id'))),
								"hdmf"		=> $this->db->escape_str(str_replace("-","",$this->input->post('hdmf_id'))),
								"phil_health"=>$this->db->escape_str(str_replace("-","",$this->input->post('philhealth_id'))),
								"category"	=> $this->db->escape_str($this->input->post('category')),
								"status"	=> "Active",
								"deleted"	=> "0"
							);			
					if($check_add_update) {					
						$this->company->gov_update($fields,$this->company_id);
						$this->session->set_flashdata("success","Successfully updated");
						$value = sprintf(lang("updated_company"),"administrator");
						add_activity($value,$this->company_id);
					} else {	
						$fields["company_id"] = $this->db->escape_str($this->company_id);
						$this->company->gov_save($fields);
						$this->session->set_flashdata("success","Successfully added");
						$value = sprintf(lang("added_company"),"administrator");
						add_activity($value,$this->company_id);	
					}	
					redirect("/".$this->uri->uri_string());	
				}
			}
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/company_setup/government_registration_view', $data);
			}else{
				redirect("/company/company_setup/company_information/");
			}	
		}
		
	}

/* End of file Government_registration.php */
/* Location: ./application/controllers/company/Government_registration.php */