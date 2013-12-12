<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * HDMF Table Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Hdmf_tables extends CI_Controller {
		
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
			$data['page_title'] = "HDMF TABLE";
			$data['sidebar_menu'] =$this->sidebar_menu;
			$hdmf_val = array('status'=>'active');
			$data['hdmf_tbl'] = $this->jmodel->display_data_where_result('hdmf',$hdmf_val);	
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/hdmf_table_view', $data);
		}
	
	}

/* End of file philhealth_tbl.php */
/* Location: ./application/controllers/hr/philhealth_tbl.php */