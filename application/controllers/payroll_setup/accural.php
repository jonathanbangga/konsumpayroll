<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accural extends CI_Controller {
	
	protected $theme;
	protected $sidebar_menu;
	
	public function __construct() {
		parent::__construct();
		// menu and authentication
		// $this->theme = $this->config->item('default');
		$this->theme = "accural_template";
		$this->menu = $this->config->item('add_company_menu');
		$this->sidebar_menu = $this->config->item('payroll_setup_sidebar_menu');
		$this->authentication->check_if_logged_in();
		$this->url = "/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$this->uri->segment(4);
		// load
		$this->load->model('konsumglobal_jmodel','jmodel');
		$this->load->model('payroll_setup/accural_model','accural_model');
		
		$this->company_id = $this->session->userdata('company_id');
	}

	public function index(){
		// header and menu's
		$data['page_title'] = "Accural";
		$data['accural'] = $this->accural_model->my_accural($this->company_id);
		
		// add accural information
		if($this->input->post('save')){
			$this->form_validation->set_rules("name", 'Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules("item_one", 'Item 1', 'trim|required|xss_clean');
			$this->form_validation->set_rules("item_two", 'Item 2', 'trim|required|xss_clean');
			$this->form_validation->set_rules("item_three", 'Item 3', 'trim|required|xss_clean');
			$this->form_validation->set_rules("formula", 'Formula', 'trim|required|xss_clean');
			
			if ($this->form_validation->run()==true){
				$name = $this->input->post('name');
				$item_one = $this->input->post('item_one');
				$item_two = $this->input->post('item_two');
				$item_three = $this->input->post('item_three');
				$formula = $this->input->post('formula');
				
				$save_accural = array(
					"accural_name" => $name,
					"item_one" => $item_one,
					"item_two" => $item_two,
					"item_three" => $item_three,
					"formula" => $formula,
					"comp_id" => $this->company_id
				);
				
				$save_accural_sql = $this->jmodel->insert_data('accural', $save_accural);
				$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully saved!</div>');
				redirect($this->url);
			}
		}
		
		// update accural information
		if($this->input->post('update')){
			$this->form_validation->set_rules("accural_id", 'Accural ID', 'trim|required|xss_clean');
			$this->form_validation->set_rules("name_edit", 'Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules("item_one_edit", 'Item 1', 'trim|required|xss_clean');
			$this->form_validation->set_rules("item_two_edit", 'Item 2', 'trim|required|xss_clean');
			$this->form_validation->set_rules("item_three_edit", 'Item 3', 'trim|required|xss_clean');
			$this->form_validation->set_rules("formula_edit", 'Formula', 'trim|required|xss_clean');
			
			if ($this->form_validation->run()==true){
				$accural_id = $this->input->post('accural_id');
				$name = $this->input->post('name_edit');
				$item_one = $this->input->post('item_one_edit');
				$item_two = $this->input->post('item_two_edit');
				$item_three = $this->input->post('item_three_edit');
				$formula = $this->input->post('formula_edit');
				
				$update_accural_info = $this->accural_model->update_accural_info(
					$name,$item_one,$item_two,$item_three,$item_three,$formula,$accural_id,$this->company_id
				);
				
				if($update_accural_info){
					$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully updated!</div>');
					redirect($this->url);
					return false;
				}else{
					echo json_encode(array("success"=>0));
				}
			}
		}
		
		if($this->input->is_ajax_request()) {
			// delete accural information
			if($this->input->post('del_accural')){
				$accural_id = $this->input->post('accural_id');
				$del_accural = $this->accural_model->del_accural($accural_id,$this->company_id);
				if($del_accural){
					$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully deleted!</div>');
					echo json_encode(array("success"=>1,"url"=>$this->url));
					return false;
				}else{
					echo json_encode(array("success"=>0));
					return false;
				}
			}
			
			// get accural information
			if($this->input->post('edit_accural')){
				$accural_id = $this->input->post('accural_id');
				$get_accural = $this->accural_model->get_accural($accural_id,$this->company_id);
				if($get_accural){
					echo json_encode(array(
						"success"=>1,
						"accural_id"=>$get_accural->accural_id,
						"accural_name"=>$get_accural->accural_name,
						"item_one"=>$get_accural->item_one,
						"item_two"=>$get_accural->item_two,
						"item_three"=>$get_accural->item_three,
						"formula"=>$get_accural->formula
					));
					return false;
				}else{
					echo json_encode(array("success"=>0));
					return false;
				}
			}
		}
		
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		$this->layout->view('pages/payroll_setup/accural_view',$data);
	}
	
}

/* End of file */