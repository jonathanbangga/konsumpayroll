<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	var $theme;
	
	public function __construct() {
		parent::__construct();
		$this->theme = $this->config->item('temp_company_wizard');
	}

	public function index()
	{
		$data['page_title'] = "Company Approvers 3";			
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/login_view', $data);
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */