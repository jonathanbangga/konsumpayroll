<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Payroll Details Controller
 *
 * @category Employee Payroll Details
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_payroll extends CI_Controller {
		
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
			$this->load->model('employee/employee_model','employee');
			$this->load->model('konsumglobal_jmodel','jmodel');
			$this->emp_id = $this->uri->segment(5);
			
			$this->sidebar_menu = 'content_holders/company_sidebar_menu';
			$this->menu = 'content_holders/company_menu';
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "Payroll";
			$data['sidebar_menu'] =$this->sidebar_menu;
			$data['emp_payroll'] = $this->jmodel->display_data_where('employee','emp_id',$this->emp_id); 
			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/employee/payroll_view', $data);
		}
		
	}
	
/* End of file emp_payroll.php */
/* Location: ./application/controllers/hr/emp_payroll.php */