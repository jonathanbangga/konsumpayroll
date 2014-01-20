<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Approvers Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Approve_timeins extends CI_Controller {
		
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
		var $per_page;
		var $segment;
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->load->model("hr/approve_timeins_model","timeins");
			$this->theme = $this->config->item('default');
			$this->menu = "content_holders/user_hr_owner_menu";
			$this->sidebar_menu = "content_holders/hr_approver_sidebar_menu";
			$this->company_info = whose_company();
			$this->subdomain = $this->uri->segment(1);
			$this->per_page = 2;
			$this->segment = 5;
			if(count($this->company_info) == 0){
				show_error("Invalid subdomain");
				return false;
			}
			$this->uri_first = $this->uri->segment(1);
		}
		
		public function index(){
			redirect("{$this->uri_first}/hr/approve_timeins/lists");
		}
		
		public function lists(){
			$uri = "/".$this->uri->segment(1)."/hr/approve_timeins/lists/";
			$page = is_numeric($this->uri->segment(5)) ? $this->uri->segment(5) : 1;
			$total_rows = $this->timeins->timeins_application_count($this->company_info->company_id);	
			init_pagination($uri,$total_rows,$this->per_page,$this->segment);
			$data['pagi'] = $this->pagination->create_links();		
			$data['page_title'] = "TimeIns Application"; 
			$data['sidebar_menu'] =$this->sidebar_menu;	
			$data['success']	= $this->session->flashdata("success");
			$data['application'] = $this->timeins->timeins_list($this->company_info->company_id,$this->per_page,(($page-1) * $this->per_page));
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/approve_timeins_view', $data);
		}
		
		/**
		 * LIST NAMES SORT 
		 */
		public function lists_names(){
			$uri = "/".$this->uri->segment(1)."/hr/approve_timeins/lists_names/".$this->uri->segment(5);
			$page = is_numeric($this->uri->segment(6)) ? $this->uri->segment(6) : 1;
			$total_rows = $this->timeins->timeins_application_count_name($this->company_info->company_id,$this->uri->segment(5));
			init_pagination($uri,$total_rows,$this->per_page,6);
			$data['pagi'] = $this->pagination->create_links();
			$data['page_title'] = "TimeIns Application"; 
			$data['sidebar_menu'] =$this->sidebar_menu;	
			$data['success']	= $this->session->flashdata("success");
			$data['application'] = $this->timeins->timeins_list_by_name($this->company_info->company_id,$this->per_page,(($page-1) * $this->per_page),$this->uri->segment(5));
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/approve_timeins_view', $data);
		}
		
		/**
		 * LIST APPLICATION VIA DATES
		 * @return views
		 */
		public function lists_dates(){
			$uri = "/".$this->uri->segment(1)."/hr/approve_timeins/lists_dates/".$this->uri->segment(5)."/".$this->uri->segment(6);
			$page = is_numeric($this->uri->segment(7)) ? $this->uri->segment(7) : 1;
			$total_rows = $this->timeins->timeins_application_count_date($this->company_info->company_id,$this->uri->segment(5),$this->uri->segment(6));
			init_pagination($uri,$total_rows,$this->per_page,7);
			$data['pagi'] = $this->pagination->create_links();
			$data['page_title'] = "TimeIns Application"; 
			$data['sidebar_menu'] =$this->sidebar_menu;	
			$data['success']	= $this->session->flashdata("success");
			$data['application'] = $this->timeins->timeins_list_by_date($this->company_info->company_id,$this->per_page,(($page-1) * $this->per_page),$this->uri->segment(5),$this->uri->segment(6));	
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/approve_timeins_view', $data);
		}
		
		/**
		 * APPROVES EXPENSES DENIED BECAUSE WE CAN
		 */
		public function approve(){
			if($this->input->is_ajax_request()){
				if($this->input->post("submit")){
					$timesheets_id = $this->input->post('employee_time_in_id');
					$this->form_validation->set_rules("employee_time_in_id[]","Expense","trim|xss_clean");
					if($this->form_validation->run() == true){	
						foreach($timesheets_id as $key=>$val):
							$fields = array(
								"time_in_status" 	=> "approved",
								"corrected"			=> "Yes"
							);
							$where = array(
								"employee_time_in_id"=>$val,
								"comp_id"=>$this->company_info->company_id
							);
							$this->timeins->update_field("employee_time_in",$fields,$where);
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
					$timesheets_id = $this->input->post('employee_time_in_id');
					$this->form_validation->set_rules("employee_time_in_id[]","Expense","trim|xss_clean");
					if($this->form_validation->run() == true){	
						foreach($timesheets_id as $key=>$val):
							$fields = array(
								"time_in_status" => "reject"
							);
							$where = array(
								"employee_time_in_id"=>$val,
								"comp_id"=>$this->company_info->company_id
							);
							$this->timeins->update_field("employee_time_in",$fields,$where);		
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
		
		public function ajax_add_notes(){
			if($this->input->is_ajax_request()){
				$eti = $this->input->post('employee_time_in_id');
				
				$this->form_validation->set_rules('employee_time_in_id','ID','required|trim|xss_clean|is_numeric');
				$this->form_validation->set_rules('note','note','trim|xss_clean');
				if($this->form_validation->run() == true){
				
						$fields = array(
							"notes" => $this->db->escape_str($this->input->post('note'))
						);
						$where = array(
							"employee_time_in_id"=>$eti,
							"comp_id"=>$this->company_info->company_id
						);
						$this->timeins->update_field("employee_time_in",$fields,$where);		
					
					echo json_encode(array("success"=>"1","error"=>""));		
					return false;
				}else{
					echo json_encode(array("success"=>"0","error"=>validation_errors("<span class='errors_zone'>","</span>")));	
					return false;
				}
			}else{
				echo 'test';
			}
		}
	
	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company_approvers.php */