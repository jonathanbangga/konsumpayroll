<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deductions extends CI_Controller {
	
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
		$this->load->model('payroll_setup/deductions_model','deductions_model');	
		$this->load->model('konsumglobal_jmodel','jmodel');
		$this->url = "/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$this->uri->segment(4);
		$this->company_id = 2;#$this->session->userdata('company_id');
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Deductions";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		
		$data['payroll_group'] = $this->deductions_model->payroll_group($this->company_id);
		$data['other_deduction'] = $this->deductions_model->other_deduction($this->company_id);
		$data['deductions_payroll_group'] = $this->deductions_model->deductions_payroll_group($this->company_id);
		$data['income'] = $this->deductions_model->income_info($this->company_id);
		$data['adjustments'] = $this->deductions_model->adjustments_info($this->company_id);
		$data['comp_id'] = $this->company_id;
		
		if($this->input->post('save')){
			
			// form validation for Payroll Group
			foreach($this->input->post('deduction_payroll_group') as $key=>$val){
				$this->form_validation->set_rules("deduction_payroll_group[{$key}]", 'Payroll Group', 'trim|required|xss_clean');
				$this->form_validation->set_rules("deduction_sss[{$key}]", 'SSS', 'trim|required|xss_clean');
				$this->form_validation->set_rules("deduction_philhealth[{$key}]", 'PhilHealth', 'trim|required|xss_clean');
				$this->form_validation->set_rules("deduction_hdmf[{$key}]", 'HDMF', 'trim|required|xss_clean');
				$this->form_validation->set_rules("deduction_withholding_tax[{$key}]", 'Withholding Tax', 'trim|required|xss_clean');
			}
			
			// form validation for Income
			foreach($this->input->post('ded_income') as $key=>$val){
				$this->form_validation->set_rules("ded_income[{$key}]", 'Income', 'trim|required|xss_clean');
				$this->form_validation->set_rules("ded_income_basic_sss[{$key}]", 'Basic SSS', 'trim|required|xss_clean');
				$this->form_validation->set_rules("ded_income_basic_philhealth[{$key}]", 'Basic PhilHealth', 'trim|required|xss_clean');
				$this->form_validation->set_rules("ded_income_basic_hdmf[{$key}]", 'Basic HDMF', 'trim|required|xss_clean');
			}
			
			// form validation for Adjustments
			foreach($this->input->post('ded_adj') as $key=>$val){
				$this->form_validation->set_rules("ded_adj[{$key}]", 'Income', 'trim|required|xss_clean');
				$this->form_validation->set_rules("ded_adj_basic_sss[{$key}]", 'Basic SSS', 'trim|required|xss_clean');
				$this->form_validation->set_rules("ded_adj_basic_philhealth[{$key}]", 'Basic PhilHealth', 'trim|required|xss_clean');
				$this->form_validation->set_rules("ded_adj_basic_hdmf[{$key}]", 'Basic HDMF', 'trim|required|xss_clean');
			}
			
			// form validation for Other Deduction Payroll Group
			/* foreach($this->input->post('payroll_group_input_other_dd_id') as $key=>$val){
				$this->form_validation->set_rules("payroll_group_input_other_dd_id[{$key}]", 'Other Deduction Payroll Group ID', 'trim|required|xss_clean');
				$this->form_validation->set_rules("payroll_group_input_other_dd[{$key}]", 'Other Deduction Payroll Group', 'trim|xss_clean');
			} */
			
			if ($this->form_validation->run()==true){
				
				$deduction_payroll_group = $this->input->post('deduction_payroll_group');
				$deduction_sss = $this->input->post('deduction_sss');
				$deduction_philhealth = $this->input->post('deduction_philhealth');
				$deduction_hdmf = $this->input->post('deduction_hdmf');
				$deduction_withholding_tax = $this->input->post('deduction_withholding_tax');
				
				foreach($this->input->post('deduction_payroll_group') as $save=>$val){
					$save_deduction = array(
					 	"payroll_group_id" => $deduction_payroll_group[$save],
						"sss" => $deduction_sss[$save],
						"philhealth" => $deduction_philhealth[$save],
						"hdmf" => $deduction_hdmf[$save],
						"withholding_tax" => $deduction_withholding_tax[$save],
						"comp_id" => $this->company_id
					);
					
					$this->jmodel->insert_data('deductions_payroll_group', $save_deduction);
				}
				
				// ============
				
				$ded_income = $this->input->post('ded_income');
				$ded_income_basic_sss = $this->input->post('ded_income_basic_sss');
				$ded_income_basic_philhealth = $this->input->post('ded_income_basic_philhealth');
				$ded_income_basic_hdmf = $this->input->post('ded_income_basic_hdmf');
				
				foreach($this->input->post('ded_income') as $save=>$val){
					$save_income = array(
						"income" => $ded_income[$save],
						"basis_for_sss" => $ded_income_basic_sss[$save],
						"basis_for_philhealth" => $ded_income_basic_philhealth[$save],
						"basis_for_hdmf" => $ded_income_basic_hdmf[$save],
						"comp_id" => $this->company_id
					);
					
					$this->jmodel->insert_data('deductions_income', $save_income);
				}
				
				// ============
				
				$ded_adj = $this->input->post('ded_adj');
				$ded_adj_basic_sss = $this->input->post('ded_adj_basic_sss');
				$ded_adj_basic_philhealth = $this->input->post('ded_adj_basic_philhealth');
				$ded_adj_basic_hdmf = $this->input->post('ded_adj_basic_hdmf');
				
				foreach($this->input->post('ded_adj') as $save=>$val){
					$save_adjustment = array(
						"adjustments" => $ded_adj[$save],
						"basis_for_sss" => $ded_adj_basic_sss[$save],
						"basis_for_philhealth" => $ded_adj_basic_philhealth[$save],
						"basis_for_hdmf" => $ded_adj_basic_hdmf[$save],
						"comp_id" => $this->company_id
					);
					
					$this->jmodel->insert_data('deductions_adjustments', $save_adjustment);
				}
				
				// ============
				
				/*
				$payroll_group_input_other_dd_id = $this->input->post('payroll_group_input_other_dd_id');
				$payroll_group_input_other_dd = $this->input->post('payroll_group_input_other_dd');
				
				foreach($this->input->post('payroll_group_input_other_dd_id') as $update=>$val){
					$new_payroll_group_input_other_dd = ($payroll_group_input_other_dd[$update] == "" || $payroll_group_input_other_dd[$update] == NULL) ? "No" : "Yes";
					$this->deductions_model->update_payroll_group_other_dd(
						$payroll_group_input_other_dd_id[$update],
						$new_payroll_group_input_other_dd,
						$this->company_id);
				}
				*/
				
				$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully saved!</div>');
				redirect($this->url);
				
			}
		}
		
		if($this->input->post('save_other_dd')){
			$this->form_validation->set_rules("other_deduction", 'Other Deduction', 'trim|required|xss_clean');
			if ($this->form_validation->run()==true){
				$other_deduction = $this->input->post('other_deduction');
				$save_other_dd = array(
					"name" => $other_deduction,
					"comp_id" => $this->company_id
				);
				
				$this->jmodel->insert_data('deductions_other_deductions', $save_other_dd);
				$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully saved!</div>');
				redirect($this->url);
			}
		}
		
		if($this->input->is_ajax_request()) {
			if($this->input->post('update_other_dd')){
				$id = $this->input->post('id');
				$new_payroll_group_input_other_dd = $this->input->post('view');
				$update_db = $this->deductions_model->update_payroll_group_other_dd(
					$id,
					$new_payroll_group_input_other_dd,
					$this->company_id);
					
				if($update_db){
					echo json_encode(array("success"=>1,"url"=>$this->url));
					return false;
				}else{
					echo json_encode(array("success"=>0));
					return false;
				}
			}
		}
		
		// update other deduction information
		if($this->input->post('update')){
			// form validation for Payroll Group
			foreach($this->input->post('deduction_payroll_group') as $key=>$val){
				$this->form_validation->set_rules("deduction_payroll_group[{$key}]", 'Payroll Group', 'trim|required|xss_clean');
				$this->form_validation->set_rules("deduction_sss[{$key}]", 'SSS', 'trim|required|xss_clean');
				$this->form_validation->set_rules("deduction_philhealth[{$key}]", 'PhilHealth', 'trim|required|xss_clean');
				$this->form_validation->set_rules("deduction_hdmf[{$key}]", 'HDMF', 'trim|required|xss_clean');
				$this->form_validation->set_rules("deduction_withholding_tax[{$key}]", 'Withholding Tax', 'trim|required|xss_clean');
			}
			
			// form validation for Income
			foreach($this->input->post('ded_income') as $key=>$val){
				$this->form_validation->set_rules("ded_income[{$key}]", 'Income', 'trim|required|xss_clean');
				$this->form_validation->set_rules("ded_income_basic_sss[{$key}]", 'Basic SSS', 'trim|required|xss_clean');
				$this->form_validation->set_rules("ded_income_basic_philhealth[{$key}]", 'Basic PhilHealth', 'trim|required|xss_clean');
				$this->form_validation->set_rules("ded_income_basic_hdmf[{$key}]", 'Basic HDMF', 'trim|required|xss_clean');
			}
			
			// form validation for Adjustments
			foreach($this->input->post('ded_adj') as $key=>$val){
				$this->form_validation->set_rules("ded_adj[{$key}]", 'Income', 'trim|required|xss_clean');
				$this->form_validation->set_rules("ded_adj_basic_sss[{$key}]", 'Basic SSS', 'trim|required|xss_clean');
				$this->form_validation->set_rules("ded_adj_basic_philhealth[{$key}]", 'Basic PhilHealth', 'trim|required|xss_clean');
				$this->form_validation->set_rules("ded_adj_basic_hdmf[{$key}]", 'Basic HDMF', 'trim|required|xss_clean');
			}
			
			if ($this->form_validation->run()==true){
				$deduction_payroll_group = $this->input->post('deduction_payroll_group');
				$deduction_sss = $this->input->post('deduction_sss');
				$deduction_philhealth = $this->input->post('deduction_philhealth');
				$deduction_hdmf = $this->input->post('deduction_hdmf');
				$deduction_withholding_tax = $this->input->post('deduction_withholding_tax');
				
				foreach($this->input->post('deduction_payroll_group') as $update=>$val){
					// update deduction payroll group
					$this->deductions_model->update_deduction_payroll_group(
						$deduction_payroll_group[$update], $deduction_sss[$update], $deduction_philhealth[$update], $deduction_hdmf[$update], $deduction_withholding_tax[$update], $this->company_id
					);
				}
				
				// ==================
				
				$ded_income = $this->input->post('ded_income');
				$ded_income_basic_sss = $this->input->post('ded_income_basic_sss');
				$ded_income_basic_philhealth = $this->input->post('ded_income_basic_philhealth');
				$ded_income_basic_hdmf = $this->input->post('ded_income_basic_hdmf');
				
				foreach($this->input->post('ded_income') as $update=>$val){
					$this->deductions_model->update_deduction_income(
						$ded_income[$update], $ded_income_basic_sss[$update], $ded_income_basic_philhealth[$update], $ded_income_basic_hdmf[$update], $this->company_id
					);
				}
				
				// ==================
				
				$ded_adj = $this->input->post('ded_adj');
				$ded_adj_basic_sss = $this->input->post('ded_adj_basic_sss');
				$ded_adj_basic_philhealth = $this->input->post('ded_adj_basic_philhealth');
				$ded_adj_basic_hdmf = $this->input->post('ded_adj_basic_hdmf');
				
				foreach($this->input->post('ded_adj') as $update=>$val){
					$this->deductions_model->update_deduction_adjustments(
						$ded_adj[$update], $ded_adj_basic_sss[$update], $ded_adj_basic_philhealth[$update], $ded_adj_basic_hdmf[$update], $this->company_id
					);
				}
				
				$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully updated!</div>');
				redirect($this->url);
			}
			
		}
		
		$this->layout->view('pages/payroll_setup/deductions_view',$data);
	}
	
}

/* End of file */