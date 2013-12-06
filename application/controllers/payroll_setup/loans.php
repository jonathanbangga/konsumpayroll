<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loans extends CI_Controller {
	
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
		$this->load->model('payroll_setup/loans_model');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Loans";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		$data['l_sql'] = $this->loans_model->get_loans();
		$this->layout->view('pages/payroll_setup/loans_view',$data);
	}
	
	public function ajax_add_loans(){
		$loan = mysql_real_escape_string($this->input->post('loan'));
		$this->loans_model->add_loans($loan);
	}
	
	public function ajax_delete_loans(){
		$load_id = $this->input->post('loan_id');
		$this->loans_model->delete_loans($load_id);
	}
	
	public function ajax_update_loans(){
		$load_id = $this->input->post('loan_id');
		$loan = mysql_real_escape_string($this->input->post('loan'));
		$this->loans_model->update_loans($load_id,$loan);
	}
	
}

/* End of file */