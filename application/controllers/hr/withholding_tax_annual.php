<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Withholding Annual Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Withholding_tax_annual extends CI_Controller {
		
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
			$data['page_title'] = "WITHOLDING TAX - ANNUAL";
			$data['sidebar_menu'] =$this->sidebar_menu;
			$withholding_tax_annual = array('status'=>'Active');
			//display all withholding tax by annual version
			$data['withholding_tax_status'] = $this->jmodel->display_data_where_result('withholding_tax_annual',$withholding_tax_annual);
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/withholding_tax_annual_view',$data);
		}
	
	}

/* End of file withholding_tax_weekly.php */
/* Location: ./application/controllers/hr/withholding_tax_weekly.php */