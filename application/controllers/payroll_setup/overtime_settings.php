<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Overtime_settings extends CI_Controller {
	
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
		$this->load->model('payroll_setup/overtime_settings_model');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Overtime Settings";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		if($this->input->post('save')==1){
			// overtime type
			$overtime_type = $this->input->post('overtime_type');
			$pay_rate = $this->input->post('pay_rate');
			$ot_rate = $this->input->post('ot_rate');
			if(count($overtime_type)>0){
				foreach($overtime_type as $index=>$val){
					$this->overtime_settings_model->add_overtime_type($val,$pay_rate[$index],$ot_rate[$index]);
				}
			}
			// allowance type
			$allowance_type = $this->input->post('allowance_type');
			$taxable = $this->input->post('taxable');
			$max_non_taxable = $this->input->post('max_non_taxable');
			$amount = $this->input->post('amount');
			$min_ot = $this->input->post('min_ot');
			if(count($allowance_type)>0){
				foreach($allowance_type as $index=>$val){
					$this->overtime_settings_model->add_allowance_type($val,$taxable[$index],$max_non_taxable[$index],$amount[$index],$min_ot[$index]);
				}
			}
		}
		$data['ot_sql'] = $this->overtime_settings_model->get_overtime_type();
		$data['at_sql'] = $this->overtime_settings_model->get_allowance_type();
		$data['lt_sql'] = $this->overtime_settings_model->get_leave_type();
		$this->layout->view('pages/payroll_setup/overtime_settings_view',$data);
	}
	
}

/* End of file */