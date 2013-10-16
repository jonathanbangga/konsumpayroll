<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Approvers Controller
 *
 * @package Module
 * @subpackage Company Approvers
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
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
			$data['page_title'] = "Company Approvers 3";			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/view_company_approvers', $data);
		}
		
		public function we(){
			echo 'tetwe';
		}
		
	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company_approvers.php */