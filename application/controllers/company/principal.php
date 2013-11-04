<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Principal Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Principal extends CI_Controller {
		
		/**
		 * Theme options - default theme
		 * @var string
		 */
		var $theme;
		var $menu;
		var $sidebar_menu;
		
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->theme = $this->config->item('default');		
			$this->menu = 'content_holders/company_menu';	
			$this->sidebar_menu = 'content_holders/company_sidebar_menu';
			$this->load->model("company/approvers_model","approvers");
		}
		
		
		public function edit(){
			$valid_domain = $this->uri->segment(4);
			if(mod_is_mycompany(0,$valid_domain) == false){
				redirect("company/dashboard");
				return false;
			}		
			$data['sidebar_menu'] = $this->sidebar_menu;
			$data['page_title'] = "Company Principal";		
			$data['error']	= "";
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/company/company_principal_view', $data);				
		}
	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company/company_approvers.php */