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
		$this->num_pagi = 4;
		$this->all_user = "/admin/users/all_users/";
		$this->admin_url = "/admin/users/all_admin";
		$this->load->helper('email');
		$this->load->library('parser');
		$this->load->helper('string');
		$this->authentication->check_if_logged_in();	
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
				$user_item = $this->users_model->get_admin_fulldetails($this->input->post("admin_id"));
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
	
	public function add_admin_users(){
		if($this->input->is_ajax_request()){
			if($this->input->post('add')){
				$this->form_validation->set_rules('name','name','xss_clean|trim|required');
				$this->form_validation->set_rules('username','username','xss_clean|trim|required|is_unique[accounts.payroll_cloud_id]');
				$this->form_validation->set_rules('email_address','Email Address','xss_clean|valid_email|trim|required|[accounts.email]');
				$this->form_validation->set_rules('password','Password','xss_clean|trim|required|matches[cpassword]|min_length[8]|max_length[18]');
				$this->form_validation->set_rules('cpassword','Confirm Password','xss_clean|trim|required');
				if($this->form_validation->run() == true){				
					$email = $this->db->escape_str($this->input->post('email_address'));			
					$account_field = array(
							"payroll_cloud_id" => $this->input->post('username'),
							"account_type_id"  => 1, // BECAUSE 1= ADMIN 2= USER ( EMPLOYEE,USER)
							"user_type_id"	   => 1, // 1=admin 2=owner 3=hr 4=accountant
							"email"			   => $email,
							"password"		   => $this->db->escape_str(md5($this->input->post('password'))),
							"deleted"		   => '0'
					);	
					$account_id = $this->users_model->add_data_fields("accounts",$account_field);			
					if($account_id){
						$konsum_admin_field = array(
							"name"			=> $this->db->escape_str($this->input->post('name')),
							"account_id" 	=> $account_id 
						);	
						$this->users_model->add_data_fields("konsum_admin",$konsum_admin_field);	
					}
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
	 * ADDS ADMIN MULTIPLE INPUT
	 * @return JSON AJAX
	 */
	public function add_admin(){
		if($this->input->post('save_user')){
			$name = $this->input->post('name');
			$user_name = $this->input->post("username");
			if($name){
				foreach($name as $key=>$val):
					$this->form_validation->set_rules("name[{$key}]","Name","required|trim|xss_clean");
					$this->form_validation->set_rules("username[{$key}]","Username","required|trim|xss_clean|is_unique[accounts.payroll_cloud_id]|min_length[8]|max_length[20]|alpha_numeric");
				endforeach;
				if($this->form_validation->run() == true){
					foreach($name as  $key=>$val){
						//ADD FIRST IN ACCOUNT
						$account_field = array(
							"payroll_cloud_id" => $user_name[$key],
							"account_type_id"  => 1, // BECAUSE 1= ADMIN 2= USER ( EMPLOYEE,USER)
							"user_type_id"	   => 1, // 1=admin 2=owner 3=hr 4=accountant
							"password"		   => md5(idates_now()),
							"deleted"		   => '0'
						);	
						$account_id = $this->users_model->add_data_fields("accounts",$account_field);	
						// ADD IN KONSUM ADMIN ACCOUNT
						if($account_id){
							$konsum_admin_field = array(
								"name"			=> $this->db->escape_str($val),
								"account_id" 	=> $account_id 
							);	
							$this->users_model->add_data_fields("konsum_admin",$konsum_admin_field);	
						}
					}	
					echo json_encode(array("success"=>"1","error"=>""));
					return false;
				}else{
					$error = validation_errors('<span class="error_zone">','</span>');
					echo json_encode(array("success"=>"0","error"=>$error));
					return false;
				}
			}
		}
	}
	
	public function update_users() {
		if($this->input->is_ajax_request()) {
			if($this->input->post('update')) {
				$this->form_validation->set_rules('edit_name','name','xss_clean|trim|required');
				$this->form_validation->set_rules('edit_email','Email Address','xss_clean|valid_email|trim|required|callback_update_user_email_check');
				$this->form_validation->set_rules('edit_old_email','Email Address','xss_clean|valid_email|trim|required');
				$this->form_validation->set_rules('edit_account_id','Account ID','xss_clean|trim|required'); 
			
				if($this->form_validation->run() == true) {	
					// UPDATE ACCOUNTS
					$account_id = $this->db->escape_str($this->input->post('edit_account_id'));
					$fields = array(
								"email"			=> $this->input->post('edit_email'),
								"password"		=> 'tetew'
					);
					$this->users_model->update_data_fields("accounts",$fields,array("account_id"=>$account_id));					
					// UPDATE COMPANY OWNER NAME
					$company_owner_field = array(
								"owner_name"	=> $this->input->post("edit_name")
					);
					$where_company = array("account_id"=>$account_id);
					$this->users_model->update_data_fields("company_owner",$company_owner_field,$where_company);
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
				$this->form_validation->set_rules('accounts_id','Admin id','xss_clean|trim|required');
				$this->form_validation->set_rules('edit_username','username','xss_clean|trim|required|callback_admin_username_update_check');
				$this->form_validation->set_rules('edit_email','Email Address','xss_clean|valid_email|trim|required|callback_check_email');
				$this->form_validation->set_rules('edit_old_email','Email Address','xss_clean|valid_email|trim'); 
				if($this->form_validation->run() == true) {
					$account_id = $this->db->escape_str($this->input->post('accounts_id'));	
					$email = $this->db->escape_str($this->input->post('edit_email'));
					// UPDATE ACCOUNTS OF KONSUM ADMIN
					$account_field = array(
							"payroll_cloud_id" => $this->input->post('edit_username'),
							"email"			   => $email,
							"password"		   => md5($this->input->post('edit_password')),
					);	
					$this->users_model->update_data_fields("accounts",$account_field,array("account_id"=>$account_id));	
					// UPDATES ACCOUNTS ON KONSUM ADMIN
					$konsum_admin_field = array("name"	=> $this->input->post('edit_name'));	
					$this->users_model->update_data_fields("konsum_admin",$konsum_admin_field,array("account_id"=>$account_id));	
					// RETURNS JSON SUCCESS ELSE FALSE	
					echo json_encode(array("error_msg"=>'',"success"=>"1"));		
				} else {
					echo json_encode(array("error_msg"=>validation_errors('<span class="error_zone">','</span>'),"success"=>"0"));
				}
			}
		} else {
			show_404();
		}
	}

	
	/**
	 * CALL BACK WHEN UPDATING ADMIN 
	 * check if email is valid
	 * @param string $str
	 */
	public function check_email($str){
		$old_email = $this->input->post("edit_old_email");
		if($old_email !=""){
			$sql = "SELECT a.account_id,a.payroll_cloud_id,a.email,ka.name
					FROM `accounts` a
					LEFT JOIN konsum_admin ka on ka.account_id = a.account_id
					WHERE a.account_type_id = 1 and a.user_type_id = 1 AND a.email = '{$str}' AND email NOT IN('{$this->db->escape_str($old_email)}')";
			$query = $this->db->query($sql);
			$row = $query->row();
			$query->free_result();
			if($row){
				$this->form_validation->set_message("check_email","Email address is already in used");
				return false;
			}else{
				return true;
			}	
		}else{
			$sql = "SELECT a.account_id,a.payroll_cloud_id,a.email
					FROM `accounts` a WHERE a.email = '{$str}'";
			$query = $this->db->query($sql);
			$row = $query->row();
			$query->free_result();
			if($row){
				$this->form_validation->set_message("check_email","Email address is already in used");
				return false;
			}else{
				return true;
			}
		}
	}
	
	/**
	 * UPDATE CHANGE PASSWORD ADMIN
	 * @return json
	 */
	public function update_change_pass_admin(){
		if($this->input->post("update")){
			$this->form_validation->set_rules("editpass_accountid","Account ID","required|trim|xss_clean|is_numeric");			 
			if($this->form_validation->run() == true){
				$we = $this->sendmail_admin_password($this->input->post('editpass_accountid'));
				echo json_encode(array("error"=>'',"success"=>"1","tetew"=>$we));	
				return false;
			}else{
				echo json_encode(array("error"=>validation_errors('<span class="error_zone">','</span>'),"success"=>"0"));
				return false;
			}
		}
	}
	
	/**
	 * SENDS EMAIL ON ADMIN RECOVERY
	 * Enter description here ...
	 * @param int $id
	 */
	public function sendmail_admin_password($id){
		$this->load->library('email');
		$details = $this->users_model->get_admin_fulldetails($id);
		$data['admin_email'] = "website.qa.pro@gmail.com";
		$data['email'] 	= $details->email;
		$data['token'] 	= $details->token;
		$data['page_title'] = "RECOVERY PASSWORD";
		$data['name'] 	= $details->name;
		$this->email->from($data['admin_email'], 'Admin Recovery Password');
		$this->email->to($data['email']);
		$this->email->cc($data['admin_email']);
		$this->email->subject($data['page_title']);
		$email_data = $this->parser->parse("pages/admin/send_recovery_password_view",$data);
		$this->email->message($email_data);
		$this->email->send();	
	}
	
	
	/** END CALLBACK **/
	
	/**
	 * DELETE ADMIN USERS 
	 * @return json response
	 */
	public function delete_admin_user() {
		if($this->input->is_ajax_request()) {
			if($this->input->post('delete')) {
				$this->form_validation->set_rules("admin_id","user","xss_clean|trim|required");
				if($this->form_validation->run()) {
					$check_admin = $this->users_model->select_admin_user($this->input->post("admin_id"));
					if($check_admin){
						$fields = array(
								"deleted" 	=>"1",
								"status" 	=>"Inactive"
						);
						$this->users_model->update_data_fields("konsum_admin",$fields,array("konsum_admin_id"=>$this->input->post("admin_id")));
						$this->users_model->update_data_fields("accounts",array("deleted"=>"1"),array("user_type_id"=>"1","account_type_id"=>"1","account_id"=>$check_admin->account_id));
					}
				}else{
					echo json_encode(array("error_msg"=>validation_errors('<span class="error_zone">','</span>'),"success"=>"0"));
				}
			}
		}else{
			show_404();
		}
	}
	
	/**
	 * 
	 * Delete users 
	 */
	public function delete_user() {
		if($this->input->is_ajax_request()) {
			if($this->input->post('delete')) {
				$this->form_validation->set_rules("company_owner_id","user","xss_clean|trim|required");
				if($this->form_validation->run()) {
					$check_user = $this->users_model->single_company_owner($this->input->post('company_owner_id'));
					if($check_user){ // CHECK THE USER IF VALID
						$fields = array("status"=>"Inactive","deleted" =>"1");	
						$fields_accounts = array( "deleted"=>"1" );	
						$this->users_model->update_data_fields("accounts",$fields_accounts,array("account_id"=>$check_user->account_id));
						$this->users_model->update_data_fields("payroll_system_account",array("status"=>"Inactive"),array("payroll_system_account_id"=>$check_user->payroll_system_account_id));
					}
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
	
	/**
	 * 
	 * CAll backs on updating users email 
	 * @param int $str (email address)
	 * @return callbacks
	 */
	public function update_user_email_check($str){
		$old_email = $this->input->post('edit_old_email');
		$query = $this->db->query("SELECT * from accounts WHERE email ='{$this->db->escape_str($str)}' AND NOT email = '{$old_email}'");
		$row = $query->row();
		if($row){
			$this->form_validation->set_message("update_user_email_check","The email address is already in use");
			return false;
		}else{
			return true;
		}
	}
	
	/**
	 * ADD OWNERS FOR ADMIN
	 * RETURNS OBJECT FOR AJAX PURPOSES
	 */
	public function add_owners(){
		if($this->input->is_ajax_request()){
			if($this->input->post('add_owner')){
				$this->form_validation->set_rules('owners_name[]',"Owners name","required|callback_check_owners_name|trim|xss_clean|callback_check_owners_name");
				$this->form_validation->set_rules('owners_email[]',"Email address","valid_email|required|trim|xss_clean|callback_check_owners_email");
				if($this->form_validation->run() == false){				
					echo json_encode(array("error"=>validation_errors("<span class='errors'>","</span>"),"success"=>"0"));
					return false;
				}else{
					$on = $this->input->post('owners_name');
					foreach($on as $key=>$val):
						$owners_name =  $val;
						$owners_current_email  =  $this->input->post('owners_email');
						$owners_email = $owners_current_email[$key];		
						// save the company owner
						$this->users_model->save_owners($owners_name,$owners_email);
					endforeach;
					echo json_encode(array("error"=>"","success"=>"1"));
					return false;
				}	
			}
		}else{
			show_404();
		}
	}
	
	/**
	 * CAllback on adding a user on OWNER
	 * @return callbacks checking files
	 */
	public function check_owners_name() {
		$flag = "";
		foreach($this->input->post('owners_name') as $key=>$val):
			if($val == "") $flag++;
		endforeach;
		if($flag ==""){
			return true;
		}else{
			$this->form_validation->set_message("check_owners_name","The Owners name field is required.");
			return false;
		}
	}
	
	/**
	 * CALLBACK ADDING OWNERS EMAIL CHECKING IF EMAILS ALREADY IN USED OR NOT
	 * @return callback
	 */
	public function check_owners_email(){
		$old_email = $this->input->post('edit_old_email');
		$flag = "";
		$flag_exist_email = "";
		$email_exists = array();
		foreach($this->input->post('owners_email') as $key=>$val):
			if($val != ""){
				$query = $this->db->query("SELECT * from accounts WHERE email ='{$this->db->escape_str($val)}' and deleted='0'");
				$row = $query->num_rows();
				$result = $query->row();
				$query->free_result();
				if($row){
					$email_exists[] = $result->email;
					$flag_exist_email++;
				}
			}else{
				$flag++;
			} 
		endforeach;
		if($flag > 0){	
			$this->form_validation->set_message("check_owners_email","The Email Address is requireds.");
			return false;
		}
		if($flag_exist_email > 0){
			$exist_now = implode(",",$email_exists);
			$this->form_validation->set_message("check_owners_email","The Email Address is already in used. ie(".$exist_now.")");
			return false;
		}
		if($flag =="" && $flag_exist_email ==""){
			return TRUE;
		}
	}
	
	/**
	 * 
	 * Callbacks Checks admin usersname
	 * @param string $str
	 * @return callbacks
	 */
	public function admin_username_update_check($str){
		$old_username = $this->input->post("edit_username_old");
		$query = $this->db->query("SELECT * from accounts WHERE  payroll_cloud_id ='{$this->db->escape_str($str)}' AND NOT payroll_cloud_id='{$old_username}'");
		$row = $query->row();
		if($row){
			$this->form_validation->set_message("admin_username_update_check","The username is already in use");
			return false;
		}else{
			return true;
		}
	}
	
	/**
	 * 
	 * Checks admin username
	 * @param string $str
	 * @return callbacks
	 */
	public function admin_username_check($str){
		$old_username = $this->input->post("edit_username_old");
		$query = $this->db->query("SELECT * from accounts WHERE payroll_cloud_id ='{$this->db->escape_str($str)}'");
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