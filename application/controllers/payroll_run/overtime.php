<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Government Registration Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Overtime extends CI_Controller {
		
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
			$this->load->model("payroll_run/overtime_model","overtime");
			$this->theme = $this->config->item('default');
			$this->menu = 'content_holders/user_hr_owner_menu';
			$this->sidebar_menu = $this->config->item('payroll_run_sidebar_menu');
			$this->company_info = whose_company();
			$this->subdomain = $this->uri->segment(1);
			$this->per_page =12;
			$this->segment = 5;
			if(count($this->company_info) == 0){
				show_error("Invalid subdomain");
				return false;
			}
		
		}
		
		public function lists(){
			$uri = "/".$this->uri->segment(1)."/payroll_run/overtime/lists";
			$page = is_numeric($this->uri->segment(5)) ? $this->uri->segment(5) : 1;
			$total_rows = $this->overtime->overtime_application_count($this->company_info->company_id);
			init_pagination($uri,$total_rows,$this->per_page,$this->segment);
			$data['page_title'] = "Overtime";
			$data['pagi'] = $this->pagination->create_links();
			$data['list'] =  $this->overtime->overtime_list($this->company_info->company_id,$this->per_page,(($page-1) * $this->per_page));
			$data['sidebar_menu'] = $this->sidebar_menu;
			$this->layout->set_layout($this->theme);
			$this->layout->view('pages/payroll_run/overtime_view',$data);
		}
		
		public function ajax_remove_overtime(){
			if($this->input->is_ajax_request()){
			# overtime id 
				$overtime_id = $this->input->post("oid");
				if($overtime_id){
					foreach($overtime_id as $key=>$val){
						$success = $this->overtime->overtime_delete($this->company_info->company_id,$val);
					}
					$this->session->set_flashdata("delete_success","Successfully deleted!");
					echo json_encode(array("success"=>true));
					return false;
				}else{
					echo json_encode(array("success"=>false));
					return false;
				}
			}else{
				show_404("what you doing dong?");
			}
		}
		
	}

/* End of file Government_registration.php */
/* Location: ./application/controllers/company/Government_registration.php */