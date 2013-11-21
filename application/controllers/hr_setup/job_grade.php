<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_grade extends CI_Controller {
	
	protected $theme;
	protected $sidebar_menu;
	
	public function __construct() {
		parent::__construct();
		$this->theme = $this->config->item('default');
		$this->menu = $this->config->item('add_company_menu');
		$this->sidebar_menu = $this->config->item('add_company_sidebar_menu');
		$this->authentication->check_if_logged_in();
		// load
		$this->load->model('hr_setup/job_grade_model');	
		// default
		$this->comp_id = 6;
	}

	public function index(){
		$data['page_title'] = "Job Grade";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		$data['jg_sql'] = $this->job_grade_model->get_job_grade($this->comp_id);
		$this->layout->view('pages/hr_setup/job_grade_view',$data);
	}
	
	public function ajax_add_job_grade(){
		$rank = $this->input->post('jg');
		$desc = $this->input->post('desc');
		foreach($rank as $index=>$val){
			$this->job_grade_model->add_job_grade($val,$desc[$index],$this->comp_id);
		}
	}
	
	public function ajax_delete_job_grade(){
		$jg_id = $this->input->post('jg_id');
		echo $this->job_grade_model->delete_job_grade($jg_id);
	}

	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */