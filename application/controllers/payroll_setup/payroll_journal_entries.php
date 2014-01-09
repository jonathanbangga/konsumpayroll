<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payroll_journal_entries extends CI_Controller {
	
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
		$this->load->model('payroll_setup/payroll_journal_entries_model','pj_entries');
		$this->load->model('konsumglobal_jmodel','jmodel');
		
		$this->url = "/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$this->uri->segment(4);
		$this->company_id = $this->session->userdata('company_id');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Payroll Journal Entries";
		
		$data['earnings'] = $this->pj_entries->earnings($this->company_id);
		$data['government_contributions'] = $this->pj_entries->government_contributions($this->company_id);
		
		$data['expense_reim'] = $this->pj_entries->expense_reim($this->company_id);
		$data['other_deduction'] = $this->pj_entries->other_deduction($this->company_id);
		$data['with_tax_others'] = $this->pj_entries->with_tax_others($this->company_id);
		
		if($this->input->post('save')){
			
			// form validation for earnings
			foreach($this->input->post('earnings') as $key=>$val){
				$this->form_validation->set_rules("earnings[{$key}]", 'Earnings', 'trim|required|xss_clean');
				$this->form_validation->set_rules("earnings_account_code[{$key}]", 'Earnings Account Code', 'trim|required|xss_clean');
				$this->form_validation->set_rules("earnings_description[{$key}]", 'Earnings Description', 'trim|required|xss_clean');
			}
			
			// form validation for Government Contributions
			foreach($this->input->post('government_contributions') as $key=>$val){
				$this->form_validation->set_rules("government_contributions[{$key}]", 'Government Contributions', 'trim|required|xss_clean');
				$this->form_validation->set_rules("government_contributions_account_code[][{$key}]", 'Government Contributions Account Code', 'trim|required|xss_clean');
				$this->form_validation->set_rules("government_contributions_description[{$key}]", 'Government Contributions Description', 'trim|required|xss_clean');
			}
			
			// form validation for Expense Reimbursement
			foreach($this->input->post('expense_reimbursement_account_code') as $key=>$val){
				$this->form_validation->set_rules("expense_reimbursement_account_code[][{$key}]", 'Expense Reimbursement Account Code', 'trim|required|xss_clean');
				$this->form_validation->set_rules("expense_reimbursement_description[{$key}]", 'Expense Reimbursement Description', 'trim|required|xss_clean');
			}
			
			// form validation for Other Deductions
			foreach($this->input->post('other_deductions') as $key=>$val){
				$this->form_validation->set_rules("other_deductions[][{$key}]", 'Other Deductions', 'trim|required|xss_clean');
				$this->form_validation->set_rules("other_deductions_account_code[][{$key}]", 'Other Deductions Account Code', 'trim|required|xss_clean');
				$this->form_validation->set_rules("other_deductions_description[{$key}]", 'Other Deductions Description', 'trim|required|xss_clean');
			}
			
			// form validation for Other Deductions With Tax
			foreach($this->input->post('witholding_tax') as $key=>$val){
				$this->form_validation->set_rules("witholding_tax[][{$key}]", 'Witholding Tax', 'trim|required|xss_clean');
				$this->form_validation->set_rules("witholding_tax_account_code[][{$key}]", 'Witholding Tax Account Code', 'trim|required|xss_clean');
				$this->form_validation->set_rules("witholding_tax_description[{$key}]", 'Witholding Tax Description', 'trim|required|xss_clean');
			}
				
			if ($this->form_validation->run()==true){
				
				// variables for earnings
				$earnings = $this->input->post('earnings');
				$earnings_account_code = $this->input->post('earnings_account_code');
				$earnings_description = $this->input->post('earnings_description');
				
				foreach($this->input->post('earnings') as $save=>$val){
					// save earnings information
					$save_earnings = array(
						"earnings" => $earnings[$save],
						"account_code" => $earnings_account_code[$save],
						"description" => $earnings_description[$save],
						"comp_id" => $this->company_id
					);
					
					$save_earnings_sql = $this->jmodel->insert_data('payroll_journal_entries_earnings', $save_earnings);
				}
				
				// =====================
				
				// variables for Government Contributions
				$government_contributions = $this->input->post('government_contributions');
				$government_contributions_account_code = $this->input->post('government_contributions_account_code');
				$government_contributions_description = $this->input->post('government_contributions_description');
				
				foreach($this->input->post('government_contributions') as $save=>$val){
					// save Government Contributions information
					$save_government_contributions = array(
						"government_contributions" => $government_contributions[$save],
						"account_code" => $government_contributions_account_code[$save],
						"description" => $government_contributions_description[$save],
						"comp_id" => $this->company_id
					);
					
					$save_government_contributions_sql = $this->jmodel->insert_data('payroll_journal_entries_government_contributions', $save_government_contributions);
				}
				
				// =====================
				
				// variables for Expense Reimbursement
				$expense_reimbursement_account_code = $this->input->post('expense_reimbursement_account_code');
				$expense_reimbursement_description = $this->input->post('expense_reimbursement_description');
				
				foreach($this->input->post('expense_reimbursement_account_code') as $save=>$val){
					// save Expense Reimbursement information
					$save_expense_reimbursement = array(
						"expense_reimbursement" => "",
						"account_code" => $expense_reimbursement_account_code[$save],
						"description" => $expense_reimbursement_description[$save],
						"comp_id" => $this->company_id
					);
					
					$save_expense_reimbursement_sql = $this->jmodel->insert_data('payroll_journal_entries_expense_reimbursement', $save_expense_reimbursement);
				}
				
				// =====================
				
				// variables for Other Deductions
				$other_deductions = $this->input->post('other_deductions');
				$other_deductions_account_code = $this->input->post('other_deductions_account_code');
				$other_deductions_description = $this->input->post('other_deductions_description');
				
				foreach($this->input->post('other_deductions') as $save=>$val){
					// save other deductions information
					$save_other_deductions = array(
						"other_deductions" => $other_deductions[$save],
						"account_code" => $other_deductions_account_code[$save],
						"description" => $other_deductions_description[$save],
						"comp_id" => $this->company_id
					);
					
					$save_other_deductions_sql = $this->jmodel->insert_data('payroll_journal_entries_other_deductions', $save_other_deductions);
				}
				
				// =====================
				
				// variables for Other Deductions witholding tax
				$witholding_tax = $this->input->post('witholding_tax');
				$witholding_tax_account_code = $this->input->post('witholding_tax_account_code');
				$witholding_tax_description = $this->input->post('witholding_tax_description');
				
				foreach($this->input->post('witholding_tax') as $save=>$val){
					// save witholding_tax information
					$save_witholding_tax = array(
						"others" => $witholding_tax[$save],
						"account_code" => $witholding_tax_account_code[$save],
						"description" => $witholding_tax_description[$save],
						"comp_id" => $this->company_id
					);
					
					$save_witholding_tax_sql = $this->jmodel->insert_data('payroll_journal_entries_witholding_tax', $save_witholding_tax);
				}
				
				$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully saved!</div>');
				redirect($this->url);
			}
		}
		
		// edit information
		if($this->input->post('update')){
			
			// form validation for earnings
			foreach($this->input->post('earnings') as $key=>$val){
				$this->form_validation->set_rules("earnings_id[{$key}]", 'Earnings ID', 'trim|required|xss_clean');
				$this->form_validation->set_rules("earnings[{$key}]", 'Earnings', 'trim|required|xss_clean');
				$this->form_validation->set_rules("earnings_account_code[{$key}]", 'Earnings Account Code', 'trim|required|xss_clean');
				$this->form_validation->set_rules("earnings_description[{$key}]", 'Earnings Description', 'trim|required|xss_clean');
			}
			
			// form validation for Government Contributions
			foreach($this->input->post('government_contributions') as $key=>$val){
				$this->form_validation->set_rules("government_contributions_id[{$key}]", 'Government Contributions ID', 'trim|required|xss_clean');
				$this->form_validation->set_rules("government_contributions[{$key}]", 'Government Contributions', 'trim|required|xss_clean');
				$this->form_validation->set_rules("government_contributions_account_code[{$key}]", 'Government Contributions Account Code', 'trim|required|xss_clean');
				$this->form_validation->set_rules("government_contributions_description[{$key}]", 'Government Contributions Description', 'trim|required|xss_clean');
			}
			
			// form validation for Expense Reimbursement
			foreach($this->input->post('expense_reim_account_code') as $key=>$val){
				$this->form_validation->set_rules("expense_reim_id[{$key}]", 'Expense Reimbursement ID', 'trim|required|xss_clean');
				$this->form_validation->set_rules("expense_reim_account_code[{$key}]", 'Expense Reimbursement Account Code', 'trim|required|xss_clean');
				$this->form_validation->set_rules("expense_reim_description[{$key}]", 'Expense Reimbursement Description', 'trim|required|xss_clean');
			}
			
			if($this->input->post('new_expense_reimbursement_account_code')){
				// form validation for Expense Reimbursement add new row
				foreach($this->input->post('new_expense_reimbursement_account_code') as $key=>$val){
					$this->form_validation->set_rules("new_expense_reimbursement_account_code[][{$key}]", 'Expense Reimbursement Account Code', 'trim|required|xss_clean');
					$this->form_validation->set_rules("new_expense_reimbursement_description[{$key}]", 'Expense Reimbursement Description', 'trim|required|xss_clean');
				}
			}
			
			// form validation for Other Deductions
			foreach($this->input->post('other_deductions') as $key=>$val){
				$this->form_validation->set_rules("other_deductions_id[{$key}]", 'Other Deductions', 'trim|required|xss_clean');
				$this->form_validation->set_rules("other_deductions[{$key}]", 'Other Deductions', 'trim|required|xss_clean');
				$this->form_validation->set_rules("other_deductions_account_code[{$key}]", 'Other Deductions Account Code', 'trim|required|xss_clean');
				$this->form_validation->set_rules("other_deductions_description[{$key}]", 'Other Deductions Description', 'trim|required|xss_clean');
			}
			
			if($this->input->post('new_other_deductions')){
				// form validation for Other Deductions
				foreach($this->input->post('new_other_deductions') as $key=>$val){
					$this->form_validation->set_rules("new_other_deductions[][{$key}]", 'Other Deductions', 'trim|required|xss_clean');
					$this->form_validation->set_rules("new_other_deductions_account_code[][{$key}]", 'Other Deductions Account Code', 'trim|required|xss_clean');
					$this->form_validation->set_rules("new_other_deductions_description[{$key}]", 'Other Deductions Description', 'trim|required|xss_clean');
				}
			}
			
			// form validation for Other Deductions With Tax
			foreach($this->input->post('witholding_tax') as $key=>$val){
				$this->form_validation->set_rules("witholding_tax_id[{$key}]", 'Witholding Tax', 'trim|required|xss_clean');
				$this->form_validation->set_rules("witholding_tax[{$key}]", 'Witholding Tax', 'trim|required|xss_clean');
				$this->form_validation->set_rules("witholding_tax_account_code[{$key}]", 'Witholding Tax Account Code', 'trim|required|xss_clean');
				$this->form_validation->set_rules("witholding_tax_description[{$key}]", 'Witholding Tax Description', 'trim|required|xss_clean');
			}
			
			if($this->input->post('new_witholding_tax')){
				// form validation for Other Deductions With Tax add new row
				foreach($this->input->post('new_witholding_tax') as $key=>$val){
					$this->form_validation->set_rules("new_witholding_tax[][{$key}]", 'Witholding Tax', 'trim|required|xss_clean');
					$this->form_validation->set_rules("new_witholding_tax_account_code[][{$key}]", 'Witholding Tax Account Code', 'trim|required|xss_clean');
					$this->form_validation->set_rules("new_witholding_tax_description[{$key}]", 'Witholding Tax Description', 'trim|required|xss_clean');
				}
			}
			
			if ($this->form_validation->run()==true){
					
				// variables for earnings
				$earnings_id = $this->input->post('earnings_id');
				$earnings = $this->input->post('earnings');
				$earnings_account_code = $this->input->post('earnings_account_code');
				$earnings_description = $this->input->post('earnings_description');
				
				foreach($this->input->post('earnings') as $update=>$val){
					// update earnings information
					$update_earnings_sql = $this->pj_entries->update_earnings_sql(
						$earnings_id[$update],$earnings[$update],$earnings_account_code[$update],$earnings_description[$update],$this->company_id
					);
				}
				
				/* ================= */
				
				// variables for Government Contributions
				$government_contributions_id = $this->input->post('government_contributions_id');
				$government_contributions = $this->input->post('government_contributions');
				$government_contributions_account_code = $this->input->post('government_contributions_account_code');
				$government_contributions_description = $this->input->post('government_contributions_description');
				
				foreach($this->input->post('government_contributions') as $update=>$val){
					// update Government Contributions information
					$update_government_contributions_sql = $this->pj_entries->update_government_contributions_sql(
						$government_contributions_id[$update],$government_contributions[$update],$government_contributions_account_code[$update],$government_contributions_description[$update],$this->company_id
					);
				}
				
				/* ================= */
				
				// variables for Expense Reimbursement
				$expense_reim_id = $this->input->post('expense_reim_id');
				$expense_reim_account_code = $this->input->post('expense_reim_account_code');
				$expense_reim_description = $this->input->post('expense_reim_description');
				
				foreach($this->input->post('expense_reim_account_code') as $update=>$val){
					// update Expense Reimbursement information
					$update_expense_reim_sql = $this->pj_entries->update_expense_reim_sql(
						$expense_reim_id[$update],$expense_reim_account_code[$update],$expense_reim_description[$update],$this->company_id
					);
				}

				if($this->input->post('new_expense_reimbursement_account_code')){
					// variables for Expense Reimbursement add new row
					$new_expense_reimbursement_account_code = $this->input->post('new_expense_reimbursement_account_code');
					$new_expense_reimbursement_description = $this->input->post('new_expense_reimbursement_description');
					
					foreach($this->input->post('new_expense_reimbursement_account_code') as $save=>$val){
						// save Expense Reimbursement information
						$new_save_expense_reimbursement = array(
							"expense_reimbursement" => "",
							"account_code" => $new_expense_reimbursement_account_code[$save],
							"description" => $new_expense_reimbursement_description[$save],
							"comp_id" => $this->company_id
						);
						
						$this->jmodel->insert_data('payroll_journal_entries_expense_reimbursement', $new_save_expense_reimbursement);
					}
				}
				
				// =====================
				
				// variables for Other Deductions
				$other_deductions_id = $this->input->post('other_deductions_id');
				$other_deductions = $this->input->post('other_deductions');
				$other_deductions_account_code = $this->input->post('other_deductions_account_code');
				$other_deductions_description = $this->input->post('other_deductions_description');
				
				foreach($this->input->post('other_deductions') as $update=>$val){
					// update Other Deductions information
					$update_other_deductions_sql = $this->pj_entries->update_other_deductions_sql(
						$other_deductions_id[$update],$other_deductions[$update],$other_deductions_account_code[$update],$other_deductions_description[$update],$this->company_id
					);
				}
				
				if($this->input->post('new_other_deductions')){
					// variables for Other Deductions add new row
					$new_other_deductions = $this->input->post('new_other_deductions');
					$new_other_deductions_account_code = $this->input->post('new_other_deductions_account_code');
					$new_other_deductions_description = $this->input->post('new_other_deductions_description');
					
					foreach($this->input->post('new_other_deductions') as $save=>$val){
						// save other deductions information add new row
						$new_save_other_deductions = array(
							"other_deductions" => $new_other_deductions[$save],
							"account_code" => $new_other_deductions_account_code[$save],
							"description" => $new_other_deductions_description[$save],
							"comp_id" => $this->company_id
						);
						
						$this->jmodel->insert_data('payroll_journal_entries_other_deductions', $new_save_other_deductions);
					}
				}
				
				// =====================
				
				// variables for Other Deductions witholding tax
				$witholding_tax_id = $this->input->post('witholding_tax_id');
				$witholding_tax = $this->input->post('witholding_tax');
				$witholding_tax_account_code = $this->input->post('witholding_tax_account_code');
				$witholding_tax_description = $this->input->post('witholding_tax_description');
				
				foreach($this->input->post('witholding_tax') as $update=>$val){
					// update Other Deductions witholding tax information
					$update_with_tax_sql = $this->pj_entries->update_with_tax_sql(
						$witholding_tax_id[$update],$witholding_tax[$update],$witholding_tax_account_code[$update],$witholding_tax_description[$update],$this->company_id
					);
				}
				
				if($this->input->post('new_witholding_tax')){
					// variables for Other Deductions witholding tax add new row
					$new_witholding_tax = $this->input->post('new_witholding_tax');
					$new_witholding_tax_account_code = $this->input->post('new_witholding_tax_account_code');
					$new_witholding_tax_description = $this->input->post('new_witholding_tax_description');
					
					foreach($this->input->post('new_witholding_tax') as $save=>$val){
						// save witholding_tax information add new row
						$new_save_witholding_tax = array(
							"others" => $new_witholding_tax[$save],
							"account_code" => $new_witholding_tax_account_code[$save],
							"description" => $new_witholding_tax_description[$save],
							"comp_id" => $this->company_id
						);
						
						$this->jmodel->insert_data('payroll_journal_entries_witholding_tax', $new_save_witholding_tax);
					}
				}
				
				$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully updated!</div>');
				redirect($this->url);
			}
		}
		
		if($this->input->is_ajax_request()) {
			// delete Expense Reimbursement information
			if($this->input->post('delete_expense_reim')){
				$expense_reim_id = $this->input->post('expense_reim_id');
				$del_expense_reim = $this->pj_entries->del_expense_reim($expense_reim_id,$this->company_id);
				if($del_expense_reim){
					$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully deleted!</div>');
					echo json_encode(array("success"=>1,"url"=>$this->url));
					return false;
				}else{
					echo json_encode(array("success"=>0));
					return false;
				}
			}
			
			// delete Other Deductions information
			if($this->input->post('delete_other_deduction')){
				$other_deduction_id = $this->input->post('other_deduction_id');
				$del_other_deduction = $this->pj_entries->del_other_deduction($other_deduction_id,$this->company_id);
				if($del_other_deduction){
					$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully deleted!</div>');
					echo json_encode(array("success"=>1,"url"=>$this->url));
					return false;
				}else{
					echo json_encode(array("success"=>0));
					return false;
				}
			}
			
			// delete Other Witholding tax information
			if($this->input->post('delete_with_tax_others')){
				$with_tax_others_id = $this->input->post('with_tax_others_id');
				$del_with_tax_others = $this->pj_entries->del_with_tax_others($with_tax_others_id,$this->company_id);
				if($del_with_tax_others){
					$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully deleted!</div>');
					echo json_encode(array("success"=>1,"url"=>$this->url));
					return false;
				}else{
					echo json_encode(array("success"=>0));
					return false;
				}
			}
		}
		
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		$this->layout->view('pages/payroll_setup/payroll_journal_entries_view',$data);
	}
	
}

/* End of file */