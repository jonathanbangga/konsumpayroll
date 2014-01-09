<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Control Panel Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Control_panel extends CI_Controller {
		
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
			$this->theme = $this->config->item('temp_control_panel'); // temp full width
			$this->menu = 'content_holders/user_hr_owner_menu';
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

			$data['page_title'] = "Control Panel";
			
			$this->layout->set_layout($this->theme);
			$this->layout->view('pages/dashboard/control_panel_view', $data);
		}
	
	}

/* End of file control_panel.php */
/* Location: ./application/controllers/dashboard/control_panel.php */