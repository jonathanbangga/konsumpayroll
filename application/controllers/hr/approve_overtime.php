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
			$this->load->model("hr/approve_overtime_model","overtime");
			$this->theme = $this->config->item('default');
			$this->menu = "content_holders/user_hr_owner_menu";
			$this->sidebar_menu = "content_holders/hr_approver_sidebar_menu";
			$this->company_info = whose_company();
			$this->subdomain = $this->uri->segment(1);
			$this->per_page = 5;
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
			$uri = "/".$this->uri->segment(1)."/hr/approve_overtime//lists/";
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
		
		public function approve(){
			if($this->input->is_ajax_request()){
				if($this->input->post("submit")){
					$overtime_id = $this->input->post('overtime_id');
					$this->form_validation->set_rules("overtime_id[]","Overtime","required|trim|xss_clean");
					if($this->form_validation->run() == true){	
						foreach($overtime_id as $key=>$val):
							$fields = array(
								"overtime_status" => "approve"
							);
							$where = array(
								"overtime_id"=>$val,
								"company_id"=>$this->company_info->company_id
							);
							$this->overtime->update_field("overtime",$fields,$where);
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
		
		public function reject(){
			if($this->input->is_ajax_request()){
				if($this->input->post("submit")){
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
							$this->overtime->update_field("overtime",$fields,$where);
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

	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company_approvers.php */