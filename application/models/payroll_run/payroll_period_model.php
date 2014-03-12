<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * No document block added. 
 * 
 * @author Joe Alcomedras
 * 
 * Recoded by
 * @author Kris Edwardg Galanida <KrisEdward.Galanida@techgrowthglobal.com>
 *
 */
class Payroll_period_model extends CI_Model {
	
	public function get_payroll_group($company_id)
	{
		$where = array(
			'company_id' => $company_id,
			'status'	 => 'Active'
		);
		$this->db->where($where);
		$q = $this->db->get('payroll_group');
		$result = $q->result();
		
		return ($result) ? $result : false;
	}
	
	public function get_payroll_calendar($payroll_group_id,$company_id)
	{
		$where = array(
			'payroll_group_id' => $payroll_group_id,
			'company_id'	   => $company_id,
			'status'		   => 'Active'
		);
		$this->db->where($where);
		$q = $this->db->get('payroll_calendar');
		$result = $q->result();
		
		return ($result) ? $result : false;
	}
	
	public function get_payroll_range($payroll_calendar_id="",$company_id){
		return $this->db->query("
			SELECT *
			FROM `payroll_calendar`
			WHERE `payroll_calendar_id` = '{$payroll_calendar_id}'
			AND `company_id` = {$company_id}
		");
	}
	
	public function add_payroll_period($payroll_group_id="",$company_id,$payroll_period="",$period_from="",$period_to=""){
		$this->db->query("
			INSERT INTO 
			`payroll_period`(
				`payroll_group_id`,
				`payroll_period`,
				`period_from`,
				`period_to`,
				`company_id`
			)
			VALUES(
				'".mysql_real_escape_string($payroll_group_id)."',
				'".mysql_real_escape_string(date('Y-m-d',strtotime($payroll_period)))."',
				'".mysql_real_escape_string(date('Y-m-d',strtotime($period_from)))."',
				'".mysql_real_escape_string(date('Y-m-d',strtotime($period_to)))."',
				'".mysql_real_escape_string($company_id)."'
			)
		");
	}
	
	public function update_payroll_period($payroll_group_id="",$company_id,$payroll_period="",$period_from="",$period_to=""){
		$this->db->query("
			UPDATE `payroll_period`
			SET
				`payroll_group_id` = '".mysql_real_escape_string($payroll_group_id)."',
				`payroll_period` = '".mysql_real_escape_string(date('Y-m-d',strtotime($payroll_period)))."',
				`period_from` = '".mysql_real_escape_string(date('Y-m-d',strtotime($period_from)))."',
				`period_to` = '".mysql_real_escape_string(date('Y-m-d',strtotime($period_to)))."'
			WHERE `company_id` = {$company_id}
		");
	}
	
	public function get_payroll_calendar_period($company_id,$payroll_calendar_id){
		return $this->db->query("
			SELECT `first_payroll_date`
			FROM `payroll_calendar`
			WHERE `payroll_calendar_id` = '{$payroll_calendar_id}'
			AND `company_id` = {$company_id}
		");
	}
	
	public function get_payroll_period($company_id)
	{
		$where = array(
			'company_id' => $company_id,
			'status'	 => 'Active'
		);
		$this->db->where($where);
		$q = $this->db->get('payroll_period');
		$result = $q->row();
		
		return ($result) ? $result : false;
	}
	
	
		
}
/* End of file */