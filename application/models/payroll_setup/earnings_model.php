<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Earnings_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function get_earnings(){
		return $this->db->query("
			SELECT *
			FROM `earnings`
			WHERE `company_id` = {$this->company_id}
		");
	}
	
	public function add_earnings($earning_name,$taxable,$max_non_taxable,$withholding_tax_rate){
		$this->db->query("
			INSERT INTO 
			`earnings` (
				`earning_name`,
				`taxable`,
				`max_non_taxable`,
				`withholding_tax_rate`,
				`company_id`
			)
			VALUES (
				'{$earning_name}',
				'{$taxable}',
				'{$max_non_taxable}',
				'{$withholding_tax_rate}',
				'{$this->company_id}'
			)
		");
	}
	
	public function delete_earnings($earning_id){
		$this->db->query("
			DELETE 
			FROM `earnings`
			WHERE `earning_id` = {$earning_id}
			AND `company_id` = {$this->company_id}
		");
	}
	
	public function update_earnings($earning_id,$earning_name,$taxable,$max_non_taxable,$withholding_tax_rate){
		$this->db->query("
			UPDATE `earnings`
			SET `earning_name` = '{$earning_name}',
				`taxable` = '{$taxable}',
				`max_non_taxable` = '{$max_non_taxable}',
				`withholding_tax_rate` = '{$withholding_tax_rate}'
			WHERE `earning_id` = {$earning_id}
			AND `company_id` = {$this->company_id}
		");
	}
		
}
/* End of file */