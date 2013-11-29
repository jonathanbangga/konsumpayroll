<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller {
	
	protected $theme;
	protected $sidebar_menu;
	
	public function __construct() {
		parent::__construct();
		$this->theme = $this->config->item('default');
		$this->menu = $this->config->item('add_company_menu');
		$this->sidebar_menu = $this->config->item('hr_setup_sidebar_menu');
		$this->authentication->check_if_logged_in();
		// load
		$this->load->model('hr_setup/projects_model');	
	}

	public function index(){
		$data['page_title'] = "Projects";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		$data['proj_sql'] = $this->projects_model->get_projects();
		$this->layout->view('pages/hr_setup/projects_view',$data);
	}

	public function ajax_add_project(){
		$proj = $this->input->post('proj');
		$desc = $this->input->post('desc');
		foreach($proj as $index=>$val){
			$this->projects_model->add_project($val,$desc[$index]);
		}
	}
	
	public function ajax_delete_project(){
		$proj = $this->input->post('proj');
		$this->projects_model->delete_project($proj);
	}
	
	public function ajax_update_project(){
		$proj_id = $this->input->post('proj_id');
		$proj = mysql_real_escape_string($this->input->post('proj'));
		$desc = mysql_real_escape_string($this->input->post('desc'));
		$this->projects_model->update_project($proj_id,$proj,$desc);
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */