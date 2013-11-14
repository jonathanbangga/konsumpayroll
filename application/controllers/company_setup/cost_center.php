<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Principal Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Cost_center extends CI_Controller {
		
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
			$this->load->model("company/cost_center_model","cost_center");
			$this->company_id = $this->session->userdata("company_id");
		}
		
		
		public function index(){
			if($this->company_id == ""){
				redirect("/company/company_setup/company_information/");
				return false;
			}			
			$data['cost_center_list'] = $this->cost_center->get_cost_center($this->company_id);
			$data['error'] = "";
			if($this->input->is_ajax_request()){
				if($this->input->post('submit')) {
					$cost_center_code = $this->input->post('cost_center_code');
					$cost_center_description = $this->input->post('cost_center_description');	
					if($cost_center_code){
						// CREATES A FORM VALIDATION FOR ARRAY PURPOSES
						foreach($cost_center_code as $key=>$val):	
							$inc_key = $key+1;
							$this->form_validation->set_rules("cost_center_code[{$key}]","Cost Center Codes : ({$inc_key})","required|trim|xss_clean|is_unique[cost_center.cost_center_code]");
							$this->form_validation->set_rules("cost_center_description[{$key}]","Description : ({$inc_key})","required|trim|xss_clean");
						endforeach;
		
						if($this->form_validation->run() == false) {
							 $data['error'] = validation_errors("<span class='error_zone'>",'</span>');
							 echo json_encode(array("success"=>"0","error"=>$data['error']));
							 return false;
						} else {	
							foreach($cost_center_code as $key=>$val):
								$account_fields = array(
												"cost_center_code" 	=> $this->db->escape_str($val),
												"description"		=> $this->db->escape_str($cost_center_description[$key]),
												"company_id"		=> $this->company_id,
												"status"			=> 'Active',
												"deleted" 			=> '0',
												"date_created"		=> idates_now()
											);	
								$account_id = $this->cost_center->save_fields("cost_center",$account_fields);		
							endforeach;
							echo json_encode(array("success"=>"1","error"=>''));
							return false;
						}
					}
				}	
			}
			$data['sidebar_menu'] = $this->sidebar_menu;
			$data['page_title'] = "Cost Center";		
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/company_setup/cost_center_view', $data);				
		}

		
		/**
		 * DELETES COST CENTER WITH THE RIGHT COMPANY ID AND COST CENTER ONLY
		 */
		public function delete_cost_center(){
			if($this->input->is_ajax_request()){
				if($this->input->post("delete")){
					$this->form_validation->set_rules("cost_center_id","ID","required|trim|xss_clean");
					$this->form_validation->set_rules("company_id","company_id","required|trim|xss_clean");
					if($this->form_validation->run() == false) {
						 $data['error'] = validation_errors("<span class='error_zone'>",'</span>');
						 echo json_encode(array("success"=>"0","error"=>$data['error']));
						 return false;
					} else {	
						$account_fields = array(
										"status"	=> 'InActive',
										"deleted" 	=> '1'
						);	
						$where = array("cost_center_id"	=> $this->db->escape_Str($this->input->post("cost_center_id")));
						$this->cost_center->update_fields("cost_center",$account_fields,$where);
						echo json_encode(array("success"=>"1","error"=>''));
						return true;
					}
				}
			}
		}
		
		public function fetch_cost_center(){
			if($this->input->is_ajax_request()){
				$company_id = $this->input->post("company_id");
				$cost_center_id = $this->input->post("cost_center_id");
				$fetch = $this->cost_center->row_cost_center($company_id,$cost_center_id);
				$this->form_validation->set_rules("company_id","Company ID","required|xss_clean");
				$this->form_validation->set_rules("cost_center_id","Cost Center ID","required|xss_clean");
				if($this->form_validation->run() == true){
					if($fetch){
						echo json_encode(array("success"=>"1","error"=>'',"cost_centers"=>$fetch));
						return false;
					}
				}else{
					$data['error'] = validation_errors("<span class='error_zone'>",'</span>');
					echo json_encode(array("success"=>"0","error"=>$data['error'],"cost_centers"=>""));
					return false;
				}
			}else{
				show_404();
			}
		}
		
		/**
		 * UPDATE COST CENTERS for COMPANY ONLY 
		 */
		public function update_cost_center(){
			if($this->input->is_ajax_request()){
				if($this->input->post("update")){
					$this->form_validation->set_rules("company_id","Company ID","required|xss_clean");
					$this->form_validation->set_rules("cost_center_id","Cost Center ID","required|xss_clean");
					$this->form_validation->set_rules("old_edit_cost_center_code","Old Cost Center ID","required|xss_clean");
					$this->form_validation->set_rules("cost_center_code","Cost Center Code","required|xss_clean|callback_check_old_cost_code");
					$this->form_validation->set_rules("description","Description","required|xss_clean");
					if($this->form_validation->run() == true){
						$account_fields = array(
								"cost_center_code" 	=> $this->db->escape_str($this->input->post('cost_center_code')),
								"description" 		=> $this->input->post('description')
						);	
						$where = array(
								"cost_center_id"	=> $this->db->escape_str($this->input->post("cost_center_id")),
								"company_id"		=> $this->db->escape_str($this->input->post('company_id'))
						);
						$this->cost_center->update_fields("cost_center",$account_fields,$where);
						echo json_encode(array("success"=>"1","error"=>''));
						return false;
					}else{
						$data['error'] = validation_errors("<span class='error_zone'>",'</span>');
						echo json_encode(array("success"=>"0","error"=>$data['error']));
						return false;
					}
				}
			}else{
				show_404();
			}
		}
		
		/** CALL BACK ON UPDATE COST CENTER CODE **/
		
		/**
		 * Checks update check cost 
		 * Enter description here ...
		 * @param unknown_type $str
		 * @return boolean
		 */
		public function check_old_cost_code($str){
			$old_edit_id_cost_center = $this->input->post('old_edit_cost_center_code');
			$row = $this->cost_center->cost_code_update_valid($str,$old_edit_id_cost_center);
			if($row){
				$this->form_validation->set_message("check_old_cost_code","Cost Center ID field must contain a unique value.");
				return false;
			}else{
				return true;
			}
		}
		/** END CALLBACK ON UPDATE COST CENTER **/
	
	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company/company_approvers.php */