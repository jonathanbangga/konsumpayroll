<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Holiday_premium extends CI_Controller {
	
	protected $theme;
	protected $sidebar_menu;
	
	public function __construct() {
		parent::__construct();
		// menu and authentication
		$this->theme = $this->config->item('default');
		$this->menu = 'content_holders/user_hr_owner_menu';
		$this->sidebar_menu = $this->config->item('payroll_run_sidebar_menu');
		$this->authentication->check_if_logged_in();
		// load
		$this->load->model('payroll_run/holiday_premium_model');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Holiday Premium";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		//$data['tk_sql'] = $this->holiday_premium->get_leave($pp->payroll_group_id,$offset,$per_page);
		$this->layout->view("pages/payroll_run/holiday_premium_view",$data);
	}
	
}

/* End of file */