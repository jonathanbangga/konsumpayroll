<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Employee extends CI_Controller {
		
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
			$this->theme = $this->config->item('temp_company_wizard');
			$this->load->model('konsumglobal_jmodel','jmodel');
		}
		
		/**
		 * index page
		 */
		public function index($var1="",$var2="") {
			$data['page_title'] = "Employee's Account";		

			echo $var1+$var2;
			
			if($this->input->is_ajax_request()) {
				if($this->input->post('save')){
					$this->form_validation->set_rules('company_id', 'Company ID', 'trim|required|xss_clean');
					$this->form_validation->set_rules('rank_id', 'Rank ID', 'trim|required|xss_clean');
					$this->form_validation->set_rules('dept_id', 'Department ID', 'trim|required|xss_clean');
					$this->form_validation->set_rules('location_id', 'Location', 'trim|required|xss_clean');
					$this->form_validation->set_rules('fname', 'Firstname', 'trim|required|xss_clean');
					$this->form_validation->set_rules('mname', 'Middlename', 'trim|required|xss_clean');
					$this->form_validation->set_rules('lname', 'Lastname', 'trim|required|xss_clean');
					$this->form_validation->set_rules('dob', 'Date of birth', 'trim|required|xss_clean');
					$this->form_validation->set_rules('marital_status', 'Marital Status', 'trim|required|xss_clean');
					$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
					$this->form_validation->set_rules('contact_no', 'Contact Number', 'trim|required|xss_clean');
					$this->form_validation->set_rules('tin', 'TIN', 'trim|required|xss_clean');
					$this->form_validation->set_rules('sss', 'SSS', 'trim|required|xss_clean');
					$this->form_validation->set_rules('phil_health', 'PhilHealth', 'trim|required|xss_clean');
					$this->form_validation->set_rules('gsis', 'GSIS', 'trim|required|xss_clean');
					$this->form_validation->set_rules('emergency_contact_person', 'Emergency Contact Person', 'trim|required|xss_clean');
					$this->form_validation->set_rules('emergency_contact_number', 'Emergency Contact Number', 'trim|required|xss_clean');
					$this->form_validation->set_rules('position_id', 'Position ID', 'trim|required|xss_clean');
					
					if ($this->form_validation->run()==true){
						$company_id = $this->input->post('company_id');
						$rank_id = $this->input->post('rank_id');
						$dept_id = $this->input->post('dept_id');
						$location_id = $this->input->post('location_id');
						$fname = $this->input->post('fname');
						$mname = $this->input->post('mname');
						$lname = $this->input->post('lname');
						$dob = $this->input->post('dob');
						$marital_status = $this->input->post('marital_status');
						$address = $this->input->post('address');
						$contact_no = $this->input->post('contact_no');
						$tin = $this->input->post('tin');
						$sss = $this->input->post('sss');
						$phil_health = $this->input->post('phil_health');
						$gsis = $this->input->post('gsis');
						$emergency_contact_person = $this->input->post('emergency_contact_person');
						$emergency_contact_number = $this->input->post('emergency_contact_number');
						$position_id = $this->input->post('position_id');
						
						$emp_id = $this->jmodel->maxid('emp_id','employee');
						
						$insert_employee = array(
							'emp_id' => $emp_id,
							'company_id' => $company_id,
							'rank_id' => $rank_id,
							'dept_id' => $dept_id,
							'location_id' => $location_id,
							'fname' => $fname,
							'mname' => $mname,
							'lname' => $lname,
							'dob' => $dob,
							'marital_status' => $marital_status,
							'address' => $address,
							'contact_no' => $contact_no,
							'tin' => $tin,
							'sss' => $sss,
							'phil_health' => $phil_health,
							'gsis' => $gsis,
							'emergency_contact_number' => $emergency_contact_person,
							'emergency_contact_number' => $emergency_contact_number,
							'position_id' => $position_id
						);
						
						$insert_employee = $this->jmodel->insert_data('employee',$insert_employee);
						if($insert_employee){
							#$this->session->set_flashdata('message', '<h1>Successfully saved</h1>');
							#redirect($this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3));
							echo json_encode(array("success"=>"1","error_msg"=>""));
							return false;
						}else{
							$errors = "Database error found.";
						}
					}else{
						$error = validation_errors('<span class="error_zone">','</span>');
						echo json_encode(array("success"=>"0","error_msg"=>$error));
						return false;
					}
				}
			}
			
			$data['employee_list'] = $this->jmodel->display_data('employee');
			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/employee_view', $data);
		}
		
		public function test($a,$b){
			echo $a+$b;
		}
	
	}

/* End of file employee.php */
/* Location: ./application/controllers/hr/employee.php */