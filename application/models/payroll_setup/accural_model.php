<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accural_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
    
    /**
     * Accural List
     * @param unknown_type $comp_id
     */
    public function my_accural($comp_id){
    	$sql = $this->db->query("
    		SELECT *FROM accural
    		WHERE comp_id = '{$comp_id}'
    		AND status = 'Active'
    	");
    	if($sql->num_rows() > 0){
    		$results = $sql->result();
    		$sql->free_result();
    		return $results;
    	}
    }
    
    /**
     * Deleted Accural Information
     * @param unknown_type $accural_id
     * @param unknown_type $comp_id
     */
    public function del_accural($accural_id,$comp_id){
    	$sql = $this->db->query("
    		DELETE FROM accural
    		WHERE accural_id = '{$accural_id}'
    		AND comp_id = '{$comp_id}'
    	");
    	
    	if($sql){
    		return true;
    	}
    }
    
    /**
     * Get Accural Information
     * @param unknown_type $accural_id
     * @param unknown_type $comp_id
     */
    public function get_accural($accural_id,$comp_id){
    	$sql = $this->db->query("
    		SELECT *FROM accural
    		WHERE comp_id = '{$comp_id}'
    		AND status = 'Active'
    		AND accural_id = '{$accural_id}'
    	");
    	if($sql->num_rows() > 0){
    		$row = $sql->row();
    		$sql->free_result();
    		return $row;
    	}
    }
    
    /**
     * Update Accural Information
     * @param unknown_type $name
     * @param unknown_type $item_one
     * @param unknown_type $item_two
     * @param unknown_type $item_three
     * @param unknown_type $item_three
     * @param unknown_type $formula
     * @param unknown_type $comp_id
     */
    public function update_accural_info(
					$name,$item_one,$item_two,$item_three,$item_three,$formula,$accural_id,$comp_id
	){
		$sql = $this->db->query("
			UPDATE accural SET
			accural_name = '{$name}',
			item_one = '{$item_one}',
			item_two = '{$item_two}',
			item_three = '{$item_three}',
			formula = '{$formula}'
			WHERE comp_id = '{$comp_id}'
			AND accural_id = '{$accural_id}'
		");

		if($sql){
			return true;
		}
	}
    
}
/* End of file */