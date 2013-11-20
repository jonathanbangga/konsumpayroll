<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ranks extends CI_Controller {
	
	protected $theme;
	protected $sidebar_menu;
	
	public function __construct() {
		parent::__construct();
		$this->theme = $this->config->item('default');
		$this->menu = $this->config->item('add_company_menu');
		$this->sidebar_menu = $this->config->item('add_company_sidebar_menu');
		$this->authentication->check_if_logged_in();
		// load
		$this->load->model('hr_setup/ranks_model');	
		// default
		$this->comp_id = 6;
	}

	public function index(){
		$data['page_title'] = "Ranks";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		$data['ranks_sql'] = $this->ranks_model->get_ranks($this->comp_id);
		$this->layout->view('pages/hr_setup/ranks_view',$data);
	}

	public function ajax_add_rank(){
		$rank = $this->input->post('rank');
		$desc = $this->input->post('desc');
		foreach($rank as $index=>$val){
			$this->ranks_model->add_rank($val,$desc[$index],$this->comp_id);
		}
	}
	
	public function ajax_delete_rank(){
		$rank_id = $this->input->post('rank_id');
		echo $this->ranks_model->delete_rank($rank_id);
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */