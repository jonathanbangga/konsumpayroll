<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Loan Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_loan extends CI_Controller {
		
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
			$this->theme = $this->config->item('default');
			$this->load->model('konsumglobal_jmodel','jmodel');
			$this->load->model('hr/hr_employee_model','hr_emp');
			$this->emp_id = $this->uri->segment(5);
			$this->sidebar_menu = 'content_holders/hr_employee_sidebar_menu';
			$this->menu = 'content_holders/company_menu';
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
			
			$check_employee_id = $this->hr_emp->check_emp_loan_id($this->uri->segment(5),$this->company_id);
			if($check_employee_id == FALSE){
				show_error("Invalid employee");
				return false;
			}
			
			$data['page_title'] = "Add Loans";
			$data['sidebar_menu'] = $this->sidebar_menu;
			
			// init pagination
			$uri = "/{$this->uri->segment(1)}/hr/emp_loan/index/{$this->emp_id}/";
			$total_rows = $this->hr_emp->emp_loan_counter($this->company_id, $this->emp_id);
			$per_page = $this->config->item('per_page');
			$segment=6;
			
			init_pagination($uri,$total_rows,$per_page,$segment);

			$page = (!$this->uri->segment(6) || $this->uri->segment(6) == 1) ? 0 : $this->uri->segment(6);
			$data["links"] = $this->pagination->create_links();
			// end pagination
			
			$data['emp_loan'] = $this->hr_emp->emp_loan($per_page, $page, $this->company_id, $this->emp_id);

			$query = $this->hr_emp->emp_loan_info($this->company_id, $this->emp_id);
			$data['fullname'] = ucwords($query->first_name)." ".ucwords($query->last_name);
			$data['payroll_cloud_id'] = $query->payroll_cloud_id;
			$data['emp_id'] = $query->emp_id;
			
			$data['loan_type'] = $this->hr_emp->loan_type_rec($this->company_id, $this->emp_id);
			
			$employee = $this->hr_emp->view_emp_loan($this->company_id);
			$results = "";
			if($employee != FALSE){
				foreach($employee as $row){
					$results .= "{label:'".ucwords($row->first_name)." ".ucwords($row->last_name)."',emp_no:'{$row->payroll_cloud_id}',emp_id:'{$row->emp_id}'},";
				}	
			}
			$data['employee'] = $results;
			
			if($this->input->post('add')){
				$emp_id = $this->input->post('emp_id');
				$loan_no = $this->input->post('loan_no');
				$loan_type = $this->input->post('loan_type'); 
				$date_granted = $this->input->post('date_granted');
				$principal = $this->input->post('principal');
				$terms = $this->input->post('terms');
				$interest_rate = $this->input->post('interest_rate');
				$penalty_rate = $this->input->post('penalty_rate');
				$beginning_balance = $this->input->post('beginning_balance');
				$bank_route = $this->input->post('bank_route');
				$bank_account = $this->input->post('bank_account');
				$account_type = $this->input->post('account_type');
				$monthly_amortization = $this->input->post('monthly_amortization');
				
				foreach($emp_id as $key2=>$val){
					$this->form_validation->set_rules("emp_id[{$key2}]", 'Employee ID', 'trim|required|xss_clean');
					$this->form_validation->set_rules("loan_no[{$key2}]", 'Loan Number', 'trim|required|xss_clean');
					$this->form_validation->set_rules("loan_type[{$key2}]", 'Loan Type', 'trim|required|xss_clean');
					$this->form_validation->set_rules("date_granted[{$key2}]", 'Date Granted', 'trim|required|xss_clean');
					$this->form_validation->set_rules("principal[{$key2}]", 'Pricipal', 'trim|required|xss_clean');
					$this->form_validation->set_rules("terms[{$key2}]", 'Terms', 'trim|required|xss_clean');
					$this->form_validation->set_rules("interest_rate[{$key2}]", 'Interest Rate', 'trim|required|xss_clean');
					$this->form_validation->set_rules("penalty_rate[{$key2}]", 'Penalty Rate', 'trim|required|xss_clean');
					$this->form_validation->set_rules("beginning_balance[{$key2}]", 'Beginning Balance', 'trim|required|xss_clean');
					$this->form_validation->set_rules("bank_route[{$key2}]", 'Bank Route', 'trim|required|xss_clean');
					$this->form_validation->set_rules("bank_account[{$key2}]", 'Bank Account', 'trim|required|xss_clean');
					$this->form_validation->set_rules("account_type[{$key2}]", 'Account Type', 'trim|required|xss_clean');
					$this->form_validation->set_rules("monthly_amortization[{$key2}]", 'Monthly Amortization', 'trim|required|xss_clean');
				}
				
				if ($this->form_validation->run()==true){
					
					foreach($emp_id as $key=>$val){
                	    $add_emp_loan = array(	
							'emp_id' => $emp_id[$key],
							'company_id' => $this->company_id,
							'loan_no' => $loan_no[$key],
							'loan_type_id' => $loan_type[$key],
							'date_granted' => $date_granted[$key],
                	    	'principal' => $principal[$key],
                	    	'terms' => $terms[$key],
                	    	'interest_rates' => $interest_rate[$key],
                	    	'penalty_rates' => $penalty_rate[$key],
                	    	'beginning_balance' => $beginning_balance[$key],
                	    	'bank_route' => $bank_route[$key],
                	    	'bank_account' => $bank_account[$key],
                	    	'account_type' => $account_type[$key],
                	    	'monthly_amortization' => $monthly_amortization[$key]
						);

						$insert_emp_loan = $this->jmodel->insert_data('employee_loans',$add_emp_loan);
					}

					$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully saved!</div>');
					redirect($this->url);
					return false;
				}
			}
			
			if($this->input->post('update_info')){
				
				// Update Employee Loan Information
				$employee_loans_id_edit = $this->input->post('employee_loans_id_edit');
				$loan_no = $this->input->post('loan_no');
				//$loan_type = $this->input->post('loan_type'); 
				$date_granted = $this->input->post('date_granted');
				$principal = $this->input->post('principal');
				$terms = $this->input->post('terms');
				$interest_rate = $this->input->post('interest_rate');
				$penalty_rate = $this->input->post('penalty_rate');
				$beginning_balance = $this->input->post('beginning_balance');
				$bank_route = $this->input->post('bank_route');
				$bank_account = $this->input->post('bank_account');
				$account_type = $this->input->post('account_type');
				$monthly_amortization = $this->input->post('monthly_amortization');
				
				$this->form_validation->set_rules("employee_loans_id_edit", 'Employee Loan ID', 'trim|required|xss_clean');
				$this->form_validation->set_rules("loan_no", 'Loan Number', 'trim|required|xss_clean');
				//$this->form_validation->set_rules("loan_type", 'Loan Type', 'trim|required|xss_clean');
				$this->form_validation->set_rules("date_granted", 'Date Granted', 'trim|required|xss_clean');
				$this->form_validation->set_rules("principal", 'Pricipal', 'trim|required|xss_clean');
				$this->form_validation->set_rules("terms", 'Terms', 'trim|required|xss_clean');
				$this->form_validation->set_rules("interest_rate", 'Interest Rate', 'trim|required|xss_clean');
				$this->form_validation->set_rules("penalty_rate", 'Penalty Rate', 'trim|required|xss_clean');
				$this->form_validation->set_rules("beginning_balance", 'Beginning Balance', 'trim|required|xss_clean');
				$this->form_validation->set_rules("bank_route", 'Bank Route', 'trim|required|xss_clean');
				$this->form_validation->set_rules("bank_account", 'Bank Account', 'trim|required|xss_clean');
				$this->form_validation->set_rules("account_type", 'Account Type', 'trim|required|xss_clean');
				$this->form_validation->set_rules("monthly_amortization", 'Monthly Amortization', 'trim|required|xss_clean');
				
				if ($this->form_validation->run()==true){
					$update_info = $this->hr_emp->update_loan_info(
						$employee_loans_id_edit,
						$loan_no,
						//$loan_type, 
						$date_granted,
						$principal,
						$terms,
						$interest_rate,
						$penalty_rate,
						$beginning_balance,
						$bank_route,
						$bank_account,
						$account_type,
						$monthly_amortization,
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
				// Delete Employee Deduction Information
				if($this->input->post('delete_db')){
					$loan_id = $this->input->post('loan_id');
					$delete_me = $this->db->query("DELETE FROM employee_loans WHERE employee_loans_id = '{$loan_id}' and company_id = '{$this->company_id}'");
					if($delete_me){
						$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully deleted!</div>');
						echo json_encode(array("success"=>1,"url"=>$this->url));
						return false;
					}
				}
				
				// Get Information for Employee Loan Information
				if($this->input->post('get_information')){
					$employee_loans_id = $this->input->post('employee_loans_id');
					$get_info = $this->db->query("
						SELECT *FROM employee_loans el
						LEFT JOIN employee e ON el.emp_id = e.emp_id 
						WHERE el.employee_loans_id = '{$employee_loans_id}' and el.company_id = '{$this->company_id}'
					");
					if($get_info->num_rows() > 0){
						$get_info_row = $get_info->row();
						$get_info->free_result();
						echo json_encode(
							array(
								"success"=>1,
								"employee_loans_id"=>$get_info_row->employee_loans_id,
								"emp_id"=>$get_info_row->emp_id,
								"emp_name"=>ucwords($get_info_row->first_name)." ".ucwords($get_info_row->last_name),
								"loan_no"=>$get_info_row->loan_no,
								"loan_type"=>$get_info_row->loan_type_id,
								"date_granted"=>$get_info_row->date_granted,
								"principal"=>$get_info_row->principal,
								"terms"=>$get_info_row->terms,
								"interest_rates"=>$get_info_row->interest_rates,
								"penalty_rates"=>$get_info_row->penalty_rates,
								"beginning_balance"=>$get_info_row->beginning_balance,
								"bank_route"=>$get_info_row->bank_route,
								"bank_account"=>$get_info_row->bank_account,
								"account_type"=>$get_info_row->account_type,
								"monthly_amortization"=>$get_info_row->monthly_amortization,
								"company_id"=>$get_info_row->company_id
							)
						);
						return false;
					}else{
						echo json_encode(array("success"=>0));
						return false;
					}
				}
			}
			
			$this->layout->set_layout($this->theme);
			$this->layout->view('pages/hr/emp_loan_view', $data);
		}
	
	}

/* End of file Emp_loan.php */
/* Location: ./application/controllers/hr/Emp_loan.php */