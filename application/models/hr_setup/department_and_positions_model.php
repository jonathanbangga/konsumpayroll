<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department_and_positions_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		$this->company_id = $this->session->userdata('company_id');	
    }

	public function get_departments($dept_id=""){
		$str_dept_id = ($dept_id!="")?"AND `dept_id` = {$dept_id}":"";
		return $this->db->query("
			SELECT *
			FROM `department`
			WHERE `company_id` = {$this->company_id}
			{$str_dept_id}
		");
	}
	
	public function get_positions($dept_id,$pos_id=""){
		$str_pos_id = ($pos_id!="")?"AND `position_id` = {$pos_id}":"";
		return $this->db->query("
			SELECT *
			FROM `position` AS p
			LEFT JOIN `department` AS d ON ( p.dept_id = d.dept_id ) 
			WHERE p.`company_id` = {$this->company_id} 
			AND p.`dept_id` = {$dept_id}
			{$str_pos_id}
		");
	}
	
	public function add_department($dept_name){
		$this->db->query("
			INSERT INTO
			`department`(
				`department_name`,
				`company_id`
			)
			VALUES(
				'{$dept_name}',
				{$this->company_id}
			)
		");
		return mysql_insert_id();
	}
	
	public function add_position($pos,$dept_id){
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
				{$this->company_id}
			)
		");
		return mysql_insert_id();
	}
	
	public function assign_selected_position($dept_id,$position_id){
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
				{$this->company_id}
			)
		");
	}
	
	public function get_distinct_department(){
		return $this->db->query("
			SELECT DISTINCT `dept_id`
			FROM `position` 
			WHERE `company_id` ={$this->company_id}
		");
	}
	
	public function get_assigned_positions(){
		return $this->db->query("
			SELECT *
			FROM `selected_position`
			WHERE `company_id` ={$this->company_id}
		");
	}
	
	public function check_department($dept_id){
		return $this->db->query("
			SELECT *
			FROM `selected_position`
			WHERE `dept_id` ={$dept_id}
			AND `company_id` ={$this->company_id}
		");
	}
	
	public function check_position($position_id){
		return $this->db->query("
			SELECT *
			FROM `selected_position`
			WHERE `position_id` ={$position_id}
			AND `company_id` ={$this->company_id}
		");
	}
	
	public function unassign_positions($position_id){
		$this->db->query("
			DELETE FROM `selected_position`
			WHERE `position_id` = {$position_id}
			AND `company_id` ={$this->company_id}
		");
	}
	
	public function delete_department($dept_id){
		$dept_id2 = implode(",",$dept_id);
		// delete department
		$this->db->query("
			DELETE 
			FROM `department`
			WHERE `dept_id` IN ({$dept_id2})
			AND `company_id` = {$this->company_id}
		");
		// delete it's position as well
		$this->db->query("
			DELETE 
			FROM `position`
			WHERE `dept_id` IN ({$dept_id2})
			AND `company_id` = {$this->company_id}
		");
		// delete it's selected position as well
		$this->db->query("
			DELETE 
			FROM `selected_position`
			WHERE `dept_id` IN ({$dept_id2})
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function delete_position($pos_id){
		$pos_id2 = implode(",",$pos_id);
		// delete position 
		$this->db->query("
			DELETE 
			FROM `position`
			WHERE `position_id` IN ({$pos_id2})
			AND `company_id` = {$this->company_id}
		");
		// delete it's selected position as well
		$this->db->query("
			DELETE 
			FROM `selected_position`
			WHERE `position_id` IN ({$pos_id2})
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function update_department($dept_id,$department_name){
		$this->db->query("
			UPDATE `department`
			SET `department_name` = '{$department_name}'
			WHERE `dept_id` = {$dept_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function update_position($position_id,$position_name){
		$this->db->query("
			UPDATE `position`
			SET `position_name` = '{$position_name}'
			WHERE `position_id` = {$position_id}
			AND `company_id` = {$this->company_id}
		");
	}
		
}
/* End of file */