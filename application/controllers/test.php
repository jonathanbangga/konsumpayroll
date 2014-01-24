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
	
	public function iemail(){
		$this->load->library('email');
		$this->email->from('christopher.cuizon@techgrowthglobal.com', 'Your Name');
		$this->email->to('christopher.cuizon@techgrowthglobal.com');
		$this->email->cc('christopher.cuizon@techgrowthglobal.com');
		$this->email->bcc('christopher.cuizon@techgrowthglobal.com');
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');
		$this->email->send();
		echo $this->email->print_debugger();
	}
	
	public function destroy(){
		$this->session->all_userdata();
	}
	
	
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */