<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
	public function __construct(){
		parent::__construct();
		$this->theme = 'company_dashboard';
		$this->sidebar_menu = 'content_holders/company_sidebar_menu';
		$this->menu = 'content_holders/company_dashboard_menu';	
		$this->authentication->check_if_logged_in();	
	}

	/**
	 * index page
	 */
	public function index(){		
		$data['sidebar_menu'] =$this->sidebar_menu;
		$data['page_title'] = "Company List";
		$this->layout->set_layout($this->theme);	
		$data['sidebar_menu'] = $this->sidebar_menu;
		$this->layout->view('pages/dashboard_view', $data);
	}
	
	public function we(){
	p($this->session->all_userdata());
	}
	
}

/* End of file */