<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employment_type_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }
	
	public function get_employment_type(){
		return $this->db->query("
			SELECT *
			FROM `employment_type`
		");
	}
	
	public function add_employment_type($et){
		return $this->db->query("
			INSERT INTO 
			`employment_type`(
				`name`
			)
			VALUES(
				'{$et}'
			)
		");
	}
		
}
/* End of file hr_setup_model.php */