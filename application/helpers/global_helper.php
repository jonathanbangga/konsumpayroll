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
				$folder = array("folder"=>$id);
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
		$query = $CI->db->query("
									SELECT * FROM assigned_company ac
									LEFT JOIN company c on c.company_id = ac.company_id
									WHERE ac.payroll_system_account_id = 1 AND c.sub_domain = '{$company_name}'
								");
		$row = $query->row();
		return $row;
	}
	
	/**
	 * Replaces spaces with underscore
	 * Enter description here ...
	 * @param unknown_type $text
	 */
	function replace_space($text) { 
	    $text = strtolower(htmlentities($text)); 
	    $text = str_replace(get_html_translation_table(), "_", $text);
	    $text = str_replace(" ", "_", $text);
	   	$text = str_replace("-", "_", $text);
	    $text = preg_replace("/[_]+/i", "_", $text);
	    return $text;
	}
	
