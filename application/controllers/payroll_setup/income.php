<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Income extends CI_Controller {
	
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
		$this->load->model('payroll_setup/income_model','income');
		$this->load->model('konsumglobal_jmodel','jmodel');
		$this->url = "/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$this->uri->segment(4);

		$this->company_id = $this->session->userdata('company_id');
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Income";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		
		$data['income_view'] = $this->income->income_view($this->company_id);
		
		// add new information
		if($this->input->post('save')){
			
			$this->form_validation->set_rules("income_basic_pay", 'Basic Pay', 'trim|xss_clean');
			$this->form_validation->set_rules("income_overtime", 'Overtime', 'trim|xss_clean');
			$this->form_validation->set_rules("income_fixed_allowance", 'Fixed Allowances', 'trim|xss_clean');
			$this->form_validation->set_rules("income_hpp", 'HPP', 'trim|xss_clean');
			$this->form_validation->set_rules("income_nsd", 'NSD', 'trim|xss_clean');
			$this->form_validation->set_rules("income_commission", 'Commission', 'trim|xss_clean');
			$this->form_validation->set_rules("income_piece_rate_pay", 'Piece Rate Pay', 'trim|xss_clean');
			
			if ($this->form_validation->run()==true){
				
				$income_basic_pay = $this->input->post('income_basic_pay');
				$income_overtime = $this->input->post('income_overtime');
				$income_fixed_allowance = $this->input->post('income_fixed_allowance');
				$income_hpp = $this->input->post('income_hpp');
				$income_nsd = $this->input->post('income_nsd');
				$income_commission = $this->input->post('income_commission');
				$income_piece_rate_pay = $this->input->post('income_piece_rate_pay');
				
				$save_income = array(
					"basic_pay" => ($income_basic_pay == "" || $income_basic_pay == NULL) ? "No" : $income_basic_pay,
					"overtime" => ($income_overtime == "" || $income_overtime == NULL) ? "No" : $income_overtime,
					"fixed_allowance" => ($income_fixed_allowance == "" || $income_fixed_allowance == NULL) ? "No" : $income_fixed_allowance,
					"holiday_premium_pay" => ($income_hpp == "" || $income_hpp == NULL) ? "No" : $income_hpp,
					"night_shift_differential" => ($income_nsd == "" || $income_nsd == NULL) ? "No" : $income_nsd,
					"commission" => ($income_commission == "" || $income_commission == NULL) ? "No" : $income_commission,
					"piece_rate_pay" => ($income_piece_rate_pay == "" || $income_piece_rate_pay == NULL) ? "No" : $income_piece_rate_pay,
					"comp_id" => $this->company_id
				);
				
				$this->jmodel->insert_data('income', $save_income);
				$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully saved!</div>');
				redirect($this->url);
			}
		}
		
		// update information
		if($this->input->post('update')){
			
			$this->form_validation->set_rules("edit_income_id", 'Income ID', 'trim|xss_clean');
			$this->form_validation->set_rules("edit_income_basic_pay", 'Basic Pay', 'trim|xss_clean');
			$this->form_validation->set_rules("edit_income_overtime", 'Overtime', 'trim|xss_clean');
			$this->form_validation->set_rules("edit_income_fixed_allowance", 'Fixed Allowances', 'trim|xss_clean');
			$this->form_validation->set_rules("edit_income_hpp", 'HPP', 'trim|xss_clean');
			$this->form_validation->set_rules("edit_income_nsd", 'NSD', 'trim|xss_clean');
			$this->form_validation->set_rules("edit_income_commission", 'Commission', 'trim|xss_clean');
			$this->form_validation->set_rules("edit_income_piece_rate_pay", 'Piece Rate Pay', 'trim|xss_clean');
			
			if ($this->form_validation->run()==true){
				
				$income_id = $this->input->post('edit_income_id');
				$income_basic_pay = $this->input->post('edit_income_basic_pay');
				$income_overtime = $this->input->post('edit_income_overtime');
				$income_fixed_allowance = $this->input->post('edit_income_fixed_allowance');
				$income_hpp = $this->input->post('edit_income_hpp');
				$income_nsd = $this->input->post('edit_income_nsd');
				$income_commission = $this->input->post('edit_income_commission');
				$income_piece_rate_pay = $this->input->post('edit_income_piece_rate_pay');
				
				$basic_pay = ($income_basic_pay == "" || $income_basic_pay == NULL) ? "No" : $income_basic_pay;
				$overtime=($income_overtime == "" || $income_overtime == NULL) ? "No" : $income_overtime;
				$fixed_allowance=($income_fixed_allowance == "" || $income_fixed_allowance == NULL) ? "No" : $income_fixed_allowance;
				$holiday_premium_pay=($income_hpp == "" || $income_hpp == NULL) ? "No" : $income_hpp;
				$night_shift_differential=($income_nsd == "" || $income_nsd == NULL) ? "No" : $income_nsd;
				$commission=($income_commission == "" || $income_commission == NULL) ? "No" : $income_commission;
				$piece_rate_pay=($income_piece_rate_pay == "" || $income_piece_rate_pay == NULL) ? "No" : $income_piece_rate_pay;
				
				$this->income->update_income(
					$income_id,$basic_pay,$overtime,$fixed_allowance,$holiday_premium_pay,$night_shift_differential,$commission,$piece_rate_pay,$this->company_id
				);
				$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully updated!</div>');
				redirect($this->url);
			}
		}
		
		// data
		$this->layout->view('pages/payroll_setup/income_view',$data);
	}
	
}

/* End of file */