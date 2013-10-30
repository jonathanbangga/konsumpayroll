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
			$this->theme = $this->config->item('default');
			$this->load->model('konsumglobal_jmodel','jmodel');
			
			$this->sidebar_menu = 'content_holders/company_sidebar_menu';
			$this->menu = 'content_holders/company_menu';
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "Employee's Account";		
			$data['sidebar_menu'] =$this->sidebar_menu;
			if($this->input->is_ajax_request()) {
				if($this->input->post('save')){
					$this->form_validation->set_rules('company_id', 'Company', 'trim|required|xss_clean');
					$this->form_validation->set_rules('rank_id', 'Rank', 'trim|required|xss_clean');
					$this->form_validation->set_rules('dept_id', 'Department', 'trim|required|xss_clean');
					$this->form_validation->set_rules('location_id', 'Location', 'trim|required|xss_clean');
					$this->form_validation->set_rules('fname', 'Firstname', 'trim|required|xss_clean');
					$this->form_validation->set_rules('mname', 'Middlename', 'trim|required|xss_clean');
					$this->form_validation->set_rules('lname', 'Lastname', 'trim|required|xss_clean');
					$this->form_validation->set_rules('emailaddress', 'Email Address', 'trim|required|xss_clean|valid_email|is_unique[accounts.email]');
					$this->form_validation->set_rules('dob', 'Date of birth', 'trim|required|xss_clean');
					$this->form_validation->set_rules('marital_status', 'Marital Status', 'trim|required|xss_clean');
					$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
					$this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required|xss_clean');
					$this->form_validation->set_rules('home_no', 'Home Number', 'trim|required|xss_clean');
					$this->form_validation->set_rules('tin', 'TIN', 'trim|required|xss_clean');
					$this->form_validation->set_rules('sss', 'SSS', 'trim|required|xss_clean');
					$this->form_validation->set_rules('phil_health', 'PhilHealth', 'trim|required|xss_clean');
					$this->form_validation->set_rules('gsis', 'GSIS', 'trim|required|xss_clean');
					$this->form_validation->set_rules('hdmf', 'HDMF', 'trim|required|xss_clean');
					$this->form_validation->set_rules('emergency_contact_person', 'Emergency Contact Person', 'trim|required|xss_clean');
					$this->form_validation->set_rules('emergency_contact_number', 'Emergency Contact Number', 'trim|required|xss_clean');
					$this->form_validation->set_rules('position_id', 'Position', 'trim|required|xss_clean');
					$this->form_validation->set_rules('payroll_group_id', 'Payroll Group', 'trim|required|xss_clean');
					
					$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|is_unique[accounts.payroll_cloud_id]');
					$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|matches[confirmpass]|min_length[8]|max_length[12]');
					$this->form_validation->set_rules('permission', 'Permission', 'trim|required|xss_clean');
					
					if ($this->form_validation->run()==true){
						$company_id = $this->input->post('company_id');
						$rank_id = $this->input->post('rank_id');
						$dept_id = $this->input->post('dept_id');
						$location_id = $this->input->post('location_id');
						$fname = $this->input->post('fname');
						$mname = $this->input->post('mname');
						$lname = $this->input->post('lname');
						$emailaddress = $this->input->post('emailaddress');
						$dob = $this->input->post('dob');
						$marital_status = $this->input->post('marital_status');
						$address = $this->input->post('address');
						$mobile_no = $this->input->post('mobile_no');
						$home_no = $this->input->post('home_no');
						$tin = $this->input->post('tin');
						$sss = $this->input->post('sss');
						$phil_health = $this->input->post('phil_health');
						$gsis = $this->input->post('gsis');
						$hdmf = $this->input->post('hdmf');
						$emergency_contact_person = $this->input->post('emergency_contact_person');
						$emergency_contact_number = $this->input->post('emergency_contact_number');
						$position_id = $this->input->post('position_id');
						$payroll_group_id = $this->input->post('payroll_group_id');
						
						$username = $this->input->post('username');
						$password = md5($this->input->post('password'));
						$permission = $this->input->post('permission');
						
						$emp_id = $this->jmodel->maxid('emp_id','employee');
						$account_id = $this->jmodel->maxid('account_id','accounts');
						
						$insert_employee = array(
							'emp_id' => $emp_id,
							'company_id' => $company_id,
							'rank_id' => $rank_id,
							'dept_id' => $dept_id,
							'location_id' => $location_id,
							'first_name' => $fname,
							'middle_name' => $mname,
							'last_name' => $lname,
							'dob' => $dob,
							'marital_status' => $marital_status,
							'address' => $address,
							'mobile_no' => $mobile_no,
							'home_no' => $home_no,
							'tin' => $tin,
							'sss' => $sss,
							'phil_health' => $phil_health,
							'gsis' => $gsis,
							'hdmf' => $hdmf,
							'emergency_contact_person' => $emergency_contact_person,
							'emergency_contact_number' => $emergency_contact_number,
							'position_id' => $position_id,
							'permission_id' => $permission,
							'payroll_group_id' => $payroll_group_id,
							'account_id' => $account_id,
							'status' => 'Active'
						);
						
						$insert_account = array(
							'account_id' => $account_id,
							'payroll_cloud_id' => $username,
							'password' => $password,
							'account_type_id' => 1,
							'email' => $emailaddress,
							'deleted' => 0
						);
						
						$insert_employee = $this->jmodel->insert_data('employee',$insert_employee);
						$insert_account = $this->jmodel->insert_data('accounts',$insert_account);
						
						if($insert_employee && $insert_account){
							echo json_encode(array("success"=>"1","error_msg"=>""));
							return false;
						}else{
							$error = "Database error found.";
							echo json_encode(array("success"=>"0","error_msg"=>$error));
							return false;
						}
					}else{
						$error = validation_errors('<span class="error_zone">','</span>');
						echo json_encode(array("success"=>"0","error_msg"=>$error));
						return false;
					}
				}
			}
			
			$data['employee_list'] = $this->jmodel->display_data('employee');
			$data['rank'] = $this->jmodel->display_data('rank');
			$data['dept'] = $this->jmodel->display_data('department');
			$data['location'] = $this->jmodel->display_data('location');
			$data['position'] = $this->jmodel->display_data('position');
			$data['payroll_group'] = $this->jmodel->display_data('payroll_group');
			$data['permission'] = $this->jmodel->display_data('permission');
			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/employee/employee_view', $data);
		}
		
		public function delete_user(){
			if($this->input->is_ajax_request()) {
				$user_id = $this->input->post('user_id');
				$delete_employee = $this->jmodel->delete_data('employee','account_id',$user_id);
				$delete_account = $this->jmodel->delete_data('accounts','account_id',$user_id);
				if($delete_employee && $delete_account){
					echo json_encode(array("success"=>"1","error_msg"=>""));
					return false;
				}else{
					$error = "Database error";
					echo json_encode(array("success"=>"0","error_msg"=>$error));
					return false;
				}
			}else{
				show_404();
			}
		}
	
	}

/* End of file employee.php */
/* Location: ./application/controllers/hr/employee.php */