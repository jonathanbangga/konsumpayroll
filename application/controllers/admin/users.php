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
	var $dashboard;
	
	public function __construct() {
		parent::__construct();
		$this->theme = $this->config->item('temp_company_wizard');
		$this->load->model("admin/users_model");
		$this->segment_url = 4;
		$this->num_pagi = 1;
		$this->dashboard = "/admin/users/all_users/";
	}

	public function index()
	{		
		redirect("admin/users/all_users");
	}
	
	public function all_users(){
		if($this->input->post('add')){
			$this->form_validation->set_rules('owner_name','Owner name','xss_clean|trim|required');
			$this->form_validation->set_rules('email_address','Email Address','xss_clean|valid_email|trim|required');
			$this->form_validation->set_rules('password','Password','xss_clean|trim|required|matches[cpassword]');
			$this->form_validation->set_rules('cpassword','Confirm Password','xss_clean|trim|required');
			
			if($this->form_validation->run()){
				echo 'we';
			}
		}

		
		$data['page_title'] = "Users"; 
		$total_rows = $this->users_model->count_activity_logs();
		$get_pagi = init_pagination($this->dashboard,$total_rows,$this->num_pagi,$this->segment_url);
		$pagi_url = $this->uri->segment(4) == "" ?  0 : $this->uri->segment(4);
		$data['client_user'] = $this->users_model->fetch_activity_logs($get_pagi['per_page'],intval($pagi_url));
		$data['pagi'] = $this->pagination->create_links();
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/admin/users_view', $data);	
	}
	

}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */