<?php
/*
#class to authenticate against active directory server with fallback to database if ad server is unreachable
#operation:
 1. on login, will attempt to authenticate with AD server.
 2. 
 
*/
class Ad_user_model extends CI_Model
{

 public $username;
 
 /* authenticate user
 * return userinfo array if ok
 * else return array with error msg
 * 
 */
 public function authenticate($username,$password){
    $this->load->library('adldap_ex');
    $userinfo = $authenticated = false;
    $retval =[];
    
    if($this->adldap_ex->bindable()){
        $authenticated =@$this->adldap_ex->authenticate($username,$password);
        if($authenticated){
            $userinfo =@$this->adldap_ex->user_info($username,['*']);
            $retval['username']		=	$userinfo[0]["samaccountname"][0];
            $retval['displayname']	=	$userinfo[0]["displayname"][0];
            $retval['firstname']		=	$userinfo[0]["givenname"][0];
            $retval['lastname']		=	$userinfo[0]["sn"][0];
            $retval['title'] 				= isset($userinfo[0]["title"][0]) ? 	$userinfo[0]["title"][0] : '';
			$retval['employeeid'] 			=	isset($userinfo[0]["employeeid"][0]) ? $userinfo[0]["employeeid"][0] :'';
            $retval['auth_type'] 		=	'ad';
            $retval['success']      		=   true;
 
         }else{
            $retval['success']      		=   false;
            $retval['message']      	=   'Incorrect username or password.';
         }
    }  
    else{
        $fallback_login_qry = $this->db->get_where('tbl_users',['username'=>trim($username)],1);
        $row = $fallback_login_qry->row();
	    if(isset($row) && password_verify($password,$row->password) ){
            $authenticated = true;
            $retval['username'] 	=	$username;
            $retval['firstname'] 	=	$row->firstname;
            $retval['lastname'] 	=	$row->lastname;
            $retval['title'] 		=	$row->title;
            $retval['employeeid'] 	=	$row->employeeid;
            $retval['auth_type'] 	=	'db';
            $retval['success']      =   true;
        }
 
		else{
            $retval['success']      =   false;
            $retval['message']      =   'Incorrect username or password.';
        }
    }
	
    return $retval;
}
 
 
 
public function save_user($userinfo,$password){
	$id = $this->get_id($userinfo['username']);
	if(!$id){
		 $data = [
				'username' 	=> $userinfo['username'],
				'firstname' => $userinfo['firstname'],
				'lastname' 	=> $userinfo['lastname'],
				'title' 	=> $userinfo['title'],
				'employeeid'    => $userinfo['employeeid'],
				'active'	=> 0,
				'password' 	=> password_hash($password, PASSWORD_DEFAULT),
				'last_login' => date("Y-m-d H:i:s")
				];
		$this->db->insert('tbl_users', $data);
	}
	else{
	    $data = [
				'title' 	=> $userinfo['title'],
				'last_login' =>date("Y-m-d H:i:s"),
				'password' => password_hash($password, PASSWORD_DEFAULT)
				];
	$this->db->where('username',$userinfo['username']);
	$this->db->update('tbl_users', $data);
	}
		
 }

 
 
 public function get_id($username){
		$this->db->select('id');
		$this->db->or_where('username', $username);
		$this->db->from('tbl_users');
		$query = $this->db->get();
		$row = $query->row();

		$retval = FALSE;
		if(isset($row)) $retval = $row->id;
		return $retval;
 }
 
 
  public function exists($username){
		$this->db->select('id');
		$this->db->or_where('username', $username);
		$this->db->from('tbl_users');
		$query = $this->db->get();
		$row = $query->row();

		$retval = FALSE;
		if(isset($row)) $retval = $row->id;
		return $retval;
 }

  public function is_active($user_id){
		$this->db->select('active');
		$this->db->where('id', $user_id);
		$this->db->from('tbl_users');
		$query = $this->db->get();
		$row = $query->row();

		$retval = FALSE;
		if(isset($row)) $retval = $row->active;
		return (boolean) $retval;
 }
 
 public function get_permissions($username){
	 $this->db->select('tbl_users.id, role, is_admin, can_add, can_edit, can_delete ');
	 $this->db->from('tbl_user_roles');
	 $this->db->join('lib_user_roles', 'lib_user_roles.role_id = tbl_user_roles.user_id', 'left');
	 	$this->db->join('tbl_users', 'tbl_users.id = tbl_user_roles.user_id','left');
	 $this->db->where('users.username',$username);
	 $query = $this->db->get();
	return $query->row();
 }
 
 
 
public function user_role($username = false){
    if(!$username) die('Username required.');
    $this->db->select('employeeid,tbl_users.id,short_name as office,tbl_users.active,role,can_add,can_edit,can_delete,is_admin');
    $this->db->from('tbl_users');
    $this->db->join('lib_user_roles', 'lib_user_roles.role_id = tbl_users.user_role','left');
    $this->db->join('tbl_offices', 'tbl_offices.office_id = tbl_users.office_id','left');
    $this->db->where('tbl_users.username',$username);
    $query = $this->db->get();
    $row = $query->row();
    return $row;
}
 
 
}