<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exclude_list extends CI_Controller {
	
	protected $theme;
	protected $sidebar_menu;
	
	public function __construct() {
		parent::__construct();
		// menu and authentication
		$this->theme = $this->config->item('default');
		$this->menu = 'content_holders/user_hr_owner_menu';
		$this->sidebar_menu = $this->config->item('payroll_run_sidebar_menu');
		$this->authentication->check_if_logged_in();
		// load
		$this->load->model('payroll_run/exclude_list_model');	
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Exclude list";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		
		// data
		// pagination settings
		$config['base_url'] = "/{$this->session->userdata('sub_domain2')}/payroll_run/exclude_list/index";
		$config['total_rows'] = $this->exclude_list_model->get_employee()->num_rows(); // all results
		$config['per_page'] = 2; // per page
		$config['uri_segment'] = 5; //page number
		
		// pagination mark up
		$config['prev_link'] = 'Previous';
		$config['next_link'] = 'Next';	    
	    $config['full_tag_open'] = '<ul id="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="next">';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a class="btn">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		// intiatalize and create pagination links
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// offset and limit for query
		$offset = ($this->uri->segment($config['uri_segment'])=="")?0:$this->uri->segment($config['uri_segment']);
		$per_page = $config['per_page'];
		$data['emp_sql'] = $this->exclude_list_model->get_employee($offset,$per_page);
		
		$this->layout->view('pages/payroll_run/exclude_list_view',$data);
	}
	
	public function ajax_add_exclude_list(){
		$el_id = $this->input->post('el_id');
		$emp_id = $this->input->post('emp_id');
		$exclude = $this->input->post('exclude');
		$on_hold = $this->input->post('on_hold');
		$reasons = $this->input->post('reasons');
		
		// delete from exclude list
		if($exclude==0&&$on_hold==0&&$el_id!=""){
			$this->exclude_list_model->delete_exclude_list($el_id,$exclude,$on_hold,$reasons);
		}else if($el_id!=""){
			$this->exclude_list_model->update_exclude_list($el_id,$exclude,$on_hold,$reasons);
		}else if($el_id==""){
			$this->exclude_list_model->add_exclude_list($emp_id,$exclude,$on_hold,$reasons);
		}
		
	}
	
}

/* End of file */