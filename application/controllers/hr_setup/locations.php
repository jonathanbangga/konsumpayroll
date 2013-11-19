<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Locations extends CI_Controller {
	
	protected $theme;
	protected $sidebar_menu;
	
	public function __construct() {
		parent::__construct();
		$this->theme = $this->config->item('default');
		$this->menu = $this->config->item('add_company_menu');
		$this->sidebar_menu = $this->config->item('add_company_sidebar_menu');
		$this->authentication->check_if_logged_in();
		// load
		$this->load->model('hr_setup/locations_model');	
		// default
		$this->comp_id = 6;
	}

	public function index(){
		$data['page_title'] = "Locations";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		$data['locations'] = $this->locations_model->get_locations($this->comp_id);
		$data['sql_proj'] = $this->locations_model->get_projects($this->comp_id);
		$this->layout->view('pages/hr_setup/locations_view',$data);
	}

	public function ajax_project_location(){
		$proj = $this->input->post('proj');
		$loc = $this->input->post('loc');
		$desc = $this->input->post('desc');
		echo $this->locations_model->add_project_location($proj,$loc,$desc,$this->comp_id);
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */