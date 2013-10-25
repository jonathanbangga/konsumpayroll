<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * Dashboard Controller
 *
 * @subpackage Dashboard
 * @category Controller
 * @version 1.0
 * @copyright Copyright (c) 2013, Konsum Technologies Inc.
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */

	class Dashboard extends CI_Controller {
	
		/**
		 * Theme options - default theme
		 * @var string
		 */
		protected $theme;
		protected $sidebar_menu;
		
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->theme = $this->config->item('temp_company_wizard');
			$this->sidebar_menu = 'content_holders/hr_menu';
			$this->authentication->check_if_logged_in();
		}
	
		/**
		 * index page
		 */
		public function index()
		{		
			$data['page_title'] = "Dashboard";
			$this->layout->set_layout($this->theme);	
			$data['sidebar_menu'] = $this->sidebar_menu;
			$this->layout->view('pages/company/dashboard_view', $data);
		}
		
	}

/* End of file dashboard.php */
/* Location: ./application/controllers/company/dashboard.php */