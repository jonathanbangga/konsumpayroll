<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_grade_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }
	
	public function get_job_grade($company_id){
		return $this->db->query("
			SELECT *
			FROM `job_grade`
			WHERE `company_id` = {$company_id}
		");
	}
	
	public function add_job_grade($job_grade,$description,$company_id){
		$this->db->query("
			INSERT INTO 
			`job_grade` (
				`job_grade`,
				`description`,
				`company_id`
			)
			VALUES (
				'{$job_grade}',
				'{$description}',
				{$company_id}
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
		
}
/* End of file */