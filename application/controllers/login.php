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
		$user = $this->input->post('user');
		$pass = md5(mysql_real_escape_string($this->input->post('pass')));
		$this->authentication->validate_login($user,$pass,$account_type); 
	}
	
	public function admin(){
		$data['page_title'] = "Login";
		$this->layout->set_layout('admin_login_template');
		$this->layout->view('pages/admin/login_view',$data);
	}
	
	public function logout(){
		$this->authentication->logout();
	}
	
	public function access_denied(){
		echo "ACCESS DENIED!!!!";
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */