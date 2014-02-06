<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*	Helper : global helpers
*	Author : Christopher Cuizon <christophercuizons@gmail.com>
*	Usage  : Use for all
*/
	
	/**
	 * Defines csrf token name for global purposes only 
	 * @return csrf_token_name
	 */
	function itoken_name(){
		$CI =& get_instance();
		return $CI->config->item('csrf_token_name');
	}
	
	/**
	 * Defines the csrf cookie name
	 * @return csrf_cookie_name
	 * @example itoken_cookie() or javascript 
	 * @uses jQuery.token("< ? php echo itoken_cookie(); ? >");
	 */
	function itoken_cookie(){
		$CI =& get_instance();
		return $CI->config->item('csrf_cookie_name');
	}

	/**
	 * Checks users is admin
	 * @return object
	 */
	function check_user_admin(){
		$CI =& get_instance();
		$id = $CI->session->userdata('account_id');
		$query = $CI->db->get_where("konsum_admin",array("account_id"=>$id));
		$row = $query->row();
		return $row;
	}
	
	/**
	*  	creates a folder of every company 
	*  	@param int id
	*	@returns object 
	**/
	function create_comp_directory($id){
		$CI =& get_instance();
		$dir = "uploads/companies/";
		if($id !=""){
			if(!is_dir($dir.$id)) {
				$folder = array("folder"=>$id,"pdf"=>$id."/pdf","excel"=>$id."/excel");
				foreach($folder as $key){				
					mkdir($dir.$key,0755,true);
				}
			}	
		}else{
			return false;
		}
	}
	
	/**
	 * Photo upload for helper only
	 * @param string $path
	 * @param int $max_size
	 * @param int $max_width
	 * @param int $max_height
	 * @return object
	 */
	function photo_upload($path="./uploads/",$max_size= 3000,$max_width=3024,$max_height=3000){
		$CI =& get_instance();
		//TRIGGER AJAX CHANGE CHMODE Para choi
		if(is_dir($path)){
			chmod("./uploads",0777);
			chmod("./uploads/companies",0777);
			chmod($path,0777);
		}
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= $max_size;
		$config['max_width']  = $max_width;
		$config['max_height']  = $max_height;
		$config['encrypt_name'] = TRUE;
		$CI->load->library('upload', $config);
		if(!$CI->upload->do_upload('upload')) {
			$error = array("status"=>"0",'error' => $CI->upload->display_errors(),'upload_data'=>'');
			return $error;
		} else {
			$data = array("status"=>"1",'error'=>'','upload_data' => $CI->upload->data());
			chmod("./uploads",0755);
			chmod("./uploads/companies",0755);
			chmod($path,0755);
			return $data;
		}
	}
	
	/**
	 * Global remover of photos
	 * @param string $filename @example(christophercuizon@gmail.com)
	 * @param int $company_id @example (session company id)
	 * @param string $path_location @example (i have predefined ./upload/companies but you can change 
	 * @return boolean
	 */
	function remove_photo($filename,$company_id,$path_location="./uploads/companies/"){
		$upload_path = $path_location."/{$company_id}/";
		if($filename && $company_id){
			if(file_exists($upload_path.$filename)){
				$f = $upload_path.$filename;
				unlink($f);
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	/**
	 * Checks the date today  
	 * @return date
	 */
	function date_today(){
		return date("Y-m-d");
	}
	
	/**
	*	Check subdomains for validaties 
	*	@return object
	*/
	function subdomain_checker(){
		$CI =& get_instance();
		$subdomain = trim($CI->db->escape_str($CI->uri->segment(1)));
		$query = $CI->db->get_where("company",array("sub_domain"=>$subdomain,"status"=>"Active","deleted"=>"0"));
		$num_rows = $query->num_rows();
		$rows = $query->row();
		$query->free_result();
		return $num_rows ? $rows : false;
	}
	
	/**
	 * Message Empty String
	 * @return string
	 */
	function msg_empty(){
		$msg_emp = "No items on this table yet.";
		return $msg_emp;
	}
	
	/**
	 * DELETES COMPANY SESSION CLEAR THEM OUT
	 * return VOID
	 */
	function delete_company_session(){
		$CI =& get_instance();
		return $CI->session->unset_userdata("company_id");
	}
	
	/**
	 * Image check if valid otherwise restore default image
	 * validates image fetch
	 * @param string $image
	 * @param int $company_id
	 * @param string $no_image
	 * @return string
	 */
	function image_exist($image,$company_id,$no_image="/assets/theme_2013/images/photo_not_available.png"){
		$image_val = "./uploads/companies/";
		if($image != ""){
			return (file_exists($image_val.$company_id."/".$image)) ? $image_val.$company_id."/".$image : $no_image;
		}else{
			return $no_image;
		}
	}
	
	/**
	 * Checks whose company has been handled by the right 
	 * return object
	 */
	function whose_company(){
		$CI =& get_instance();
		$psa_id = $CI->session->userdata("psa_id");
		$company_name = trim($CI->db->escape_str($CI->uri->segment(1)));
		if(is_numeric($psa_id)){
		$query = $CI->db->query("
									SELECT * FROM assigned_company ac
									LEFT JOIN company c on c.company_id = ac.company_id
									WHERE ac.payroll_system_account_id = {$psa_id} AND c.sub_domain = '{$company_name}'
								");
		$row = $query->row();
		return $row;
		}else{
			return false;
		}
	}
		
	function icompany_logo(){	
		$CI =& get_instance();
		
		if($CI->uri->segment(2) == 'company_setup' || $CI->uri->segment(2) == 'hr_setup' || $CI->uri->segment(2) == 'payroll_setup'){
			if($CI->session->userdata("company_id")){
				$q = $CI->db->query("SELECT * FROM company WHERE company_id = {$CI->session->userdata("company_id")}");
				$res = $q->row();
				$q->free_result();
				return image_exist($res->company_logo,$res->company_id);
			}else{
				return '/assets/theme_2013/images/photo_not_available.png';
			}
		}else if($CI->uri->segment(1) == "admin"){
			return '/assets/theme_2013/images/img-logo2.jpg';
		}else{
			$company = whose_company();
			if($company){
				$q = $CI->db->query("SELECT * FROM assigned_company ac LEFT JOIN company c on c.company_id = ac.company_id WHERE c.sub_domain = '".$company->sub_domain."'");
				$res = $q->row();
				$q->free_result();
				return image_exist($res->company_logo,$res->company_id);
			}else{
				return '/assets/theme_2013/images/photo_not_available.png';
			}
		}
	}
	
	/**
	 * Replaces spaces with underscore
	 * Enter description here ...
	 * @param string $text
	 */
	function replace_space($text) { 
	    $text = strtolower(htmlentities($text)); 
	    $text = str_replace(get_html_translation_table(), "_", $text);
	    $text = str_replace(" ", "_", $text);
	   	$text = str_replace("-", "_", $text);
	    $text = preg_replace("/[_]+/i", "_", $text);
	    return $text;
	}
	
	/**
	 * Prices amount global
	 * @param numeric $amount
	 */
	function iprice($amount){
		if($amount >= 0){
			return number_format($amount,2);
		}else{
			return false;
		}
	}
	
	/**
	 * Intelligent exports 
	 * This helper will help you achieve enumerous exports such as csv and xls 
	 * @version asherot
	 * @param string $contents
	 * @param enum $type (@example xls, csv)
	 * @param string $filename
	 * @return literature modules
	 */
	function module_literature($contents,$type,$filename="export"){
		if($type){
			switch($type):
				case "xls":
					header('Content-type: application/vnd.ms-excel');
				    header("Content-Disposition: attachment; filename={$filename}.xls");
				    header("Pragma: no-cache");
				    header("Expires: 0"); 
					$output = $contents;
					echo $output;
					return true;
				break;
				case "csv":
					$clean = str_replace("\t",",",$contents);
					header('Content-type: application/csv');
					header('Content-Disposition: attachment; filename='.$filename.'.csv');
					$output = $clean;
					echo $output;
					return true;
				break;
			endswitch;
		}else{
			return false;
		}
	}
	
	/**
	 * THIS WILL CHECK THE lEAVE APPlICATION DETAILS 
	 * USED FOR CHECKING EMPLOYEE IDS 
	 * @param int $employee_leaves_application_id
	 * @return object
	 */
	function check_leave_application($employee_leaves_application_id){
		$CI =& get_instance();
		if(is_numeric($employee_leaves_application_id)){
			$query = $CI->db->get_where("employee_leaves_application",array("employee_leaves_application_id"=>$employee_leaves_application_id));
			$row = $query->row();
			$query->free_result();
			return $row;
		}else{
			return false;
		}
	}
	
	/**
	 * CHECK OVERTIME APPLICATION DETAILS
	 * USED FOR CHECKING EMPLOYEE IDS
	 * @param int $overtime_id
	 */
	function check_overtime_application($overtime_id){
		$CI =& get_instance();
		if(is_numeric($overtime_id)){
			$query = $CI->db->get_where("employee_overtime_application",array("overtime_id"=>$overtime_id));
			$row = $query->row();
			$query->free_result();
			return $row;
		}else{
			return false;
		}
	}
	
	/**
	 * Employee Name
	 * @param unknown_type $emp_id
	 */
	function emp_name($emp_id){
		$CI =& get_instance();
		$sql = $CI->db->query("
			SELECT *FROM employee
			WHERE emp_id = '{$emp_id}'
			AND status = 'Active'
			AND deleted = '0'
		"); 
		$row = $sql->row();
		$sql->free_result();
		return ucwords($row->first_name)." ".ucwords($row->last_name);
	}
	
	/**
	 * Cost Center 
	 * @param unknown_type $cost_center_id
	 */
	function cost_center($cost_center_id){
		$CI =& get_instance();
		$sql = $CI->db->query("
			SELECT 
			*FROM cost_center
			WHERE cost_center_id = '{$cost_center_id}'
			AND status = 'Active'
		");
		$row = $sql->row();
		$sql->free_result();
		return $row->cost_center_code;
	}
	
	/**
	 * Deduction Payroll Group Name
	 * @param unknown_type $id
	 * @param unknown_type $field
	 */
	function deduction_payroll_group($id,$field){
		$CI =& get_instance();
		$sql = $CI->db->query("
			SELECT 
			*FROM deductions_payroll_group
			WHERE payroll_group_id = '{$id}'
			AND status = 'Active'
		");
		$row = $sql->row();
		$sql->free_result();
		return $row->$field;
	}
	
	/**
	 * Deduction Income Information
	 * @param unknown_type $id
	 * @param unknown_type $field
	 * @param unknown_type $income_val
	 */
	function deduction_income($income_val,$field,$comp_id){
		$CI =& get_instance();
		$sql = $CI->db->query("
			SELECT 
			*FROM deductions_income
			WHERE income = '{$income_val}'
			AND comp_id = '{$comp_id}'
			AND status = 'Active'
		");
		$row = $sql->row();
		$sql->free_result();
		return $row->$field;
	}
	
	/**
	 * Deduction Adjustments Information
	 * @param unknown_type $id
	 * @param unknown_type $field
	 * @param unknown_type $income_val
	 */
	function deduction_adjustments($val,$field,$comp_id){
		$CI =& get_instance();
		$sql = $CI->db->query("
			SELECT 
			*FROM deductions_adjustments
			WHERE adjustments = '{$val}'
			AND comp_id = '{$comp_id}'
			AND status = 'Active'
		");
		$row = $sql->row();
		$sql->free_result();
		return $row->$field;
	}
	
	function tokenize(){
		return random_string('alnum', 16);
	}
	
	
