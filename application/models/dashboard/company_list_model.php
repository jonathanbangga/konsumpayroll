<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_list_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

	public function get_company(){
		return $this->db->query("
			SELECT *
			FROM `company` c
			
		");
	}
		
}
/* End of file */