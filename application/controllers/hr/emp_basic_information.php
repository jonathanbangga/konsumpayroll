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
			$this->authentication->check_if_logged_in();
			$this->theme = $this->config->item('default');
			$this->load->model('konsumglobal_jmodel','jmodel');
			$this->load->model('hr/hr_employee_model','hr_emp');
			
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
			$data['page_title'] = "Basic Information";
			$data['sidebar_menu'] = $this->sidebar_menu;
			
			// init pagination
			$uri = "/{$this->uri->segment(1)}/hr/emp_basic_information/index";
			$total_rows = $this->hr_emp->basic_emp_view_all_active_user_count($this->company_id);
			$per_page = $this->config->item('per_page');
			$segment=5;
			
			init_pagination($uri,$total_rows,$per_page,$segment);

			$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
			$data["links"] = $this->pagination->create_links();
			// end pagination
			
			$data['employee'] = $this->hr_emp->basic_emp_view_all_active_user($per_page, $page, $this->company_id);
			
			if($this->input->post('add')){
				foreach($this->input->post('uname') as $key_2=>$val){
					$this->form_validation->set_rules("uname[{$key_2}]", 'Username', 'trim|required|xss_clean');
					$this->form_validation->set_rules("last_name[{$key_2}]", 'Last Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules("first_name[{$key_2}]", 'First Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules("middle_name[{$key_2}]", 'Middle Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules("email[{$key_2}]", 'Email', 'trim|required|xss_clean|valid_email');
					$this->form_validation->set_rules("dob[{$key_2}]", 'Birth Date', 'trim|required|xss_clean');
					$this->form_validation->set_rules("gender[{$key_2}]", 'Gender', 'trim|required|xss_clean');
					$this->form_validation->set_rules("marital_status[{$key_2}]", 'Marital Status', 'trim|required|xss_clean');
					$this->form_validation->set_rules("address[{$key_2}]", 'Address', 'trim|required|xss_clean');
					$this->form_validation->set_rules("contact_no[{$key_2}]", 'Contact Number', 'trim|required|xss_clean');
					$this->form_validation->set_rules("tin[{$key_2}]", 'TIN', 'trim|required|xss_clean');
					$this->form_validation->set_rules("sss[{$key_2}]", 'SSS', 'trim|required|xss_clean');
					$this->form_validation->set_rules("hdmf[{$key_2}]", 'HDMF', 'trim|required|xss_clean');
					$this->form_validation->set_rules("philhealth[{$key_2}]", 'PhilHealth', 'trim|required|xss_clean');
					$this->form_validation->set_rules("no_dependents[{$key_2}]", 'Number of Dependents', 'trim|required|xss_clean');
				}
				
				if ($this->form_validation->run()==true){
					foreach($this->input->post('uname') as $key=>$val){
						$company_id = $this->company_id;
						$rank_id = "";
						$dept_id = "";
						$location_id = "";
						$fname = $this->input->post('first_name');
						$mname = $this->input->post('middle_name');
						$lname = $this->input->post('last_name');
						$emailaddress = $this->input->post('email');
						$dob = $this->input->post('dob');
						$marital_status = $this->input->post('marital_status');
						$address = $this->input->post('address');
						$mobile_no = "";
						$home_no = $this->input->post('contact_no');
						$tin = $this->input->post('tin');
						$sss = $this->input->post('sss');
						$phil_health = $this->input->post('philhealth');
						$gsis = "";
						$hdmf = $this->input->post('hdmf');
						$emergency_contact_person = "";
						$emergency_contact_number = "";
						$no_dependents = $this->input->post('no_dependents');
						$position_id = "";
						$payroll_group_id = "";
						
						$username = $this->input->post('uname');
						$password = "";
						$permission = "";
						
						$emp_id = $this->jmodel->maxid('emp_id','employee');
						$account_id = $this->jmodel->maxid('account_id','accounts');
						
						// Check Username
					
						$validate_uname = $this->hr_emp->validate_name($username[$key]);
						if($validate_uname){
							show_error("The Employee Number field must contain a unique value");
							return false;
						}
						
						// Check Employee Email Address
						$validate_email = $this->hr_emp->validate_email($emailaddress[$key]);
						if($validate_email){
							show_error("The Email Address field must contain a unique value");
							return false;
						}
						
						$insert_employee = array(
							'emp_id' => $emp_id,
							'company_id' => $company_id,
							'rank_id' => $rank_id,
							'dept_id' => $dept_id,
							'location_id' => $location_id,
							'first_name' => $fname[$key],
							'middle_name' => $mname[$key],
							'last_name' => $lname[$key],
							'dob' => $dob[$key],
							'marital_status' => $marital_status[$key],
							'address' => $address[$key],
							'mobile_no' => $mobile_no,
							'home_no' => $home_no[$key],
							'tin' => $tin[$key],
							'sss' => $sss[$key],
							'phil_health' => $phil_health[$key],
							'gsis' => $gsis,
							'hdmf' => $hdmf[$key],
							'emergency_contact_person' => $emergency_contact_person,
							'emergency_contact_number' => $emergency_contact_number,
							'no_of_dependents' => $no_dependents[$key],
							'position_id' => $position_id,
							'permission_id' => $permission,
							'payroll_group_id' => $payroll_group_id,
							'account_id' => $account_id,
							'status' => 'Active'
						);	
						
						$insert_account = array(
							'account_id' => $account_id,
							'payroll_cloud_id' => $username[$key],
							'payroll_system_account_id'=>'2',
							'password' => $password,
							'account_type_id' => "2",
							'email' => $emailaddress[$key],
							'user_type_id'=>"5",
							'token'=>tokenize(),
							'deleted' => "0"
						);
							
						$insert_employee_sql = $this->jmodel->insert_data('employee',$insert_employee);
						$insert_account_sql = $this->jmodel->insert_data('accounts',$insert_account);
					}
					
					$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully saved!</div>');
					redirect($this->url);
				}else{
					print validation_errors();
					return false;
				}
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
				
				// Check Employee Email Address
				if($this->input->post('check_email_address')){
					$ajax_email_val = $this->input->post('email_val');
					foreach($ajax_email_val as $key_email=>$val_email){
						$validate_email = $this->hr_emp->validate_email($ajax_email_val[$key_email]);
						if($validate_email){
							echo json_encode(array("success"=>1));
							return false;
						}else{
							echo json_encode(array("success"=>0));
							return false;
						}
					}
				}
				
				// Delete Employee Information
				// Delete Account Information
				if($this->input->post('del_empDB')){
					$emp_id = $this->input->post('emp_id');
					$delete_me = $this->hr_emp->update_basic_emp($emp_id,$this->company_id);
					
					if($delete_me){
						$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully deleted!</div>');
						echo json_encode(array("success"=>1,"url"=>$this->url));
						return false;
					}
				}
				
				// get information
				if($this->input->post('get_information')){
					$emp_id = $this->input->post('emp_id');
					$emp_res = $this->hr_emp->emp_res($emp_id,$this->company_id);
					if($emp_res != FALSE){
						echo json_encode(
							array(
								"success"=>1,
								"account_id"=>$emp_res->account_id,
								"emp_id"=>$emp_res->emp_id,
								"last_name"=>$emp_res->last_name,
								"first_name"=>$emp_res->first_name,
								"middle_name"=>$emp_res->middle_name,
								"email"=>$emp_res->email,
								"dob"=>$emp_res->dob,
								"gender"=>$emp_res->gender,
								"marital_status"=>$emp_res->marital_status,
								"address"=>$emp_res->address,
								"contact_no"=>$emp_res->home_no,
								"mobile_no"=>$emp_res->mobile_no,
								"home_no"=>$emp_res->home_no,
								"tin"=>$emp_res->tin,
								"hdmf"=>$emp_res->hdmf,
								"sss"=>$emp_res->sss,
								"philhealth"=>$emp_res->phil_health,
								"gsis"=>$emp_res->gsis,
								"no_of_dependents"=>$emp_res->no_of_dependents
							)
						);
						return false;
					}else{
						echo json_encode(array("success"=>0));
						return false;
					}
				}
				
				// updating information
				if($this->input->post('update_info')){
					$emp_idEdit = $this->input->post('emp_idEdit');
					$lastname_edit = $this->input->post('lastname_edit');
					$firstname_edit = $this->input->post('firstname_edit');
					$middlename_edit = $this->input->post('middlename_edit');
					$account_id = $this->input->post('account_id');
					$old_email_edit = $this->input->post('old_email_edit');
					$email_edit = $this->input->post('email_edit');
					$dob_edit = $this->input->post('dob_edit');
					$gender_edit = $this->input->post('gender_edit');
					$marital_status_edit = $this->input->post('marital_status_edit');
					$address_edit = $this->input->post('address_edit');
					$contact_no_edit = $this->input->post('contact_no_edit');
					$tin_edit = $this->input->post('tin_edit');
					$sss_edit = $this->input->post('sss_edit');
					$hdmf_edit = $this->input->post('hdmf_edit');
					$philhealth_edit = $this->input->post('philhealth_edit');
					$no_qual_dep_edit = $this->input->post('no_qual_dep_edit');
					
					$check_email_address = $this->hr_emp->update_check_email_address($old_email_edit,$email_edit);
					if($check_email_address == FALSE){
						echo json_encode(array("success"=>3,"msg"=>"The Email Address field must contain a unique value."));
						return false;
					}
					
					$update_array = array(
						'last_name'=>$lastname_edit,
						'first_name'=>$firstname_edit,
						'middle_name'=>$middlename_edit,
						'dob'=>$dob_edit,
						'gender'=>$gender_edit,
						'marital_status'=>$marital_status_edit,
						'address'=>$address_edit,
						'home_no'=>$contact_no_edit,
						'tin'=>$tin_edit,
						'sss'=>$sss_edit,
						'hdmf'=>$hdmf_edit,
						'phil_health'=>$philhealth_edit,
						'no_of_dependents'=>$no_qual_dep_edit
					);
					
					$update_email = array(
						'email'=>$email_edit
					);
					$update_info = $this->jmodel->update_data('employee',$update_array,$emp_idEdit,'emp_id');
					$update_emailadd_info = $this->jmodel->update_data('accounts',$update_email,$account_id,'account_id');
					if($update_info && $update_emailadd_info){
						$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully updated!</div>');
						echo json_encode(array("success"=>1,"url"=>$this->url));
						return false;
					}else{
						echo json_encode(array("success"=>0));
					}
				}
			}
			
			/* $this->load->library('csvreader');
	        $resultcsv =   $this->csvreader->parse_file('uploads/Test.csv');//path to csv file
	
	        $data['csvData'] =  $resultcsv; */
			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/emp_basic_info_view', $data);
		}
	
	}

/* End of file sss_tbl.php */
/* Location: ./application/controllers/hr/sss_tbl.php */