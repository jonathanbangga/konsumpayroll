<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employment_type extends CI_Controller {
	
	protected $theme;
	protected $sidebar_menu;
	
	public function __construct() {
		parent::__construct();
		// menu and authentication
		$this->theme = $this->config->item('default');
		$this->menu = $this->config->item('add_company_menu');
		$this->sidebar_menu = $this->config->item('hr_setup_sidebar_menu');
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
		$data['aet'] = $this->employment_type_model->get_assigned_employment_type();
		$this->layout->view('pages/hr_setup/employment_type_view',$data);
	}
	
	public function ajax_add_employment_type(){
		$et = $this->input->post('et');
		foreach($et as $val){
			$this->employment_type_model->add_employment_type($val);
		}
	}

	public function ajax_assign_employment_type(){
		$et = $this->input->post('et');
		$selected = $this->input->post('selected');
		$this->employment_type_model->update_employment_type($selected,$et);
	}
	
	public function ajax_delete_employment_type(){
		$et_id = $this->input->post('et_id');
		$this->employment_type_model->delete_employment_type($et_id);
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */