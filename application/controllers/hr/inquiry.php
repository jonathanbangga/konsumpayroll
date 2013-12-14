<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Inquiry Controller Handles on HR inquiries
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Inquiry extends CI_Controller {
		
		/**
		 * Theme options - default theme
		 * @var string
		 */
		var $theme;
		var $company_info;
		
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->authentication->check_if_logged_in();	
			$this->load->model("hr/inquiry_model","inquiry");
			$this->theme = $this->config->item('jb_employee_temp'); // i just used this because the template has no sidebar
			$this->sidebar_menu = 'content_holders/hr_tables_sidebar_menu';
			$this->menu = 'content_holders/user_hr_owner_menu';
			$this->load->helper('string');
			$this->company_info =  whose_company();
			if($this->company_info == false){
				show_error("Company subdomain is invalid");
				return false;
			}		
		}
		
		public function index(){
			redirect($this->uri->segment(1)."/hr/inquiry/search");	
		}
		
		/**
		 * inquiry REsults
		 */
		public function search() {
			$data['page_title'] = "INQUIRY";
			$data['sidebar_menu'] =$this->sidebar_menu;
			$data['inquiry_result'] = '';
			$data['employees'] = $this->inquiry->fetch_all_employee($this->company_info->company_id);		
			if($this->input->post('submit')){
				$this->form_validation->set_rules("payroll_user","Employee number","trim|xss_clean");
				$this->form_validation->set_rules("employee_name","Employee name","trim|xss_clean");
				$this->form_validation->set_rules("year","Year","trim|xss_clean");
				if($this->form_validation->run() == true){	
					$this->session->set_userdata("payroll_user",$this->input->post('payroll_user'));
					$this->session->set_userdata("employee_name",$this->input->post('employee_name'));
					$this->session->set_userdata("year",$this->input->post('year'));	
					$data['inquiry_result']  = $this->inquiry->get_employee_inquiries(
												$this->company_info->company_id,
												$this->input->post('payroll_user'),
												$this->input->post('employee_name'),
												$this->input->post('year')
												);						
				}else{
					
				}	
			}	
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/inquiry_view', $data);
		}
	
	}

/* End of file sss_tbl.php */
/* Location: ./application/controllers/hr/sss_tbl.php */