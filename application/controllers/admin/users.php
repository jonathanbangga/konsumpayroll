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
	var $all_user;
	var $admin_url;
	
	public function __construct() {
		parent::__construct();
		$this->theme = $this->config->item('temp_admin');
		$this->load->model("admin/users_model");
		$this->segment_url = 4;
		$this->num_pagi = 5;
		$this->all_user = "/admin/users/all_users/";
		$this->admin_url = "/admin/users/all_admin";
	}

	public function index()
	{		
		redirect("admin/users/all_users");
	}
	
	public function all_users(){
		$data['page_title'] = "Users"; 
		$total_rows = $this->users_model->users_count_list();
		$config["base_url"] 	= $this->all_user;
        $config["total_rows"] 	= $total_rows;
        $config["per_page"] 	= $this->num_pagi;
        $config["uri_segment"] 	= $this->segment_url;
        $this->pagination->initialize($config);
		$pagi_url = $this->uri->segment(4) == "" ?  0 : $this->uri->segment(4);
		$data['client_user'] = $this->users_model->users_list($config['per_page'],intval($pagi_url));
		$data['pagi'] = $this->pagination->create_links();
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/admin/users_view', $data);	
	}
	
	public function all_admin(){
		$data['page_title'] = "Admin Users"; 
		$total_rows = $this->users_model->count_admin();
		$config["base_url"] 	= $this->admin_url;
        $config["total_rows"] 	= $total_rows;
        $config["per_page"] 	= $this->num_pagi;
        $config["uri_segment"] 	= $this->segment_url;
        $this->pagination->initialize($config);
		$pagi_url = $this->uri->segment(4) == "" ?  0 : $this->uri->segment(4);
		$data['client_user'] 	= $this->users_model->fetch_admin($config['per_page'],intval($pagi_url));
		$data['pagi'] = $this->pagination->create_links();
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/admin/admin_view', $data);	
	}	
	
	public function show_edit_admin() {
		if($this->input->is_ajax_request()) {
			if($this->input->post("update_edit")) {
				$this->form_validation->set_rules("admin_id","id","xss_clean|trim|required");
				if($this->form_validation->run() == false) {
					echo json_encode(validation_errors());
				} else {
				$user_item = $this->users_model->select_admin_user($this->input->post("admin_id"));
					echo json_encode($user_item);
				}
			}
		}else{
			show_404();
		}
	}

	public function show_edit_user() {
		if($this->input->is_ajax_request()) {
			if($this->input->post("update_edit")) {
				$this->form_validation->set_rules("admin_id","id","xss_clean|trim|required");
				if($this->form_validation->run() == false) {
					echo json_encode(validation_errors());
				} else {
					$user_item = $this->users_model->select_user($this->input->post("admin_id"));
					echo json_encode($user_item);
				}
			}
		}else{
			show_404();
		}
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
								"password"		=> $this->db->escape_str(md5($this->input->post('password')))
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
	
	public function add_admin_users(){
		if($this->input->is_ajax_request()){
			if($this->input->post('add')){
				$this->form_validation->set_rules('name','name','xss_clean|trim|required');
				$this->form_validation->set_rules('username','username','xss_clean|trim|required|callback_admin_username_check');
				$this->form_validation->set_rules('email_address','Email Address','xss_clean|valid_email|trim|required|callback_email_check');
				$this->form_validation->set_rules('password','Password','xss_clean|trim|required|matches[cpassword]|min_length[8]|max_length[18]');
				$this->form_validation->set_rules('cpassword','Confirm Password','xss_clean|trim|required');
				if($this->form_validation->run() == true){
					$fields = array(
								"name"		=> $this->db->escape_str($this->input->post('name')),
								"username" 	=> $this->db->escape_str($this->input->post('username')),
								"email_address" => $this->db->escape_str($this->input->post('email_address')),
								"password"		=> $this->db->escape_str(md5($this->input->post('password')))
							);
					$this->users_model->add_all_admin($fields);
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
	
	public function update_users() {
		if($this->input->is_ajax_request()) {
			if($this->input->post('update')) {
				$this->form_validation->set_rules('edit_name','name','xss_clean|trim|required');
				$this->form_validation->set_rules('edit_id','id','xss_clean|trim|required');
				$this->form_validation->set_rules('edit_email','Email Address','xss_clean|valid_email|trim|required|callback_update_user_email_check');
				$this->form_validation->set_rules('edit_old_email','Email Address','xss_clean|valid_email|trim|required');
				$this->form_validation->set_rules('edit_pass','Password','xss_clean|trim|required|matches[edit_cpass]|min_length[8]|max_length[18]');
				$this->form_validation->set_rules('edit_cpass','Confirm Password','xss_clean|trim|required'); 
				if($this->form_validation->run() == true) {	
				
					$fields = array(
								"owner_name" 	=> $this->db->escape_str($this->input->post('edit_name')),
								"email_address" => $this->db->escape_str($this->input->post('edit_email')),
								"password"		=> $this->db->escape_str(md5($this->input->post('edit_pass')))
							);
					$this->users_model->update_all_user($fields,$this->input->post('edit_id'));
					echo json_encode(array("error_msg"=>'',"success"=>"1","value"=>$fields));
				} else {
					echo json_encode(array("error_msg"=>validation_errors('<span class="error_zone">','</span>'),"success"=>"0"));
				}
			}
		} else {
			show_404();
		}
	}
	
	public function update_admin_users() {
		if($this->input->is_ajax_request()) {
			if($this->input->post('update')) {
				$this->form_validation->set_rules('edit_name','name','xss_clean|trim|required');
				$this->form_validation->set_rules('edit_id','id','xss_clean|trim|required');
				$this->form_validation->set_rules('edit_username','username','xss_clean|trim|required|callback_admin_username_check');
				$this->form_validation->set_rules('edit_email','Email Address','xss_clean|valid_email|trim|required|callback_admin_username_update_check');
				$this->form_validation->set_rules('edit_old_email','Email Address','xss_clean|valid_email|trim|required');
				$this->form_validation->set_rules('edit_password','Password','xss_clean|trim|required|matches[edit_cpassword]|min_length[8]|max_length[18]');
				$this->form_validation->set_rules('edit_cpassword','Confirm Password','xss_clean|trim|required'); 
				if($this->form_validation->run() == true) {	
					$fields = array(
								"name"		=> $this->db->escape_str($this->input->post('edit_name')),
								"username" 	=> $this->db->escape_str($this->input->post('edit_username')),
								"email_address" => $this->db->escape_str($this->input->post('edit_email')),
								"password"		=> $this->db->escape_str(md5($this->input->post('edit_password')))
							);
					$this->users_model->update_admin_user($fields,$this->input->post('edit_id'));
					echo json_encode(array("error_msg"=>'',"success"=>"1"));
				} else {
					echo json_encode(array("error_msg"=>validation_errors('<span class="error_zone">','</span>'),"success"=>"0"));
				}
			}
		} else {
			show_404();
		}
	}
	
	public function delete_admin_user() {
		if($this->input->is_ajax_request()) {
			if($this->input->post('delete')) {
				$this->form_validation->set_rules("admin_id","user","xss_clean|trim|required");
				if($this->form_validation->run()) {
					$this->users_model->delete_users_id("konsum_admin",array("konsum_admin_id"=>$this->input->post("admin_id")));
				}else{
					echo json_encode(array("error_msg"=>validation_errors('<span class="error_zone">','</span>'),"success"=>"0"));
				}
			}
		}else{
			show_404();
		}
	}
	
	public function delete_user() {
		if($this->input->is_ajax_request()) {
			if($this->input->post('delete')) {
				$this->form_validation->set_rules("admin_id","user","xss_clean|trim|required");
				if($this->form_validation->run()) {
					$fields = array(
								"status" => "Inactive",
								"deleted" => "1"
							);
					$this->users_model->disable_user($fields,$this->input->post('admin_id'));
				}else{
					echo validation_errors();
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
	
	public function update_user_email_check($str){
		$old_email = $this->input->post('edit_old_email');
		$query = $this->db->query("SELECT * from company_owner WHERE email_address ='{$this->db->escape_str($str)}' AND NOT email_address = '{$old_email}'");
		$row = $query->row();
		if($row){
			$this->form_validation->set_message("update_user_email_check","The email address is already in use");
			return false;
		}else{
			return true;
		}
	}
	
	public function admin_email_check($str){
		$old_email = $this->input->post("edit_old_email");
		$query = $this->db->query("SELECT * from konsum_admin WHERE email_address ='{$this->db->escape_str($str)}' AND NOT email_address = '{$old_email}'");
		$row = $query->row();
		if($row){
			$this->form_validation->set_message("admin_email_check","The email address is already in uses");
			return false;
		}else{
			return true;
		}
	}
	
	public function admin_username_update_check($str){
		$old_username = $this->input->post("edit_username_old");
		$query = $this->db->query("SELECT * from konsum_admin WHERE username ='{$this->db->escape_str($str)}' AND NOT username='{$old_username}'");
		$row = $query->row();
		if($row){
			$this->form_validation->set_message("admin_username_check","The username is already in use");
			return false;
		}else{
			return true;
		}
	}
	
	public function admin_username_check($str){
		$old_username = $this->input->post("edit_username_old");
		$query = $this->db->query("SELECT * from konsum_admin WHERE username ='{$this->db->escape_str($str)}'");
		$row = $query->row();
		if($row){
			$this->form_validation->set_message("admin_username_check","The username is already in use");
			return false;
		}else{
			return true;
		}
	}
	

}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */