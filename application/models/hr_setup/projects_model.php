<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function add_project($project_name,$project_description){
		$this->db->query("
			INSERT INTO 
			`project` (
				`project_name`,
				`project_description`,
				`company_id`
			)
			VALUE (
				'".mysql_real_escape_string($project_name)."',
				'".mysql_real_escape_string($project_description)."',
				{$this->company_id}
			)
		");
	}
	
	public function get_projects(){
		return $this->db->query("
			SELECT *
			FROM `project`
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function delete_project($project_id){
		$this->db->query("
			DELETE 
			FROM `project`
			WHERE `project_id` = {$project_id}
			AND `company_id` = {$this->company_id}
		");
		// delete locations as well
		$this->db->query("
			DELETE 
			FROM `location`
			WHERE `project_id` = {$project_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function update_project($project_id,$project_name,$project_description){
		$this->db->query("
			UPDATE `project`
			SET `project_name` = '{$project_name}',
				`project_description` = '{$project_description}'
			WHERE `project_id` = {$project_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
}
/* End of file */