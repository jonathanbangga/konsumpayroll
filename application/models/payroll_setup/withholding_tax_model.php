<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Withholding_tax_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function set_withholding_tax_settings($compensation_type){
		$this->db->query("
			INSERT INTO 
			`withholding_tax_settings` (
				`compensation_type`,
				`company_id`	
			)
			VALUES (
				'{$compensation_type}',
				'{$this->company_id}'
			)
		");
	}
	
	public function update_withholding_tax_settings($compensation_type){
		$this->db->query("
			UPDATE `withholding_tax_settings` 
			SET `compensation_type` = '{$compensation_type}'
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function get_withholding_tax_settings(){
		return $this->db->query("
			SELECT *
			FROM `withholding_tax_settings` 
			WHERE `company_id` = {$this->company_id}
		");
	}
		
}
/* End of file */