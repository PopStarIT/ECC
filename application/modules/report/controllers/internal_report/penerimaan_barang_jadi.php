<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');Class Penerimaan_barang_jadi extends CI_Controller { 	function __construct(){ 		parent::__construct(); 				$this->data_request = $_REQUEST;				$module = $this->router->module;		$directory = $this->router->directory;		$class = $this->router->class;		$method = $this->router->method;		$directory = trim(str_replace('../modules/'.$module ,'',str_replace('/controllers/','',$directory)),'/');				$this->module = $module;		if(trim($directory) != ''){			$this->directory = $directory;		} else {			$this->directory = '0';			$this->directory2 = '';		}		$this->class = $class;		$this->method = $method;	}		function penerimaan_barang_jadi_table(){		$field = array();		$field['r1'] = array('sc' => 'r1','ctype' => 'text', 'bypassvalue' => '', 'title' => 'NO PENERIMAAN');		$field['r2'] = array('sc' => 'r2','ctype' => 'text', 'bypassvalue' => '', 'title' => 'TGL PENERIMAAN');		$field['r3'] = array('sc' => 'r3','ctype' => 'text', 'bypassvalue' => '', 'title' => 'KODE PLAN');		$field['r4'] = array('sc' => 'r4','ctype' => 'text', 'bypassvalue' => '', 'title' => 'KODE FG');		$field['r5'] = array('sc' => 'r5','ctype' => 'text', 'bypassvalue' => '', 'title' => 'NAMA FG');		$field['r6'] = array('sc' => 'r6','ctype' => 'int', 'bypassvalue' => '', 'title' => 'JUMLAH', 'data_type' => 'decimal', 'decimal_digit' => 4);		$field['r7'] = array('sc' => 'r7','ctype' => 'text', 'bypassvalue' => '', 'title' => 'SAT');				return $field;	}		function index(){		$this->load->model('main');		$component['loadlayout'] = true;		$component['view_load'] = 'internal_report/penerimaan_barang_jadi/view';		$component['load_js'][] = 'internal_report/penerimaan_barang_jadi/view';				$component['page_title'] = "Penerimaan Barang Jadi";		$dashboard_table = array();			$field = $this->penerimaan_barang_jadi_table();				$dashboard_table['field'] = $field;				$component['dashboard_table'] = $dashboard_table;				$this->authentication->ajaxlayout($component);	}		function loaddata(){				$field = $this->penerimaan_barang_jadi_table();				$date_start = isset($_REQUEST['date_start']) ?  $_REQUEST['date_start'] : '';		$date_end = isset($_REQUEST['date_end']) ? $_REQUEST['date_end'] : '';		$print = isset($_REQUEST['print']) ? $_REQUEST['print'] : 0;		$format = isset($_REQUEST['format']) ? $_REQUEST['format'] : 'xlsx';		$page = isset($_POST['page'])?$_POST['page']:1; // get the requested page         $rows = isset($_POST['rows'])?$_POST['rows']:10; // get how many rows we want to have into the grid         $sidx = isset($_POST['sidx'])?$_POST['sidx']:'r1'; // get index row - i.e. user click to sort         $sord = isset($_POST['sord'])?$_POST['sord']:'0'; // get the direction 		$search = isset($_REQUEST['_search'])?$_REQUEST['_search']:false; 		$filterRules =  isset($_POST['filters'])?$_POST['filters']:false;						$limit =  $rows;		$offset =  $rows * ($page - 1);				$order = isset($_REQUEST['order']) ? $_REQUEST['order'] : array();				if($sord == 'asc'){			$sord = 1;		} else {			$sord = 2;		}				$sort =	$sidx. '='.$sord;							if(strlen(trim($date_start)) == 0 ){			$date_start = '1900-01-01';		}				if(strlen(trim($date_end)) == 0 ){			$date_end = '9999-12-31';		}				$return = array();		$return['valid'] = false;		$return['message'] = "Internal Server Error";											$sp = "dbo.sp_rpt_penerimaan_barang_jadi";				if($print == 1){			$this->rpc_service->setSP(array("sp"=> $sp,"mode"=> $print == 1 ? "2" : "1","debug"=>"1"));		} else {			$this->rpc_service->setSP($sp);		}				$this->rpc_service->addField('date_start',$date_start);		$this->rpc_service->addField('date_end',$date_end);		$this->rpc_service->addField('format',$format);		$this->rpc_service->addField('temp_folder',sys_get_temp_dir());		$this->rpc_service->addField('sort',$sort);		$this->rpc_service->addField('limit',$limit);		$this->rpc_service->addField('offset',$offset);						$this->rpc_service->setWhere($search,$filterRules,$field);				if($print == 1){						$result = $this->rpc_service->resultPrint2();			echo json_encode($result);		} else {			$this->authentication->plainlayout();									$result = $this->rpc_service->resultJSON();				$data_result = json_decode($result['data'],true);						if(isset($data_result['detail']['result_count'])){				$records = $data_result['detail']['result_count'];				$total = ceil($data_result['detail']['result_count'] / $limit);			} else {				$records = 0;				$total = 0;			}						$responce = new stdclass();			$responce->page = $page;			$responce->records = $records;			$responce->total = $total;			$i=0; 			if($data_result){				if(isset($data_result['xrow'])){					foreach($data_result['xrow'] as $key=>$value){						foreach ($value as $k => $v) {													$responce->rows[$i][$k] = $v;						} 						$i++;					}				}			}					echo json_encode($responce);		}	}}?>