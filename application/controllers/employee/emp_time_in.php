<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Time In Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_time_in extends CI_Controller {
		
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
			$this->company_id = 2;
			$this->emp_id = 78;
			
			$this->url = "/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3);
			$this->theme = $this->config->item('jb_employee_temp');
			$this->menu = $this->config->item('jb_employee_menu');
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "Time In";
			
			$data['time_in_list'] = $this->employee->time_in_list($this->company_id, $this->emp_id);
			
			// check timesheet table

			$first_time_out = $this->employee->check_time_out_first($this->company_id, $this->emp_id);

			if($first_time_out == FALSE){
				// If datetime is not already exist in table
				// enable time in button
				$data['time_out'] = "0";
			}else{
				$row_lunch_out = $first_time_out->lunch_out;
				$row_lunch_in = $first_time_out->lunch_in;
				$row_time_out = $first_time_out->time_out;
				if($row_lunch_out == "00:00:00" || $row_time_out == "00:00:00"){
					$data['time_out'] = "1";
				}elseif($row_lunch_in == "00:00:00"){
					$data['time_out'] = "0";
				}
			}
			
			
			// Start Time In
			if($this->input->is_ajax_request()) {
				
				// for time in
				if($this->input->post('process_time_in')){
					$date_val = date("Y")."-".date("m")."-".date("d");
					
					// if datetime is not already exist in table
					$time_in_is_empty = $this->employee->time_in_is_empty($this->company_id, $this->emp_id);
					
					// insert employee time in value
					if($time_in_is_empty){
						$add_time_in = array(
							'emp_id'=>$this->emp_id,
							'comp_id'=>$this->company_id,
							'time_in'=>date('H:i:s'),
							'date'=>$date_val, 
							'reason'=>''
						);
						$insert_emp_leave = $this->jmodel->insert_data('employee_time_in',$add_time_in);
						if($insert_emp_leave){
							echo json_encode(array("success"=>1,"url"=>$this->url));
							return false;
						}
					}
					
					// fetch datetime_in today to update the lunch in
					$get_datetime_in_today = $this->employee->get_timein_today($this->company_id, $this->emp_id);
					if($get_datetime_in_today != FALSE){
						// declare row variables
						$current_time_in = $get_datetime_in_today->time_in;
						$current_lunch_out = $get_datetime_in_today->lunch_out;
						$current_lunch_in = $get_datetime_in_today->lunch_in;
						$current_time_out = $get_datetime_in_today->time_out;
						
						// insert employee lunch in value
						if($current_lunch_out != "00:00:00" && $current_lunch_in == "00:00:00"){
							// update lunch in from employee time in
							$update_lunch_in = $this->employee->update_lunch_in($this->company_id, $this->emp_id);
							if($update_lunch_in){
								echo json_encode(array("success"=>1,"url"=>$this->url));
								return false;
							}
						}else{
							// report hackers
							echo json_encode(array("success"=>0,"msg"=>"- Please time in first"));
							return false;
						}
					}
				}
				
				// for time out
				if($this->input->post('process_time_out')){
					// check if time in is not already exist in table
					$time_in_is_empty = $this->employee->time_in_is_empty($this->company_id, $this->emp_id);
					if($time_in_is_empty){
						// report hackers
						echo json_encode(array("success"=>0,"msg"=>"- Please time in first"));
						return false;
					}else{
						// fetch datetime_in today to update the lunch out / time out
						$get_datetime_in_today = $this->employee->get_timein_today($this->company_id, $this->emp_id);
						if($get_datetime_in_today != FALSE){
							
							// declare row variables
							$current_time_in = $get_datetime_in_today->time_in;
							$current_lunch_out = $get_datetime_in_today->lunch_out;
							$current_lunch_in = $get_datetime_in_today->lunch_in;
							$current_time_out = $get_datetime_in_today->time_out;
							
							if($current_time_in != "00:00:00" && $current_lunch_out == "00:00:00"){
								// update lunch out from employee time in
								$update_lunch_out = $this->employee->update_lunch_out($this->company_id, $this->emp_id);
								if($update_lunch_out){
									echo json_encode(array("success"=>1,"url"=>$this->url));
									return false;
								}
							}else{
								// report hackers
								echo json_encode(array("success"=>0,"msg"=>"- Please time in first"));
								return false;
							}
						}
					}
				}
			}
			
			$this->layout->set_layout($this->theme);
			$this->layout->view('pages/employee/emp_time_in_view', $data);
		}
	
	}

/* End of file Emp_time_in.php */
/* Location: ./application/controllers/employee/Emp_time_in.php */