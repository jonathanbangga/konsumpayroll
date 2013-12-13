<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * SSS Table Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Sss_tbl extends CI_Controller {
		
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
			$data['page_title'] = "SSS TABLE";
			$data['sidebar_menu'] =$this->sidebar_menu;
			$sss_val = array('status'=>	'active');
			$data['sss_tbl'] = $this->jmodel->display_data_where_result('sss',$sss_val);
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/employee/sss_table_view', $data);
		}
	
	}

/* End of file sss_tbl.php */
/* Location: ./application/controllers/hr/sss_tbl.php */