<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * Admin Login Controller
 *
 * @subpackage Admin Login
 * @category Controller
 * @version 1.0
 * @copyright Copyright (c) 2013, Konsum Technologies Inc.
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */

	class Login extends CI_Controller {
	
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
		public function index()
		{		
			$data['msg_error'] = "";
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if ($username && $password) {
				$verify = $this->konsumpay_auth->login($username, $password,'admin');
				if ($verify == FALSE)
					$data['msg_error'] = "Incorrect username/password!";
			}
			
			if ($this->konsumpay_auth->is_logged_in()) {
	            // Redirect to landing page.
	            $session = $this->konsumpay_auth->get_session_data();
	            if ($session['account_type'] == 'admin') {
	                redirect('admin/dashboard','refresh');
				} else {
					//if current user is not admin, show error.
					show_404();
				}
	        }
	
			$data['page_title'] = "Login";			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/login_view', $data);
		}
		
	}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
