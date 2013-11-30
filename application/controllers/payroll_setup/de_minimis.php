<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class De_minimis extends CI_Controller {
	
	protected $theme;
	protected $sidebar_menu;
	
	public function __construct() {
		parent::__construct();
		// menu and authentication
		$this->theme = $this->config->item('default');
		$this->menu = $this->config->item('add_company_menu');
		$this->sidebar_menu = $this->config->item('payroll_setup_sidebar_menu');
		$this->authentication->check_if_logged_in();
		// load
		$this->load->model('payroll_setup/de_minimis_model');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "De Minimis";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		$data['sql_dm'] = $this->de_minimis_model->get_de_minimis();
		$this->layout->view('pages/payroll_setup/de_minimis_view',$data);
	}
	
	public function ajax_add_de_minimiss(){
		$mul = mysql_real_escape_string($this->input->post('mul'));
		$dma = mysql_real_escape_string($this->input->post('dma'));
		$ceiling = mysql_real_escape_string($this->input->post('ceiling'));
		$this->de_minimis_model->add_de_minimis($mul,$dma,$ceiling);
	}
	
	public function ajax_update_de_minimiss(){
		$mul = mysql_real_escape_string($this->input->post('mul'));
		$dma = mysql_real_escape_string($this->input->post('dma'));
		$ceiling = mysql_real_escape_string($this->input->post('ceiling'));
		$this->de_minimis_model->update_de_minimis($mul,$dma,$ceiling);
	}
	
}

/* End of file */