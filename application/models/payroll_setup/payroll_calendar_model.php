<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payroll_calendar_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
	
	public function get_payroll_group(){
		return $this->db->query("
			SELECT *
			FROM `payroll_group_setup`
			WHERE `company_id` = '{$this->company_id}'
		");
	}
	
	public function add_payroll_calendar($payroll_group_id,$semi_monthly="",$monthly="",$payroll_date="",$cut_off_from="",$cut_off_to=""){
		$this->db->query("
			INSERT INTO
			`payroll_calendar` (
				`payroll_group_id`,
				`semi_monthly`,
				`monthly`,
				`payroll_date`,
				`cut_off_from`,
				`cut_off_to`,
				`company_id`
			)
			VALUES (
				'{$payroll_group_id}',
				'{$semi_monthly}',
				'{$monthly}',
				'{$payroll_date}',
				'{$cut_off_from}',
				'{$cut_off_to}',
				'{$this->company_id}'	
			)
		");
	}
	
}
/* End of file */