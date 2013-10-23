<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('account_model');
	}

	public function index(){
		$this->load->view('login_view');
	}
	
	public function validate_login($account_type){
	
		$user = $this->input->post('user');
		$pass = $this->input->post('pass');
		$sql = $this->account_model->get_account($user,$pass,$account_type);
		
		// admin
		if($account_type==1){
		
			// if account exist
			if($sql->num_rows()>0){
				$a = $sql->row();
				$newdata = array(
                   'account_id'  => $a->account_id
				);
				$this->session->set_userdata($newdata);
				redirect('/admin/dashboard');
			}else{
				redirect('/login/admin');
			}
		
		// user
		}else{
		
			// if account exist
			if($sql->num_rows()>0){
				$a = $sql->row();
				$newdata = array(
                   'account_id'  => $a->account_id
				);
				$this->session->set_userdata($newdata);
				redirect('/konsum/hr/employee');
			}else{
				redirect('/');
			}
			
		}
		
	}
	
	public function admin(){
		$this->load->view('pages/admin/login_view');
	}
	
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */