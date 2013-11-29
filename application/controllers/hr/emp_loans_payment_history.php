<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Loans Payment History Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_loans_payment_history extends CI_Controller {
		
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
			$this->company_id = 1;
			
			$this->sidebar_menu = 'content_holders/hr_employee_sidebar_menu';
			$this->menu = 'content_holders/company_menu';
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "Loans Payment History";
			$data['sidebar_menu'] = $this->sidebar_menu;
			
			$data['emp_loan'] = $this->hr_emp->emp_loan($this->company_id);
			$this->layout->set_layout($this->theme);
			$this->layout->view('pages/hr/emp_loans_payment_history_view', $data);
		}
	
	}

/* End of file Emp_amortization_schedule.php */
/* Location: ./application/controllers/hr/Emp_amortization_schedule.php */