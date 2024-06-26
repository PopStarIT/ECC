<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Application constant string
| -------------------------------------------------------------------
*/

$config_path = realpath('bricks_data');

if(!is_dir($config_path)){
	exit('No direct script access allowed');
}

$config_array = array();
$config_array['base_config'] = 'base_config.json';
$config_array['module_config'] = 'module_config.json';
$config_array['class_config'] = 'class_config.json';
$config_array['method_config'] = 'method_config.json';
$config_array['role_config'] = 'role_config.json';
$config_array['menu_config'] = 'menu_config.json'; 
$config_array['role_username_config'] = 'role_username_config.json';


foreach($config_array as $key => $value){
	
	$array = array();
	if(is_file($config_path.'/'.$value)){
		$json = file_get_contents($config_path.'/'.$value);
		$array = json_decode($json, true);
	}

	$config[$key] = $array;

}

$config['api_url'] = 'http://localhost:8082/api_ecc/api/';
$config['api_username'] = 'admin';
$config['api_key'] = 'DUNHILLMILD';
$config['bricks_config_path'] = $config_path;