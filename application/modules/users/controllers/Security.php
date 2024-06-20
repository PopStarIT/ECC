<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Security extends CI_Controller {

	function __construct(){ 
		parent::__construct(); 
		
		$this->data_request = $_REQUEST;
		
		$module = $this->router->module;
		$directory = $this->router->directory;
		$class = $this->router->class;
		$method = $this->router->method;
		$directory = trim(str_replace('../modules/'.$module ,'',str_replace('/controllers/','',$directory)),'/');
		
		$this->module = $module;
		if(trim($directory) != ''){
			$this->directory = $directory;
		} else {
			$this->directory = '0';
			$this->directory2 = '';
		}
		$this->class = $class;
		$this->method = $method;
	} 

	function index(){ 
		$component['loadlayout'] = true;
		
		$component['page_title'] = 'Security';
		$component['page_icon'] = 'fa fa-lock';
		$component['view_load'] = 'security';
		$component['load_js'][] = 'security';
		
				 
		$this->authentication->cplayout($component);
	} 
	
	function security_submit(){
		$this->authentication->plainlayout();
		$parameter = array();
        $return = array();
        
		$return['valid'] = false;
		$return['message'] = 'Internal server error, please try again';
		
		$error = 0;
		$error_msg = "";
		
        $oldpassword = isset($_POST['oldpassword']) ? trim($_POST['oldpassword']) : null;
        $password = isset($_POST['password']) ? trim($_POST['password']) : null;
        $password2 = isset($_POST['password2']) ? trim($_POST['password2']) : null;
        $user_id = $this->session->userdata('user_id');
        		
		if($error == 0){

			$array = array();
			$array['oldpassword'] = $oldpassword;
			$array['password'] = $password;
			$array['password2'] = $password2;
			$array['user_id'] = $user_id;
			
			$sp = $this->clientapi->user_security($array);
		
			if(isset($sp->status)){
				if($sp->status == 'success'){
					if(isset($sp->data)){
												
						$return['valid'] = true;
						$return['status_code'] = 200;
						$return['message'] = $sp->data->message;
					}
						
				} else {
					$return['message'] = $sp->data->error_message;
				}
			}
		} else {
			$return['valid'] = false;
			$return['message'] = $error_msg;
		}
		
        echo json_encode($return);
	}
}