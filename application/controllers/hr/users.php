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
	
	public function __construct() {
		parent::__construct();
		$this->theme = $this->config->item('default');
		$this->load->model("hr/users_model","users");
		$this->num_pagi = 3;
		$this->segment_url = 4;
		$this->authentication->check_if_logged_in();	
		$this->menu = 'content_holders/company_menu';
		$this->sidebar_menu = 'content_holders/hr_approver_sidebar_menu';
	}

	public function index(){
		$data['page_title'] = "Manage Users";
		$company_info = whose_company();
		if($company_info == false){
			show_error("Company subdomain is invalid");
			return false;
		}
		$data['sidebar_menu'] =$this->sidebar_menu;	
		init_pagination("/{$this->uri->segment(1)}/hr/users/index",10,1,5);
		$data['pagi'] = $this->pagination->create_links();
		
		$data['company_info'] = $company_info;
		$data['approval_group'] = $this->users->fetch_approval_group($company_info->company_id);
		$data['approval_process'] = $this->users->approval_process($company_info->company_id);
		$data['approvers_list'] = $this->users->fetch_approvers_users($company_info->company_id);
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
						$this->form_validation->set_rules("password[".$k."]","Employee password (".$k."):","required|trim|xss_clean");
						$this->form_validation->set_rules("approval_process_id[".$k."]","Employee Payroll group (".$k."):","required|trim|xss_clean");
						$this->form_validation->set_rules("permission[".$k."]","Permission (".$k."):","trim|xss_clean");
					}		
				}		
				if($this->form_validation->run() == TRUE){	
					foreach($payroll_cloud_id as $key=>$val){
						$account_fields = array(
									"payroll_cloud_id" 	=> $this->db->escape_str($val),
									"password"			=> md5($password[$key]),
									"account_type_id"	=> 2, // 2 which is users only
									"user_type_id"		=> 3,  // 3 Defines as HR on user_type table
									"email"				=> $emp_email[$key]
						);	
						$account_id = $this->users->save_fields("accounts",$account_fields);
						// CREATE EMPLOYEE
						$fields = array(
							"last_name" 	=> $this->db->escape_str($emp_last[$key]),
							"first_name" 	=> $this->db->escape_str($emp_first[$key]),
							"middle_name"	=> $this->db->escape_str($emp_middle[$key]),
							"account_id"	=> $this->db->escape_str($account_id),
							"company_id"	=> $company_info->company_id
						);
						$emp_id = $this->users->save_fields("employee",$fields);
						// CREATE COMPANY APPROVERS
						$approvers_fields = array(
							"company_id"	=> $company_info->company_id,
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
									"company_id"	=> $company_info->company_id
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
	
	public function we(){
		p($this->session->all_userdata());
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */