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
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->load->model("hr/approve_overtime_model","overtime");
			$this->theme = $this->config->item('default');
			$this->menu = "content_holders/hr_company_sidebar_menu";
			$this->sidebar_menu = "content_holders/hr_approver_sidebar_menu";
			$this->company_info = whose_company();
			if(count($this->company_info) == 0){
				show_error("Invalid subdomain");
				return false;
			}
		}
		
		public function index(){
			redirect("{$this->uri->segment(1)}/hr/approve_leave/lists");
		}
		
		public function lists(){
			$data['page_title'] = "Overtime Application"; 
			$data['sidebar_menu'] =$this->sidebar_menu;	
			$data['leave_application'] = $this->overtime->overtime_list($this->company_info->company_id);
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/approve_overtime_view', $data);
		}
	
	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company_approvers.php */