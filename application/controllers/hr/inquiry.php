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
		
		/**
		 * Index disabled redirect to search
		 */
		public function index(){
			redirect($this->uri->segment(1)."/hr/inquiry/search");	
		}
		
		/**
		 * inquiry REsults
		 */
		public function search() {
			$data['page_title'] = "INQUIRY";
			$data['sidebar_menu'] = $this->sidebar_menu;
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
					$data['inquiry_result'] = $this->inquiry->get_employee_inquiries($this->company_info->company_id,$this->input->post('payroll_user'),$this->input->post('employee_name'),$this->input->post('year'));		
				}else{
					
				}	
			}	
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/inquiry_view', $data);
		}
		
		/**
		 * Add using ajax adjustments
		 * Triggers ajax by adding individual adjustments
		 */
		public function ajax_add_adjustments(){
			if($this->input->is_ajax_request()){
				switch($this->input->post('type')):
					case "add_adjustments":
						if($this->input->post('submit')){
							$this->form_validation->set_rules('ela_id','Application ID','required|trim|xss_clean');
							$this->form_validation->set_rules('adjustments','Adjustments','required|trim|xss_clean');
							if($this->form_validation->run() == true){
								$fields = array(
									"note" 		=>  $this->input->post('adjustments')
								);
								$where = array(
									"employee_leaves_application_id" => $this->input->post('ela_id'),
									"company_id" => $this->company_info->company_id
								);
								$this->inquiry->update_fields("employee_leaves_application",$fields,$where);
								echo json_encode(array("success"=>"1","error"=>""));
								return false;
							}else{
								echo json_encode(array("success"=>"0","error"=>validation_errors()));
								return false;
							}
						}
					break;
					case "add_adjustment_reasons":	
						if($this->input->post('submit')){
							$this->form_validation->set_rules('ela_id','Application ID','required|trim|xss_clean');
							$this->form_validation->set_rules('adjustments_reasons','Adjustments Reasons','required|trim|xss_clean');
							if($this->form_validation->run() == true){
								$fields = array(
									"reasons" 	=>  $this->input->post('adjustments_reasons')
								);
								$where = array(
									"employee_leaves_application_id" => $this->input->post('ela_id'),
									"company_id" => $this->company_info->company_id
								);
								$this->inquiry->update_fields("employee_leaves_application",$fields,$where);
								echo json_encode(array("success"=>"1","error"=>""));
								return false;
							}else{
								echo json_encode(array("success"=>"0","error"=>validation_errors(),'we'=>'123'));
								return false;
							}
						}
					break;
				endswitch;
			}
		}
		
		/**
		 * export types
		 * This will export what type of document to export to either XLS or CSV format
		 * @param string $payroll_user
		 * @param string $employee_name
		 * @param int $year
		 * @return data
		 */
		public function export($type,$payroll_user=NULL,$employee_name=NULL,$year=NULL){
			if($payroll_user == 'no') $payroll_user = NULL; // CHECKS PAYROLL USERS
			if($employee_name == 'no') $employee_name = NULL; // CHECK EMPLOYEE NAME
			if($year =='no') $year = NULL; // CHECK  YEAR 
			$employee_name = str_replace("%20"," ",$employee_name);
			$payroll_user =  str_replace("%20"," ",$payroll_user);
			$data['inquiry_result']  = $this->inquiry->get_employee_inquiries($this->company_info->company_id,$payroll_user,$employee_name,$year);		
			$contents_stored = "Period \t Leave Type \t Total Credits \t Accrued Leaves \t Used Leaves \t Adjustments \t Ending Balance \t Adjustment Reason\n";
			if($data['inquiry_result']){					
				foreach($data['inquiry_result'] as $key=>$val):
					$contents_stored .= $val->period." \t ".$val->leave_name." \t 1 \t".$val->total_credits." \t "
									.random_string('numeric',1)."\t".$val->note." \t 1000 \t ".$val->reasons."\n";
				endforeach;
			}
			
			if($type){
				switch($type):
					case "xls":
						module_literature($contents_stored,"xls");
					break;
					case "csv":
						module_literature($contents_stored,"csv");
					break;
				endswitch;
			}else{
				return false;
			}
		}
	
		public function test(){
			$we = create_comp_directory('434');
			p($we);
		}
	}

/* End of file sss_tbl.php */
/* Location: ./application/controllers/hr/sss_tbl.php */