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
			//if($this->input->is_ajax_request()){
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
		//	}
			$data['sidebar_menu'] = $this->sidebar_menu;
			$data['page_title'] = "Cost Center";		
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/company_setup/cost_center_view', $data);				
		}

		
		public function add_cost_center(){
			if($this->input->post("add")){
				$this->form_validation->set_rules("cost_center_code","Cost Center Code","required|trim|xss_clean");
				$this->form_validation->set_rules("add_desc","Description","required|trim|xss_clean");				
				if($this->form_validation->run() == false) {
					 $data['error'] = validation_errors("<span class='error_zone'>",'</span>');
					 echo json_encode(array("success"=>"0","error"=>$data['error']));
					 return false;
				} else {	
					$account_fields = array(
									"cost_center_code" 	=> $this->db->escape_str($this->input->post('cost_center_code')),
									"description"		=> $this->db->escape_str($this->input->post('add_desc')),
									"status"			=> 'Active',
									"deleted" 	=> '0'
								);	
					$account_id = $this->cost_center->save_fields("cost_center",$account_fields);
					
				}
			}
		}
		
	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company/company_approvers.php */