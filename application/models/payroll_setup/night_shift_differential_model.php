<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Night_shift_differential_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function get_night_shift_differential_settings(){
		return $this->db->query("
			SELECT *
			FROM `nightshift_differential_settings`
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function set_night_shift_differential_settings($from_time="",$to_time="",$rate=""){
		$this->db->query("
			INSERT INTO 
				`nightshift_differential_settings`(
					`from_time`,
					`to_time`,
					`rate`,
					`company_id`
				)
				VALUES(
					'{$from_time}',
					'{$to_time}',
					'{$rate}',
					{$this->company_id}
				)
		");
	}
	
	public function update_night_shift_differential_settings($from_time="",$to_time="",$rate=""){
		$this->db->query("
			UPDATE `nightshift_differential_settings` 
			SET
				`from_time` = '{$from_time}',
				`to_time` = '{$to_time}',
				`rate` = '{$rate}'
			WHERE `company_id` = {$this->company_id}
		");
	}
		
}
/* End of file */