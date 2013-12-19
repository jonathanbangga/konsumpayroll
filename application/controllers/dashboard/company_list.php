<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_list extends CI_Controller {

	/**
	 * Theme options - default theme
	 * @var string
	 */
	protected $theme;
	protected $sub_domain;
	/**
	 * Constructor
	 */
	public function __construct(){
		parent::__construct();
		$this->theme = $this->config->item('company_dashboard');
		$this->menu = $this->config->item('company_dashboard_menu');
		$this->authentication->check_if_logged_in();	
		$this->load->model("dashboard/company_list_model");
		delete_company_session();
		$this->sub_domain = $this->session->userdata('sub_domain');	
	}

	/**
	 * index page
	 */
	public function index(){		
		$data['page_title'] = "Company List";
		$this->layout->set_layout($this->theme);
		$data['company'] = $this->company_list_model->get_company(); 
		$data['sub_domain'] = $this->sub_domain;
		$this->layout->view('pages/dashboard/company_list_view', $data);
	}
	
	public function manage($company_id,$sub_domain){
		$newdata = array(
		   'company_id2'  => $company_id,
		   'sub_domain2'  => $sub_domain,
		);
		$this->session->set_userdata($newdata);
		redirect("/{$sub_domain}/hr/emp_basic_information");
	}
	
	/**
	 * DELETED COMPANY
	 * DELETES COMPANY BY TYPE
	 */
	public function delete_company(){
		if($this->input->is_ajax_request()){
			$this->form_validation->set_rules("company_id","Company","is_numeric|xss_clean|trim");
			if($this->form_validation->run() == true){
				$comp_id = $this->input->post("company_id");
				$field = array(
					"deleted"=>"1"
				);
				$where = array(
					"company_id" => $this->db->escape_str($comp_id),
					"payroll_system_account_id" => $this->session->userdata('psa_id')
				);
				$icheck = $this->company_list_model->update_fields("assigned_company",$field,$where);
				if($icheck){ // CHECK IF HE IS THE RIGHT PERSON TO DELETE IF NOT NO DATA WILL BE DELETED
					$field_company = array(
						"deleted"=>"1",
						"status"=>"Inactive"
					);
					$where_company = array(
						"company_id" => $this->db->escape_str($comp_id)
					);
					$this->company_list_model->update_fields("company",$field,$where_company);
				}
				echo json_encode(array("success"=>"1","error"=>""));
				return false;
			}else{
				echo json_encode(array("success"=>"0","error"=>validation_errors("<span class='error_fields'>","</span>")));
				return false;
			}
		}else{
			show_404();
		}
	}
	
}

/* End of file */