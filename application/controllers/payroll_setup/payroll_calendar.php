<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payroll_calendar extends CI_Controller {
	
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
		$this->load->model('payroll_setup/payroll_calendar_model');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Payroll Calendar";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		$data['pg_sql'] = $this->payroll_calendar_model->get_payroll_group();
		$this->layout->view('pages/payroll_setup/payroll_calendar_view',$data);
	}
	
	public function ajax_add_payroll_calendar(){
		$pg_id = $this->input->post('pg_id');
		$semi_monthly = $this->input->post('semi_monthly');
		$monthly = $this->input->post('monthly');
		$payroll_date = $this->input->post('payroll_date');
		$payroll_date2 = date('Y-m-d',strtotime($payroll_date));
		$cut_off_from = $this->input->post('cut_off_from');
		$cut_off_from2 = date('Y-m-d',strtotime($cut_off_from));
		$cut_off_to = $this->input->post('cut_off_to');
		$cut_off_to2 = date('Y-m-d',strtotime($cut_off_to));
		$this->payroll_calendar_model->add_payroll_calendar($pg_id,$semi_monthly,$monthly,$payroll_date2,$cut_off_from2,$cut_off_to2);
	}
	
	
	public function test(){
		$payroll_date = '12/31/2013';
		echo $payroll_date2 = date('Y-m-d',strtotime($payroll_date));
		$cut_off_from = '12/11/2013';
		$cut_off_from2 = date('Y-m-d',strtotime(str_replace("/","-",$cut_off_from)));
		$cut_off_to = '12/25/2013';
		$cut_off_to2 = date('Y-m-d',strtotime(str_replace("/","-",$cut_off_to)));
	}
	
	
}

/* End of file */