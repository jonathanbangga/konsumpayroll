<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_grade_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function get_job_grade(){
		return $this->db->query("
			SELECT *
			FROM `job_grade`
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function add_job_grade($job_grade,$description){
		$this->db->query("
			INSERT INTO 
			`job_grade` (
				`job_grade`,
				`description`,
				`company_id`
			)
			VALUES (
				'".mysql_real_escape_string($job_grade)."',
				'".mysql_real_escape_string($description)."',
				{$this->company_id}
			)
		");
	}
	
	public function delete_job_grade($job_grade_id){
		return $this->db->query("
			DELETE 
			FROM `job_grade`
			WHERE `job_grade_id` = {$job_grade_id}
		");
	}
	
	public function update_job_grade($job_grade_id,$job_grade,$description){
		$this->db->query("
			UPDATE `job_grade`
			SET `job_grade` = '{$job_grade}',
				`description` = '{$description}'
			WHERE `job_grade_id` = {$job_grade_id}
			AND `company_id` = {$this->company_id}
		");
	}
		
}
/* End of file */