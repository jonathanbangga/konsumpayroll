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
			$data['page_title'] = "Government Registration";			
			$data['sidebar_menu'] = $this->sidebar_menu;
			$data['page_title'] = "Government Registration";		
			$data['company_info'] =  $this->company->get_government_registration($valid_domain);
			$data['error']	= "";
			$data['category'] = array("regular","non-regular","household","probie");
			$check_add_update = $this->company->gov_info($valid_domain);
			if($this->input->post('save')){
				$this->form_validation->set_rules("tin","tin id","required|trim|xss_clean");
				$this->form_validation->set_rules("rdo","rdo id","required|trim|xss_clean");
				$this->form_validation->set_rules("sss_id","sss id","required|trim|xss_clean");
				$this->form_validation->set_rules("hdmf_id","hdmf id","required|trim|xss_clean");
				$this->form_validation->set_rules("philhealth_id","philhealth id","required|trim|xss_clean");
				$this->form_validation->set_rules("category","category id","required|trim|xss_clean");
				if($this->form_validation->run() == false){
					$data['error'] = validation_errors("<span class='errors'>","</span>");
				}else{
					$fields = array(
								"tin"		=> $this->db->escape_str($this->input->post('tin')),
								"rdo_code"	=> $this->db->escape_str($this->input->post('rdo')),
								"sss_id"	=> $this->db->escape_str($this->input->post('sss_id')),
								"hdmf"		=> $this->db->escape_str($this->input->post('hdmf_id')),
								"phil_health"=>$this->db->escape_str($this->input->post('philhealth_id')),
								"category"	=> $this->db->escape_str($this->input->post('category')),
								"status"	=> "Active",
								"deleted"	=> "0"
							);			
					if($check_add_update){	
						$this->company->gov_update($fields,$valid_domain);
						$this->session->set_flashdata("success","Successfully updated");
						$value = sprintf(lang("updated_company"),"administrator");
						add_activity($value,$valid_domain);
					}else{
						#$fields["company_id"] = $this->db->escape_str($valid_domain);
						#$this->company->gov_save($fields);
						#$this->session->set_flashdata("success","Successfully added");
						#$value = sprintf(lang("updated_company"),"administrator");
						#add_activity($value,$valid_domain);	
					}	
					redirect("/".$this->uri->uri_string());	
				}
			}
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/company/government_registration_view', $data);				
		}
		
		
	
	
	}

/* End of file Government_registration.php */
/* Location: ./application/controllers/company/Government_registration.php */