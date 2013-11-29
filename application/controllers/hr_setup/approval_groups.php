<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Approval_groups extends CI_Controller {
	
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
		$this->load->model('hr_setup/approval_groups_model');	
	}

	public function index(){
		$data['page_title'] = "Approval Groups";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		$data['ap_sql'] = $this->approval_groups_model->get_approval_process();
		$data['ap_n_ag_sql'] = $this->approval_groups_model->get_approval_process_in_approval_groups();
		$this->layout->view('pages/hr_setup/approval_groups_view',$data);
	}
	
	public function ajax_add_approval_process(){
		$name = mysql_real_escape_string($this->input->post('name'));
		echo $this->approval_groups_model->add_approval_process($name);
	}
	
	public function ajax_add_approval_group(){
		$app_proc = $this->input->post('app_proc');
		$approver = $this->input->post('approver');
		$level = $this->input->post('level');
		$this->approval_groups_model->add_approval_groups($app_proc,$approver,$level);
	}
	
	public function delete_approver(){
		$ag_id = $this->input->post('ag_id');
		$this->approval_groups_model->delete_approval_groups($ag_id);
	}
	
	public function ajax_delete_approval_process(){
		$ap_id = $this->input->post('ap_id');
		$this->approval_groups_model->delete_approval_process($ap_id);
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */