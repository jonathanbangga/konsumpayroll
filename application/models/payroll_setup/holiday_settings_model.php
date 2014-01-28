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
			FROM `holiday` AS h
			LEFT JOIN `hours_type` AS ht ON h.`hour_type_id` = ht.`hour_type_id` 
			WHERE h.`company_id` = {$this->company_id}
		");
	}
	
	public function add_holiday_settings($holiday_name="",$type="",$date=""){
		$this->db->query("
			INSERT INTO
			`holiday` (
				`holiday_name`,
				`hour_type_id`,
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
	
	public function delete_holiday_settings($holiday_id){
		$this->db->query("
			DELETE 
			FROM `holiday`
			WHERE `holiday_id` = {$holiday_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function update_holiday_settings($holiday_id,$holiday_name,$type,$date){
		$this->db->query("
			UPDATE `holiday`
			SET
				`holiday_name` = '{$holiday_name}',
				`hour_type_id` = '{$type}',
				`date` = '{$date}'
			WHERE `holiday_id` = {$holiday_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function get_hours_type(){
		return $this->db->query("
			SELECT *
			FROM `hours_type`
			WHERE `company_id` = {$this->company_id}
		");
	}
		
}
/* End of file */