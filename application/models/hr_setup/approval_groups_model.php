<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Approval_groups_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }
	
	public function add_approval_process($name,$company_id){
		return $this->db->query("
			INSERT INTO 
			`approval_process` (
				`name`,
				`company_id`
			)
			VALUES (
				'{$name}',
				{$company_id}
			)
		");
	}
	
	public function get_approval_process($company_id){
		return $this->db->query("
			SELECT *
			FROM `approval_process`
			WHERE `company_id` = {$company_id}
		");
	}
	
	public function get_employee($company_id){
		return $this->db->query("
			SELECT *
			FROM `employee`
			WHERE `company_id` = {$company_id}
		");
	}
	
	public function add_approval_groups($approval_process_id,$emp_id,$level,$company_id){
		foreach($approval_process_id as $ap){
			foreach($emp_id as $index=>$emp){
				$this->db->query("
					INSERT INTO
					`approval_groups` (
						`approval_process_id`,
						`emp_id`,
						`level`,
						`company_id`
					)
					VALUES (
						{$ap},
						{$emp},
						{$level[$index]},
						{$company_id}
					)
				");
			}
		}
	}
	
	public function get_approval_process_in_approval_groups($company_id){
		return $this->db->query("
			SELECT DISTINCT ag.`approval_process_id` , ap.`name`
			FROM `approval_groups` AS ag
			LEFT JOIN `approval_process` AS ap ON ( ag.`approval_process_id` = ap.`approval_process_id` )
			WHERE ag.`company_id` ={$company_id}
		");
	}
	
	public function get_approvers($approval_process_id,$company_id){
		return $this->db->query("
			SELECT *
			FROM `approval_groups` AS ag
			LEFT JOIN `employee` AS e ON ( ag.`emp_id` = e.`emp_id` )
			WHERE ag.`approval_process_id` = {$approval_process_id}
			AND ag.`company_id` ={$company_id}
		");
	}
	
}
/* End of file */