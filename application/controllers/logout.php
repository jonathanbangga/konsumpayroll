<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * Logout Controller
 *
 * @subpackage Logout
 * @category Controller
 * @version 1.0
 * @copyright Copyright (c) 2013, Konsum Technologies Inc.
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */

	class Logout extends CI_Controller {
		
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
		}
	
		/**
		 * index page
		 */
		public function index()
		{		
			$this->konsumpay_auth->logout();
			redirect('/','refresh');
		}
		
	}

/* End of file logout.php */
/* Location: ./application/controllers/logout.php */