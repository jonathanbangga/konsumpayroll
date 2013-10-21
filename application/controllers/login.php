<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * Login Controller
 *
 * @subpackage Login
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
		 * Login for admin
		 */
		public function admin()
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
					$value = sprintf(lang("last_login"),"administrator");
					add_activity($value,"admin");
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
		
		/**
		 * Login for owner
		 */
		public function owner(){
			$data['msg_error'] = "";
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if ($username && $password) {
				$verify = $this->konsumpay_auth->login($username, $password,'owner');
				
				if ($verify == FALSE)
					$data['msg_error'] = "Incorrect username/password!";
			}
			
			if ($this->konsumpay_auth->is_logged_in()) {
	            // Redirect to landing page.
	            $session = $this->konsumpay_auth->get_session_data();
	            if ($session['account_type'] == 'owner') {
	                redirect('owner/cpanel','refresh');
				} else {
					//if current user is not owner, show error.
					show_404();
				}
	        }
	
			$data['page_title'] = "Konsum Payroll - Company Owner";
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/login_view', $data);
		}
		
		
	}

/* End of file login.php */
/* Location: ./application/controllers/login.php */