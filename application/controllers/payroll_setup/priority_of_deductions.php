<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Priority_of_deductions extends CI_Controller {
	
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
		$this->load->model('payroll_setup/priority_of_deductions_model','priority_of_deductions');
		$this->company_id = $this->session->userdata("company_id");	
	}

	public function index(){
		$data['page_title'] = "Priority of Deductions";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		$data['priority_deducations'] = $this->priority_of_deductions->get_priority_of_deductions($this->company_id);
		$data['other_deducations']	= $this->priority_of_deductions->get_priority_of_deductions_other($this->company_id);
		$data['other_loans'] = $this->priority_of_deductions->get_priority_of_other_loan($this->company_id);
		
		# SUBMIT DATA
		if($this->input->post('submit')){		
			$this->form_validation->set_rules('philhealth','philhealth','xss_clean|trim|required');
			$this->form_validation->set_rules('sss','sss','xss_clean|trim|required');
			$this->form_validation->set_rules('withholding_tax','withholding tax','xss_clean|trim|required');
			$this->form_validation->set_rules('hdmf','hdmf','xss_clean|trim|required');
			$this->form_validation->set_rules('company_loan','hdmf','xss_clean|trim|required');
			$this->form_validation->set_rules('sss_salary_loan','hdmf','xss_clean|trim|required');
			$this->form_validation->set_rules('sss_calamity_loan','hdmf','xss_clean|trim|required');
			$this->form_validation->set_rules('sss_emergency_loan','hdmf','xss_clean|trim|required');
			if($this->form_validation->run() == true){	
				$philhealth		= $this->input->post('philhealth');
				$sss 			= $this->input->post('sss');
				$withholding_tax = $this->input->post('withholding_tax');
				$hdmf 				= $this->input->post('hdmf');
				$company_loan 		= $this->input->post('company_loan');
				$sss_salary_loan 	= $this->input->post('sss_salary_loan');
				$sss_calamity_loan 	= $this->input->post('sss_calamity_loan');
				$sss_emergency_loan = $this->input->post('sss_emergency_loan');
				$name 				= $this->input->post('name');
				$priority 			= $this->input->post('priority');
				$update_priority_id = $this->input->post('update_priority_id');
				$update_priority_name = $this->input->post('update_priority_name');
				$update_priority 	= $this->input->post('update_priority');	
				$add_loan_name 		= $this->input->post('add_loan_name');
				$add_loan_priority	= $this->input->post('add_loan_priority');
				$update_pod_id		= $this->input->post('update_pod_id');
				$update_loan_name	= $this->input->post('update_loan_name');
				$update_loan_priority = $this->input->post('update_loan_priority');
									
				# SAVE OTHER DEDUCTIONS PRIORITY
				if($priority){
					foreach($name as $key=>$val):
						$this->priority_of_deductions->save_priority_of_deductions_other($this->company_id,$val,$priority[$key]);
					endforeach;
				}	
				
				# UPDATE OTHER DEDUCTIONS PRIORITY 
				if($update_priority_id){
					foreach($update_priority_id as $upi_key=>$upi_val):
						$this->priority_of_deductions->update_priority_of_deductions_other($this->company_id,$upi_val,$update_priority_name[$upi_key],$update_priority[$upi_key]);
					endforeach;
				}	
						
				# SAVE LOAN 
				if($add_loan_name){
					foreach($add_loan_name as $aln_key=>$aln_val):
						$this->priority_of_deductions->save_priority_of_other_loan($this->company_id,$aln_val,$add_loan_priority[$aln_key]);
					endforeach;
				}		
				
				# UPDATE LOAN
				if($update_pod_id){
					foreach($update_pod_id as $pod_key=>$pod_val):
						$this->priority_of_deductions->update_priority_of_other_loan($this->company_id,$pod_val,$update_loan_name[$pod_key],$update_loan_priority[$pod_key]);
					endforeach;
				}
	
				# IF PRIORITY DEDUCATIONS HAS VALUE THEN NO NEED TO SAVE BUT UPDATES GO THROUGH ONLY
				if($data['priority_deducations']){
					$this->priority_of_deductions->update_priority_of_deducations($this->company_id,$philhealth,$sss,$withholding_tax,$hdmf,$company_loan,$sss_salary_loan,$sss_calamity_loan,$sss_emergency_loan);
					$this->session->set_flashdata("success","Priority of deductions had been updated!"); # WRITE A TEMPORARY SESSION STATUS
					redirect("/".$this->uri->uri_string()); # REDIRECT THIS SO THAT WE CAN GET FLASHDATA
				}else{ # ELSE IF PRIORITY DEDUCATION HAS NO VALUE THEN WE CAN PROCEED TO SAVE
					$this->priority_of_deductions->save_priority_of_deducations($this->company_id,$philhealth,$sss,$withholding_tax,$hdmf,$company_loan,$sss_salary_loan,$sss_calamity_loan,$sss_emergency_loan);
					$this->session->set_flashdata("success","Priority of deductions had been saved!"); # WRITE A TEMPORARY SESSION STATUS
					redirect("/".$this->uri->uri_string());  # REDIRECT THIS SO THAT WE CAN GET FLASHDATA
				}
			}
		}	
		$this->layout->view('pages/payroll_setup/priority_of_deductions_view',$data);
	}
	
	public function we(){
		$this->session->set_userdata("company_id","23");
	}
	
	public function ajax_remove_other_deductions(){
		if($this->input->is_ajax_request()){
			$id = $this->input->post('priority_of_deductions_other_id');
			if(is_numeric($id)){
				$res = $this->priority_of_deductions->remove_priority_of_deductions_other($this->company_id,$id);
				$this->session->set_flashdata("success","Other Deductions had been deleted!"); # WRITE A TEMPORARY SESSION STATUS
				echo json_encode(array("success"=>$res));
			}else{
				echo json_encode(array("success"=>'0','trigger'=>'hacked'));
			}
		}else{
			show_404();
		}
	}
	
	public function ajax_remove_other_loans(){
		if($this->input->is_ajax_request()){
			$id = $this->input->post('priority_of_deductions_other_id');
			if(is_numeric($id)){
				$res = $this->priority_of_deductions->remove_priority_of_other_loan($this->company_id,$id);
				$this->session->set_flashdata("success","Other Loans had been deleted!"); # WRITE A TEMPORARY SESSION STATUS
				echo json_encode(array("success"=>$res));
				return false;
			}else{
				echo json_encode(array("success"=>'0'));
				return false;
			}
		}else{
			show_404();
		}
	}
	
	
	
}

/* End of file */