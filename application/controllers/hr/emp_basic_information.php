<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Basic Information Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_basic_information extends CI_Controller {
		
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
			$data['page_title'] = "Basic Information";
			$data['sidebar_menu'] = $this->sidebar_menu;
			
			$data['employee'] = $this->hr_emp->view_employee($this->company_id);
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/emp_basic_info_view', $data);
		}
	
	}

/* End of file sss_tbl.php */
/* Location: ./application/controllers/hr/sss_tbl.php */