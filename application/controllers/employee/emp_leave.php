<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Leave Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_leave extends CI_Controller {
		
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
			$this->load->model('konsumglobal_jmodel','jmodel');
			$this->load->model('employee/employee_model','employee');
			
			$this->url = "/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3);
			$this->theme = $this->config->item('jb_employee_temp');
			$this->menu = $this->config->item('jb_employee_menu');
			
			$this->company_info = whose_company();
			
			if(count($this->company_info) == 0){
				show_error("Invalid subdomain");
				return false;
			}
			$this->company_id = $this->company_info->company_id;
			$this->emp_id = $this->session->userdata('emp_id');
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "Leave History";
			
			// init pagination
			$uri = "/{$this->uri->segment(1)}/employee/emp_leave/index";
			$total_rows = $this->employee->leave_application_counter($this->company_id, $this->emp_id);
			$per_page = $this->config->item('per_page');
			$segment=5;
			
			init_pagination($uri,$total_rows,$per_page,$segment);

			$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
			$data["links"] = $this->pagination->create_links();
			// end pagination
			
			$data['leave'] = $this->employee->leave_application($per_page, $page, $this->company_id, $this->emp_id);
			$data['leave_type'] = $this->employee->leave_type($this->company_id);
			
			if($this->input->post('save_my_leave')){
				$leave_type = $this->input->post('leave_type');
				$reason = $this->input->post('reason');
				$start_date = $this->input->post('start_date');
				$start_date_hr = $this->input->post('start_date_hr');
				$start_date_min = $this->input->post('start_date_min'); 
				$start_date_sec = $this->input->post('start_date_sec');
				$end_date = $this->input->post('end_date');
				$end_date_hr = $this->input->post('end_date_hr');
				$end_date_min = $this->input->post('end_date_min');
				$end_date_sec = $this->input->post('end_date_sec');
				$return_date = $this->input->post('return_date');
				$return_date_hr = $this->input->post('return_date_hr');
				$return_date_min = $this->input->post('return_date_min');
				$return_date_sec = $this->input->post('return_date_sec');
				$total_leave_request = $this->input->post('total_leave_request');
				
				$this->form_validation->set_rules("leave_type", 'Leave Type', 'trim|required|xss_clean');
				$this->form_validation->set_rules("reason", 'Reason', 'trim|required|xss_clean');
				$this->form_validation->set_rules("start_date", 'Start Date', 'trim|required|xss_clean');
				$this->form_validation->set_rules("start_date_hr", 'Start Date Hour', 'trim|required|xss_clean');
				$this->form_validation->set_rules("start_date_min", 'Start Date Minute', 'trim|required|xss_clean');
				$this->form_validation->set_rules("start_date_sec", 'Start Date Second', 'trim|required|xss_clean');
				$this->form_validation->set_rules("end_date", 'End Date', 'trim|required|xss_clean');
				$this->form_validation->set_rules("end_date_hr", 'End Date Hour', 'trim|required|xss_clean');
				$this->form_validation->set_rules("end_date_min", 'End Date Minute', 'trim|required|xss_clean');
				$this->form_validation->set_rules("end_date_sec", 'End Date Second', 'trim|required|xss_clean');
				$this->form_validation->set_rules("return_date", 'Return Date', 'trim|required|xss_clean');
				$this->form_validation->set_rules("return_date_hr", 'Return Date Hour', 'trim|required|xss_clean');
				$this->form_validation->set_rules("return_date_min", 'Return Date Minute', 'trim|required|xss_clean');
				$this->form_validation->set_rules("return_date_sec", 'Return Date Second', 'trim|required|xss_clean');
				$this->form_validation->set_rules("total_leave_request", 'Total Leave Request', 'trim|xss_clean');
				
				if ($this->form_validation->run()==true){
					$concat_start_date = $start_date." ".$start_date_hr.":".$start_date_min.":".$start_date_sec;
					$concat_end_date = $end_date." ".$end_date_hr.":".$end_date_min.":".$end_date_sec;
					$concat_return_date = $return_date." ".$return_date_hr.":".$return_date_min.":".$return_date_sec;
					
					$save_employee_leave = array(
						"company_id"=>$this->company_id,
						"emp_id"=>$this->emp_id,
						"date_filed"=>date("Y-m-d"),
						"leave_type_id"=>$leave_type,
						"reasons"=>$reason,
						"date_start"=>$concat_start_date,
						"date_end"=>$concat_end_date,
						"date_return"=>$concat_return_date,
						"total_leave_requested"=>$total_leave_request,
						"note"=>"",
						"leave_application_status"=>"pending",
						"attachments"=>""
					);
					
					$insert_employee_leave = $this->jmodel->insert_data('employee_leaves_application',$save_employee_leave);

					if($insert_employee_leave){
						$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully saved!</div>');
						redirect($this->url);
					}
				}
				
			}
			
			if($this->input->is_ajax_request()) {
				// for shift schedule
				if($this->input->post('shift_schedule')){
					$weekDay_value = $this->input->post('weekDay_value');
					$query_weekDay_value = $this->employee->weekDay_value($this->company_id, $this->emp_id, $weekDay_value);
					print ($query_weekDay_value) ? 1.25 : 0 ;
					return false;
				}
				
				// start date for shift schedule
				if($this->input->post('result_shift_schedule')){
					$date_weekDay_value = $this->input->post('date_weekDay_value');
					$date_query_weekDay_value = $this->employee->date_weekDay_value($this->company_id, $this->emp_id, $date_weekDay_value);
					print $date_query_weekDay_value;
					return false;
				}
			}
			
			$this->layout->set_layout($this->theme);
			$this->layout->view('pages/employee/leave_table_view', $data);
		}
	
	}

/* End of file sss_tbl.php */
/* Location: ./application/controllers/hr/sss_tbl.php */