<?php 
error_reporting(E_ALL);
ini_set( 'display_errors','1'); 
class Test extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library('parser');
		$this->load->library('email');
	}

	public function index(){
		echo "<pre>";
		print_r($this->session->all_userdata());
		echo "</pre>";
	}
	
	public function iemail(){	
		$data = array(
			"title"				=>"oh yeah",
			"page_content" 	=> "babay",
			"token"				=> "werdsfds",
			"page_title"		=> "Email",
			"full_name"		=> "christopher cuizon",
			"admin"				=> "Konsumpayroll"
		);
		$content = $this->parser->parse("email_test_view",$data);
		$this->email->clear();
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		$this->email->from('christopher.cuizon@techgrowthglobal.com', 'Your Name');
		$this->email->to('christophercuizons@gmail.com');
		$this->email->cc('christopher.cuizon@techgrowthglobal.com');
		$this->email->bcc('christopher.cuizon@techgrowthglobal.com');
		$this->email->subject('Email Test teste ');
		$this->email->message($content);
		$this->email->send();
		
	}
	
	public function destroy(){
		$this->session->all_userdata();
	}
	
	public function nemail(){
		$to  = 'christopher.cuizon@techgrowthglobal.com';
		$subject = 'the subject 13';
		$message = $this->emailthis();
		$headers = 'From: christophercuizons@gmail.com' . "\r\n" .
			'Reply-To: christophercuizons@gmail.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		$we = mail($to, $subject, $message, $headers);
		
	}
	
	public function e(){
		print_r(phpinfo());
	}
	
	public function emailthis(){	
		$data = array(
			"title"				=>"oh yeah",
			"page_content" 	=> "babay",
			"token"				=> "werdsfds",
			"page_title"		=> "Email",
			"full_name"		=> "christopher cuizon",
			"admin"				=> "Konsumpayroll"
		);
		$this->parser->parse("email_test_view",$data);
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */