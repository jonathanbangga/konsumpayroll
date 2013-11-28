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
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->load->model("hr/approve_payroll_run_model","payroll_run");
			$this->theme = $this->config->item('default');
			$this->menu = "content_holders/hr_company_sidebar_menu";
			$this->sidebar_menu = "content_holders/hr_approver_sidebar_menu";
			$this->company_info = whose_company();
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
			$data['page_title'] = "Timesheets Application"; 
			$data['sidebar_menu'] =$this->sidebar_menu;	
			$uri = "/".$this->uri->segment(1)."/hr/approve_payroll_run/lists/";
			$total_rows = $this->payroll_run->payroll_run_count($this->company_info->company_id);
			$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
	       	init_pagination($uri,$total_rows,$this->per_page,$this->segment);
	 		$data['pagi'] = $this->pagination->create_links();
			$data['leave_application'] = $this->payroll_run->payroll_run_list($this->company_info->company_id,$this->per_page,$page);
			echo $this->db->last_query();
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/approve_payroll_run_view', $data);
		}
	
	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company_approvers.php */