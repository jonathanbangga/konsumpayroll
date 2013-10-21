<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*	Helper : Activity logs helper 
*	Author : Christopher Cuizon <christophercuizons@gmail.com>
*	Usage  : For activity logs
*/
	
	/**
	*	Adds activity for all actions
	*	@param string $name
	*	@param int $company_id
	*/
	function add_activity($name,$company_id){
		$CI =& get_instance();
		$fields = array(
					"name" 	=> $CI->db->escape_str($name),
					"date"	=> idates_now(),
					"company_id"=> $CI->db->escape_str($company_id)
			);
		$CI->db->insert("activity_logs",$fields);	
	}

	/**
	*	Displays Only Ymd
	*	@param dates  date
	*	@return string
	*/
	function idates($date) {
		$dates = date("F d, Y",strtotime($date));
		return $dates;
	}	
	
	function idates_time($date) {
		$dates = date("Y-m-d H:i:s",strtotime($date));
		return $dates;
	}
	
	function time_only($time){
		return date("H:i:s a",strtotime($time));
	}
	
	function idates_now() {
		return date("Y-m-d H:i:s");
	}
	
	function p($array) {
		echo "<pre>";
		print_r($array);
		echo "</pre>";	
	}
	
	function init_pagination($uri,$total_rows,$per_page=10,$segment=4){
       $ci                          =& get_instance();
       $config['per_page']          = $per_page;
       $config['uri_segment']       = $segment;
       $config['base_url']          = base_url().$uri;
       $config['total_rows']        = $total_rows;
       $config['use_page_numbers']  = TRUE;
       $ci->pagination->initialize($config);
       return $config;   
   } 

   
  