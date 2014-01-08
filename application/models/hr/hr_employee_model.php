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
				SELECT 
				eqd.qualified_dependents_id as qualified_dependents_id,
				eqd.dependents_name as dependents_name,
				eqd.dob as dob
				FROM employee_qualifid_dependents eqd
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
				return "<tr class='msg_empt_cont'><td colspan='4' style='text-align:left;'>".msg_empty()."</td></tr>";
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
		 * Basic Employee Information View All Active Users Count
		 * @param unknown_type $comp_id
		 */
		public function basic_emp_view_all_active_user_count($comp_id){
			$sql = $this->db->query("
				SELECT 
				COUNT(e.emp_id) as emp_id
				FROM employee e
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE e.company_id = '{$comp_id}'
				AND e.status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row->emp_id;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Basic Employee Information View All Active Users
		 * Enter description here ...
		 * @param unknown_type $comp_id
		 */
		public function basic_emp_view_all_active_user($limit, $start, $comp_id){
			if($start==0){
				$sql = $this->db->query("
					SELECT *FROM employee e
					LEFT JOIN accounts a ON e.account_id = a.account_id
					WHERE e.company_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$limit."
				");
				
				if($sql->num_rows() > 0){
					$results = $sql->result();
					$sql->free_result();
					return $results;
				}else{
					return FALSE;
				}	
			}else{
				$sql = $this->db->query("
					SELECT *FROM employee e
					LEFT JOIN accounts a ON e.account_id = a.account_id
					WHERE e.company_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$start.",".$limit."
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
		 * Validate Email Address
		 * Enter description here ...
		 */
		public function validate_email($email){
			$sql = $this->db->query("
				SELECT *FROM accounts a
				LEFT JOIN employee e ON a.account_id = e.account_id
				WHERE a.email = '{$email}'
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
		 * Employee Training Details Counter
		 * Enter description here ...
		 * @param unknown_type $comp_id
		 */
		public function employee_training_details_counter($comp_id){
			$sql = $this->db->query("
				SELECT 
				COUNT(e.emp_id) as emp_id
				FROM employee_training_details etd
				LEFT JOIN employee e ON etd.emp_id = e.emp_id
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE etd.comp_id = '{$comp_id}'
				AND e.status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row->emp_id;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee Training Details
		 * Enter description here ...
		 * @param unknown_type $comp_id
		 */
		public function employee_training_details($limit, $start, $comp_id){
			if($start==0){
				$sql = $this->db->query("
					SELECT *FROM employee_training_details etd
					LEFT JOIN employee e ON etd.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					WHERE etd.comp_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$limit."
				");
				
				if($sql->num_rows() > 0){
					$results = $sql->result();
					$sql->free_result();
					return $results;
				}else{
					return FALSE;
				}
			}else{
				$sql = $this->db->query("
					SELECT *FROM employee_training_details etd
					LEFT JOIN employee e ON etd.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					WHERE etd.comp_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$start.",".$limit."
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
		
		/**
		 * Employee List Counter
		 * @param unknown_type $comp_id
		 */
		public function employee_for_dep_list_counter($comp_id){
			$sql = $this->db->query("
				SELECT 
				COUNT(emp_id) AS emp_id
				FROM employee e
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE e.company_id = '{$comp_id}'
				AND e.status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row->emp_id;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee List
		 * @param unknown_type $comp_id
		 */
		public function employee_list($limit, $start, $comp_id){
			if($start==0){
				$sql = $this->db->query("
					SELECT *FROM employee e
					LEFT JOIN accounts a ON e.account_id = a.account_id
					WHERE e.company_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$limit."
				");
				
				if($sql->num_rows() > 0){
					$results = $sql->result();
					$sql->free_result();
					return $results;
				}else{
					return FALSE;
				}
			}else{
				$sql = $this->db->query("
					SELECT *FROM employee e
					LEFT JOIN accounts a ON e.account_id = a.account_id
					WHERE e.company_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$start.",".$limit."
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
		
		/**
		 * Display Dependent Information
		 * @param unknown_type $dep_id
		 * @param unknown_type $comp_id
		 */
		public function dep_res($dep_id,$comp_id){
			$sql = $this->db->query("
				SELECT 
				eqd.qualified_dependents_id as qualified_dependents_id,
				eqd.dependents_name as dependents_name,
				eqd.dob as dob
				FROM employee_qualifid_dependents eqd
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
			/* $sql = $this->db->query("
				SELECT *FROM employee
				WHERE emp_id = '{$emp_id}'
				AND company_id = '{$comp_id}'
				AND status = 'Active'
			"); */
			
			$sql = $this->db->query("
				SELECT *FROM employee e
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE e.emp_id = '{$emp_id}'
				AND e.company_id = '{$comp_id}'
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
		 * Record counter
		 * @return user_id
		 */
		public function basic_pay_adjustment_count($comp_id) {
			$sql = "
				SELECT 
				COUNT(e.emp_id) as emp_id
				FROM basic_pay_adjustment bpa
				LEFT JOIN employee e ON bpa.emp_id = e.emp_id
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE e.company_id = '{$comp_id}'
				AND e.status = 'Active'
			";
	        $query = $this->db->query($sql);
	        $row = $query->row();
        	$query->free_result();
        	return $row->emp_id;
	    }
		
		/**
		 * Basic Pay Adjustment
		 * @param unknown_type $comp_id
		 */
		public function basic_pay_adjustment($limit, $start, $comp_id){
			
			if($start==0){
				$sql = $this->db->query("
					SELECT *FROM basic_pay_adjustment bpa
					LEFT JOIN employee e ON bpa.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					WHERE e.company_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$limit."
				");
				
				if($sql->num_rows() > 0){
					$results = $sql->result();
					$sql->free_result();
					return $results;
				}else{
					return FALSE;
				}
			}else{
				$sql = $this->db->query("
					SELECT *FROM basic_pay_adjustment bpa
					LEFT JOIN employee e ON bpa.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					WHERE e.company_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$start.",".$limit."
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
		
		/**
		 * View Employee Termination Information
		 * @param unknown_type $comp_id
		 */
		public function view_emp_termination_info($comp_id){
			$emp_train_det = $this->db->query("
				SELECT *FROM employee_termination
				WHERE company_id = '{$comp_id}'
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
		 * Update Employee Basic Pay Adjustment
		 * @param unknown_type $emp_idEdit
		 * @param unknown_type $current_basic_pay_edit
		 * @param unknown_type $new_basic_pay_edit
		 * @param unknown_type $effective_date_edit
		 * @param unknown_type $adjustment_date_edit
		 * @param unknown_type $reason_for_adjustment_edit
		 * @param unknown_type $attachment_old_val
		 * @param unknown_type $comp_id
		 */
		public function update_basic_pay_adjustment($emp_idEdit,$current_basic_pay_edit,$new_basic_pay_edit,$effective_date_edit,$adjustment_date_edit,$reason_for_adjustment_edit,$attachment_val,$comp_id){
			if($attachment_val == 0){
				$sql = $this->db->query("
					UPDATE basic_pay_adjustment
					SET current_basic_pay = '{$current_basic_pay_edit}', 
					new_basic_pay = '{$new_basic_pay_edit}', 
					effective_date = '{$effective_date_edit}', 
					adjustment_date = '{$adjustment_date_edit}', 
					reasons = '{$reason_for_adjustment_edit}'
					WHERE emp_id = '{$emp_idEdit}'
					AND comp_id = '{$comp_id}'
				");
				
				if($sql){
					return TRUE;
				}else{
					return FALSE;
				}
			}else{
				$sql = $this->db->query("
					UPDATE basic_pay_adjustment
					SET current_basic_pay = '{$current_basic_pay_edit}', 
					new_basic_pay = '{$new_basic_pay_edit}', 
					effective_date = '{$effective_date_edit}', 
					adjustment_date = '{$adjustment_date_edit}', 
					reasons = '{$reason_for_adjustment_edit}', 
					attachment = '{$attachment_val}'
					WHERE emp_id = '{$emp_idEdit}'
					AND comp_id = '{$comp_id}'
				");
				
				if($sql){
					return TRUE;
				}else{
					return FALSE;
				}
			}
		}
		
		/**
		 * Display Employe Termination Information Counter
		 * Enter description here ...
		 * @param unknown_type $comp_id
		 */
		public function termination_counter($comp_id){
			$sql = $this->db->query("
				SELECT 
				COUNT(e.emp_id) as emp_id
				FROM employee_termination et
				LEFT JOIN employee e ON et.emp_id = e.emp_id
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE et.company_id = '{$comp_id}'
				AND e.status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row->emp_id;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Display Employe Termination Information
		 * Enter description here ...
		 * @param unknown_type $comp_id
		 */
		public function termination($limit, $start, $comp_id){
			if($start==0){
				$sql = $this->db->query("
					SELECT *FROM employee_termination et
					LEFT JOIN employee e ON et.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					WHERE et.company_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$limit."
				");
				
				if($sql->num_rows() > 0){
					$results = $sql->result();
					$sql->free_result();
					return $results;
				}else{
					return FALSE;
				}
			}else{
				$sql = $this->db->query("
					SELECT *FROM employee_termination et
					LEFT JOIN employee e ON et.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					WHERE et.company_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$start.",".$limit."
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
		
		/**
		 * Update Employee Termination Information
		 * @param unknown_type $emp_idEdit
		 * @param unknown_type $last_date_edit
		 * @param unknown_type $reason_edit
		 * @param unknown_type $type_edit
		 * @param unknown_type $approval_granted_edit
		 * @param unknown_type $approval_date_edit
		 * @param unknown_type $image_val
		 * @param unknown_type $comp_id
		 */
		public function update_termination_info($emp_idEdit,$last_date_edit,$reason_edit,$type_edit,$approval_granted_edit,$approval_date_edit,$attachment_val,$comp_id){
			if($attachment_val == 0){
				$sql = $this->db->query("
					UPDATE employee_termination
					SET last_date = '{$last_date_edit}', 
					reason = '{$reason_edit}', 
					type = '{$type_edit}', 
					approve_granted = '{$approval_granted_edit}', 
					approval_date = '{$approval_date_edit}'
					WHERE emp_id = '{$emp_idEdit}'
					AND company_id = '{$comp_id}'
				");
				
				if($sql){
					return TRUE;
				}else{
					return FALSE;
				}
			}else{
				$sql = $this->db->query("
					UPDATE employee_termination
					SET last_date = '{$last_date_edit}', 
					reason = '{$reason_edit}', 
					type = '{$type_edit}', 
					approve_granted = '{$approval_granted_edit}', 
					approval_date = '{$approval_date_edit}',
					attachment = '{$attachment_val}'
					WHERE emp_id = '{$emp_idEdit}'
					AND company_id = '{$comp_id}'
				");
				
				if($sql){
					return TRUE;
				}else{
					return FALSE;
				}
			}				
		}
		
		/**
		 * Employee Leave Information Counter
		 * @param unknown_type $comp_id
		 */
		public function emp_leave_counter($comp_id){
			$sql = $this->db->query("
				SELECT 
				COUNT(e.emp_id) as emp_id
				FROM employee_leaves el
				LEFT JOIN employee e ON el.emp_id = e.emp_id
				LEFT JOIN accounts a ON e.account_id = a.account_id
				LEFT JOIN leave_type lt ON el.leave_type_id = lt.leave_type_id
				WHERE el.company_id = '{$comp_id}'
				AND e.status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row->emp_id;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee Leave Information
		 * @param unknown_type $comp_id
		 */
		public function emp_leave($limit, $start, $comp_id){
			if($start==0){
				$sql = $this->db->query("
					SELECT *FROM employee_leaves el
					LEFT JOIN employee e ON el.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					LEFT JOIN leave_type lt ON el.leave_type_id = lt.leave_type_id
					WHERE el.company_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$limit."
				");
				
				if($sql->num_rows() > 0){
					$results = $sql->result();
					$sql->free_result();
					return $results;
				}else{
					return FALSE;
				}
			}else{
				$sql = $this->db->query("
					SELECT *FROM employee_leaves el
					LEFT JOIN employee e ON el.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					LEFT JOIN leave_type lt ON el.leave_type_id = lt.leave_type_id
					WHERE el.company_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$start.",".$limit."
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
		
		/**
		 * Employee Leave Type
		 * Enter description here ...
		 */
		public function leave_type($comp_id){
			$sql = $this->db->query("
				SELECT *FROM leave_type
				WHERE company_id = '{$comp_id}'
				AND status = 'Active'
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
		 * View Employee Leave Information
		 * Enter description here ...
		 * @param unknown_type $comp_id
		 */
		public function view_emp_leave($comp_id){
			$emp_train_det = $this->db->query("
				SELECT *FROM employee_leaves
				WHERE company_id = '{$comp_id}'
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
			
			/*$sql = $this->db->query("
				SELECT *FROM employee e
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE e.company_id = '{$comp_id}'
				AND e.status = 'Active'
				AND e.emp_id NOT IN({$emp_val_notin});
			");*/
			
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
		 * Update Employee Leave Information
		 * @param unknown_type $emp_idEdit
		 * @param unknown_type $leave_type
		 * @param unknown_type $remaining_hours_edit
		 * @param unknown_type $as_of_edit
		 * @param unknown_type $comp_id
		 */
		public function update_leave_info($emp_idEdit,$leave_type,$remaining_hours_edit,$as_of_edit,$comp_id){
			$sql = $this->db->query("
				UPDATE employee_leaves
				SET leave_type_id = '{$leave_type}', 
				leave_credits = '{$remaining_hours_edit}', 
				as_of = '{$as_of_edit}'
				WHERE emp_id = '{$emp_idEdit}'
				AND company_id = '{$comp_id}'
			");
			
			if($sql){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * View Employee Deduction Information
		 * Enter description here ...
		 * @param unknown_type $comp_id
		 */
		public function view_emp_deduction($comp_id){
			$emp_train_det = $this->db->query("
				SELECT *FROM employee_deductions
				WHERE company_id = '{$comp_id}'
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
		 * Employee Deduction Information
		 * @param unknown_type $comp_id
		 */
		public function emp_deduction($limit, $start, $comp_id){
			
			if($start==0){
				$sql = $this->db->query("
					SELECT 
					e.first_name as first_name,
					e.last_name as last_name,
					a.payroll_cloud_id as payroll_cloud_id,
					d.deduction_name as deduction_name,
					ed.amount as amount,
					ed.valid_from as valid_from,
					ed.valid_until as valid_until,
					ed.recurring as recurring,
					ed.emp_id as emp_id
					FROM employee_deductions ed
					LEFT JOIN deduction d ON ed.deduction_type_id = d.deduction_id
					LEFT JOIN employee e ON ed.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					WHERE ed.company_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$limit."
				");
				
				if($sql->num_rows() > 0){
					$results = $sql->result();
					$sql->free_result();
					return $results;
				}else{
					return FALSE;
				}
			}else{
				$sql = $this->db->query("
					SELECT 
					e.first_name as first_name,
					e.last_name as last_name,
					a.payroll_cloud_id as payroll_cloud_id,
					d.deduction_name as deduction_name,
					ed.amount as amount,
					ed.valid_from as valid_from,
					ed.valid_until as valid_until,
					ed.recurring as recurring,
					ed.emp_id as emp_id
					FROM employee_deductions ed
					LEFT JOIN deduction d ON ed.deduction_type_id = d.deduction_id
					LEFT JOIN employee e ON ed.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					WHERE ed.company_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$start.",".$limit."
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
		
		/**
		 * Employee Deduction Information Count
		 * @param unknown_type $comp_id
		 */
		public function emp_deduction_counter($comp_id){
			$sql = $this->db->query("
				SELECT 
				COUNT(e.emp_id) as emp_id
				FROM employee_deductions ed
				LEFT JOIN deduction d ON ed.deduction_type_id = d.deduction_id
				LEFT JOIN employee e ON ed.emp_id = e.emp_id
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE ed.company_id = '{$comp_id}'
				AND e.status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row->emp_id;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Deduction Type
		 * @param unknown_type $comp_id
		 */
		public function emp_deduction_type($comp_id){
			$sql = $this->db->query("
				SELECT *FROM deduction
				WHERE company_id = '{$comp_id}'
				AND status = 'Active'
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
		 * Employee Fixed Allowances Type
		 * @param unknown_type $comp_id
		 */
		public function emp_fixed_allowance_type($comp_id){
			$sql = $this->db->query("
				SELECT *FROM allowance_type
				WHERE company_id = '{$comp_id}'
				AND status = 'Active'
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
		 * Update Employee Deduction Information		 
		 * @param unknown_type $emp_idEdit
		 * @param unknown_type $deduction_type
		 * @param unknown_type $amount_edit
		 * @param unknown_type $valid_from
		 * @param unknown_type $valid_to
		 * @param unknown_type $recurring
		 * @param unknown_type $comp_id
		 */
		public function update_deduction_info($emp_idEdit,$deduction_type,$amount_edit,$valid_from,$valid_to,$recurring,$comp_id){
			$sql = $this->db->query("
				UPDATE employee_deductions
				SET deduction_type_id = '{$deduction_type}', 
				recurring = '{$recurring}', 
				amount = '{$amount_edit}', 
				valid_from = '{$valid_from}', 
				valid_until = '{$valid_to}'
				WHERE emp_id = '{$emp_idEdit}'
				AND company_id = '{$comp_id}'
			");
			
			if($sql){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee Fixed Allowances Counter
		 * @param unknown_type $comp_id
		 */
		public function emp_fixed_allowances_counter($comp_id){
			$sql = $this->db->query("
				SELECT
				COUNT(e.emp_id) as emp_id
				FROM employee_fixed_allowances efd
				LEFT JOIN allowance_type at ON efd.allowance_type_id = at.allowance_type_id
				LEFT JOIN employee e ON efd.emp_id = e.emp_id
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE efd.company_id = '{$comp_id}'
				AND e.status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row->emp_id;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee Fixed Allowances
		 * @param unknown_type $comp_id
		 */
		public function emp_fixed_allowances($limit, $start, $comp_id){
			if($start==0){
				$sql = $this->db->query("
					SELECT
					e.emp_id as emp_id, 
					e.first_name as first_name,
					e.last_name as last_name,
					a.payroll_cloud_id as payroll_cloud_id,
					at.allowance_type_name as allowance_type_name,
					efd.amount as amount,
					efd.taxable as taxable
					FROM employee_fixed_allowances efd
					LEFT JOIN allowance_type at ON efd.allowance_type_id = at.allowance_type_id
					LEFT JOIN employee e ON efd.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					WHERE efd.company_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$limit."
				");
				
				if($sql->num_rows() > 0){
					$results = $sql->result();
					$sql->free_result();
					return $results;
				}else{
					return FALSE;
				}
			}else{
				$sql = $this->db->query("
					SELECT
					e.emp_id as emp_id, 
					e.first_name as first_name,
					e.last_name as last_name,
					a.payroll_cloud_id as payroll_cloud_id,
					at.allowance_type_name as allowance_type_name,
					efd.amount as amount,
					efd.taxable as taxable
					FROM employee_fixed_allowances efd
					LEFT JOIN allowance_type at ON efd.allowance_type_id = at.allowance_type_id
					LEFT JOIN employee e ON efd.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					WHERE efd.company_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$start.",".$limit."
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
		
		/**
		 * View Employee Fixed Allowances Information
		 * Enter description here ...
		 * @param unknown_type $comp_id
		 */
		public function view_emp_fixed_allowances($comp_id){
			$emp_train_det = $this->db->query("
				SELECT *FROM employee_fixed_allowances
				WHERE company_id = '{$comp_id}'
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
		 * Update Employee Fixed Allowance Information		 
		 * @param unknown_type $emp_idEdit
		 * @param unknown_type $deduction_type
		 * @param unknown_type $amount_edit
		 * @param unknown_type $valid_from
		 * @param unknown_type $valid_to
		 * @param unknown_type $recurring
		 * @param unknown_type $comp_id
		 */
		public function update_fixed_allowance($emp_idEdit,$allowance_type,$amount_edit,$taxable_edit,$comp_id){
			$sql = $this->db->query("
				UPDATE employee_fixed_allowances
				SET allowance_type_id = '{$allowance_type}', 
				amount = '{$amount_edit}',
				taxable = '{$taxable_edit}'
				WHERE emp_id = '{$emp_idEdit}'
				AND company_id = '{$comp_id}'
			");
			
			if($sql){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee Earnings Information Counter
		 * @param unknown_type $comp_id
		 */
		public function emp_earnings_counter($comp_id){
			$sql = $this->db->query("
				SELECT
				COUNT(e.emp_id) as emp_id
				FROM employee_earnings ee
				LEFT JOIN employee e ON ee.emp_id = e.emp_id
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE ee.company_id = '{$comp_id}'
				AND e.status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row->emp_id;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee Earnings Information
		 * @param unknown_type $comp_id
		 */
		public function emp_earnings($limit, $start, $comp_id){
			if($start==0){
				$sql = $this->db->query("
					SELECT
					*FROM employee_earnings ee
					LEFT JOIN employee e ON ee.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					WHERE ee.company_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$limit."
				");
				
				if($sql->num_rows() > 0){
					$results = $sql->result();
					$sql->free_result();
					return $results;
				}else{
					return FALSE;
				}
			}else{
				$sql = $this->db->query("
					SELECT
					*FROM employee_earnings ee
					LEFT JOIN employee e ON ee.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					WHERE ee.company_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$start.",".$limit."
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
		
		/**
		 * View Employee Earnings
		 * Enter description here ...
		 * @param unknown_type $comp_id
		 */
		public function view_emp_earnings($comp_id){
			$emp_train_det = $this->db->query("
				SELECT *FROM employee_earnings
				WHERE company_id = '{$comp_id}'
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
		 * Update Employee Earnings Information
		 * @param unknown_type $emp_idEdit
		 * @param unknown_type $minimum_wage_earner
		 * @param unknown_type $statutory_min_wage
		 * @param unknown_type $entitled_to_basic_pay
		 * @param unknown_type $pay_rate_type
		 * @param unknown_type $timesheet_required
		 * @param unknown_type $entitled_to_overtime
		 * @param unknown_type $entitled_to_night_differential_pay
		 * @param unknown_type $night_diff_rate
		 * @param unknown_type $entitled_to_commission
		 * @param unknown_type $entitled_to_holiday_or_premium_pay
		 * @param unknown_type $comp_id
		 */
		public function update_emp_earnings(
							$emp_idEdit,
							$minimum_wage_earner,
							$statutory_min_wage,
							$entitled_to_basic_pay,
							$pay_rate_type,
							$timesheet_required,
							$entitled_to_overtime,
							$entitled_to_night_differential_pay,
							$night_diff_rate,
							$entitled_to_commission,
							$entitled_to_holiday_or_premium_pay,
							$comp_id
						){
			$sql = $this->db->query("
				UPDATE employee_earnings
				SET minimum_wage_earner = '{$minimum_wage_earner}', 
				statutory_min_wage = '{$statutory_min_wage}',
				entitled_to_basic_pay = '{$entitled_to_basic_pay}',
				pay_rate_type = '{$pay_rate_type}',
				timesheet_required = '{$timesheet_required}',
				entitled_to_overtime = '{$entitled_to_overtime}',
				entitled_to_night_differential_pay = '{$entitled_to_night_differential_pay}',
				night_diff_rate = '{$night_diff_rate}',
				entitled_to_commission = '{$entitled_to_commission}',
				entitled_to_holiday_or_premium_pay 	 = '{$entitled_to_holiday_or_premium_pay}'
				WHERE emp_id = '{$emp_idEdit}'
				AND company_id = '{$comp_id}'
			");
			
			if($sql){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee Payroll Information Counter
		 * @param unknown_type $comp_id
		 */
		public function emp_payroll_info_counter($comp_id){
			$sql = $this->db->query("
				SELECT
				COUNT(e.emp_id) as emp_id
				FROM employee_payroll_information epi
				LEFT JOIN employee e ON epi.emp_id = e.emp_id
				LEFT JOIN accounts a ON e.account_id = a.account_id
				LEFT JOIN department d ON epi.department_id = d.dept_id
				LEFT JOIN payroll_group pg ON pg.payroll_group_id = epi.payroll_group_id
				WHERE epi.company_id = '{$comp_id}'
				AND epi.status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row->emp_id;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee Payroll Information
		 * @param unknown_type $comp_id
		 */
		public function emp_payroll_info($limit, $start, $comp_id){
			if($start==0){
				$sql = $this->db->query("
					SELECT
					*FROM employee_payroll_information epi
					LEFT JOIN employee e ON epi.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					LEFT JOIN department d ON epi.department_id = d.dept_id
					LEFT JOIN payroll_group pg ON pg.payroll_group_id = epi.payroll_group_id
					WHERE epi.company_id = '{$comp_id}'
					AND epi.status = 'Active'
					LIMIT ".$limit."
				");
				
				if($sql->num_rows() > 0){
					$results = $sql->result();
					$sql->free_result();
					return $results;
				}else{
					return FALSE;
				}
			}else{
				$sql = $this->db->query("
					SELECT
					*FROM employee_payroll_information epi
					LEFT JOIN employee e ON epi.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					LEFT JOIN department d ON epi.department_id = d.dept_id
					LEFT JOIN payroll_group pg ON pg.payroll_group_id = epi.payroll_group_id
					WHERE epi.company_id = '{$comp_id}'
					AND epi.status = 'Active'
					LIMIT ".$start.",".$limit."
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
		
		/**
		 * View Employee Payroll Information
		 * @param unknown_type $comp_id
		 */
		public function view_emp_payroll_info($comp_id){
			$emp_train_det = $this->db->query("
				SELECT *FROM employee_payroll_information
				WHERE company_id = '{$comp_id}'
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
		 * Department List
		 * @param unknown_type $comp_id
		 */
		public function department_list($comp_id){
			$sql = $this->db->query("
				SELECT *FROM department
				WHERE company_id = '{$comp_id}'
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
		 * Payroll Group List
		 * @param unknown_type $comp_id
		 */
		public function payroll_group($comp_id){
			$sql = $this->db->query("
				SELECT *FROM payroll_group
				WHERE company_id = '{$comp_id}'
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
		 * Update Employee Payroll Information		 
		 * @param unknown_type $emp_idEdit
		 * @param unknown_type $department
		 * @param unknown_type $sub_dept
		 * @param unknown_type $employment_type
		 * @param unknown_type $position
		 * @param unknown_type $date_hired
		 * @param unknown_type $last_date
		 * @param unknown_type $tax_status
		 * @param unknown_type $payment_method
		 * @param unknown_type $bank_route
		 * @param unknown_type $bank_account
		 * @param unknown_type $account_type
		 * @param unknown_type $payroll_group
		 * @param unknown_type $default_project
		 * @param unknown_type $timeSheet_approval_grp
		 * @param unknown_type $overtime_approval_grp
		 * @param unknown_type $leave_approval_grp
		 * @param unknown_type $expense_approval_grp
		 * @param unknown_type $eBundy_approval_grp
		 * @param unknown_type $sss_contribution_amount
		 * @param unknown_type $hdmf_contribution_amount
		 * @param unknown_type $philhealth_contribution_amount
		 * @param unknown_type $witholding_tax
		 * @param unknown_type $cost_center
		 * @param unknown_type $comp_id
		 */
		public function update_emp_payroll_info(
							$emp_idEdit,
							$department,
							$sub_dept,
							$employment_type,
							$position,
							$date_hired,
							$last_date,
							$tax_status,
							$payment_method,
							$bank_route,
							$bank_account,
							$account_type,
							$payroll_group,
							$default_project,
							$timeSheet_approval_grp,
							$overtime_approval_grp,
							$leave_approval_grp,
							$expense_approval_grp,
							$eBundy_approval_grp,
							$sss_contribution_amount,
							$hdmf_contribution_amount,
							$philhealth_contribution_amount,
							$witholding_tax,
							$cost_center,
							$comp_id
						){
			$sql = $this->db->query("
				UPDATE employee_payroll_information
				SET department_id = '{$department}', 
				sub_department_id = '{$sub_dept}',
				employment_type = '{$employment_type}',
				position = '{$position}',
				date_hired = '{$date_hired}',
				last_date = '{$last_date}',
				tax_status = '{$tax_status}',
				payment_method = '{$payment_method}',
				bank_route = '{$bank_route}',
				bank_account 	 = '{$bank_account}',
				account_type 	 = '{$account_type}',
				payroll_group_id 	 = '{$payroll_group}',
				default_project 	 = '{$default_project}',
				timeSheet_approval_grp 	 = '{$timeSheet_approval_grp}',
				overtime_approval_grp 	 = '{$overtime_approval_grp}',
			 	leave_approval_grp 	 = '{$leave_approval_grp}',
			 	expense_approval_grp 	 = '{$expense_approval_grp}',
			 	eBundy_approval_grp 	 = '{$eBundy_approval_grp}',
			 	sss_contribution_amount 	 = '{$sss_contribution_amount}',
			 	hdmf_contribution_amount 	 = '{$hdmf_contribution_amount}',
			 	philhealth_contribution_amount 	 = '{$philhealth_contribution_amount}',
			 	witholding_tax 	 = '{$witholding_tax}',
			 	cost_center 	 = '{$cost_center}'
				WHERE emp_id = '{$emp_idEdit}'
				AND company_id = '{$comp_id}'
			");
			
			if($sql){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee Loans Information Counter
		 * @param unknown_type $comp_id
		 */
		public function emp_loan_counter($comp_id, $emp_id){
			$sql = $this->db->query("
				SELECT 
				COUNT(e.emp_id) as emp_id
				FROM employee_loans el
				LEFT JOIN employee e ON el.emp_id = e.emp_id
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE el.company_id = '{$comp_id}'
				AND e.status = 'Active'
				AND e.emp_id = '{$emp_id}'
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row->emp_id;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee Loans Information
		 * @param unknown_type $comp_id
		 */
		public function emp_loan($limit, $start, $comp_id, $emp_id){
			if($start==0){
				$sql = $this->db->query("
					SELECT 
					*FROM employee_loans el
					LEFT JOIN employee e ON el.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					LEFT JOIN loan_type lt ON el.loan_type_id = lt.loan_type_id
					WHERE el.company_id = '{$comp_id}'
					AND e.status = 'Active'
					AND e.emp_id = '{$emp_id}'
					LIMIT ".$limit."
				");
				
				if($sql->num_rows() > 0){
					$results = $sql->result();
					$sql->free_result();
					return $results;
				}else{
					return FALSE;
				}
			}else{
				$sql = $this->db->query("
					SELECT 
					*FROM employee_loans el
					LEFT JOIN employee e ON el.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					LEFT JOIN loan_type lt ON el.loan_type_id = lt.loan_type_id
					WHERE el.company_id = '{$comp_id}'
					AND e.status = 'Active'
					AND e.emp_id = '{$emp_id}'
					LIMIT ".$start.",".$limit."
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
		
		/**
		 * View Employee Loan Information
		 * Enter description here ...
		 * @param unknown_type $comp_id
		 */
		public function view_emp_loan($comp_id){
			$emp_train_det = $this->db->query("
				SELECT *FROM employee_loans
				WHERE company_id = '{$comp_id}'
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
		 * Update Employee Loan Information
		 * @param unknown_type $emp_idEdit
		 * @param unknown_type $loan_no
		 * @param unknown_type $loan_type
		 * @param unknown_type $date_granted
		 * @param unknown_type $principal
		 * @param unknown_type $terms
		 * @param unknown_type $interest_rate
		 * @param unknown_type $penalty_rate
		 * @param unknown_type $beginning_balance
		 * @param unknown_type $bank_route
		 * @param unknown_type $bank_account
		 * @param unknown_type $account_type
		 * @param unknown_type $monthly_amortization
		 * @param unknown_type $comp_id
		 */
		public function update_loan_info(
						$employee_loans_id,
						$loan_no,
						//$loan_type, 
						$date_granted,
						$principal,
						$terms,
						$interest_rate,
						$penalty_rate,
						$beginning_balance,
						$bank_route,
						$bank_account,
						$account_type,
						$monthly_amortization,
						$comp_id){
			$sql = $this->db->query("
				UPDATE employee_loans
				SET loan_no = '{$loan_no}', 
				date_granted = '{$date_granted}', 
				principal = '{$principal}', 
				terms = '{$terms}',
				interest_rates = '{$interest_rate}',
				penalty_rates = '{$penalty_rate}',
				beginning_balance = '{$beginning_balance}',
				bank_route = '{$bank_route}',
				bank_account = '{$bank_account}',
				account_type = '{$account_type}',
				monthly_amortization = '{$monthly_amortization}'
				WHERE employee_loans_id = '{$employee_loans_id}'
				AND company_id = '{$comp_id}'
			");
			
			if($sql){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee Loan Information
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 */
		public function emp_loan_info($comp_id,$emp_id){
			$sql = $this->db->query("
				SELECT *FROM employee e
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE e.company_id = '{$comp_id}'
				AND e.emp_id = '{$emp_id}'
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee Loan Type Record Information
		 * @param unknown_type $comp_id
		 * @param unknown_type $emp_id
		 */
		public function loan_type_rec($comp_id, $emp_id){
			$emp_train_det = $this->db->query("
				SELECT *FROM employee_loans
				WHERE company_id = '{$comp_id}'
				AND emp_id = '{$emp_id}'
			");
			
			$result_emp_train_det = $emp_train_det->result();
			$result_array = "";
			if($emp_train_det->num_rows() > 0){
				foreach($result_emp_train_det as $row){
					$result_array .= $row->loan_type_id.",";
				}
				$emp_val_notin = substr($result_array, 0, -1);	
			}else{
				$emp_val_notin = 0;
			}
			
			$sql = $this->db->query("
				SELECT *FROM loan_type
				WHERE company_id = '{$comp_id}'
				AND status = 'Active'
				AND loan_type_id NOT IN({$emp_val_notin});
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
		 * Employee Loans Information for Company Counter
		 * @param unknown_type $comp_id
		 */
		public function emp_loan_counter_comp($comp_id){
			/*
			 * $sql2 = $this->db->query("
				SELECT *
				FROM employee_loans el
				WHERE company_id = '{$comp_id}'
				AND status = 'Active'
				GROUP BY el.emp_id
			")
			if($sql->num_rows() > 0){
				return $sql->num_rows();
			}else{
				return FALSE;
			}
			*/;
			
			$sql = $this->db->query("
				SELECT
				COUNT(emp_id) as total
				FROM employee e
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE e.company_id = '{$comp_id}'
				AND e.status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row->total;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee Loans Information for Company
		 * @param unknown_type $comp_id
		 */
		public function emp_loan_comp($limit, $start, $comp_id){
			if($start==0){
				/* $sql = $this->db->query("
					SELECT 
					*FROM employee_loans el
					LEFT JOIN employee e ON el.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					LEFT JOIN loan_type lt ON el.loan_type_id = lt.loan_type_id
					WHERE el.company_id = '{$comp_id}'
					AND e.status = 'Active'
					GROUP BY e.emp_id
					LIMIT ".$limit."
				"); */
				
				$sql = $this->db->query("
					SELECT					
					*FROM employee e
					LEFT JOIN accounts a ON e.account_id = a.account_id
					WHERE e.company_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$limit."
				");
				
				if($sql->num_rows() > 0){
					$results = $sql->result();
					$sql->free_result();
					return $results;
				}else{
					return FALSE;
				}
			}else{
				/* $sql = $this->db->query("
					SELECT 
					*FROM employee_loans el
					LEFT JOIN employee e ON el.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					WHERE el.company_id = '{$comp_id}'
					AND e.status = 'Active'
					GROUP BY e.emp_id
					LIMIT ".$start.",".$limit."
				"); */
				
				$sql = $this->db->query("
					SELECT
					*FROM employee e
					LEFT JOIN accounts a ON e.account_id = a.account_id
					WHERE e.company_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$start.",".$limit."
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
		
		/**
		 * Employee Loan No Information Counter
		 * @param unknown_type $comp_id
		 */
		public function emp_loan_counter_no($comp_id, $loan_id){
			$sql = $this->db->query("
				SELECT 
				COUNT(e.emp_id) as emp_id
				FROM employee_loans el
				LEFT JOIN employee e ON el.emp_id = e.emp_id
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE el.company_id = '{$comp_id}'
				AND e.status = 'Active'
				AND el.employee_loans_id = '{$loan_id}'
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row->emp_id;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee Loans Information
		 * @param unknown_type $comp_id
		 */
		public function emp_loan_no($limit, $start, $comp_id, $loan_id){
			if($start==0){
				$sql = $this->db->query("
					SELECT 
					*FROM employee_loans el
					LEFT JOIN employee e ON el.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					LEFT JOIN loan_type lt ON el.loan_type_id = lt.loan_type_id
					WHERE el.company_id = '{$comp_id}'
					AND e.status = 'Active'
					AND el.employee_loans_id = '{$loan_id}'
					LIMIT ".$limit."
				");
				
				if($sql->num_rows() > 0){
					$results = $sql->result();
					$sql->free_result();
					return $results;
				}else{
					return FALSE;
				}
			}else{
				$sql = $this->db->query("
					SELECT 
					*FROM employee_loans el
					LEFT JOIN employee e ON el.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					WHERE el.company_id = '{$comp_id}'
					AND e.status = 'Active'
					AND el.employee_loans_id = '{$loan_id}'
					LIMIT ".$start.",".$limit."
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
		
		/**
		 * Employee Loan No Information
		 * @param unknown_type $comp_id
		 */
		public function emp_loan_no_group($comp_id, $loan_id){
			$sql = $this->db->query("
				SELECT 
				*FROM employee_loans el
				LEFT JOIN employee e ON el.emp_id = e.emp_id
				LEFT JOIN accounts a ON e.account_id = a.account_id
				LEFT JOIN loan_type lt ON el.loan_type_id = lt.loan_type_id
				WHERE el.company_id = '{$comp_id}'
				AND e.status = 'Active'
				AND el.employee_loans_id = '{$loan_id}'
				GROUP BY e.emp_id
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee Amortization Schedule Information Counter
		 * @param unknown_type $comp_id
		 */
		public function emp_amortization_sched_counter($comp_id, $loan_id){
			$sql = $this->db->query("
				SELECT 
				COUNT(employee_amortization_schedule_id) as employee_amortization_schedule_id
				FROM employee_amortization_schedule
				WHERE comp_id = '{$comp_id}'
				AND emp_loan_id = '{$loan_id}'
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row->employee_amortization_schedule_id;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee Amortization Schedule Information
		 * @param unknown_type $comp_id
		 */
		public function emp_amortization_sched($limit, $start, $comp_id, $loan_id){
			if($start==0){
				$sql = $this->db->query("
					SELECT 
					*FROM employee_amortization_schedule
					WHERE comp_id = '{$comp_id}'
					AND emp_loan_id = '{$loan_id}'
					LIMIT ".$limit."
				");
				
				if($sql->num_rows() > 0){
					$results = $sql->result();
					$sql->free_result();
					return $results;
				}else{
					return FALSE;
				}
			}else{
				$sql = $this->db->query("
					SELECT 
					*FROM employee_amortization_schedule
					WHERE comp_id = '{$comp_id}'
					AND emp_loan_id = '{$loan_id}'
					LIMIT ".$start.",".$limit."
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
		
		/**
		 * Employee Payment History Information Counter
		 * @param unknown_type $comp_id
		 */
		public function emp_payment_history_counter($comp_id, $loan_id){
			$sql = $this->db->query("
				SELECT 
				COUNT(employee_loans_id) as employee_loans_id 
				FROM employee_payment_history
				WHERE comp_id = '{$comp_id}'
				AND employee_loans_id = '{$loan_id}'
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row->employee_loans_id;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee Payment History Information
		 * @param unknown_type $comp_id
		 */
		public function emp_payment_history($limit, $start, $comp_id, $loan_id){
			if($start==0){
				$sql = $this->db->query("
					SELECT 
					*FROM employee_payment_history
					WHERE comp_id = '{$comp_id}'
					AND employee_loans_id = '{$loan_id}'
					LIMIT ".$limit."
				");
				
				if($sql->num_rows() > 0){
					$results = $sql->result();
					$sql->free_result();
					return $results;
				}else{
					return FALSE;
				}
			}else{
				$sql = $this->db->query("
					SELECT 
					*FROM employee_payment_history
					WHERE comp_id = '{$comp_id}'
					AND employee_loans_id = '{$loan_id}'
					LIMIT ".$start.",".$limit."
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
		
		/**
		 * Employee Update Amortization Information
		 * @param unknown_type $employee_amortization_schedule_id
		 * @param unknown_type $payroll_date
		 * @param unknown_type $payment
		 * @param unknown_type $interest
		 * @param unknown_type $principal
		 * @param unknown_type $comp_id
		 */
		public function update_amortization_info(
						$employee_amortization_schedule_id,
						$payroll_date,
						$payment,
						$interest,
						$principal,
						$comp_id){
			$sql = $this->db->query("
				UPDATE employee_amortization_schedule
				SET payroll_date = '{$payroll_date}', 
				payment = '{$payment}', 
				interest = '{$interest}', 
				principal = '{$principal}'
				WHERE employee_amortization_schedule_id = '{$employee_amortization_schedule_id}'
				AND comp_id = '{$comp_id}'
			");
			
			if($sql){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Update Employee Payment History
		 * @param unknown_type $employee_payment_history_id
		 * @param unknown_type $interest
		 * @param unknown_type $principal
		 * @param unknown_type $credit_balance_on_principal
		 * @param unknown_type $credit_balance_on_interest
		 * @param unknown_type $penalty
		 * @param unknown_type $comp_id
		 */
		public function update_payment_history(
						$employee_payment_history_id,
						$interest,
						$principal,
						$credit_balance_on_principal,
						$credit_balance_on_interest,
						$penalty,
						$comp_id
						){
			$sql = $this->db->query("
				UPDATE employee_payment_history
				SET interest = '{$interest}', 
				principal = '{$principal}', 
				credit_balance_on_principal = '{$credit_balance_on_principal}', 
				credit_balance_on_interest = '{$credit_balance_on_interest}',
				penalty = '{$penalty}'
				WHERE  	employee_payment_history_id = '{$employee_payment_history_id}'
				AND comp_id = '{$comp_id}'
			");
			
			if($sql){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee Shift Information Counter
		 * @param unknown_type $limit
		 * @param unknown_type $start
		 * @param unknown_type $comp_id
		 */
		public function emp_shift_counter($comp_id){
			$sql = $this->db->query("
				SELECT 
				COUNT(ess.shifts_schedule_id) as total
				FROM employee_shifts_schedule ess
				LEFT JOIN employee e ON ess.emp_id = e.emp_id
				LEFT JOIN accounts a ON e.account_id = a.account_id
				LEFT JOIN payroll_group pg ON ess.payroll_group_id = pg.payroll_group_id
				WHERE e.company_id = '{$comp_id}'
				AND e.status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$row = $sql->row();
				$sql->free_result();
				return $row->total;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Employee Shift Information
		 * @param unknown_type $limit
		 * @param unknown_type $start
		 * @param unknown_type $comp_id
		 */
		public function emp_shift($limit, $start, $comp_id){
			if($start==0){
				$sql = $this->db->query("
					SELECT *FROM employee_shifts_schedule ess
					LEFT JOIN employee e ON ess.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					LEFT JOIN payroll_group pg ON ess.payroll_group_id = pg.payroll_group_id
					WHERE e.company_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$limit."
				");
				
				if($sql->num_rows() > 0){
					$results = $sql->result();
					$sql->free_result();
					return $results;
				}else{
					return FALSE;
				}	
			}else{
				$sql = $this->db->query("
					SELECT *FROM employee_shifts_schedule ess
					LEFT JOIN employee e ON ess.emp_id = e.emp_id
					LEFT JOIN accounts a ON e.account_id = a.account_id
					WHERE e.company_id = '{$comp_id}'
					AND e.status = 'Active'
					LIMIT ".$start.",".$limit."
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
		
		/**
		 * Employee for Shift Information
		 * @param unknown_type $comp_id
		 */
		public function emp_shift_listing($comp_id){
			$emp_train_det = $this->db->query("
				SELECT *FROM employee_shifts_schedule
				WHERE company_id = '{$comp_id}'
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
			
			/*
			$sql2 = $this->db->query("
				SELECT *FROM employee e
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE e.company_id = '{$comp_id}'
				AND e.status = 'Active'
				AND e.emp_id NOT IN({$emp_val_notin});
			");
			*/
			
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
		 * Display Employee Shift Information
		 * @param unknown_type $shifts_schedule_id
		 * @param unknown_type $comp_id
		 */
		public function emp_shift_info($shifts_schedule_id,$comp_id){
			$sql = $this->db->query("
				SELECT *,ess.payroll_group_id as main_payroll_group_id
				FROM employee_shifts_schedule ess
				LEFT JOIN employee e ON ess.emp_id = e.emp_id
				WHERE ess.shifts_schedule_id = '{$shifts_schedule_id}'
				AND ess.company_id = '{$comp_id}'
				AND ess.status = 'Active'
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
		 * Update Employee Shift Information
		 * @param unknown_type $shifts_schedule_id
		 * @param unknown_type $valid_from
		 * @param unknown_type $until
		 * @param unknown_type $sunday
		 * @param unknown_type $monday
		 * @param unknown_type $tuesday
		 * @param unknown_type $wednesday
		 * @param unknown_type $thursday
		 * @param unknown_type $friday
		 * @param unknown_type $saturday
		 * @param unknown_type $comp_id
		 */
		public function update_shift_info(
				$shifts_schedule_id,
				$valid_from,
				$until,
				$payroll_group_edit,
				$comp_id){
			$sql = $this->db->query("
				UPDATE employee_shifts_schedule
				SET valid_from = '{$valid_from}', 
				until = '{$until}', 
				payroll_group_id = '{$payroll_group_edit}' 
				WHERE shifts_schedule_id = '{$shifts_schedule_id}'
				AND company_id = '{$comp_id}'
			");
			
			if($sql){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		/**
		 * Search Shift Employee Information
		 * @param unknown_type $emp_no
		 * @param unknown_type $emp_name
		 */
		public function search_shift_emp_name($emp_name){
			$sql = $this->db->query("
				SELECT *FROM employee_shifts_schedule ess
				LEFT JOIN employee e ON ess.emp_id = e.emp_id
				LEFT JOIN accounts a ON e.account_id = a.account_id
				LEFT JOIN payroll_group pg ON ess.payroll_group_id = pg.payroll_group_id
				WHERE concat(e.first_name,' ',e.last_name) LIKE '%{$emp_name}%'
				AND e.status = 'Active'
				LIMIT 10
			");
			$results = $sql->result();
			if($sql->num_rows() > 0){
				$sql->free_result();
				return $results;
			}else{
				return false;
			}
		}
		
		/**
		 * Search Shift Employee Information
		 * @param unknown_type $emp_no
		 * @param unknown_type $emp_name
		 */
		public function search_shift_emp_no($emp_no){
			$sql = $this->db->query("
				SELECT *FROM employee_shifts_schedule ess
				LEFT JOIN employee e ON ess.emp_id = e.emp_id
				LEFT JOIN accounts a ON e.account_id = a.account_id
				LEFT JOIN payroll_group pg ON ess.payroll_group_id = pg.payroll_group_id
				WHERE a.payroll_cloud_id LIKE '%{$emp_no}%'
				AND e.status = 'Active'
				LIMIT 10
			");
			$results = $sql->result();
			if($sql->num_rows() > 0){
				$sql->free_result();
				return $results;
			}else{
				return false;
			}
		}
		
		/**
		 * Check Employee Loan ID
		 * @param unknown_type $emp_id
		 * @param unknown_type $comp_id
		 */
		public function check_emp_loan_id($emp_id,$comp_id){
			$sql = $this->db->query("
				SELECT 
				*FROM employee
				WHERE emp_id = '{$emp_id}'
				AND company_id = '{$comp_id}'
				AND status = 'Active'
			");
			$results = $sql->result();
			if($sql->num_rows() > 0){
				return true;
			}else{
				return false;
			}
		}
		
		/**
		 * Check Employee Amortization Schedule ID		 
		 * @param unknown_type $amor_sched_id
		 * @param unknown_type $comp_id
		 */
		public function check_amortization_sched_id($emp_loan_id,$comp_id){
			/* $sql = $this->db->query("
				SELECT 
				*FROM employee_amortization_schedule
				WHERE comp_id = '{$comp_id}'
				AND employee_amortization_schedule_id = '{$amor_sched_id}'
				AND status = 'Active'
			"); */
			$sql = $this->db->query("
				SELECT 
				*FROM employee_loans
				WHERE company_id = '{$comp_id}'
				AND employee_loans_id = '{$emp_loan_id}'
				AND status = 'Active'
			");
			$results = $sql->result();
			if($sql->num_rows() > 0){
				return true;
			}else{
				return false;
			}
		}
		
		/**
		 * Employee Loan Amount
		 * @param unknown_type $loan_id
		 * @param unknown_type $comp_id
		 */
		public function loan_amount($loan_id,$comp_id){
			$sql = $this->db->query("
				SELECT 
				*FROM employee_loans
				WHERE company_id = '{$comp_id}'
				AND employee_loans_id = '{$loan_id}'
				AND status = 'Active'
			");
			$row = $sql->row();
			if($sql->num_rows() > 0){
				return $row->principal;
			}else{
				return false;
			}
		}
		
		/**
		 * Total Principal Amount Amortization
		 * @param unknown_type $loan_id
		 * @param unknown_type $comp_id
		 */
		public function total_princiapl_amortization($loan_id,$comp_id){
			$sql = $this->db->query("
				SELECT 
				*FROM employee_amortization_schedule
				WHERE comp_id = '{$comp_id}'
				AND emp_loan_id = '{$loan_id}'
				AND status = 'Active'
			");
			$result = $sql->result();
			if($sql->num_rows() > 0){
				$total_val = 0;
				foreach($result as $row){
					$total_val = $total_val + $row->principal;
				}
				return $total_val;
			}else{
				return false;
			}
		}
		
		/**
		 * Get Interest and Principal Value
		 * @param unknown_type $get_kapila_ka_row
		 * @param unknown_type $comp_id
		 */
		public function get_interest_principal($amotization_id, $get_kapila_ka_row,$comp_id){
			$sql = $this->db->query("
				SELECT 
				*FROM employee_amortization_schedule
				WHERE comp_id = '{$comp_id}'
				AND emp_loan_id = '{$amotization_id}'
				AND status = 'Active'
				LIMIT {$get_kapila_ka_row},1
			");
			$row = $sql->row();
			if($sql->num_rows() > 0){
				$sql->free_result();
				return $row;
			}else{
				return false;
			}
		}

		/**
		 * Get Interest and Principal Value from Payment History
		 * Enter description here ...
		 * @param unknown_type $amotization_id
		 * @param unknown_type $comp_id
		 */
		public function kapila_ka_row_interest_principal($loan_id, $comp_id){
			$sql = $this->db->query("
				SELECT 
				*FROM employee_payment_history
				WHERE comp_id = '{$comp_id}'
				AND employee_loans_id = '{$loan_id}'
				AND status = 'Active'
			");
			$row = $sql->row();
			if($sql->num_rows() > 0){
				$kapila_ka_row_res = $sql->num_rows() + 1;
				return $kapila_ka_row_res;
			}else{
				$kapila_ka_row_res = 1;
				return $kapila_ka_row_res;
			}
		}
		
		/**
		 * Payment Debit Amount / Remaining Cash Amount
		 * @param unknown_type $loan_id
		 * @param unknown_type $comp_id
		 */
		public function payment_debit_amount($loan_id, $comp_id){
			$sql = $this->db->query("
				SELECT *
				FROM `employee_payment_history`
				WHERE comp_id = '{$comp_id}'
				AND employee_loans_id = '{$loan_id}'
				AND status = 'Active'
				ORDER BY employee_payment_history_id DESC
				LIMIT 1
			");
			$row = $sql->row();
			if($sql->num_rows() > 0){
				$sql->free_result();
				return $row->remaining_cash_amount;
			}else{
				return 0;
			}
		}
		
		/**
		 * Check Employee Email Address
		 * @param $email
		 * @param $old_email
		 */
		public function update_check_email_address($old_email, $email){
			$query = $this->db->query("
				SELECT *FROM accounts
				WHERE email = '{$email}'
				AND deleted = '0'
			");
			$results = $query->row();
			if($query->num_rows() == 0){
				return true;
			}else{
				if($results->email == $old_email){
					return true;
				}else{
					return false;
				}
			}
		}
		
		/**
		 * View Approver Information
		 * @param unknown_type $name_approver
		 * @param unknown_type $comp_id
		 */
		public function view_approver($name_approver,$comp_id){
			$sql = $this->db->query("
				SELECT 
				*, ag.emp_id as emp_id FROM approval_process ap
				LEFT JOIN approval_groups ag ON ap.approval_process_id = ag.approval_process_id
				LEFT JOIN employee e ON e.emp_id = ag.emp_id
				WHERE ap.company_id = '{$comp_id}'
				AND ap.name = '{$name_approver}'
			");
			$result = $sql->result();
			if($sql->num_rows() > 0){
				$sql->free_result();
				return $result;
			}else{
				return false;
			}
		}
		
		/**
		 * View Cost Center Information
		 * @param unknown_type $comp_id
		 */
		public function view_costcenter($comp_id){
			$sql = $this->db->query("
				SELECT 
				*FROM cost_center
				WHERE company_id = '{$comp_id}'
				AND status = 'Active'
			");
			$result = $sql->result();
			if($sql->num_rows() > 0){
				$sql->free_result();
				return $result;
			}else{
				return false;
			}
		}
		
	}
	
/* End of file Hr_employee_model.php */
/* Location: ./application/models/hr/Hr_employee_model.php */