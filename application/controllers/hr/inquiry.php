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
		 * index page
		 */
		public function search() {
			$data['page_title'] = "INQUIRY";
			$data['sidebar_menu'] =$this->sidebar_menu;
			$inq = $this->inquiry->get_employee_inquiries($this->company_info->company_id,"106007477",null,null);
			echo $this->db->last_query();
			p($inq);
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/inquiry_view', $data);
		}
	
	}

/* End of file sss_tbl.php */
/* Location: ./application/controllers/hr/sss_tbl.php */