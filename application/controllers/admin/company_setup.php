<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * Admin Dashboard
 *
 * @subpackage Admin Dashboard
 * @category Controller
 * @version 1.0
 * @copyright Copyright (c) 2013, Konsum Technologies Inc.
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */

class Company_setup extends CI_Controller {

	var $theme;

	public function __construct() {
		parent::__construct();
		$this->theme = $this->config->item('temp_admin');
		$this->load->model("admin/company_setup_model","company_setup");
	}

	public function index(){
		echo 'we';
	
	}
	
	
	public function add()
	{		
		$data['page_title'] = "Company Setup";	
		$data['owners']		= $this->company_setup->display_owners();
		$data['companies'] 	= $this->company_setup->fetch_company(5,0);		
		if($this->input->post('submit')) {
			$this->form_validation->set_rules("owner","Owner","required|trim|xss_clean");
			$this->form_validation->set_rules("reg_business_name","Registration Business Name","required|trim|xss_clean");
			$this->form_validation->set_rules("trade_name","trade name","required|trim|xss_clean");
			$this->form_validation->set_rules("business_address","business address","required|trim|xss_clean");
			$this->form_validation->set_rules("city","city","required|trim|xss_clean");
			$this->form_validation->set_rules("org_type","org type","trim|xss_clean");
			$this->form_validation->set_rules("industry","industry","trim|xss_clean");
			$this->form_validation->set_rules("business_phone","business phone","required|trim|xss_clean");
			$this->form_validation->set_rules("extension","extension","trim|xss_clean");
			$this->form_validation->set_rules("mobile_no","mobile no","required|trim|xss_clean");
			$this->form_validation->set_rules("fax","fax","trim|xss_clean");
			if($this->form_validation->run() == FALSE) {
			
			} else {
				$fields = array(
							"company_owner_id"	=> $this->db->escape_str($this->input->post("owner")),
							"registered_business_name" => $this->db->escape_str($this->input->post("reg_business_name")),
							"trade_name"		=> $this->db->escape_str($this->input->post("trace_name")),
							"business_address"	=> $this->db->escape_str($this->input->post("business_address")),
							"city"				=> $this->db->escape_str($this->input->post("city")),
							"organization_type"	=> $this->db->escape_str($this->input->post("org_type")),
							"industry"			=> $this->db->escape_str($this->input->post("industry")),
							"business_phone"	=> $this->db->escape_str($this->input->post("business_phone")),
							"extension"			=> $this->db->escape_str($this->input->post("extension")),
							"mobile_number"		=> $this->db->escape_str($this->input->post("mobile_no")),
							"fax"				=> $this->db->escape_str($this->input->post("fax")),
							"status"			=> "Active",
							"deleted"			=> "0"
						);
				$this->company_setup->save_fields("company",$fields);	
			}
		}
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/admin/company_add_view', $data);	
	}
	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */