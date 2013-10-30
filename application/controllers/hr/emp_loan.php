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
			$this->theme = $this->config->item('temp_company_wizard');
			$this->load->model('konsumglobal_jmodel','jmodel');
			$this->load->model('employee_model','employee');
			$this->company_id = 1;
			$this->emp_id = 3;
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "Loans";
			
			$data['loan'] = $this->employee->loans($this->company_id,$this->emp_id);
			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/employee/loan_table_view', $data);
		}
	
	}

/* End of file sss_tbl.php */
/* Location: ./application/controllers/hr/sss_tbl.php */