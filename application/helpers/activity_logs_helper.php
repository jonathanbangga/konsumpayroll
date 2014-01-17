<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*	Helper : Activity logs helper 
*	Author : Christopher Cuizon <christophercuizons@gmail.com>
*	Usage  : For activity logs
*/
	
	/**
	*	Adds activity logs for all actions 
	*	@param string $name
	*	@param int $company_id
	*	@return integer
	*/
	function add_activity($name,$company_id){
		$CI =& get_instance();
		$fields = array(
					"name" 	=> $CI->db->escape_str($name),
					"date"	=> idates_now(),
					"company_id"=> $CI->db->escape_str($company_id)
			);
		$CI->db->insert("activity_logs",$fields);	
		return $CI->db->insert_id();
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
	
	/**
	 * Checks the dates and time
	 * @param date $date
	 * @return dates
	 */
	function idates_time($date) {
		$dates = date("Y-m-d H:i:s",strtotime($date));
		return $dates;
	}
	
	/**
	 * defines the time only to example 9:59:02 pm
	 * @param time $time
	 * @return dates
	 */
	function time_only($time){
		return date("H:i:s",strtotime($time));
	}
	
	/**
	 * Checks dates now
	 * @return dates
	 */
	function idates_now() {
		return date("Y-m-d H:i:s");
	}
	
	/**
	 * checks the date on Y-m-d format only
	 * @param date $str
	 * @return dates
	 */
	function idates_only($str){
		return date("Y-m-d",strtotime($str));
	}
	
	/**
	 * DISPLAYS DATES IN SLASH FORMAT
	 * activates dates slash
	 * @param string $str
	 * @return dates
	 */
	function idates_slash($str){
	#	return ($str == "0000-00-00" || $str == "01/01/1970" || $str =="1970-01-01") ? null : date("d/m/Y",strtotime($str));
	return ($str == "0000-00-00" || $str == "01/01/1970" || $str =="1970-01-01") ? null : date("Y-m-d",strtotime($str));
	}
	
	/**
	 * CLEANS THE DATE WHEN IT THE FORMAT IS SLASH THEN THIS 
	 * FUNCTIONS WILL AUTOMATICALLY CONVERTS  SLASH TO DASHSES
	 * @param string $str
	 * @param string $type (@example date,date-time)
	 * @return if date then @format will be Y-m-d else date-time then Y-m-d H:i:s 
	 */
	function date_clean($str,$type = "date"){
		if($str  == "0000-00-00" || $str == "01/01/1970" || $str =="1970-01-01"){
			return null;			
		}else{
			switch($type):
				case "date":
					//$str = date("d/m/Y",strtotime(str_replace("/","-",$str)));
					return  date("Y-m-d",strtotime($str));
				break;
				case "date_time":
				//	$str =  str_replace("/","-",$str);
					return idates_time($str);
				break;
			endswitch;	
		}
	}
	
	/**
	 * This is the shortcut for the pre functionalities because so taas hehe
	 * @param object $array
	 * @example p(array("b","c","d"));
	 * @return object
	 */
	function p($array) {
		echo "<pre>";
		print_r($array);
		echo "</pre>";	
	}
	
	/**
	*	init pagination
	*	@param string uri
	*	@param int $total_rowss
	*	@param int $per_page
	*	@param int $segment
	*	@return object
	*/
	function init_pagination($uri,$total_rows,$per_page=10,$segment=4){
       	$ci                          =& get_instance();
       	$config['per_page']          = $per_page;
       	$config['uri_segment']       = $segment;
       	$config['base_url']          = base_url().$uri;
       	$config['total_rows']        = $total_rows;
       	$config['use_page_numbers']  = TRUE;
       	$config['prev_link'] = 'Previous';
		$config['next_link'] = 'Next';	    
	    $config['full_tag_open'] = '<ul id="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="next">';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a class="btn">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
       	$ci->pagination->initialize($config);
       return $config;
   } 
   
  