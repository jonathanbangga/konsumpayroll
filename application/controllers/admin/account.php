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

class Account extends CI_Controller {

	var $theme;

	public function __construct() {
		parent::__construct();
		$this->theme = $this->config->item('temp_company_wizard');
		$this->authentication->check_if_logged_in();	
	}

	public function index()
	{		
		$data['page_title'] = "Account";
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/admin/account_view', $data);	
		//echo "test";
	}
	
	public function test($a,$b){
		echo $a+$b;
	}
	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */