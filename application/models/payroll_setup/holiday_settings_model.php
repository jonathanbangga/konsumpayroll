<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Holiday_settings_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function get_holiday_settings(){
		return $this->db->query("
			SELECT *
			FROM `holiday`
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function add_holiday_settings($holiday_name="",$type="",$date=""){
		$this->db->query("
			INSERT INTO
			`holiday` (
				`holiday_name`,
				`type`,
				`date`,
				`company_id`
			)
			VALUES (
				'{$holiday_name}',
				'{$type}',
				'{$date}',
				'{$this->company_id}'
			)
		");
	}
		
}
/* End of file */