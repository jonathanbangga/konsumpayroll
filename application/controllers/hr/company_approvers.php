<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Approvers Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Company_approvers extends CI_Controller {
		
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
			$this->theme = $this->config->item('temp_company_wizard');
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "Company Information";			
			$this->layout->set_layout($this->theme);	
		#	$this->layout->view('pages/hr/company_approvers_view', $data);
			$this->layout->view('pages/hr/company_information_view', $data);
		}
		
		public function approvers(){
			$data['page_title'] = "Company Approvers 4";			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/company_approvers_view', $data);
			
		}
	
	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company_approvers.php */