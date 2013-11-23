<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Locations_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function get_locations($location_id=""){
		$location_str = ($location_id!="")?"AND l.`location_id` = {$location_id}":"";
		return $this->db->query("
			SELECT *
			FROM `location` AS l
			LEFT JOIN `project` AS p ON ( l.`project_id` = p.`project_id` ) 
			WHERE l.`company_id` = {$this->company_id}
			{$location_str}
		");
	}
	
	public function get_projects(){
		return $this->db->query("
			SELECT *
			FROM `project` 
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function add_project_location($project_id,$location,$description){
		$this->db->query("
			INSERT INTO 
			`location` (
				`project_id`,
				`location`,
				`description`,
				`company_id`
			)
			VALUES (
				{$project_id},
				'".mysql_real_escape_string($location)."',
				'".mysql_real_escape_string($description)."',
				{$this->company_id}
			)
		");
	}
	
	public function delete_project_location($location_id){
		$this->db->query("
			DELETE 
			FROM `location`
			WHERE `location_id` = {$location_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function update_project_location($location,$description,$location_id){
		return $this->db->query("
			UPDATE `location`
			SET `location` = '".mysql_real_escape_string($location)."',
				`description` = '".mysql_real_escape_string($description)."'
			WHERE `location_id` = {$location_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
}
/* End of file */