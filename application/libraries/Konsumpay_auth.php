<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Konsumpayroll Authentication Library
 *
 * @package Authentication
 * @subpackage Libraries
 * @category   Authentication
 * @author Jonthan Bangga <jonathanbangga@gmail.com>
 */

class Konsumpay_Auth {
	/**
     * Codeigniter Instance
     * @var codeigniter
     */
    protected $_CI;
    /**
     * Config variable
     * @var array
     */
    protected $_config;

	public function __construct()
    {
        log_message('debug', 'Konsumpayroll Authentication Library Loaded');
        
        $this->_CI =& get_instance();
        $this->_CI->load->database();
        $this->_CI->load->library(array('session'));
		
		$group = $this->_CI->uri->segment(1);
		$admin_login = $this->_CI->uri->segment(2);
		if($group=='logout' || ($group=='admin' && $admin_login=='login')){
			$var = "";
		}else if ($group != 'login' && $group) {
			$this->allow($group,'login');
		}
    }
	
	/** 
     * Restricts a page for the particular group.
     * @param string $group The group that is allowed to access
     *  to specified group
     * @param string $url The redirect url incase user is denied for access.
     * @return mixed Returns true if user has access otherwise
     *  show 404 error.
     */
    public function allow($group=null, $url=null)  
    {
    	$valid_group = "";
        if (is_string($group)) {
            if(array_search($group,$this->_CI->config->item('konsum_groups'))){
            	$valid_group = 1;
            }else{
            	$valid_group = 0;
            }
        }
		if ($valid_group != 0) {
			show_error('Invalid specified group');
		}
		if ($group == NULL) { // Unrestricted
            return true;
		}
		
        $sess_group = $this->_CI->session->userdata('account_type');
		if ($sess_group == $group) {
			return TRUE;
		} else {
			// access denied.
            if (!empty($url)) {
                redirect($url);
            } else {
               show_404(uri_string());
            }
		}
		
    }
	
	/**
	 * Login current user
	 * @params String $username
	 * @params String $password
	 * @params String $user_type	The default is users
	 * @return Boolean
	 */
	public function login($username, $password, $user_type="users")
	{
		if (!is_string($username) || !is_string($password)) {
            throw new Exception('Parameter type passed is invalid');
        }
		
		$this->_CI->load->model('konsumpay_auth_model');
			
		switch($user_type) {
			case "admin" :
				$verifyInfo = $this->_CI->konsumpay_auth_model->verify_admin($username, $this->encrypt_password($password));			
			break;
			case "users" :
				$verifyInfo = $this->_CI->konsumpay_auth_model->verify_user($username, $this->encrypt_password($password));
			break;
		}
		
		if ($verifyInfo == FALSE) {
			return FALSE;
		} else {
			//Login successfull store info
							
            if (!$groupname = array_search($verifyInfo['group'],
                $this->_CI->config->item('konsum_groups'))) {
                $groupname = 'anonymous';
            }
			
            // Saved user info to session.
			
			$userdata = array(
				'account_id'   => $verifyInfo['account_id'],
				'account_type' => $groupname,
				'logged_in'    => TRUE
			);

            $this->_CI->session->set_userdata($userdata);
            return TRUE;
		}
	}
	
	/**
     * Check if user is logged in
     * @return Boolean
     */
    public function is_logged_in()
    {
        if ($this->_CI->session->userdata('logged_in') === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	public function logout()
	{
		$this->_CI->session->sess_destroy();
	}
	
	/**
     * Gets all the user session data.
     * @return array Returns the session data
     */
    public function get_session_data()
    {
        return $this->_CI->session->all_userdata();
    }
	
	/**
	 * Encrypt the password. This encryption uses MD5
	 * @params String $password
	 * @return String
	 */
	public function encrypt_password($password)
	{
		if (!is_string($password)) {
			show_error('Parameters are invalid');
		}		
		return md5($password);
	}

}