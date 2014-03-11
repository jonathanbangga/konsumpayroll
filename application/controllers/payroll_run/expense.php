<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expense extends CI_Controller {
	
	/**
	 * Theme options - default theme
	 * @var string
	 */
	var $theme;
	var $menu;
	var $sidebar_menu;
	var $company_info;
	var $subdomain;
	var $per_page;
	var $segment;
	
	var $company_id;
	
	/**
	 * Constructor
	 */
	public function __construct() 
	{
		parent::__construct();
		
		$this->load->model("payroll_run/expense_model","em");
		$this->theme = $this->config->item('default');
		$this->menu = 'content_holders/user_hr_owner_menu';
		$this->sidebar_menu = $this->config->item('payroll_run_sidebar_menu');
		$this->company_info = whose_company();
		$this->subdomain = $this->uri->segment(1);
		$this->per_page	= 10;
		$this->segment	= 5;
		$this->authentication->check_if_logged_in();
		
		$this->company_id = $this->company_info->company_id;
		
		if(count($this->company_info) == 0){
			show_error("Invalid subdomain");
			return false;
		}
	}
	
	public function index()
	{
		if ($this->input->post()) {
			$this->form_validation->set_rules('employee_id[]','Employee','trim|xss_clean');
			$this->form_validation->set_rules('expense_type_id[]','Expense Type','trim|xss_clean');
			$this->form_validation->set_rules('date[]','Date','trim|xss_clean');
			$this->form_validation->set_rules('amount[]','Amount','trim|xss_clean');
			
			if ($this->form_validation->run() == TRUE) {
				$post = $this->input->post();
				foreach ($post['employee_id'] as $key => $employee) {
					if ($employee) {
						
						$q  = $this->em->get_employee($this->company_id,$employee);
						$q1 = $this->em->get_expense_type($this->company_id,$post['expense_type_id'][$key]);
						
						$expense = array(
							'company_id' => $this->company_id,
							'account_id' => $q->account_id,
							'expense_type_id' => ($q1) ? $q1->expense_type_id : '',
							'minimum'		  => ($q1) ? $q1->minimum_amount : '',
							'maximum'		  => ($q1) ? $q1->maximum_amount : '',
							'date'			  => ($post['date'][$key]) ? date('Y-m-d',strtotime(str_replace('/', '-', $post['date'][$key]))) : '',
							'amount'		  => $post['amount'][$key]
						);
						$this->em->add_expense($expense);
					}
				}	
				//redirect ('/'.$this->subdomain.'/payroll_run/expense','location');
			}
		}
		
		$data['page_title'] = "Expense";
		$data['sidebar_menu'] = $this->sidebar_menu;
		
		$data['q'] = $this->em->get_payroll_expenses($this->company_id);
		
		$this->layout->set_layout($this->theme);
		$this->layout->view('pages/payroll_run/expense_view',$data);
	}
	
	public function add_expense($no)
	{
		if ($this->input->is_ajax_request()) {
			
			$q  = $this->em->get_employees($this->company_id);
			$q1 = $this->em->get_expenses_type($this->company_id);
			
			$emp = '<select class="employee txtselect" name="employee_id[]" id="'.$no.'">
				<option value="">Select</option>';
			foreach ($q as $employee) {
				$emp .= '<option value="'.$employee->account_id.'">'.$employee->payroll_cloud_id.'</option>';
			}
			$emp .= '</option>';
			
			$exp = '<select class="expense_type_id txtselect" name="expense_type_id[]" id="'.$no.'">
				<option value="">Select</option>';
			foreach ($q1 as $expense) {
				$exp .= '<option value="'.$expense->expense_type_id.'">'.$expense->expense_type_name.'</option>';
			}
			$exp .= '</option>';
			
			echo '<tr id="'.$no.'">
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>'.$emp.'</td>
				<td class="name">&nbsp;</td>
				<td>'.$exp.'</td>
				<td class="minimum">&nbsp;</td>
				<td class="maximum">&nbsp;</td>
				<td><input type="text" name="date[]" class="date txtfield datepicker" readonly="readonly" /></td>
				<td><input type="text" name="amount[]" class="amount txtfield" /></td>
			</tr>';
		} else {
			show_404();
		}
	}
	
	public function get_employee($id)
	{
		if ($this->input->is_ajax_request()) {
			$q = $this->em->get_employee($this->company_id, $id);
			
			$employee = array(
				'name' => $q->first_name.' '.$q->middle_name.' '.$q->last_name
			);
			echo json_encode($employee);
			
		} else {
			show_404();
		}
	}
	
	public function get_expense_type($id)
	{
		if ($this->input->is_ajax_request()) {
			$q = $this->em->get_expense_type($this->company_id,$id);
			echo json_encode($q);
		} else {
			show_404();
		}
	}
}