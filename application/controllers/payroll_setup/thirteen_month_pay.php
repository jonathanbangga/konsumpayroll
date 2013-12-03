<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Thirteen_month_pay extends CI_Controller {
	
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
		$this->load->model('payroll_setup/thirteen_month_pay_model');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "13th Month Pay";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		$this->layout->view('pages/payroll_setup/thirteen_month_pay_view',$data);
	}
	
}

/* End of file */