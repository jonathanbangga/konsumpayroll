<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Approvers Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Approve_overtime extends CI_Controller {
		
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
			$this->load->model("hr/approve_overtime_model","overtime");
			$this->theme = $this->config->item('default');
			$this->menu = "content_holders/user_hr_owner_menu";
			$this->sidebar_menu = "content_holders/hr_approver_sidebar_menu";
			$this->company_info = whose_company();
			$this->subdomain = $this->uri->segment(1);
			$this->per_page =10;
			$this->segment = 5;
			if(count($this->company_info) == 0){
				show_error("Invalid subdomain");
				return false;
			}
		}
		
		public function index(){
			redirect("{$this->uri->segment(1)}/hr/approve_leave/lists");
		}
		
		/**
		 * FETCJH OVERTIME APPLICATIONS
		 * @return views
		 */
		public function lists(){
			$uri = "/".$this->uri->segment(1)."/hr/approve_overtime/lists/";
			$page = is_numeric($this->uri->segment(5)) ? $this->uri->segment(5) : 1;
			$total_rows = $this->overtime->overtime_application_count($this->company_info->company_id);
			init_pagination($uri,$total_rows,$this->per_page,$this->segment);
			$data['pagi'] = $this->pagination->create_links();
			$data['page_title'] = "Overtime Application"; 
			$data['sidebar_menu'] =$this->sidebar_menu;	
			$data['success'] = $this->session->flashdata("success");
			$data['application'] = $this->overtime->overtime_list($this->company_info->company_id,$this->per_page,(($page-1) * $this->per_page));
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/approve_overtime_view', $data);
		}
		
		/**
		 * LIST OVERTIME VIA DATE
		 * @return amazing
		 */
		public function lists_dates(){
			$uri = "/".$this->uri->segment(1)."/hr/approve_overtime/lists_dates/".$this->uri->segment(5)."/".$this->uri->segment(6);
			$page = is_numeric($this->uri->segment(7)) ? $this->uri->segment(7) : 1;
			$total_rows = $this->overtime->overtime_application_count_date($this->company_info->company_id,idates_only($this->uri->segment(5)),idates_only($this->uri->segment(6)));
			init_pagination($uri,$total_rows,$this->per_page,7);
			$data['pagi'] = $this->pagination->create_links();
			$data['page_title'] = "Overtime Application"; 
			$data['sidebar_menu'] =$this->sidebar_menu;	
			$data['success'] = $this->session->flashdata("success");
			$data['application'] = $this->overtime->overtime_list_by_date($this->company_info->company_id,$this->per_page,(($page-1) * $this->per_page),idates_only($this->uri->segment(5)),idates_only($this->uri->segment(6)));
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/approve_overtime_view', $data);
		}
		
		/**
		 * LIST OVERTIME VIA DATE
		 * @return amazing
		 */
		public function lists_names(){
			$uri = "/".$this->uri->segment(1)."/hr/approve_overtime/lists_names/".$this->uri->segment(5);
			$page = is_numeric($this->uri->segment(7)) ? $this->uri->segment(7) : 1;
			$total_rows = $this->overtime->overtime_application_count_name($this->company_info->company_id,$this->uri->segment(5));
			init_pagination($uri,$total_rows,$this->per_page,6);
			$data['pagi'] = $this->pagination->create_links();
			$data['page_title'] = "Overtime Application"; 
			$data['sidebar_menu'] =$this->sidebar_menu;	
			$data['success'] = $this->session->flashdata("success");
			$data['application'] = $this->overtime->overtime_list_by_name($this->company_info->company_id,$this->per_page,(($page-1) * $this->per_page),$this->uri->segment(5));
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/approve_overtime_view', $data);
		}
		
		/**
		 * Approves overtime application
		 * @return json.
		 */
		public function approve(){
			if($this->input->is_ajax_request()){
				if($this->input->post("submit")){
					$overtime_id = $this->input->post('overtime_id');
					$this->form_validation->set_rules("overtime_id[]","Overtime","required|trim|xss_clean");
					if($this->form_validation->run() == true){	
						foreach($overtime_id as $key=>$val):
							$fields = array(
								"overtime_status" => "approved"
							);
							$where = array(
								"overtime_id"=>$val,
								"company_id"=>$this->company_info->company_id
							);
							$this->overtime->update_field("employee_overtime_application",$fields,$where);
							# this will add activity logs on every application which was approve
							$this->overtime->ajax_overtime_logs_approve($val,$this->company_info->company_id);
						endforeach;
						$this->session->set_flashdata("success","Success");
						echo json_encode(array("success"=>"1","error"=>"","field"=>$where));		
						return true;
					}else{
						echo json_encode(array("success"=>"0","error"=>validation_errors("<span class='errors_zone'>","</span>"),"we"=>"weee"));	
						return false;
					}			
				}
			}else{
				show_404();
			}
		}
		
		/**
		 * Rejects overtime application
		 * @return Json
		 */
		public function reject(){
			if($this->input->is_ajax_request()) {
				if($this->input->post("submit")) {
					$overtime_id = $this->input->post('overtime_id');
					$this->form_validation->set_rules("overtime_id[]","Overtime","required|trim|xss_clean");
					if($this->form_validation->run() == true){	
						foreach($overtime_id as $key=>$val):
							$fields = array(
								"overtime_status" => "reject"
							);
							$where = array(
								"overtime_id"=>$val,
								"company_id"=>$this->company_info->company_id
							);
							# this will add activity logs on every application which was rejected
							$this->overtime->ajax_overtime_logs_reject($val,$this->company_info->company_id);		
							$this->overtime->update_field("employee_overtime_application",$fields,$where);
						endforeach;
						$this->session->set_flashdata("success","Success");
						echo json_encode(array("success"=>"1","error"=>"","field"=>$where));		
						return true;
					}else{
						echo json_encode(array("success"=>"0","error"=>validation_errors("<span class='errors_zone'>","</span>"),"we"=>"weee"));	
						return false;
					}			
				}
			}else{
				show_404();
			}
		}

		public function we(){
			$we2 = check_overtime_application(12);
			$we = $this->overtime->ajax_overtime_logs_reject(12,$this->company_info->company_id);
			p($we);
		}
		
		public function ajax_add_notes(){
			if($this->input->is_ajax_request()){
				$overtime_id = $this->input->post('overtime_id');
				$this->form_validation->set_rules('overtime_id','ID','required|trim|xss_clean|is_numeric');
				$this->form_validation->set_rules('note','note','trim|xss_clean');
				if($this->form_validation->run() == true){
					$fields = array("notes" => $this->db->escape_str($this->input->post('note')));
					$where = array("overtime_id"=>$overtime_id,"company_id"=>$this->company_info->company_id);
					$this->overtime->update_field("employee_overtime_application",$fields,$where);	
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