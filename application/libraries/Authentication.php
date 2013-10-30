<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication {

	protected $ci;

	public function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->model('account_model');
    }

    public function validate_login($user,$pass,$account_type){
		$sql = $this->ci->account_model->get_account($user,$pass,$account_type);
		// admin
		if($account_type==1){
			// if account exist
			if($sql->num_rows()>0){
				$a = $sql->row();
				$newdata = array(
                   'account_id'  => $a->account_id
				);
				$this->ci->session->set_userdata($newdata);
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
				$this->ci->session->set_userdata($newdata);
				redirect('/konsum/company/dashboard');
			}else{
				redirect('/');
			}	
		}
    }
	
	public function check_if_logged_in(){
		$account = $this->ci->session->userdata('account_id');
		if(!$account){
			redirect('/login/access_denied');
		}
	}
	
	public function logout(){
		$this->ci->session->unset_userdata('account_id');
		$this->ci->session->sess_destroy();
		redirect('/');
	}
	
}

/* End of file Someclass.php */