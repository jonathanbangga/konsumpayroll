<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leaves extends CI_Controller {
	
	protected $theme;
	protected $sidebar_menu;
	
	public function __construct() {
		parent::__construct();
		$this->theme = $this->config->item('default');
		$this->menu = $this->config->item('add_company_menu');
		$this->sidebar_menu = $this->config->item('add_company_sidebar_menu');
		$this->authentication->check_if_logged_in();
		// load
		$this->load->model('hr_setup/leaves_model');	
	}

	public function index(){
		$data['page_title'] = "Leaves";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		$data['leaves_sql'] = $this->leaves_model->get_leaves();
		$data['pos_sql'] = $this->leaves_model->get_position();
		$data['lp_sql'] = $this->leaves_model->get_hr_setup_properties();
		$this->layout->view('pages/hr_setup/leaves_view',$data);
	}

	public function ajax_add_leaves(){
		$lt = $this->input->post('lt');
		$payable = $this->input->post('payable');
		$req_doc = $this->input->post('req_doc');
		$act_hours_worked = $this->input->post('act_hours_worked');
		$deduct_num_work = $this->input->post('deduct_num_work');
		$accrued = $this->input->post('accrued');
		$period = $this->input->post('period');
		$position = $this->input->post('position');
		$years_of_service = $this->input->post('years_of_service');
		$unused_leave = $this->input->post('unused_leave');
		$unused_leave_termin = $this->input->post('unused_leave_termin');
		$max_day_leave = $this->input->post('max_day_leave');
		foreach($lt as $index=>$val){
			$this->leaves_model->add_leaves($val,$payable[$index],$req_doc[$index],$act_hours_worked[$index],$deduct_num_work[$index],$accrued[$index],$period[$index],$position[$index],$years_of_service[$index],$unused_leave[$index],$unused_leave_termin[$index],$max_day_leave[$index]);
		}	
	}
	
	public function ajax_delete_leaves(){
		$leaves_id = $this->input->post('leaves_id');
		echo $this->leaves_model->delete_leaves($leaves_id);
	}
	
	public function ajax_update_leaves(){
		$leaves_id = $this->input->post('leaves_id');
		$lt = $this->input->post('lt');
		$pybl = $this->input->post('pybl');
		$rec_doc = $this->input->post('rec_doc');
		$ahw = $this->input->post('ahw');
		$dnw = $this->input->post('dnw');
		$acrd = $this->input->post('acrd');
		$prd = $this->input->post('prd');
		$pos = $this->input->post('pos');
		$yos = $this->input->post('yos');
		$ul = $this->input->post('ul');
		$ult = $this->input->post('ult');
		$mdl = $this->input->post('mdl');
		$this->leaves_model->update_leaves($leaves_id,$lt,$pybl,$rec_doc,$ahw,$dnw,$acrd,$prd,$pos,$yos,$ul,$ult,$mdl);
	}
	
	public function ajax_check_hr_setup_properties(){
		$sql = $this->leaves_model->get_hr_setup_properties();
		echo $sql->num_rows();
	}
	
	public function ajax_set_hr_setup_properties(){
		$ldnh = $this->input->post('ldnh');
		$mwd = $this->input->post('mwd');
		$this->leaves_model->set_hr_setup_properties($ldnh,$mwd);
	}
	
	public function ajax_update_hr_setup_properties(){
		$ldnh = $this->input->post('ldnh');
		$mwd = $this->input->post('mwd');
		$this->leaves_model->update_hr_setup_properties($ldnh,$mwd);
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */