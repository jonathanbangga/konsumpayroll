<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * HDMF Table Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Hdmf_tbl extends CI_Controller {
		
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
			$this->theme = $this->config->item('default');
			$this->load->model('konsumglobal_jmodel','jmodel');
			$this->load->model('employee/employee_model','employee');
			$this->company_id = 1;
			
			$this->sidebar_menu = 'content_holders/employee_sidebar_menu';
			$this->menu = 'content_holders/company_menu';
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "HDMF Table";
			$data['sidebar_menu'] =$this->sidebar_menu;
			$hdmf_val = array('company_id'=>$this->company_id);
			$data['hdmf_tbl'] = $this->jmodel->display_data_where_result('hdmf',$hdmf_val);
			
			$this->layout->set_layout($this->theme);	
			$this->layout->view('pages/employee/hdmf_table_view', $data);
		}
	
	}

/* End of file philhealth_tbl.php */
/* Location: ./application/controllers/hr/philhealth_tbl.php */