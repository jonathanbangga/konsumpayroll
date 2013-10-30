<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Konsumpayroll Authentication Library Config
 *
 * @package Authentication
 * @subpackage Libraries
 * @category   Authentication
 * @author Jonthan Bangga <jonathanbangga@gmail.com> 
 */

$config['konsum_groups'] = array(
	'admin' 		 => 1,
	'superadmin' 	 => 2,
	'owner'	 		 => 3,
	'hr' 	 		 => 4,
	'user' 	 		 => 5,
	'anonymous' 	 => 20);

#$config['konsum_profile_menu'] = array("a"=>"My Profile","b"=>"Payroll");
$config['konsum_profile_menu'] = array("My Profile"=>"a","Payroll"=>"b");

$config['admin_tbl'] = 'konsum_admin';
$config['owner_tbl'] = 'company_owner';