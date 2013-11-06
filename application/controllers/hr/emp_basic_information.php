<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Basic Information Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_basic_information extends CI_Controller {
		
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
			$data['page_title'] = "Basic Information";
			$data['sidebar_menu'] = $this->sidebar_menu;
			
			$data['employee'] = $this->hr_emp->view_employee($this->company_id);
			
			if($this->input->post('add')){
				$this->form_validation->set_rules('uname', 'Username', 'trim|required|xss_clean');
				$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('middle_name', 'Middle Name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('location_id', 'Location', 'trim|required|xss_clean');
				$this->form_validation->set_rules('dob', 'Birth Date', 'trim|required|xss_clean');
				$this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
				$this->form_validation->set_rules('marital_status', 'Marital Status', 'trim|required|xss_clean');
				$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
				$this->form_validation->set_rules('contact_no', 'Contact Number', 'trim|required|xss_clean');
				$this->form_validation->set_rules('tin', 'TIN', 'trim|required|xss_clean');
				$this->form_validation->set_rules('sss', 'SSS', 'trim|required|xss_clean');
				$this->form_validation->set_rules('hdmf', 'HDMF', 'trim|required|xss_clean');
				$this->form_validation->set_rules('no_dependents', 'Number of Dependents', 'trim|required|xss_clean');
				
				if ($this->form_validation->run()==true){
					foreach($this->input->post('uname') as $key=>$val){
						$company_id = "";
						$rank_id = "";
						$dept_id = "";
						$location_id = "";
						$fname = $this->input->post('first_name')[$key];
						$mname = $this->input->post('middle_name')[$key];
						$lname = $this->input->post('last_name')[$key];
						$emailaddress = "";
						$dob = $this->input->post('dob')[$key];
						$marital_status = $this->input->post('marital_status')[$key];
						$address = $this->input->post('address')[$key];
						$mobile_no = "";
						$home_no = "";
						$tin = $this->input->post('tin')[$key];
						$sss = $this->input->post('sss')[$key];
						$phil_health = "";
						$gsis = "";
						$hdmf = $this->input->post('hdmf')[$key];
						$emergency_contact_person = "";
						$emergency_contact_number = "";
						$position_id = "";
						$payroll_group_id = "";
						
						$username = $this->input->post('uname')[$key];
						$password = "";
						$permission = "";
						
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
							$this->session->set_flashdata('message', '<p class="save_alert">Successfully saved!</p>');
							redirect($this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3));
						}
					}
				}
			}
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/emp_basic_info_view', $data);
		}
	
	}

/* End of file sss_tbl.php */
/* Location: ./application/controllers/hr/sss_tbl.php */