<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	var $theme;
	
	public function __construct() {
		parent::__construct();
		$this->theme = $this->config->item('temp_company_wizard');
	}

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
                redirect('admin/company_setup','refresh');
			} else {
				//if current user is not admin, show error.
				show_404();
			}
        }

		$data['page_title'] = "Login";			
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/login_view', $data);
	}
	
	public function logout()
	{
		$this->konsumpay_auth->logout();
		redirect('admin/login','refresh');
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */