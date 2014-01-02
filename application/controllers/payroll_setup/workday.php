<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workday extends CI_Controller {
	
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
		$this->load->model('payroll_setup/workday_model');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Work Day";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		if($this->input->post('save')){
			$workday = $this->input->post('workday');
			$pg_id = $this->input->post('pg_id');
			$start_time_h = $this->input->post('st_h');
			$start_time_m = $this->input->post('st_m');
			$start_time_p = $this->input->post('st_p');
			$end_time_h = $this->input->post('et_h');
			$end_time_m = $this->input->post('et_m');
			$end_time_p = $this->input->post('et_p');
			$working_hours = $this->input->post('working_hours');
			$break_last_index = $this->input->post('break_last_index');
			$sel_wdid = $this->input->post('sel_wdid');
			
			// workdays
			foreach($workday as $wd){
				$wd2 = explode("-",$wd);
				$day = $wd2[0];
				$index = $wd2[1];
				$start_time = date("H:i:s",strtotime($start_time_h[$index].":".$start_time_m[$index]." ".$start_time_p[$index]));
				$end_time = date("H:i:s",strtotime($end_time_h[$index].":".$end_time_m[$index]." ".$end_time_p[$index]));
				
				//$wd_flag = $this->workday_model->check_if_working_day_already_set($pg_id[$index],$day);
				if($sel_wdid[$index]!=""){
					//echo $break_last_index[$index];
					// update workdays
					$this->workday_model->update_workdays($day,$start_time,$end_time,$working_hours[$index],$sel_wdid[$index]);
					// break time
					// loop through number of breaks
					for($i=0;$i<$break_last_index[$index];$i++){
						$bt_st_h = $this->input->post('bt_st_h'.$i);
						$bt_st_m = $this->input->post('bt_st_m'.$i);
						$bt_st_p = $this->input->post('bt_st_p'.$i);
						$bt_start_time = date("H:i:s",strtotime($bt_st_h[$index].":".$bt_st_m[$index]." ".$bt_st_p[$index]));
						$bt_et_h = $this->input->post('bt_et_h'.$i);
						$bt_et_m = $this->input->post('bt_et_m'.$i);
						$bt_et_p = $this->input->post('bt_et_p'.$i);
						$bt_end_time = date("H:i:s",strtotime($bt_et_h[$index].":".$bt_et_m[$index]." ".$bt_et_p[$index]));
						$btid = $this->input->post('btid'.$i);
						// update break time
						echo $btid[$index];
						$this->workday_model->update_break_time($btid[$index],$bt_start_time,$bt_end_time);
						
					}
				}else{
					// save workdays
					$this->workday_model->add_workdays($day,$start_time,$end_time,$working_hours[$index],$pg_id[$index]);
					// save break time
					// loop through number of breaks
					for($i=0;$i<$break_last_index[$index];$i++){
						$bt_st_h = $this->input->post('bt_st_h'.$i);
						$bt_st_m = $this->input->post('bt_st_m'.$i);
						$bt_st_p = $this->input->post('bt_st_p'.$i);
						$bt_start_time = date("H:i:s",strtotime($bt_st_h[$index].":".$bt_st_m[$index]." ".$bt_st_p[$index]));
						$bt_et_h = $this->input->post('bt_et_h'.$i);
						$bt_et_m = $this->input->post('bt_et_m'.$i);
						$bt_et_p = $this->input->post('bt_et_p'.$i);
						$bt_end_time = date("H:i:s",strtotime($bt_et_h[$index].":".$bt_et_m[$index]." ".$bt_et_p[$index]));
						// update break time
						$this->workday_model->add_break_time($pg_id[$index],$day,$bt_start_time,$bt_end_time,$i);
					}
				}			
			}
			// workshift
			$workshift = $this->input->post('workshift');
			$ws_sel = $this->input->post('ws_sel');
			$pg_id_ws = $this->input->post('pg_id_ws');
			$shift_name = $this->input->post('shift_name');
			$shift_st_h = $this->input->post('shift_st_h');
			$shift_st_m = $this->input->post('shift_st_m');
			$shift_st_p = $this->input->post('shift_st_p');
			$shift_et_h = $this->input->post('shift_et_h');
			$shift_et_m = $this->input->post('shift_et_m');
			$shift_et_p = $this->input->post('shift_et_p');
			$shift_wh = $this->input->post('shift_wh');
			foreach($shift_name as $index=>$sn){
				$shift_st = date("H:i:s",strtotime($shift_st_h[$index].":".$shift_st_m[$index]." ".$shift_st_p[$index]));
				$shift_et = date("H:i:s",strtotime($shift_et_h[$index].":".$shift_et_m[$index]." ".$shift_et_p[$index]));
				// save workshift
				//$this->workday_model->add_workshift($pg_id_ws[$index],$sn,$shift_st,$shift_et,$shift_wh[$index],$ws_sel[$index]);
			}
			// worday settings
			$main_pg_id = $this->input->post('main_pg_id');
			$workday_type = $this->input->post('workday_type');
			$num_of_break = $this->input->post('num_of_break');
			$wd_py = $this->input->post('wd_py');
			$dl_py = $this->input->post('dl_py');
			$dsb_py = $this->input->post('dsb_py');
			$flex_chk_sel = $this->input->post('flex_chk_sel');
			$flex_h = $this->input->post('flex_h');
			$flex_m = $this->input->post('flex_m');
			$flex_p = $this->input->post('flex_p');
			foreach($main_pg_id as $index=>$pg){
				if($flex_chk_sel[$index]==1){
					$flex = date("H:i:s",strtotime($flex_h[$index].":".$flex_m[$index]." ".$flex_p[$index]));
				}else{
					$flex = "";
				}
				// save workday settings
				//$this->workday_model->set_workday_settings($pg,$workday_type[$index],$num_of_break[$index],$wd_py[$index],$dl_py[$index],$dsb_py[$index],$flex_chk_sel[$index],$flex);
			}
		}
		$data['pg_sql'] = $this->workday_model->get_payroll_group();
		$this->layout->view('pages/payroll_setup/workday_view',$data);
	}
	
}

/* End of file */