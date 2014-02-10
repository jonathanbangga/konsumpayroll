<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Payment History Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_payment_history extends CI_Controller {
		
		/**
		 * Theme options - default theme
		 * @var string
		 */
		var $theme;
		
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->authentication->check_if_logged_in();
			$this->theme = $this->config->item('default');
			$this->load->model('konsumglobal_jmodel','jmodel');
			$this->load->model('hr/hr_employee_model','hr_emp');
			$this->loan_no = $this->uri->segment(5);
			$this->sidebar_menu = 'content_holders/hr_employee_sidebar_menu';
			$this->menu = 'content_holders/user_hr_owner_menu';
			$this->url = $url = "/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5);

			$this->company_info = whose_company();
			
			if(count($this->company_info) == 0){
				show_error("Invalid subdomain");
				return false;
			}
			$this->company_id = $this->company_info->company_id;
		}
		
		/**
		 * index page
		 */
		public function index() {
			
			$check_emp_loan_id = $this->hr_emp->check_amortization_sched_id($this->loan_no,$this->company_id);
			if($check_emp_loan_id == FALSE){
				show_error("Invalid parameter");
				return false;
			}
			
			$data['page_title'] = "Payment History";
			$data['sidebar_menu'] = $this->sidebar_menu;
			
			// init pagination
			$uri = "/{$this->uri->segment(1)}/hr/emp_payment_history/index/{$this->loan_no}/";
			$total_rows = $this->hr_emp->emp_payment_history_counter($this->company_id, $this->loan_no);
			
			$per_page = $this->config->item('per_page');
			$segment=6;
			
			init_pagination($uri,$total_rows,$per_page,$segment);
	
			$page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
			$data["links"] = $this->pagination->create_links();
			// end pagination
			
			$data['emp_payment_history'] = $this->hr_emp->emp_payment_history($per_page, $page, $this->company_id, $this->loan_no);
			
			// Total Principal Amortization Schedule
			$data['total_princiapl_amortization'] = $this->hr_emp->total_princiapl_amortization($this->loan_no,$this->company_id);
			
			// Employee Loan Amount
			$data['loan_amount'] = $this->hr_emp->loan_amount($this->loan_no,$this->company_id);
			
			$query = $this->hr_emp->emp_loan_no_group($this->company_id, $this->loan_no);
			$data['emp_info'] = $query;
			
			// Get Interest and Principal Value
			$loan_id = $this->loan_no;
			$get_kapila_ka_row = $this->hr_emp->kapila_ka_row_interest_principal($loan_id, $this->company_id); 
			$get_interest_principal = $this->hr_emp->get_interest_principal($loan_id, $get_kapila_ka_row, $this->company_id);
			if($get_interest_principal != FALSE){
				$data['interest'] = $get_interest_principal->interest;
				$data['principal'] = $get_interest_principal->principal;
			}
			
			// Remaining Cash Amount
			$debit_amount = $this->hr_emp->payment_debit_amount($this->loan_no, $this->company_id);
			$data['debit_amount'] = $debit_amount;
			
			// Get last row for payment history
			$data['last_row_payment'] = $this->hr_emp->last_row_payment($this->company_id, $this->loan_no);
			
			if($this->input->post('add')){
				
				$loan_no = $this->input->post('loan_no');
				$payment = $this->input->post('payment');
				$interest = $this->input->post('interest');
				$principal = $this->input->post('principal');
				$penalty = $this->input->post('penalty');
				$installment_value = $this->input->post('installment_value');
				$remaining_cash_amount = $this->input->post('remaining_cash_amount');
				$amortization_schedule_group = $this->input->post('amortization_schedule_group');
				$employee_amortization_schedule_id = $this->input->post('employee_amortization_schedule_id');
				
				foreach($loan_no as $key2=>$val){
					$this->form_validation->set_rules("loan_no[{$key2}]", 'Loan No', 'trim|required|xss_clean');
					$this->form_validation->set_rules("payment[{$key2}]", 'Payment', 'trim|required|xss_clean');
					$this->form_validation->set_rules("interest[{$key2}]", 'Interest', 'trim|required|xss_clean');
					$this->form_validation->set_rules("principal[{$key2}]", 'Principal', 'trim|required|xss_clean');
					$this->form_validation->set_rules("penalty[{$key2}]", 'Penalty', 'trim|required|xss_clean');
					$this->form_validation->set_rules("installment_value[{$key2}]", 'Installment', 'trim|required|xss_clean');
					$this->form_validation->set_rules("remaining_cash_amount[{$key2}]", 'Remaining Cash Amount', 'trim|required|xss_clean');
					$this->form_validation->set_rules("amortization_schedule_group[{$key2}]", 'Amortization Group', 'trim|required|xss_clean');
					$this->form_validation->set_rules("employee_amortization_schedule_id[{$key2}]", 'Amortization Schedule ID', 'trim|required|xss_clean');
				}
				
				if ($this->form_validation->run()==true){
					
					foreach($loan_no as $key=>$val){
						#if($payment[$key] > ($interest[$key] + $principal[$key])){
							// $new_remaining_cash_amount = $payment[$key] - ($interest[$key] + $principal[$key] + $remaining_cash_amount[$key]);
							$new_remaining_cash_amount = ($payment[$key] + $remaining_cash_amount[$key]) - ($interest[$key] + $principal[$key]);
						#}else{
						#	$new_remaining_cash_amount = 0;
						#}
						
                	    $add_emp_payment_history = array(								
							'employee_loans_id' => $loan_no[$key],
                	    	'payment' => $payment[$key],
                	    	'interest' => $interest[$key],
							'principal' => $principal[$key],
                	    	'penalty' => $penalty[$key],
                	    	'remaining_cash_amount' => $new_remaining_cash_amount,
                	    	'employee_amortization_schedule_group'=>$amortization_schedule_group[$key],
                	    	'last_remaining_cash_amount'=>$remaining_cash_amount[$key],
                	    	'employee_amortization_schedule_id'=>$employee_amortization_schedule_id[$key],
                	    	'comp_id' => $this->company_id
						);

						$this->jmodel->insert_data('employee_payment_history',$add_emp_payment_history);
					}

					$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully saved!</div>');
					redirect($this->uri->uri_string());
					return false;
				}
			}
			
			if($this->input->post('update_info')){
				
				$employee_payment_history_id = $this->input->post('employee_payment_history_id');
				
				/*
				 $interest = $this->input->post('interest');
				$principal = $this->input->post('principal');
				$credit_balance_on_principal = $this->input->post('credit_balance_on_principal');
				$credit_balance_on_interest = $this->input->post('credit_balance_on_interest');
				$penalty = $this->input->post('penalty');
				
				$this->form_validation->set_rules("employee_payment_history_id", 'Employee Payment History ID', 'trim|required|xss_clean');
				$this->form_validation->set_rules("interest", 'Interest', 'trim|required|xss_clean');
				$this->form_validation->set_rules("principal", 'Principal', 'trim|required|xss_clean');
				$this->form_validation->set_rules("credit_balance_on_principal", 'Credit Balance on Principal', 'trim|required|xss_clean');
				$this->form_validation->set_rules("credit_balance_on_interest", 'Credit Balance on Interest', 'trim|required|xss_clean');
				$this->form_validation->set_rules("penalty", 'Penalty', 'trim|required|xss_clean');
				*/
				
				$payment = $this->input->post('payment');
				$interest = $this->input->post('interest');
				$principal = $this->input->post('principal');
				$penalty = $this->input->post('penalty');
				$remaining_cash_amount = $this->input->post('remaining_cash_amount');
				
				
				$this->form_validation->set_rules("employee_payment_history_id", 'Employee Payment History ID', 'trim|required|xss_clean');
				
				$this->form_validation->set_rules("payment", 'Payment', 'trim|required|xss_clean');
				$this->form_validation->set_rules("interest", 'Interest', 'trim|required|xss_clean');
				$this->form_validation->set_rules("principal", 'Principal', 'trim|required|xss_clean');
				$this->form_validation->set_rules("penalty", 'Penalty', 'trim|required|xss_clean');
				$this->form_validation->set_rules("remaining_cash_amount", 'Remaining Balance', 'trim|required|xss_clean');
				
				if ($this->form_validation->run()==true){
					/*$update_info = $this->hr_emp->update_payment_history(
						$employee_payment_history_id,
						$interest,
						$principal,
						$credit_balance_on_principal,
						$credit_balance_on_interest,
						$penalty,
						$this->company_id);*/
						
					// $new_remaining_cash_amount = $payment - ($interest + $principal + $remaining_cash_amount);
					$new_remaining_cash_amount = ($payment + $remaining_cash_amount) - ($interest + $principal);
					
					$update_info = $this->hr_emp->update_payment_history(
						$employee_payment_history_id,
						$payment,
						$penalty,
						$new_remaining_cash_amount,
						$this->company_id);
					if($update_info){
						$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully updated!</div>');
						echo json_encode(array("success"=>1));
						redirect($this->url);
						return false;
					}else{
						echo json_encode(array("success"=>0));
						return false;	
					}
				}else{
					$error = validation_errors('<span class="error_zone">','</span>');
					echo json_encode(array("success"=>"0","error_msg"=>$error));
					return false;
				}
			}
			
			if($this->input->is_ajax_request()) {
				// Delete Employee Payment History Information
				if($this->input->post('delete_db')){
					$loan_id = $this->input->post('loan_id');
					$delete_me = $this->db->query("DELETE FROM employee_payment_history WHERE employee_payment_history_id = '{$loan_id}' and comp_id = '{$this->company_id}'");
					if($delete_me){
						$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully deleted!</div>');
						echo json_encode(array("success"=>1,"url"=>$this->url));
						return false;
					}
				}
				
				// Get Information for Employee Payment History
				if($this->input->post('get_information')){
					$employee_payment_history_id = $this->input->post('employee_payment_history_id');
					$get_info = $this->db->query("
						SELECT *FROM employee_payment_history
						WHERE employee_payment_history_id = '{$employee_payment_history_id}' and comp_id = '{$this->company_id}'
					");
					if($get_info->num_rows() > 0){
						$get_info_row = $get_info->row();
						$get_info->free_result();
						echo json_encode(
							/*array(
								"success"=>1,
								"employee_payment_history_id"=>$get_info_row->employee_payment_history_id,
								"employee_loans_id"=>$get_info_row->employee_loans_id,
								"interest"=>$get_info_row->interest,
								"principal"=>$get_info_row->principal,
								"credit_balance_on_principal"=>$get_info_row->credit_balance_on_principal,
								"credit_balance_on_interest"=>$get_info_row->credit_balance_on_interest,
								"penalty"=>$get_info_row->penalty
							)*/
							array(
								"success"=>1,
								"payment"=>$get_info_row->payment,
								"employee_payment_history_id"=>$get_info_row->employee_payment_history_id,
								"employee_loans_id"=>$get_info_row->employee_loans_id,
								"interest"=>$get_info_row->interest,
								"principal"=>$get_info_row->principal,
								"penalty"=>$get_info_row->penalty,
								"remaining_cash_amount"=>$get_info_row->remaining_cash_amount,
								"last_remaining_cash_amount"=>$get_info_row->last_remaining_cash_amount
							)
						);
						return false;
					}else{
						echo json_encode(array("success"=>0));
						return false;
					}
				}
			}
			
			// add new amortization schedule
			if($this->input->post("add_new_amortization_sched")){
				print $this->loan_no;
				
				$create_new_amortization_schedule = $this->hr_emp->create_new_amortization_schedule($this->loan_no);
				print $create_new_amortization_schedule->employee_amortization_schedule_group + 1;
				
				p($this->input->post());
				
				$principal = $this->input->post('principal');
				$interest = $this->input->post('interest');
				$payroll_date = $this->input->post('payroll_date');
				$loan_amount_child = $this->input->post('loan_amount_child');
				$loan_id = $this->loan_no;
				$amortization_schedule_group_val = $create_new_amortization_schedule->employee_amortization_schedule_group + 1;
				
				$this->form_validation->set_rules("principal", 'Principal', 'trim|required|xss_clean');
				$this->form_validation->set_rules("interest", 'Interest', 'trim|required|xss_clean');
				$this->form_validation->set_rules("payroll_date", 'Payroll Date', 'trim|required|xss_clean');
				$this->form_validation->set_rules("loan_amount_child", 'Loan Amount Child', 'trim|required|xss_clean');
				
				if ($this->form_validation->run()==true){
					
					// insert new amortizatio schedule
					
					// payment, interest and principal value is equal to 0
					
					$insert_amortization_schedule_val = array(
						'payroll_date' => $payroll_date,
						'payment' => 0,
						'interest' => 0,
						'principal' => 0,
						'emp_loan_id' => $loan_id,
						'employee_amortization_schedule_group' => $amortization_schedule_group_val,
						'loan_amount_child' => $loan_amount_child,
						'comp_id' => $this->company_id
					);
	
					$this->jmodel->insert_data('employee_amortization_schedule',$insert_amortization_schedule_val);
	
					$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully saved!</div>');
					redirect($this->uri->segment(1)."/".$this->uri->segment(2)."/emp_amortization_schedule/index/".$loan_id);
						
					return false;
				}
			}
			
			$this->layout->set_layout($this->theme);
			$this->layout->view('pages/hr/emp_payment_history_view', $data);
		}
	
	}

/* End of file Emp_payment_history.php */
/* Location: ./application/controllers/hr/Emp_payment_history.php */