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
		
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->theme = $this->config->item('default');		
			$this->menu = 'content_holders/company_menu';	
			$this->sidebar_menu = 'content_holders/company_sidebar_menu';
			$this->load->model("company/cost_center_model","cost_center");
		}
		
		
		public function edit(){
			$valid_domain = $this->uri->segment(4);
			if(mod_is_mycompany(0,$valid_domain) == false){
				redirect("company/dashboard");
				return false;
			}		
			$data['cost_center_list'] = $this->cost_center->get_cost_center($valid_domain);
			$data['error'] = "";
			if($this->input->is_ajax_request()){
				if($this->input->post('submit')) {
					$this->form_validation->set_rules("cost_center_code","Cost Center Code","required|trim|xss_clean");
					$this->form_validation->set_rules("add_desc","Description","required|trim|xss_clean");				
					if($this->form_validation->run() == false) {
						 $data['error'] = validation_errors("<span class='error_zone'>",'</span>');
						 echo json_encode(array("success"=>"0","error"=>$data['error']));
						 return false;
					} else {	
						$account_fields = array(
										"cost_center_code" 	=> $this->db->escape_str($this->input->post('payroll_cloud_id')),
										"description"		=> $this->db->escape_str($this->input->post('add_desc')),
										"status"			=> 'Active',
										"deleted" 	=> '0'
									);	
						$account_id = $this->cost_center->save_fields("cost_center",$account_fields);
						
					}
				}	
			}
			$data['sidebar_menu'] = $this->sidebar_menu;
			$data['page_title'] = "Cost Center";		
			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/company/cost_center_view', $data);				
		}

		
		public function add_cost_center(){
		
		}
		
	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company/company_approvers.php */