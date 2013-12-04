<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Amortization Schedule Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_amortization_schedule extends CI_Controller {
		
		/**
		 * Theme options - default theme
		 * @var string
		 */
		var $theme;
		
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->theme = $this->config->item('default');
			$this->load->model('konsumglobal_jmodel','jmodel');
			$this->load->model('hr/hr_employee_model','hr_emp');

			$this->loan_no = $this->uri->segment(5);
			$this->sidebar_menu = 'content_holders/hr_employee_sidebar_menu';
			$this->menu = 'content_holders/company_menu';
			$this->url = $url = "/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5);
			
			$this->company_info = whose_company();
			
			if(count($this->company_info) == 0){
				show_error("Invalid subdomain");
				return false;
			}
			$this->company_id = $this->company_info->company_id;
		}
		
		/**
		 * index page
		 */
		public function index() {
			
			$check_amortization_sched_id = $this->hr_emp->check_amortization_sched_id($this->uri->segment(5),$this->company_id);
			if($check_amortization_sched_id == FALSE){
				show_error("Invalid parameter");
				return false;
			}
			
			$data['page_title'] = "Amortization Schedule";
			$data['sidebar_menu'] = $this->sidebar_menu;
			
			// init pagination
			$uri = "/{$this->uri->segment(1)}/hr/emp_amortization_schedule/index/{$this->loan_no}/";
			$total_rows = $this->hr_emp->emp_amortization_sched_counter($this->company_id, $this->loan_no);
			
			$per_page = $this->config->item('per_page');
			$segment=6;
			
			init_pagination($uri,$total_rows,$per_page,$segment);
	
			$page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
			$data["links"] = $this->pagination->create_links();
			// end pagination
			
			$data['emp_amortization'] = $this->hr_emp->emp_amortization_sched($per_page, $page, $this->company_id, $this->loan_no);
			
			$query = $this->hr_emp->emp_loan_no_group($this->company_id, $this->loan_no);
			$data['emp_info'] = $query;
			
			if($this->input->post('add')){
				$loan_no = $this->input->post('loan_no');
				$payroll_date = $this->input->post('payroll_date');				
				#$payment = $this->input->post('payment');
				$interest = $this->input->post('interest');
				$principal = $this->input->post('principal');
				
				foreach($loan_no as $key2=>$val){
					$this->form_validation->set_rules("loan_no[{$key2}]", 'Loan No', 'trim|required|xss_clean');
					$this->form_validation->set_rules("payroll_date[{$key2}]", 'Payroll Date', 'trim|required|xss_clean');
					#$this->form_validation->set_rules("payment[{$key2}]", 'Payment', 'trim|required|xss_clean');
					$this->form_validation->set_rules("interest[{$key2}]", 'Interest', 'trim|required|xss_clean');
					$this->form_validation->set_rules("principal[{$key2}]", 'Pricipal', 'trim|required|xss_clean');
				}
				
				if ($this->form_validation->run()==true){
					
					foreach($loan_no as $key=>$val){
						$payment_val = $interest[$key] + $principal[$key];
                	    $add_emp_amortization_sched = array(								
							'payroll_date' => $payroll_date[$key],
                	    	'payment' => $payment_val,
							'interest' => $interest[$key],
							'principal' => $principal[$key],
                	    	'emp_loan_id' => $loan_no[$key],
                	    	'comp_id' => $this->company_id
						);

						$this->jmodel->insert_data('employee_amortization_schedule',$add_emp_amortization_sched);
					}

					$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully saved!</div>');
					redirect($this->url);
					return false;
				}
			}
			
			if($this->input->post('update_info')){
				
				$employee_amortization_schedule_id = $this->input->post('employee_amortization_schedule_id');
				$payroll_date = $this->input->post('payroll_date');
				#$payment = $this->input->post('payment');
				$interest = $this->input->post('interest');
				$principal = $this->input->post('principal');
				
				$this->form_validation->set_rules("employee_amortization_schedule_id", 'Employee Amortization Schedule ID', 'trim|required|xss_clean');
				$this->form_validation->set_rules("payroll_date", 'Payroll Date', 'trim|required|xss_clean');
				#$this->form_validation->set_rules("payment", 'Payment', 'trim|required|xss_clean');
				$this->form_validation->set_rules("interest", 'Interest', 'trim|required|xss_clean');
				$this->form_validation->set_rules("principal", 'Principal', 'trim|required|xss_clean');
				
				if ($this->form_validation->run()==true){
					$payment_value = $interest + $principal;
					$update_info = $this->hr_emp->update_amortization_info(
						$employee_amortization_schedule_id,
						$payroll_date,
						$payment_value,
						$interest,
						$principal,
						$this->company_id);
					if($update_info){
						$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully updated!</div>');
						echo json_encode(array("success"=>1));
						redirect($this->url);
						return false;
					}else{
						echo json_encode(array("success"=>0));
						return false;
					}
				}else{
					$error = validation_errors('<span class="error_zone">','</span>');
					echo json_encode(array("success"=>"0","error_msg"=>$error));
					return false;
				}
			}
			
			if($this->input->is_ajax_request()) {
				// Delete Employee Amortization Schedule Information
				if($this->input->post('delete_db')){
					$loan_id = $this->input->post('loan_id');
					$delete_me = $this->db->query("DELETE FROM employee_amortization_schedule WHERE employee_amortization_schedule_id = '{$loan_id}' and comp_id = '{$this->company_id}'");
					if($delete_me){
						$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully deleted!</div>');
						echo json_encode(array("success"=>1,"url"=>$this->url));
						return false;
					}
				}
				
				// Get Information for Employee Amortization Schedule
				if($this->input->post('get_information')){
					$employee_amortization_schedule_id = $this->input->post('employee_amortization_schedule_id');
					$get_info = $this->db->query("
						SELECT *FROM employee_amortization_schedule
						WHERE employee_amortization_schedule_id = '{$employee_amortization_schedule_id}' and comp_id = '{$this->company_id}'
					");
					if($get_info->num_rows() > 0){
						$get_info_row = $get_info->row();
						$get_info->free_result();
						echo json_encode(
							array(
								"success"=>1,
								"employee_amortization_schedule_id"=>$get_info_row->employee_amortization_schedule_id,
								"payroll_date"=>$get_info_row->payroll_date,
								"payment"=>$get_info_row->payment,
								"interest"=>$get_info_row->interest,
								"principal"=>$get_info_row->principal,
								"emp_loan_id"=>$get_info_row->emp_loan_id
							)
						);
						return false;
					}else{
						echo json_encode(array("success"=>0));
						return false;
					}
				}
			}
			
			$this->layout->set_layout($this->theme);
			$this->layout->view('pages/hr/emp_amortization_sched_view', $data);
		}
	
	}

/* End of file Emp_amortization_schedule.php */
/* Location: ./application/controllers/hr/Emp_amortization_schedule.php */