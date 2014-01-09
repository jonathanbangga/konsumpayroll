<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Thirteen moth pay 
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
class Thirteen_month_pay extends CI_Controller {
	
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
		$this->load->model('payroll_setup/thirteen_month_pay_model','thirteen_month_pay');	
		$this->company_id = $this->session->userdata("company_id");
	}

	public function index(){
		// header and menu's
		
		$data['page_title'] = "13th Month Pay";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		$data['thirteen_month'] = $this->thirteen_month_pay->get_thirteen_month_pay($this->company_id);	
		if($this->input->post('submit')){			
			$thirteen_month_process = $this->input->post('thirteen_month_process');
			$first_month_payroll_date = $this->input->post('first_month_payroll_date');
			$first_month_payroll_from = $this->input->post('first_month_payroll_from');
			$first_month_payroll_to = $this->input->post('first_month_payroll_to');
			
			$second_month_payroll_date = $this->input->post('second_month_payroll_date');
			$second_month_payroll_from = $this->input->post('second_month_payroll_from');
			$second_month_payroll_to = $this->input->post('second_month_payroll_to');
			
			$third_month_payroll_date = $this->input->post('third_month_payroll_date');
			$third_month_payroll_from = $this->input->post('third_month_payroll_from');
			$third_month_payroll_to = $this->input->post('third_month_payroll_to');
			
			$fourth_month_payroll_date = $this->input->post('fourth_month_payroll_date');
			$fourth_month_payroll_from = $this->input->post('fourth_month_payroll_from');
			$fourth_month_payroll_to = $this->input->post('fourth_month_payroll_to');
			
			$fifth_month_payroll_date = $this->input->post('fifth_month_payroll_date');
			$fifth_month_payroll_from = $this->input->post('fifth_month_payroll_from');
			$fifth_month_payroll_to = $this->input->post('fifth_month_payroll_to');
			
			$sixth_month_payroll_date = $this->input->post('sixth_month_payroll_date');
			$sixth_month_payroll_from = $this->input->post('sixth_month_payroll_from');
			$sixth_month_payroll_to = $this->input->post('sixth_month_payroll_to');
			
			$seventh_month_payroll_date = $this->input->post('seventh_month_payroll_date');
			$seventh_month_payroll_from = $this->input->post('seventh_month_payroll_from');
			$seventh_month_payroll_to = $this->input->post('seventh_month_payroll_to');
			
			$eight_month_payroll_date = $this->input->post('eight_month_payroll_date');
			$eight_month_payroll_from = $this->input->post('eight_month_payroll_from');
			$eight_month_payroll_to = $this->input->post('eight_month_payroll_to');
			
			$ninth_month_payroll_date = $this->input->post('ninth_month_payroll_date');
			$ninth_month_payroll_from = $this->input->post('ninth_month_payroll_from');
			$ninth_month_payroll_to = $this->input->post('ninth_month_payroll_to');
			
			$tenth_month_payroll_date = $this->input->post('tenth_month_payroll_date');
			$tenth_month_payroll_from = $this->input->post('tenth_month_payroll_from');
			$tenth_month_payroll_to = $this->input->post('tenth_month_payroll_to');
			
			$eleventh_month_payroll_date = $this->input->post('eleventh_month_payroll_date');
			$eleventh_month_payroll_from = $this->input->post('eleventh_month_payroll_from');
			$eleventh_month_payroll_to = $this->input->post('eleventh_month_payroll_to');
			
			$twelveth_month_payroll_date = $this->input->post('twelveth_month_payroll_date');
			$twelveth_month_payroll_from = $this->input->post('twelveth_month_payroll_from');
			$twelveth_month_payroll_to = $this->input->post('twelveth_month_payroll_to');
			
			$first_quarter_date = $this->input->post('first_quarter_date');
			$first_quarter_from = $this->input->post('first_quarter_from');
			$first_quarter_to = $this->input->post('first_quarter_to');
			
			$second_quarter_date = $this->input->post('second_quarter_date');
			$second_quarter_from = $this->input->post('second_quarter_from');
			$second_quarter_to = $this->input->post('second_quarter_to');
			
			$third_quarter_date = $this->input->post('third_quarter_date');
			$third_quarter_from = $this->input->post('third_quarter_from');
			$third_quarter_to = $this->input->post('third_quarter_to');
			
			$add_another_bonus 		= $this->input->post('add_another_bonus');
			$often_process_payroll2 = $this->input->post('often_process_payroll2');
			$schedule_date_release	= $this->input->post('schedule_date_release');
			$add_second_bonus		= $this->input->post('add_second_bonus');
	
			$field = array(
				"process_by"	=> $thirteen_month_process,
				"first_month_payroll_date"	=> $first_month_payroll_date,
				"first_month_payroll_from"	=> $first_month_payroll_from,		
				"first_month_payroll_to"	=> $first_month_payroll_to,
				"second_month_payroll_date"	=> $second_month_payroll_date,
				"second_month_payroll_from"	=> $second_month_payroll_from,	
				"second_month_payroll_to"	=> $second_month_payroll_to,			
				"third_month_payroll_date"	=> $third_month_payroll_date,			
				"third_month_payroll_from"	=> $third_month_payroll_from,
				"third_month_payroll_to"	=> $third_month_payroll_to,
				"fourth_month_payroll_date"	=> $fourth_month_payroll_date,
				"fourth_month_payroll_from"	=> $fourth_month_payroll_from,			
				"fourth_month_payroll_to"	=> $fourth_month_payroll_to,
				"fifth_month_payroll_date"	=> $fifth_month_payroll_date,
				"fifth_month_payroll_from"	=> $fifth_month_payroll_from,			
				"fifth_month_payroll_to"	=> $fifth_month_payroll_to,			
				"sixth_month_payroll_date"	=> $sixth_month_payroll_date,			
				"sixth_month_payroll_from"	=> $sixth_month_payroll_from,
				"sixth_month_payroll_to"	=> $sixth_month_payroll_to,
				"seventh_month_payroll_date"=> $seventh_month_payroll_date,
				"seventh_month_payroll_from"=> $seventh_month_payroll_from,			
				"seventh_month_payroll_to"	=> $seventh_month_payroll_to,
				"eight_month_payroll_date"	=> $eight_month_payroll_date,
				"eight_month_payroll_from"	=> $eight_month_payroll_from,			
				"eight_month_payroll_to"	=> $eight_month_payroll_to,			
				"ninth_month_payroll_date"	=> $ninth_month_payroll_date,			
				"ninth_month_payroll_from"	=> $ninth_month_payroll_from,	
				"ninth_month_payroll_to"	=> $ninth_month_payroll_to,
				"tenth_month_payroll_date"	=> $tenth_month_payroll_date,
				"tenth_month_payroll_from"	=> $tenth_month_payroll_from,
				"eleventh_month_payroll_date"	=> $eleventh_month_payroll_date, 
				"eleventh_month_payroll_from"	=> $eleventh_month_payroll_from,
				"eleventh_month_payroll_to"		=> $eleventh_month_payroll_to,
				"twelveth_month_payroll_date"	=> $twelveth_month_payroll_date,
				"twelveth_month_payroll_from"	=> $twelveth_month_payroll_from,
				"twelveth_month_payroll_to"	=> $twelveth_month_payroll_to,
				"first_quarter_date"	=> $first_quarter_date,
				"first_quarter_from"	=> $first_quarter_from,
				"first_quarter_to"		=> $first_quarter_to,
				"second_quarter_date"	=> $second_quarter_date,
				"second_quarter_from"	=> $second_quarter_from,
				"second_quarter_to"		=> $second_quarter_to,
				"third_quarter_date"	=> $third_quarter_date,
				"third_quarter_from"	=> $third_quarter_from,
				"third_quarter_to"		=> $third_quarter_to,
				"add_another_bonus"		=> $add_another_bonus,
				"often_process_payroll2"=> $often_process_payroll2,
				"schedule_date_release"	=> $schedule_date_release,
				"add_second_bonus"		=> $add_second_bonus,
				'deleted'				=> '0'		
			);

			# IF WE HAVE A DATA ON THE 13MONTH PAY WILL JUST HAVE TO UPDATE IT NOT SAVE
			if($data['thirteen_month']){	
				$this->thirteen_month_pay->update_thirteen_month_pay($this->company_id,$field);
			}else{ # ELSE IF WE DON'T HAVE DATA ON IT WILL JUST SAVE IT OKAY?			
				$field['company_id'] = $this->company_id;
				$this->thirteen_month_pay->update_thirteen_month_pay($this->company_id,$field);
			} # END OF CONDITION
		}
		// data
		$this->layout->view('pages/payroll_setup/thirteen_month_pay_view',$data);
	}
	
}

/* End of file */