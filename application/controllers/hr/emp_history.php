<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee History Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_history extends CI_Controller {
		
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
			
			$this->emp_id = $this->uri->segment(5);
			$this->sidebar_menu = 'content_holders/hr_employee_sidebar_menu';
			$this->menu = 'content_holders/user_hr_owner_menu';
			$this->url = "/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$this->uri->segment(4);
		
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
		$data['page_title'] = "Employment History";
			$data['sidebar_menu'] = $this->sidebar_menu;
			
			// init pagination
			$uri = "/{$this->uri->segment(1)}/hr/emp_shift/index";
			$total_rows = $this->hr_emp->emp_shift_counter($this->company_id);
			$per_page = $this->config->item('per_page');
			$segment=5;
			
			init_pagination($uri,$total_rows,$per_page,$segment);

			$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
			$data["links"] = $this->pagination->create_links();
			// end pagination
			
			$data['employee'] = $this->hr_emp->emp_shift($per_page, $page, $this->company_id);
			
			$employee = $this->hr_emp->emp_shift_listing($this->company_id);
			$results = "";
			if($employee != FALSE){
				foreach($employee as $row){
					$results .= "{label:'".ucwords($row->first_name)." ".ucwords($row->last_name)."',emp_no:'{$row->payroll_cloud_id}',emp_id:'{$row->emp_id}'},";
				}	
			}
			
			$data['employee_shift'] = $results;
			
			if($this->input->post('add')){
				foreach($this->input->post('emp_id') as $key2=>$val){
					$this->form_validation->set_rules("emp_id[{$key2}]", 'Employee ID', 'trim|required|xss_clean');
					$this->form_validation->set_rules("emp_no[{$key2}]", 'Employee Number', 'trim|required|xss_clean');
					$this->form_validation->set_rules("valid_from[{$key2}]", 'Valid From', 'trim|required|xss_clean');
					$this->form_validation->set_rules("until[{$key2}]", 'Until', 'trim|required|xss_clean');
					$this->form_validation->set_rules("sunday[{$key2}]", 'Sunday', 'trim|required|xss_clean');
					$this->form_validation->set_rules("monday[{$key2}]", 'Monday', 'trim|required|xss_clean');
					$this->form_validation->set_rules("tuesday[{$key2}]", 'Tuesday', 'trim|required|xss_clean');
					$this->form_validation->set_rules("wednesday[{$key2}]", 'Wednesday', 'trim|required|xss_clean');
					$this->form_validation->set_rules("thursday[{$key2}]", 'Thursday', 'trim|required|xss_clean');
					$this->form_validation->set_rules("friday[{$key2}]", 'Friday', 'trim|required|xss_clean');
					$this->form_validation->set_rules("saturday[{$key2}]", 'Saturday', 'trim|required|xss_clean');
				}
				//if ($this->form_validation->run()==true){
					foreach($this->input->post('emp_id') as $key=>$val){
						$company_id = $this->company_id;
						$emp_id = $this->input->post('emp_id');
						$valid_from = $this->input->post('valid_from');
						$until = $this->input->post('until');
						$sunday = $this->input->post('sunday');
						$monday = $this->input->post('monday');
						$tuesday = $this->input->post('tuesday');
						$wednesday = $this->input->post('wednesday');
						$thursday = $this->input->post('thursday');
						$friday = $this->input->post('friday');
						$saturday = $this->input->post('saturday');
						
						$insert_employee_shift = array(
							'emp_id' => $emp_id[$key],
							'company_id' => $company_id,
							'valid_from' => $valid_from[$key],
							'until' => $until[$key],
							'Sunday' => $sunday[$key],
							'Monday' => $monday[$key],
							'Tuesday' => $tuesday[$key],
							'Wednesday' => $wednesday[$key],
							'Thursday' => $thursday[$key],
							'Friday' => $friday[$key],
							'Saturday' => $saturday[$key]
						);
							
						$this->jmodel->insert_data('employee_shifts_schedule',$insert_employee_shift);
					}
					
					$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully saved!</div>');
					redirect($this->url);
				//}
			}
			
			if($this->input->is_ajax_request()) {
				// Check Username
				if($this->input->post('check_uname')){
					$ajax_uname_val = $this->input->post('uname_val');	
					foreach($ajax_uname_val as $key=>$val){
						$validate_uname = $this->hr_emp->validate_name($ajax_uname_val[$key]);
						if($validate_uname){
							echo json_encode(array("success"=>1));
							return false;
						}else{
							echo json_encode(array("success"=>0));
							return false;
						}
					}
				}
				
				// Delete Employee Shift Information
				if($this->input->post('del_empDB')){
					$shifts_schedule_id = $this->input->post('shifts_schedule_id');
					$delete_me = $this->db->query("DELETE FROM employee_shifts_schedule WHERE shifts_schedule_id = '{$shifts_schedule_id}' and company_id = '{$this->company_id}'");
					if($delete_me){
						$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully deleted!</div>');
						echo json_encode(array("success"=>1,"url"=>$this->url));
						return false;
					}
				}
				
				// get information
				if($this->input->post('get_information')){
					$shifts_schedule_id = $this->input->post('shifts_schedule_id');
					$emp_res = $this->hr_emp->emp_shift_info($shifts_schedule_id,$this->company_id);
					if($emp_res != FALSE){
						echo json_encode(
							array(
								"success"=>1,
								"emp_name"=>ucwords($emp_res->first_name)." ".ucwords($emp_res->last_name),
								"shifts_schedule_id"=>$emp_res->shifts_schedule_id,
								"company_id"=>$emp_res->company_id,
								"valid_from"=>$emp_res->valid_from,
								"until"=>$emp_res->until,
								"Sunday"=>$emp_res->Sunday,
								"Monday"=>$emp_res->Monday,
								"Tuesday"=>$emp_res->Tuesday,
								"Wednesday"=>$emp_res->Wednesday,
								"Thursday"=>$emp_res->Thursday,
								"Friday"=>$emp_res->Friday,
								"Saturday"=>$emp_res->Saturday
							)
						);
						return false;
					}else{
						echo json_encode(array("success"=>0));
						return false;
					}
				}
				
				if($this->input->post('search_emp_name')){
					$emp_name = $this->input->post('emp_name');
					$results = $this->hr_emp->search_shift_emp_name($emp_name);
					if($results != FALSE){
						foreach($results as $row){
							print "
								<tr class='shift_row_list'>
					              <td></td>
					              <td>".ucwords($row->first_name)." ".ucwords($row->last_name)."</td>
					              <td>{$row->payroll_cloud_id}</td>
					              <td>{$row->valid_from}</td>
					              <td>{$row->until}</td>
					              <td>{$row->Sunday}</td>
					              <td>{$row->Monday}></td>
					              <td>{$row->Tuesday}</td>
					              <td>{$row->Wednesday}</td>
					              <td>{$row->Thursday}</td>
					              <td>{$row->Friday}</td>	
					              <td>{$row->Saturday}</td>
					              <td><a href='javascript:void(0);' class='btn btn-gray btn-action editBtnDb' shifts_schedule_id='{$row->shifts_schedule_id}'>EDIT</a> <a href='javascript:void(0);' class='btn btn-red btn-action delBtnDb' shifts_schedule_id='{$row->shifts_schedule_id}'>DELETE</a></td>
					            </tr>
							";
						}
						return false;
					}else{
						print "
							<tr class='shift_row_list no_result_cont'>
				              <td colspan='13' style='text-align:left;'>No results found</td>
				            </tr>
						";
						return false;
					}
				}
				
				if($this->input->post('search_emp_no')){
					$emp_no = $this->input->post('emp_no');
					$results = $this->hr_emp->search_shift_emp_no($emp_no);
					if($results != FALSE){
						foreach($results as $row){
							print "
								<tr class='shift_row_list'>
					              <td></td>
					              <td>".ucwords($row->first_name)." ".ucwords($row->last_name)."</td>
					              <td>{$row->payroll_cloud_id}</td>
					              <td>{$row->valid_from}</td>
					              <td>{$row->until}</td>
					              <td>{$row->Sunday}</td>
					              <td>{$row->Monday}></td>
					              <td>{$row->Tuesday}</td>
					              <td>{$row->Wednesday}</td>
					              <td>{$row->Thursday}</td>
					              <td>{$row->Friday}</td>	
					              <td>{$row->Saturday}</td>
					              <td><a href='javascript:void(0);' class='btn btn-gray btn-action editBtnDb' shifts_schedule_id='{$row->shifts_schedule_id}'>EDIT</a> <a href='javascript:void(0);' class='btn btn-red btn-action delBtnDb' shifts_schedule_id='{$row->shifts_schedule_id}'>DELETE</a></td>
					            </tr>
							";
						}
						return false;
					}else{
						print "
							<tr class='shift_row_list no_result_cont'>
				              <td colspan='13' style='text-align:left;'>No results found</td>
				            </tr>
						";
						return false;
					}
				}
			}
			
			if($this->input->post('update_info')){
				$company_id = $this->company_id;
				$shifts_schedule_id = $this->input->post('shifts_schedule_id');
				$valid_from = $this->input->post('valid_from');
				$until = $this->input->post('until');
				$sunday = $this->input->post('sunday');
				$monday = $this->input->post('monday');
				$tuesday = $this->input->post('tuesday');
				$wednesday = $this->input->post('wednesday');
				$thursday = $this->input->post('thursday');
				$friday = $this->input->post('friday');
				$saturday = $this->input->post('saturday');
				
				$this->form_validation->set_rules("shifts_schedule_id", 'Shift Schedule ID', 'trim|required|xss_clean');
				$this->form_validation->set_rules("valid_from", 'Valid From', 'trim|required|xss_clean');
				$this->form_validation->set_rules("until", 'Until', 'trim|required|xss_clean');
				$this->form_validation->set_rules("sunday", 'Sunday', 'trim|required|xss_clean');
				$this->form_validation->set_rules("monday", 'Monday', 'trim|required|xss_clean');
				$this->form_validation->set_rules("tuesday", 'Tuesday', 'trim|required|xss_clean');
				$this->form_validation->set_rules("wednesday", 'Wednesday', 'trim|required|xss_clean');
				$this->form_validation->set_rules("thursday", 'Thursday', 'trim|required|xss_clean');
				$this->form_validation->set_rules("friday", 'Friday', 'trim|required|xss_clean');
					$this->form_validation->set_rules("saturday", 'Saturday', 'trim|required|xss_clean');
				
				if ($this->form_validation->run()==true){
					$update_info = $this->hr_emp->update_shift_info(
						$shifts_schedule_id,
						$valid_from,
						$until,
						$sunday,
						$monday,
						$tuesday,
						$wednesday,
						$thursday,
						$friday,
						$saturday,
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
					echo json_encode(array("success"=>0));
					return false;
				}
			}
			
			$this->layout->set_layout($this->theme);
			$this->layout->view('pages/hr/emp_history_view', $data);
		}
	
	}

/* End of file Emp_history.php */
/* Location: ./application/controllers/hr/Emp_history.php */