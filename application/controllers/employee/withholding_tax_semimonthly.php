<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Withholding Tax Semi Monthly Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Withholding_tax_semimonthly extends CI_Controller {
		
		
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
			$this->authentication->check_if_logged_in();	
			$this->load->model('konsumglobal_jmodel','jmodel');	
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
			$data['page_title'] = "Withholding Tax - Semi Monthly";
			$withholding_tax_val = array('status'=>'active','tax_type'=>'Semi Monthly');
			$data['withholding_tax'] = $this->jmodel->display_data_where_result('withholding_tax',$withholding_tax_val);			
			$withholding_tax_status = array('status'=>'active','tax_type'=>'Semi Monthly');
			$data['withholding_tax_status'] = $this->jmodel->display_data_where_result('withholding_tax_status',$withholding_tax_status);
			$data['sidebar_menu'] =$this->sidebar_menu;
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/employee/withholding_tax_semimonthly_view', $data);
		}
	
	}

/* End of file withholding_tax_semimonthly.php */
/* Location: ./application/controllers/employee/withholding_tax_semimonthly.php */