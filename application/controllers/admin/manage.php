<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends CI_Controller {

	var $theme;
	
	public function __construct() {
		parent::__construct();
		$this->theme = $this->config->item('temp_company_wizard');
		
	}

	public function index()
	{		
		echo 'we';
	}
	
	public function tetew() {
		$data['page_title'] = "Manage tetew";
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/hr/company_information_view', $data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */