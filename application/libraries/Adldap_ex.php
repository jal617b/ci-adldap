<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('Adldap.php');

class Adldap_ex extends Adldap { 
	/**
	*Test connectivity to AD server by binding anonymously
	*
	*@return bool
	*/
	public function bindable(){
		$this->_bind = @ldap_bind($this->_conn);
        if (!$this->_bind){ return (false); }
        return (true);
	}
}