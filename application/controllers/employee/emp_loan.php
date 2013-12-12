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
			$this->load->model('konsumglobal_jmodel','jmodel');
			$this->load->model('employee/employee_model','employee');
			$this->company_id = 2;
			$this->emp_id = 78;
			
			$this->url = "/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3);
			$this->theme = $this->config->item('jb_employee_temp');
			$this->menu = $this->config->item('jb_employee_menu');
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "Loan History";
			$data['loan'] = $this->employee->loans($this->company_id,$this->emp_id);
			$data['loan_type'] = $this->employee->loan_type($this->company_id);
			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/employee/loan_table_view', $data);
		}
	
	}

/* End of file emp_loan.php */
/* Location: ./application/controllers/employee/emp_loan.php */