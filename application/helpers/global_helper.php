<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*	Helper : global helpers
*	Author : Christopher Cuizon <christophercuizons@gmail.com>
*	Usage  : For activity logs
*/
	
	function itoken_name(){
		$CI =& get_instance();
		return $CI->config->item('csrf_token_name');
	}
	
	function itoken_cookie(){
		$CI =& get_instance();
		return $CI->config->item('csrf_cookie_name');
	}

