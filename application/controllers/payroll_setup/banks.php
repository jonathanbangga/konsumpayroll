<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banks extends CI_Controller {
	
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
		$this->load->model('payroll_setup/banks_model');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Banks";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		if($this->input->post('save')){
			$pg_id =  $this->input->post('pg_id');
			$bank = $this->input->post('bank');
			$branch = $this->input->post('branch');
			$bank_an = $this->input->post('bank_an');
			$bank_at = $this->input->post('bank_at');
			$paba_id = $this->input->post('paba_id');	
			foreach($pg_id as $index=>$val){
				if($paba_id[$index]==""){
					$this->banks_model->assign_bank_account_to_payroll($val,$bank[$index],$branch[$index],$bank_an[$index],$bank_at[$index]);
				}else{
					$this->banks_model->update_bank_account_to_payroll($paba_id[$index],$bank[$index],$branch[$index],$bank_an[$index],$bank_at[$index]);
				}
			}	
			setcookie('msg', "Submission has been saved");
			$data['pg_sql'] = $this->banks_model->get_payroll_group();
			$this->layout->view('pages/payroll_setup/banks_view',$data);
		}else{
			$data['pg_sql'] = $this->banks_model->get_payroll_group();
			$this->layout->view('pages/payroll_setup/banks_view',$data);
		}
		
	}
	
}

/* End of file */