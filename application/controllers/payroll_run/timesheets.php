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
		//$data['emp_sql'] = $this->exclude_list_model->get_employee($offset,$per_page);
		$this->layout->view('pages/payroll_run/timesheets_view',$data);
	}
	
	public function test(){
		echo '
		<html>
		<head>
			<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
			<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		</head>
		<body>	
		'.form_open_multipart("/{$this->session->userdata('sub_domain2')}/payroll_run/exclude_list/test_import").'
			Browse: <input type="file" id="file" class="file" name="file" />
			<input type="submit" name="go" value="go" />
		'.form_close().'
		</body>
		</html>
		';
	}
	
	public function test_import(){
	
		
		// csv file
		$csv_file = $_FILES["file"]["tmp_name"];
		
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
					$this->exclude_list_model->test_import($data[0],$data[1]);
				}
			}
			$i++;
		}
		
		// close file
		fclose($file);

	}
	
}

/* End of file */