<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Overtime_settings_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function get_overtime_settings(){
		return $this->db->query("
			SELECT *
			FROM `overtime_type`
			WHERE `company_id` = {$this->company_id}
		");
	}
		
}
/* End of file */