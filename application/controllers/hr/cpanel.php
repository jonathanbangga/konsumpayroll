<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * HR cpanel Controller
 *
 * @subpackage HR cpanel
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
		
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->theme = $this->config->item('temp_company_wizard');
			$this->load->model('hr/hr_model','hr_model');
		}
	
		/**
		 * index page
		 */
		public function index(){
			$data['page_title'] = "Welcome";
			
			$data['company_list'] = $this->hr_model->company_list($this->session->userdata('company_id'));
			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/hr/cpanel_view', $data);
		}
		
	}
	
/* End of file cpanel.php */
/* Location: ./application/controllers/hr/cpanel.php */
	
	