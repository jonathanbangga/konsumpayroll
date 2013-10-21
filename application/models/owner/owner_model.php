<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * owner Global Model
 *
 * @category Model
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Owner_model extends CI_Model {
		
		/**
		 * Company List
		 * @param unknown_type $company_owner_id
		 */
		public function company_list($company_owner_id){
			$sql = $this->db->query("
				SELECT *FROM company
				WHERE company_owner_id = '{$company_owner_id}'
				AND status = 'active'
			");
			
			if($sql->num_rows() > 0){
				$result = $sql->result();
				$sql->free_result();
				return $result;
			}else{
				return false;
			}
		}
		
	}
	
/* End of file owner_model.php */
/* Location: ./application/models/owner/owner_model.php */