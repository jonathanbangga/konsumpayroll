<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * HDMF Table Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Hdmf_tbl extends CI_Controller {
		
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
			$this->company_id = 1;
			
			$this->sidebar_menu = 'content_holders/employee_sidebar_menu';
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
			$data['page_title'] = "HDMF TABLE";
			$data['sidebar_menu'] =$this->sidebar_menu;
			$hdmf_val = array('status'=>'active');
			$data['hdmf_tbl'] = $this->jmodel->display_data_where_result('hdmf',$hdmf_val);	
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/employee/hdmf_table_view', $data);
		}
	
	}

/* End of file philhealth_tbl.php */
/* Location: ./application/controllers/hr/philhealth_tbl.php */