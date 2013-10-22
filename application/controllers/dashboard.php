<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dashboard extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function index(){
		$this->load->view('dashboard_view');
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */