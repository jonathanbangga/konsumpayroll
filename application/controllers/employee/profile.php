<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Profile Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Profile extends CI_Controller {
		
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
			$this->load->model('employee/employee_model','employee');
			$this->load->model('konsumglobal_jmodel','jmodel');
			$this->emp_id = $this->uri->segment(5);
			
			$this->sidebar_menu = 'content_holders/company_sidebar_menu';
			$this->menu = 'content_holders/company_menu';
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "My Profile";
			$data['sidebar_menu'] =$this->sidebar_menu;
			$employee_id = $this->emp_id;
			$data['my_profile'] = $this->employee->my_profile($employee_id);
			
			if($this->input->is_ajax_request()) {
				if($this->input->post('save')){
					$this->form_validation->set_rules('fname', 'Firstname', 'trim|required|xss_clean');
					$this->form_validation->set_rules('mname', 'Middlename', 'trim|required|xss_clean');
					$this->form_validation->set_rules('lname', 'Lastname', 'trim|required|xss_clean');
					$this->form_validation->set_rules('emailaddress', 'Email Address', 'trim|required|xss_clean|valid_email|callback_email_check');
					$this->form_validation->set_rules('dob', 'Date of birth', 'trim|required|xss_clean');
					$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
					$this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required|xss_clean');
					$this->form_validation->set_rules('home_no', 'Home Number', 'trim|required|xss_clean');
					$this->form_validation->set_rules('emergency_contact_person', 'Emergency Contact Person', 'trim|required|xss_clean');
					$this->form_validation->set_rules('emergency_contact_number', 'Emergency Contact Number', 'trim|required|xss_clean');
					
					$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|callback_uname_check');
					$this->form_validation->set_rules('old_pass', 'Old Password', 'trim|required|xss_clean|callback_pass_check');
					$this->form_validation->set_rules('new_pass', 'New Password', 'trim|required|xss_clean|matches[confirmpass]|min_length[8]|max_length[12]');

					if ($this->form_validation->run()==true){
						
						$fname = $this->input->post('fname');
						$mname = $this->input->post('mname');
						$lname = $this->input->post('lname');
						$emailaddress = $this->input->post('emailaddress');
						$dob = $this->input->post('dob');
						$address = $this->input->post('address');
						$mobile_no = $this->input->post('mobile_no');
						$home_no = $this->input->post('home_no');
						$emergency_contact_person = $this->input->post('emergency_contact_person');
						$emergency_contact_number = $this->input->post('emergency_contact_number');
						
						$username = $this->input->post('username');
						$password = md5($this->input->post('new_pass'));
						
						$update_employee = array(
							'fname' => $fname,
							'mname' => $mname,
							'lname' => $lname,
							'dob' => $dob,
							'address' => $address,
							'mobile_no' => $mobile_no,
							'home_no' => $home_no,
							'emergency_contact_person' => $emergency_contact_person,
							'emergency_contact_number' => $emergency_contact_number,
						);
						
						$update_account = array(
							'payroll_cloud_id' => $username,
							'password' => $password,
							'email' => $emailaddress,
						);
						
						$update_employee = $this->jmodel->update_data('employee',$update_employee,$this->emp_id,'emp_id');
						$account_id = $this->jmodel->display_data_where('employee','emp_id',$this->emp_id);
						$update_account = $this->jmodel->update_data('accounts',$update_account,$account_id->account_id,'account_id');
						
						if($update_employee && $update_account){
							#echo json_encode(array("success"=>"0","error_msg"=>$this->db->last_query())); 
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
			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/employee/profile_view', $data);
		}
		
		/**
		 * Check old password
		 * @param unknown_type $str
		 */
		public function pass_check($str){
			$pass = md5($str);
			$sql = $this->db->query("
				SELECT *FROM accounts a
				LEFT JOIN employee e ON a.account_id = e.account_id
				WHERE e.emp_id = '{$this->emp_id}'
				AND a.password = '{$pass}' 
			");
			if($sql->num_rows() == 1){
				return true;
			}else{
				$this->form_validation->set_message("pass_check","The Old Password is invalid.");
				return false;
			}
		}
		
		/**
		 * Check email addeess
		 * @param unknown_type $str
		 */
		public function email_check($str){
			
			$sql = $this->db->query("
				SELECT *FROM accounts a
				LEFT JOIN employee e ON a.account_id = e.account_id
				WHERE a.email = '{$str}'
			");
			
			if($sql->num_rows() == 1){
				$row = $sql->row();
				$sql->free_result();
				
				$check_my_email = $this->db->query("
					SELECT *FROM accounts a
					LEFT JOIN employee e ON a.account_id = e.account_id
					WHERE e.emp_id = '{$this->emp_id}'
				");
				
				$row_emailadd = $check_my_email->row();
				
				if($row->email == $row_emailadd->email){
					return true;
				}else{
					$this->form_validation->set_message("email_check","The Email Address field must contain a unique value.");
					return false;
				}
			}else{
				return true;
			}
		}
		
		/**
		 * Check username
		 * @param unknown_type $str
		 */
		public function uname_check($str){
			$sql = $this->db->query("
				SELECT *FROM accounts a
				LEFT JOIN employee e ON a.account_id = e.account_id
				WHERE a.payroll_cloud_id = '{$str}'
			");
			
			if($sql->num_rows() == 1){
				$row = $sql->row();
				$sql->free_result();
				
				$check_my_uname = $this->db->query("
					SELECT *FROM accounts a
					LEFT JOIN employee e ON a.account_id = e.account_id
					WHERE e.emp_id = '{$this->emp_id}'
				");
				
				$row_uname = $check_my_uname->row();
				
				if($row->payroll_cloud_id == $row_uname->payroll_cloud_id){
					return true;
				}else{
					$this->form_validation->set_message("uname_check","The Username field must contain a unique value.");
					return false;
				}
			}else{
				return true;
			}
		}
	}
	
/* End of file profile.php */
/* Location: ./application/controllers/hr/profile.php */