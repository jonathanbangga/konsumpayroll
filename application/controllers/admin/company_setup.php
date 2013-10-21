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

class Company_setup extends CI_Controller {

	var $theme;

	public function __construct() {
		parent::__construct();
		$this->theme = $this->config->item('temp_admin');
	}

	public function add()
	{		
		$data['page_title'] = "Company Setup";	
		if($this->input->post('submit')) {
			$this->form_validation->set_rules("reg_business_name","Registration Business Name","required|trim|xss_clean");
			$this->form_validation->set_rules("trade_name","trade name","required|trim|xss_clean");
			$this->form_validation->set_rules("business_address","business address","required|trim|xss_clean");
			$this->form_validation->set_rules("city","city","required|trim|xss_clean");
			$this->form_validation->set_rules("org_type","org type","trim|xss_clean");
			$this->form_validation->set_rules("industry","industry","trim|xss_clean");
			$this->form_validation->set_rules("business_phone","business phone","required|trim|xss_clean");
			$this->form_validation->set_rules("extension","extension","trim|xss_clean");
			$this->form_validation->set_rules("mobile_no","mobile no","required|trim|xss_clean");
			$this->form_validation->set_rules("fax","fax","trim|xss_clean");
			if($this->form_validation->run() == FALSE) {
		
			} else {
			
			}
		}
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/admin/company_add_view', $data);	
	}
	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */