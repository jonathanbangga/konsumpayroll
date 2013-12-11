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
		
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->theme = $this->config->item('default');
			$this->load->model('konsumglobal_jmodel','jmodel');
			$this->load->model('employee/employee_model','employee');
			$this->company_id = 1;
			
			$this->sidebar_menu = 'content_holders/company_sidebar_menu';
			$this->menu = 'content_holders/company_menu';
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "Withholding Tax - Semi Monthly";
			$withholding_tax_val = array('company_id'=>$this->company_id,'tax_type'=>'Semi Monthly');
			$data['withholding_tax'] = $this->jmodel->display_data_where_result('withholding_tax',$withholding_tax_val);
			
			$withholding_tax_status = array('company_id'=>$this->company_id,'tax_type'=>'Semi Monthly');
			$data['withholding_tax_status'] = $this->jmodel->display_data_where_result('withholding_tax_status',$withholding_tax_status);
			
			$data['sidebar_menu'] =$this->sidebar_menu;
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/employee/withholding_tax_semimonthly_view', $data);
		}
	
	}

/* End of file withholding_tax_semimonthly.php */
/* Location: ./application/controllers/hr/withholding_tax_semimonthly.php */