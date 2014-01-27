<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Credentials extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function change_pass(){
		$data['page_title'] = "Login";
		$this->layout->set_layout('login_template');
		$this->layout->view('changepass_view',$data);
	}
	
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */