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
			$pc_id = $this->input->post('pc_id');
			$semi_monthly = $this->input->post('semi_monthly');
			$monthly = $this->input->post('monthly');
			$payroll_date = $this->input->post('payroll_date');
			$cut_off_from = $this->input->post('cut_off_from');
			$cut_off_to = $this->input->post('cut_off_to');
			foreach($pg_id as $index=>$val){
				$payroll_date2 = date('Y-m-d',strtotime($payroll_date[$index]));
				$cut_off_from2 = date('Y-m-d',strtotime($cut_off_from[$index]));
				$cut_off_to2 = date('Y-m-d',strtotime($cut_off_to[$index]));
				if($pc_id[$index]==""){
					$this->payroll_calendar_model->add_payroll_calendar($val,$semi_monthly[$index],$monthly[$index],$payroll_date2,$cut_off_from2,$cut_off_to2);
				}else{
					$this->payroll_calendar_model->update_payroll_calendar($pc_id[$index],$semi_monthly[$index],$monthly[$index],$payroll_date2,$cut_off_from2,$cut_off_to2);
				}
				
			}
			setcookie('msg', "All payroll Calendar has been Saved");
		}
		$data['pg_sql'] = $this->payroll_calendar_model->get_payroll_group();
		$this->layout->view('pages/payroll_setup/payroll_calendar_view',$data);
		
	}
	
	public function ajax_add_payroll_calendar(){
		$pg_id = $this->input->post('pg_id');
		$first_semi_monthly = $this->input->post('first_semi_monthly');
		$second_monthly = $this->input->post('second_monthly');
		$first_payroll_date = $this->input->post('first_payroll_date');
		$first_payroll_date2 = date('Y-m-d',strtotime($first_payroll_date));
		$cut_off_from = $this->input->post('cut_off_from');
		$cut_off_from2 = date('Y-m-d',strtotime($cut_off_from));
		$cut_off_to = $this->input->post('cut_off_to');
		$cut_off_to2 = date('Y-m-d',strtotime($cut_off_to));
		$pc_id = $this->input->post('pc_id');
		if($pc_id==""){
			$this->payroll_calendar_model->add_payroll_calendar($pg_id,$first_semi_monthly,$second_monthly,$first_payroll_date2,$cut_off_from2,$cut_off_to2);
		}else{
			$this->payroll_calendar_model->update_payroll_calendar($pc_id,$first_semi_monthly,$second_monthly,$first_payroll_date2,$cut_off_from2,$cut_off_to2);
		}
		
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
	
	public function ajax_show_calendar(){
		$pc_id = $this->input->post('pc_id');
		$pc_sql = $this->payroll_calendar_model->get_next_payroll_list($pc_id);
		if($pc_sql->num_rows()>0){
			$pc = $pc_sql->row();
			$pd = $pc->first_payroll_date;
			$year = date("Y",strtotime($pd));
			$cof = $pc->cut_off_from;
			$cot = $pc->cut_off_to;
			$period = $pc->first_payroll_date;
			$first_semi_monthly = $pc->first_semi_monthly;
			$second_monthly = $pc->second_monthly;
		}else{
			$year = "";
			$pd = "";
			$cof = "";
			$cot = "";
			$period = "";
			$first_semi_monthly = "";
			$second_monthly = "";
		}
		$str = '
			<div style="text-align:center;margin-bottom: 10px;">'.$year.'</div> 
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
					// while loop
					$last_day = ($second_monthly==-1)?date("t",strtotime("December {$year}")):$second_monthly;
					$last_payroll = date("Y-m-d",strtotime("December {$last_day} {$year}"));
					$i=0;
					while($pd<$last_payroll){
					
						if($i>0){
							$pd_day = date("d",strtotime($pd));
							$pd_month_txtual = date("F",strtotime($pd));
							if($pd_day==$first_semi_monthly){
								//$day = ($second_monthly==-1)?date("t",strtotime($pd)):$second_monthly;	
								if($second_monthly==-1){
									$day = date("t",strtotime($pd));
								}else{
									if($second_monthly>=29&&$pd_month_txtual=="February"){
										$day = date("t",strtotime($pd));
									}else{
										$day = $second_monthly;
									}
									if($second_monthly==31&&$pd_month_txtual!="February"){
										$ld = date("t",strtotime($pd));
										$day = ($ld==31)?$second_monthly:$ld;
									}
								}
							}else{
								$day = $first_semi_monthly;
								$month = date("m",strtotime("{$pd_month_txtual} + 1 month"));
							} 
							$pd = date("Y-m-d",strtotime("{$year}-{$month}-{$day}"));
							$cof = date('Y-m-d',strtotime($cot."+ 1 day"));
							$cot = date('Y-m-d',strtotime($cot."+ 15 days"));
						}
						
						$str .= '<tr>	
									<td>
									<input class="txtfield dp edit_payroll_date" type="text" value="'.date("m/d/Y",strtotime($pd)).'" /></td>
									<td><input class="txtfield dp edit_cut_off_from" type="text" value="'.date("m/d/Y",strtotime($cof)).'" /></td>
									<td><input class="txtfield dp edit_cut_off_to" type="text" value="'.date("m/d/Y",strtotime($cot)).'" /></td>
									<td><input class="txtfield period" type="text" style="width: 20px;" value="'.date("n",strtotime($pd)).'" /></td>
								</tr>';
					$i++;
					}
				
	
				$str .= '</tbody>
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
	
	public function test(){
		echo date("t",strtotime("January 2014"));
	}
	
}

/* End of file */