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
		$data['page_title'] = "Department Setup";	
		$data['owners']		= $this->company_setup->display_owners(); # for dropdowns 
		$data['companies'] 	= $this->company_setup->fetch_company($config["per_page"],$pagi_url);
		$data['option_owners']		= $this->company_setup->display_owners_options();
		$data['pagi'] = $this->pagination->create_links();
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/admin/company_add_view', $data);	
	}
	
	/**
	 * ADD COMPANY FOR LOOPS
	 * Enter description here ...
	 */
	public function add_company(){
		if($this->input->post('add_owner_company')) {
			$name = $this->input->post("name");
			$owner = $this->input->post("owner");
			if($owner){
				foreach($owner as $key=>$val):
					$this->form_validation->set_rules("name[{$key}]","Department Name","required|trim|xss_clean|is_unique[payroll_system_account.name]");
					$this->form_validation->set_rules("owner[{$key}]","Owner","required|trim|xss_clean");
				endforeach;
			}	
			if($this->form_validation->run() == FALSE) {
				echo json_encode(array("success"=>"0","error"=>validation_errors("<span class='errors'>","</span>")));
				return false;
			} else {
				foreach($owner as $key=>$val):
					$payroll_system  = $this->company_setup->display_owners_details($val);				
					if($payroll_system){
						// CREATE PAYROLL SYSTEM ACCOUNT FIRST THEN ASSIGN THE OWNER
						$fields_psa = array(
								"name"			=> $name[$key],
								"account_id"	=> $val,
								"status"		=> "Active"
						);
						$payroll_system_account_id = $this->company_setup->save_fields("payroll_system_account",$fields_psa);
						if($payroll_system_account_id){
						// UPDATE AND ASSIGNED IT TO T HE PAYROLL SYSTEM ACCOUNT ID THE ACCOUNT ID
							$where = array("account_id"=>$val);
							$fields_account = array(
									"payroll_system_account_id" => $payroll_system_account_id
							);
							$this->company_setup->update_fields_data("accounts",$fields_account,$where);
						}
						
					}		
					add_activity(sprintf(lang("added_company"),$this->profile->account_admin()->name),"");	
				endforeach;	
				echo json_encode(array("success"=>"1","error"=>''));
				return false;
			}
		}
	}
	
	public function we(){
		p($this->session->all_userdata());
	}
	
	public function delete(){
		if($this->input->post("delete")) {
			$this->form_validation->set_rules("id","id","required|xss_clean|trim");
			if($this->form_validation->run() == false){
				return false;
			}else{
				$where = array("payroll_system_account_id"=>$this->input->post("id"));
				$fields = array("status"=>"Inactive");
				$this->company_setup->update_payroll_account_system("payroll_system_account",$fields,$where);
			}
		}
	}
	
	public function status(){
		$type = $this->input->post("type");
		if($type) {
			switch($type):
				case "company_view":
					if($this->input->post('update')) {	
						$info = $this->company_setup->company_info($this->input->post('psa_id'));
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
	
	/**
	 * UPDATE PAYROLL SYSTEM ACCOUNT
	 * VALIDATES ERROR TRAPPING
	 */
	public function update_psa(){
		if($this->input->post('update_dept')){
			$this->form_validation->set_rules("psa_id","PSA ID","required|is_numeric|trim|xss_clean");
			$this->form_validation->set_rules("dept_owner","Owner","required|trim|xss_clean");
			$this->form_validation->set_rules("dept_name","Name","required|trim|xss_clean|callback_check_psa_name");
			$this->form_validation->set_rules("old_psa_name","Name","required|trim|xss_clean");
			if($this->form_validation->run() == false){
				echo json_encode(array("success"=>"0","error"=>validation_errors("<span class='errors'>","</span>")));
				return false;
			}else{
				$fields = array(
								"name"			=> $this->input->post('dept_name'),
								"status"		=> "Active"
				);
				$where = array("payroll_system_account_id"=>$this->db->escape_str($this->input->post("psa_id")));
				$this->company_setup->update_payroll_account_system("payroll_system_account",$fields,$where);
				echo json_encode(array("success"=>"1","error"=>''));
				return false;
			}
		}
	}
	
	/** CALLBACKS FOR UPDATE PSA ***/
	public function check_psa_name($str){
		$old_name =  $this->db->escape_str($this->input->post("old_psa_name"));
		$query = $this->db->query("SELECT * FROM `payroll_system_account` WHERE name = '{$this->db->escape_str($str)}' AND name NOT IN('{$old_name}')");
		$row = $query->num_rows();
		if($row){
			$this->form_validation->set_message("check_psa_name","Name of department already exist");
			return false;
		}else{
			return true;
		}
	}
	/** CALLBACKS FOR END UPDATE PSA **/
	
	
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