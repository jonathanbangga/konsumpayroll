<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Night_shift_differential extends CI_Controller {
	
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
		$this->load->model('payroll_setup/night_shift_differential_model');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Night Shift Differential Settings";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		$data['sql_nsd'] = $this->night_shift_differential_model->get_night_shift_differential_settings();
		$this->layout->view('pages/payroll_setup/night_shift_differential_view',$data);
	}
	
	public function ajax_add_nsd_settings(){
		$nsd_from = date("H:i:s",strtotime($this->input->post('nsd_from')));
		$nsd_to = date("H:i:s",strtotime($this->input->post('nsd_to')));
		$nsd_rate = $this->input->post('nsd_rate');
		$this->night_shift_differential_model->set_night_shift_differential_settings($nsd_from,$nsd_to,$nsd_rate);
	}
	
	public function ajax_update_nsd_settings(){
		$nsd_from = date("H:i:s",strtotime($this->input->post('nsd_from')));
		$nsd_to = date("H:i:s",strtotime($this->input->post('nsd_to')));
		$nsd_rate = $this->input->post('nsd_rate');
		$this->night_shift_differential_model->update_night_shift_differential_settings($nsd_from,$nsd_to,$nsd_rate);
	}
	
}

/* End of file */