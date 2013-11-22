<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_profile extends CI_Controller {

	/**
	 * Theme options - default theme
	 * @var string
	 */
	protected $theme;
	protected $sidebar_menu;
	
	var $access_type;
	var $account_id;
	/**
	 * Constructor
	 */
	public function __construct(){
		parent::__construct();
		$this->theme = $this->config->item('company_dashboard');
		$this->menu = $this->config->item('company_dashboard_menu');
		$this->load->model("dashboard/company_list_model","admin");
		$this->authentication->check_if_logged_in();	
		delete_company_session();
		$this->access_type = $this->session->userdata('user_type_id');
		$this->account_id = $this->session->userdata('account_id');
	}

	/**
	 * index page
	 */
	public function index(){		
		$data['page_title'] = "My Profile";
		$data['error'] = "";
		$data['name'] = "";
		if($this->access_type == 2){ // OWNER
			$data['name'] = $this->profile->get_account($this->account_id,"company_owner");
		}else if($this->access_type == 3){ // EMPLOYEE
			$data['name'] = $this->profile->get_account($this->account_id,"employee");
		}
		if($this->input->post('save')){			
			if($this->access_type != 2){
				$this->form_validation->set_rules('payroll_cloud_id',"Username",'xss_clean|trim|required|min_length[12]|max_length[20]');	
			}
			$this->form_validation->set_rules('first_name','First Name','xss_clean|trim|required');
			$this->form_validation->set_rules('last_name','Last Name','xss_clean|trim|required');
			$this->form_validation->set_rules('middle_name','Middle Name','xss_clean|trim|required');
			$this->form_validation->set_rules('birth_date','Birth date','xss_clean|trim|required');
			$this->form_validation->set_rules('mobile_no','Mobile Number','xss_clean|trim|required');
			$this->form_validation->set_rules('home_no','Telephone Number','xss_clean|trim|required');
			$this->form_validation->set_rules('home_add',"Home Address",'xss_clean|trim|required');
			$this->form_validation->set_rules('emergency_contact_person',"Emergency Contact Person",'xss_clean|trim|required');
			$this->form_validation->set_rules("email_add","Email Address","xss_clean|valid_email|trim");		
			$this->form_validation->set_rules("old_email_add","Email Address","xss_clean|valid_email|trim");				
			$this->form_validation->set_rules('emergency_contact_number',"Emergency Contact Number",'xss_clean|trim|required');
			$this->form_validation->set_rules('old_password',"Old password",'xss_clean|trim|required|min_length[12]|max_length[20]');
			$this->form_validation->set_rules('new_password',"New password",'xss_clean|trim|required|matches[retype_password]|min_length[12]|max_length[20]');
			$this->form_validation->set_rules('retype_password',"Retype password",'xss_clean|trim|required|min_length[12]|max_length[20]');
			$this->form_validation->set_rules('security_question',"Security Question",'xss_clean|trim|required');
			$this->form_validation->set_rules('security_answer','Security Answer','xss_clean|trim|required');
			if($this->form_validation->run() == TRUE){	
				$where = array("account_id"=>$this->account_id);
				$fields = array(
						"first_name" 	=> $this->input->post('first_name'),
						"middle_name"	=> $this->input->post('middle_name'),
						"last_name"		=> $this->input->post('last_name'),
						"address"		=> $this->input->post('address'),
						"home_no"		=> $this->input->post('home_no'),
						"mobile_no"		=> $this->input->post('mobile_no'),
						"emergency_contact_person" => $this->input->post('emergency_contact_person'),
						"emergency_contact_number" => $this->input->post('emergency_contact_number'),
						"security_question"	=> $this->input->post('security_question'),
						"security_answer"	=> $this->input->post('security_answer')
				);
				if($this->access_type == 2){ // OWNER
					// update company owners
					$this->admin->update_fields("company_owner",$fields,$where);
					// update account 
					$account_field = array(
						"email"		=> $this->input->post("email_add"),
						"password"	=> $this->input->post('new_password')
					);
					$this->admin->update_fields("accounts",$account_field,$where);			
				}else if($this->access_type == 3){ // HR
					// UPDATE EMPLOYEE TABLE
					$this->admin->update_fields("employee",$fields,$where);
					// UPDATE ACCOUNT
					$account_field = array(
						"email"		=> $this->input->post("email_add"),
						"password"	=> $this->input->post('new_password')
					);
					$this->admin->update_fields("accounts",$account_field,$where);
				}	
				$this->session->set_flashdata("success","Successfully saved");
				redirect($this->uri->uri_string());
			}else{
				$data['error'] = validation_errors("<span class='error_zone'>","</span>");	
			}
		}
		$this->layout->set_layout($this->theme);
		$this->layout->view('pages/dashboard/admin_profile_view', $data);
	}
	
	public function email_check($str){
		$old_email = $this->input->post("old_email_add");
		$new_email = $this->input->post("email_add");
		$query = $this->db->query("SELECT * FROM accounts WHERE ");
	}
}

/* End of file */