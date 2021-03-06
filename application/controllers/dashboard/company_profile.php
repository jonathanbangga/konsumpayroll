<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Approvers Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Company_profile extends CI_Controller {
		
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->authentication->check_if_logged_in();
			$this->company_info = whose_company();
			
			if(count($this->company_info) == 0){
				show_error("Invalid subdomain");
				return false;
			}
			$this->company_id = $this->company_info->company_id;	
		}
		
		/**
		 * index page
		 */
		public function index() {
			$this->session->set_userdata("company_id",$this->company_id);
			
			if($this->uri->segment(4) == ""){
				redirect("{$this->uri->segment(1)}/company_setup/company_information");
			}elseif($this->uri->segment(5) == "hr_setup"){
				redirect("{$this->uri->segment(1)}/hr_setup/employment_type");
			}elseif($this->uri->segment(5) == "payroll_setup"){
				redirect("{$this->uri->segment(1)}/payroll_setup/payroll_group");
			}
		}
		
		
		public function payroll_run(){
			$this->session->set_userdata("company_id",$this->company_id);
			redirect($this->uri->segment(1)."/payroll_run/overtime/lists");	
		}
		
		
	}

/* End of file company_approvers.php */
/* Location: ./application/controllers/company_approvers.php */