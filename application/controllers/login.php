<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('account_model');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index(){
		$this->load->view('login_view');
	}
	
	public function validate_login(){
		$user = $this->input->post('user');
		$pass = $this->input->post('pass');
		$sql = $this->account_model->get_account($user,$pass);
		// if account exist
		if($sql->num_rows()>0){
			$a = $sql->row();
			// admin
		/* 	if($a->account_type_id==1){
				redirect('/admin/dashboard');
			// users
			}else{
				redirect('/konsum/dashboard');
			} */
		}else{
			redirect('/');
		}
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */