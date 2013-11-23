<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function index(){
		echo "<pre>";
		print_r($this->session->all_userdata());
		echo "</pre>";
	}
	
	
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */