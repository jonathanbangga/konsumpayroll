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
		$data['wt_sql'] = $this->withholding_tax_model->get_withholding_tax_settings();
		$this->layout->view('pages/payroll_setup/withholding_tax_view',$data);
	}
	
	public function ajax_set_withholding_tax(){
		$comp = $this->input->post('comp');
		$this->withholding_tax_model->set_withholding_tax_settings($comp);
	}
	
	public function ajax_update_withholding_tax(){
		$comp = $this->input->post('comp');
		$this->withholding_tax_model->update_withholding_tax_settings($comp);
	}
	
}

/* End of file */