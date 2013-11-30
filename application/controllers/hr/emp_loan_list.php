<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Loan Information Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_loan_list extends CI_Controller {
		
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
			$data['page_title'] = "Employee Loans";
			$data['sidebar_menu'] = $this->sidebar_menu;
			
			// init pagination
			$uri = "/{$this->uri->segment(1)}/hr/emp_loan_list/index/";
			$total_rows = $this->hr_emp->emp_loan_counter_comp($this->company_id);
			$per_page =2;
			$segment=5;
			
			init_pagination($uri,$total_rows,$per_page,$segment);

			$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
			$data["links"] = $this->pagination->create_links();
			// end pagination
			
			$data['emp_loan'] = $this->hr_emp->emp_loan_comp($per_page, $page, $this->company_id);
			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/emp_loan_list_view', $data);
		}
	
	}

/* End of file Emp_loan_list.php */
/* Location: ./application/controllers/hr/Emp_loan_list.php */