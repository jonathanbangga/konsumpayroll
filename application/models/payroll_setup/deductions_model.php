<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deductions_model extends CI_Model {

	protected $company_id;

    public function __construct(){
        parent::__construct();
		// default
		$this->company_id = $this->session->userdata('company_id');
    }
		
}
/* End of file */