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
	'user' 	 		 => 3,
	'anonymous' 	 => 20);

$config['admin_tbl'] = 'user_credentials';