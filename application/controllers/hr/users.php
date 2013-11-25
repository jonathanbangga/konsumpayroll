<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * Users Settings
 *
 * @subpackage Hr 
 * @category Controller
 * @version 1.0
 * @copyright Copyright (c) 2013, Konsum Technologies Inc.
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */

class Users extends CI_Controller {

	var $theme;
	var $num_pagi;
	var $segment_url;
	var $sidebar_menu;
	
	public function __construct() {
		parent::__construct();
		$this->theme = $this->config->item('default');
		$this->load->model("hr/users_model","users");
		$this->num_pagi = 3;
		$this->segment_url = 4;
		$this->authentication->check_if_logged_in();	
		$this->menu = 'content_holders/company_menu';
		$this->sidebar_menu = 'content_holders/company_sidebar_menu';
	}

	public function index(){
		$data['page_title'] = "Manage Users";
		$data['sidebar_menu'] =$this->sidebar_menu;	
		
		// save
		$this->users->test();
		// save section
		
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/hr/users_view', $data);
	}
	
	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */