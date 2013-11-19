<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Approval_groups extends CI_Controller {
	
	protected $theme;
	protected $sidebar_menu;
	protected $comp_id;
	
	public function __construct() {
		parent::__construct();
		// menu and authentication
		$this->theme = $this->config->item('default');
		$this->menu = $this->config->item('add_company_menu');
		$this->sidebar_menu = $this->config->item('add_company_sidebar_menu');
		$this->authentication->check_if_logged_in();
			// load
		$this->load->model('hr_setup/approval_groups_model');	
		$this->comp_id = 6;
	}

	public function index(){
		$data['page_title'] = "Approval Groups";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		$data['ap_sql'] = $this->approval_groups_model->get_approval_process($this->comp_id);
		$data['comp_id'] = $this->comp_id;
		$data['ap_n_ag_sql'] = $this->approval_groups_model->get_approval_process_in_approval_groups($this->comp_id);
		$this->layout->view('pages/hr_setup/approval_groups_view',$data);
	}
	
	public function ajax_add_approval_process(){
		$name = $this->input->post('name');
		echo $this->approval_groups_model->add_approval_process($name,$this->comp_id);
	}
	
	public function ajax_add_approval_group(){
		$app_proc = $this->input->post('app_proc');
		$approver = $this->input->post('approver');
		$level = $this->input->post('level');
		$this->approval_groups_model->add_approval_groups($app_proc,$approver,$level,$this->comp_id);
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */