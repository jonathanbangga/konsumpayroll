<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Loan Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_loan extends CI_Controller {
		
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
			$this->authentication->check_if_logged_in();
			$this->load->helper('employee_helper');
			$this->load->model('konsumglobal_jmodel','jmodel');
			$this->load->model('employee/employee_model','employee');
			
			$this->url = "/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3);
			$this->theme = $this->config->item('jb_employee_temp');
			$this->menu = $this->config->item('jb_employee_menu');
			
			$this->company_info = whose_company();
			
			if(count($this->company_info) == 0){
				show_error("Invalid subdomain");
				return false;
			}
			$this->company_id = $this->company_info->company_id;
			$this->emp_id = $this->session->userdata('emp_id');
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "Loan History";
			$data['loan'] = $this->employee->loans($this->company_id,$this->emp_id);
			$data['loan_type'] = $this->employee->loan_type($this->company_id);
			$data['comp_id'] = $this->company_id;
			
			if($this->input->is_ajax_request()) {
				
				// Filter Loan Type
				if($this->input->post('for_loan_type')){
					$loan_type = $this->input->post('loan_type');
					$filter_loan_type = $this->employee->filter_loan_type($loan_type, $this->company_id,$this->emp_id);
					if($filter_loan_type != FALSE){
						foreach($filter_loan_type as $row){
							print '
								<tr class="row_list">
									<td>'.$row->loan_type_name.'</td>
									<td>'.$row->loan_no.'</td>
									<td>'.$row->date_granted.'</td>
									<td>'.$row->principal.'</td>
									<td>'.loan_balance($this->company_id, $row->emp_id, $row->employee_loans_id).'</td>
									<td>'.$row->monthly_amortization.'</td>
									<td>'.$row->interest_rates.'</td>
									<td><a class="btn" href="/'.$this->uri->segment(1).'/employee/emp_payment_history/index/'.$row->employee_loans_id.'">PAYMENT HISTORY</a></td>
								</tr>
							';
						}
						return false;
					}else{
	            		print "<tr class='msg_empt_cont row_list'><td colspan='12' style='text-align:left;'>".msg_empty()."</td></tr>";
	            	}
				}
			}
			
			$this->layout->set_layout($this->theme);
			$this->layout->view('pages/employee/loan_table_view', $data);
		}
	
	}

/* End of file emp_loan.php */
/* Location: ./application/controllers/employee/emp_loan.php */