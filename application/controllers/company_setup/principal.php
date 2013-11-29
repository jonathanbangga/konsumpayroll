<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Principal Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Principal extends CI_Controller {
		
		/**
		 * Theme options - default theme
		 * @var string
		 */
		var $theme;
		var $menu;
		var $sidebar_menu;
		var $company_id;
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->theme = $this->config->item('default');		
			$this->menu = 'content_holders/company_menu';	
			$this->sidebar_menu = 'content_holders/company_sidebar_menu';
			$this->load->model("company/company_principal_model","principal");
			$this->company_id = $this->session->userdata("company_id");
			$this->authentication->check_if_logged_in();	
		}
		
		
		public function index(){
			
			if($this->company_id){
			$data['company_principal'] = $this->principal->fetch_principals($this->company_id);
			$data['error'] = "";
			if($this->input->is_ajax_request()){
				if($this->input->post("approver_save")){
					$emp_id 	= $this->input->post('emp_id');
					$emp_name 	= $this->input->post('emp_name');
					$emp_level	= $this->input->post('emp_level');
					$emp_email 	= $this->input->post('emp_email');
					$emp_bphone = $this->input->post('emp_mobile');
					$emp_mphone = $this->input->post('emp_home');
					
					if($emp_id){
						foreach($emp_id as $validate_key=>$validate_val):
							$emp_id_ctr = $validate_key+1;
							$this->form_validation->set_rules("emp_id[{$validate_key}]","Employee ID ({$emp_id_ctr})","required|xss_clean|trim|is_unique[accounts.payroll_cloud_id]");
							$this->form_validation->set_rules("emp_name[{$validate_key}]","Employee Name ({$emp_id_ctr})","required|xss_clean|trim");
							$this->form_validation->set_rules("emp_level[{$validate_key}]","Level ({$emp_id_ctr})","xss_clean|trim");
							$this->form_validation->set_rules("emp_email[{$validate_key}]","Employee Email ({$emp_id_ctr})","valid_email|is_unique[accounts.email]|required|xss_clean|trim");
							$this->form_validation->set_rules("emp_mobile[{$validate_key}]","Business Phone ({$emp_id_ctr})","xss_clean|trim");
							$this->form_validation->set_rules("emp_home[{$validate_key}]","Business Mobile Phone ({$emp_id_ctr})","xss_clean|trim");
						endforeach;
					}
					if($this->form_validation->run() == true){
						
							foreach($emp_id as $key=>$val):
							/* SAVE SECTION HERE */
								/*-------------				CREATE ACCOUNTS  		--------- */
								$account_fields = array(
									"payroll_cloud_id" 	=> $this->db->escape_str($val),
									"password"			=> md5(idates_now()),
									"email"				=> $this->db->escape_str($emp_email[$key]),
									"account_type_id" 	=> 3
								);	
								$account_id = $this->principal->save_fields("accounts",$account_fields);
								/*-------------				END CREATES ACCOUNT  		--------- */
								/*-------------				CREATES EMPLOYEE	  		--------- */
								$fields = array(
									"first_name" 	=> $this->db->escape_str($emp_name[$key]),
									"account_id"	=> $this->db->escape_str($account_id),
									"mobile_no"		=> $this->db->escape_str($emp_bphone[$key]),
									"company_id"	=> $this->company_id
								);
								$emp_id = $this->principal->save_fields("employee",$fields);
								/*-------------				END CREATES EMPLOYEE  		--------- */
								/*-------------				CREATES COMPANY PRINCIPALS  --------- */
								if($emp_id){
									$principal_field = array(
													"emp_id" 	=> $this->db->escape_str($emp_id),
													"company_id"=> $this->company_id,
													"level"		=> $this->db->escape_str($emp_level[$key]),
													"status"	=> "Active",
													"deleted" 	=> "0"
											);	
									$this->principal->save_fields("company_principal",$principal_field);
								}
								/*-------------				END CREATES COMPANY PRINCIPALS  --------- */	
							/* END SAVE SECTION */
							endforeach;
							echo json_encode(array("success"=>"1","error"=>""));
							return true;	
						
					} else {
						$data['error'] = validation_errors("<span class='error_zone'>",'</span>');
						echo json_encode(array("success"=>"0","error"=>validation_errors("<span class='error_zone'>",'</span>'),"we"=>$this->form_validation));
						return false;
					}	
				}
			}
			
			
			$data['sidebar_menu'] = $this->sidebar_menu;
			$data['page_title'] = "Company Principal";		
			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/company_setup/company_principal_view', $data);	
			}else{
					redirect("/company/company_setup/company_information/");
			}			
		}
		
		public function principal_id(){
			if($this->input->is_ajax_request()){
				$company_id = $this->input->post("company_id");
				$emp_id = $this->input->post("emp_id");
				if($this->input->post("edit")){		
					$this->form_validation->set_rules("company_id","company id","xss_clean|trim|required");
					$this->form_validation->set_rules("emp_id","company id","xss_clean|trim|required");
					if($this->form_validation->run() == false){				
						echo json_encode(array("success"=>"0","errors"=>validation_errors("<span class='error_zone'>",'</span>',"")));
						return false;
					}else{
						$fields = $this->principal->get_principal_emp($company_id,$emp_id);	
						echo json_encode($fields);
						return true;
					}
				}
			}else{
				show_404();
			}
		}
		
		public function update_company_principal(){
			if($this->company_id){
				if($this->input->is_ajax_request()){
					if($this->input->post('update')) {
						$this->form_validation->set_rules("principal_id","Principal","required|trim|xss_clean");
						$this->form_validation->set_rules("lname","Last name","required|trim|xss_clean");
						$this->form_validation->set_rules("fname","First name","required|trim|xss_clean");
						$this->form_validation->set_rules("mname","Middle name","required|trim|xss_clean");
						$this->form_validation->set_rules("position","Position","trim|xss_clean");
						$this->form_validation->set_rules("contact_no","Business phone","trim|xss_clean");
						$this->form_validation->set_rules("old_email","Email","required|valid_email|trim|xss_clean");
						$this->form_validation->set_rules("email","Email","required|valid_email|trim|xss_clean|callback_check_email");
						$this->form_validation->set_rules("company_id","company_id","required|xss_clean");
						$this->form_validation->set_rules("emp_id","Employee id","required|xss_clean");
						$this->form_validation->set_rules("payroll_cloud_id","Payroll Cloud Id","min_length[8]|max_length[36]required|trim|xss_clean|callback_check_payroll_cloud_id");
						$this->form_validation->set_rules("old_payroll_cloud_id","Payroll Cloud Id","min_length[8]|max_length[36]required|trim|xss_clean");	
						if($this->form_validation->run() == false){
							echo json_encode(array("success"=>"0","error"=>validation_errors("<span class='error_zone'>","</span>")));
							return false;
						} else { 
							$emp_id = $this->db->escape_str($this->input->post('emp_id'));
							$emp_where = array("emp_id" =>$emp_id);
							$fields = array(
								"last_name" 	=> $this->db->escape_str($this->input->post('lname')),
								"first_name" 	=> $this->db->escape_str($this->input->post('fname')),
								"middle_name"	=> $this->db->escape_str($this->input->post('mname')),
								"mobile_no"	=> $this->db->escape_str($this->input->post('contact_no'))
							);
							$this->principal->update_fields("employee",$fields,$emp_where);
							$employee = $this->principal->get_employee($emp_id);
							if($employee){
								$account_where = array("account_id"=>$employee->account_id);
								$account_fields = array(
									"payroll_cloud_id" 	=> $this->db->escape_str($this->input->post('payroll_cloud_id')),
									"email"				=> $this->db->escape_str($this->input->post('email'))
								);	
								$this->principal->update_fields("accounts",$account_fields,$account_where);
								echo json_encode(array("success"=>"1","error"=>""));
								return true;
							}	
						}
					}
				}	
			}else{
				return false;
			}
		}
		
		public function people_company_principal(){
			if($this->input->post("delete")){
				$this->form_validation->set_rules("company_principal_id","Company Principal ID","required|xss_clean");
				if($this->form_validation->run() == false){
					echo json_encode(array("success"=>"0","error"=>validation_errors("<span class='error_zone'>","</span>")));
					return false;
				}else{
					$fields = array("deleted"=>"1","status"=>"Inactive");
					$where = array("company_principal_id"=>$this->db->escape_str($this->input->post("company_principal_id")));
					$update_id = $this->principal->update_fields("company_principal",$fields,$where);
					// DELETE EMPLOYEE
					$company_principal = $this->principal->fetch_company_principal($where);
					// GET THE COMPANY PRINCIPAL AND CHECK WHO IS THE USER
					if($company_principal){
						$where_employee = array("emp_id"=>$company_principal->emp_id);
						$this->principal->update_fields("employee",$fields,$where_employee);
					}
					// END DELETE EMPLOYEE
					echo json_encode(array("success"=>"1","error"=>""));
					return false;	
				}
			}
		}
		
		/**
		 * Callbacks checking email on updates
		 * @param string $str
		 * @return error
		 */
		public function check_email($str){
			$check = $this->principal->check_email_exist($this->input->post('old_email'),$str);
			if($check == false){
				return TRUE;
			} else {
				$this->form_validation->set_message('check_email', 'The %s field is already in used');
				return FALSE;
			}
		}

		public function check_payroll_cloud_id($str){
			$check = $this->principal->check_payrol_cloud_id($this->input->post('old_payroll_cloud_id'),$str);
			if($check == false){
				return TRUE;
			} else {
				$this->form_validation->set_message('check_payroll_cloud_id', 'The %s field is already in used');
				return FALSE;
			}
		}
				
	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company/company_approvers.php */