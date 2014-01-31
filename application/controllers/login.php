<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function index(){
		$data['page_title'] = "Login";
		$this->layout->set_layout('login_template');
		$this->layout->view('login_view',$data);
	}
	
	public function validate_login($account_type){
		$user = mysql_real_escape_string($this->input->post('user'));
		$pass = md5(mysql_real_escape_string($this->input->post('pass')));
		$this->form_validation->set_rules("user","user","trim|xss_clean|required");
		$this->form_validation->set_rules("pass","password","trim|xss_clean|required");
		
		if($this->form_validation->run() == TRUE){
			$this->authentication->validate_login($user,$pass,$account_type); 
		}else{
			$this->session->set_flashdata("error_nofields","Required username and password");
		
			redirect("/");
		}
	}
	
	public function admin(){
		$data['page_title'] = "Login";
	
		if($this->session->userdata("account_id") !="" && $this->session->userdata("account_id") == 1) redirect('/admin/dashboard'); # added by bogart
		$this->layout->set_layout('admin_login_template');
		$this->layout->view('pages/admin/login_view',$data);
	}
	
	public function logout(){
		$this->authentication->logout();
	}
	
	public function access_denied(){
		show_error("ACCESS DENIED!!!!");
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */