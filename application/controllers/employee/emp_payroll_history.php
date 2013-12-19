<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Payroll History Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_payroll_history extends CI_Controller {
		
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
			$this->menu = $this->config->item('company_dashboard_menu');
			$this->load->model('konsumglobal_jmodel','jmodel');
			$this->load->model('employee/employee_model','employee');
			
			$this->url = "/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3);
			$this->theme = $this->config->item('jb_employee_temp');
			$this->menu = $this->config->item('jb_employee_menu');
			
			$this->company_info = whose_company();
			
			if(count($this->company_info) == 0){
				show_error("Invalid subdomain");
				return false;
			}
			$this->company_id = $this->company_info->company_id;
			$this->emp_id = $this->session->userdata('emp_id');
		}
		
		/**
		 * index page
		 */
		public function index() {

			$data['page_title'] = "Payroll History";
			$this->layout->set_layout($this->theme);
			$this->layout->view('pages/employee/emp_payroll_history_view', $data);
		}
	
	}

/* End of file Emp_payroll_history.php */
/* Location: ./application/controllers/employee/Emp_payroll_history.php */