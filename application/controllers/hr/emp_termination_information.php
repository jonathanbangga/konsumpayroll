<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employee Termination Information Controller
 *
 * @category Controller
 * @version 1.0
 * @author Jonathan Bangga <jonathanbangga@gmail.com>
 */
	class Emp_termination_information extends CI_Controller {
		
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
			$data['page_title'] = "Termination Information";
			$data['sidebar_menu'] = $this->sidebar_menu;
			
			// init pagination
			$uri = "/{$this->uri->segment(1)}/hr/emp_termination_information/index";
			$total_rows = $this->hr_emp->termination_counter($this->company_id);
			$per_page = $this->config->item('per_page');
			$segment=5;
			
			init_pagination($uri,$total_rows,$per_page,$segment);

			$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
			$data["links"] = $this->pagination->create_links();
			
			$data['termination'] = $this->hr_emp->termination($per_page, $page, $this->company_id);
			$employee = $this->hr_emp->view_emp_termination_info($this->company_id);
			$results = "";
			if($employee != FALSE){
				foreach($employee as $row){
					$results .= "{label:'".ucwords($row->first_name)." ".ucwords($row->last_name)."',emp_no:'{$row->payroll_cloud_id}',emp_id:'{$row->emp_id}'},";
				}	
			}
			$data['employee'] = $results;
			
			if($this->input->post('add')){
				$emp_id = $this->input->post('emp_id');
				$last_date = $this->input->post('last_date');
				$reason = $this->input->post('reason');
				$type = $this->input->post('type'); 
				$approval_granted = $this->input->post('approval_granted');
				$approval_date = $this->input->post('approval_date');
				$array_val = $this->input->post('array_val');
				
				foreach($emp_id as $key2=>$val){
					$this->form_validation->set_rules("emp_id[{$key2}]", 'Employee ID', 'trim|required|xss_clean');
					$this->form_validation->set_rules("last_date[{$key2}]", 'Last Date', 'trim|required|xss_clean');
					$this->form_validation->set_rules("reason[{$key2}]", 'Reason', 'trim|required|xss_clean');
					$this->form_validation->set_rules("type[{$key2}]", 'Type', 'trim|required|xss_clean');
					$this->form_validation->set_rules("approval_granted[{$key2}]", 'Approval Granted', 'trim|required|xss_clean');
					$this->form_validation->set_rules("approval_date[{$key2}]", 'Approval Date', 'trim|required|xss_clean');
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
								'company_id' => $this->company_id,
								'last_date' => $last_date[$key],
								'reason' => $reason[$key],
								'type' => $type[$key],
								'approve_granted' => $approval_granted[$key],
							 	'approval_date' => $approval_date[$key],
								'attachment' => "0"
							);
	
							$insert_basic_pay_adjustment = $this->jmodel->insert_data('employee_termination',$add_basci_pay_adjustment);
						}else{
							// uploading file
							if($this->upload->do_upload($file_name)){                                           
		                        $upload_data = $this->upload->data();
	                	    }else{
	                	    	$error = array('error' => $this->upload->display_errors());
	                	    }
	                	    
	                	    $add_basci_pay_adjustment = array(	
								'emp_id' => $emp_id[$key],
								'company_id' => $this->company_id,
								'last_date' => $last_date[$key],
								'reason' => $reason[$key],
								'type' => $type[$key],
								'approve_granted' => $approval_granted[$key],
							 	'approval_date' => $approval_date[$key],
								'attachment' => $upload_data['file_name']
							);
	
							$insert_basic_pay_adjustment = $this->jmodel->insert_data('employee_termination',$add_basci_pay_adjustment);
						}
						
					}
					
					$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully saved!</div>');
					redirect($this->url);
					return false;
				}
			}
			
			if($this->input->post('update_info')){
				
				// Update Employee Termination Information
				$emp_idEdit = $this->input->post('emp_idEdit');
				$last_date_edit = $this->input->post('last_date_edit');
				$reason_edit = $this->input->post('reason_edit');
				$type_edit = $this->input->post('type_edit'); 
				$approval_granted_edit = $this->input->post('approval_granted_edit');
				$approval_date_edit = $this->input->post('approval_date_edit');
				$attachment_old_val = $this->input->post('attachment_old_val');
				
				$this->form_validation->set_rules("emp_idEdit", 'Employee ID', 'trim|required|xss_clean');
				$this->form_validation->set_rules("last_date_edit", 'Last Date', 'trim|required|xss_clean');
				$this->form_validation->set_rules("reason_edit", 'Reason', 'trim|required|xss_clean');
				$this->form_validation->set_rules("type_edit", 'Type', 'trim|required|xss_clean');
				$this->form_validation->set_rules("approval_granted_edit", 'Approval Granted', 'trim|required|xss_clean');
				$this->form_validation->set_rules("approval_date_edit", 'Approval Date', 'trim|required|xss_clean');
				$this->form_validation->set_rules("attachment_old_val", 'Attachment Old value', 'trim|required|xss_clean');
				
				if ($this->form_validation->run()==true){
					
					if($_FILES['userfile']['tmp_name']==""){
						$update_info = $this->hr_emp->update_termination_info(
								$emp_idEdit,
								$last_date_edit,
								$reason_edit,
								$type_edit,
								$approval_granted_edit,
								$approval_date_edit,
								0,
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
						$config['upload_path'] = "./uploads/";
						$config['allowed_types'] = 'doc|docx|xls|xlsx|ppt|pptx|pdf|txt|jpg|png|jpeg|bmp|gif|avi|flv|mpg|wmv|mp3|wma|wav|zip|rar|sql';
						$config['encrypt_name']  = TRUE;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						// uploading file
						if($this->upload->do_upload('userfile')){                                           
	                        $upload_data = $this->upload->data();
	                        
	                        $update_info = $this->hr_emp->update_termination_info(
								$emp_idEdit,
								$last_date_edit,
								$reason_edit,
								$type_edit,
								$approval_granted_edit,
								$approval_date_edit,
								$upload_data['file_name'],
								$this->company_id
							);
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
				// Delete Employee Termination Information
				if($this->input->post('delete_db')){
					$emp_id = $this->input->post('emp_id');
					$photo_val = $this->input->post('attr_photo_val');
					$delete_me = $this->db->query("DELETE FROM employee_termination WHERE emp_id = '{$emp_id}' and company_id = '{$this->company_id}'");
					if($delete_me){
						if($photo_val!="0") unlink(realpath('uploads/'.$photo_val));
						$this->session->set_flashdata('message', '<div class="successContBox highlight_message">Successfully deleted!</div>');
						echo json_encode(array("success"=>1,"url"=>$this->url));
						return false;
					}
				}
				
				// Get Information for Employee Termination Information
				if($this->input->post('get_information')){
					$emp_id = $this->input->post('emp_id');
					$get_info = $this->db->query("
						SELECT *FROM employee_termination et
						LEFT JOIN employee e ON et.emp_id = e.emp_id 
						WHERE et.emp_id = '{$emp_id}' and et.company_id = '{$this->company_id}'
					");
					if($get_info->num_rows() > 0){
						$get_info_row = $get_info->row();
						$get_info->free_result();
						echo json_encode(
							array(
								"success"=>1,
								"emp_id"=>$get_info_row->emp_id,
								"emp_name"=>ucwords($get_info_row->first_name)." ".ucwords($get_info_row->last_name),
								"last_date"=>$get_info_row->last_date,
								"reason"=>$get_info_row->reason,
								"type"=>$get_info_row->type,
								"approve_granted"=>$get_info_row->approve_granted,
								"approval_date"=>$get_info_row->approval_date,
								"attachment"=>$get_info_row->attachment
							)
						);
						return false;
					}else{
						echo json_encode(array("success"=>0));
						return false;
					}
				}
				
				// Update Employee Termination Information
				if($this->input->post('update_info')){
					$emp_idEdit = $this->input->post('emp_idEdit');
					$last_date_edit = $this->input->post('last_date_edit');
					$reason_edit = $this->input->post('reason_edit');
					$type_edit = $this->input->post('type_edit');
					$approval_granted_edit = $this->input->post('approval_granted_edit');
					$approval_date_edit = $this->input->post('approval_date_edit');
					$attachment_val = $this->input->post('attachment_val');
					
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
			$this->layout->view('pages/hr/termination_info_view', $data);
		}
	
	}

/* End of file Emp_termination_information.php */
/* Location: ./application/controllers/hr/Emp_termination_information.php */