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
	}

	public function index(){
		$data['page_title'] = "Job Grade";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		$data['jg_sql'] = $this->job_grade_model->get_job_grade();
		$this->layout->view('pages/hr_setup/job_grade_view',$data);
	}
	
	public function ajax_add_job_grade(){
		$rank = $this->input->post('jg');
		$desc = $this->input->post('desc');
		foreach($rank as $index=>$val){
			$this->job_grade_model->add_job_grade($val,$desc[$index]);
		}
	}
	
	public function ajax_delete_job_grade(){
		$jg_id = $this->input->post('jg_id');
		echo $this->job_grade_model->delete_job_grade($jg_id);
	}
	
	public function ajax_update_job_grade(){
		$job_grade_id = $this->input->post('job_grade_id');
		$job_grade = mysql_real_escape_string($this->input->post('job_grade'));
		$desc = mysql_real_escape_string($this->input->post('desc'));
		$this->job_grade_model->update_job_grade($job_grade_id,$job_grade,$desc);
	}

	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */