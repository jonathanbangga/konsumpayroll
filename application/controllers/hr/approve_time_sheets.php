<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Approvers Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Approve_time_sheets extends CI_Controller {
		
		/**
		 * Theme options - default theme
		 * @var string
		 */
		var $theme;
		var $menu;
		var $sidebar_menu;
		var $company_info;
		var $subdomain;
		var $per_page;
		var $segment;
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->authentication->check_if_logged_in();
			$this->load->model("hr/approve_timesheets_model","timesheets");
			$this->theme = $this->config->item('default');
			$this->menu = "content_holders/user_hr_owner_menu";
			$this->sidebar_menu = "content_holders/hr_approver_sidebar_menu";
			$this->company_info = whose_company();
			$this->subdomain = $this->uri->segment(1);
			$this->per_page = 10;
			$this->segment = 5;
			if(count($this->company_info) == 0){
				show_error("Invalid subdomain");
				return false;
			}
		}
		
		public function index(){
			redirect("{$this->uri->segment(1)}/hr/approve_leave/lists");
		}
		
		public function lists(){
			$uri = "/".$this->uri->segment(1)."/hr/approve_time_sheets/lists/";
			$page = is_numeric($this->uri->segment(5)) ? $this->uri->segment(5) : 1;
			$total_rows = $this->timesheets->timesheets_application_count($this->company_info->company_id);
			init_pagination($uri,$total_rows,$this->per_page,$this->segment);
			$data['pagi'] = $this->pagination->create_links();
			$data['page_title'] = "Timesheets Application"; 
			$data['sidebar_menu'] =$this->sidebar_menu;	
			$data['success'] = $this->session->flashdata("success");
			$data['application'] = $this->timesheets->timesheets_list($this->company_info->company_id,$this->per_page,(($page-1) * $this->per_page));
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/approve_time_sheets_view', $data);
		}
		
		/**
		 * LIST VIA DATES
		 * CHECKS VIA DATES AND PASS THE DATA TO
		 */
		public function lists_dates(){
			$uri = "/".$this->uri->segment(1)."/hr/approve_time_sheets/lists_dates/".$this->uri->segment(5)."/".$this->uri->segment(6);
			$page = is_numeric($this->uri->segment(7)) ? $this->uri->segment(7) : 1;
			$total_rows = $this->timesheets->timesheets_application_count_dates($this->company_info->company_id,$this->uri->segment(5),$this->uri->segment(6));
			init_pagination($uri,$total_rows,$this->per_page,7);
			$data['pagi'] = $this->pagination->create_links();
			$data['page_title'] = "Timesheets Application"; 
			$data['sidebar_menu'] =$this->sidebar_menu;	
			$data['success'] = $this->session->flashdata("success");
			$data['application'] = $this->timesheets->timesheets_list_by_date($this->company_info->company_id,$this->per_page,(($page-1) * $this->per_page),$this->uri->segment(5),$this->uri->segment(6));
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/approve_time_sheets_view', $data);
		}
		
		/**
		 * LIST VIA NAMES
		 * CHECKS TIMESHEETS LIST NAMES
		 */
		public function lists_names(){
			$uri = "/".$this->uri->segment(1)."/hr/approve_time_sheets/lists_names/".$this->uri->segment(5);
			$page = is_numeric($this->uri->segment(6)) ? $this->uri->segment(6) : 1;
			$total_rows = $this->timesheets->timesheets_application_count_names($this->company_info->company_id,$this->uri->segment(5));
			init_pagination($uri,$total_rows,$this->per_page,6);
			$data['pagi'] = $this->pagination->create_links();
			$data['page_title'] = "Timesheets Application"; 
			$data['sidebar_menu'] =$this->sidebar_menu;	
			$data['success'] = $this->session->flashdata("success");
			$data['application'] = $this->timesheets->timesheets_list_by_name($this->company_info->company_id,$this->per_page,(($page-1) * $this->per_page),$this->uri->segment(5));
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/approve_time_sheets_view', $data);
		}
		
		public function approve(){
			if($this->input->is_ajax_request()){
				if($this->input->post("submit")){
					$timesheets_id = $this->input->post('timesheets_id');
					$this->form_validation->set_rules("timesheets_id[]","Timesheet","required|trim|xss_clean");
					if($this->form_validation->run() == true){	
						foreach($timesheets_id as $key=>$val):
							$fields = array(
								"timesheets_status" => "approve"
							);
							$where = array(
								"timesheets_id"=>$val,
								"company_id"=>$this->company_info->company_id
							);
							$this->timesheets->update_field("employee_timesheets",$fields,$where);			
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
		
		public function reject(){
			if($this->input->is_ajax_request()){
				if($this->input->post("submit")){
					$timesheets_id = $this->input->post('timesheets_id');
					$this->form_validation->set_rules("timesheets_id[]","Timesheet","required|trim|xss_clean");
					if($this->form_validation->run() == true){	
						foreach($timesheets_id as $key=>$val):
							$fields = array(
								"timesheets_status" => "reject"
							);
							$where = array(
								"timesheets_id"=>$val,
								"company_id"=>$this->company_info->company_id
							);
							$this->timesheets->update_field("employee_timesheets",$fields,$where);			
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
				$timesheets_id = $this->input->post('timesheets_id');
				$this->form_validation->set_rules('timesheets_id','ID','required|trim|xss_clean|is_numeric');
				$this->form_validation->set_rules('note','note','trim|xss_clean');
				if($this->form_validation->run() == true){
					$fields = array("note" => $this->db->escape_str($this->input->post('note')));
					$where = array("timesheets_id"=>$timesheets_id,"company_id"=>$this->company_info->company_id);
					$this->timesheets->update_field("employee_timesheets",$fields,$where);	
					echo json_encode(array("success"=>"1","error"=>""));		
					return false;
				}else{
					echo json_encode(array("success"=>"0","error"=>validation_errors("<span class='errors_zone'>","</span>")));	
					return false;
				}
			}else{
				show_404();
			}
		}
	
	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company_approvers.php */