<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Qualified Dependents Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_qualified_dependents extends CI_Controller {
		
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
			$this->menu = 'content_holders/user_hr_owner_menu';
			
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
			$data['page_title'] = "Qualified Dependents";
			$data['sidebar_menu'] = $this->sidebar_menu;
			
			// init pagination
			$uri = "/{$this->uri->segment(1)}/hr/emp_qualified_dependents/index";
			$total_rows = $this->hr_emp->employee_for_dep_list_counter($this->company_id);
			$per_page = $this->config->item('per_page');
			$segment=5;
			
			init_pagination($uri,$total_rows,$per_page,$segment);

			$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
			$data["links"] = $this->pagination->create_links();
			// end pagination
			
			$data['employee'] = $this->hr_emp->employee_list($per_page, $page, $this->company_id);
			
			// add new dependent
			if($this->input->post('save_dep')){
							
				$emp_id = $this->input->post('emp_id_add');
				$dept_name = $this->input->post('dept_name_add');
				$dob = $this->input->post('dob_add');
				
				foreach($emp_id as $key2=>$val){
					$this->form_validation->set_rules("emp_id_add[{$key2}]", 'Employee ID', 'trim|required|xss_clean');
					$this->form_validation->set_rules("dept_name_add[{$key2}]", 'Department Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules("dob_add[{$key2}]", 'Date of Birth', 'trim|required|xss_clean');
				}
				
				if ($this->form_validation->run()==true){
					foreach($dept_name as $key=>$val){
						$insert_dependents = array(
							'emp_id' => $emp_id[$key],
							'dependents_name' => $val,
							'dob' => $dob[$key],
							'company_id' => $this->company_id
						);
	
						$sql_insert_dept = $this->jmodel->insert_data('employee_qualifid_dependents',$insert_dependents);
					}
					
					$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully saved!</div>');
					redirect($this->url);
				}
			}
			
			if($this->input->is_ajax_request()) {
				// view dependents
				if($this->input->post('view_qual_dep')){
					$emp_id = $this->input->post('emp_id');
					$qual_dept_list = $this->hr_emp->qual_dept($emp_id,$this->company_id);
					
					$emp_name_request = array('company_id'=>$this->company_id,'emp_id'=>$emp_id);
					$emp_name_res = $this->jmodel->display_data_where_result('employee',$emp_name_request);
					foreach($emp_name_res as $row){
						$emp_name = ucwords($row->first_name)." ".ucwords($row->last_name);
						$emp_id_row = $row->emp_id;
					}
					
					echo json_encode(array("emp_id"=>$emp_id_row,"name"=>$emp_name,"table"=>$qual_dept_list));
					return false;
				}
				
				// delete qualified dependent
				if($this->input->post('delete_dep')){
					$dep_id = $this->input->post('dep_id');
					$emp_id = $this->input->post('emp_id');
					$delete_me = $this->hr_emp->delete_qual_depent($dep_id,$emp_id,$this->company_id);
					
					if($delete_me){
						$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully deleted!</div>');
						echo json_encode(array("success"=>1,"url"=>$this->url));
						return false;
					}
				}
				
				// get information
				if($this->input->post('get_information')){
					$dep_id = $this->input->post('dep_id');
					$dep_res = $this->hr_emp->dep_res($dep_id,$this->company_id);
					if($dep_res != FALSE){
						echo json_encode(array("success"=>1,"dep_id"=>$dep_res->qualified_dependents_id,"name"=>$dep_res->dependents_name,"dob"=>$dep_res->dob));
						return false;
					}else{
						echo json_encode(array("success"=>0));
						return false;
					}
				}
				
				// updating information
				if($this->input->post('update_dep')){
					$dep_id = $this->input->post('dep_id');
					$name = $this->input->post('name');
					$dep_dob = $this->input->post('dep_dob');
					$update_val_proc = $this->hr_emp->update_qual_dep($dep_id,$name,$dep_dob,$this->company_id);
					if($update_val_proc){
						$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully updated!</div>');
						echo json_encode(array("success"=>1,"url"=>$this->url));
						return false;
					}else{
						echo json_encode(array("success"=>0));
						return false;
					}
				}
			}
			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/qual_dep_view', $data);
		}
	
	}

/* End of file Emp_leave.php */
/* Location: ./application/controllers/hr/Emp_leave.php */