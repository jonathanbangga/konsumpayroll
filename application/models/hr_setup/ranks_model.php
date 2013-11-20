<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ranks_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }
	
	public function get_ranks($company_id){
		return $this->db->query("
			SELECT *
			FROM `rank`
			WHERE `company_id` = {$company_id}
		");
	}
	
	public function add_rank($rank,$description,$company_id){
		$this->db->query("
			INSERT INTO 
			`rank` (
				`rank`,
				`description`,
				`company_id`
			)
			VALUES (
				{$rank},
				'{$description}',
				{$company_id}
			)
		");
	}
	
	public function delete_rank($rank_id){
		return $this->db->query("
			DELETE 
			FROM `rank`
			WHERE `rank_id` = {$rank_id}
		");
	}
		
}
/* End of file hr_setup_model.php */