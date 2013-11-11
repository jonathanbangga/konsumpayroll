<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employment_type_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }
	
	public function get_employment_type(){
		return $this->db->query("
			SELECT *
			FROM `employment_type`
			WHERE `company_id` = 0
		");
	}
	
	public function get_assigned_employment_type(){
		return $this->db->query("
			SELECT *
			FROM `employment_type`
			WHERE `company_id` != 0
		");
	}
	
	public function add_employment_type($et){
		return $this->db->query("
			INSERT INTO 
			`employment_type`(
				`name`
			)
			VALUES(
				'{$et}'
			)
		");
	}
	
	public function update_employment_type($company_id,$emp_type_id){
		$et = implode(",",$emp_type_id);
		return $this->db->query("
			UPDATE `employment_type`
			SET `company_id` = {$company_id}
			WHERE `emp_type_id` IN ({$et})
		");
	}
		
}
/* End of file hr_setup_model.php */