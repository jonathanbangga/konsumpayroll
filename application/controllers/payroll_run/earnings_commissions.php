<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	  
class Earnings_commissions extends CI_Controller {
	
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
		
		$this->load->model("payroll_run/earnings_commissions_model","ecm");
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
	
	public function commission()
	{
		if ($this->input->post()) {
			$this->form_validation->set_rules('sales_amount[]','Sales Amount','trim|xss_clean');
			$this->form_validation->set_rules('earning_id[]','Commission Type','trim|xss_clean');
			$this->form_validation->set_rules('rate_per[]','Rate Percentage','trim|xss_clean');
			$this->form_validation->set_rules('tax_rate[]','Witholding Tax Rate','trim|xss_clean');
			
			if ($this->form_validation->run() == TRUE) { 
				$post = $this->input->post();
				
				foreach ($post['sales_amount'] as $key => $sa) {
					// calculate
					if ($post['sales_amount'][$key] && $post['earning_id'][$key]) {
						$q = $this->ecm->get_earning($post['earning_id'][$key],$this->company_id);
						
						$rate_per = $q->withholding_tax_rate;
						
						if ($q->taxable && $q->max_non_taxable < $post['sales_amount'][$key]) {
							$x = $post['sales_amount'][$key] - $q->max_non_taxable;
							$tax_rate = $x * ($q->withholding_tax_rate / 100);
							$commission_amount = $post['sales_amount'][$key] - $tax_rate;
						} else {
							$tax_rate = 0;
							$commission_amount = $post['sales_amount'][$key];
						}
					} else {
						$rate_per = 0;
						$tax_rate = 0;
						$commission_amount = 0;
					}
					
					// check if it exists
					$check  = $this->ecm->get_payroll_commission($this->company_id,$key);
					
					if ($check) {
						$where = array(
							'account_id' => $key,
							'company_id' => $this->company_id
						);
						$commission = array(
							'sales_amount' 		=> $post['sales_amount'][$key],
							'earning_id'   		=> $post['earning_id'][$key],
							'rate_per'	   		=> $rate_per,
							'tax_rate'	   		=> $tax_rate,
							'commission_amount' => $commission_amount 
						);
						$this->ecm->update_payroll_commission($where,$commission);
					} else {
						$commission = array(
							'account_id'		=> $key,
							'company_id'		=> $this->company_id,
							'sales_amount' 		=> $post['sales_amount'][$key],
							'earning_id'   		=> $post['earning_id'][$key],
							'rate_per'	   		=> $rate_per,
							'tax_rate'	   		=> $tax_rate,
							'commission_amount' => $commission_amount 
						);
						$this->ecm->add_payroll_commission($commission);
					}
				}
				redirect('/'.$this->subdomain.'/payroll_run/earnings_commissions/commission','location');
			}
		}
		
		$data['page_title'] = "Earnings and Commissions";
		$data['sidebar_menu'] = $this->sidebar_menu;
		
		$total_rows = $this->ecm->count_employees($this->company_id);
		$uri = $this->uri->segment(1).'/payroll_run/earnings_commissions/commission';
		
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0; 
		
		init_pagination($uri,$total_rows,$this->per_page,$this->segment);
		$data['links'] = $this->pagination->create_links();
		
		$data['q']  = $this->ecm->get_employees_commissions($this->company_id,$page,$this->per_page);
		$data['q1'] = $this->ecm->get_earnings($this->company_id);
		
		$this->layout->set_layout($this->theme);
		$this->layout->view('pages/payroll_run/earnings_commissions_view',$data);
	}
	
	public function piece_rate()
	{
		$data['page_title'] = "Earnings and Commissions";
		$data['sidebar_menu'] = $this->sidebar_menu;
		
		$total_rows = $this->ecm->count_employees($this->company_id);
		$uri = $this->uri->segment(1).'/payroll_run/earnings_commissions/commission';
		
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0; 
		
		init_pagination($uri,$total_rows,$this->per_page,$this->segment);
		$data['links'] = $this->pagination->create_links();
		
		$data['q'] = $this->ecm->get_employees_commissions($this->company_id,$page,$this->per_page);
		
		$this->layout->set_layout($this->theme);
		$this->layout->view('pages/payroll_run/piece_rate_view',$data);
	}
	
	public function other_earnings()
	{
	if ($this->input->post()) {
			$this->form_validation->set_rules('sales_amount[]','Sales Amount','trim|xss_clean');
			$this->form_validation->set_rules('earning_id[]','Commission Type','trim|xss_clean');
			$this->form_validation->set_rules('rate_per[]','Rate Percentage','trim|xss_clean');
			$this->form_validation->set_rules('tax_rate[]','Witholding Tax Rate','trim|xss_clean');
			
			if ($this->form_validation->run() == TRUE) { 
				$post = $this->input->post();
				
				foreach ($post['sales_amount'] as $key => $sa) {
					// calculate
					if ($post['sales_amount'][$key] && $post['earning_id'][$key]) {
						$q = $this->ecm->get_earning($post['earning_id'][$key],$this->company_id);
						
						$rate_per = $q->withholding_tax_rate;
						
						if ($q->taxable && $q->max_non_taxable < $post['sales_amount'][$key]) {
							$x = $post['sales_amount'][$key] - $q->max_non_taxable;
							$tax_rate = $x * ($q->withholding_tax_rate / 100);
							$amount = $post['sales_amount'][$key] - $tax_rate;
						} else {
							$tax_rate = 0;
							$amount = $post['sales_amount'][$key];
						}
					} else {
						$rate_per = 0;
						$tax_rate = 0;
						$amount = 0;
					}
					
					// check if it exists
					$check  = $this->ecm->get_payroll_other_earning($this->company_id,$key);
					
					if ($check) {
						$where = array(
							'account_id' => $key,
							'company_id' => $this->company_id
						);
						$earning = array(
							'sales_amount' 		=> $post['sales_amount'][$key],
							'earning_id'   		=> $post['earning_id'][$key],
							'rate_per'	   		=> $rate_per,
							'tax_rate'	   		=> $tax_rate,
							'amount' 			=> $amount 
						);
						$this->ecm->update_payroll_other_earning($where,$earning);
					} else {
						$earning = array(
							'account_id'		=> $key,
							'company_id'		=> $this->company_id,
							'sales_amount' 		=> $post['sales_amount'][$key],
							'earning_id'   		=> $post['earning_id'][$key],
							'rate_per'	   		=> $rate_per,
							'tax_rate'	   		=> $tax_rate,
							'amount' 			=> $amount 
						);
						$this->ecm->add_payroll_other_earning($earning);
					}
				}
				redirect('/'.$this->subdomain.'/payroll_run/earnings_commissions/other_earnings','location');
			}
		}
		
		$data['page_title'] = "Earnings and Commissions";
		$data['sidebar_menu'] = $this->sidebar_menu;
		
		$total_rows = $this->ecm->count_employees($this->company_id);
		$uri = $this->uri->segment(1).'/payroll_run/earnings_commissions/earning';
		
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0; 
		
		init_pagination($uri,$total_rows,$this->per_page,$this->segment);
		$data['links'] = $this->pagination->create_links();
		
		$data['q']  = $this->ecm->get_employees_other_earnings($this->company_id,$page,$this->per_page);
		$data['q1'] = $this->ecm->get_earnings($this->company_id);
		
		$this->layout->set_layout($this->theme);
		$this->layout->view('pages/payroll_run/other_earnings_view',$data);
	}
	
	public function calculate()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->input->post('sales_amount') && $this->input->post('earning_id')) {
				$post = $this->input->post();
				
				$q = $this->ecm->get_earning($post['earning_id'],$this->company_id);
				
				if ($q->taxable && $q->max_non_taxable < $post['sales_amount']) {
					$x = $post['sales_amount'] - $q->max_non_taxable;
					$tax_rate = $x * ($q->withholding_tax_rate / 100);
					
					$amount = $post['sales_amount'] - $tax_rate;
				} else {
					$tax_rate = 0;
					$amount = $post['sales_amount'];
				}
				
				$result = array(
					'rate_per' 			=> $q->withholding_tax_rate,
					'tax_rate' 			=> $tax_rate,
					'commission_amount' => $amount
				);
			} else {
				$result = array(
					'rate_per' 			=> 0,
					'tax_rate' 			=> 0,
					'commission_amount' => 0
				);
			}
			echo json_encode($result);
		} else {
			show_404();
		}
	}
	
}
