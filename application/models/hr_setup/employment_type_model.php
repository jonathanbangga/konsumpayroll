<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employment_type_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function get_employment_type(){
		return $this->db->query("
			SELECT *
			FROM `employment_type`
			WHERE `selected` = 0
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function get_assigned_employment_type(){
		return $this->db->query("
			SELECT *
			FROM `employment_type`
			WHERE `selected` = 1
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function add_employment_type($et){
		return $this->db->query("
			INSERT INTO 
			`employment_type`(
				`name`,
				`company_id`
			)
			VALUES(
				'".mysql_real_escape_string($et)."',
				'{$this->company_id}'
			)
		");
	}
	
	public function update_employment_type($selected,$emp_type_id){
		$et = implode(",",$emp_type_id);
		return $this->db->query("
			UPDATE `employment_type`
			SET `selected` = {$selected}
			WHERE `emp_type_id` IN ({$et})
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function delete_employment_type($emp_type_id){
		$et = implode(",",$emp_type_id);
		$this->db->query("
			DELETE 
			FROM `employment_type`
			WHERE `emp_type_id` IN ({$et})
			AND `company_id` = {$this->company_id}
		");
	}
		
}
/* End of file hr_setup_model.php */