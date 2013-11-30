<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Earnings extends CI_Controller {
	
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
		$this->load->model('payroll_setup/earnings_model');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Earnings";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		$data['esql'] = $this->earnings_model->get_earnings();
		$this->layout->view('pages/payroll_setup/earnings_view',$data);
	}
	
	public function ajax_add_earnings(){
		$earnings = $this->input->post('earnings');
		$taxable = $this->input->post('taxable');
		$max_non_taxable = $this->input->post('max_non_taxable');
		$withholding_tax = $this->input->post('withholding_tax');
		foreach($earnings as $index=>$val){
			$this->earnings_model->add_earnings($val,$taxable[$index],$max_non_taxable[$index],$withholding_tax[$index]);
		}
	}
	
	public function ajax_delete_earnings(){
		$earnings_id = $this->input->post('earnings_id');
		$this->earnings_model->delete_earnings($earnings_id);
	}
	
	public function ajax_update_earnings(){
		$earnings_id = $this->input->post('earnings_id');
		$earnings = $this->input->post('earnings');
		$taxable = $this->input->post('taxable');
		$max_non_taxable = $this->input->post('max_non_taxable');
		$witholding_tax = $this->input->post('witholding_tax');
		$this->earnings_model->update_earnings($earnings_id,$earnings,$taxable,$max_non_taxable,$witholding_tax);
	}
	
}

/* End of file */