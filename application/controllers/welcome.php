<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


<<<<<<< HEAD
class Welcome extends CI_Controller {
	
	public function __construct() {
		parent::__construct();;
	}

	public function test(){
		echo "hello";
=======
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
		//echo $a+$b;
	}
	
	public function test($a,$b){
		echo $a+$b;
>>>>>>> ffdc59abc5f683ceaeb48d0edcacd562ab63872b
	}
	
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
