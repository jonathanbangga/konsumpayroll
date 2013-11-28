<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leaves_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		$this->company_id = $this->session->userdata('company_id');
    }

	public function get_leaves(){
		return $this->db->query("
			SELECT *
			FROM `leaves` AS l
			LEFT JOIN `position` AS p ON ( l.`position_id` = p.`position_id` ) 
			WHERE l.`company_id` = {$this->company_id}
		");
	}
	
	public function get_position(){
		return $this->db->query("
			SELECT *
			FROM `selected_position` AS sp
			LEFT JOIN `position` AS p ON ( sp.position_id = p.position_id )
			WHERE sp.`company_id` ={$this->company_id}
		");
	}
	
	public function add_leaves($leave_type,$payable,$required_documents,$include_in_actual_hours_worked,$leaves_used_to_deduct_no_of_work,$leave_accrued,$period,$position_id,$years_of_service,$unused_leave,$unused_leave_upon_termination,$max_days_of_leave){
		$this->db->query("
			INSERT INTO 
			`leaves` (	
				`leave_type`,
				`payable`,
				`required_documents`,
				`include_in_actual_hours_worked`,
				`leaves_used_to_deduct_no_of_work`,
				`leave_accrued`,
				`period`,
				`position_id`,
				`years_of_service`,
				`unused_leave`,
				`unused_leave_upon_termination`,
				`max_days_of_leave`,
				`company_id`
			)
			VALUES (
				'".mysql_real_escape_string($leave_type)."',
				'{$payable}',
				'".mysql_real_escape_string($required_documents)."',
				'{$include_in_actual_hours_worked}',
				'{$leaves_used_to_deduct_no_of_work}',
				'".mysql_real_escape_string($leave_accrued)."',
				'{$period}',
				'{$position_id}',
				'{$years_of_service}',
				'{$unused_leave}',
				'{$unused_leave_upon_termination}',
				'".mysql_real_escape_string($max_days_of_leave)."',
				'{$this->company_id}'
			)
		");
	}
	
	public function delete_leaves($leaves_id){
		return $this->db->query("
			DELETE 
			FROM `leaves`
			WHERE `leaves_id` = {$leaves_id}
		");
	}
	
	public function update_leaves($leaves_id,$leave_type,$payable,$required_documents,$include_in_actual_hours_worked,$leaves_used_to_deduct_no_of_work,$leave_accrued,$period,$position_id,$years_of_service,$unused_leave,$unused_leave_upon_termination,$max_days_of_leave){
		$this->db->query("
			UPDATE `leaves`
			SET `leave_type` = '".mysql_real_escape_string($leave_type)."',
				`payable` = '{$payable}',
				`required_documents` = '".mysql_real_escape_string($required_documents)."',
				`include_in_actual_hours_worked` = '{$include_in_actual_hours_worked}',
				`leaves_used_to_deduct_no_of_work` = '{$leaves_used_to_deduct_no_of_work}',
				`leave_accrued` = '".mysql_real_escape_string($leave_accrued)."',
				`period` = '{$period}',
				`position_id` = '{$position_id}',
				`years_of_service` = '{$years_of_service}',
				`unused_leave` = '{$unused_leave}',
				`unused_leave_upon_termination` = '{$unused_leave_upon_termination}',
				`max_days_of_leave` = '".mysql_real_escape_string($max_days_of_leave)."'
			WHERE `leaves_id` = {$leaves_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function	set_hr_setup_properties($leave_day_num_of_hours,$month_num_of_workdays){
		$this->db->query("
			INSERT INTO 
				`hr_setup_properties` (
					`leave_day_num_of_hours`,
					`month_num_of_workdays`,
					`company_id`
				)
				VALUES (
					'{$leave_day_num_of_hours}',
					'{$month_num_of_workdays}',
					{$this->company_id}
				)
		");
	}
	
	public function update_hr_setup_properties($leave_day_num_of_hours,$month_num_of_workdays){
		$this->db->query("
			UPDATE `hr_setup_properties`
			SET
				`leave_day_num_of_hours` = '{$leave_day_num_of_hours}',
				`month_num_of_workdays` = '{$month_num_of_workdays}'
			WHERE `company_id` = {$this->company_id}	
		");
	}
	
	public function get_hr_setup_properties(){
		return $this->db->query("
			SELECT *
			FROM `hr_setup_properties`
			WHERE `company_id` = {$this->company_id}
		");
	}
	
}
/* End of file */