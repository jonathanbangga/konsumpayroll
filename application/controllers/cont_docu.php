<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Employee extends CI_Controller {
		
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
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "Employee's Account";
			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/employee/employee_view', $data);
		}
	
	}

/* End of file employee.php */
/* Location: ./application/controllers/hr/employee.php */