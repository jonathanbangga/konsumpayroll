<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*	Helper : global helpers
*	Author : Christopher Cuizon <christophercuizons@gmail.com>
*	Usage  : Use for all
*/
	
	function itoken_name(){
		$CI =& get_instance();
		return $CI->config->item('csrf_token_name');
	}
	
	function itoken_cookie(){
		$CI =& get_instance();
		return $CI->config->item('csrf_cookie_name');
	}

	function check_user_admin(){
		$CI =& get_instance();
		$id = $CI->session->userdata('account_id');
		$query = $CI->db->get_where("konsum_admin",array("konsum_admin_id"=>$id));
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
	
	function photo_upload($path="./uploads/",$max_size= 100,$max_width=1024,$max_height=768){
		$CI =& get_instance();
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= $max_size;
		$config['max_width']  = $max_width;
		$config['max_height']  = $max_height;
		$CI->load->library('upload', $config);
		if ( ! $CI->upload->do_upload()) {
			$error = array("status"=>"0",'error' => $CI->upload->display_errors());
			return $error;
		} else {
			$data = array("status"=>"1",'upload_data' => $CI->upload->data());
			return $data;
		}
	}
	
	function date_today(){
		return date("Y-m-d");
	}
	
	/**
	*	Check subdomains for validaty
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
	 * Enter description here ...
	 */
	function msg_empty(){
		$msg_emp = "No items on this table yet.";
		return $msg_emp;
	}
	
