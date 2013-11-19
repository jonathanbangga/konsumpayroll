<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * HR Employee Model
 *
 * @category Model
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Hr_employee_model extends CI_Model {
		
		/**
		 * Qualified Dependents List
		 * @param unknown_type $emp_id
		 */
		public function qual_dept($emp_id,$comp_id){
			$sql = $this->db->query("
				SELECT *FROM employee_qualifid_dependents eqd
				LEFT JOIN employee e ON eqd.emp_id = e.emp_id
				WHERE eqd.emp_id = '{$emp_id}' 
				AND eqd.company_id = '{$comp_id}'
				AND e.status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$results = $sql->result();
				$sql->free_result();
				$count = 1;
				foreach($results as $row){
					$emp_no = $row->qualified_dependents_id;
					$table[] = '
						<tr class="clear_tbl">
					      <td>'.$count++.'</td>
			              <td>'.$row->dependents_name.'</td>
			              <td>'.$row->dob.'</td>
			              <td>
			              <a href="javascript:void(0);" attr_no="'.$emp_no.'" class="btn btn-gray btn-action editBtnDb custom_white">EDIT</a>
			              <a href="javascript:void(0);" attr_no="'.$emp_no.'" class="btn btn-red btn-action delBtnDb custom_white">DELETE</a></td>	
			            </tr>';
				}
				return $table;
			}else{
				return "";//"<tr class='clear_tbl'><td colspan='4'>".msg_empty()."</td></tr>";
			}
		}
		
		/**
		 * Delete Qualified Dependent
		 * @param unknown_type $depent_id
		 * @param unknown_type $emp_id
		 * @param unknown_type $comp_id
		 */
		public function delete_qual_depent($depent_id,$emp_id,$comp_id){
			$sql = $this->db->query("
				DELETE FROM employee_qualifid_dependents
				WHERE company_id = '{$comp_id}'
				AND qualified_dependents_id = '{$depent_id}'
				AND emp_id = '{$emp_id}'
			");
			
			return true;
		}
		
		/**
		 * Basic Employee Information View All Active Users
		 * Enter description here ...
		 * @param unknown_type $comp_id
		 */
		public function basic_emp_view_all_active_user($comp_id){
			$sql = $this->db->query("
				SELECT *FROM employee e
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE e.company_id = '{$comp_id}'
				AND e.status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$results = $sql->result();
				$sql->free_result();
				return $results;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * View Employee
		 * @param unknown_type $comp_id
		 */
		public function view_employee($comp_id){
			$emp_train_det = $this->db->query("
				SELECT *FROM employee_training_details
				WHERE comp_id = '{$comp_id}'
			");
			
			$result_emp_train_det = $emp_train_det->result();
			$result_array = "";
			if($emp_train_det->num_rows() > 0){
				foreach($result_emp_train_det as $row){
					$result_array .= $row->emp_id.",";
				}
				$emp_val_notin = substr($result_array, 0, -1);	
			}else{
				$emp_val_notin = 0;
			}
			
			$sql = $this->db->query("
				SELECT *FROM employee e
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE e.company_id = '{$comp_id}'
				AND e.status = 'Active'
				AND e.emp_id NOT IN({$emp_val_notin});
			");
			
			if($sql->num_rows() > 0){
				$results = $sql->result();
				$sql->free_result();
				return $results;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Validate Username
		 * Enter description here ...
		 */
		public function validate_name($uname){
			$sql = $this->db->query("
				SELECT *FROM accounts a
				LEFT JOIN employee e ON a.account_id = e.account_id
				WHERE a.payroll_cloud_id = '{$uname}'
				AND e.status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$results = $sql->result();
				$sql->free_result();
				return TRUE;
			}else{
				return FALSE;
			}
		}

		/**
		 * Employee Training Details
		 * Enter description here ...
		 * @param unknown_type $comp_id
		 */
		public function employee_training_details($comp_id){
			$sql = $this->db->query("
				SELECT *FROM employee_training_details etd
				LEFT JOIN employee e ON etd.emp_id = e.emp_id
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE etd.comp_id = '{$comp_id}'
				AND e.status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$results = $sql->result();
				$sql->free_result();
				return $results;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee List
		 * @param unknown_type $comp_id
		 */
		public function employee_list($comp_id){
			$sql = $this->db->query("
				SELECT *FROM employee e
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE e.company_id = '{$comp_id}'
				AND e.status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$results = $sql->result();
				$sql->free_result();
				return $results;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Display Dependent Information
		 * @param unknown_type $dep_id
		 * @param unknown_type $comp_id
		 */
		public function dep_res($dep_id,$comp_id){
			$sql = $this->db->query("
				SELECT *FROM employee_qualifid_dependents eqd
				LEFT JOIN employee e ON eqd.emp_id = e.emp_id
				WHERE eqd.company_id = '{$comp_id}'
				AND eqd.qualified_dependents_id = '{$dep_id}'
				AND e.status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$results = $sql->row();
				$sql->free_result();
				return $results;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Update Dependent Information
		 * @param unknown_type $dep_id
		 * @param unknown_type $name
		 * @param unknown_type $dep_dob
		 * @param unknown_type $comp_id
		 */
		public function update_qual_dep($dep_id,$name,$dep_dob,$comp_id){
			$sql = $this->db->query("
				UPDATE employee_qualifid_dependents
				SET dependents_name = '{$name}',dob = '{$dep_dob}'
				WHERE qualified_dependents_id = '$dep_id'
				AND company_id = '{$comp_id}'
			");
			
			if($sql){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Update Training Details
		 * @param unknown_type $emp_idEdit
		 * @param unknown_type $dateFromEdit
		 * @param unknown_type $dateToEdit
		 * @param unknown_type $courseNameEdit
		 * @param unknown_type $courseNameEdit
		 * @param unknown_type $organizerEdit
		 * @param unknown_type $costEdit
		 * @param unknown_type $trainingHoursEdit
		 */
		public function update_train_details($emp_idEdit,$dateFromEdit,$dateToEdit,$courseNameEdit,$courseNameEdit,$organizerEdit,$costEdit,$trainingHoursEdit,$comp_id){
			$sql = $this->db->query("
				UPDATE employee_training_details
				SET date_from = '{$dateFromEdit}', date_to = '{$dateToEdit}', course_name = '{$courseNameEdit}', organizer = '{$organizerEdit}', cost = '{$costEdit}', training_hours = '{$trainingHoursEdit}'
				WHERE emp_id = '$emp_idEdit'
				AND comp_id = '{$comp_id}'
			");
			
			if($sql){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Update Employee Basic Information
		 * Enter description here ...
		 * @param unknown_type $emp_id
		 * @param unknown_type $comp_id
		 */
		public function update_basic_emp($emp_id,$comp_id){
			$delete_me = $this->db->query("UPDATE employee SET status = 'Inactive', deleted = '1' WHERE emp_id = '{$emp_id}' and company_id = '{$comp_id}'");
			if($delete_me){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Display Employee Information
		 * @param unknown_type $emp_id
		 * @param unknown_type $comp_id
		 */
		public function emp_res($emp_id,$comp_id){
			$sql = $this->db->query("
				SELECT *FROM employee
				WHERE emp_id = '{$emp_id}'
				AND company_id = '{$comp_id}'
				AND status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$results = $sql->row();
				$sql->free_result();
				return $results;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Basic Pay Adjustment
		 * @param unknown_type $comp_id
		 */
		public function basic_pay_adjustment($comp_id){
			$sql = $this->db->query("
				SELECT *FROM basic_pay_adjustment bpa
				LEFT JOIN employee e ON bpa.emp_id = e.emp_id
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE e.company_id = '{$comp_id}'
				AND e.status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$results = $sql->result();
				$sql->free_result();
				return $results;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * View Employee Basic Pay Adjustment
		 * @param unknown_type $comp_id
		 */
		public function view_emp_basic_pay_adjustment($comp_id){
			$emp_train_det = $this->db->query("
				SELECT *FROM basic_pay_adjustment
				WHERE comp_id = '{$comp_id}'
			");
			
			$result_emp_train_det = $emp_train_det->result();
			$result_array = "";
			if($emp_train_det->num_rows() > 0){
				foreach($result_emp_train_det as $row){
					$result_array .= $row->emp_id.",";
				}
				$emp_val_notin = substr($result_array, 0, -1);	
			}else{
				$emp_val_notin = 0;
			}
			
			$sql = $this->db->query("
				SELECT *FROM employee e
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE e.company_id = '{$comp_id}'
				AND e.status = 'Active'
				AND e.emp_id NOT IN({$emp_val_notin});
			");
			
			if($sql->num_rows() > 0){
				$results = $sql->result();
				$sql->free_result();
				return $results;
			}else{
				return FALSE;
			}
		}
	}
	
/* End of file Hr_employee_model.php */
/* Location: ./application/models/hr/Hr_employee_model.php */