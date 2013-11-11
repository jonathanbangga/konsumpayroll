<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employment_type extends CI_Controller {
	
	protected $theme;
	protected $sidebar_menu;
	
	public function __construct() {
		parent::__construct();
		// menu and authentication
		$this->theme = $this->config->item('default');
		$this->menu = $this->config->item('add_company_menu');
		$this->sidebar_menu = $this->config->item('add_company_sidebar_menu');
		$this->authentication->check_if_logged_in();
		// load
		$this->load->model('hr_setup/employment_type_model');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Employment Type";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		$data['et'] = $this->employment_type_model->get_employment_type();
		$this->layout->view('pages/hr_setup/employment_type_view',$data);
	}
	
	public function ajax_add_employment_type(){
		$et = $this->input->post('et');
		echo $this->employment_type_model->add_employment_type($et);
	}

	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */