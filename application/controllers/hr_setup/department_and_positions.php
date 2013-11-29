<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department_and_positions extends CI_Controller {
	
	protected $theme;
	protected $sidebar_menu;
	
	public function __construct() {
		parent::__construct();
		// menu and authentication
		$this->theme = $this->config->item('default');
		$this->menu = $this->config->item('add_company_menu');
		$this->sidebar_menu = $this->config->item('hr_setup_sidebar_menu');
		$this->authentication->check_if_logged_in();
		// load
		$this->load->model('hr_setup/department_and_positions_model');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Department & Positions";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		$data['departments'] = $this->department_and_positions_model->get_departments();
		$data['sel_dept'] = $this->department_and_positions_model->get_distinct_department();
		$this->layout->view('pages/hr_setup/department_and_positions_view',$data);
	}

	public function ajax_get_positions(){
		$dept_id = $this->input->post('dept_id');
		$dept_name = $this->input->post('dept_name');
		$pos = $this->department_and_positions_model->get_positions($dept_id);
		echo $pos->num_rows();
	}
	
	public function ajax_add_department(){
		$dept_name = $this->input->post('dept_name');
		// return the department ID added
		$temp = "";
		foreach($dept_name as $val){
			$dept_id = $this->department_and_positions_model->add_department($val);
			// get that specific department via department id
			$sql_dept = $this->department_and_positions_model->get_departments($dept_id);
			
			if($sql_dept->num_rows()>0){
				$row = $sql_dept->row();
				$temp .= '<li class="li_dept">
							<label>
								<input class="dept_id right" name="dept_id[]" type="checkbox" value="'.$row->dept_id.'">
								<span class="dept_name">'.$row->department_name.'</span>
							</label>
						</li>';	
			}
		}
		echo $temp;
	}
	
	public function ajax_add_position(){
		$pos = $this->input->post('pos');
		$dept_id = $this->input->post('dept_id');
		$arr = array();
		foreach($pos as $val){
			// return the position ID added
			$pos_id = $this->department_and_positions_model->add_position($val,$dept_id);
			// get that specific position via department id
			$sql_pos = $this->department_and_positions_model->get_positions($dept_id,$pos_id);
			
			if($sql_pos->num_rows()){
				$row = $sql_pos->row();
				$arr[] = array(
						"department"=>$row->department_name,
						"dept_id"=>$row->dept_id,
						"pos_id"=>$row->position_id,
						"position"=>$row->position_name
					);
		
			}
		}
		echo json_encode($arr);
	}
	
	public function ajax_assign_department_and_position(){
		$dept_id = $this->input->post('dept_id');
		$pos_id = $this->input->post('pos_id');
		$this->department_and_positions_model->assign_selected_position($dept_id,$pos_id);
	}
	
	public function ajax_unassign_department_and_position(){
		$pos_id = $this->input->post('pos_id');
		$this->department_and_positions_model->unassign_positions($pos_id);
	}
	
	public function ajax_delete_department(){
		$dept_id = $this->input->post('dept_id');
		$this->department_and_positions_model->delete_department($dept_id);
	}
	
	public function ajax_delete_position(){
		$pos_id = $this->input->post('pos_id');
		$this->department_and_positions_model->delete_position($pos_id);
	}
	
	public function ajax_update_department(){
		$dept_id = $this->input->post('dept_id');
		$dept_name = $this->input->post('dept_name');
		$this->department_and_positions_model->update_department($dept_id,$dept_name);
	}
	
	public function ajax_update_position(){
		$pos_id = $this->input->post('pos_id');
		$pos_name = $this->input->post('pos_name');
		$this->department_and_positions_model->update_position($pos_id,$pos_name);
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */