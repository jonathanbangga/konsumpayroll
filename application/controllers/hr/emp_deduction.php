<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Deduction Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_deduction extends CI_Controller {
		
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
			$this->url = "/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$this->uri->segment(4);
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "Deductions";
			$data['sidebar_menu'] = $this->sidebar_menu;
			
			// init pagination
			$uri = "/{$this->uri->segment(1)}/hr/emp_deduction/index";
			$total_rows = $this->hr_emp->emp_deduction_counter($this->company_id);
			$per_page =2;
			$segment=5;
			
			init_pagination($uri,$total_rows,$per_page,$segment);

			$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
			$data["links"] = $this->pagination->create_links();
			// end pagination
			
			$data['emp_deduction'] = $this->hr_emp->emp_deduction($per_page, $page, $this->company_id);
			$data['emp_deduction_type'] = $this->hr_emp->emp_deduction_type($this->company_id);
			$employee = $this->hr_emp->view_emp_deduction($this->company_id);
			$results = "";
			if($employee != FALSE){
				foreach($employee as $row){
					$results .= "{label:'".ucwords($row->first_name)." ".ucwords($row->last_name)."',emp_no:'{$row->payroll_cloud_id}',emp_id:'{$row->emp_id}'},";
				}	
			}
			$data['employee'] = $results;
			
			if($this->input->post('add')){
				$emp_id = $this->input->post('emp_id');
				$emp_no = $this->input->post('emp_no');
				$deduction_type = $this->input->post('deduction_type');
				$amount = $this->input->post('amount'); 
				$valid_from = $this->input->post('valid_from');
				$valid_to = $this->input->post('valid_to');
				$recurring = $this->input->post('recurring');
				
				foreach($emp_id as $key2=>$val){
					$this->form_validation->set_rules("emp_id[{$key2}]", 'Employee ID', 'trim|required|xss_clean');
					$this->form_validation->set_rules("emp_no[{$key2}]", 'Employee Number', 'trim|required|xss_clean');
					$this->form_validation->set_rules("deduction_type[{$key2}]", 'Deduction Type', 'trim|required|xss_clean');
					$this->form_validation->set_rules("amount[{$key2}]", 'Amount', 'trim|required|xss_clean');
					$this->form_validation->set_rules("valid_from[{$key2}]", 'Valid From', 'trim|required|xss_clean');
					$this->form_validation->set_rules("valid_to[{$key2}]", 'Valid To', 'trim|required|xss_clean');
					$this->form_validation->set_rules("recurring[{$key2}]", 'Recurring', 'trim|required|xss_clean');
				}
				
				if ($this->form_validation->run()==true){
					
					foreach($emp_id as $key=>$val){
                	    $add_emp_deduction = array(	
							'emp_id' => $emp_id[$key],
							'company_id' => $this->company_id,
							'deduction_type_id' => $deduction_type[$key],
							'amount' => $amount[$key],
							'valid_from' => $valid_from[$key],
                	    	'valid_until' => $valid_to[$key],
                	    	'recurring' => $recurring[$key]
						);

						$insert_emp_deduction = $this->jmodel->insert_data('employee_deductions',$add_emp_deduction);
					}

					$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully saved!</div>');
					redirect($this->url);
					return false;
				}
			}
			
			if($this->input->post('update_info')){
				
				// Update Employee Deduction Information
				$emp_idEdit = $this->input->post('emp_idEdit');
				$deduction_type = $this->input->post('deduction_type');
				$amount_edit = $this->input->post('amount_edit');
				$valid_from = $this->input->post('valid_from'); 
				$valid_to = $this->input->post('valid_to');
				$recurring = $this->input->post('recurring');
				
				$this->form_validation->set_rules("emp_idEdit", 'Employee ID', 'trim|required|xss_clean');
				$this->form_validation->set_rules("deduction_type", 'Deduction Type', 'trim|required|xss_clean');
				$this->form_validation->set_rules("amount_edit", 'Amount', 'trim|required|xss_clean');
				$this->form_validation->set_rules("valid_from", 'Valid From', 'trim|required|xss_clean');
				$this->form_validation->set_rules("valid_to", 'Valid To', 'trim|required|xss_clean');
				$this->form_validation->set_rules("recurring", 'Recurring', 'trim|required|xss_clean');
				
				if ($this->form_validation->run()==true){
					$update_info = $this->hr_emp->update_deduction_info($emp_idEdit,$deduction_type,$amount_edit,$valid_from,$valid_to,$recurring,$this->company_id);
					if($update_info){
						$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully updated!</div>');
						echo json_encode(array("success"=>1));
						redirect($this->url);
						return false;
					}else{
						echo json_encode(array("success"=>0));
						return false;
					}
				}else{
					echo json_encode(array("success"=>0));
					return false;
				}
			}
			
			if($this->input->is_ajax_request()) {
				// Delete Employee Deduction Information
				if($this->input->post('delete_db')){
					$emp_id = $this->input->post('emp_id');
					$delete_me = $this->db->query("DELETE FROM employee_deductions WHERE emp_id = '{$emp_id}' and company_id = '{$this->company_id}'");
					if($delete_me){
						$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully deleted!</div>');
						echo json_encode(array("success"=>1,"url"=>$this->url));
						return false;
					}
				}
				
				// Get Information for Employee Leave Information
				if($this->input->post('get_information')){
					$emp_id = $this->input->post('emp_id');
					$get_info = $this->db->query("
						SELECT *FROM employee_deductions ed
						LEFT JOIN employee e ON ed.emp_id = e.emp_id 
						WHERE ed.emp_id = '{$emp_id}' and ed.company_id = '{$this->company_id}'
					");
					if($get_info->num_rows() > 0){
						$get_info_row = $get_info->row();
						$get_info->free_result();
						echo json_encode(
							array(
								"success"=>1,
								"emp_id"=>$get_info_row->emp_id,
								"emp_name"=>ucwords($get_info_row->first_name)." ".ucwords($get_info_row->last_name),
								"deduction_type_id"=>$get_info_row->deduction_type_id,
								"recurring"=>$get_info_row->recurring,
								"amount"=>$get_info_row->amount,
								"valid_from"=>$get_info_row->valid_from,
								"valid_until"=>$get_info_row->valid_until
							)
						);
						return false;
					}else{
						echo json_encode(array("success"=>0));
						return false;
					}
				}
			}
			
			$this->layout->set_layout($this->theme);
			$this->layout->view('pages/hr/emp_deduction_view', $data);
		}
	
	}

/* End of file Emp_deduction.php */
/* Location: ./application/controllers/hr/Emp_deduction.php */