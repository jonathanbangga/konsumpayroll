<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Withholding Tax Monthly Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Withholding_tax_monthly extends CI_Controller {
		
		
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
			$this->authentication->check_if_logged_in();	
			$this->theme = $this->config->item('default');
			$this->load->model('konsumglobal_jmodel','jmodel');
			$this->load->model('employee_model','employee');
			$this->company_id = 1;
			
			$this->sidebar_menu = 'content_holders/hr_tables_sidebar_menu';
			$this->menu = 'content_holders/user_hr_owner_menu';
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
			$data['page_title'] = "Withholding Tax - Monthly";
			$withholding_tax_val = array('company_id'=>$this->company_info->company_id,'tax_type'=>'Monthly');
			$data['withholding_tax'] = $this->jmodel->display_data_where_result('withholding_tax',$withholding_tax_val);
			
			$withholding_tax_status = array('company_id'=>$this->company_info->company_id,'tax_type'=>'Monthly');
			$data['withholding_tax_status'] = $this->jmodel->display_data_where_result('withholding_tax_status',$withholding_tax_status);
			
			$data['sidebar_menu'] =$this->sidebar_menu;
			$this->layout->set_layout($this->theme);
			$this->layout->view('pages/hr/withholding_tax_monthly_view', $data);
		}
	
	}

/* End of file withholding_tax_monthly.php */
/* Location: ./application/controllers/hr/withholding_tax_monthly.php */