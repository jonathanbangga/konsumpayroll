<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hours_type extends CI_Controller {
	
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
		$this->load->model('payroll_setup/hours_type_model');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Hours type";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		$data['ht_sql'] = $this->hours_type_model->get_hours_type();
		$this->layout->view('pages/payroll_setup/hours_type_view',$data);
	}
	
	public function ajax_add_hours_type(){
		$hours_type = $this->input->post('hours_type');
		$pay_rate = $this->input->post('pay_rate');
		foreach($hours_type as $index=>$val){
			$this->hours_type_model->add_hours_type($val,$pay_rate[$index]);
		}
	}
	
	public function ajax_delete_hours_type(){
		$hours_type_id = $this->input->post('hours_type_id');
		$this->hours_type_model->delete_hours_type($hours_type_id);
	}
	
	public function ajax_update_hours_type(){
		$holiday_id = $this->input->post('holiday_id');
		$hour_type = $this->input->post('hour_type');
		$pay_rate = $this->input->post('pay_rate');
		$this->hours_type_model->update_hours_type($holiday_id,$hour_type,$pay_rate);
	}
	
}

/* End of file */