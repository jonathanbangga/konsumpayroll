<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication {

	protected $ci;

	public function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->model('account_model');
		$this->check_employee();
    }

    public function validate_login($user,$pass,$account_type){
	
		$sql = $this->ci->account_model->get_account($user,$pass,$account_type);
		
		// admin
		if($account_type==1){
			// if account exist
			if($sql->num_rows()>0){
				$a = $sql->row();
				$newdata = array(
                   'account_id'  => $a->main_account_id,
				   'account_type_id'  => $a->account_type_id
				);
				$this->ci->session->set_userdata($newdata);
				redirect('/admin/dashboard');
			}else{
				redirect('/login/admin');
			}
		// user
		}else{
			if($sql->num_rows()>0){
				$a = $sql->row();
				$newdata = array(
                   'account_id'  => $a->main_account_id,
				   'account_type_id'  => $a->account_type_id,
				   'psa_id'  => $a->payroll_system_account_id,
				   'user_type_id' => $a->user_type_id,
				   'sub_domain' => $a->main_sub_domain,
				   'company_name' => $a->company_name,
				   'emp_id'=>$a->emp_id
				);
				if($a->user_type_id == 3 || $a->user_type_id == 2){
					// redirect owner or hr
					$this->ci->session->set_userdata($newdata);
					redirect("/{$a->main_sub_domain}/dashboard/company_list");
				}elseif($a->user_type_id == 5){
					// redirect employee
					$this->ci->session->set_userdata($newdata);
					redirect("/{$a->company_name}/employee/emp_time_in");
				}
			}else{
				redirect('/');
			}
			
			/*
			// if account exist
			if($sql->num_rows()>0){
				$a = $sql->row();
				$newdata = array(
                   'account_id'  => $a->main_account_id,
				   'account_type_id'  => $a->account_type_id,
				   'psa_id'  => $a->payroll_system_account_id,
				   'user_type_id' => $a->user_type_id,
				   'sub_domain' => $a->sub_domain
				);
				$this->ci->session->set_userdata($newdata);
				redirect("/{$a->sub_domain}/dashboard/company_list");
			}else{
				redirect('/');
			}	
			*/
		}
    }
	
	public function check_if_logged_in(){
		$account = $this->ci->session->userdata('account_id');
		if($account==""){
			redirect('/login/access_denied');
		}
	}
	
	public function logout(){
		$account_type_id = $this->ci->session->userdata('account_type_id');
		if($account_type_id==1){
			$this->destroy_session();
			redirect('/login/admin');
		}else{
			$this->destroy_session();
			redirect('/');
		}	
	}
	
	public function destroy_session(){
		$this->ci->session->unset_userdata('account_id');
		$this->ci->session->unset_userdata('account_type_id');
		$this->ci->session->unset_userdata("user_type_id");
		$this->ci->session->unset_userdata("psa_id");
		$this->ci->session->unset_userdata("company_id");
		$this->ci->session->sess_destroy();
	}
	
	public function check_employee(){
		$account = $this->ci->session->userdata('account_id');
		$check_employee = $this->ci->account_model->check_employee($account);
		if($this->ci->uri->segment(2) == "hr" || $this->ci->uri->segment(1) == "" || $this->ci->uri->segment(2) == "dashboard"){
			// for employee
			if($check_employee == 5 && $account != ""){
				$company_name = $this->ci->session->userdata('company_name');
				redirect("/{$company_name}/employee/emp_time_in");
			}
		}
	}
	
}

/* End of file Someclass.php */