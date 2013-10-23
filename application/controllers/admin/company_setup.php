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
	var $num_pagi;
	var $segment_url;
	
	public function __construct() {
		parent::__construct();
		$this->theme = $this->config->item('temp_admin');
		$this->load->model("admin/company_setup_model","company_setup");
		$this->num_pagi = 3;
		$this->segment_url = 4;
	}

	public function index(){
		redirect("admin/company_setup/add");
	}
	
	
	public function add()
	{		
		$config["base_url"] 	= "/admin/company_setup/add";
        $config["total_rows"] 	= $this->company_setup->count_company();
        $config["per_page"] 	= $this->num_pagi;
        $config["uri_segment"] 	= $this->segment_url;
        $this->pagination->initialize($config);
		$pagi_url = $this->uri->segment(4) == "" ?  0 : $this->uri->segment(4);
		$data['page_title'] = "Company Setup";	
		$data['owners']		= $this->company_setup->display_owners(); # for dropdowns 
		$data['companies'] 	= $this->company_setup->fetch_company($config["per_page"],$pagi_url);	
		$data['pagi'] = $this->pagination->create_links();
		if($this->input->post('submit')) {
			$this->form_validation->set_rules("owner","Owner","required|trim|xss_clean");
			$this->form_validation->set_rules("reg_business_name","Registration Business Name","required|trim|xss_clean");
			$this->form_validation->set_rules("trade_name","trade name","required|trim|xss_clean");
			$this->form_validation->set_rules("business_address","business address","required|trim|xss_clean");
			$this->form_validation->set_rules("city","city","required|trim|xss_clean");
			$this->form_validation->set_rules("zip_code","zip","required|trim|xss_clean");
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
							"trade_name"		=> $this->db->escape_str($this->input->post("trade_name")),
							"business_address"	=> $this->db->escape_str($this->input->post("business_address")),
							"city"				=> $this->db->escape_str($this->input->post("city")),
							"zipcode"			=> $this->db->escape_str($this->input->post("zip_code")),
							"organization_type"	=> $this->db->escape_str($this->input->post("org_type")),
							"industry"			=> $this->db->escape_str($this->input->post("industry")),
							"business_phone"	=> $this->db->escape_str($this->input->post("business_phone")),
							"extension"			=> $this->db->escape_str($this->input->post("extension")),
							"mobile_number"		=> $this->db->escape_str($this->input->post("mobile_no")),
							"fax"				=> $this->db->escape_str($this->input->post("fax")),
							"status"			=> "Active",
							"deleted"			=> "0"
						);
				$comp_ids = $this->company_setup->save_fields("company",$fields);	
				create_comp_directory($comp_ids);
			}
		}
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/admin/company_add_view', $data);	
	}
	
	public function delete(){
		if($this->input->post("delete")) {
			$this->form_validation->set_rules("id","id","required|xss_clean|trim");
			if($this->form_validation->run() == false){
				return false;
			}else{
				$fields = array("company_id"=>$this->input->post('id'),"status"=>"Inactive","deleted"=>"0");
				$this->company_setup->update_fields("company",$fields,$this->db->escape_str($this->input->post('id')));
			}
		}
	}
	
	public function status(){
		$type = $this->input->post("type");
		if($type) {
			switch($type):
				case "company_view":
					if($this->input->post('update')) {	
						$info = $this->company_setup->company_info($this->input->post('id'));
						echo json_encode($info);
					}
				break;
				case "update":
				
				break;
			endswitch;
		}else{
			return false;
		}
	}
	

}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */