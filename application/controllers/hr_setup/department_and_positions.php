<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department_and_positions extends CI_Controller {
	
	protected $theme;
	protected $sidebar_menu;
	
	public function __construct() {
		parent::__construct();
		// menu and authentication
		$this->theme = $this->config->item('default');
		$this->menu = 'content_holders/company_menu';	
		$this->sidebar_menu = 'content_holders/hr_setup_sidebar_menu';
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
		$this->layout->view('pages/hr_setup/department_and_positions_view',$data);
	}

	public function ajax_get_positions(){
		$dept_id = $this->input->post('dept_id');
		$dept_name = $this->input->post('dept_name');
		$pos = $this->department_and_positions_model->get_positions($dept_id);
		$str = "";
		if($pos->num_rows()>0){
			$str = '
			<li class="li'.$dept_id.' li_dept">
			  <input type="hidden" name="dept_id" class="dept_id" value="'.$dept_id.'" />
			  <header>'.$dept_name.'</header>
			  <div class="dept-box">
				<ul>';
					foreach($pos->result() as $row){ 
					$str .= '
						<li>
							<label>
								<input class="right" name="" type="checkbox" value="'.$row->position_id.'">
								'.$row->position_name.'
							</label>
						</li>';	  
					}
				$str .= '</ul>
			  </div>
			  <a class="add-more-pos btn" href="javascript:void(0);">ADD POSITION</a> 
			</li>
			';
		}
		echo $str;
	}
	
	public function ajax_add_department(){
		$dept_name = $this->input->post('dept_name');
		echo $this->department_and_positions_model->add_department($dept_name);
	}
	
	public function ajax_add_position(){
		$pos = $this->input->post('pos');
		$dept_id = $this->input->post('dept_id');
		echo $this->department_and_positions_model->add_position($pos,$dept_id);
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */