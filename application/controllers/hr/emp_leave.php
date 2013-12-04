<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Leave Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_leave extends CI_Controller {
		
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
			
			$this->sidebar_menu = 'content_holders/hr_employee_sidebar_menu';
			$this->menu = 'content_holders/company_menu';
			$this->url = "/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$this->uri->segment(4);
		
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
			$data['page_title'] = "Leaves";
			$data['sidebar_menu'] = $this->sidebar_menu;
			
			// init pagination
			$uri = "/{$this->uri->segment(1)}/hr/emp_leave/index";
			$total_rows = $this->hr_emp->emp_fixed_allowances_counter($this->company_id);
			$per_page = $this->config->item('per_page');
			$segment=5;
			
			init_pagination($uri,$total_rows,$per_page,$segment);

			$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
			$data["links"] = $this->pagination->create_links();
			// end pagination
			
			$data['emp_leave'] = $this->hr_emp->emp_leave($per_page, $page, $this->company_id);
			$data['leave_type'] = $this->hr_emp->leave_type($this->company_id);
			
			$employee = $this->hr_emp->view_emp_leave($this->company_id);
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
				$leave_type = $this->input->post('leave_type');
				$remaining_hours = $this->input->post('remaining_hours'); 
				$as_of = $this->input->post('as_of');
				
				foreach($emp_id as $key2=>$val){
					$this->form_validation->set_rules("emp_id[{$key2}]", 'Employee ID', 'trim|required|xss_clean');
					$this->form_validation->set_rules("emp_no[{$key2}]", 'Employee Number', 'trim|required|xss_clean');
					$this->form_validation->set_rules("leave_type[{$key2}]", 'Current Basic Pay', 'trim|required|xss_clean');
					$this->form_validation->set_rules("remaining_hours[{$key2}]", 'New Basic Pay', 'trim|required|xss_clean');
					$this->form_validation->set_rules("as_of[{$key2}]", 'Effective Date', 'trim|required|xss_clean');
				}
				
				if ($this->form_validation->run()==true){
					
					foreach($emp_id as $key=>$val){
                	    $add_emp_leave = array(	
							'emp_id' => $emp_id[$key],
							'company_id' => $this->company_id,
							'leave_type_id' => $leave_type[$key],
							'remaining_hours' => $remaining_hours[$key],
							'as_of' => $as_of[$key]
						);

						$insert_emp_leave = $this->jmodel->insert_data('employee_leaves',$add_emp_leave);
					}
						
					
					$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully saved!</div>');
					redirect($this->url);
					return false;
				}
			}
			
			if($this->input->post('update_info')){
				
				// Update Employee Basic Pay Adjustment
				$emp_idEdit = $this->input->post('emp_idEdit');
				$leave_type = $this->input->post('leave_type');
				$remaining_hours_edit = $this->input->post('remaining_hours_edit');
				$as_of_edit = $this->input->post('as_of_edit'); 
				
				$this->form_validation->set_rules("emp_idEdit", 'Employee ID', 'trim|required|xss_clean');
				$this->form_validation->set_rules("leave_type", 'Current Basic Pay', 'trim|required|xss_clean');
				$this->form_validation->set_rules("remaining_hours_edit", 'New Basic Pay', 'trim|required|xss_clean');
				$this->form_validation->set_rules("as_of_edit", 'Effective Date', 'trim|required|xss_clean');
				
				if ($this->form_validation->run()==true){
					$update_info = $this->hr_emp->update_leave_info($emp_idEdit,$leave_type,$remaining_hours_edit,$as_of_edit,$this->company_id);
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
				// Delete Employee Leave Information
				if($this->input->post('delete_db')){
					$emp_id = $this->input->post('emp_id');
					$delete_me = $this->db->query("DELETE FROM employee_leaves WHERE emp_id = '{$emp_id}' and company_id = '{$this->company_id}'");
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
						SELECT *FROM employee_leaves el
						LEFT JOIN employee e ON el.emp_id = e.emp_id 
						WHERE el.emp_id = '{$emp_id}' and el.company_id = '{$this->company_id}'
					");
					if($get_info->num_rows() > 0){
						$get_info_row = $get_info->row();
						$get_info->free_result();
						echo json_encode(
							array(
								"success"=>1,
								"emp_id"=>$get_info_row->emp_id,
								"emp_name"=>ucwords($get_info_row->first_name)." ".ucwords($get_info_row->last_name),
								"leave_type_id"=>$get_info_row->leave_type_id,
								"remaining_hours"=>$get_info_row->remaining_hours,
								"as_of"=>$get_info_row->as_of
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
			$this->layout->view('pages/hr/emp_leave_view', $data);
		}
	
	}

/* End of file Emp_leave.php */
/* Location: ./application/controllers/hr/Emp_leave.php */