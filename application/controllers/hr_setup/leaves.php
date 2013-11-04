<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leaves extends CI_Controller {
	
	protected $theme;
	protected $sidebar_menu;
	
	public function __construct() {
		parent::__construct();
		$this->theme = $this->config->item('default');
		$this->menu = 'content_holders/company_menu';
		$this->sidebar_menu = 'content_holders/hr_setup_sidebar_menu';
		$this->authentication->check_if_logged_in();
	}

	public function index(){
		$data['page_title'] = "Leaves";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		$this->layout->view('pages/hr_setup/leaves_view',$data);
	}

	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */