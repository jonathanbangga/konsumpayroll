<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	protected $theme;
	
	public function __construct() {
		parent::__construct();
		$this->theme = $this->config->item('login_template');
	}

	public function index(){
		$data['page_title'] = "Login";
		$this->layout->set_layout($this->theme);
		$this->layout->view('login_view',$data);
	}
	
	public function validate_login($account_type){
		$user = $this->input->post('user');
		$pass = $this->input->post('pass');
		$this->authentication->validate_login($user,$pass,$account_type); 
	
	}
	
	public function admin(){
		$this->load->view('pages/admin/login_view');
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