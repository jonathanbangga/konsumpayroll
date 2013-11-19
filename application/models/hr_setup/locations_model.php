<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Locations_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }
	
	public function get_locations($company_id){
		return $this->db->query("
			SELECT *
			FROM `location` AS l
			LEFT JOIN `project` AS p ON ( l.`project_id` = p.`project_id` ) 
			WHERE l.`company_id` = {$company_id}
		");
	}
	
	public function get_projects($company_id){
		return $this->db->query("
			SELECT *
			FROM `project` 
			WHERE `company_id` = {$company_id}
		");
	}
	
	public function add_project_location($project_id,$location,$description,$company_id){
		return $this->db->query("
			INSERT INTO 
			`location` (
				`project_id`,
				`location`,
				`description`,
				`company_id`
			)
			VALUES (
				{$project_id},
				'{$location}',
				'{$description}',
				{$company_id}
			)
		");
	}
	
}
/* End of file */