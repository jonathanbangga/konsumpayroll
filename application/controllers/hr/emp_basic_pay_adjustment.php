<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Basic Pay Adjusment Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_basic_pay_adjustment extends CI_Controller {
		
		/**
		 * Theme options - default theme
		 * @var string
		 */
		var $theme;
		
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->theme = $this->config->item('default');
			$this->load->model('konsumglobal_jmodel','jmodel');
			$this->load->model('hr/hr_employee_model','hr_emp');
			$this->company_id = 1;
			
			$this->sidebar_menu = 'content_holders/hr_employee_sidebar_menu';
			$this->menu = 'content_holders/company_menu';
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "Basic Pay Adjustment";
			$data['sidebar_menu'] = $this->sidebar_menu;
			
			$data['basic_pay_adjustment'] = $this->hr_emp->basic_pay_adjustment($this->company_id);
			$employee = $this->hr_emp->view_emp_basic_pay_adjustment($this->company_id);
			$results = "";
			if($employee != FALSE){
				foreach($employee as $row){
					$results .= "{label:'".ucwords($row->first_name)." ".ucwords($row->last_name)."',emp_no:'{$row->payroll_cloud_id}',emp_id:'{$row->emp_id}'},";
				}	
			}
			$data['employee'] = $results;
			
			if($this->input->post('add')){
				$emp_id = $this->input->post('emp_id');
				$emp_name = $this->input->post('emp_name');
				$emp_no = $this->input->post('emp_no');
				$current_basic_pay = $this->input->post('current_basic_pay'); 
				$new_basic_pay = $this->input->post('new_basic_pay');
				$effective_date = $this->input->post('effective_date');
				$adjustment_date = $this->input->post('adjustment_date');
				$reasons = $this->input->post('reasons');
				
				foreach($emp_id as $key2=>$val){
					$this->form_validation->set_rules("emp_id[{$key2}]", 'Employee ID', 'trim|required|xss_clean');
					$this->form_validation->set_rules("emp_name[{$key2}]", 'Employee Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules("emp_no[{$key2}]", 'Employee Number', 'trim|required|xss_clean');
					$this->form_validation->set_rules("current_basic_pay[{$key2}]", 'Current Basic Pay', 'trim|required|xss_clean');
					$this->form_validation->set_rules("new_basic_pay[{$key2}]", 'New Basic Pay', 'trim|required|xss_clean');
					$this->form_validation->set_rules("effective_date[{$key2}]", 'Effective Date', 'trim|required|xss_clean');
					$this->form_validation->set_rules("adjustment_date[{$key2}]", 'Adjustment Date', 'trim|required|xss_clean');
					$this->form_validation->set_rules("reasons[{$key2}]", 'Reasons', 'trim|required|xss_clean');
				}
				
				if ($this->form_validation->run()==true){
					foreach($emp_id as $key=>$val){
						
						// uploading file
						$config['upload_path'] = "./uploads/";
						$config['allowed_types'] = 'doc|docx|xls|xlsx|ppt|pptx|pdf|txt|jpg|png|jpeg|bmp|gif|avi|flv|mpg|wmv|mp3|wma|wav|zip|rar|sql';
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($this->upload->do_upload("userfile[{$key}]")){                                           
	                        $data_result = $this->upload->data();
                	    }
						
						$add_basci_pay_adjustment = array(	
							'emp_id' => $emp_id[$key],
							'comp_id' => $this->company_id,
							'current_basic_pay' => $current_basic_pay[$key],
							'new_basic_pay' => $new_basic_pay[$key],
							'effective_date' => $effective_date[$key],
							'adjustment_date' => $adjustment_date[$key],
						 	'reasons' => $reasons[$key],
							'attachment' => "0"
						);

						$insert_basic_pay_adjustment = $this->jmodel->insert_data('basic_pay_adjustment',$add_basci_pay_adjustment);
					}
					$this->session->set_flashdata('message', '<p class="save_alert">Successfully saved!</p>');
					redirect($this->uri->uri_string());
					return false;
				}
			}
			
			if($this->input->is_ajax_request()) {
				if($this->input->post('delete_basic_pay_adjustment')){
					$emp_id = $this->input->post('emp_id');
					$delete_me = $this->db->query("DELETE FROM basic_pay_adjustment WHERE emp_id = '{$emp_id}' and comp_id = '{$this->company_id}'");
					if($delete_me){
						$this->session->set_flashdata('message', '<p class="save_alert">Successfully deleted!</p>');
						echo json_encode(array("success"=>1));
						return false;
					}
				}
			}
			$this->layout->set_layout($this->theme);
			$this->layout->view('pages/hr/basic_pay_adjustment_view', $data);
		}
	
	}

/* End of file Emp_basic_pay_adjustment.php */
/* Location: ./application/controllers/hr/Emp_basic_pay_adjustment.php */