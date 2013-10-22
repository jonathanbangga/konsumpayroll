<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "login/owner";
$route['404_override'] = '';

$route['admin/dashboard'] = "admin/dashboard/index";
$route['admin/dashboard/:any'] = "admin/dashboard/index/$1";
$route['admin/account'] = "admin/account/index";
$route['admin/login'] = "admin/login/index";
$route['admin/users'] = "admin/users/index";
// all users
$route['admin/users/add_users'] = "admin/users/add_users";
$route['admin/users/all_users'] = "admin/users/all_users";
$route['admin/users/delete_admin_user'] = "admin/users/delete_admin_user";
$route['admin/users/delete_user'] = "admin/users/delete_user";

$route['admin/users/show_edit_admin'] = "admin/users/show_edit_admin";
$route['admin/users/update_admin_users'] = "admin/users/update_admin_users";

$route['admin/users/all_users/:any'] = "admin/users/all_users/$1";

// admin users 
$route['admin/users/add_admin_users'] = "admin/users/add_admin_users";
$route['admin/users/all_admin'] = "admin/users/all_admin";
$route['admin/users/all_admin/:any'] = "admin/users/all_admin/$1";
$route['admin/company_setup'] = "admin/company_setup/add";
$route['admin/company_setup/add'] = "admin/company_setup/add";

#athan
$route['login/owner'] = "login/owner";
$route['login/admin'] = "login/admin";
$route['owner/cpanel'] = "owner/cpanel";

#jc
$route['([A-Za-z0-9_.])+/(:any)'] = "$2";

/* End of file routes.php */
/* Location: ./application/config/routes.php */