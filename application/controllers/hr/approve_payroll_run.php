<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Approvers Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Approve_payroll_run extends CI_Controller {
		
		/**
		 * Theme options - default theme
		 * @var string
		 */
		var $theme;
		var $menu;
		var $sidebar_menu;
		var $company_info;
		var $per_page;
		var $segment;
		var $subdomain;
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->load->model("hr/approve_payroll_run_model","payroll_run");
			$this->theme = $this->config->item('default');
			$this->menu = "content_holders/user_hr_owner_menu";
			$this->sidebar_menu = "content_holders/hr_approver_sidebar_menu";
			$this->company_info = whose_company();
			$this->per_page = 1;
			$this->segment = 5;
			$this->subdomain = $this->uri->segment(1);
			if(count($this->company_info) == 0){
				show_error("Invalid subdomain");
				return false;
			}
		}
		
		public function index(){
			redirect("{$this->uri->segment(1)}/hr/approve_leave/lists");
		}
		
		public function lists(){
			$data['page_title'] = "PAYROLL RUN APPLICATION"; 
			$data['sidebar_menu'] =$this->sidebar_menu;	
			$uri = "/".$this->uri->segment(1)."/hr/approve_payroll_run/lists/";
			$total_rows = $this->payroll_run->payroll_run_count($this->company_info->company_id);
			$page = is_numeric($this->uri->segment(5)) ? $this->uri->segment(5) : 1;
	       	init_pagination($uri,$total_rows,$this->per_page,$this->segment);
	 		$data['pagi'] = $this->pagination->create_links();
	 		$data['success'] = 	$this->session->flashdata("success");
			$data['application'] = $this->payroll_run->payroll_run_list($this->company_info->company_id,$this->per_page,(($page-1) * $this->per_page));		
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/approve_payroll_run_view', $data);
		}
		
		/**
		 * FETCH LIST NAMES
		 * CHECK FETCH LIST NAMES
		 */
		public function lists_names(){
			$data['page_title'] = "PAYROLL RUN APPLICATION"; 
			$data['sidebar_menu'] =$this->sidebar_menu;	
			$uri = "/".$this->uri->segment(1)."/hr/approve_payroll_run/lists_names/".$this->uri->segment(5)."/";
			$total_rows = $this->payroll_run->payroll_run_count_name($this->company_info->company_id,$this->uri->segment(5));
			$page = is_numeric($this->uri->segment(6)) ? $this->uri->segment(6) : 1;
	       	init_pagination($uri,$total_rows,$this->per_page,6);
	 		$data['pagi'] = $this->pagination->create_links();
	 		$data['success'] = 	$this->session->flashdata("success");
			$data['application'] = $this->payroll_run->payroll_run_list_by_names($this->company_info->company_id,$this->per_page,(($page-1) * $this->per_page),$this->uri->segment(5));
			echo $this->db->last_query();		
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/approve_payroll_run_view', $data);
		}
		
		public function lists_dates(){
			$data['page_title'] = "PAYROLL RUN APPLICATION"; 
			$data['sidebar_menu'] =$this->sidebar_menu;	
			$uri = "/".$this->uri->segment(1)."/hr/approve_payroll_run/lists_dates/{$this->uri->segment(5)}/{$this->uri->segment(6)}";
			$total_rows = $this->payroll_run->payroll_run_count_dates($this->company_info->company_id,$this->uri->segment(5),$this->uri->segment(6));
			$page = is_numeric($this->uri->segment(7)) ? $this->uri->segment(7) : 1;
	       	init_pagination($uri,$total_rows,$this->per_page,7);
	 		$data['pagi'] = $this->pagination->create_links();
	 		$data['success'] = 	$this->session->flashdata("success");
			$data['application'] = $this->payroll_run->payroll_run_list_by_date($this->company_info->company_id,$this->per_page,(($page-1) * $this->per_page),$this->uri->segment(5),$this->uri->segment(6));
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/approve_payroll_run_view', $data);
		}

		public function approve(){
			if($this->input->is_ajax_request()){
				if($this->input->post("submit")){
					$payroll_run_id = $this->input->post('payroll_run_id');
					$this->form_validation->set_rules("payroll_run_id[]","Payroll","required|trim|xss_clean");
					if($this->form_validation->run() == true){	
						foreach($payroll_run_id as $key=>$val):
							$fields = array(
								"payroll_run_status" => "approve"
							);
							$where = array(
								"payroll_run_id"=>$val,
								"company_id"=>$this->company_info->company_id
							);
							$this->payroll_run->update_field("payroll_run",$fields,$where);
						endforeach;
						$this->session->set_flashdata("success","Success");
						echo json_encode(array("success"=>"1","error"=>""));		
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
					$payroll_run_id = $this->input->post('payroll_run_id');
					$this->form_validation->set_rules("payroll_run_id[]","Payroll","required|trim|xss_clean");
					if($this->form_validation->run() == true){	
						foreach($payroll_run_id as $key=>$val):
							$fields = array(
								"payroll_run_status" => "reject"
							);
							$where = array(
								"payroll_run_id"=>$val,
								"company_id"=>$this->company_info->company_id
							);
							$this->payroll_run->update_field("payroll_run",$fields,$where);
						endforeach;
						$this->session->set_flashdata("success","Success");
						echo json_encode(array("success"=>"1","error"=>""));		
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