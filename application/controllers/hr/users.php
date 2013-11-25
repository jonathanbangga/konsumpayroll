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
		$this->sidebar_menu = 'content_holders/company_sidebar_menu';
	}

	public function index(){
		$data['page_title'] = "Manage Users";
		$company_info = whose_company();
		if($company_info == false){
			show_error("Company subdomain is invalid");
			return false;
		}
		$data['sidebar_menu'] =$this->sidebar_menu;	
		$data['approvers_list'] = $this->users->fetch_approvers_users($company_info->company_id);
		// save
		if($this->input->is_ajax_request()){
			if($this->input->post('approver_save')){
				$emp_idfield = $this->input->post('emp_id');
				$emp_first 	= $this->input->post("first_name");
				$emp_middle = $this->input->post("middle_name");
				$emp_last 	= $this->input->post("last_name");
				$emp_level	= $this->input->post('level');
				if($emp_idfield){
					foreach($emp_idfield as $k=>$v){
						$this->form_validation->set_rules("emp_id[".$k."]","Employee number (".$k."):","required|trim|numeric|xss_clean|min_length[8]|max_length[30]|is_unique[accounts.payroll_cloud_id]");
						$this->form_validation->set_rules("first_name[".$k."]","Employee First Name (".$k."):","required|trim|xss_clean");
						$this->form_validation->set_rules("middle_name[".$k."]","Employee Middle Name (".$k."):","required|trim|xss_clean");
						$this->form_validation->set_rules("last_name[".$k."]","Employee Last Name (".$k."):","required|trim|xss_clean");
						$this->form_validation->set_rules("level[".$k."]","Employee level (".$k."):","required|trim|xss_clean|numeric");
					}		
				}		
				if($this->form_validation->run() == TRUE){	
					foreach($emp_idfield as $key=>$val):
						$emp_id = $val;
						// CREATE ACCOUNTS
						$account_fields = array(
									"payroll_cloud_id" 	=> $this->db->escape_str($emp_id),
									"password"			=> md5(idates_now()),
									"account_type_id"	=> 2, // 2 which is users only
									"user_type_id"		=> 3  // 3 Defines as HR on user_type table
						);	
						$account_id = $this->approvers->save_fields("accounts",$account_fields);
						// CREATE EMPLOYEE
						$fields = array(
							"last_name" 	=> $this->db->escape_str($emp_last[$key]),
							"first_name" 	=> $this->db->escape_str($emp_first[$key]),
							"middle_name"	=> $this->db->escape_str($emp_middle[$key]),
							"account_id"	=> $this->db->escape_str($account_id),
							"company_id"	=> $valid_domain
						);
						$emp_id = $this->approvers->save_fields("employee",$fields);
						// CREATE COMPANY APPROVERS
						$approvers_fields = array(
							"company_id"	=> $valid_domain,
							"account_id"	=> $account_id,
							"level"			=> $this->db->escape_str($emp_level[$key]),
							"deleted"		=> '0'
						);
						$this->approvers->save_fields("company_approvers",$approvers_fields);	
					endforeach;
					echo json_encode(array("success"=>"1","error"=>''));
					return false;
				}else{
					$data['error'] = validation_errors("<span class='errors'>","</span>");
					echo json_encode(array("success"=>"0","error"=>$data['error']));
					return false;
				}
			}
		}
		// save section
		
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/hr/users_view', $data);
	}
	
	public function we(){
	p($this->session->all_userdata());
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */