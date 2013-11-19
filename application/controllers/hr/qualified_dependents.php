<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Qualified Dependents Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Qualified_dependents extends CI_Controller {
		
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
			$data['page_title'] = "201 File";
			$data['sidebar_menu'] = $this->sidebar_menu;
			
			$data['employee'] = $this->hr_emp->employee_list($this->company_id);
			
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
					$this->form_validation->set_rules('qual_dep', '', 'trim|required|xss_clean');
					$this->form_validation->set_rules('emp_id', '', 'trim|required|xss_clean');
					foreach($this->input->post('qual_dep') as $key=>$val){
						$this->hr_emp->delete_qual_depent($val,$this->input->post('emp_id'),$this->company_id);
					}
					
					$dep_id = $this->input->post('dep_id');
					$emp_id = $this->input->post('emp_id');
					$this->hr_emp->delete_qual_depent($dep_id,$emp_id,$this->company_id);
					$this->session->set_flashdata('message', '<p class="save_alert">Successfully deleted!</p>');
					echo json_encode(array("success"=>1));
					return false;
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
						$this->session->set_flashdata('message', '<p class="save_alert">Successfully updated!</p>');
						echo json_encode(array("success"=>1));
						return false;
					}else{
						echo json_encode(array("success"=>0));
						return false;
					}
				}
			}
			
			// add new dependent
			if($this->input->post('save_dep')){
				
				$this->form_validation->set_rules('emp_id', '', 'trim|required|xss_clean');
				$this->form_validation->set_rules('dept_name', '', 'trim|required|xss_clean');
				$this->form_validation->set_rules('dob', '', 'trim|required|xss_clean');
				
				$emp_id = $this->input->post('emp_id');
				$dept_name = $this->input->post('dept_name');
				$dob = $this->input->post('dob');
				
				foreach($this->input->post('dept_name') as $key=>$val){
					$insert_dependents = array(
						'emp_id' => $emp_id,
						'dependents_name' => $val,
						'dob' => $this->input->post('dob')[$key],
						'company_id' => $this->company_id
					);

					$sql_insert_dept = $this->jmodel->insert_data('employee_qualifid_dependents',$insert_dependents);
				}
				$this->session->set_flashdata('message', '<p class="save_alert">Successfully saved!</p>');
				redirect($this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3));
			}
			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/qual_dep_view', $data);
		}
	
	}

/* End of file sss_tbl.php */
/* Location: ./application/controllers/hr/sss_tbl.php */