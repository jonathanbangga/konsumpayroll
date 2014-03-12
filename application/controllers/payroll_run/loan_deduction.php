<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loan_deduction extends CI_Controller {
	
	/**
	 * Theme options - default theme
	 * @var string
	 */
	var $theme;
	var $menu;
	var $sidebar_menu;
	var $company_info;
	var $subdomain;
	var $per_page;
	var $segment;
	
	var $company_id;
	
	/**
	 * Constructor
	 */
	public function __construct() 
	{
		parent::__construct();
		
		$this->load->model("payroll_run/loan_deduction_model","ldm");
		$this->theme = $this->config->item('default');
		$this->menu = 'content_holders/user_hr_owner_menu';
		$this->sidebar_menu = $this->config->item('payroll_run_sidebar_menu');
		$this->company_info = whose_company();
		$this->subdomain = $this->uri->segment(1);
		$this->per_page	= 10;
		$this->segment	= 5;
		$this->authentication->check_if_logged_in();
		
		$this->company_id = $this->company_info->company_id;
		
		if(count($this->company_info) == 0){
			show_error("Invalid subdomain");
			return false;
		}
	}
	
	public function loans()
	{
		$data['page_title'] = "Loans and Deductions";
		$data['sidebar_menu'] = $this->sidebar_menu;
		
		$data['q'] = $this->ldm->get_loans($this->company_id);
		
		$this->layout->set_layout($this->theme);
		$this->layout->view('pages/payroll_run/loans_view',$data);
	}
	
	public function deductions()
	{
		$data['page_title'] = "Loans and Deductions";
		$data['sidebar_menu'] = $this->sidebar_menu;
		
		$data['q'] = $this->ldm->get_loans($this->company_id);
		
		$this->layout->set_layout($this->theme);
		$this->layout->view('pages/payroll_run/deductions_view',$data);
	}
}