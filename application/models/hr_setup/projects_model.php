<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }
	
	public function add_project($project_name,$project_description,$company_id){
		$this->db->query("
			INSERT INTO 
			`project` (
				`project_name`,
				`project_description`,
				`company_id`
			)
			VALUE (
				'{$project_name}',
				'{$project_description}',
				{$company_id}
			)
		");
	}
	
	public function get_projects($company_id){
		return $this->db->query("
			SELECT *
			FROM `project`
			WHERE `company_id` = {$company_id}
		");
	}
	
	public function delete_project($project_id,$company_id){
		$this->db->query("
			DELETE 
			FROM `project`
			WHERE `project_id` = {$project_id}
			AND `company_id` = {$company_id}
		");
	}
	
}
/* End of file */