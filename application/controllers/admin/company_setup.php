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
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/admin/company_add_view', $data);	
	}
	
	public function add_company(){
		if($this->input->post('submit')) {
			$this->form_validation->set_rules("owner","Owner","required|trim|xss_clean");
			$this->form_validation->set_rules("reg_business_name","Registration Business Name","required|trim|xss_clean");
			$this->form_validation->set_rules("subscription_date","Subscription Date","required|trim|xss_clean");
			$this->form_validation->set_rules("no_employees","No of employees","required|trim|xss_clean|numeric");
			$this->form_validation->set_rules("email_add","email","required|trim|xss_clean|valid_email");
			#$this->form_validation->set_rules("trade_name","trade name","required|trim|xss_clean");
			$this->form_validation->set_rules("business_phone","business phone","required|trim|xss_clean");
			$this->form_validation->set_rules("mobile_no","mobile no","required|trim|xss_clean");
			$this->form_validation->set_rules("fax","fax","trim|xss_clean");
			$this->form_validation->set_rules("business_address","business address","required|trim|xss_clean");
			$this->form_validation->set_rules("city","city","trim|xss_clean");
			$this->form_validation->set_rules("province","Province","trim|xss_clean");
			$this->form_validation->set_rules("zip_code","zip","trim|xss_clean");
			#$this->form_validation->set_rules("org_type","org type","trim|xss_clean");
			#$this->form_validation->set_rules("industry","industry","trim|xss_clean");	
			$this->form_validation->set_rules("extension","extension","trim|xss_clean");
			if($this->form_validation->run() == FALSE) {
				echo json_encode(array("success"=>"false","error"=>validation_errors("<span class='errors'>","</span>")));
			} else {
				$fields = array(
							"company_owner_id"	=> $this->db->escape_str($this->input->post("owner")),
							"company_name" 		=> $this->db->escape_str($this->input->post("reg_business_name")),
							"subscription_date"	=> $this->db->escape_str($this->input->post("subscription_date")),
							"number_of_employees" => $this->db->escape_str($this->input->post("no_employees")),
							"email_address"		=> $this->db->escape_str($this->input->post("email_add")),
							"business_address"	=> $this->db->escape_str($this->input->post("business_address")),
							"city"				=> $this->db->escape_str($this->input->post("city")),
							"zipcode"			=> $this->db->escape_str($this->input->post("zip_code")),
							"subscription_date"	=> $this->db->escape_str($this->input->post("subscription_date")),
							"province"			=> $this->db->escape_str($this->input->post("province")),
							"business_phone"	=> $this->db->escape_str($this->input->post("business_phone")),
							"mobile_number"		=> $this->db->escape_str($this->input->post("mobile_no")),
							"fax"				=> $this->db->escape_str($this->input->post("fax")),
							"status"			=> "Active",
							"deleted"			=> "0"
						);
				$comp_ids = $this->company_setup->save_fields("company",$fields);	
				create_comp_directory($comp_ids);
				echo json_encode(array("success"=>"true","error"=>""));
			}
		}
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
	
	public function edit(){
		$data['page_title'] = "Edit";
		if(is_numeric($this->uri->segment(4))){
			$data['company_info'] = $this->company_setup->company_info($this->uri->segment(4));
			$data['owners']	= $this->company_setup->display_owners(); # for dropdowns
			$data['error'] = "";
			if($this->input->post('update')) {
				$this->form_validation->set_rules("jowner","Owner","required|trim|xss_clean");
				$this->form_validation->set_rules("ucompid","id","required|trim|xss_clean");
				$this->form_validation->set_rules("company_name","Registration Business Name","required|trim|xss_clean|callback_update_company_check");
				$this->form_validation->set_rules("old_company_name","Old company","required|trim|xss_clean");
				$this->form_validation->set_rules("uemail","email","required|trim|xss_clean|valid_email");
				$this->form_validation->set_rules("usubscription_date","Subscription Date","required|trim|xss_clean");
				$this->form_validation->set_rules("uno_employee","Number of employess","trim|xss_clean");
				$this->form_validation->set_rules("uprovince","Province","trim|xss_clean");
				$this->form_validation->set_rules("ubusiness_address","business address","required|trim|xss_clean");
				$this->form_validation->set_rules("ucity","city","required|trim|xss_clean");
				$this->form_validation->set_rules("uzip_code","zip","required|trim|xss_clean");
				$this->form_validation->set_rules("ubusiness_phone","business phone","required|trim|xss_clean");
				$this->form_validation->set_rules("uextension","extension","trim|xss_clean");
				$this->form_validation->set_rules("umobile_no","mobile no","required|trim|xss_clean");
				$this->form_validation->set_rules("ufax","fax","trim|xss_clean");
				if($this->form_validation->run() == FALSE) {
					$data['error'] = validation_errors("<span class='errors'>","</span>");
				} else {
					$comp_id = $this->db->escape_str($this->input->post('ucompid'));
					$fields = array(
								"company_owner_id"	=> $this->db->escape_str($this->input->post("jowner")),
								"company_name" 		=> $this->db->escape_str($this->input->post("company_name")),
								"subscription_date"	=> $this->db->escape_str($this->input->post("usubscription_date")),
								"business_address"	=> $this->db->escape_str($this->input->post("ubusiness_address")),
								"city"				=> $this->db->escape_str($this->input->post("ucity")),
								"zipcode"			=> $this->db->escape_str($this->input->post("uzip_code")),
								"email_address"		=> $this->db->escape_str($this->input->post("uemail")),
								"industry"			=> $this->db->escape_str($this->input->post("uindustry")),
								"business_phone"	=> $this->db->escape_str($this->input->post("ubusiness_phone")),
								"province"			=> $this->db->escape_str($this->input->post("uprovince")),
								"mobile_number"		=> $this->db->escape_str($this->input->post("umobile_no")),
								"fax"				=> $this->db->escape_str($this->input->post("ufax")),
								"status"			=> "Active",
								"deleted"			=> "0"
							);		
					$comp_ids = $this->company_setup->update_fields("company",$fields,$comp_id);	
					$this->session->set_flashdata("success","You have successfully updated company");
				}
			}
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/admin/edit_company_view', $data);	
		}else{
			show_404();
		}
	}
	
	public function company_check($str){
		$res = $this->company_setup->exist_company($str);
		if($res) {
			$this->form_validation->set_message("company_check","Company is already been used");
			return false;
		}else{
			return true;
		}
	}
	
	
	
	public function update_company_check($str){
		$oname = $this->input->post('old_company_name');	
		$res = $this->company_setup->update_exist_company($str,$oname);
		if($res) {
			$this->form_validation->set_message("update_company_check","Company is already been used");
			return false;
		}else{
			return true;
		}
	}
	

}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */