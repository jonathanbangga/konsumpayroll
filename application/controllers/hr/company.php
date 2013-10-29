<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Approvers Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Company extends CI_Controller {
		
		/**
		 * Theme options - default theme
		 * @var string
		 */
		var $theme;
		var $menu;
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->theme = $this->config->item('temp_company_wizard');
			$this->menu = "content_holders/hr_company_sidebar_menu";
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "Company Information";			
			$data['sidebar_menu'] = $this->menu;
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/company_information_view', $data);
		}
		
		public function approvers(){
			$data['page_title'] = "Company Approvers";	
			$data['sidebar_menu'] = $this->menu;			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/company_approvers_view', $data);	
		}
		
		public function company_principal(){
			$data['page_title'] = "Company Principal";	
			$data['sidebar_menu'] = $this->menu;
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/company_principal_view', $data);	
		}
		
		public function cost_center(){
			$data['page_title'] = "Cost Center";
			$data['sidebar_menu'] = $this->menu;			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/cost_center_view', $data);		
		}		
		
		public function gov_registration(){
			$data['page_title'] = "Government Registration";
			$data['sidebar_menu'] = $this->menu;			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/government_registration_view', $data);			
		}
	
	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company_approvers.php */