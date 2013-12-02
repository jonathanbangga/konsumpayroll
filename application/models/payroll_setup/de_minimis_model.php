<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class De_minimis_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function get_de_minimis(){
		return $this->db->query("
			SELECT *
			FROM `de_minimis`
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function add_de_minimis($monetized_unused_leave="",$daily_meal_allowance="",$ceiling=""){
		$this->db->query("
			INSERT INTO
			`de_minimis` (
				`monetized_unused_leave`,
				`daily_meal_allowance`,
				`ceiling`,
				`company_id`
			)
			VALUES (
				'{$monetized_unused_leave}',
				'{$daily_meal_allowance}',
				'{$ceiling}',
				{$this->company_id}
			)
		");
	}
	
	public function update_de_minimis($monetized_unused_leave="",$daily_meal_allowance="",$ceiling=""){
		$this->db->query("
			UPDATE `de_minimis` 
			SET
				`monetized_unused_leave` = '{$monetized_unused_leave}',
				`daily_meal_allowance` = '{$daily_meal_allowance}',
				`ceiling` = '{$ceiling}'
			WHERE `company_id` = {$this->company_id}
		");
	}
		
}
/* End of file */