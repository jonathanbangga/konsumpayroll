<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * GSIS Table Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Gsis_tbl extends CI_Controller {
		
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
			$this->theme = $this->config->item('default');
			$this->load->model('konsumglobal_jmodel','jmodel');
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
			$data['page_title'] = "GSIS TABLE";
			$data['sidebar_menu'] =$this->sidebar_menu;
			$gsis_val = array('status'=>'active');
			$data['gsis_tbl'] = $this->jmodel->display_data_where_result('gsis',$gsis_val);
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/employee/gsis_table_view',$data);
		}
	
	}

/* End of file Gsis_tbl.php */
/* Location: ./application/controllers/employee/Gsis_tbl.php */