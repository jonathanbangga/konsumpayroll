<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Basic Pay Adjusment Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_basic_pay_adjustment extends CI_Controller {
		
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
			$this->company_id = 1;
			
			$this->sidebar_menu = 'content_holders/hr_employee_sidebar_menu';
			$this->menu = 'content_holders/company_menu';
			$this->url = "/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$this->uri->segment(4);
		}
		
		/**
		 * index page
		 */
		public function index() {
			$data['page_title'] = "Basic Pay Adjustment";
			$data['sidebar_menu'] = $this->sidebar_menu;
			
			$uri = "/{$this->uri->segment(1)}/hr/emp_basic_pay_adjustment/index";
			$total_rows = $this->hr_emp->basic_pay_adjustment_count($this->company_id);
			$per_page =2;
			$segment=5;
			
			init_pagination($uri,$total_rows,$per_page,$segment);

			$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
			$data["links"] = $this->pagination->create_links();
			
			$data['basic_pay_adjustment'] = $this->hr_emp->basic_pay_adjustment($per_page, $page, $this->company_id);
			$employee = $this->hr_emp->view_emp_basic_pay_adjustment($this->company_id);
			$results = "";
			if($employee != FALSE){
				foreach($employee as $row){
					$results .= "{label:'".ucwords($row->first_name)." ".ucwords($row->last_name)."',emp_no:'{$row->payroll_cloud_id}',emp_id:'{$row->emp_id}'},";
				}	
			}
			$data['employee'] = $results;
			
			if($this->input->post('add')){
				$emp_id = $this->input->post('emp_id');
				$emp_name = $this->input->post('emp_name');
				$emp_no = $this->input->post('emp_no');
				$current_basic_pay = $this->input->post('current_basic_pay'); 
				$new_basic_pay = $this->input->post('new_basic_pay');
				$effective_date = $this->input->post('effective_date');
				$adjustment_date = $this->input->post('adjustment_date');
				$reasons = $this->input->post('reasons');
				$array_val = $this->input->post('array_val');
				
				foreach($emp_id as $key2=>$val){
					$this->form_validation->set_rules("emp_id[{$key2}]", 'Employee ID', 'trim|required|xss_clean');
					$this->form_validation->set_rules("emp_name[{$key2}]", 'Employee Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules("emp_no[{$key2}]", 'Employee Number', 'trim|required|xss_clean');
					$this->form_validation->set_rules("current_basic_pay[{$key2}]", 'Current Basic Pay', 'trim|required|xss_clean');
					$this->form_validation->set_rules("new_basic_pay[{$key2}]", 'New Basic Pay', 'trim|required|xss_clean');
					$this->form_validation->set_rules("effective_date[{$key2}]", 'Effective Date', 'trim|required|xss_clean');
					$this->form_validation->set_rules("adjustment_date[{$key2}]", 'Adjustment Date', 'trim|required|xss_clean');
					$this->form_validation->set_rules("reasons[{$key2}]", 'Reasons', 'trim|required|xss_clean');
					$this->form_validation->set_rules("array_val[{$key2}]", '', 'trim|required|xss_clean');
				}
				
				if ($this->form_validation->run()==true){
					
					$config['upload_path'] = "./uploads/";
					$config['allowed_types'] = 'doc|docx|xls|xlsx|ppt|pptx|pdf|txt|jpg|png|jpeg|bmp|gif|avi|flv|mpg|wmv|mp3|wma|wav|zip|rar|sql';
					$config['encrypt_name']  = TRUE;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					
					foreach($emp_id as $key=>$val){
						$file_name = "userfile".$array_val[$key];
						if($_FILES[$file_name]['tmp_name']==""){
							$add_basci_pay_adjustment = array(	
								'emp_id' => $emp_id[$key],
								'comp_id' => $this->company_id,
								'current_basic_pay' => $current_basic_pay[$key],
								'new_basic_pay' => $new_basic_pay[$key],
								'effective_date' => $effective_date[$key],
								'adjustment_date' => $adjustment_date[$key],
							 	'reasons' => $reasons[$key],
								'attachment' => "0"
							);
	
							$insert_basic_pay_adjustment = $this->jmodel->insert_data('basic_pay_adjustment',$add_basci_pay_adjustment);
						}else{
							// uploading file
							if($this->upload->do_upload($file_name)){                                           
		                        $upload_data = $this->upload->data();
	                	    }else{
	                	    	$error = array('error' => $this->upload->display_errors());
	                	    }
	                	    
	                	    $add_basci_pay_adjustment = array(	
								'emp_id' => $emp_id[$key],
								'comp_id' => $this->company_id,
								'current_basic_pay' => $current_basic_pay[$key],
								'new_basic_pay' => $new_basic_pay[$key],
								'effective_date' => $effective_date[$key],
								'adjustment_date' => $adjustment_date[$key],
							 	'reasons' => $reasons[$key],
								'attachment' => $upload_data['file_name']
							);
	
							$insert_basic_pay_adjustment = $this->jmodel->insert_data('basic_pay_adjustment',$add_basci_pay_adjustment);
						}
						
					}
					
					$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully saved!</div>');
					redirect($this->url);
					return false;
				}
			}
			
			if($this->input->post('update_info')){
				
				// Update Employee Basic Pay Adjustment
				$emp_idEdit = $this->input->post('emp_idEdit');
				$current_basic_pay_edit = $this->input->post('current_basic_pay_edit');
				$new_basic_pay_edit = $this->input->post('new_basic_pay_edit');
				$effective_date_edit = $this->input->post('effective_date_edit'); 
				$adjustment_date_edit = $this->input->post('adjustment_date_edit');
				$reason_for_adjustment_edit = $this->input->post('reason_for_adjustment_edit');
				$attachment_old_val = $this->input->post('attachment_old_val');
				
				$this->form_validation->set_rules("emp_idEdit", 'Employee ID', 'trim|required|xss_clean');
				$this->form_validation->set_rules("current_basic_pay_edit", 'Current Basic Pay', 'trim|required|xss_clean');
				$this->form_validation->set_rules("new_basic_pay_edit", 'New Basic Pay', 'trim|required|xss_clean');
				$this->form_validation->set_rules("effective_date_edit", 'Effective Date', 'trim|required|xss_clean');
				$this->form_validation->set_rules("adjustment_date_edit", 'Adjustment Date', 'trim|required|xss_clean');
				$this->form_validation->set_rules("reason_for_adjustment_edit", 'Reason for Adjustment', 'trim|required|xss_clean');
				$this->form_validation->set_rules("attachment_old_val", 'Attachment Old value', 'trim|required|xss_clean');
				
				if ($this->form_validation->run()==true){
					
					if($_FILES['userfile']['tmp_name']==""){
						$update_info = $this->hr_emp->update_basic_pay_adjustment($emp_idEdit,$current_basic_pay_edit,$new_basic_pay_edit,$effective_date_edit,$adjustment_date_edit,$reason_for_adjustment_edit,0,$this->company_id);
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
						$config['upload_path'] = "./uploads/";
						$config['allowed_types'] = 'doc|docx|xls|xlsx|ppt|pptx|pdf|txt|jpg|png|jpeg|bmp|gif|avi|flv|mpg|wmv|mp3|wma|wav|zip|rar|sql';
						$config['encrypt_name']  = TRUE;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						// uploading file
						if($this->upload->do_upload('userfile')){                                           
	                        $upload_data = $this->upload->data();
	                        $update_info = $this->hr_emp->update_basic_pay_adjustment($emp_idEdit,$current_basic_pay_edit,$new_basic_pay_edit,$effective_date_edit,$adjustment_date_edit,$reason_for_adjustment_edit,$upload_data['file_name'],$this->company_id);
                	    }else{
                	    	echo json_encode(array("success"=>0,'error' => $this->upload->display_errors()));
							return false;
                	    }
						
						if($update_info){
							if($attachment_old_val!="0") unlink(realpath('uploads/'.$attachment_old_val));
							$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully updated!</div>');
							redirect($this->url);
							return false;
						}else{
							echo json_encode(array("success"=>0));
							return false;
						}
					}
				}else{
					echo json_encode(array("success"=>0));
					return false;
				}
			}
			
			if($this->input->is_ajax_request()) {
				// Delete Employee for Basic Pay Adjustment
				if($this->input->post('delete_basic_pay_adjustment')){
					$emp_id = $this->input->post('emp_id');
					$photo_val = $this->input->post('attr_photo_val');
					$delete_me = $this->db->query("DELETE FROM basic_pay_adjustment WHERE emp_id = '{$emp_id}' and comp_id = '{$this->company_id}'");
					if($delete_me){
						if($photo_val!="0") unlink(realpath('uploads/'.$photo_val));
						$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully deleted!</div>');
						echo json_encode(array("success"=>1,"url"=>$this->url));
						return false;
					}
				}
				
				// Get Information for Employee Basic Pay Adjustment
				if($this->input->post('get_information')){
					$emp_id = $this->input->post('emp_id');
					$get_info = $this->db->query("
						SELECT *FROM basic_pay_adjustment b
						LEFT JOIN employee e ON b.emp_id = e.emp_id 
						WHERE b.emp_id = '{$emp_id}' and b.comp_id = '{$this->company_id}'
					");
					if($get_info->num_rows() > 0){
						$get_info_row = $get_info->row();
						$get_info->free_result();
						echo json_encode(
							array(
								"success"=>1,
								"emp_id"=>$get_info_row->emp_id,
								"emp_name"=>ucwords($get_info_row->first_name)." ".ucwords($get_info_row->last_name),
								"current_basic_pay"=>$get_info_row->current_basic_pay,
								"new_basic_pay"=>$get_info_row->new_basic_pay,
								"effective_date"=>$get_info_row->effective_date,
								"adjustment_date"=>$get_info_row->adjustment_date,
								"reasons"=>$get_info_row->reasons,
								"attachment"=>$get_info_row->attachment
							)
						);
						return false;
					}else{
						echo json_encode(array("success"=>0));
						return false;
					}
				}
				
				// Update Employee Basic Pay Adjustment
				if($this->input->post('update_info')){
					$emp_idEdit = $this->input->post('emp_idEdit');
					$dateFromEdit = $this->input->post('dateFromEdit');
					$dateToEdit = $this->input->post('dateToEdit');
					$courseNameEdit = $this->input->post('courseNameEdit');
					$organizerEdit = $this->input->post('organizerEdit');
					$costEdit = $this->input->post('costEdit');
					$trainingHoursEdit = $this->input->post('trainingHoursEdit');
					
					$update_info = $this->hr_emp->update_train_details($emp_idEdit,$dateFromEdit,$dateToEdit,$courseNameEdit,$courseNameEdit,$organizerEdit,$costEdit,$trainingHoursEdit,$this->company_id);
					if($update_info){
						$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully updated!</div>');
						echo json_encode(array("success"=>1));
						return false;
					}else{
						echo json_encode(array("success"=>0));
						return false;
					}
				}
			}
			
			$this->layout->set_layout($this->theme);
			$this->layout->view('pages/hr/basic_pay_adjustment_view', $data);
		}
	
	}

/* End of file Emp_basic_pay_adjustment.php */
/* Location: ./application/controllers/hr/Emp_basic_pay_adjustment.php */