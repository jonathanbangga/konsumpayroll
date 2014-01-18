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

	public function index(){
		// header and menu's
		$data['page_title'] = "Timesheet";
		$this->layout->set_layout($this->theme);
		$data['sidebar_menu'] = $this->sidebar_menu;
		// data
		if(isset($_FILES["file"]["tmp_name"])){
			$this->import_csv($_FILES["file"]["tmp_name"]);
			setcookie('msg','Import success!');
		}
		$this->layout->view('pages/payroll_run/timesheets_view',$data);
	}
	
	public function import_csv($csv_file){
		
		// open file
		$file=fopen($csv_file,"r") or exit("Unable to open file!");
		
		// loop through file
		$i = 0;
		while(!feof($file)){
			// get csv file script, returns an array
			$data = fgetcsv($file);
			// exclude the heading 
			if($i>0){
				// excludes empty data
				if($data[0]!=""){
					// insert data
					$emp_sql = $this->timesheets_model->get_employee_id($data[0],$data[1],$data[2]);
					if($emp_sql->num_rows()>0){
						$emp = $emp_sql->row();
						$emp_id = $emp->emp_id;
						$date = date("Y-m-d",strtotime($data[3]));
						$this->timesheets_model->add_temp_employee_time_in($emp_id,$date,$data[4],$data[5],$data[6],$data[7],$data[8]);
					}
				}
			}
			$i++;
		}
		
		// close file
		fclose($file);

	}
	
}

/* End of file */