<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payroll_group extends CI_Controller {
	
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
		$this->load->model('payroll_setup/payroll_group_model');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Payroll Group";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		$data['pg_sql'] = $this->payroll_group_model->get_payroll_group_setup();
		$this->layout->view('pages/payroll_setup/payroll_group_view',$data);
	}
	
	public function ajax_add_payroll_group_setup(){
		$payroll_group = $this->input->post('payroll_group');
		$period_type = $this->input->post('period_type');
		$pay_rate_type = $this->input->post('pay_rate_type');
		foreach($payroll_group as $index=>$val){
			$this->payroll_group_model->add_payroll_group_setup($val,$period_type[$index],$pay_rate_type[$index]);
		}
	}
	
	public function ajax_delete_payroll_group_setup(){
		$pg_id = $this->input->post('pg_id');
		$this->payroll_group_model->delete_payroll_group_setup($pg_id);
	}
	
	public function ajax_update_payroll_group_setup(){
		$pg_id = $this->input->post('pg_id');
		$payroll_group = $this->input->post('payroll_group');
		$period_type = $this->input->post('period_type');
		$pay_rate_type = $this->input->post('pay_rate_type');
		$this->payroll_group_model->update_payroll_group_setup($pg_id,$payroll_group,$period_type,$pay_rate_type);
	}
	
}

/* End of file */