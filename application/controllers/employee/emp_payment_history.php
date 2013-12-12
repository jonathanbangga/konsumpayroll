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
			/* $this->load->model('konsumglobal_jmodel','jmodel');
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
			
			$this->theme = $this->config->item('jb_employee_temp');
			$this->menu = $this->config->item('jb_employee_menu');
			$this->company_id = 2;
			$this->emp_id = 78; */
 			
			$this->menu = $this->config->item('company_dashboard_menu');
			$this->load->model('konsumglobal_jmodel','jmodel');
			$this->load->model('employee/employee_model','employee');
			$this->company_id = 2;
			$this->emp_id = 78;
			
			$this->url = "/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3);
			$this->theme = $this->config->item('jb_employee_temp');
			$this->menu = $this->config->item('jb_employee_menu');
			
			$this->loan_no = $this->uri->segment(5);
		}
		
		/**
		 * index page
		 */
		public function index() {
			
			$check_emp_loan_id = $this->employee->check_amortization_sched_id($this->loan_no,$this->company_id);
			if($check_emp_loan_id == FALSE){
				show_error("Invalid parameter");
				return false;
			}
			
			$data['page_title'] = "Payment History";
			
			$data['emp_payment_history'] = $this->employee->emp_payment_history($this->company_id, $this->loan_no);
			
			// Total Principal Amortization Schedule
			$data['total_princiapl_amortization'] = $this->employee->total_princiapl_amortization($this->loan_no,$this->company_id);
			
			// Employee Loan Amount
			$data['loan_amount'] = $this->employee->loan_amount($this->loan_no,$this->company_id);
			
			$query = $this->employee->emp_loan_no_group($this->company_id, $this->loan_no);
			$data['emp_info'] = $query;
			
			// Get Interest and Principal Value
			$loan_id = $this->loan_no;
			$get_kapila_ka_row = $this->employee->kapila_ka_row_interest_principal($loan_id, $this->company_id); 
			$get_interest_principal = $this->employee->get_interest_principal($loan_id, $get_kapila_ka_row, $this->company_id);
			if($get_interest_principal != FALSE){
				$data['interest'] = $get_interest_principal->interest;
				$data['principal'] = $get_interest_principal->principal;
			}
			
			// Remaining Cash Amount
			$debit_amount = $this->employee->payment_debit_amount($this->loan_no, $this->company_id);
			$data['debit_amount'] = $debit_amount;
			
			$this->layout->set_layout($this->theme);
			$this->layout->view('pages/employee/emp_payment_history_view', $data);
		}
	
	}

/* End of file Emp_payment_history.php */
/* Location: ./application/controllers/employee/Emp_payment_history.php */