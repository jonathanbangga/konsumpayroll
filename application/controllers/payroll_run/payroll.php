<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll Controller
 *
 * @category Controller
 * @version 1.0
 * @author Christopher Cuizon <christophercuizons@gmail.com>
 */
	class Payroll extends CI_Controller {
		
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
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();

			$this->load->model('konsumglobal_jmodel','jmodel');
			$this->load->model('payroll_run/payroll_model','payroll_mdl');
			$this->theme = $this->config->item('default');
			$this->menu = 'content_holders/user_hr_owner_menu';
			$this->sidebar_menu = $this->config->item('payroll_run_sidebar_menu');
			$this->url = "/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$this->uri->segment(4);
			$this->comp_id = $this->uri->segment(1);
		}
		
		/**
		 * Carry Over
		 */
		public function carry_over(){
			$data['page_title'] = "Carry Over";
			$data['sidebar_menu'] = $this->sidebar_menu;
			
			$employee = $this->payroll_mdl->carry_over($this->comp_id);
			
			$data['employee'] = $employee;
			
			if($this->input->post('save')){
				$emp_id = $this->input->post('emp_id');
				$absences = $this->input->post('absences');
				$tardiness = $this->input->post('tardiness');
				$undertime = $this->input->post('undertime');
				$overtime = $this->input->post('overtime');
				$leave_pay = $this->input->post('leave_pay');
				$night_differential = $this->input->post('night_differential');
				$earnings = $this->input->post('earnings');
				$commission = $this->input->post('commission');
				$allowance = $this->input->post('allowance');
				$expense = $this->input->post('expense');
				$loans = $this->input->post('loans');
				
				foreach($emp_id as $key2=>$val){
					$this->form_validation->set_rules("emp_id[{$key2}]", 'Employee ID', 'trim|required|xss_clean');
					$this->form_validation->set_rules("absences[{$key2}]", 'Absences', 'trim|required|xss_clean');
					$this->form_validation->set_rules("tardiness[{$key2}]", 'Tardiness', 'trim|required|xss_clean');
					$this->form_validation->set_rules("undertime[{$key2}]", 'Undertime', 'trim|required|xss_clean');
					$this->form_validation->set_rules("overtime[{$key2}]", 'Overtime', 'trim|required|xss_clean');
					$this->form_validation->set_rules("leave_pay[{$key2}]", 'Leave Pay', 'trim|required|xss_clean');
					$this->form_validation->set_rules("night_differential[{$key2}]", 'Night Differential', 'trim|required|xss_clean');
					$this->form_validation->set_rules("earnings[{$key2}]", 'Earnings', 'trim|required|xss_clean');
					$this->form_validation->set_rules("commission[{$key2}]", 'Commission', 'trim|required|xss_clean');
					$this->form_validation->set_rules("allowance[{$key2}]", 'Allowance', 'trim|required|xss_clean');
					$this->form_validation->set_rules("expense[{$key2}]", 'Expense', 'trim|required|xss_clean');
					$this->form_validation->set_rules("loans[{$key2}]", 'Loans', 'trim|required|xss_clean');
					
					if ($this->form_validation->run()==true){
						foreach($emp_id as $key=>$val){
							$sql = $this->db->query("
								SELECT *
								FROM `payroll_carry_over`
								WHERE emp_id = '{$emp_id[$key]}'
							");
							
							if($sql->num_rows() == 0){
								
								$carry_over = array(	
									'emp_id' => $emp_id[$key],
									'absences' => $absences[$key],
									'tardiness' => $tardiness[$key],
									'undertime' => $undertime[$key],
									'overtime' => $overtime[$key],
								 	'leave_pay' => $leave_pay[$key],
									'night_differential' => $night_differential[$key],
									'earnings' => $earnings[$key],
									'commission' => $commission[$key],
									'allowance' => $allowance[$key],
									'expense' => $expense[$key],
									'loans' => $loans[$key],
									'status' => 'Active'
								);
								
								$insert_carry_over = $this->jmodel->insert_data('payroll_carry_over',$carry_over);
								$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully saved!</div>');	
							}else{
								$update_carry_over = $this->payroll_mdl->update_carry_over(
									$emp_id[$key],$absences[$key],$tardiness[$key],$undertime[$key],$overtime[$key],$leave_pay[$key],
									$night_differential[$key],$earnings[$key],$commission[$key],$allowance[$key],$expense[$key],$loans[$key]
								);
								$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully updated!</div>');
							}
						}
						redirect($this->url);
					}else{
						echo json_encode(array("success"=>0));
						return false;
					}
				}
			}
			
			$this->layout->set_layout($this->theme);
			$this->layout->view('pages/payroll_run/payroll_carryover',$data);
		}
		
	}

/* End of file overtime.php */
/* Location: ./application/controllers/payroll_run/overtime.php */