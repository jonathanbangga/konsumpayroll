<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department_and_positions_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

	public function get_departments($company_id,$dept_id=""){
		$str_dept_id = ($dept_id!="")?"AND `dept_id` = {$dept_id}":"";
		return $this->db->query("
			SELECT *
			FROM `department`
			WHERE `company_id` = {$company_id}
			{$str_dept_id}
		");
	}
	
	public function get_positions($comp_id,$dept_id,$pos_id=""){
		$str_pos_id = ($pos_id!="")?"AND `position_id` = {$pos_id}":"";
		return $this->db->query("
			SELECT *
			FROM `position` AS p
			LEFT JOIN `department` AS d ON ( p.dept_id = d.dept_id ) 
			WHERE p.`company_id` = {$comp_id} 
			AND p.`dept_id` = {$dept_id}
			{$str_pos_id}
		");
	}
	
	public function add_department($dept_name,$company_id){
		$this->db->query("
			INSERT INTO
			`department`(
				`department_name`,
				`company_id`
			)
			VALUES(
				'{$dept_name}',
				{$company_id}
			)
		");
		return mysql_insert_id();
	}
	
	public function add_position($comp_id,$pos,$dept_id){
		$this->db->query("
			INSERT INTO
			`position`(
				`position_name`,
				`dept_id`,
				`company_id`
			)
			VALUES(
				'{$pos}',
				{$dept_id},
				{$comp_id}
			)
		");
		return mysql_insert_id();
	}
	
	public function assign_selected_position($company_id,$dept_id,$position_id){
		$this->db->query("
			INSERT INTO
			`selected_position`(
				`dept_id`,
				`position_id`,
				`company_id`
			)
			VALUES(
				'{$dept_id}',
				{$position_id},
				{$company_id}
			)
		");
	}
	
	public function get_distinct_department($company_id){
		return $this->db->query("
			SELECT DISTINCT `dept_id`
			FROM `selected_position` 
			WHERE `company_id` ={$company_id}
		");
	}
	
	public function get_assigned_positions($company_id){
		return $this->db->query("
			SELECT *
			FROM `selected_position`
			WHERE `company_id` ={$company_id}
		");
	}
	
	public function check_department($dept_id,$company_id){
		return $this->db->query("
			SELECT *
			FROM `selected_position`
			WHERE `dept_id` ={$dept_id}
			AND `company_id` ={$company_id}
		");
	}
	
	public function check_position($position_id,$company_id){
		return $this->db->query("
			SELECT *
			FROM `selected_position`
			WHERE `position_id` ={$position_id}
			AND `company_id` ={$company_id}
		");
	}
	
	public function unassign_positions($position_id,$company_id){
		$this->db->query("
			DELETE FROM `selected_position`
			WHERE `position_id` = {$position_id}
			AND `company_id` ={$company_id}
		");
	}
		
}
/* End of file */