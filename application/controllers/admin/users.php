<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * Admin Dashboard
 *
 * @subpackage Admin Dashboard
 * @category Controller
 * @version 1.0
 * @copyright Copyright (c) 2013, Konsum Technologies Inc.
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */

class Users extends CI_Controller {

	var $theme;
	var $segment_url;
	var $num_pagi;
	var $dashboard;
	
	public function __construct() {
		parent::__construct();
		$this->theme = $this->config->item('temp_admin');
		$this->load->model("admin/users_model");
		$this->segment_url = 4;
		$this->num_pagi = 5;
		$this->dashboard = "/admin/users/all_users/";
	}

	public function index()
	{		
		redirect("admin/users/all_users");
	}
	
	public function all_users(){
		$data['page_title'] = "Users"; 
		$total_rows = $this->users_model->count_activity_logs();
		$get_pagi = init_pagination($this->dashboard,$total_rows,$this->num_pagi,$this->segment_url);
		$pagi_url = $this->uri->segment(4) == "" ?  0 : $this->uri->segment(4);
		$data['client_user'] = $this->users_model->fetch_activity_logs($get_pagi['per_page'],intval($pagi_url));
		$data['pagi'] = $this->pagination->create_links();
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/admin/users_view', $data);	
	}
	
	public function all_admin(){
		$data['page_title'] = "Admin"; 
		$total_rows = $this->users_model->count_admin();
		$get_pagi = init_pagination($this->dashboard,$total_rows,$this->num_pagi,$this->segment_url);
		$pagi_url = $this->uri->segment(4) == "" ?  0 : $this->uri->segment(4);
		$data['client_user'] = $this->users_model->fetch_admin($get_pagi['per_page'],intval($pagi_url));
		$data['pagi'] = $this->pagination->create_links();
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/admin/users_view', $data);	
	}
	
	public function add_users(){
		if($this->input->is_ajax_request()){
			if($this->input->post('add')){
				$this->form_validation->set_rules('owner_name','Owner name','xss_clean|trim|required');
				$this->form_validation->set_rules('email_address','Email Address','xss_clean|valid_email|trim|required|callback_email_check');
				$this->form_validation->set_rules('password','Password','xss_clean|trim|required|matches[cpassword]|min_length[8]|max_length[12]');
				$this->form_validation->set_rules('cpassword','Confirm Password','xss_clean|trim|required');
				if($this->form_validation->run() == true){
					$fields = array(
								"owner_name" 	=> $this->db->escape_str($this->input->post('owner_name')),
								"email_address" => $this->db->escape_str($this->input->post('email_address')),
								"password"		=> $this->db->escape_str($this->input->post('password'))
							);
					$this->users_model->add_all_user($fields);
					echo json_encode(array("success"=>"1","error_msg"=>""));
				}else{
					$error = validation_errors('<span class="error_zone">','</span>');
					echo json_encode(array("success"=>"0","error_msg"=>$error));
				}
			}
		}else{
			show_404();
		}
	}
	
	/**
	*	Call back on email checking if it's already in used
	*	@param string $str
	*	@return string
	*/
	public function email_check($str){
		$query = $this->db->query("SELECT * from company_owner WHERE email_address ='{$this->db->escape_str($str)}'");
		$row = $query->row();
		if($row){
			$this->form_validation->set_message("email_check","The email address is already in use");
			return false;
		}else{
			return true;
		}
	}
	

}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */