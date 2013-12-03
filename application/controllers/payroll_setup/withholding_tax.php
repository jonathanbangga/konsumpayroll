<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Withholding_tax extends CI_Controller {
	
	protected $theme;
	protected $sidebar_menu;
	
	public function __construct() {
		parent::__construct();
		// menu and authentication
		$this->theme = $this->config->item('default');
		$this->menu = $this->config->item('add_company_menu');
		$this->sidebar_menu = $this->config->item('payroll_setup_sidebar_menu');
		$this->authentication->check_if_logged_in();
		// load
		$this->load->model('payroll_setup/withholding_tax_model');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Withholding Tax";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		$this->layout->view('pages/payroll_setup/withholding_tax_view',$data);
	}
	
}

/* End of file */