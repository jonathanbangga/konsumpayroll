<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_list extends CI_Controller {

	/**
	 * Theme options - default theme
	 * @var string
	 */
	protected $theme;
	protected $sidebar_menu;
	/**
	 * Constructor
	 */
	public function __construct(){
		parent::__construct();
		$this->theme = $this->config->item('company_dashboard');
		$this->menu = $this->config->item('company_dashboard_menu');
		$this->authentication->check_if_logged_in();		
		$this->load->model("company/company_model","company");
	}

	/**
	 * index page
	 */
	public function index(){		
		$data['page_title'] = "Company List";
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/dashboard/company_list_view', $data);
	}
	
	public function we(){
	p($this->session->all_userdata());
	}
	
}

/* End of file */