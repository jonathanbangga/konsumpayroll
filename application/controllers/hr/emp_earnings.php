<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Earnings Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_earnings extends CI_Controller {
		
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
			$this->menu = 'content_holders/company_menu';
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
			$data['page_title'] = "Earnings";
			$data['sidebar_menu'] = $this->sidebar_menu;
			
			// init pagination
			$uri = "/{$this->uri->segment(1)}/hr/emp_earnings/index";
			$total_rows = $this->hr_emp->emp_earnings_counter($this->company_id);
			$per_page = $this->config->item('per_page');
			$segment=5;
			
			init_pagination($uri,$total_rows,$per_page,$segment);

			$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
			$data["links"] = $this->pagination->create_links();
			// end pagination
			
			$data['emp_earnings'] = $this->hr_emp->emp_earnings($per_page, $page, $this->company_id);
			$employee = $this->hr_emp->view_emp_earnings($this->company_id);
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
				$min_wage_earner = $this->input->post('min_wage_earner');
				$amount = $this->input->post('amount'); 
				$entitled_to_basic_pay = $this->input->post('entitled_to_basic_pay');
				$pay_rate_type = $this->input->post('pay_rate_type');
				$time_sheet_required = $this->input->post('time_sheet_required');
				$entitled_to_ot = $this->input->post('entitled_to_ot');
				$entitled_to_nsd = $this->input->post('entitled_to_nsd');
				$night_shift_diff_rate = $this->input->post('night_shift_diff_rate');
				$entitled_commission = $this->input->post('entitled_commission');
				$entitled_holi_pre = $this->input->post('entitled_holi_pre');
				
				foreach($emp_id as $key2=>$val){
					$this->form_validation->set_rules("emp_id[{$key2}]", 'Employee ID', 'trim|required|xss_clean');
					$this->form_validation->set_rules("emp_no[{$key2}]", 'Employee Number', 'trim|required|xss_clean');
					$this->form_validation->set_rules("min_wage_earner[{$key2}]", 'Allowance Type', 'trim|required|xss_clean');
					$this->form_validation->set_rules("amount[{$key2}]", 'Amount', 'trim|required|xss_clean');
					$this->form_validation->set_rules("entitled_to_basic_pay[{$key2}]", 'Employee ID', 'trim|required|xss_clean');
					$this->form_validation->set_rules("pay_rate_type[{$key2}]", 'Employee Number', 'trim|required|xss_clean');
					$this->form_validation->set_rules("time_sheet_required[{$key2}]", 'Allowance Type', 'trim|required|xss_clean');
					$this->form_validation->set_rules("entitled_to_ot[{$key2}]", 'Amount', 'trim|required|xss_clean');
					$this->form_validation->set_rules("entitled_to_nsd[{$key2}]", 'Amount', 'trim|required|xss_clean');
					$this->form_validation->set_rules("night_shift_diff_rate[{$key2}]", 'Amount', 'trim|required|xss_clean');
					$this->form_validation->set_rules("entitled_commission[{$key2}]", 'Amount', 'trim|required|xss_clean');
					$this->form_validation->set_rules("entitled_holi_pre[{$key2}]", 'Amount', 'trim|required|xss_clean');
				}
				
				if ($this->form_validation->run()==true){
					
					foreach($emp_id as $key=>$val){
                	    $add_emp_earnings = array(	
							'emp_id' => $emp_id[$key],
							'company_id' => $this->company_id,
							'minimum_wage_earner' => $min_wage_earner[$key],
							'statutory_min_wage' => $amount[$key],
                	    	'entitled_to_basic_pay' => $entitled_to_basic_pay[$key],
							'pay_rate_type' => $pay_rate_type[$key],
							'timesheet_required' => $time_sheet_required[$key],
                	    	'entitled_to_overtime' => $entitled_to_ot[$key],
							'entitled_to_night_differential_pay' => $entitled_to_nsd[$key],
							'night_diff_rate' => $night_shift_diff_rate[$key],
                	    	'entitled_to_commission' => $entitled_commission[$key],
                	    	'entitled_to_holiday_or_premium_pay' => $entitled_holi_pre[$key]
						);

						$insert_emp_earnings = $this->jmodel->insert_data('employee_earnings',$add_emp_earnings);
					}

					$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully saved!</div>');
					redirect($this->url);
				}
			}
			
			if($this->input->post('update_info')){
				
				// Update Employee Deduction Information
				$emp_idEdit = $this->input->post('emp_idEdit');
				$min_wage_earner = $this->input->post('min_wage_earner');
				$amount = $this->input->post('amount'); 
				$entitled_to_basic_pay = $this->input->post('entitled_to_basic_pay');
				$pay_rate_type = $this->input->post('pay_rate_type');
				$time_sheet_required = $this->input->post('time_sheet_required');
				$entitled_to_ot = $this->input->post('entitled_to_ot');
				$entitled_to_nsd = $this->input->post('entitled_to_nsd');
				$night_shift_diff_rate = $this->input->post('night_shift_diff_rate');
				$entitled_commission = $this->input->post('entitled_commission');
				$entitled_holi_pre = $this->input->post('entitled_holi_pre');
				
				$this->form_validation->set_rules("emp_idEdit", 'Employee ID', 'trim|required|xss_clean');
				$this->form_validation->set_rules("min_wage_earner", 'Minimum Wage Earner', 'trim|required|xss_clean');
				$this->form_validation->set_rules("amount", 'Minimum Wage Amt', 'trim|required|xss_clean');
				$this->form_validation->set_rules("entitled_to_basic_pay", 'Entitled to Basic Pay', 'trim|required|xss_clean');
				$this->form_validation->set_rules("pay_rate_type", 'Pay Rate Type', 'trim|required|xss_clean');
				$this->form_validation->set_rules("time_sheet_required", 'Timesheet Required ', 'trim|required|xss_clean');
				$this->form_validation->set_rules("entitled_to_ot", 'Entitled to Overtime ', 'trim|required|xss_clean');
				$this->form_validation->set_rules("entitled_to_nsd", 'Entitled to NSD', 'trim|required|xss_clean');
				$this->form_validation->set_rules("night_shift_diff_rate", 'NSD Rate', 'trim|required|xss_clean');
				$this->form_validation->set_rules("entitled_commission", 'Entitled to Commission', 'trim|required|xss_clean');
				$this->form_validation->set_rules("entitled_holi_pre", 'Entitled to Holiday/Premium', 'trim|required|xss_clean');
				
				if ($this->form_validation->run()==true){
					$update_info = $this->hr_emp->update_emp_earnings(
							$emp_idEdit,
							$min_wage_earner,
							$amount,
							$entitled_to_basic_pay,
							$pay_rate_type,
							$time_sheet_required,
							$entitled_to_ot,
							$entitled_to_nsd,
							$night_shift_diff_rate,
							$entitled_commission,
							$entitled_holi_pre,
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
				// Delete Employee Earnings Information
				if($this->input->post('delete_db')){
					$emp_id = $this->input->post('emp_id');
					$delete_me = $this->db->query("DELETE FROM employee_earnings WHERE emp_id = '{$emp_id}' and company_id = '{$this->company_id}'");
					if($delete_me){
						$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully deleted!</div>');
						echo json_encode(array("success"=>1,"url"=>$this->url));
						return false;
					}
				}
				
				// Get Information for Employee Earnings Information
				if($this->input->post('get_information')){
					$emp_id = $this->input->post('emp_id');
					$get_info = $this->db->query("
						SELECT *FROM employee_earnings ee
						LEFT JOIN employee e ON ee.emp_id = e.emp_id 
						WHERE ee.emp_id = '{$emp_id}' and ee.company_id = '{$this->company_id}'
					");
					if($get_info->num_rows() > 0){
						$get_info_row = $get_info->row();
						$get_info->free_result();
						echo json_encode(
							array(
								"success"=>1,
								"emp_id"=>$get_info_row->emp_id,
								"emp_name"=>ucwords($get_info_row->first_name)." ".ucwords($get_info_row->last_name),
								"minimum_wage_earner"=>$get_info_row->minimum_wage_earner,
								"statutory_min_wage"=>$get_info_row->statutory_min_wage,
								"entitled_to_basic_pay"=>$get_info_row->entitled_to_basic_pay,
								"pay_rate_type"=>$get_info_row->pay_rate_type,
								"timesheet_required"=>$get_info_row->timesheet_required,
								"entitled_to_overtime"=>$get_info_row->entitled_to_overtime,
								"entitled_to_night_differential_pay"=>$get_info_row->entitled_to_night_differential_pay,
								"night_diff_rate"=>$get_info_row->night_diff_rate,
								"entitled_to_commission"=>$get_info_row->entitled_to_commission,
								"entitled_to_holiday_or_premium_pay"=>$get_info_row->entitled_to_holiday_or_premium_pay
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
			$this->layout->view('pages/hr/emp_earnings_view', $data);
		}
	
	}

/* End of file Emp_earnings.php */
/* Location: ./application/controllers/hr/Emp_earnings.php */