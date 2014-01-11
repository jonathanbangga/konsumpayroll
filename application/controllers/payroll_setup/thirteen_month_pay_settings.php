<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Thirteen_month_pay_settings for 13month settings
 *
 * @category CONTROLLER
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
class Thirteen_month_pay_settings extends CI_Controller {
	
	protected $theme;
	protected $sidebar_menu;
	var $company_id;
	
	public function __construct() {
		parent::__construct();
		// menu and authentication
		$this->theme = $this->config->item('default');
		$this->menu = $this->config->item('add_company_menu');
		$this->sidebar_menu = $this->config->item('payroll_setup_sidebar_menu');
		$this->authentication->check_if_logged_in();
		// load
		$this->load->model('payroll_setup/thirteen_month_pay_settings_model',"thirteen_month_pay_settings");
		$this->company_id = $this->session->userdata('company_id');
	}

	public function we(){
		$this->session->set_userdata("company_id","1");
		p($this->session->all_userdata());
	}
	
	public function index(){
		// header and menu's
		$this->layout->set_layout($this->theme);
		$data['page_title'] = "13th Month Pay Settings";
		
		$data['sidebar_menu'] = $this->sidebar_menu;
		$data['settings'] = $this->thirteen_month_pay_settings->get_settings($this->company_id);
		$data['earnings'] = $this->thirteen_month_pay_settings->get_earnings($this->company_id);
		$data['more_adjustments'] = $this->thirteen_month_pay_settings->get_other_adjustments($this->company_id);
		$data['options'] = array("Select"=>"","Yes"=>"yes","No"=>"no");
		// data
		$earning_ids = $this->input->post('earning_id');
		$earning_status = $this->input->post('earning_status');
		$more_adjustments = $this->input->post('more_adjustments_name');
		$more_adjustments_status = $this->input->post('more_adjustments_option');
		$more_adjustments_name = $this->input->post('more_adjustments_name');

		// updates 13month 
		$update_more_adjustments = $this->input->post('thirteen_month_other_adjustments_id');
		$update_more_adjustments_status = $this->input->post('additional_adjustments_name');
		# ARRAYS OF FIELS FOR UPDATE
		
		if($this->input->post('submit')){
		$fields_update = array(
			"basic_pay"	 => $this->input->post('basic_pay'),
			"overtime"	 => $this->input->post('overtime'),
			"holiday_or_premium_pay" 	=> $this->input->post('holiday_or_premium_pay'),
			"night_shift_differential"	=> $this->input->post('night_shift_differential'),
			"type_of_basic_pay_process" => $this->input->post('type_of_basic_pay_process'),
			"tardiness"	=> $this->input->post('tardiness'),
			"absences"	=> $this->input->post('absences'),
			"undertime"	=> $this->input->post('undertime')
		);
		# ARRAYS OF FIELDS FOR SAVE PURPOSES
		$fields_save = array(
			"company_id" => $this->company_id,
			"basic_pay"	 => $this->input->post('basic_pay'),
			"overtime"	 => $this->input->post('overtime'),
			"holiday_or_premium_pay" 	=> $this->input->post('holiday_or_premium_pay'),
			"night_shift_differential"	=> $this->input->post('night_shift_differential'),
			"type_of_basic_pay_process" => $this->input->post('type_of_basic_pay_process'),
			"tardiness"	=> $this->input->post('tardiness'),
			"absences"	=> $this->input->post('absences'),
			"undertime"	=> $this->input->post('undertime')
		);
		
			$this->form_validation->set_rules('basic_pay','Basic Pay','required|trim|xss_clean');
			$this->form_validation->set_rules('overtime','Overtime','required|trim|xss_clean');
			$this->form_validation->set_rules('holiday_or_premium_pay','Holyday/Premium','required|trim|xss_clean');
			$this->form_validation->set_rules('night_shift_differential','Nightshift Differential','required|trim|xss_clean');
			$this->form_validation->set_rules('type_of_basic_pay_process','Type of basic pay process','required|trim|xss_clean');
			$this->form_validation->set_rules('tardiness','Tardiness','required|trim|xss_clean');
			$this->form_validation->set_rules('absences','Absences','required|trim|xss_clean');
			$this->form_validation->set_rules('undertime','Undertime','required|trim|xss_clean');
			if($this->form_validation->run() == true){
				# IF EARNINGS ARE TRUE THEN SAVES THE INCLUDED 13MONTH EARNINGS
				if($earning_ids){
					# RESETS THE INCLUDE EARNINGS
					$this->thirteen_month_pay_settings->delete_include_earnings($this->company_id); 
					foreach($earning_ids as $earn_key=>$earn_val):		
						$earning_field = array(
							"earning_id" => $earn_val,
							"company_id" => $this->company_id,
							"include_status" => $earning_status[$earn_key],
							"date" => idates_now(),
							"deleted"=>'0'
						);
						$this->thirteen_month_pay_settings->save_field("thirteen_month_include_earnings",$earning_field);	
					endforeach;
				}
				# ADD MORE ADJUSTMENTS
				if($more_adjustments){
					foreach($more_adjustments as $more_key => $more_val):
						$more_adjustments_fields = array(
							"company_id" => $this->company_id,
							"adjustments_status" => $more_adjustments_status[$more_key],
							"name" 		=> $more_adjustments_name[$more_key],
							"deleted" 	=> "0"
						);
						$this->thirteen_month_pay_settings->save_field('thirteen_month_other_adjustments',$more_adjustments_fields);
					endforeach;
				}		
				# IF DATA IF SETTINGS ARE NOT EMPTY THEN UPDATE FUNCTIONALITIES GOES HERE
				if($data['settings']){ 
					# UPDATES 13MONTH SETTINGS
					$this->thirteen_month_pay_settings->update_field('thirteen_month_settings',$fields_update,array("company_id"=>$this->company_id));	
					# UPDATES ADJUSTMENTS	
					if($update_more_adjustments){
						foreach($update_more_adjustments as $uma_key=>$uma_val):
							$update_more_adjustments_field = array("adjustments_status" =>$this->db->escape_str($update_more_adjustments_status[$uma_key]));
							$this->thirteen_month_pay_settings->update_field('thirteen_month_other_adjustments',$update_more_adjustments_field,array("thirteen_month_other_adjustments_id"=>$uma_val));
						endforeach;
					}
					$this->session->set_flashdata("success","Thirteen month settings had been updated!");
					redirect("/".$this->uri->uri_string());
				}else{ # ELSE ONCE NO DATA IT SHOULD GO TO SAVE FUNCTIONALITIES	
					# SAVES 13MONTH SETTINGS
					$this->thirteen_month_pay_settings->save_field('thirteen_month_settings',$fields_save);	
					$this->session->set_flashdata("success","Thirteen month settings had been saved!");
					redirect("/".$this->uri->uri_string());
				}		
			}
		}	
		$this->layout->view('pages/payroll_setup/thirteen_month_pay_settings_view',$data);
	}
	
	
}

/* End of file */