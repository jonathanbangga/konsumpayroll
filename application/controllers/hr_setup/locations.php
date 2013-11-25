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
	}

	public function index(){
		$data['page_title'] = "Locations";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		$data['locations'] = $this->locations_model->get_locations();
		$data['sql_proj'] = $this->locations_model->get_projects();
		$this->layout->view('pages/hr_setup/locations_view',$data);
	}

	public function ajax_project_location(){
		$proj = $this->input->post('proj');
		$loc = $this->input->post('loc');
		$desc = $this->input->post('desc');
		foreach($proj as $index=>$val){
			$this->locations_model->add_project_location($val,$loc[$index],$desc[$index]);
		}
	}
	
	public function ajax_delete_project_location(){
		$loc_id = $this->input->post('loc_id');
		$this->locations_model->delete_project_location($loc_id);
		redirect("/{$this->session->userdata('sub_domain')}/hr_setup/projects");
	}
	
	public function ajax_get_project_location(){
		$loc_id = $this->input->post('loc_id');
		$loc_sql = $this->locations_model->get_locations($loc_id);
		if($loc_sql->num_rows()>0){
		$loc = $loc_sql->row();
				$arr = array(
					"project_name"=>$loc->project_name,
					"location"=>$loc->location,
					"description"=>$loc->description
				);
			echo json_encode($arr);
		}
	}
	
	public function ajax_update_project_location(){
		$loc_id = $this->input->post('loc_id');
		$loc = $this->input->post('loc');
		$desc = $this->input->post('desc');
		echo $this->locations_model->update_project_location($loc,$desc,$loc_id);
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */