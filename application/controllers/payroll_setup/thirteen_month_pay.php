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
	//	$data['thirteen_month'] = $this->thirteen_month_pay->get_thirteen_month_pay($this->company_id);	
		$data['get_payroll_group_setup'] = $this->thirteen_month_pay->get_payroll_group_setup($this->company_id);
		
		
		if($this->input->post('submit')){	
			$this->form_validation->set_rules("payroll_group_id[]","Payroll Group ID","xss_clean|trim|required");
			if($this->form_validation->run() == true){
				$payroll_group_id = $this->input->post('payroll_group_id');	
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
				
				$add_another_bonus = $this->input->post('add_another_bonus');
	
				foreach($payroll_group_id as $pgi_key=>$pgi_val):
					
					$field = array(
						"payroll_group_id"			=> $pgi_val,
						"process_by"	=> $thirteen_month_process[$pgi_key],
						"first_month_payroll_date"	=> date_clean($first_month_payroll_date[$pgi_key]),
						"first_month_payroll_from"	=> date_clean($first_month_payroll_from[$pgi_key]),	
						"first_month_payroll_to"	=> date_clean($first_month_payroll_to[$pgi_key]),
						"second_month_payroll_date"	=> date_clean($second_month_payroll_date[$pgi_key]),
						"second_month_payroll_from"	=> date_clean($second_month_payroll_from[$pgi_key]),	
						"second_month_payroll_to"	=> date_clean($second_month_payroll_to[$pgi_key]),			
						"third_month_payroll_date"	=> date_clean($third_month_payroll_date[$pgi_key]),			
						"third_month_payroll_from"	=> date_clean($third_month_payroll_from[$pgi_key]),
						"third_month_payroll_to"	=> date_clean($third_month_payroll_to[$pgi_key]),
						"fourth_month_payroll_date"	=> date_clean($fourth_month_payroll_date[$pgi_key]),
						"fourth_month_payroll_from"	=> date_clean($fourth_month_payroll_from[$pgi_key]),			
						"fourth_month_payroll_to"	=> date_clean($fourth_month_payroll_to[$pgi_key]),
						"fifth_month_payroll_date"	=> date_clean($fifth_month_payroll_date[$pgi_key]),
						"fifth_month_payroll_from"	=> date_clean($fifth_month_payroll_from[$pgi_key]),			
						"fifth_month_payroll_to"	=> date_clean($fifth_month_payroll_to[$pgi_key]),			
						"sixth_month_payroll_date"	=> date_clean($sixth_month_payroll_date[$pgi_key]),			
						"sixth_month_payroll_from"	=> date_clean($sixth_month_payroll_from[$pgi_key]),
						"sixth_month_payroll_to"	=> date_clean($sixth_month_payroll_to[$pgi_key]),
						"seventh_month_payroll_date"=> date_clean($seventh_month_payroll_date[$pgi_key]),
						"seventh_month_payroll_from"=> date_clean($seventh_month_payroll_from[$pgi_key]),			
						"seventh_month_payroll_to"	=> date_clean($seventh_month_payroll_to[$pgi_key]),
						"eight_month_payroll_date"	=> date_clean($eight_month_payroll_date[$pgi_key]),
						"eight_month_payroll_from"	=> date_clean($eight_month_payroll_from[$pgi_key]),			
						"eight_month_payroll_to"	=> date_clean($eight_month_payroll_to[$pgi_key]),			
						"ninth_month_payroll_date"	=> date_clean($ninth_month_payroll_date[$pgi_key]),			
						"ninth_month_payroll_from"	=> date_clean($ninth_month_payroll_from[$pgi_key]),	
						"ninth_month_payroll_to"	=> date_clean($ninth_month_payroll_to[$pgi_key]),
						"tenth_month_payroll_date"	=> date_clean($tenth_month_payroll_date[$pgi_key]),
						"tenth_month_payroll_from"	=> date_clean($tenth_month_payroll_from[$pgi_key]),
						"eleventh_month_payroll_date"	=> date_clean($eleventh_month_payroll_date[$pgi_key]), 
						"eleventh_month_payroll_from"	=> date_clean($eleventh_month_payroll_from[$pgi_key]),
						"eleventh_month_payroll_to"		=> date_clean($eleventh_month_payroll_to[$pgi_key]),
						"twelveth_month_payroll_date"	=> date_clean($twelveth_month_payroll_date[$pgi_key]),
						"twelveth_month_payroll_from"	=> date_clean($twelveth_month_payroll_from[$pgi_key]),
						"twelveth_month_payroll_to"	=> date_clean($twelveth_month_payroll_to[$pgi_key]),
						"first_quarter_date"	=> date_clean($first_quarter_date[$pgi_key]),
						"first_quarter_from"	=> date_clean($first_quarter_from[$pgi_key]),
						"first_quarter_to"		=> date_clean($first_quarter_to[$pgi_key]),
						"second_quarter_date"	=> date_clean($second_quarter_date[$pgi_key]),
						"second_quarter_from"	=> date_clean($second_quarter_from[$pgi_key]),
						"second_quarter_to"		=> date_clean($second_quarter_to[$pgi_key]),
						"third_quarter_date"	=> date_clean($third_quarter_date[$pgi_key]),
						"third_quarter_from"	=> date_clean($third_quarter_from[$pgi_key]),
						"third_quarter_to"		=> date_clean($third_quarter_to[$pgi_key]),
						"add_another_bonus"		=> $add_another_bonus[$pgi_key],
						'deleted'				=> '0'	
					);
	
					p($field);
					#CHECK FIRST BEFORE WE SAVE THE FILE IT MAY BE A SAVE OPTION OTHERWISE WE UPDATE IT ON 
					$check_payroll_group = $this->thirteen_month_pay->check_thirteen_month_pay_exist($this->company_id,$pgi_val);
					if($check_payroll_group){ # EXIST ALREADY SO WE MUST UPDATE
						$where_update = array("company_id"=>$this->company_id,"payroll_group_id"=>$this->db->escape_str($pgi_val));
						$this->thirteen_month_pay->update_thirteen_month_pay($where_update,$field);
					}else{ # NOT EXIST MEANING MUST SAVE ONLY
						$field['company_id'] = $this->company_id; # CREATE AN ARRAY OF COMPANY_ID to store on save 	
						$this->thirteen_month_pay->save_thirteen_month_pay($field);
					}	
				endforeach;
				$this->session->set_flashdata("success","data had been saved");
				redirect('/'.$this->uri->uri_string());
			}else{
			
			}
		}
		// data
		$this->layout->view('pages/payroll_setup/thirteen_month_pay_view',$data);
	}
	
}

/* End of file */