<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department_and_positions_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

	public function get_departments(){
		return $this->db->query("
			SELECT *
			FROM `department`
		");
	}
	
	public function get_positions($dept_id){
		return $this->db->query("
			SELECT *
			FROM `position`
			WHERE `dept_id` = {$dept_id}
		");
	}
	
	public function add_department($dept_name){
		return $this->db->query("
			INSERT INTO
			`department`(
				`department_name`
			)
			VALUES(
				'{$dept_name}'
			)
		");
	}
	
	public function add_position($pos,$dept_id){
		return $this->db->query("
			INSERT INTO
			`position`(
				`position_name`,
				`dept_id`
			)
			VALUES(
				'{$pos}',
				{$dept_id}
			)
		");
	}
		
}
/* End of file */