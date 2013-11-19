<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Training Details Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_training_details extends CI_Controller {
		
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
			$this->company_id = 1;
			
			$this->sidebar_menu = 'content_holders/hr_employee_sidebar_menu';
			$this->menu = 'content_holders/company_menu';
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "201 File";
			$data['sidebar_menu'] = $this->sidebar_menu;
			
			$employee = $this->hr_emp->view_employee($this->company_id);
			$results = "";
			if($employee != FALSE){
				foreach($employee as $row){
					$results .= "{label:'".ucwords($row->first_name)." ".ucwords($row->last_name)."',emp_no:'{$row->payroll_cloud_id}',emp_id:'{$row->emp_id}'},";
				}	
			}
			$data['employee'] = $results;
			$data['employee_list'] = $this->hr_emp->employee_training_details($this->company_id);
			if($this->input->is_ajax_request()) {
				if($this->input->post('save')){
					
					$emp_id = $this->input->post('emp_id');
					$emp_name = $this->input->post('emp_name');
					$emp_no = $this->input->post('emp_no');
					$dateFrom = $this->input->post('dateFrom');
					$dateTo = $this->input->post('dateTo');
					$coursename = $this->input->post('coursename');
					$organizer = $this->input->post('organizer');
					$cost = $this->input->post('cost');
					$training_hours = $this->input->post('training_hours');
					
					foreach($emp_name as $key2=>$val){
						$this->form_validation->set_rules("emp_id[{$key2}]", 'Employee ID', 'trim|required|xss_clean|is_unique[employee_training_details.emp_id]');
						$this->form_validation->set_rules("emp_name[{$key2}]", 'Employee Name', 'trim|required|xss_clean');
						$this->form_validation->set_rules("emp_no[{$key2}]", 'Employee Number', 'trim|required|xss_clean');
						$this->form_validation->set_rules("dateFrom[{$key2}]", 'Date From', 'trim|required|xss_clean');
						$this->form_validation->set_rules("dateTo[{$key2}]", 'Date To', 'trim|required|xss_clean');
						$this->form_validation->set_rules("coursename[{$key2}]", 'Course Name', 'trim|required|xss_clean');
						$this->form_validation->set_rules("organizer[{$key2}]", 'Organizer', 'trim|required|xss_clean');
						$this->form_validation->set_rules("cost[{$key2}]", 'Cost', 'trim|required|xss_clean');
						$this->form_validation->set_rules("training_hours[{$key2}]", 'Training Hours', 'trim|required|xss_clean');
					}

					if ($this->form_validation->run()==true){
						foreach($emp_id as $key=>$val){
							$valtraining_details = array(	
								'emp_id' => $emp_id[$key],
								'comp_id' => $this->company_id,
								'date_from' => $dateFrom[$key],
								'date_to' => $dateTo[$key],
								'course_name' => $coursename[$key],
								'organizer' => $organizer[$key],
							 	'cost' => $cost[$key],
								'training_hours' => $training_hours[$key]
							);
	
							$insert_training_details = $this->jmodel->insert_data('employee_training_details',$valtraining_details);
						}
						$this->session->set_flashdata('message', '<p class="save_alert">Successfully saved!</p>');
						echo json_encode(array("success"=>1));
						return false;
					}else{
						echo json_encode(array("success"=>0));
						return false;
					}
				}
				
				if($this->input->post('del_empDB')){
					$emp_id = $this->input->post('emp_id');
					$delete_me = $this->db->query("DELETE FROM employee_training_details WHERE emp_id = '{$emp_id}' and comp_id = '{$this->company_id}'");
					if($delete_me){
						$this->session->set_flashdata('message', '<p class="save_alert">Successfully deleted!</p>');
						echo json_encode(array("success"=>1));
						return false;
					}
				}
				
				if($this->input->post('get_information')){
					$emp_id = $this->input->post('emp_id');
					$get_info = $this->db->query("
						SELECT *FROM employee_training_details WHERE emp_id = '{$emp_id}' and comp_id = '{$this->company_id}'
					");
					if($get_info->num_rows() > 0){
						$get_info_row = $get_info->row();
						$get_info->free_result();
						$dateFromInfo = $get_info_row->date_from;
						$dateToInfo = $get_info_row->date_to;
						$course_name = $get_info_row->course_name;
						$organizer = $get_info_row->organizer;
						$cost = $get_info_row->cost;
						$training_hours = $get_info_row->training_hours;
						echo json_encode(
							array(
								"success"=>1,
								"emp_id"=>$get_info_row->emp_id,
								"dateFromInfo"=>$dateFromInfo,
								"dateToInfo"=>$dateToInfo,
								"course_name"=>$course_name,
								"organizer"=>$organizer,
								"cost"=>$cost,
								"training_hours"=>$training_hours
							)
						);
						return false;
					}else{
						echo json_encode(array("success"=>0));
						return false;
					}
				}
				
				if($this->input->post('update_info')){
					$emp_idEdit = $this->input->post('emp_idEdit');
					$dateFromEdit = $this->input->post('dateFromEdit');
					$dateToEdit = $this->input->post('dateToEdit');
					$courseNameEdit = $this->input->post('courseNameEdit');
					$organizerEdit = $this->input->post('organizerEdit');
					$costEdit = $this->input->post('costEdit');
					$trainingHoursEdit = $this->input->post('trainingHoursEdit');
					
					$update_info = $this->hr_emp->update_train_details($emp_idEdit,$dateFromEdit,$dateToEdit,$courseNameEdit,$courseNameEdit,$organizerEdit,$costEdit,$trainingHoursEdit,$this->company_id);
					if($update_info){
						$this->session->set_flashdata('message', '<p class="save_alert">Successfully updated!</p>');
						echo json_encode(array("success"=>1));
						return false;
					}else{
						echo json_encode(array("success"=>0));
						return false;
					}
				}
			}
			
			$this->layout->set_layout($this->theme);
			$this->layout->view('pages/hr/training_det_view', $data);
		}
	
	}

/* End of file sss_tbl.php */
/* Location: ./application/controllers/hr/sss_tbl.php */