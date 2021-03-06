<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Overtime_settings extends CI_Controller {
	
	protected $theme;
	protected $sidebar_menu;
	
	public function __construct() {
		parent::__construct();
		// menu and authentication
		$this->theme = $this->config->item('default');
		$this->menu = $this->config->item('add_company_menu');
		$this->sidebar_menu = $this->config->item('payroll_setup_sidebar_menu');
		$this->authentication->check_if_logged_in();
		// load
		$this->load->model('payroll_setup/overtime_settings_model');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Overtime Settings";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		if($this->input->post('save')==1){
			// overtime type
			$overtime_type = $this->input->post('overtime_type');
			//$pay_rate = $this->input->post('pay_rate');
			$ot_rate = $this->input->post('ot_rate');
			//var_dump($overtime_type);
			if($overtime_type){
				foreach($overtime_type as $index=>$val){
					$this->overtime_settings_model->add_overtime_type($val,$ot_rate[$index]);
				}
			}
			// allowance type
			$allowance_type = $this->input->post('allowance_type');
			$taxable = $this->input->post('taxable');
			$max_non_taxable = $this->input->post('max_non_taxable');
			$amount = $this->input->post('amount');
			$min_ot = $this->input->post('min_ot');
			if($allowance_type){
				foreach($allowance_type as $index=>$val){
					$this->overtime_settings_model->add_allowance_type($val,$taxable[$index],$max_non_taxable[$index],$amount[$index],$min_ot[$index]);
				}
			}
			// overtime settings
			// allowance type
			$ots_id = $this->input->post('ots_id');
			$automatic_recognition = $this->input->post('automatic_recognition');
			$overtime_as_leave_hours = $this->input->post('overtime_as_leave_hours');
			$leave_type = $this->input->post('leave_type');
			$min_hours = $this->input->post('min_hours');
			$increment = $this->input->post('increment');
			if($this->input->post('has_ots')==1){
				$this->overtime_settings_model->update_overtime_settings($ots_id,$automatic_recognition,$overtime_as_leave_hours,$leave_type,$min_hours,$increment);
			}else{
				$this->overtime_settings_model->save_overtime_settings($automatic_recognition,$overtime_as_leave_hours,$leave_type,$min_hours,$increment);
			}
			
			
			setcookie('msg', "Submission has been saved");
		}
		
		$data['ot_sql'] = $this->overtime_settings_model->get_overtime_type();
		$data['at_sql'] = $this->overtime_settings_model->get_allowance_type();
		$data['lt_sql'] = $this->overtime_settings_model->get_leave_type();
		$data['ots_sql'] = $this->overtime_settings_model->get_overtime_settings();
		$data['ht_sql'] = $this->overtime_settings_model->get_hour_type();
		$this->layout->view('pages/payroll_setup/overtime_settings_view',$data);
	}
	
	public function ajax_delete_overtime_type(){
		$overtime_type_id = $this->input->post('overtime_type_id');
		$this->overtime_settings_model->delete_overtime_type($overtime_type_id);
	}
	
	public function ajax_delete_allowance_type(){
		$allowance_type_id = $this->input->post('allowance_type_id');
		$this->overtime_settings_model->delete_allowance_type($allowance_type_id);
	}
	
	public function ajax_update_overtime_type(){
		$overtime_type_id = $this->input->post('overtime_type_id');
		$overtime_type = $this->input->post('overtime_type');
		$pay_rate = $this->input->post('pay_rate');
		$ot_rate = $this->input->post('ot_rate');
		$this->overtime_settings_model->update_overtime_type($overtime_type_id,$overtime_type,$pay_rate,$ot_rate);
	}
	
	public function ajax_update_allowance_type(){
		$allowance_type_id = $this->input->post('allowance_type_id');
		$allowance_type = $this->input->post('allowance_type');
		$taxable = $this->input->post('taxable');
		$maximum_non_taxable = $this->input->post('maximum_non_taxable');
		$amount = $this->input->post('amount');
		$minimum_ot = $this->input->post('minimum_ot');
		$this->overtime_settings_model->update_allowance_type($allowance_type_id,$allowance_type,$taxable,$maximum_non_taxable,$amount,$minimum_ot);
	}
	
	public function ajax_get_rate(){
		$ht_id = $this->input->post('ht_id');
		$ht_sql = $this->overtime_settings_model->get_hour_type_via_id($ht_id);
		if($ht_sql->num_rows()>0){
			$ht = $ht_sql->row();
			echo $ht->pay_rate;
		}
	}
	
}

/* End of file */