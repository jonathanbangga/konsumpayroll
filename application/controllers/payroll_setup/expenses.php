<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expenses extends CI_Controller {
	
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
		$this->load->model('payroll_setup/expenses_model');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Expenses";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		$data['e_sql'] = $this->expenses_model->get_expense_type();
		$this->layout->view('pages/payroll_setup/expenses_view',$data);
	}
	
	public function ajax_add_expense_type(){
		$expense_type = $this->input->post('expense_type');
		$min_amount = $this->input->post('min_amount');
		$max_amount = $this->input->post('max_amount');
		$req_receipt = $this->input->post('req_receipt');
		foreach($expense_type as $index=>$val){
			$this->expenses_model->add_expense_type($val,$min_amount[$index],$max_amount[$index],$req_receipt[$index]);
		}
	}
	
	public function ajax_delete_expense_type(){
		$expense_type_id = $this->input->post('expense_type_id');
		$this->expenses_model->delete_expense_type($expense_type_id);
	}
	
	public function ajax_update_expense_type(){
		$expense_type_id = $this->input->post('expense_type_id');
		$expense_type = $this->input->post('expense_type');
		$min_amount = $this->input->post('minimum_amount');
		$max_amount = $this->input->post('maximum_amount');
		$req_receipt = $this->input->post('req_receipt');
		$this->expenses_model->update_expense_type($expense_type_id,$expense_type,$min_amount,$max_amount,$req_receipt);
	}
	
}

/* End of file */