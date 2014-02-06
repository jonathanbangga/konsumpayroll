<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rest_day extends CI_Controller {
	
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
		$this->load->model('payroll_setup/rest_day_model');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Rest Day";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		$data['pg_sql'] = $this->rest_day_model->get_payroll_group();
		
		$pg_id = $this->input->post('pg_id');
		if($this->input->post('save')){
			$this->rest_day_model->clear_rest_day();
			foreach($pg_id as $i=>$pg_id_val){
				$rd = $this->input->post('rd'.$i);
				foreach($rd as $rd_val){
					$this->rest_day_model->add_rest_day($pg_id_val,$rd_val);
				}
			}
			setcookie('msg','Changes Saved!');
		}
		
		$this->layout->view('pages/payroll_setup/rest_day_view',$data);
	}
	
	public function ajax_set_rest_day(){
		$pg_id = $this->input->post('pg_id');
		$rest_day = $this->input->post('rest_day');
		$this->rest_day_model->add_rest_day($pg_id,$rest_day);
	}
	
	public function ajax_unset_rest_day(){
		$rd_id = $this->input->post('rd_id');
		$this->rest_day_model->delete_rest_day($rd_id);
	}
	
}

/* End of file */