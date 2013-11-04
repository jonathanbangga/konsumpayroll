<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employment_type_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }
	
	public function get_employment_type(){
		return $this->db->query("
			SELECT *
			FROM `employment_type`
		");
	}
		
}
/* End of file hr_setup_model.php */