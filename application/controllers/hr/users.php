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
		$this->theme = $this->config->item('default');
		$this->load->model("hr/users_model","users");
		$this->num_pagi = 3;
		$this->segment_url = 4;
		$this->authentication->check_if_logged_in();	
		$this->menu = "content_holders/user_hr_owner_menu";
		$this->sidebar_menu = 'content_holders/hr_approver_sidebar_menu';
		$this->company_info =  whose_company();
		$this->per_page = 5;
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
						$this->form_validation->set_rules("approval_process_id[".$k."]","Employee Payroll group (".$k."):","required|trim|xss_clean");
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
							"deleted"		=> '0'
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
		$this->layout->view('pages/hr/users_view', $data);
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
				$this->form_validation->set_rules("jpayroll_group","Payroll Group","trim|xss_clean");
				if($this->form_validation->run() == true){	
					$where = array("account_id"=>$this->db->escape_str($this->input->post('jaccount_id')));
					// EMPLOYEE UPDATES
					$fields_employee = array(
						"first_name"	=>$this->db->escape_str($this->input->post('jfname')),
						"middle_name"	=>$this->db->escape_str($this->input->post('jmname')),
						"last_name"		=>$this->db->escape_str($this->input->post('jlname'))
					);
					$this->users->update_fields("employee",$fields_employee,$where);
					// ACCOUNT UPDATEs
					$fields_account = array(
						"email"			=>$this->db->escape_str($this->input->post('jemail_address'))
					);
					$this->users->update_fields("accounts",$fields_account,$where);
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
	
}

/* End of file users.php */
/* Location: ./application/controllers/hr/users.php */