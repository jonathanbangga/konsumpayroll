<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Approvers Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Approve_expenses extends CI_Controller {
		
		/**
		 * Theme options - default theme
		 * @var string
		 */
		var $theme;
		var $menu;
		var $sidebar_menu;
		var $company_info;
		var $uri_first;
		var $subdomain;
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->load->model("hr/approve_expenses_model","expense");
			$this->theme = $this->config->item('default');
			$this->menu = "content_holders/hr_company_sidebar_menu";
			$this->sidebar_menu = "content_holders/hr_approver_sidebar_menu";
			$this->company_info = whose_company();
			$this->subdomain = $this->uri->segment(1);
			if(count($this->company_info) == 0){
				show_error("Invalid subdomain");
				return false;
			}
			$this->uri_first = $this->uri->segment(1);
		}
		
		public function index(){
			redirect("{$this->uri_first}/hr/approve_leave/lists");
		}
		
		public function lists(){
			$data['page_title'] = "Expense Application"; 
			$data['sidebar_menu'] =$this->sidebar_menu;	
			$data['success']	= $this->session->flashdata("success");
			$data['leave_application'] = $this->expense->expense_list($this->company_info->company_id);
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/approve_expenses_view', $data);
		}
		
		/**
		 * APPROVES EXPENSES DENIED BECAUSE WE CAN
		 */
		public function approve(){
			if($this->input->is_ajax_request()){
				if($this->input->post("submit")){
					$timesheets_id = $this->input->post('expense_id');
					$this->form_validation->set_rules("expense_id[]","Expense","required|trim|xss_clean");
					if($this->form_validation->run() == true){	
						foreach($timesheets_id as $key=>$val):
							$fields = array(
								"expense_status" => "approve"
							);
							$where = array(
								"expense_id"=>$val,
								"company_id"=>$this->company_info->company_id
							);
							$this->expense->update_field("expenses",$fields,$where);			
						endforeach;
						$this->session->set_flashdata("success","Success");
						echo json_encode(array("success"=>"1","error"=>""));		
						return true;
					}else{
						echo json_encode(array("success"=>"0","error"=>validation_errors("<span class='errors_zone'>","</span>")));	
						return false;
					}			
				}
			}else{
				show_404();
			}
		}
		
		
		/**
		 * APPROVES EXPENSES DENIED BECAUSE WE CAN
		 */
		public function reject(){
			if($this->input->is_ajax_request()){
				if($this->input->post("submit")){
					$timesheets_id = $this->input->post('expense_id');
					$this->form_validation->set_rules("expense_id[]","Expense","required|trim|xss_clean");
					if($this->form_validation->run() == true){	
						foreach($timesheets_id as $key=>$val):
							$fields = array(
								"expense_status" => "reject"
							);
							$where = array(
								"expense_id"=>$val,
								"company_id"=>$this->company_info->company_id
							);
							$this->expense->update_field("expenses",$fields,$where);			
						endforeach;
						$this->session->set_flashdata("success","Success");
						echo json_encode(array("success"=>"1","error"=>""));		
						return true;
					}else{
						echo json_encode(array("success"=>"0","error"=>validation_errors("<span class='errors_zone'>","</span>")));	
						return false;
					}			
				}
			}else{
				show_404();
			}
		}
		
	
	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company_approvers.php */