<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends CI_Controller {
	
	public function __construct() {
		parent::__construct();;
	}

	public function dashboard(){
		$this->load->view('admin/dashboard_view');
	}
	
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */