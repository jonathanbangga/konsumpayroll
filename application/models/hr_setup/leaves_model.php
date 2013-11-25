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
	
}
/* End of file */