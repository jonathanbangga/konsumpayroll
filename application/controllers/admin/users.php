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
		$this->segment_url = 3;
		$this->num_pagi = 20;
		$this->dashboard = "/admin/users/";
	}

	public function index()
	{		
		redirect("admin/users/all_users");
	}
	
	public function all_users(){
		$data['page_title'] = "Users";
		$total_rows = $this->users_model->count_activity_logs();
		$get_pagi = init_pagination($this->dashboard,$total_rows,$this->num_pagi,$this->segment_url);
		$pagi_url = $this->uri->segment(4) == "" ?  0 : $this->uri->segment(4);
		$data['logs'] = $this->users_model->fetch_activity_logs($get_pagi['per_page'],intval($pagi_url));
		p($data['logs']);
		$data['pagi'] = $this->pagination->create_links();
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/admin/users_view', $data);	
	}
	
	
	
	public function logs(){
		$value = sprintf(lang("last_login"),"administrator");
		add_activity($value,"admin");
	}
	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */