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
				SELECT *FROM employee_qualifid_dependents
				WHERE emp_id = '{$emp_id}' 
				AND company_id = '{$comp_id}'
				AND status = 'Active'
			");
			
			if($sql->num_rows() > 0){
				$results = $sql->result();
				$sql->free_result();
				foreach($results as $row){
					$table[] = '
						<tr class="clear_tbl">
			              <td><input onclick="checkCheckBox();" type="checkbox" name="qual_dep[]" class="qual_depid_cb" value="'.$row->qualified_dependents_id.'"></td>
			              <td>'.$row->qualified_dependents_id.'</td>
			              <td>'.$row->dependents_name.'</td>
			              <td>'.$row->dob.'</td>	
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
		 * View Employee
		 * @param unknown_type $comp_id
		 */
		public function view_employee($comp_id){
			$sql = $this->db->query("
				SELECT *FROM employee e
				LEFT JOIN accounts a ON e.account_id = a.account_id
				WHERE e.company_id = '{$comp_id}'
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