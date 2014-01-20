<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exclude_list_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function get_employee($offset="",$limit=""){
		$str = "";
		if($limit!=""){
			$str .= "LIMIT {$offset}, {$limit}"; 
		}
		return $this->db->query("
			SELECT *
			FROM `employee` AS e
			LEFT JOIN `accounts` AS a ON e.`account_id` = a.`account_id`
			WHERE e.`company_id` ={$this->company_id}
			{$str}
		");
	}
	
	public function add_exclude_list($emp_id="",$exclude="",$on_hold="",$reason=""){
		$this->db->query("
			INSERT INTO 
			`exclude_list`(
				`emp_id`,
				`exclude`,
				`on_hold`,
				`reason`,
				`company_id`
			)
			VALUES(
				'".mysql_real_escape_string($emp_id)."',
				'".mysql_real_escape_string($exclude)."',
				'".mysql_real_escape_string($on_hold)."',
				'".mysql_real_escape_string($reason)."',
				'".mysql_real_escape_string($this->company_id)."'
			)
		");
	}
	
	public function update_exclude_list($exclude_list_id="",$exclude="",$on_hold="",$reason=""){
		$this->db->query("
			UPDATE `exclude_list` 
			SET
				`exclude` = '".mysql_real_escape_string($exclude)."',
				`on_hold` = '".mysql_real_escape_string($on_hold)."',
				`reason` = '".mysql_real_escape_string($reason)."'
			WHERE `exclude_list_id` = {$exclude_list_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function get_exclude_list($emp_id){
		return $this->db->query("
			SELECT *
			FROM `exclude_list`
			WHERE `emp_id` = {$emp_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function delete_exclude_list($exclude_list_id){
		$this->db->query("
			DELETE FROM
			`exclude_list`
			WHERE `exclude_list_id` = {$exclude_list_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function test_import($name,$age){
		$this->db->query("
			INSERT INTO 
			`test`(
				`name`,
				`age`
			)
			VALUES(
				'".mysql_real_escape_string($name)."',
				'".mysql_real_escape_string($age)."'
			)
		");
	}
		
}
/* End of file */