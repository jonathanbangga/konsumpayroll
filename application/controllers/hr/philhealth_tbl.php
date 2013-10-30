<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Philhealth Table Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Philhealth_tbl extends CI_Controller {
		
		/**
		 * Theme options - default theme
		 * @var string
		 */
		var $theme;
		
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->theme = $this->config->item('temp_company_wizard');
			$this->load->model('konsumglobal_jmodel','jmodel');
			$this->load->model('employee_model','employee');
			$this->company_id = 1;
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "Philhealth Table";
			
			$phil_health = array('company_id'=>$this->company_id);
			$data['philhealth_tbl'] = $this->jmodel->display_data_where_result('phil_health',$phil_health);
			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/employee/philhealth_table_view', $data);
		}
	
	}

/* End of file philhealth_tbl.php */
/* Location: ./application/controllers/hr/philhealth_tbl.php */