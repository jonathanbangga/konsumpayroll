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
				$this->ci->session->set_flashdata("error_denied","The email and password is invalid");
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
		$account_type_id = $this->ci->session->userdata("account_type_id");
		$uri_admin = $this->ci->uri->segment(1);
		# added by christopher cuizon updated on jc code
		if($account=="") redirect('/login/access_denied');
		switch($account_type_id):
			case "1": // admin
				return ($uri_admin == 'admin') ? true : redirect('/login/access_denied');
			break;
			case "2":
				if($uri_admin == 'admin') redirect('/login/access_denied'); #wtf dong you are not invited
			break;			
		endswitch;	
		# this functions enable to check if the person is trying to play our security defenses therefore we must check if the data is really valid and let her in if its true otherwise then redirect to access denied
		if($this->ci->uri->segment(2) == "dashboard" && $this->ci->uri->segment(3) == "company_list"){
			$letme_in = $this->ci->account_model->dashboard_access($this->ci->session->userdata('psa_id'),trim($this->ci->uri->segment(1)));
			($letme_in->result == 0) ? redirect('/login/access_denied') : '';
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
		
		if($this->ci->uri->segment(2) == "employee" || $this->ci->uri->segment(1) == ""){
			// for hr or owner
			if($account != ""){
				if($check_employee == '3' || $check_employee == '2'){
					$sub_domain = $this->ci->session->userdata('sub_domain');
					redirect("/{$sub_domain}/dashboard/company_list");
				}
			}
		}
	}
	
}

/* End of file Someclass.php */