<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * owner cpanel Controller
 *
 * @subpackage owner cpanel
 * @category Controller
 * @version 1.0
 * @copyright Copyright (c) 2013, Konsum Technologies Inc.
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */

	class Cpanel extends CI_Controller {
	
		/**
		 * Theme options - default theme
		 * @var string
		 */
		var $theme;
		var $menu;
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->theme = $this->config->item('default');
			$this->load->model('owner/owner_model','owner_model');
			$this->menu = "content_holders/hr_company_sidebar_menu";
		}
	
		/**
		 * index page
		 */
		public function index(){
			$data['page_title'] = "Welcome";
			$data['sidebar_menu'] = $this->menu;
			$data['company_list'] = $this->owner_model->company_list($this->session->userdata('account_id'));	
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/owner/cpanel_view', $data);
		}
		
	}
	
/* End of file cpanel.php */
/* Location: ./application/controllers/owner/cpanel.php */
	
	