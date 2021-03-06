<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * Users Settings
 *
 * @subpackage Hr 
 * @category Controller
 * @version 1.0
 * @copyright Copyright (c) 2013, Konsum Technologies Inc.
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */

class Users extends CI_Controller {

	var $theme;
	var $num_pagi;
	var $segment_url;
	var $sidebar_menu;
	var $company_info;
	var $per_page;
	var $segment;
	var $subdomain;
	public function __construct() {
		parent::__construct();
		$this->load->library('parser');
		$this->load->library('email');
		$this->theme = $this->config->item('temp_control_panel');
		$this->load->model("hr/users_model","users");
		$this->num_pagi = 3;
		$this->segment_url = 4;
		$this->authentication->check_if_logged_in();	
		$this->menu = "content_holders/user_hr_owner_menu";
		$this->sidebar_menu = 'content_holders/hr_approver_sidebar_menu';
		$this->company_info =  whose_company();
		$this->per_page = 10;
		$this->segment = 5;
		$this->subdomain = $this->uri->segment(1);
		if($this->company_info == false){
			show_error("Company subdomain is invalid");
			return false;
		}
	}

	public function index(){
		$url = "/{$this->subdomain}/hr/users/index";
		$page = is_numeric($this->uri->segment(5)) ? $this->uri->segment(5) : 1;
		$data['page_title'] = "Manage Users";	
		$data['sidebar_menu'] =$this->sidebar_menu;	
		$data['total_rows'] = $this->users->fetch_approvers_users_count($this->company_info->company_id);
		init_pagination($url,$data['total_rows'],$this->per_page,$this->segment);
		$data['pagi'] = $this->pagination->create_links();
		$data['company_info'] = $this->company_info;
		$data['approval_group'] = $this->users->fetch_approval_group($this->company_info->company_id);
		$data['approval_process'] = $this->users->approval_process($this->company_info->company_id);
		$data['permission_type'] = $this->users->permission_type($this->company_info->company_id);
		$data['approvers_list'] = $this->users->fetch_approvers_users($this->company_info->company_id,$this->per_page,(($page-1) * $this->per_page));
		// save
			if($this->input->post('save')){
				$payroll_cloud_id = $this->input->post('payroll_cloud_id');
				$emp_email  = $this->input->post('email');
				$emp_first 	= $this->input->post("first_name");
				$emp_middle = $this->input->post("middle_name");
				$emp_last 	= $this->input->post("last_name");
				$password	= $this->input->post('password');
				$payroll_group = $this->input->post('payroll_group');
				$approval_process_id =  $this->input->post('approval_process_id');
				$emp_permission	= $this->input->post('permission');	
				if($emp_email){
					foreach($payroll_cloud_id as $k=>$v){
						$this->form_validation->set_rules("payroll_cloud_id[".$k."]","Payroll Cloud ID (".$k."):","required|trim|xss_clean|is_unique[accounts.payroll_cloud_id]");
						$this->form_validation->set_rules("email[".$k."]","Employee Email (".$k."):","required|trim|xss_clean|valid_email|is_unique[accounts.email]");
						$this->form_validation->set_rules("first_name[".$k."]","Employee First Name (".$k."):","required|trim|xss_clean");
						$this->form_validation->set_rules("middle_name[".$k."]","Employee Middle Name (".$k."):","required|trim|xss_clean");
						$this->form_validation->set_rules("last_name[".$k."]","Employee Last Name (".$k."):","required|trim|xss_clean");
						//$this->form_validation->set_rules("password[".$k."]","Employee password (".$k."):","required|trim|xss_clean");
						//$this->form_validation->set_rules("approval_process_id[".$k."]","Employee Payroll group (".$k."):","required|trim|xss_clean");
						$this->form_validation->set_rules("permission[".$k."]","Permission (".$k."):","trim|xss_clean");
					}		
				}		
				if($this->form_validation->run() == TRUE){	
					foreach($payroll_cloud_id as $key=>$val){
						$account_fields = array(
									"payroll_cloud_id" 	=> $this->db->escape_str($val),
									//"password"			=> md5($password[$key]),
									"account_type_id"	=> 2, // 2 which is users only
									"user_type_id"		=> 3,  // 3 Defines as HR on user_type table
									"email"				=> $emp_email[$key],
									"payroll_system_account_id" => $this->session->userdata("psa_id")
						);	
						$account_id = $this->users->save_fields("accounts",$account_fields);
						// CREATE EMPLOYEE
						$fields = array(
							"last_name" 	=> $this->db->escape_str($emp_last[$key]),
							"first_name" 	=> $this->db->escape_str($emp_first[$key]),
							"middle_name"	=> $this->db->escape_str($emp_middle[$key]),
							"account_id"	=> $this->db->escape_str($account_id),
							"company_id"	=> $this->company_info->company_id
						);
						$emp_id = $this->users->save_fields("employee",$fields);
						// CREATE COMPANY APPROVERS
						$approvers_fields = array(
							"company_id"	=> $this->company_info->company_id,
							"account_id"	=> $account_id,
							"level"			=> "",
							"deleted"		=> '0',
							"users_roles_id"=>$this->db->escape_str($emp_permission[$key])
						);
						$this->users->save_fields("company_approvers",$approvers_fields);
						// ADD PAYROLL TO APPROVAL PROCESS
						$employee_info = $this->users->employee_info($account_id);
						if($approval_process_id[$key]){
							if($employee_info){
								$appgroups_fields = array(
									"approval_process_id" => $approval_process_id[$key],
									"emp_id"		=> $employee_info->emp_id,
									"company_id"	=> $this->company_info->company_id
								);
								$this->users->save_fields("approval_groups",$appgroups_fields);
							}
						}	
					}	
					echo json_encode(array("success"=>"1","error"=>""));
					return false;
				}else{
					$data['error'] = validation_errors("<span class='errors'>","</span>");
					echo json_encode(array("success"=>"0","error"=>$data['error']));
					return false;
				}
			}
		// save section	
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/hr/manage_users_admin_view', $data);
	}
	
	public function add_admin(){
		$url = "/{$this->subdomain}/hr/users/add_admin";
		$page = is_numeric($this->uri->segment(5)) ? $this->uri->segment(5) : 1;
		$data['page_title'] = "Manage Users Admin";	
		$data['sidebar_menu'] =$this->sidebar_menu;	
		$data['total_rows'] = $this->users->fetch_approvers_users_count($this->company_info->company_id);
		init_pagination($url,$data['total_rows'],$this->per_page,$this->segment);
		$data['pagi'] = $this->pagination->create_links();
		$data['company_info'] = $this->company_info;
		$data['approval_group'] = $this->users->fetch_approval_group($this->company_info->company_id);
		$data['approval_process'] = $this->users->approval_process($this->company_info->company_id);
	
		$data['user_roles'] = $this->users->permission_type($this->company_info->company_id);
		$data['approvers_list'] = $this->users->fetch_approvers_users($this->company_info->company_id,$this->per_page,(($page-1) * $this->per_page));
		$data['normal_employee'] = $this->users->normal_employee($this->company_info->company_id);

		// save
			if($this->input->post('save')){
				$payroll_cloud_id = $this->input->post('payroll_cloud_id');
				$emp_email  = $this->input->post('email');
				$employee_firstname 	= $this->input->post("employee_firstname");
				$employee_middlename 	= $this->input->post("employee_middlename");
				$employee_lastname 	= $this->input->post("employee_lastname");
				$emp_permission	= $this->input->post('permission');	
				$approval_process_id = $this->input->post("approval_process_id");
				if($emp_email){
					foreach($payroll_cloud_id as $k=>$v){
						$this->form_validation->set_rules("payroll_cloud_id[".$k."]","Payroll Cloud ID (".$k."):","required|trim|xss_clean|is_unique[accounts.payroll_cloud_id]");
						$this->form_validation->set_rules("email[".$k."]","Employee Email (".$k."):","required|trim|xss_clean|valid_email|is_unique[accounts.email]");
						$this->form_validation->set_rules("employee_firstname[".$k."]","Employee First Name (".$k."):","required|trim|xss_clean");
						$this->form_validation->set_rules("employee_middlename[".$k."]","Employee Middle Name (".$k."):","required|trim|xss_clean");
						$this->form_validation->set_rules("employee_lastname[".$k."]","Employee Last Name (".$k."):","required|trim|xss_clean");
						$this->form_validation->set_rules("permission[".$k."]","Permission (".$k."):","trim|xss_clean");
					}		
				}		
				if($this->form_validation->run() == TRUE){	
					foreach($payroll_cloud_id as $key=>$val){
						$account_fields = array(
									"payroll_cloud_id" 	=> $this->db->escape_str($val),
									"password"			=> md5("password"),
									"account_type_id"	=> 2, // 2 which is users only
									"user_type_id"		=> 3,  // 3 Defines as HR on user_type table
									"email"				=> $emp_email[$key],
									"payroll_system_account_id" => $this->session->userdata("psa_id"),
									"token"=> tokenize()
						);	
						$account_id = $this->users->save_fields("accounts",$account_fields);
						// CREATE EMPLOYEE
						$fields = array(
							"last_name" 	=> $this->db->escape_str($employee_lastname[$key]),
							"first_name" 	=> $this->db->escape_str($employee_firstname[$key]),
							"middle_name"=>$this->db->escape_str($employee_middlename[$key]),
							"account_id"	=> $this->db->escape_str($account_id),
							"company_id"	=> $this->company_info->company_id
						);
						$emp_id = $this->users->save_fields("employee",$fields);
						// CREATE COMPANY APPROVERS
						$approvers_fields = array(
							"company_id"	=> $this->company_info->company_id,
							"account_id"	=> $account_id,
							"level"			=> "",
							"deleted"		=> '0',
							"users_roles_id"=>$this->db->escape_str($emp_permission[$key])
						);
						$this->users->save_fields("company_approvers",$approvers_fields);
						// ADD PAYROLL TO APPROVAL PROCESS
						$employee_info = $this->users->employee_info($account_id);
						//if($approval_process_id[$key]){
						//	if($employee_info){
						//		$appgroups_fields = array(
						//			"approval_process_id" => $approval_process_id[$key],
						//			"emp_id"		=> $employee_info->emp_id,
						//			"company_id"	=> $this->company_info->company_id
						//		);
						//		$this->users->save_fields("approval_groups",$appgroups_fields);
						//	}
						//}	
					}	
					 $this->session->set_flashdata("add_admin_succes","Successfully saved!");
					echo json_encode(array("success"=>"1","error"=>""));
					return false;
				}else{
					$data['error'] = validation_errors("<span class='errors'>","</span>");
					echo json_encode(array("success"=>"0","error"=>$data['error']));
					return false;
				}
			}
		// save section	
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/hr/manage_users_admin_view', $data);
	}
	
	public function employee_list(){
		$url = "/{$this->subdomain}/hr/users/employee_list";
		$page = is_numeric($this->uri->segment(5)) ? $this->uri->segment(5) : 1;
		$data['page_title'] = "Manage Users Employee";	
		$data['sidebar_menu'] =$this->sidebar_menu;	
		$data['total_rows'] = $this->users->count_normal_employee($this->company_info->company_id);
		init_pagination($url,$data['total_rows'],$this->per_page,$this->segment);
		$data['pagi'] = $this->pagination->create_links();
		$data['company_info'] = $this->company_info;
		$data['normal_employee'] = $this->users->normal_employee($this->company_info->company_id,$this->per_page,(($page-1) * $this->per_page));
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/hr/manage_users_employee_view', $data);
	}
	
	public function add_employee(){
		if($this->input->post('save_employee')){
			$normal_payroll_cloud_id = $this->input->post('normal_payroll_cloud_id');
			$normal_employee_firstname = $this->input->post('normal_employee_firstname');
			$normal_employee_middlename = $this->input->post('normal_employee_middlename');
			$normal_employee_lastname = $this->input->post('normal_employee_lastname');
			$normal_payroll_cloud_id = $this->input->post('normal_payroll_cloud_id');
			$normal_email = $this->input->post('normal_email');
			
			foreach($normal_payroll_cloud_id as $k=>$v){
				$this->form_validation->set_rules("normal_payroll_cloud_id[".$k."]","Payroll Cloud ID (".$k."):","required|trim|xss_clean|is_unique[accounts.payroll_cloud_id]|min_length[8]|max_length[20]");
				$this->form_validation->set_rules("normal_email[".$k."]","Employee Email (".$k."):","required|trim|xss_clean|valid_email|is_unique[accounts.email]");
				$this->form_validation->set_rules("normal_employee_firstname[".$k."]","Employee First Name (".$k."):","required|trim|xss_clean");
				$this->form_validation->set_rules("normal_employee_middlename[".$k."]","Employee Middle Name (".$k."):","required|trim|xss_clean");
				$this->form_validation->set_rules("normal_employee_lastname[".$k."]","Employee Last Name (".$k."):","required|trim|xss_clean");	
			}		
			
			if($this->form_validation->run() == true){
				foreach($normal_payroll_cloud_id as $key=>$val):
					$account_fields = array(
						"payroll_cloud_id" 	=> $this->db->escape_str($val),
						"account_type_id"	=> 2, // 2 which is users only
						"user_type_id"		=> 5,  // 3 Defines as HR on user_type table
						"email"				=> $normal_email[$key],
						"payroll_system_account_id" => $this->session->userdata("psa_id"),
						"token"			=> tokenize()
					);	
				
					$account_id = $this->users->save_fields("accounts",$account_fields);
						// CREATE EMPLOYEE
					$fields = array(
						"last_name" 	=> $this->db->escape_str($normal_employee_lastname[$key]),
						"first_name" 	=> $this->db->escape_str($normal_employee_firstname[$key]),
						"middle_name" 	=> $this->db->escape_str($normal_employee_middlename[$key]),
						"account_id"	=> $this->db->escape_str($account_id),
						"company_id"	=> $this->company_info->company_id
					);
					$emp_id = $this->users->save_fields("employee",$fields);
				endforeach;
				$this->session->set_flashdata("add_admin_succes","Successfully saved!");
				echo json_encode(array("success"=>"1","error"=>""));
				return false;
			}else{
				$data['error'] = validation_errors("<span class='errors'>","</span>");
				echo json_encode(array("success"=>"0","error"=>$data['error']));
				return false;
			}
		};
	}
	
	public function ajax_check_email(){
		if($this->input->is_ajax_request()){
			$email = trim($this->input->post('email'));
			$row = $this->users->existing_email($email);
			echo json_encode(array("existings"=>$row));
			return false;
		}else{
			show_404();
		}
	}
	
	public function ajax_check_employee_id(){		
		if($this->input->is_ajax_request()){
			$normal_payroll_cloud_id = trim($this->input->post('check_employee_id'));
			$row = $this->users->existing_account($normal_payroll_cloud_id);
			echo json_encode(array("existings"=>$row));
			return false;
		}else{
			show_404();
		}
	}
	
	/**
	*	THIS FUNCTIONS SEND EMAIL TO THE EMPLOYEE ONLY INCLUDING HR WHICH ADMIN
	*	@return send mail
	*/
	public function ajax_send_invite(){
		$invite_id = $this->input->post('invite_id');
		$email_status = $this->invitemail_layout($invite_id);
		if($email_status){
			redirect($this->uri->segment(1)."/hr/users/invitation_success");
		}else{
			echo json_encode(array("status"=>"error"));
			return false;
		}
	}
	
	/**
	*	INVITATION SUCCESS RESPONSE STATUS
	*/
	public function invitation_success(){
		echo json_encode(array("send_mail"=>"2"));
	}
	
	/**
	*	SENDING EMAIL THROugh HERE 
	*	@param int $account_id
	*	@return boolean
	*/
	public function invitemail_layout($account_id){
		#$account_id = $this->input->post('account_id');
		$invitations = $this->users->send_invitation($this->company_info->company_id,$account_id);
	
		if($invitations){
			$name = $invitations->first_name." ".$invitations->last_name;
			$data = array(
				"title"				=> "Invitations",
				"page_content" 		=> "Invitations",
				"token"				=> $invitations->token,
				"page_title"		=> $invitations->email,
				"full_name"		=> ucfirst($name),
				"admin"				=> "Konsumpayroll"
			);
			$content = $this->parser->parse("email_test_view",$data);
			$this->email->clear();
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = 'html';
			$config['charset'] = 'utf-8';
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from('christopher.cuizon@techgrowthglobal.com', 'Konsum Payroll Account Recovery');
			$this->email->to($invitations->email);
			$this->email->cc('christopher.cuizon@techgrowthglobal.com');
			$this->email->subject('Email Test teste333333');
			$this->email->message($content);
			$email_check = $this->email->send();	
			return true;
		}else{
			return false;
		}	
	}
	
	
	public function search_name(){
		$name = $this->input->post("name");
		$query = $this->db->query("SELECT name FROM approval_process WHERE company_id = '{$this->db->escape_tr($comp_id)}'");
		$result = $query->result();
		$query->free_result();
		$data = array();
		if($result){
			foreach($result as $key):
			$data[] =array("name"=>$key->name);
			endforeach;
		}
		echo json_encode($data); 
	}

	
	public function check_users(){
		if($this->input->is_ajax_request()){
			$account_id = $this->input->post("account_id");
			if($account_id){
				$account = $this->profile->get_account($account_id,"employee");
				echo json_encode($account);
			}else{
				echo json_encode(array("error"=>"true"));
			}
		}else{
			show_404();
		}
	}
	
	/**
	 * UPDATE USERS
	 * @returns submissions
	 */
	public function update_users(){
		if($this->input->is_ajax_request()){
			if($this->input->post("update")){
				$this->form_validation->set_rules("jaccount_id","AccountID","required|trim|xss_clean");
				$this->form_validation->set_rules("jemail_address","Email Address","required|trim|xss_clean|callback_update_email_check");
				$this->form_validation->set_rules("old_jemail_address","Email Address","required|trim|xss_clean");
				$this->form_validation->set_rules("jfname","First Name","required|trim|xss_clean");
				$this->form_validation->set_rules("jmname","Middle Name","required|trim|xss_clean");
				$this->form_validation->set_rules("jlname","Last Name","required|trim|xss_clean");
				$this->form_validation->set_rules("jpermisssion","Payroll Group","trim|xss_clean");
				if($this->form_validation->run() == true){	
					$where = array("account_id"=>$this->db->escape_str($this->input->post('jaccount_id')));
					// EMPLOYEE UPDATES
					$fields_employee = array(
						"first_name"		=>$this->db->escape_str($this->input->post('jfname')),
						"middle_name"	=>$this->db->escape_str($this->input->post('jmname')),
						"last_name"		=>$this->db->escape_str($this->input->post('jlname'))
					);
					$this->users->update_fields("employee",$fields_employee,$where);
					// ACCOUNT UPDATEs
					$fields_account = array(
						"email"			=>$this->db->escape_str($this->input->post('jemail_address'))
					);
					$this->users->update_fields("accounts",$fields_account,$where);
					// COMPANY APPROVERS
					$fields_company_approvers = array(
						"users_roles_id" => $this->db->escape_str($this->input->post('jpermisssion'))
					);
					$this->users->update_fields("company_approvers",$fields_company_approvers,$where);
					// RETURN JSON 
					echo json_encode(array("success"=>"1","error"=>""));
					return false;
				}else{
					echo json_encode(array("success"=>"0","error"=>validation_errors('<span class="error_zone">',"</span>")));
					return false;
				}
			}
		}else{
			show_error('Captured IP ADDRESS :'.$this->input->ip_address().' Investigating...');
		}
	}
	
	// CALLBACK
	public function update_email_check(){
		$old_email = $this->db->escape_str($this->input->post('old_jemail_address'));
		$email = $this->db->escape_str($this->input->post('jemail_address'));
		if($old_email){
			$query = $this->db->query("SELECT * FROM accounts WHERE email ='{$email}' AND email NOT IN('{$old_email}')");
			$row = $query->row();
			$query->free_result();
			if($row){
				$this->form_validation->set_message("update_email_check","Email is already exist");
				return false;
			}else{
				return true;
			}
		}else{
			$query2 = $this->db->get_where("accounts",array("email"=>$email));
			$row2= $query2->row();
			$query2->free_result();
			if($row2){
				$this->form_validation->set_message("update_email_check","Email is already exist");
				return false;
			}else{
				return true;
			}
		}
	}
	// END CALLBACK
	
	/**
	 * ADDS PERMISSIONS 
	 * add permissions to the susers
	 */
	public function permissions(){
		$data['page_title'] = "Roles";	
		if($this->input->is_ajax_request()){
			if($this->input->post('submit')){
				$this->form_validation->set_rules('user_roles_type','Account type','required|trim|xss_clean');
				$this->form_validation->set_rules('roles','Role','required|trim|xss_clean|callback_roles_check');
				$this->form_validation->set_rules('hidden_roles[]','Assign Right','required|trim|xss_clean');
				if($this->form_validation->run() == true){
					if( $this->db->escape_str($this->input->post('user_roles_type')) == 1){
						$roles_assign =$this->input->post('hidden_roles');
						$fields = array(
							"company_id"	=> $this->company_info->company_id,
							"roles"			=> $this->db->escape_str($this->input->post('roles')),
							"users_account_type" => $this->db->escape_str($this->input->post('user_roles_type'))
						);
						if($roles_assign){
							foreach($roles_assign as $key=>$val):
								$fields[$val] = 1; 
							endforeach;
						}
						$this->users->save_fields("user_roles",$fields);
						$this->session->set_flashdata("permission_stats","Permissions had been saved!");
						echo json_encode(array("success"=>"1","error"=>""));	
						return false;	
					}else{
						echo json_encode(array("success"=>"0","error"=>""));	
						return false;
					}
				}else{
					echo json_encode(array("success"=>"0","error"=>validation_errors('<span class="error_zone">',"</span>")));
					return false;
				}
			}
		}
		$data['sidebar_menu'] =$this->sidebar_menu;	
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/hr/roles_view', $data);
	}
	
	public function permissions_list(){
		$data['page_title'] = "Edit Users roles";	
		$url  = $this->uri->segment(1)."/hr/users/permissions_list"; # url check
		$page = is_numeric($this->uri->segment(5)) ? $this->uri->segment(5) : 1;
		$data['total_rows'] = $this->users->count_user_roles_list($this->company_info->company_id,"administrator");
		init_pagination($url,$data['total_rows'],$this->per_page,$this->segment);
		$data['pagi'] = $this->pagination->create_links();
		$data['admin_users_list'] = $this->users->user_roles_list($this->company_info->company_id,"administrator",$this->per_page,(($page-1) * $this->per_page));
		$data['sidebar_menu'] =$this->sidebar_menu;	
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/hr/roles_list_view', $data);	
	}
	
	public function permissions_edit(){
		$data['page_title'] = "Edit Users roles";	
		$url  = $this->uri->segment(1)."/hr/users/permissions_list"; # url check
		$page = is_numeric($this->uri->segment(5)) ? $this->uri->segment(5) : 1;
		$data['total_rows'] = $this->users->count_user_roles_list($this->company_info->company_id,"administrator");
		init_pagination($url,$data['total_rows'],$this->per_page,$this->segment);
		$data['pagi'] = $this->pagination->create_links();
		$data['admin_users_list'] = $this->users->user_roles_list($this->company_info->company_id,"administrator",$this->per_page,(($page-1) * $this->per_page));
		$data['sidebar_menu'] =$this->sidebar_menu;	
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/hr/roles_list_view', $data);	
	}
	

	// CALLBACK permissions
	/**
	 * Roles check callback is already been used
	 * @param string $str
	 * @return calbacks
	 */
	public function roles_check($str){
		$query = $this->db->query("SELECT * FROM user_roles WHERE company_id = {$this->company_info->company_id} AND roles='{$str}'");
		$row = $query->row();
		if($row){
			$this->form_validation->set_message('roles_check','%s name is already exist');
			return false;
		}else{
			return true;
		}
	}
	// END CALL BACK Permissions

}

/* End of file users.php */
/* Location: ./application/controllers/hr/users.php */