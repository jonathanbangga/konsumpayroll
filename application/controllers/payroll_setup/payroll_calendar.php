<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payroll_calendar extends CI_Controller {
	
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
		$this->load->model('payroll_setup/payroll_calendar_model');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Payroll Calendar";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		if($this->input->post('save_all')){
			$pg_id = $this->input->post('pg_id');
			$semi_monthly = $this->input->post('semi_monthly');
			$monthly = $this->input->post('monthly');
			$payroll_date = $this->input->post('payroll_date');
			$cut_off_from = $this->input->post('cut_off_from');
			$cut_off_to = $this->input->post('cut_off_to');
			foreach($pg_id as $index=>$val){
				$payroll_date2 = date('Y-m-d',strtotime($payroll_date[$index]));
				$cut_off_from2 = date('Y-m-d',strtotime($cut_off_from[$index]));
				$cut_off_to2 = date('Y-m-d',strtotime($cut_off_to[$index]));
				$this->payroll_calendar_model->add_payroll_calendar($val,$semi_monthly[$index],$monthly[$index],$payroll_date2,$cut_off_from2,$cut_off_to2);
			}
			setcookie('msg', "All payroll Calendar has been Saved");
		}
		$data['pg_sql'] = $this->payroll_calendar_model->get_payroll_group();
		$this->layout->view('pages/payroll_setup/payroll_calendar_view',$data);
		
	}
	
	public function ajax_add_payroll_calendar(){
		$pg_id = $this->input->post('pg_id');
		$semi_monthly = $this->input->post('semi_monthly');
		$monthly = $this->input->post('monthly');
		$payroll_date = $this->input->post('payroll_date');
		$payroll_date2 = date('Y-m-d',strtotime($payroll_date));
		$cut_off_from = $this->input->post('cut_off_from');
		$cut_off_from2 = date('Y-m-d',strtotime($cut_off_from));
		$cut_off_to = $this->input->post('cut_off_to');
		$cut_off_to2 = date('Y-m-d',strtotime($cut_off_to));
		$this->payroll_calendar_model->add_payroll_calendar($pg_id,$semi_monthly,$monthly,$payroll_date2,$cut_off_from2,$cut_off_to2);
	}
	
	public function ajax_get_payroll_calendar_year(){
		$pg_id = $this->input->post('pg_id');
		$pgy_sql = $this->payroll_calendar_model->get_distinct_year($pg_id);
		$str = '
			<input type="hidden" id="pg_id" value="'.$pg_id.'" />
			<select class="txtselect" id="pcy_select" style="width: 80px;">
				<option value="">Select</option>';
		foreach($pgy_sql->result() as $pgy){
			$str .= "
				<option value='{$pgy->payroll_year}'>{$pgy->payroll_year}</option>"; 
		}
		$str .= '
			</select>';
		echo $str;
	}
	
	public function ajax_get_payroll_calendar(){
		$pg_id = $this->input->post('pg_id');
		$year = $this->input->post('year');
		$pc_sql = $this->payroll_calendar_model->get_payroll_calendar($pg_id,$year);
		$str = '
			<table>
				<thead>
					<tr>
						<th>Payroll Date</th>
						<th>From</th>
						<th>To</th>
						<th>Period</th>
					</tr>
				</thead>
				<tbody>';
		foreach($pc_sql->result() as $pc){
			$str .= '
					<tr>	
						<td style="display:none;">
							<input type="hidden" class="pc_id" value="'.$pc->payroll_calendar_id.'" />
							<input type="hidden" class="is_changed" value="0" />
						</td>
						<td><input class="txtfield dp edit_payroll_date" type="text" value="'.date("m/d/Y",strtotime($pc->payroll_date)).'" /></td>
						<td><input class="txtfield dp edit_cut_off_from" type="text" value="'.date("m/d/Y",strtotime($pc->cut_off_from)).'" /></td>
						<td><input class="txtfield dp edit_cut_off_to" type="text" value="'.date("m/d/Y",strtotime($pc->cut_off_to)).'" /></td>
						<td><input class="txtfield period" type="text" value="'.$pc->period.'" style="width: 20px;" /></td>
					</tr>
			';
		}	
		$str .= '
				</tbody>
			</table>';
		echo $str;
	}
	
	public function ajax_update_payroll_calendar(){
		$is_changed = $this->input->post('is_changed');
		$pc_id = $this->input->post('pc_id');
		$payroll_date = $this->input->post('payroll_date');
		$cut_off_from = $this->input->post('cut_off_from');
		$cut_off_to = $this->input->post('cut_off_to');
		$period = $this->input->post('period');
		foreach($is_changed as $index=>$val){
			if($val==1){
				$payroll_date2 = date('Y-m-d',strtotime($payroll_date[$index]));
				$cut_off_from2 = date('Y-m-d',strtotime($cut_off_from[$index]));
				$cut_off_to2 = date('Y-m-d',strtotime($cut_off_to[$index]));
				$this->payroll_calendar_model->update_payroll_calendar($pc_id[$index],$payroll_date2,$cut_off_from2,$cut_off_to2,$period[$index]);
			}
		}
		
	}
	
}

/* End of file */