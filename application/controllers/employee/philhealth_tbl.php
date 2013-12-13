<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Philhealth Table Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Philhealth_tbl extends CI_Controller {
		
		/**
		 * Theme options - default theme
		 * @var string
		 */
		var $theme;
		var $company_info;
		
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->authentication->check_if_logged_in();	
			$this->theme = $this->config->item('default');
			$this->load->model('konsumglobal_jmodel','jmodel');
			$this->load->model('employee/employee_model','employee');
			$this->sidebar_menu = 'content_holders/employee_sidebar_menu';
			$this->menu = $this->config->item('jb_employee_menu');
			$this->company_info =  whose_company();
			if($this->company_info == false){
				show_error("Company subdomain is invalid");
				return false;
			}	
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "PHILHEALTH TABLE";
			$data['sidebar_menu'] =$this->sidebar_menu;
			$phil_health = array('status'=>'active');
			$data['philhealth_tbl'] = $this->jmodel->display_data_where_result('phil_health',$phil_health);
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/employee/philhealth_table_view', $data);
		}
	
	}

/* End of file philhealth_tbl.php */
/* Location: ./application/controllers/hr/philhealth_tbl.php */