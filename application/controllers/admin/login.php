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

class Login extends CI_Controller {

	var $theme;
	var $segment_url;
	var $num_pagi;
	var $dashboard;
	
	public function __construct() {
		parent::__construct();
		$this->theme = $this->config->item('temp_company_wizard');
	}

	public function index()
	{		
		echo "weeeeeeeeee";
	}
	
	
	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */