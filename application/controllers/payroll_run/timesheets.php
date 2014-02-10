<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timesheets extends CI_Controller {
	
	protected $theme;
	protected $sidebar_menu;
	
	public function __construct() {
		parent::__construct();
		// menu and authentication
		$this->theme = $this->config->item('default');
		$this->menu = 'content_holders/user_hr_owner_menu';
		$this->sidebar_menu = $this->config->item('payroll_run_sidebar_menu');
		$this->authentication->check_if_logged_in();
		// load
		$this->load->model('payroll_run/timesheets_model');	
	}

	public function index($source=0){
		// header and menu's
		$data['page_title'] = "Timesheet";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		$page = 'timesheets_view';
		// get payroll group
		$pp = $this->timesheets_model->get_payroll_period()->row();
		// clicking upload
		//echo $_FILES["file"]["tmp_name"];
		if(isset($_FILES["file"]["tmp_name"])){
			if($_FILES["file"]["tmp_name"]){
				// check of conflicts
				$conflict = $this->check_conflicts($pp->payroll_group_id,$_FILES["file"]["tmp_name"]);
				// if conflicts
				if(count($conflict)>0){
					move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/temp/" . $_FILES["file"]["name"]);
					$data['path_to_file'] = "uploads/temp/" . $_FILES["file"]["name"];
					$data['conflict'] = $conflict;
					$page = 'import_confirm_view';
				}else{
					$data['emp_arr'] = $this->import_csv($pp->payroll_group_id,$_FILES["file"]["tmp_name"]);
					setcookie('msg','Import Success!');
				}
			}	
		}
		// clicking save
		if($this->input->post('hid_save')==1){
			$timesheet = $this->input->post('process_sel');
			$this->timesheets_model->delete_selected_timesheets();
			$this->timesheets_model->save_selected_timesheets($timesheet,$pp->payroll_group_id);
			setcookie('msg','Submission saved!');
		}
		if($this->input->post('hid_delete')==1){
			$eti_emp_id = $this->input->post('eti_emp_id');
			foreach($eti_emp_id as $val){
				$this->timesheets_model->delete_time_ins($val,$source);
			}
			setcookie('msg','Delete Successful!');
		}
		
		// pagination settings
		$config['base_url'] = "/{$this->session->userdata('sub_domain2')}/payroll_run/timesheets/index/{$source}";
		$config['total_rows'] = $this->timesheets_model->get_employee_time_ins($pp->payroll_group_id,$source)->num_rows(); // all results
		$config['per_page'] = 2; // per page
		$config['uri_segment'] = 6; //page number
		
		// pagination mark up
		$config['prev_link'] = 'Previous';
		$config['next_link'] = 'Next';	    
	    $config['full_tag_open'] = '<ul id="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="next">';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a class="btn">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		// intiatalize and create pagination links
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// offset and limit for query
		$offset = ($this->uri->segment($config['uri_segment'])=="")?0:$this->uri->segment($config['uri_segment']);
		$per_page = $config['per_page'];
		// timesheet
		$data['emp_ti_sql'] = $this->timesheets_model->get_employee_time_ins($pp->payroll_group_id,$source,$offset,$per_page);
		// details
		$data['emp_ti_details_sql'] = $this->timesheets_model->get_distinct_employee($pp->payroll_group_id,$source);
		$data['pp_sql'] = $this->timesheets_model->get_payroll_period();
		$data['source'] = $source;
		$this->layout->view("pages/payroll_run/{$page}",$data);
	}
	
	public function import_csv($pg_id,$csv_file){
		
		// open file
		$file=fopen($csv_file,"r") or exit("Unable to open file!");
		
		// loop through file
		$i = 0;
		$emp_arr = array();
		while(!feof($file)){
			// get csv file script, returns an array
			$data = fgetcsv($file);
			// exclude the heading 
			if($i>0){
				// exlude empty name
				if($data[0]!=""){
					// get employee id
					$emp_sql = $this->timesheets_model->get_employee_id($pg_id,$data[0],$data[1],$data[2]);
					if($emp_sql->num_rows()>0){
						$emp = $emp_sql->row();
						$emp_id = $emp->emp_id;
						$date = date("Y-m-d",strtotime($data[3]));
						$time_in = date("Y-m-d H:i:s",strtotime($data[3]));
						$lunch_out = date("Y-m-d H:i:s",strtotime($data[4]));
						$lunch_in = date("Y-m-d H:i:s",strtotime($data[5]));
						$time_out = date("Y-m-d H:i:s",strtotime($data[6]));
						$hours_worked = $data[7];
						
						// get time-in
						$ti_sql = $this->timesheets_model->get_employee_timein_date($pg_id,$date,$emp_id);
						// if time-in date exist
						if($ti_sql->num_rows()>0){
							$ti =  $ti_sql->row();
							$this->timesheets_model->delete_timein($ti->employee_time_in_id);
						}
						
						// insert
						$this->timesheets_model->add_temp_employee_time_in($emp_id,$date,$time_in,$lunch_out,$lunch_in,$time_out,$hours_worked);
					}else{
						$emp_arr[] = $data[0].' '.$data[2];
					}
				}				
			}
			$i++;
		}
		
		// close file
		fclose($file);
		
		return $emp_arr;

	}
	
	public function check_conflicts($pg_id,$csv_file){
	
		// open file
		$file=fopen($csv_file,"r") or exit("Unable to open file!");
		
		// loop through file
		$i = 0;
		$conflict = array();
		while(!feof($file)){
			// get csv file script, returns an array
			$data = fgetcsv($file);
			// exclude the heading 
			if($i>0){
				// excludes empty data
				if($data[0]!=""){
					// check conflicts
					$date = date("Y-m-d",strtotime($data[3]));
					// get employee
					$emp = $this->timesheets_model->get_employee_id($pg_id,$data[0],$data[1],$data[2])->row();
					$ti_sql = $this->timesheets_model->get_employee_timein_date($pg_id,$date,$emp->emp_id);
					if($ti_sql->num_rows()>0){
						$ti = $ti_sql->row();
						$conflict[] = $ti->first_name.' '.$ti->last_name.' '.date("m/d/Y",strtotime($ti->date));
					}
				}
			}
			$i++;
		}
		
		// close file
		fclose($file);
		
		return $conflict;
		
	}
	
	public function import_confirm(){
		$data['page_title'] = "Import Confirmation";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;

		if($this->input->post('hid_yes')==1){
			// get payroll group
			$pp = $this->timesheets_model->get_payroll_period()->row();
			$this->import_csv($pp->payroll_group_id,$this->input->post('path_to_file'));
			unlink($this->input->post('path_to_file'));
			setcookie('msg','Import success!');
			redirect("/{$this->session->userdata('sub_domain2')}/payroll_run/timesheets");
		}else{
			unlink($this->input->post('path_to_file'));
			setcookie('msg','Import cancelled!');
			redirect("/{$this->session->userdata('sub_domain2')}/payroll_run/timesheets");
		}
	}
	
	public function download_timesheet_template(){
		$filename ="booking_report.csv";
		header('Content-type: text/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		echo "First Name,Middle Name,Last Name,Time In,Lunch Out,Lunch In,Time Out,Hours Worked";
	}
	
}

/* End of file */