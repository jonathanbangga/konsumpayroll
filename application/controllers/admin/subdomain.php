<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * Admin Subdomain
 *
 * @subpackage Subdomain
 * @category Controller
 * @version 1.0
 * @copyright Copyright (c) 2013, Konsum Technologies Inc.
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */

class Subdomain extends CI_Controller {

	var $theme;
	var $num_pagi;
	var $segment_url;
	
	public function __construct() {
		parent::__construct();
		$this->theme = $this->config->item('temp_admin');
		$this->load->model("admin/company_setup_model","company_setup");
		$this->num_pagi = 3;
		$this->segment_url = 4;
	}

	public function index(){
		$data['page_title'] = "Subdomain";
		$data['company']	= $this->company_setup->all_company();
		$data['error']		= "";
		if($this->input->post('submit')){
			$this->form_validation->set_rules("company","company","trim|xss_clean|required");
			$this->form_validation->set_rules("subdomain","subdomain","trim|xss_clean|required");
			if($this->form_validation->run() == false){
				$data['error'] = validation_errors("<span class='error'>","</span><br />");
			}else{
				$fields = array("sub_domain"=> $this->db->escape_str($this->input->post('subdomain')));
				$this->company_setup->update_fields("company",$fields,$this->input->post('company'));
				$this->session->set_flashdata(array("success"=>"You have successfully added a subdomain"));
				redirect("admin/subdomain");
			}
		}
		$this->layout->set_layout($this->theme);	
		$this->layout->view('pages/admin/subdomain_view', $data);	
	}
	
	public function select_company(){
		if($this->input->post('company')){
			$info = $this->company_setup->company_info($this->input->post('company'));
			echo json_encode($info);
		}
	}
	
}

/* End of file Admin Subdomain.php */
/* Location: ./application/controllers/admin/Subdomain.php */