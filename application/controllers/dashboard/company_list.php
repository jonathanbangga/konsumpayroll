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
		$this->ci->session->set_userdata($newdata);
		redirect("/{$sub_domain}/hr/emp_basic_information");
	}
	
}

/* End of file */