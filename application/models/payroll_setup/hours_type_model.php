<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hours_type_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function get_hours_type(){
		return $this->db->query("
			SELECT *
			FROM 
			`hours_type`
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function add_hours_type($hour_type_name,$pay_rate){
		$this->db->query("
			INSERT INTO
			`hours_type` (
				`hour_type_name`,
				`pay_rate`,
				`company_id`
			)
			VALUES (
				'{$hour_type_name}',
				'{$pay_rate}',
				{$this->company_id}
			)
		");
	}
	
	public function delete_hours_type($hour_type_id){
		$this->db->query("
			DELETE 
			FROM `hours_type`
			WHERE `hour_type_id` = '{$hour_type_id}' 
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function update_hours_type($hour_type_id,$hour_type_name,$pay_rate){
		$this->db->query("
			UPDATE `hours_type` 
			SET	`hour_type_name` = '{$hour_type_name}',
				`pay_rate` = '{$pay_rate}'
			WHERE `hour_type_id` = '{$hour_type_id}' 
			AND `company_id` = {$this->company_id}
		");
	}
		
}
/* End of file */