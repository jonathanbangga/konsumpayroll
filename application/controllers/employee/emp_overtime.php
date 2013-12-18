<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Overtime Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_overtime extends CI_Controller {
		
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
			$this->menu = $this->config->item('company_dashboard_menu');
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
			$data['page_title'] = "Overtime Logs";
			
			// init pagination
			$uri = "/{$this->uri->segment(1)}/employee/emp_overtime/index";
			$total_rows = $this->employee->overtime_application_counter($this->company_id, $this->emp_id);
			$per_page = $this->config->item('per_page');
			$segment=5;
			
			init_pagination($uri,$total_rows,$per_page,$segment);

			$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
			$data["links"] = $this->pagination->create_links();
			// end pagination
			
			$data['overtime'] = $this->employee->overtime_application($per_page, $page, $this->company_id,$this->emp_id);
			
			if($this->input->post('add')){
				$start_date = $this->input->post('start_date');
				$start_date_hr = $this->input->post('start_date_hr');
				$start_date_min = $this->input->post('start_date_min');
				$start_date_sec = $this->input->post('start_date_sec');
				$end_date_hr = $this->input->post('end_date_hr');
				$end_date_min = $this->input->post('end_date_min');
				$end_date_sec = $this->input->post('end_date_sec');
				$total_hours = $this->input->post('total_hours');
				$purpose = $this->input->post('purpose');
				
				$this->form_validation->set_rules("start_date", 'Start Date', 'trim|required|xss_clean');
				$this->form_validation->set_rules("start_date_hr", 'Start Date Time Hour', 'trim|required|xss_clean');
				$this->form_validation->set_rules("start_date_min", 'Start Date Time Minute', 'trim|required|xss_clean');
				$this->form_validation->set_rules("start_date_sec", 'Start Date Time Second', 'trim|required|xss_clean');
				$this->form_validation->set_rules("end_date_hr", 'End Date Time Hour', 'trim|required|xss_clean');
				$this->form_validation->set_rules("end_date_min", 'End Date Time Minute', 'trim|required|xss_clean');
				$this->form_validation->set_rules("end_date_sec", 'End Date Time Second', 'trim|required|xss_clean');
				$this->form_validation->set_rules("total_hours", 'Total Hours', 'trim|required|xss_clean');
				$this->form_validation->set_rules("purpose", 'Purpose', 'trim|required|xss_clean');
				
				if ($this->form_validation->run()==true){
											
					$start_time = $start_date_hr.":".$start_date_min.":".$start_date_sec;
					$end_time = $end_date_hr.":".$end_date_min.":".$end_date_sec;
					$save_employee_overtime = array(
						"emp_id"=>$this->emp_id,
						"overtime_date_applied"=>date("Y-m-d"),
						"overtime_from"=>$start_date,
						"overtime_to"=>$start_date,
						"start_time"=>$start_time,
						"end_time"=>$end_time,
						"no_of_hours"=>$total_hours,
						"with_nsd_hours"=>"",
						"company_id"=>$this->company_id,
						"reason"=>$purpose,
						"notes"=>""
					);
					
					$insert_employee_loan = $this->jmodel->insert_data('employee_overtime_application',$save_employee_overtime);

					if($insert_employee_loan){
						$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully saved!</div>');
						redirect($this->url);
					}
				}
			}
			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/employee/overtime_table_view', $data);
		}
	
	}

/* End of file sss_tbl.php */
/* Location: ./application/controllers/hr/sss_tbl.php */