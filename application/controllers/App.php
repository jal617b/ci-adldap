<?php
defined('BASEPATH') OR exit('No direct script access allowed');


#######################################
# Most samples here uses the grocerycrud library but
# it is still possible to use basic html forms to process data submissions
# always check to codeigniter documentation :: http://localhost/ci319/user_guide/
 
class App extends CI_Controller {
	public function __construct()
	{
		parent::__construct();	
		#$this->output->enable_profiler (1);
	}
	
	
	public function index()
	{
		if(isset($_SESSION['logged_in']))
			 $this->load->view('view');
		else 
			redirect('user/logout');

	}
	
	function user_guide(){
		 $this->load->view('user-guide');
	}
	
	# data source for server-sent events
	# @tutorial : https://www.html5rocks.com/en/tutorials/eventsource/basics/
	#
	function notifier(){
		if(!$this->_logged_in()) redirect('/');
		header('Content-Type: text/event-stream');
		header('Cache-Control: no-cache'); // recommended to prevent caching of event data.
		
		$msg['overdue'] =  rand(0, 100); # sample only; 
		$msg['requests'] =   $this->db->count_all_results('tbl_sample'); #see http://localhost/ci319/user_guide/database/query_builder.html#limiting-or-counting-results
		$msg['active_session'] =  isset($_SESSION['logged_in']); 
		 
		echo "data: ".json_encode($msg) . PHP_EOL;
		echo "retry: 10000". PHP_EOL;
		echo PHP_EOL;
		ob_flush();
		flush();
			
	}

	# NOTE: These samples uses the grocerycrud library (https://www.grocerycrud.com)  for the Create, Read, Update & Delete functionalities

	
	 function sample(){
		if(!$this->_logged_in()) redirect('/');
		$crud = $this->_crud('tbl_sample','Data','Sample Data');
		$crud->required_fields('destination','travel_date');
		$crud->field_type('req_status','hidden');
		$crud->field_type('encoded_by','hidden');
	
		$crud->callback_before_insert(array($this,'set_xdata'));
		$state = $crud->getState();
		if(in_array($state,['list','ajax_list','success','print','export'])){
			$crud->set_relation('req_status','lib_status','status_desc');
			$crud->set_relation('encoded_by','tbl_users','username');
		}
		
		$crud->display_as('req_status','Request Status');
		 
		if(!$this->_is_admin()) { #non-admin users can view their own data only
			$crud->where('encoded_by',$_SESSION['user_id']);
		}
		if(!$this->_can_add()){
			$crud->unset_add();
		}
		if(!$this->_can_edit()){
			$crud->unset_edit();
		}
		if(!$this->_can_delete()){
			$crud->unset_delete();
		}
		
		$output = $crud->render();
		$this->_crud_output($output);
	 }
	 
	 function set_xdata($post_array) {
		$post_array['req_status'] = 1 ; // (NEW) from lib_status
		$post_array['encoded_by'] = $_SESSION['user_id'];
		return $post_array;
	}        
#ADMIN ONLY FUNCTIONS	
	function offices(){
		if(!$this->_is_admin()) redirect('/');
		$crud = $this->_crud('tbl_offices','Office','Offices');
		$current_id = $this->uri->segment(4, 0);
	
		if($current_id > 0)
			$crud->set_relation('parent_id','tbl_offices','short_name',['office_id <>'=>$current_id]);
		else
			$crud->set_relation('parent_id','tbl_offices','full_name');
		$crud->unset_read();
		$crud->unset_clone();
		$crud->unset_delete();
		$crud->display_as('parent_id','Parent Office');
		$crud->display_as('short_name','Abbreviation/Short Name');
		$crud->required_fields('full_name','short_name');
		$output = $crud->render();
		$this->_crud_output($output);
	 }

	 function users($new = null){
		if(!$this->_is_admin()) redirect('/');
		$crud = $this->_crud('tbl_users','','Users');
		$crud->unset_add();
		$crud->unset_read();
		$crud->unset_clone();
		$crud->unset_delete();
		$crud->set_note('<strong>Instructions</strong><br/>Fields marked with asterisk(*) are required.<br/> ');
		if(!is_null($new) && $new ==='new') $crud->or_where(['employeeid'=>'','active'=> 0,'tbl_users.office_id'=>NULL,'user_role'=>NULL]);
		$crud->columns('employeeid','username','firstname','lastname','title','office_id','active','user_role');
		$crud->fields('employeeid','username','firstname','lastname','title','office_id','active','user_role');
		$crud->required_fields('employeeid','office_id','user_role');
		$crud->set_relation('user_role','lib_user_roles','role');
		$crud->set_relation('office_id','tbl_offices','{full_name}');
		$crud->display_as('office_id','Office')
			->display_as('employeeid','ID Number');
		$crud->field_type('username','readonly')
			->field_type('lastname','readonly')
			->field_type('title','readonly')
			->field_type('firstname','readonly');
		$crud->set_lang_string('form_active','Yes')
			->set_lang_string('form_inactive','No');
		
		$crud->where('id <>',$_SESSION['user_id']);
		$crud->callback_edit_field('employeeid', function ($value, $primary_key) { 
			$emp_str =  '<input id="field-employeeid" class="form-control" name="employeeid" type="text" value="'.$value.'" maxlength="55" '.($value ==='' ? '': 'readonly') . '>';
			return $emp_str;
		});
		$output = $crud->render();
		$this->_crud_output($output);
	 }
	
	 function roles(){
		if(!$this->_is_admin()) redirect('/');
		$crud = $this->_crud('lib_user_roles','Role','User Roles');
		$crud->set_lang_string('form_active','Yes')
		->set_lang_string('form_inactive','No');
		$crud->unset_read();
		$crud->unset_delete();
		$crud->display_as("is_admin",'Admin Acct.');
		$crud->required_fields('role','is_admin','can_add','can_edit','can_delete');
		   $output = $crud->render();
		$this->_crud_output($output);
	 }

	 function request_status(){
		if(!$this->_is_admin()) redirect('/');
		$crud = $this->_crud('lib_status','Status','Request Status');
	
		$crud->unset_read();
		$crud->unset_clone();
		$crud->unset_delete();
		$crud->columns('status_desc','lock_record');
		$crud->fields('status_desc','lock_record');
		$crud->required_fields('status_desc','lock_record');
		$crud->display_as('status_desc','Request Status');
		$crud->set_lang_string('form_active','Yes');
		$crud->set_lang_string('form_inactive','No');
	
		   $output = $crud->render();
		$this->_crud_output($output);
	 }
	
 
##############################################################################
	function _crud($tablename = false, $subject = 'Record', $subject_plural ='Records'){
		if(!$tablename) die('Error');
		$crud = new grocery_CRUD();
		$crud->set_subject($subject,$subject_plural);
		$crud->set_table($tablename);
		#$crud->set_theme('datatables');
		#$crud->set_lang_string('form_save_and_go_back','Save');
		#$crud->set_lang_string('form_update_and_go_back','Update');
		$crud->unset_save_button_only();
		$crud->unset_bootstrap();
		$crud->unset_jquery();
		return $crud;
	}
	public function _crud_output($output = null)
	{
		$this->load->view('crud.php',(array)$output);
	}

	function _can_add(){
		return (bool) $_SESSION['can_add'];
	}

	function _can_edit(){
		return (bool) $_SESSION['can_edit'];
	}

	function _can_delete(){
		return (bool) $_SESSION['can_delete'];
	}

	function _is_admin(){
		return (bool) $_SESSION['is_admin'];
	}

	function _logged_in(){
		return (bool) $_SESSION['logged_in'];
	}

}
