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
		
			// clear data
			$this->workday_model->clear_all_db_in_workday();
			
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
			$is_delete = $this->input->post('is_delete');
			
			// add assign worktype to payroll group
			$workday_type = $this->input->post('workday_type');
			$main_pg_id = $this->input->post('main_pg_id');
			$num_of_break = $this->input->post('num_of_break');
			$working_day_per_year = $this->input->post('working_day_per_year');
			$flex_chk_sel = $this->input->post('flex_chk_sel');
			$flex_h = $this->input->post('flex_h');
			$flex_m = $this->input->post('flex_m');
			$flex_p = $this->input->post('flex_p');
		
			// working day drop down
			foreach($workday_type as $pgi=>$wt){	
				// if selected workday type
				if($wt!=""){
					// add workday
					$this->workday_model->add_workday($wt,$main_pg_id[$pgi]);
				
					if($flex_chk_sel[$pgi]==1){
						$flex = date("H:i:s",strtotime($flex_h[$pgi].":".$flex_m[$pgi]." ".$flex_p[$pgi]));
					}else{
						$flex = "";
					}
					
					switch($wt){
						case "Uniform Working Days":
							$this->workday_model->set_uniform_working_day_settings($num_of_break[$pgi],$working_day_per_year[$pgi],$flex_chk_sel[$pgi],$flex,$main_pg_id[$pgi]);
						break;
						case "Flexible Hours":
							// flexible hours
							$tot_h_pd = $this->input->post('tot_h_pd');	
							$tot_wd_pw = $this->input->post('tot_wd_pw');					
							$tot_days_py = $this->input->post('tot_days_py');
							$lta_h = $this->input->post('lta_h');
							$lta_m = $this->input->post('lta_m');
							$lta_p = $this->input->post('lta_p');
							$lta = date("H:i:s",strtotime($lta_h[$pgi].":".$lta_m[$pgi]." ".$lta_p[$pgi]));
							$num_breaks_pd = $this->input->post('num_breaks_pd');
							$dur_lb_pd = $this->input->post('dur_lb_pd');
							//$dur_sb_pd = $this->input->post('dur_sb_pd');
							$b1 = $this->input->post('flex_break1');
							$b2 = $this->input->post('flex_break2');
							$b3 = $this->input->post('flex_break3');
							$b4 = $this->input->post('flex_break4');
							$main_pg_id = $this->input->post('main_pg_id');
							// save
							$this->workday_model->add_flexible_hours($tot_h_pd[$pgi],$tot_wd_pw[$pgi],$tot_days_py[$pgi],$lta,$num_breaks_pd[$pgi],$b1,$b2,$b3,$b4,$dur_lb_pd[$pgi],$main_pg_id[$pgi]);
						break;
						case "Workshift":
							// workshift settings
							$ws_break = $this->input->post('ws_break');
							$shift_wd_py = $this->input->post('shift_wd_py');
							$grace_value = $this->input->post('grace_value');
							$main_pg_id = $this->input->post('main_pg_id');
							$this->workday_model->set_workshift_settings($ws_break[$pgi],$shift_wd_py[$pgi],$grace_value[$pgi],$main_pg_id[$pgi]);
						break;
					}	
				}
			}
	
			// working days
			$wt_name = $this->input->post('wt_name');
			foreach($workday as $wd){
				$wd2 = explode("-",$wd);
				$day = $wd2[0];
				$index = $wd2[1];
				$start_time = date("H:i:s",strtotime($start_time_h[$index].":".$start_time_m[$index]." ".$start_time_p[$index]));
				$end_time = date("H:i:s",strtotime($end_time_h[$index].":".$end_time_m[$index]." ".$end_time_p[$index]));
				
				$work = 0;
				$work2 = 0;
				$w1 = strtotime($start_time);
				$w2 = strtotime($end_time);
				$work = $w2 - $w1;
				$work2 = $work/3600;

				$break = 0;
				$break2 = 0;
				for($i=0;$i<$break_last_index[$index];$i++){
				
					$bt_st_h = $this->input->post('bt_st_h'.$i);
					$bt_st_m = $this->input->post('bt_st_m'.$i);
					$bt_st_p = $this->input->post('bt_st_p'.$i);
					$bt_start_time = date("H:i:s",strtotime($bt_st_h[$index].":".$bt_st_m[$index]." ".$bt_st_p[$index]));
					$bt_et_h = $this->input->post('bt_et_h'.$i);
					$bt_et_m = $this->input->post('bt_et_m'.$i);
					$bt_et_p = $this->input->post('bt_et_p'.$i);
					$bt_end_time = date("H:i:s",strtotime($bt_et_h[$index].":".$bt_et_m[$index]." ".$bt_et_p[$index]));
		
					$bt1 = strtotime($bt_start_time);
					$bt2 = strtotime($bt_end_time);
					$break = $bt2 - $bt1;
					$break2 += $break/3600;
					
				}

			
				$wh = $work2-$break2;
				
				// save workdays
				$this->workday_model->add_uniform_working_day($day,$start_time,$end_time,$wh,$pg_id[$index]);
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
					// add break time
					$this->workday_model->add_break_time($pg_id[$index],$day,$bt_start_time,$bt_end_time,$i,$wt_name[$index]);
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
			$shift_bt_st_h = $this->input->post('shift_bt_st_h');
			$shift_bt_st_m= $this->input->post('shift_bt_st_m');
			$shift_bt_st_p = $this->input->post('shift_bt_st_p');
			$shift_bt_et_h = $this->input->post('shift_bt_et_h');
			$shift_bt_et_m= $this->input->post('shift_bt_et_m');
			$shift_bt_et_p = $this->input->post('shift_bt_et_p');
			$shift_wh = $this->input->post('shift_wh');
			$ws_last_index = $this->input->post('ws_last_index');
			$ws_wt_name = $this->input->post('ws_wt_name');
			$wsbtid = $this->input->post('wsbtid');
			
			foreach($shift_name as $index=>$sn){
				$shift_st = date("H:i:s",strtotime($shift_st_h[$index].":".$shift_st_m[$index]." ".$shift_st_p[$index]));
				$shift_et = date("H:i:s",strtotime($shift_et_h[$index].":".$shift_et_m[$index]." ".$shift_et_p[$index]));
	
				// save workshift
				$wsid = $this->workday_model->add_workshift($pg_id_ws[$index],$sn,$shift_st,$shift_et,$shift_wh[$index],$ws_sel[$index]);
				// loop through number of breaks
				for($i=0;$i<$ws_last_index[$index];$i++){
					$shift_bt_st_h = $this->input->post('shift_bt_st_h'.$i);
					$shift_bt_st_m = $this->input->post('shift_bt_st_m'.$i);
					$shift_bt_st_p = $this->input->post('shift_bt_st_p'.$i);
					$shift_bt_st = date("H:i:s",strtotime($shift_bt_st_h[$index].":".$shift_bt_st_m[$index]." ".$shift_bt_st_p[$index]));
					$shift_bt_et_h = $this->input->post('shift_bt_et_h'.$i);
					$shift_bt_et_m = $this->input->post('shift_bt_et_m'.$i);
					$shift_bt_et_p = $this->input->post('shift_bt_et_p'.$i);
					$shift_bt_et = date("H:i:s",strtotime($shift_bt_et_h[$index].":".$shift_bt_et_m[$index]." ".$shift_bt_et_p[$index]));
					// add break time
					$this->workday_model->add_break_time($pg_id_ws[$index],'',$shift_bt_st,$shift_bt_et,$i,$ws_wt_name[$index],$wsid);
				}
			}
			
			setcookie("msg","Submission successful!"); 
		}
		
		$data['pg_sql'] = $this->workday_model->get_payroll_group();
		$this->layout->view('pages/payroll_setup/workday_view',$data);
		
	}
	
	public function ajax_delete_workshift(){
		$wsid = $this->input->post('wsid');
		$this->workday_model->delete_workshift($wsid);
	}
	
	public function test(){
	
		$time1 = strtotime('08:00:00');
		$time2 = strtotime('18:00:00');
		$work = $time2 - $time1;
		$work2 = $work/3600;
		
		$time1 = strtotime('12:00:00');
		$time2 = strtotime('13:00:00');
		$break = $time2 - $time1;
		$break2 = $break/3600;
		
		$working_hours = $work2-$break2;
		
		echo "work: ".$work2."<br />".
			 "break: ".$break2."<br />".
			 "working hours: ".$working_hours."<br />";
		
	}
	
}

/* End of file */