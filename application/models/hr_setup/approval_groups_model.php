<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Approval_groups_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function add_approval_process($name){
		return $this->db->query("
			INSERT INTO 
			`approval_process` (
				`name`,
				`company_id`
			)
			VALUES (
				'{$name}',
				{$this->company_id}
			)
		");
	}
	
	public function get_approval_process(){
		return $this->db->query("
			SELECT *
			FROM `approval_process`
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function get_employee(){
		return $this->db->query("
			SELECT *
			FROM `employee`
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function add_approval_groups($approval_process_id,$emp_id,$level){
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
						{$this->company_id}
					)
				");
			}
		}
	}
	
	public function get_approval_process_in_approval_groups(){
		return $this->db->query("
			SELECT DISTINCT ag.`approval_process_id` , ap.`name`
			FROM `approval_groups` AS ag
			LEFT JOIN `approval_process` AS ap ON ( ag.`approval_process_id` = ap.`approval_process_id` )
			WHERE ag.`company_id` ={$this->company_id}
		");
	}
	
	public function get_approvers($approval_process_id){
		return $this->db->query("
			SELECT *
			FROM `approval_groups` AS ag
			LEFT JOIN `employee` AS e ON ( ag.`emp_id` = e.`emp_id` )
			WHERE ag.`approval_process_id` = {$approval_process_id}
			AND ag.`company_id` ={$this->company_id}
		");
	}
	
	public function delete_approval_groups($approval_group_id){
		$this->db->query("
			DELETE
			FROM `approval_groups`
			WHERE `approval_group_id` = {$approval_group_id}
		");
	}
	
	public function delete_approval_process($ap_id){
		$ap_id2 = implode(",",$ap_id);
		$this->db->query("
			DELETE 
			FROM `approval_process`
			WHERE `approval_process_id` IN ({$ap_id2})
			AND `company_id` = {$this->company_id}
		");
	}
	
}
/* End of file */