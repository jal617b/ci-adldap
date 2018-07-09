<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		date_default_timezone_set("Asia/Manila");
		parent::__construct();
		$this->load->model('ad_user_model','user');
	}
	
	public function index()
	{
		if(!isset($_SESSION['logged_in']) ){
			if (empty($_SESSION['token'])) {
				$_SESSION['token'] =  $this->_token();
			}
			$token = $_SESSION['token'];
			$this->load->view('login');
		}
		else
			redirect('/app/');
	}



 function login(){
	$username = $this->input->post('username');
	$password = $this->input->post('password');
	$token = $this->input->post('token');
	if(  $token !== $_SESSION['token'] ){
		$this->session->set_flashdata('login_msg', 'Access denied.');
		redirect('/');
	}
	else{
		
		$userinfo = $this->user->authenticate($username,$password);
		if(!$userinfo['success']){
			$this->session->set_flashdata('login_msg',$userinfo['message']);
			redirect('/');
		}
		else{
			$this->user->save_user($userinfo,$password);
			$roles = $this->user->user_role($username);
			 #var_dump($roles);die();
			if( ((int)$roles->active === 0 && $roles->role === null ) || trim($roles->employeeid) === '')  {
				$this->session->set_flashdata('login_msg','Hi '.$userinfo['firstname'].', your account for this site is not yet active. Please contact your system admin for account activation.');
				redirect('/');
			}
			else if( (int)$roles->active === 1 && $roles->role != null ) {
				$_SESSION['employeeid'] = $roles->employeeid;
				$_SESSION['role'] = $roles->role;
				$_SESSION['office'] = $roles->office;
				$_SESSION['logged_in'] = true;
				$_SESSION['auth_type'] = $userinfo['auth_type'];
				$_SESSION['title'] = $userinfo['title'];
				$_SESSION['username'] = $username;
				$_SESSION['fullname'] = $userinfo['firstname'] ." " . $userinfo['lastname'];
				$_SESSION['user_id'] = $this->user->get_id($username);
				$_SESSION['is_admin'] = $roles->is_admin ;
				$_SESSION['can_add'] = $roles->can_add ;
				$_SESSION['can_edit'] = $roles->can_edit ;
				$_SESSION['can_delete'] = $roles->can_delete ;
			}
			else if( (int)$roles->active === 0 && $roles->role != null) {
				$this->session->set_flashdata('login_msg','Your account has been locked.');
				redirect('/');
			}
			else {
				$this->session->set_flashdata('login_msg','You do not have permission to access this page.');
				redirect('/');
			}
		}
		unset($_SESSION['token']);
		}
		redirect('/app');
	}

	function logout(){
			session_destroy();
			redirect('/');
	}
  
	function _token(){
		$returnvalue = null;
		if (function_exists('random_bytes')) {
			return bin2hex(random_bytes(32));
		} else {
			return bin2hex(openssl_random_pseudo_bytes(32));
		}
	}
}
