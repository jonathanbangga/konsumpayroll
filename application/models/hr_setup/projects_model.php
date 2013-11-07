<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Model {

    public function __construct(){
        parent::__construct();
    }
	
	public function get_projects(){
		return $this->db->query("
			SELECT *
			FROM `projects`
		");
	}
	
}
/* End of file */