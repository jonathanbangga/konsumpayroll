<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll Information Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_payroll_information extends CI_Controller {
		
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
			$this->load->model('hr/hr_employee_model','hr_emp');
			
			$this->sidebar_menu = 'content_holders/hr_employee_sidebar_menu';
			$this->menu = 'content_holders/user_hr_owner_menu';
			$this->url = "/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$this->uri->segment(4);
			
			$this->company_info = whose_company();
			
			if(count($this->company_info) == 0){
				show_error("Invalid subdomain");
				return false;
			}
			$this->company_id = $this->company_info->company_id;
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "Payroll Information";
			$data['sidebar_menu'] = $this->sidebar_menu;
			
			// init pagination
			$uri = "/{$this->uri->segment(1)}/hr/emp_payroll_information/index";
			$total_rows = $this->hr_emp->emp_payroll_info_counter($this->company_id);
			$per_page = $this->config->item('per_page');
			$segment=5;
			
			init_pagination($uri,$total_rows,$per_page,$segment);

			$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
			$data["links"] = $this->pagination->create_links();
			// end pagination
			
			$data['emp_payroll_info'] = $this->hr_emp->emp_payroll_info($per_page, $page, $this->company_id);
			$data['department'] = $this->hr_emp->department_list($this->company_id);
			$data['payroll_group'] = $this->hr_emp->payroll_group($this->company_id);
			$employee = $this->hr_emp->view_emp_payroll_info($this->company_id);
			$results = "";
			if($employee != FALSE){
				foreach($employee as $row){
					$results .= "{label:'".ucwords($row->first_name)." ".ucwords($row->last_name)."',emp_no:'{$row->payroll_cloud_id}',emp_id:'{$row->emp_id}'},";
				}
			}
			$data['employee'] = $results;
			
			if($this->input->post('add')){
				
				$emp_id = $this->input->post('emp_id');
				$emp_no = $this->input->post('emp_no');
				$department = $this->input->post('department');
				$sub_dept = $this->input->post('sub_dept'); 
				$employment_type = $this->input->post('employment_type');
				$position = $this->input->post('position');
				$date_hired = $this->input->post('date_hired');
				$last_date = $this->input->post('last_date');
				$tax_status = $this->input->post('tax_status');
				$payment_method = $this->input->post('payment_method');
				$bank_route = $this->input->post('bank_route');
				$bank_account = $this->input->post('bank_account');
				$account_type = $this->input->post('account_type');
				$payroll_group = $this->input->post('payroll_group');
				$default_project = $this->input->post('default_project');
				$timeSheet_approval_grp = $this->input->post('timeSheet_approval_grp');
				$overtime_approval_grp = $this->input->post('overtime_approval_grp');
				$leave_approval_grp = $this->input->post('leave_approval_grp');
				$expense_approval_grp = $this->input->post('expense_approval_grp');
				$eBundy_approval_grp = $this->input->post('eBundy_approval_grp');
				$sss_contribution_amount = $this->input->post('sss_contribution_amount');
				$hdmf_contribution_amount = $this->input->post('hdmf_contribution_amount');
				$philhealth_contribution_amount = $this->input->post('philhealth_contribution_amount');
				$witholding_tax = $this->input->post('witholding_tax');
				$cost_center = $this->input->post('cost_center');
				
				
				foreach($emp_id as $key2=>$val){
					$this->form_validation->set_rules("emp_id[{$key2}]", 'Employee ID', 'trim|required|xss_clean');
					$this->form_validation->set_rules("emp_no[{$key2}]", 'Employee Number', 'trim|required|xss_clean');
					$this->form_validation->set_rules("department[{$key2}]", 'Department', 'trim|required|xss_clean');
					$this->form_validation->set_rules("sub_dept[{$key2}]", 'Sub Department', 'trim|required|xss_clean');
					$this->form_validation->set_rules("employment_type[{$key2}]", 'Employment Type', 'trim|required|xss_clean');
					$this->form_validation->set_rules("position[{$key2}]", 'Position', 'trim|required|xss_clean');
					$this->form_validation->set_rules("date_hired[{$key2}]", 'Date Hired', 'trim|required|xss_clean');
					$this->form_validation->set_rules("last_date[{$key2}]", 'Last Date', 'trim|required|xss_clean');
					$this->form_validation->set_rules("tax_status[{$key2}]", 'Tax Status', 'trim|required|xss_clean');
					$this->form_validation->set_rules("payment_method[{$key2}]", 'Payment Method', 'trim|required|xss_clean');
					$this->form_validation->set_rules("bank_route[{$key2}]", 'Bank Route', 'trim|required|xss_clean');
					$this->form_validation->set_rules("bank_account[{$key2}]", 'Bank Account', 'trim|required|xss_clean');
					$this->form_validation->set_rules("account_type[{$key2}]", 'Account Type', 'trim|required|xss_clean');
					$this->form_validation->set_rules("payroll_group[{$key2}]", 'Payroll Group', 'trim|required|xss_clean');
					$this->form_validation->set_rules("default_project[{$key2}]", 'Default Project', 'trim|required|xss_clean');
					$this->form_validation->set_rules("timeSheet_approval_grp[{$key2}]", 'Tim Sheet Approval Group', 'trim|required|xss_clean');
					$this->form_validation->set_rules("overtime_approval_grp[{$key2}]", 'Overtime Approval Group', 'trim|required|xss_clean');
					$this->form_validation->set_rules("leave_approval_grp[{$key2}]", 'Leave Approval Group', 'trim|required|xss_clean');
					$this->form_validation->set_rules("expense_approval_grp[{$key2}]", 'Expense Approval Group', 'trim|required|xss_clean');
					$this->form_validation->set_rules("eBundy_approval_grp[{$key2}]", 'Ebundy Approval Group', 'trim|required|xss_clean');
					$this->form_validation->set_rules("sss_contribution_amount[{$key2}]", 'SSS Contribution Amount', 'trim|required|xss_clean');
					$this->form_validation->set_rules("hdmf_contribution_amount[{$key2}]", 'HDMF Contribution Amount', 'trim|required|xss_clean');
					$this->form_validation->set_rules("philhealth_contribution_amount[{$key2}]", 'Philhealth Contribution Amount', 'trim|required|xss_clean');
					$this->form_validation->set_rules("witholding_tax[{$key2}]", 'Witholding Tax', 'trim|required|xss_clean');
					$this->form_validation->set_rules("cost_center[{$key2}]", 'Cost Center', 'trim|required|xss_clean');
				}
				
				if ($this->form_validation->run()==true){
					
					foreach($emp_id as $key=>$val){
                	    $add_emp_payroll_info = array(	
							'emp_id' => $emp_id[$key],
							'company_id' => $this->company_id,
							'department_id' => $department[$key],
							'sub_department_id' => $sub_dept[$key],
                	    	'employment_type' => $employment_type[$key],
							'position' => $position[$key],
							'date_hired' => $date_hired[$key],
                	    	'last_date' => $last_date[$key],
							'tax_status' => $tax_status[$key],
							'payment_method' => $payment_method[$key],
                	    	'bank_route' => $bank_route[$key],
                	    	'bank_account' => $bank_account[$key],
                	    	'account_type' => $account_type[$key],
                	    	'payroll_group_id' => $payroll_group[$key],
                	    	'default_project' => $default_project[$key],
                	    	'timeSheet_approval_grp' => $timeSheet_approval_grp[$key],
                	    	'overtime_approval_grp' => $overtime_approval_grp[$key],
                	    	'leave_approval_grp' => $leave_approval_grp[$key],
                	    	'expense_approval_grp' => $expense_approval_grp[$key],
                	    	'eBundy_approval_grp' => $eBundy_approval_grp[$key],
                	    	'sss_contribution_amount' => $sss_contribution_amount[$key],
                	    	'hdmf_contribution_amount' => $hdmf_contribution_amount[$key],
                	    	'philhealth_contribution_amount' => $philhealth_contribution_amount[$key],
                	    	'witholding_tax' => $witholding_tax[$key],
                	    	'cost_center' => $cost_center[$key]
						);

						$insert_emp_earnings = $this->jmodel->insert_data('employee_payroll_information',$add_emp_payroll_info);
					}

					$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully saved!</div>');
					redirect($this->url);
					return false;
				}
			}
			
			if($this->input->post('update_info')){
				
				// Update Employee Deduction Information
				$emp_idEdit = $this->input->post('emp_idEdit');
				$department = $this->input->post('department');
				$sub_dept = $this->input->post('sub_dept'); 
				$employment_type = $this->input->post('employment_type');
				$position = $this->input->post('position');
				$date_hired = $this->input->post('date_hired');
				$last_date = $this->input->post('last_date');
				$tax_status = $this->input->post('tax_status');
				$payment_method = $this->input->post('payment_method');
				$bank_route = $this->input->post('bank_route');
				$bank_account = $this->input->post('bank_account');
				$account_type = $this->input->post('account_type');
				$payroll_group = $this->input->post('payroll_group');
				$default_project = $this->input->post('default_project');
				$timeSheet_approval_grp = $this->input->post('timeSheet_approval_grp');
				$overtime_approval_grp = $this->input->post('overtime_approval_grp');
				$leave_approval_grp = $this->input->post('leave_approval_grp');
				$expense_approval_grp = $this->input->post('expense_approval_grp');
				$eBundy_approval_grp = $this->input->post('eBundy_approval_grp');
				$sss_contribution_amount = $this->input->post('sss_contribution_amount');
				$hdmf_contribution_amount = $this->input->post('hdmf_contribution_amount');
				$philhealth_contribution_amount = $this->input->post('philhealth_contribution_amount');
				$witholding_tax = $this->input->post('witholding_tax');
				$cost_center = $this->input->post('cost_center');
				
				$this->form_validation->set_rules("emp_idEdit", 'Employee ID', 'trim|required|xss_clean');
				$this->form_validation->set_rules("department", 'Department', 'trim|required|xss_clean');
				$this->form_validation->set_rules("sub_dept", 'Sub Department', 'trim|required|xss_clean');
				$this->form_validation->set_rules("employment_type", 'Employment Type', 'trim|required|xss_clean');
				$this->form_validation->set_rules("position", 'Position', 'trim|required|xss_clean');
				$this->form_validation->set_rules("date_hired", 'Date Hired', 'trim|required|xss_clean');
				$this->form_validation->set_rules("last_date", 'Last Date', 'trim|required|xss_clean');
				$this->form_validation->set_rules("tax_status", 'Tax Status', 'trim|required|xss_clean');
				$this->form_validation->set_rules("payment_method", 'Payment Method', 'trim|required|xss_clean');
				$this->form_validation->set_rules("bank_route", 'Bank Route', 'trim|required|xss_clean');
				$this->form_validation->set_rules("bank_account", 'Bank Account', 'trim|required|xss_clean');
				$this->form_validation->set_rules("account_type", 'Account Type', 'trim|required|xss_clean');
				$this->form_validation->set_rules("payroll_group", 'Payroll Group', 'trim|required|xss_clean');
				$this->form_validation->set_rules("default_project", 'Default Project', 'trim|required|xss_clean');
				$this->form_validation->set_rules("timeSheet_approval_grp", 'Tim Sheet Approval Group', 'trim|required|xss_clean');
				$this->form_validation->set_rules("overtime_approval_grp", 'Overtime Approval Group', 'trim|required|xss_clean');
				$this->form_validation->set_rules("leave_approval_grp", 'Leave Approval Group', 'trim|required|xss_clean');
				$this->form_validation->set_rules("expense_approval_grp", 'Expense Approval Group', 'trim|required|xss_clean');
				$this->form_validation->set_rules("eBundy_approval_grp", 'Ebundy Approval Group', 'trim|required|xss_clean');
				$this->form_validation->set_rules("sss_contribution_amount", 'SSS Contribution Amount', 'trim|required|xss_clean');
				$this->form_validation->set_rules("hdmf_contribution_amount", 'HDMF Contribution Amount', 'trim|required|xss_clean');
				$this->form_validation->set_rules("philhealth_contribution_amount", 'Philhealth Contribution Amount', 'trim|required|xss_clean');
				$this->form_validation->set_rules("witholding_tax", 'Witholding Tax', 'trim|required|xss_clean');
				$this->form_validation->set_rules("cost_center", 'Cost Center', 'trim|required|xss_clean');
				
				if ($this->form_validation->run()==true){
					$update_info = $this->hr_emp->update_emp_payroll_info(
							$emp_idEdit,
							$department,
							$sub_dept,
							$employment_type,
							$position,
							$date_hired,
							$last_date,
							$tax_status,
							$payment_method,
							$bank_route,
							$bank_account,
							$account_type,
							$payroll_group,
							$default_project,
							$timeSheet_approval_grp,
							$overtime_approval_grp,
							$leave_approval_grp,
							$expense_approval_grp,
							$eBundy_approval_grp,
							$sss_contribution_amount,
							$hdmf_contribution_amount,
							$philhealth_contribution_amount,
							$witholding_tax,
							$cost_center,
							$this->company_id
						);
					if($update_info){
						$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully updated!</div>');
						echo json_encode(array("success"=>1));
						redirect($this->url);
						return false;
					}else{
						echo json_encode(array("success"=>0));
						return false;
					}
				}else{
					$error = validation_errors('<span class="error_zone">','</span><br />');
					echo json_encode(array("success"=>"0","error_msg"=>$error));
					return false;
				}
			}
			
			if($this->input->is_ajax_request()) {
				// Delete Employee Payroll Information
				if($this->input->post('delete_db')){
					$emp_id = $this->input->post('emp_id');
					$delete_me = $this->db->query("DELETE FROM employee_payroll_information WHERE emp_id = '{$emp_id}' and company_id = '{$this->company_id}'");
					if($delete_me){
						$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully deleted!</div>');
						echo json_encode(array("success"=>1,"url"=>$this->url));
						return false;
					}
				}
				
				// Get Information for Employee Payroll Information
				if($this->input->post('get_information')){
					$emp_id = $this->input->post('emp_id');
					$get_info = $this->db->query("
						SELECT 
						e.emp_id as emp_id,
						e.first_name as first_name,
						e.last_name as last_name,
						epi.department_id as department_id,
						epi.sub_department_id as sub_department_id,
						epi.employment_type as employment_type,
						epi.position as position,
						epi.date_hired as date_hired, 
						epi.last_date as last_date,
						epi.tax_status as tax_status,
						epi.payment_method as payment_method,
						epi.bank_route as bank_route,
						epi.bank_account as bank_account,
						epi.account_type as account_type,
						epi.payroll_group_id as payroll_group_id,
						epi.default_project as default_project,
						epi.timeSheet_approval_grp as timeSheet_approval_grp,
						epi.overtime_approval_grp as overtime_approval_grp,
						epi.leave_approval_grp as leave_approval_grp,
						epi.expense_approval_grp as expense_approval_grp,
						epi.eBundy_approval_grp as eBundy_approval_grp,
						epi.sss_contribution_amount as sss_contribution_amount,
						epi.hdmf_contribution_amount as hdmf_contribution_amount,
						epi.philhealth_contribution_amount as philhealth_contribution_amount,
						epi.witholding_tax as witholding_tax,
						epi.cost_center as cost_center
						FROM employee_payroll_information epi
						LEFT JOIN employee e ON epi.emp_id = e.emp_id 
						WHERE epi.emp_id = '{$emp_id}' and epi.company_id = '{$this->company_id}'
					");
					if($get_info->num_rows() > 0){
						$get_info_row = $get_info->row();
						$get_info->free_result();
						echo json_encode(
							array(
								"success"=>1,
								"emp_id"=>$get_info_row->emp_id,
								"emp_name"=>ucwords($get_info_row->first_name)." ".ucwords($get_info_row->last_name),
								"department_id"=>$get_info_row->department_id,
								"sub_department_id"=>$get_info_row->sub_department_id,
								"employment_type"=>$get_info_row->employment_type,
								"position"=>$get_info_row->position,
								"date_hired"=>$get_info_row->date_hired,
								"last_date"=>$get_info_row->last_date,
								"tax_status"=>$get_info_row->tax_status,
								"payment_method"=>$get_info_row->payment_method,
								"bank_route"=>$get_info_row->bank_route,
								"bank_account"=>$get_info_row->bank_account,
								"account_type"=>$get_info_row->account_type,
								"payroll_group_id"=>$get_info_row->payroll_group_id,
								"default_project"=>$get_info_row->default_project,
								"timeSheet_approval_grp"=>$get_info_row->timeSheet_approval_grp,
								"overtime_approval_grp"=>$get_info_row->overtime_approval_grp,
								"leave_approval_grp"=>$get_info_row->leave_approval_grp,
								"expense_approval_grp"=>$get_info_row->expense_approval_grp,
								"eBundy_approval_grp"=>$get_info_row->eBundy_approval_grp,
								"sss_contribution_amount"=>$get_info_row->sss_contribution_amount,
								"hdmf_contribution_amount"=>$get_info_row->hdmf_contribution_amount,
								"philhealth_contribution_amount"=>$get_info_row->philhealth_contribution_amount,
								"witholding_tax"=>$get_info_row->witholding_tax,
								"cost_center"=>$get_info_row->cost_center
							)
						);
						return false;
					}else{
						echo json_encode(array("success"=>0));
						return false;
					}
				}
			}
			
			$this->layout->set_layout($this->theme);
			$this->layout->view('pages/hr/emp_payroll_info_view', $data);
		}
	
	}

/* End of file Emp_earnings.php */
/* Location: ./application/controllers/hr/Emp_earnings.php */