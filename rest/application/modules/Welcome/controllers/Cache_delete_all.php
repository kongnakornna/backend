<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
//include (dirname(__FILE__) . "./tool/debug.php");
class Cache_delete_all extends REST_Controller{

    public function __construct() {
                parent::__construct();
                $this->load->model('Model_cache_delete_all');
    } 
	public function index_get(){
			ob_end_clean();
		/*
		  $base_url_key=base_url('api/Key/X-API-KEY/FOO');
		  $this->load->helper('url');
	      $this->load->library('rest');
	      $this->load->library('curl');
	      $this->rest->put($base_url_key);
		*/
		$this->load->helper('url');
       echo 'Payasyougo  type';
	} 
	public function all_get( ){
		ob_end_clean(); 
		#  /api/Cache_delete_all/all?format=html
		#  /api/Cache_delete_all/all?format=xml
		#  /api/Cache_delete_all/all?format=json
		       $data = $this->Model_cache_delete_all->cache_delete_all();
                       $this->set_response([
	            	'code' => 200,
	                'status' => TRUE,
	                'error' => 'REST Done',
	                'remarks' => 'API REST Database Cache delete all',
	                'data' => $data,
	            ],REST_Controller::HTTP_OK); 
		 
	} 

}