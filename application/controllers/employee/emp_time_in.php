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
			$this->zero_time = "0000-00-00 00:00:00";
			$this->min_log = 5;
		}
		
		/**
		 * index page
		 */
		public function index() {

			$data['page_title'] = "Time In";
			$data['min_log'] = $this->min_log;
			$data['time_in_list'] = $this->employee->time_in_list($this->company_id, $this->emp_id);
			
			// check timesheet table

			$first_time_out = $this->employee->check_time_out_first($this->company_id, $this->emp_id);

			if($first_time_out == FALSE){
				// If datetime is not already exist in table
				// enable time in button
				// disbale time out button
				$data['time_out'] = "0";
			}elseif($first_time_out->time_in != $this->zero_time && $first_time_out->lunch_out != $this->zero_time && $first_time_out->lunch_in != $this->zero_time && $first_time_out->time_out != $this->zero_time){
				// disable time in and time out button
				$data['time_out'] = "2";			
			}elseif(($first_time_out->time_in != $this->zero_time && $first_time_out->lunch_in != $this->zero_time) || ($first_time_out->lunch_out == $this->zero_time && $first_time_out->time_out == $this->zero_time)){
				// enable time out button
				// disbale time in button
				$data['time_out'] = "1";
			}elseif($first_time_out->lunch_in == $this->zero_time){
				// enable time in button
				// disbale time out button
				$data['time_out'] = "0";
			}
			
			if($this->input->is_ajax_request()) {
				// Start Time In	
				// for time in
				if($this->input->post('process_time_in')){
					
					// rows not empty, trap the anonymous user
					$get_datetime_in_today = $this->employee->get_timein_today($this->company_id, $this->emp_id);
					if($get_datetime_in_today){
						// declare row variables
						$current_time_in = $get_datetime_in_today->time_in;
						$current_lunch_out = $get_datetime_in_today->lunch_out;
						$current_lunch_in = $get_datetime_in_today->lunch_in;
						$current_time_out = $get_datetime_in_today->time_out;
						if($current_time_in!=$this->zero_time && $current_lunch_out!=$this->zero_time && $current_lunch_in!=$this->zero_time && $current_time_out!=$this->zero_time){
							#echo json_encode(array("success"=>0));
							echo json_encode(array("success"=>0));
							return false;
						}
					}
					
					$date_val = date("Y")."-".date("m")."-".date("d");
					
					// if datetime is not already exist in table or hours is greater than 24 hours / 1 day
					$time_in_is_empty = $this->employee->time_in_is_empty($this->company_id, $this->emp_id);
					
					// insert employee time in value
					if($time_in_is_empty){
						$add_time_in = array(
							'emp_id'=>$this->emp_id,
							'comp_id'=>$this->company_id,
							'time_in'=>date('Y-m-d H:i:s'),
							'date'=>$date_val,
							'reason'=>''
						);
						$insert_emp_leave = $this->jmodel->insert_data('employee_time_in',$add_time_in);
						if($insert_emp_leave){
							echo json_encode(array("success"=>1,"url"=>$this->url));
							return false;
						}
					}
					
					// check if current time is less than 5 minutes, alert try to login after $this->min_log minutes
					$check_current_time_to_timein_lunchin = $this->employee->check_current_time_to_timein_lunchin($this->company_id, $this->emp_id, $this->min_log);
					if($check_current_time_to_timein_lunchin){
						echo json_encode(array("success"=>3,"msg"=>"- Please try to lunch in after {$this->min_log} minutes"));
						return false;
					}
					
					// fetch datetime_in today to update the lunch in
					$get_datetime_in_today = $this->employee->get_timein_today($this->company_id, $this->emp_id);
					if($get_datetime_in_today != FALSE){
						// declare row variables
						$employee_time_in_id = $get_datetime_in_today->employee_time_in_id;
						$current_time_in = $get_datetime_in_today->time_in;
						$current_lunch_out = $get_datetime_in_today->lunch_out;
						$current_lunch_in = $get_datetime_in_today->lunch_in;
						$current_time_out = $get_datetime_in_today->time_out;
						
						// insert employee lunch in value
						if($current_lunch_out != $this->zero_time && $current_lunch_in == $this->zero_time){
							// update lunch in from employee time in
							$update_lunch_in = $this->employee->update_lunch_in($this->company_id, $this->emp_id, $employee_time_in_id);
							if($update_lunch_in){
								echo json_encode(array("success"=>1,"url"=>$this->url));
								return false;
							}
						}else{
							// report hackers
							echo json_encode(array("success"=>0));
							return false;
						}
					}
				}
				
				// for time out
				if($this->input->post('process_time_out')){
					
					// rows not empty, trap the anonymous user
					$get_datetime_in_today = $this->employee->get_timein_today($this->company_id, $this->emp_id);
					if($get_datetime_in_today){
						// declare row variables
						$current_time_in = $get_datetime_in_today->time_in;
						$current_lunch_out = $get_datetime_in_today->lunch_out;
						$current_lunch_in = $get_datetime_in_today->lunch_in;
						$current_time_out = $get_datetime_in_today->time_out;
						if($current_time_in!=$this->zero_time && $current_lunch_out!=$this->zero_time && $current_lunch_in!=$this->zero_time && $current_time_out!=$this->zero_time){
							echo json_encode(array("success"=>0));
							return false;
						}
					}
					
					// check if time in is not already exist in table
					$time_in_is_empty = $this->employee->check_time_in_is_empty($this->company_id, $this->emp_id);
					if($time_in_is_empty){
						// report hackers
						echo json_encode(array("success"=>0,"msg"=>"- Please time in first"));
						return false;
					}else{
						
						// fetch datetime_in today to update the lunch out / time out
						$get_datetime_in_today = $this->employee->get_timein_today($this->company_id, $this->emp_id);
						if($get_datetime_in_today != FALSE){
							
							// declare row variables
							$employee_time_in_id = $get_datetime_in_today->employee_time_in_id; 	
							$current_time_in = $get_datetime_in_today->time_in;
							$current_lunch_out = $get_datetime_in_today->lunch_out;
							$current_lunch_in = $get_datetime_in_today->lunch_in;
							$current_time_out = $get_datetime_in_today->time_out;
							
							// check if current time is less than 5 minutes, alert try to login after $this->min_log minutes
							$check_current_time_to_login = $this->employee->check_current_time_login($this->company_id, $this->emp_id, $this->min_log);
							if($check_current_time_to_login){
								if($current_lunch_out==$this->zero_time){
									echo json_encode(array("success"=>3,"msg"=>"- Please try to lunch out after {$this->min_log} minutes"));
									return false;
								}else{
									echo json_encode(array("success"=>3,"msg"=>"- Please try to logout out after {$this->min_log} minutes"));
									return false;
								}
							}
							
							if($current_time_in != $this->zero_time && $current_lunch_out == $this->zero_time){
								// update lunch out from employee time in
								$update_lunch_out = $this->employee->update_lunch_out($this->company_id, $this->emp_id, $employee_time_in_id);
								if($update_lunch_out){
									echo json_encode(array("success"=>1,"url"=>$this->url));
									return false;
								}
							}elseif($current_time_in != $this->zero_time && $current_lunch_out != "" && $current_lunch_in != "" && $current_time_out == $this->zero_time){
								// update time out from employee time in
								$update_time_out = $this->employee->update_time_out($this->company_id, $this->emp_id, $employee_time_in_id);
								if($update_time_out){
									
									// compute total hours worked
									$total_hours = $this->employee->total_hours($this->company_id, $this->emp_id);
									if($total_hours){
										echo json_encode(array("success"=>1,"url"=>$this->url));
										return false;
									}
								}							
							}else{
								// report hackers
								echo json_encode(array("success"=>0));
								return false;
							}
						}else{
							// report hackers
							echo json_encode(array("success"=>0));
							return false;
						}
					}
				}
				
				// change log request
				if($this->input->post('change_log')){
					$employee_time_in_id = $this->input->post('employee_time_in_id');
					$get_timein_info = $this->employee->get_timein_info($this->company_id, $this->emp_id, $employee_time_in_id);
					if($get_timein_info){
						
						$time_in_date = explode(" ",$get_timein_info->time_in);
						$lunch_out_date = explode(" ",$get_timein_info->lunch_out);
						$lunch_in_date = explode(" ",$get_timein_info->lunch_in);
						$time_out_date = explode(" ",$get_timein_info->time_out);
						
						$tim_in = $time_in_date[0];
						$tim_in = date("g:i:A",strtotime($get_timein_info->time_in));
						$lunch_out = ($get_timein_info->lunch_out==$this->zero_time) ? "00:00:00" : date("g:i:A",strtotime($get_timein_info->lunch_out));
						$lunch_in = ($get_timein_info->lunch_in==$this->zero_time) ? "00:00:00" : date("g:i:A",strtotime($get_timein_info->lunch_in));
						$time_out = ($get_timein_info->time_out==$this->zero_time) ? "00:00:00" : date("g:i:A",strtotime($get_timein_info->time_out));
						
						$current_time_val = date("Y-m-d H:i:s");
						
						$startDate = strtotime("{$get_timein_info->time_in}");
						$endDate = strtotime("{$current_time_val}");
						$interval = $endDate - $startDate;
						$days = floor($interval / (60 * 60 * 24));
						
						print json_encode(array(
							"success"=>1,
							"no_of_days"=>$days,
							"employee_time_in_id"=>$get_timein_info->employee_time_in_id,
							"time_in_date"=>$time_in_date[0],
							"lunch_out_date"=>$lunch_out_date[0],
							"lunch_in_date"=>$lunch_in_date[0],
							"time_out_date"=>$time_out_date[0],
							"time_in"=>$tim_in,
							"lunch_out"=>$lunch_out,
							"lunch_in"=>$lunch_in,
							"time_out"=>$time_out,
							"reason"=>$get_timein_info->reason
						));
						return false;
					}					
				}
			}
			
			// update employee log
			
			if($this->input->post('update_log')){
				
				$employee_timein = $this->input->post('employee_timein');
				
				$employee_timein_date = $this->input->post('employee_timein_date');
				$lunch_out_date = $this->input->post('lunch_out_date');
				$lunch_in_date = $this->input->post('lunch_in_date');
				$time_out_date = $this->input->post('time_out_date');
				
				$time_in_hr = $this->input->post('time_in_hr');
				$time_in_min = $this->input->post('time_in_min');
				$time_in_ampm = $this->input->post('time_in_ampm');
				
				$lunch_out_hr = $this->input->post('lunch_out_hr');
				$lunch_out_min = $this->input->post('lunch_out_min');
				$lunch_out_ampm = $this->input->post('lunch_out_ampm');
				
				$lunch_in_hr = $this->input->post('lunch_in_hr');
				$lunch_in_min = $this->input->post('lunch_in_min');
				$lunch_in_ampm = $this->input->post('lunch_in_ampm');
				
				$time_out_hr = $this->input->post('time_out_hr');
				$time_out_min = $this->input->post('time_out_min');
				$time_out_ampm = $this->input->post('time_out_ampm');
				
				$time_in = $employee_timein_date." ".date("H:i:s",strtotime($time_in_hr.":".$time_in_min." ".$time_in_ampm));
				$lunch_out = ($lunch_out_hr=="00" && $lunch_out_min=="00" && $lunch_out_ampm=="00") ? "00:00:00" : date("H:i:s",strtotime($lunch_out_hr.":".$lunch_out_min." ".$lunch_out_ampm));
				$lunch_in = ($lunch_in_hr=="00" && $lunch_in_min=="00" && $lunch_in_ampm=="00") ? "00:00:00" : date("H:i:s",strtotime($lunch_in_hr.":".$lunch_in_min." ".$lunch_in_ampm));
				$time_out = ($time_out_hr=="00" && $time_out_min=="00" && $time_out_ampm=="00") ? "00:00:00" : date("H:i:s",strtotime($time_out_hr.":".$time_out_min." ".$time_out_ampm));
				
				$reason = $this->input->post('reason');
				
				$this->form_validation->set_rules("employee_timein", 'Employee Time In ID', 'trim|required|xss_clean');

				$this->form_validation->set_rules("employee_timein_date", 'Time In Date', 'trim|required|xss_clean');
				$this->form_validation->set_rules("lunch_out_date", 'Lunch Out Date', 'trim|required|xss_clean');
				$this->form_validation->set_rules("lunch_in_date", 'Lunch In Date', 'trim|required|xss_clean');
				$this->form_validation->set_rules("time_out_date", 'Time Out Date', 'trim|required|xss_clean');
				
				$this->form_validation->set_rules("time_in_hr", 'Time In Hour', 'trim|required|xss_clean');
				$this->form_validation->set_rules("time_in_min", 'Time In Minute', 'trim|required|xss_clean');
				$this->form_validation->set_rules("time_in_ampm", 'Time In AM/PM', 'trim|required|xss_clean');
				
				$this->form_validation->set_rules("lunch_out_hr", 'Lunch Out Hour', 'trim|required|xss_clean');
				$this->form_validation->set_rules("lunch_out_min", 'Lunch Out Minute', 'trim|required|xss_clean');
				$this->form_validation->set_rules("lunch_out_ampm", 'Lunch Out AM/PM', 'trim|required|xss_clean');
				
				$this->form_validation->set_rules("lunch_in_hr", 'Lunch In Hour', 'trim|required|xss_clean');
				$this->form_validation->set_rules("lunch_in_hr", 'Lunch In Minute', 'trim|required|xss_clean');
				$this->form_validation->set_rules("lunch_in_ampm", 'Lunch Out AM/PM', 'trim|required|xss_clean');
				
				$this->form_validation->set_rules("time_out_hr", 'Lunch Out Hour', 'trim|required|xss_clean');
				$this->form_validation->set_rules("time_out_min", 'Lunch Out Minute', 'trim|required|xss_clean');
				$this->form_validation->set_rules("time_out_ampm", 'Lunch Out AM/PM', 'trim|required|xss_clean');
				
				$this->form_validation->set_rules("reason", 'Reason', 'trim|required|xss_clean');
				if ($this->form_validation->run()==true){
					$update_employee_time_log = $this->employee->update_employee_time_log(
						$this->company_id, $this->emp_id, $employee_timein, $time_in, $lunch_out_date." ".$lunch_out, $lunch_in_date." ".$lunch_in, $time_out_date." ".$time_out, $reason
					);
					if($update_employee_time_log){
						$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully updated!</div>');
						redirect($this->url);
					}
				}else{
					print validation_errors();
					return false;
				}
			}
			
			$this->layout->set_layout($this->theme);
			$this->layout->view('pages/employee/emp_time_in_view', $data);
		}
	
	}

/* End of file Emp_time_in.php */
/* Location: ./application/controllers/employee/Emp_time_in.php */