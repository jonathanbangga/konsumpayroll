<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Holiday_settings extends CI_Controller {
	
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
		$this->load->model('payroll_setup/holiday_settings_model');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Holiday Settings";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		$data['hs_sql'] = $this->holiday_settings_model->get_holiday_settings();
		$this->layout->view('pages/payroll_setup/holiday_settings_view',$data);
	}
	
	public function ajax_add_holiday_settings(){
		$holiday = $this->input->post('holiday');
		$type = $this->input->post('type');
		$date = $this->input->post('date');
		foreach($holiday as $index=>$val){
			$this->holiday_settings_model->add_holiday_settings($val,$type[$index],$date[$index]);
		}
	}
	
	public function ajax_delete_holiday_settings(){
		$holiday_id = $this->input->post('holiday_id');
		$this->holiday_settings_model->delete_holiday_settings($holiday_id);
	}
	
	public function ajax_update_holiday_settings(){
		$holiday_id = $this->input->post('holiday_id');
		$holiday = $this->input->post('holiday');
		$type = $this->input->post('type');
		$date = $this->input->post('date');
		$this->holiday_settings_model->update_holiday_settings($holiday_id,$holiday,$type,$date);
		
	}
	
}

/* End of file */