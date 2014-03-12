<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payroll_period extends CI_Controller {
	
	var $sidebar_menu;
	var $company_id;
	var $company_info;
	var $subdomain;
	
	public function __construct() {
		parent::__construct();
		$this->load->model('payroll_run/payroll_period_model');
		
		// layout setup
		$this->menu = 'content_holders/user_hr_owner_menu';
		$this->sidebar_menu = $this->config->item('payroll_run_sidebar_menu');
		
		// account details
		$this->company_info = whose_company();
		$this->company_id = $this->company_info->company_id;
		$this->subdomain = $this->uri->segment(1);
		
		// authentication
		$this->authentication->check_if_logged_in();
	}

	public function index(){
		$data['page_title'] = "Payroll Period";
		$data['sidebar_menu'] = $this->sidebar_menu;
		
		if ($this->input->post()) {
			$this->form_validation->set_rules('payroll_group', 'Payroll Group', 'required');
			$this->form_validation->set_rules('payroll_period', 'Payroll Period', 'required');
			$this->form_validation->set_rules('pfrom', 'Payroll Period from', 'required');
			$this->form_validation->set_rules('pto', 'Payroll Period to', 'required');
			if ($this->form_validation->run() == true)
			{
				$pg = $this->input->post('payroll_group');
				$pp = $this->input->post('payroll_period');
				$pfrom = $this->input->post('pfrom');
				$pto = $this->input->post('pto');
				$pp_id = $this->input->post('payroll_period_id');
				
				// validation sucess
				// get payroll period
				$period_sql = $this->payroll_period_model->get_payroll_calendar_period($this->company_id,$pp);
				$period = $period_sql->row();
				if($pp_id==""){
					$this->payroll_period_model->add_payroll_period($pg,$this->company_id,$period->first_payroll_date,$pfrom,$pto);
					setcookie("msg", "Submission has been saved!"); 
				}else{
					$this->payroll_period_model->update_payroll_period($pg,$this->company_id,$period->first_payroll_date,$pfrom,$pto);
					setcookie("msg", "Changes has been saved!"); 
				}	
				
			}
		}
		
		$data['q']  = $this->payroll_period_model->get_payroll_period($this->company_id);
		$data['q1'] = $this->payroll_period_model->get_payroll_group($this->company_id);
		
		$this->layout->view('pages/payroll_run/payroll_period_view',$data);
	}
	
	public function ajax_get_payroll_period(){
		$pg_id = $this->input->post('pg_id');
		$pp_sql = $this->payroll_period_model->get_payroll_calendar($pg_id,$this->company_id);
		$str = "";
		if($pp_sql->num_rows()>0){
			$str .= '<option value="">select payroll period</option>';
			foreach($pp_sql->result() as $pp){
				$str .= '<option value="'.$pp->payroll_calendar_id.'">'.date("m/d/Y",strtotime($pp->first_payroll_date)).'</option>';
			}	
		}
		echo $str;
	}
	
	public function ajax_get_range(){
		$pc_id = $this->input->post('pc_id');
		$pp_sql = $this->payroll_period_model->get_payroll_range($pc_id,$this->company_id);
		$ret = "-1";
		if($pp_sql->num_rows()>0){
			$pp = $pp_sql->row();
			 $arr = array(
				"pfrom"=>date("m/d/Y",strtotime($pp->cut_off_from)),
				"pto"=>date("m/d/Y",strtotime($pp->cut_off_to))
			);
			 $ret = json_encode($arr);
		}
		echo $ret;
	}
	
}

/* End of file */