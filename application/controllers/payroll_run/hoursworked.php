<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Government Registration Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Hoursworked extends CI_Controller {
		
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
			$this->load->model("payroll_run/hoursworked_model","hw");
			$this->theme = $this->config->item('default');
			$this->menu = 'content_holders/user_hr_owner_menu';
			$this->sidebar_menu = $this->config->item('payroll_run_sidebar_menu');
			$this->company_info = whose_company();
			$this->subdomain = $this->uri->segment(1);
			$this->per_page =1;
			$this->segment = 5;
			if(count($this->company_info) == 0){
				show_error("Invalid subdomain");
				return false;
			}
		}
		
		public function lists(){
			$data['page_title'] = "Hourswork";
			$uri = "/".$this->uri->segment(1)."/payroll_run/overtime/lists";
			$page = is_numeric($this->uri->segment(5)) ? $this->uri->segment(5) : 1;
			#$total_rows = $this->overtime->overtime_application_count($this->company_info->company_id);
			#init_pagination($uri,$total_rows,$this->per_page,$this->segment);
			$data['pagi'] = $this->pagination->create_links();
			$data['list'] =  $this->hw->hoursworked_list($this->company_info->company_id,$this->per_page,(($page-1) * $this->per_page));
			echo $this->db->last_query();
			$data['sidebar_menu'] = $this->sidebar_menu;
			$this->layout->set_layout($this->theme);
			$this->layout->view('pages/payroll_run/hours_worked_view',$data);
		}
		
		public function check_timeins(){
			$query = $this->db->query("SELECT distinct(e.emp_id),sum(eti.total_hours) as res FROM employee  e
													LEFT JOIN `employee_time_in` eti on e.emp_id = eti.emp_id 
													WHERE eti.comp_id = '{$this->db->escape_str($this->company_info->company_id)}' group by e.emp_id");
			$result = $query->result();	
			$query->free_result();
			return $result;
		}
		
		
		
	}

/* End of file hoursworked.php */
/* Location: ./application/controllers/company/hoursworked.php */