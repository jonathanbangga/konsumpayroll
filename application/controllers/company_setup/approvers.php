<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Approvers Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Approvers extends CI_Controller {
		
		/**
		 * Theme options - default theme
		 * @var string
		 */
		var $theme;
		var $menu;
		var $sidebar_menu;
		
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->theme = $this->config->item('default');		
			$this->menu = 'content_holders/company_menu';	
			$this->sidebar_menu = 'content_holders/company_sidebar_menu';
			$this->load->model("company/approvers_model","approvers");
		}
		
		
		public function edit(){
			$valid_domain = $this->uri->segment(4);
			if(mod_is_mycompany(0,$valid_domain) == false){
				redirect("company/dashboard");
				return false;
			}	
			$data['page_title'] = "Company Approvers";			
			$data['sidebar_menu'] = $this->sidebar_menu;
			$data['error']	= "";
			$data['category'] = array("regular","non-regular","household","probie");
			$data['approvers_list'] = $this->approvers->fetch_approvers_users($valid_domain);	
				if($this->input->is_ajax_request()){
					if($this->input->post('submit')){
						$this->form_validation->set_rules("lname","Last name","required|trim|xss_clean");
						$this->form_validation->set_rules("fname","First name","required|trim|xss_clean");
						$this->form_validation->set_rules("mname","Middle name","required|trim|xss_clean");
						$this->form_validation->set_rules("position","Position","trim|xss_clean");
						$this->form_validation->set_rules("contact_no","Business phone","trim|xss_clean");
						$this->form_validation->set_rules("email","Email","required|valid_email|trim|is_unique[accounts.email]|xss_clean");
						$this->form_validation->set_rules("username","username","min_length[8]|max_length[36]required|trim|is_unique[accounts.payroll_cloud_id]|xss_clean");
						if($this->form_validation->run() == false){
							$data['error'] = array("success"=>"0","error"=>validation_errors("<span class='errors'>","</span>"));
							echo json_encode($data['error']);
							return false;
						}else{
		
							/**=========== for accounts ===========**/
							$account_fields = array(
										"payroll_cloud_id" => $this->db->escape_str($this->input->post('username')),
										"password"		=> md5(idates_now()),
										"email"			=> $this->db->escape_str($this->input->post('email')),
										"account_type_id" => 3
									);	
							$account_id = $this->approvers->save_fields("accounts",$account_fields);
							/**=========== for ranks assign ===========**/
							$rank_fields = array(
										"rank_name"		=> "",
										"company_id"	=> $valid_domain,
										"status"		=> "Active",
										"deleted"		=> "0"
									);
							$rank_id = $this->approvers->save_fields("rank",$rank_fields);
							/**=========== for department assign ===========**/
							$dept_fields = array(
										"company_id"	=> $valid_domain,
										"status"		=> "Active",
										"deleted"		=> "0"
									);
							$dep_id = $this->approvers->save_fields("department",$dept_fields);
							/**=========== for location assign ===========**/
							$location_fields = array(
										"company_id"	=> $valid_domain,
										"status"		=> "Active",
										"deleted"		=> "0"
									);
							$location_id = $this->approvers->save_fields("location",$location_fields);
							/**=========== for employee assign ===========**/
							if($account_id) {
								$fields = array(
									"last_name" 	=> $this->db->escape_str($this->input->post('lname')),
									"first_name" 	=> $this->db->escape_str($this->input->post('fname')),
									"middle_name"	=> $this->db->escape_str($this->input->post('mname')),
									"account_id"	=> $this->db->escape_str($account_id),
									"contact_no"	=> $this->db->escape_str($this->input->post('contact_no')),
									"rank_id"		=> $rank_id,
									"dept_id"		=> $dep_id,
									"location_id"	=> $location_id,
									"company_id"	=> $valid_domain
									);
								$emp_id = $this->approvers->save_fields("employee",$fields);						
							/**=========== for assigning company heads ===========**/
								$assign_company_heads = array(
											"company_id" 	=> $valid_domain,
											"emp_id"		=> $emp_id,
											"user_created"	=> idates_now(),
											"status"		=> "Active",
											"deleted"		=> "0"
										);
								$com_head_id = $this->approvers->save_fields("assign_company_head",$assign_company_heads);

								$data['error'] = array("success"=>"1","error"=>"");
								echo json_encode($data['error']);
								return false;
							}
						} 
					}
				}
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/company/company_approvers_view', $data);				
		}
		
		public function remove_company_approver(){
			if($this->input->is_ajax_request()){
				$this->form_validation->set_rules('account_id',"account","trim|required|xss_clean");
				if($this->form_validation->run() == false){	
					echo json_encode(array("success"=>"false","error"=>validation_errors("<span class='error_zone'>","</span>")));
				}else{
					$account_id = $this->input->post('account_id');
					$this->approvers->remove_assign_company_head($account_id);					
					$check = $this->approvers->remove_approvers($account_id);
					echo json_encode(array("success"=>$check,"error"=>""));
				}
			}else{
				show_404();
			}	
		}

		public function we(){
			$data = array("deleted"=>1,"email"=>"we@yahoo.com");	
			$this->db->update("accounts",$data,array("account_id"=>6));	
			echo $this->db->last_query();		
		}
		
	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company/company_approvers.php */