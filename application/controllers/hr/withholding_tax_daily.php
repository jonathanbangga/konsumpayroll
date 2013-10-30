<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Withholding Tax Daily Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Withholding_tax_daily extends CI_Controller {
		
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
			$data['page_title'] = "Withholding Tax - Daily";
			$withholding_tax_val = array('company_id'=>$this->company_id,'tax_type'=>'Daily');
			$data['withholding_tax'] = $this->jmodel->display_data_where_result('withholding_tax',$withholding_tax_val);
			
			$withholding_tax_status = array('company_id'=>$this->company_id,'tax_type'=>'Daily');
			$data['withholding_tax_status'] = $this->jmodel->display_data_where_result('withholding_tax_status',$withholding_tax_status);
			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/employee/withholding_tax_daily_view', $data);
		}
	
	}

/* End of file withholding_tax_daily.php */
/* Location: ./application/controllers/hr/withholding_tax_daily.php */